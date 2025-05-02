<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProgrammesController extends Controller
{
    private function getApplication($id)
    {
        $application = DB::connection('sqlsrv')->table('mother_applications')
            ->where('id', $id)
            ->first();

        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }

        return $application;
    }

    public function FieldData()
    {
        $PageTitle = 'FIELD DATA';
        $PageDescription = '';

        return view('programmes.field_data', compact('PageTitle', 'PageDescription'));
    }


    public function Payments()
    {
        $PageTitle = 'PAYMENTS';
        $PageDescription = '';

        // Get payment data
        $paymentData = $this->getPaymentData();

        return view('programmes.payments', array_merge(
            $paymentData,
            [
                'PageTitle' => $PageTitle,
                'PageDescription' => $PageDescription
            ]
        ));
    }

    /**
     * Filter payment data based on request parameters
     */
    public function filterPayments(Request $request)
    {
        // Validate request
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'payment_type' => 'nullable|string|in:all,initial,betterment,final',
            'payment_status' => 'nullable|string'
        ]);

        // Get filtered payment data
        $paymentData = $this->getPaymentData($request);

        return response()->json($paymentData);
    }

    /**
     * Get payment data with optional filters
     */
    private function getPaymentData(Request $request = null)
    {
        // Initialize query builders
        $billingQuery = DB::connection('sqlsrv')->table('billing');

        // Apply date filters if provided
        if ($request && $request->filled('start_date')) {
            $billingQuery->whereDate('billing.created_at', '>=', $request->start_date);
        }

        if ($request && $request->filled('end_date')) {
            $billingQuery->whereDate('billing.created_at', '<=', $request->end_date);
        }

        // Apply payment type filter if provided
        if ($request && $request->filled('payment_type') && $request->payment_type !== 'all') {
            switch ($request->payment_type) {
                case 'initial':
                    $billingQuery->whereNotNull('Scheme_Application_Fee')
                        ->where(DB::raw('CAST(Scheme_Application_Fee AS FLOAT)'), '>', 0);
                    break;
                case 'betterment':
                    $billingQuery->whereNotNull('Betterment_Charges')
                        ->where(DB::raw('CAST(Betterment_Charges AS FLOAT)'), '>', 0);
                    break;
                case 'final':
                    // Final bill typically includes processing fees
                    $billingQuery->whereNotNull('Processing_Fee')
                        ->where(DB::raw('CAST(Processing_Fee AS FLOAT)'), '>', 0);
                    break;
            }
        }

        // Apply payment status filter if provided
        if ($request && $request->filled('payment_status') && $request->payment_status !== 'all') {
            $billingQuery->where('Payment_Status', $request->payment_status);
        }

        // Clone the query for different purposes
        $primaryQuery = clone $billingQuery;
        $unitQuery = clone $billingQuery;
        $summaryQuery = clone $billingQuery;

        // Query 1: Primary Application Payments (with mother_applications join)
        $primaryPayments = $primaryQuery
            ->leftJoin('mother_applications', 'billing.application_id', '=', 'mother_applications.id')
            ->whereNotNull('billing.application_id')
            ->whereNull('billing.sub_application_id')
            ->select(
                'billing.*',
                'mother_applications.first_name',
                'mother_applications.surname',
                'mother_applications.corporate_name'
            )
            ->get();

        // Query 2: Unit Application Payments (with subapplications join)
        $unitPayments = $unitQuery
            ->leftJoin('subapplications', 'billing.sub_application_id', '=', 'subapplications.id')
            ->whereNotNull('billing.sub_application_id')
            ->select(
                'billing.*',
                'subapplications.first_name',
                'subapplications.surname',
                'subapplications.corporate_name'
            )
            ->get();

        // Format owner names
        foreach ($primaryPayments as $payment) {
            $payment->owner_name = !empty($payment->corporate_name)
                ? $payment->corporate_name
                : trim($payment->first_name . ' ' . $payment->surname);
        }

        foreach ($unitPayments as $payment) {
            $payment->owner_name = !empty($payment->corporate_name)
                ? $payment->corporate_name
                : trim($payment->first_name . ' ' . $payment->surname);
        }

        // Combined payments for the main summary section
        $payments = collect($primaryPayments)->merge($unitPayments);

        // Calculate general payment statistics
        $totalPayments = $payments->count();
        $pendingPayments = $payments->where('Payment_Status', 'Incomplete')->count();
        $paidPayments = $payments->where('Payment_Status', 'Complete')->count();

        // Calculate sums for each payment type with NULL handling
        $schemeApplicationFeeSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Scheme_Application_Fee AS FLOAT), 0)'));
        $sitePlanFeeSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Site_Plan_Fee AS FLOAT), 0)'));
        $processingFeeSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Processing_Fee AS FLOAT), 0)'));
        $bettermentChargesSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Betterment_Charges AS FLOAT), 0)'));
        $unitApplicationFeesSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Unit_Application_Fees AS FLOAT), 0)'));
        $landUseChargeSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Land_Use_Charge AS FLOAT), 0)'));
        $penaltyFeesSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Penalty_Fees AS FLOAT), 0)'));

        // Add total sum of all payment fields regardless of status with NULL handling
        $totalPaymentSum = $summaryQuery
            ->sum(DB::raw('ISNULL(CAST(Scheme_Application_Fee AS FLOAT), 0) + 
                         ISNULL(CAST(Site_Plan_Fee AS FLOAT), 0) + 
                         ISNULL(CAST(Processing_Fee AS FLOAT), 0) + 
                         ISNULL(CAST(Betterment_Charges AS FLOAT), 0) + 
                         ISNULL(CAST(Unit_Application_Fees AS FLOAT), 0) + 
                         ISNULL(CAST(Land_Use_Charge AS FLOAT), 0) + 
                         ISNULL(CAST(Penalty_Fees AS FLOAT), 0)'));

        // Primary vs Unit statistics for charts
        $primaryTotalSum = collect($primaryPayments)->sum(function ($payment) {
            return
                floatval($payment->Scheme_Application_Fee ?? 0) +
                floatval($payment->Site_Plan_Fee ?? 0) +
                floatval($payment->Processing_Fee ?? 0) +
                floatval($payment->Betterment_Charges ?? 0) +
                floatval($payment->Unit_Application_Fees ?? 0) +
                floatval($payment->Land_Use_Charge ?? 0) +
                floatval($payment->Penalty_Fees ?? 0);
        });

        $unitTotalSum = collect($unitPayments)->sum(function ($payment) {
            return
                floatval($payment->Scheme_Application_Fee ?? 0) +
                floatval($payment->Site_Plan_Fee ?? 0) +
                floatval($payment->Processing_Fee ?? 0) +
                floatval($payment->Betterment_Charges ?? 0) +
                floatval($payment->Unit_Application_Fees ?? 0) +
                floatval($payment->Land_Use_Charge ?? 0) +
                floatval($payment->Penalty_Fees ?? 0);
        });

        // Payment trends by month (for line chart)
        $paymentsByMonth = $payments->groupBy(function ($payment) {
            if (is_object($payment) && isset($payment->created_at) && $payment->created_at) {
                return \Carbon\Carbon::parse($payment->created_at)->format('Y-m');
            }
            return 'Unknown';
        })->map(function ($group) {
            return $group->count();
        });

        return [
            'payments' => $payments,
            'primaryPayments' => $primaryPayments,
            'unitPayments' => $unitPayments,
            'totalPayments' => $totalPayments,
            'pendingPayments' => $pendingPayments,
            'paidPayments' => $paidPayments,
            'totalPaymentSum' => $totalPaymentSum,
            'schemeApplicationFeeSum' => $schemeApplicationFeeSum,
            'sitePlanFeeSum' => $sitePlanFeeSum,
            'processingFeeSum' => $processingFeeSum,
            'bettermentChargesSum' => $bettermentChargesSum,
            'unitApplicationFeesSum' => $unitApplicationFeesSum,
            'landUseChargeSum' => $landUseChargeSum,
            'penaltyFeesSum' => $penaltyFeesSum,
            'primaryTotalSum' => $primaryTotalSum,
            'unitTotalSum' => $unitTotalSum,
            'paymentsByMonth' => $paymentsByMonth
        ];
    }

    public function Others()
    {
        $PageTitle = 'OTHER DEPARTMENT APPROVALS';
        $PageDescription = '';

        // Fetch surveys with mother application owner information
        $surveys = DB::connection('sqlsrv')->table('surveyCadastralRecord')
            ->join('mother_applications', 'surveyCadastralRecord.application_id', '=', 'mother_applications.id')
            ->whereNull('surveyCadastralRecord.sub_application_id')
            ->select(
                'surveyCadastralRecord.fileno',
                'surveyCadastralRecord.application_id',
                'surveyCadastralRecord.survey_by',
                'surveyCadastralRecord.survey_by_date',
                'surveyCadastralRecord.drawn_by',
                'surveyCadastralRecord.drawn_by_date',
                'surveyCadastralRecord.checked_by',
                'surveyCadastralRecord.checked_by_date',
                'surveyCadastralRecord.approved_by',
                'surveyCadastralRecord.approved_by_date',
                'mother_applications.applicant_title',
                'mother_applications.first_name',
                'mother_applications.surname',
                'mother_applications.corporate_name',
                'mother_applications.multiple_owners_names'
            )->get();

        // Fetch unit surveys with subapplication owner information
        $Unitsurveys = DB::connection('sqlsrv')->table('surveyCadastralRecord')
            ->join('subapplications', 'surveyCadastralRecord.sub_application_id', '=', 'subapplications.id')
            ->whereNotNull('surveyCadastralRecord.sub_application_id')
            ->select(
                'surveyCadastralRecord.fileno',
                'surveyCadastralRecord.application_id',
                'surveyCadastralRecord.sub_application_id',
                'surveyCadastralRecord.survey_by',
                'surveyCadastralRecord.survey_by_date',
                'surveyCadastralRecord.drawn_by',
                'surveyCadastralRecord.drawn_by_date',
                'surveyCadastralRecord.checked_by',
                'surveyCadastralRecord.checked_by_date',
                'surveyCadastralRecord.approved_by',
                'surveyCadastralRecord.approved_by_date',
                'subapplications.applicant_title',
                'subapplications.first_name',
                'subapplications.surname',
                'subapplications.corporate_name',
                'subapplications.multiple_owners_names'
            )->get();

        // Process owner names for main applications
        foreach ($surveys as $survey) {
            if (!empty($survey->multiple_owners_names)) {
                $ownerArray = json_decode($survey->multiple_owners_names, true);
                $survey->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($survey->corporate_name)) {
                $survey->owner_name = $survey->corporate_name;
            } else {
                $survey->owner_name = trim($survey->applicant_title . ' ' . $survey->first_name . ' ' . $survey->surname);
            }
        }

        // Process owner names for unit applications
        foreach ($Unitsurveys as $survey) {
            if (!empty($survey->multiple_owners_names)) {
                $ownerArray = json_decode($survey->multiple_owners_names, true);
                $survey->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($survey->corporate_name)) {
                $survey->owner_name = $survey->corporate_name;
            } else {
                $survey->owner_name = trim($survey->applicant_title . ' ' . $survey->first_name . ' ' . $survey->surname);
            }
        }

        return view('programmes.approvals.other_departments', compact('surveys', 'Unitsurveys', 'PageTitle', 'PageDescription'));
    }


    public function Deeds()
    {
        $PageTitle = 'DEEDS';
        $PageDescription = '';
        $deeds = DB::connection('sqlsrv')->table('landAdministration')
            ->join('mother_applications', 'landAdministration.application_id', '=', 'mother_applications.id')
            ->select(
                'landAdministration.*',
                'mother_applications.applicant_title',
                'mother_applications.first_name',
                'mother_applications.surname',
                'mother_applications.corporate_name',
                'mother_applications.multiple_owners_names'
            )
            ->get();

        // Process owner names for deeds
        foreach ($deeds as $deed) {
            if (!empty($deed->multiple_owners_names)) {
                $ownerArray = json_decode($deed->multiple_owners_names, true);
                $deed->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($deed->corporate_name)) {
                $deed->owner_name = $deed->corporate_name;
            } else {
                $deed->owner_name = trim($deed->applicant_title . ' ' . $deed->first_name . ' ' . $deed->surname);
            }
        }

        // Fetch deeds with subapplication owner information
        $unitDeeds = DB::connection('sqlsrv')->table('landAdministration')
            ->join('subapplications', 'landAdministration.sub_application_id', '=', 'subapplications.id')
            ->select(
                'landAdministration.*',
                'subapplications.applicant_title',
                'subapplications.first_name',
                'subapplications.surname',
                'subapplications.corporate_name',
                'subapplications.multiple_owners_names'
            )
            ->get();
        foreach ($unitDeeds as $deed) {
            if (!empty($deed->multiple_owners_names)) {
                $ownerArray = json_decode($deed->multiple_owners_names, true);
                $deed->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($deed->corporate_name)) {
                $deed->owner_name = $deed->corporate_name;
            } else {
                $deed->owner_name = trim($deed->applicant_title . ' ' . $deed->first_name . ' ' . $deed->surname);
            }
        }



        return view('programmes.approvals.deeds', compact('deeds', 'unitDeeds', 'PageTitle', 'PageDescription'));
    }


    public function Lands()
    {
        $PageTitle = 'LANDS';
        $PageDescription = '';

        // Fetch lands data from the database


        return view('programmes.approvals.lands', compact('PageTitle', 'PageDescription'));
    }

    public function PlanningRecomm()
    {
        $PageTitle = 'Planning Recommendation';
        $PageDescription = '';

        // Get mother applications
        $applications = DB::connection('sqlsrv')->table('mother_applications')->get();

        // Process owner names for primary applications
        foreach ($applications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        // Get unit applications
        $unitApplications = DB::connection('sqlsrv')->table('subapplications')->get();

        // Process owner names for unit applications
        foreach ($unitApplications as $unitApplication) {
            if (!empty($unitApplication->multiple_owners_names)) {
                $ownerArray = json_decode($unitApplication->multiple_owners_names, true);
                $unitApplication->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($unitApplication->corporate_name)) {
                $unitApplication->owner_name = $unitApplication->corporate_name;
            } else {
                $unitApplication->owner_name = trim($unitApplication->applicant_title . ' ' . $unitApplication->first_name . ' ' . $unitApplication->surname);
            }
        }

        // Calculate statistics for primary applications
        $totalPrimaryApplications = count($applications);
        $approvedPrimaryApplications = collect($applications)->where('planning_recommendation_status', 'Approved')->count();
        $rejectedPrimaryApplications = collect($applications)->where('planning_recommendation_status', 'rejected')->count();
        $pendingPrimaryApplications = $totalPrimaryApplications - $approvedPrimaryApplications - $rejectedPrimaryApplications;

        // Calculate statistics for unit applications
        $totalUnitApplications = count($unitApplications);
        $approvedUnitApplications = collect($unitApplications)->where('planning_recommendation_status', 'Approved')->count();
        $rejectedUnitApplications = collect($unitApplications)->where('planning_recommendation_status', 'rejected')->count();
        $pendingUnitApplications = $totalUnitApplications - $approvedUnitApplications - $rejectedUnitApplications;

        return view('programmes.approvals.planning_recomm', compact(
            'applications',
            'unitApplications',
            'PageTitle',
            'PageDescription',
            'totalPrimaryApplications',
            'approvedPrimaryApplications',
            'rejectedPrimaryApplications',
            'pendingPrimaryApplications',
            'totalUnitApplications',
            'approvedUnitApplications',
            'rejectedUnitApplications',
            'pendingUnitApplications'
        ));
    }

    public function Director_approval()
    {
        $PageTitle = 'Director\'s Approval';
        $PageDescription = '';

        // Get mother applications
        $applications = DB::connection('sqlsrv')->table('mother_applications')->get();

        // Process owner names for primary applications
        foreach ($applications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        // Get unit applications
        $unitApplications = DB::connection('sqlsrv')->table('subapplications')->get();

        // Process owner names for unit applications
        foreach ($unitApplications as $unitApplication) {
            if (!empty($unitApplication->multiple_owners_names)) {
                $ownerArray = json_decode($unitApplication->multiple_owners_names, true);
                $unitApplication->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($unitApplication->corporate_name)) {
                $unitApplication->owner_name = $unitApplication->corporate_name;
            } else {
                $unitApplication->owner_name = trim($unitApplication->applicant_title . ' ' . $unitApplication->first_name . ' ' . $unitApplication->surname);
            }
        }

        // Calculate statistics for primary applications
        $totalPrimaryApplications = count($applications);
        $approvedPrimaryApplications = collect($applications)->where('application_status', 'Approved')->count();
        $rejectedPrimaryApplications = collect($applications)->where('application_status', 'rejected')->count();
        $pendingPrimaryApplications = $totalPrimaryApplications - $approvedPrimaryApplications - $rejectedPrimaryApplications;

        // Calculate statistics for unit applications
        $totalUnitApplications = count($unitApplications);
        $approvedUnitApplications = collect($unitApplications)->where('application_status', 'Approved')->count();
        $rejectedUnitApplications = collect($unitApplications)->where('application_status', 'rejected')->count();
        $pendingUnitApplications = $totalUnitApplications - $approvedUnitApplications - $rejectedUnitApplications;

        return view('programmes.approvals.director', compact(
            'applications',
            'unitApplications',
            'PageTitle',
            'PageDescription',
            'totalPrimaryApplications',
            'approvedPrimaryApplications',
            'rejectedPrimaryApplications',
            'pendingPrimaryApplications',
            'totalUnitApplications',
            'approvedUnitApplications',
            'rejectedUnitApplications',
            'pendingUnitApplications'
        ));
    }

    public function ST_Report()
    {
        $PageTitle = 'Sectional Titling Report';
        $PageDescription = '';

        // Fetch primary applications with related billing data
        $primaryApplications = DB::connection('sqlsrv')->table('mother_applications')
            ->leftJoin('billing', function ($join) {
                $join->on('mother_applications.id', '=', 'billing.application_id')
                    ->whereNull('billing.sub_application_id');
            })
            ->select(
                'mother_applications.id',
                'mother_applications.fileno',
                'mother_applications.applicant_type',
                'mother_applications.applicant_title',
                'mother_applications.first_name',
                'mother_applications.surname',
                'mother_applications.corporate_name',
                'mother_applications.rc_number',
                'mother_applications.multiple_owners_names',
                'mother_applications.property_lga',
                'mother_applications.NoOfUnits',
                'mother_applications.NoOfSections',
                'mother_applications.NoOfBlocks',
                'mother_applications.land_use',
                'mother_applications.residential_type',
                'mother_applications.commercial_type',
                'mother_applications.industrial_type',
                'mother_applications.mixed_type',
                'mother_applications.ownership_type',
                'mother_applications.application_status',
                'mother_applications.approval_date',
                'mother_applications.planning_recommendation_status',
                'mother_applications.planning_approval_date',
                'mother_applications.created_at',
                'mother_applications.updated_at',
                'billing.Payment_Status'
            )
            ->get();

        // Process owner names
        foreach ($primaryApplications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        // Calculate statistics
        $totalApplications = count($primaryApplications);
        $approvedApplications = collect($primaryApplications)->where('application_status', 'Approved')->count();
        $pendingApplications = collect($primaryApplications)->where('application_status', '!=', 'Approved')
            ->where('application_status', '!=', 'rejected')
            ->count();
        $rejectedApplications = collect($primaryApplications)->where('application_status', 'rejected')->count();

        // Planning recommendation stats
        $approvedPlanningRecommendations = collect($primaryApplications)->where('planning_recommendation_status', 'Approved')->count();
        $pendingPlanningRecommendations = collect($primaryApplications)->where('planning_recommendation_status', '!=', 'Approved')
            ->where('planning_recommendation_status', '!=', 'rejected')
            ->count();
        $rejectedPlanningRecommendations = collect($primaryApplications)->where('planning_recommendation_status', 'rejected')->count();

        // Group applications by LGA for geo chart
        $applicationsByLGA = collect($primaryApplications)
            ->groupBy('property_lga')
            ->map(function ($group) {
                return $group->count();
            });

        // Get monthly application trend data (last 12 months)
        $monthlyTrend = collect($primaryApplications)
            ->filter(function ($app) {
                return !empty($app->created_at);
            })
            ->groupBy(function ($app) {
                return \Carbon\Carbon::parse($app->created_at)->format('Y-m');
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys();

        // Prepare month labels for chart
        $monthLabels = [];
        $applicationCountByMonth = [];
        foreach ($monthlyTrend as $month => $count) {
            $monthLabels[] = $month;
            $applicationCountByMonth[] = $count;
        }

        // Fetch unit applications with related billing data and mother application context
        $unitApplications = DB::connection('sqlsrv')->table('subapplications')
            ->leftJoin('mother_applications', 'subapplications.main_application_id', '=', 'mother_applications.id')
            ->leftJoin('billing', function ($join) {
                $join->on('subapplications.id', '=', 'billing.sub_application_id');
            })
            ->select(
                'subapplications.id',
                'subapplications.main_application_id',
                'subapplications.fileno',
                'subapplications.applicant_type',
                'subapplications.applicant_title',
                'subapplications.first_name',
                'subapplications.surname',
                'subapplications.corporate_name',
                'subapplications.rc_number',
                'subapplications.multiple_owners_names',
                'subapplications.block_number',
                'subapplications.floor_number',
                'subapplications.unit_number',
                'subapplications.property_location',
                'subapplications.ownership',

                'subapplications.plot_size',
                'subapplications.commercial_type',
                'subapplications.industrial_type',
                'subapplications.ownership_type',
                'subapplications.residence_type',
                'subapplications.application_status',
                'subapplications.approval_date',
                'subapplications.planning_recommendation_status',
                'subapplications.planning_approval_date',
                'subapplications.created_at',
                'subapplications.updated_at',
                'mother_applications.land_use',
                'mother_applications.property_lga',
                'billing.Payment_Status'
            )
            ->get();

        // Process owner names for unit applications
        foreach ($unitApplications as $application) {
            if (!empty($application->multiple_owners_names)) {
                $ownerArray = json_decode($application->multiple_owners_names, true);
                $application->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } elseif (!empty($application->corporate_name)) {
                $application->owner_name = $application->corporate_name;
            } else {
                $application->owner_name = trim($application->applicant_title . ' ' . $application->first_name . ' ' . $application->surname);
            }
        }

        // Calculate unit application statistics
        $totalUnitApplications = count($unitApplications);
        $approvedUnitApplications = collect($unitApplications)->where('application_status', 'Approved')->count();
        $pendingUnitApplications = collect($unitApplications)->where('application_status', '!=', 'Approved')
            ->where('application_status', '!=', 'rejected')
            ->count();
        $rejectedUnitApplications = collect($unitApplications)->where('application_status', 'rejected')->count();

        // Planning recommendation stats for unit applications
        $approvedUnitPlanningRecommendations = collect($unitApplications)->where('planning_recommendation_status', 'Approved')->count();
        $pendingUnitPlanningRecommendations = collect($unitApplications)->where('planning_recommendation_status', '!=', 'Approved')
            ->where('planning_recommendation_status', '!=', 'rejected')
            ->count();
        $rejectedUnitPlanningRecommendations = collect($unitApplications)->where('planning_recommendation_status', 'rejected')->count();

        // Group unit applications by LGA for geo chart
        $unitApplicationsByLGA = collect($unitApplications)
            ->groupBy('property_lga')
            ->map(function ($group) {
                return $group->count();
            });

        // Get monthly unit application trend data
        $unitMonthlyTrend = collect($unitApplications)
            ->filter(function ($app) {
                return !empty($app->created_at);
            })
            ->groupBy(function ($app) {
                return \Carbon\Carbon::parse($app->created_at)->format('Y-m');
            })
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys();

        // Prepare month labels for unit application chart
        $unitMonthLabels = [];
        $unitApplicationCountByMonth = [];
        foreach ($unitMonthlyTrend as $month => $count) {
            $unitMonthLabels[] = $month;
            $unitApplicationCountByMonth[] = $count;
        }



        return view('programmes.report', compact(
            'PageTitle',
            'PageDescription',
            'primaryApplications',
            'totalApplications',
            'approvedApplications',
            'pendingApplications',
            'rejectedApplications',
            'approvedPlanningRecommendations',
            'pendingPlanningRecommendations',
            'rejectedPlanningRecommendations',
            'applicationsByLGA',
            'monthLabels',
            'applicationCountByMonth',
            // Unit application data
            'unitApplications',
            'totalUnitApplications',
            'approvedUnitApplications',
            'pendingUnitApplications',
            'rejectedUnitApplications',
            'approvedUnitPlanningRecommendations',
            'pendingUnitPlanningRecommendations',
            'rejectedUnitPlanningRecommendations',
            'unitApplicationsByLGA',
            'unitMonthLabels',
            'unitApplicationCountByMonth'
        ));
    }


  

    public function Entity($applicationId = null)
    {
        $PageTitle = 'Entities';
        $PageDescription = 'Application Entities by Type';

        // Fetch primary applications grouped by applicant type
        $individualApplications = DB::connection('sqlsrv')->table('mother_applications')
            ->where('applicant_type', 'individual')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'NoOfUnits',
                'receipt_date',
                'planning_recommendation_status',
                'application_status',
                'property_street_name',
                'property_lga',
                'created_at'
            )
            ->get();

        $corporateApplications = DB::connection('sqlsrv')->table('mother_applications')
            ->where('applicant_type', 'corporate')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'NoOfUnits',
                'receipt_date',
                'planning_recommendation_status',
                'application_status',
                'property_street_name',
                'property_lga',
                'created_at'
            )
            ->get();

        $multipleApplications = DB::connection('sqlsrv')->table('mother_applications')
            ->where('applicant_type', 'multiple')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'NoOfUnits',
                'receipt_date',
                'planning_recommendation_status',
                'application_status',
                'property_street_name',
                'property_lga',
                'created_at'
            )
            ->get();

        // Fetch unit applications grouped by applicant type
        $unitIndividualApplications = DB::connection('sqlsrv')->table('subapplications')
            ->where('applicant_type', 'individual')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'property_location',
                'created_at',
                'planning_recommendation_status',
                'application_status'
            )
            ->get();

        $unitCorporateApplications = DB::connection('sqlsrv')->table('subapplications')
            ->where('applicant_type', 'corporate')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'property_location',
                'created_at',
                'planning_recommendation_status',
                'application_status'
            )
            ->get();

        $unitMultipleApplications = DB::connection('sqlsrv')->table('subapplications')
            ->where('applicant_type', 'multiple')
            ->select(
                'id',
                'fileno',
                'applicant_type',
                'first_name',
                'surname',
                'corporate_name',
                'multiple_owners_names',
                'land_use',
                'property_location',
                'created_at',
                'planning_recommendation_status',
                'application_status'
            )
            ->get();

        // Process owner names for primary applications
        foreach ($individualApplications as $app) {
            $app->owner_name = trim($app->first_name . ' ' . $app->surname);
        }

        foreach ($corporateApplications as $app) {
            $app->owner_name = $app->corporate_name;
        }

        foreach ($multipleApplications as $app) {
            if (!empty($app->multiple_owners_names)) {
                $ownerArray = json_decode($app->multiple_owners_names, true);
                $app->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } else {
                $app->owner_name = 'Multiple Owners';
            }
        }

        // Process owner names for unit applications
        foreach ($unitIndividualApplications as $app) {
            $app->owner_name = trim($app->first_name . ' ' . $app->surname);
        }

        foreach ($unitCorporateApplications as $app) {
            $app->owner_name = $app->corporate_name;
        }

        foreach ($unitMultipleApplications as $app) {
            if (!empty($app->multiple_owners_names)) {
                $ownerArray = json_decode($app->multiple_owners_names, true);
                $app->owner_name = $ownerArray ? implode(', ', $ownerArray) : null;
            } else {
                $app->owner_name = 'Multiple Owners';
            }
        }

        // Prepare statistics
        $primaryStats = [
            'individual' => count($individualApplications),
            'corporate' => count($corporateApplications),
            'multiple' => count($multipleApplications),
            'total' => count($individualApplications) + count($corporateApplications) + count($multipleApplications)
        ];

        $unitStats = [
            'individual' => count($unitIndividualApplications),
            'corporate' => count($unitCorporateApplications),
            'multiple' => count($unitMultipleApplications),
            'total' => count($unitIndividualApplications) + count($unitCorporateApplications) + count($unitMultipleApplications)
        ];

        return view('programmes.entity.index', compact(
            'PageTitle',
            'PageDescription',
            'individualApplications',
            'corporateApplications',
            'multipleApplications',
            'unitIndividualApplications',
            'unitCorporateApplications',
            'unitMultipleApplications',
            'primaryStats',
            'unitStats'
        ));
    }

  
  
 
  
    
   
   
 
 

 
 

     
 

}