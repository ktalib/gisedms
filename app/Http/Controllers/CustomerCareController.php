<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PageTitle = 'Customer Care';
        $PageDescription = 'Customer Care Management System';
        
        // Fetch primary customer data from mother_applications table
        $customerCareData = DB::connection('sqlsrv')->table('mother_applications')
            ->select(
                'id', 'fileno', 'applicant_type', 'applicant_title', 
                'first_name', 'surname', 'corporate_name', 
                'multiple_owners_names', 'passport', 'multiple_owners_passport',
                'address', 'phone_number', 'email'
            )
            ->get();
            
        // Fetch secondary customer data from sub_applications table
        $secondaryApplicationsData =  DB::connection('sqlsrv')->table('subapplications')
            ->select(
                'id',   'fileno', 'applicant_type', 'applicant_title', 
                'first_name', 'surname', 'corporate_name', 
                'multiple_owners_names', 'passport', 'multiple_owners_passport',
                'address', 'phone_number', 'email'
            )
            ->get();

        // Return a view with both primary and secondary customer care data
        return view('customer_care.index', compact('customerCareData', 'secondaryApplicationsData', 'PageTitle', 'PageDescription'));
    }
    
    /**
     * Get customer details for modal display
     */
    public function getCustomer($id, Request $request)
    {
        $type = $request->query('type', 'primary');
        
        if ($type === 'primary') {
            $customer =  DB::connection('sqlsrv')->table('mother_applications')->find($id);
        } else {
            $customer =  DB::connection('sqlsrv')->table('subapplications')->find($id);
        }
        
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found']);
        }
        
        // Format name based on applicant type
        $name = '';
        if ($customer->applicant_type == 'individual') {
            $name = trim(($customer->applicant_title ?? '') . ' ' . ($customer->first_name ?? '') . ' ' . ($customer->surname ?? ''));
        } elseif ($customer->applicant_type == 'corporate') {
            $name = $customer->corporate_name ?? 'N/A';
        } elseif ($customer->applicant_type == 'multiple') {
            $names = json_decode($customer->multiple_owners_names, true) ?? [];
            $name = implode(', ', $names);
        }
        
        // Get image URL
        $imageUrl = null;
        if ($customer->applicant_type == 'individual' || $customer->applicant_type == 'corporate') {
            if ($customer->passport) {
                $imageUrl = asset('storage/app/public/' . $customer->passport);
            }
        } elseif ($customer->applicant_type == 'multiple') {
            $passports = json_decode($customer->multiple_owners_passport, true) ?? [];
            if (!empty($passports)) {
                $imageUrl = asset('storage/app/public/' . $passports[0]);
            }
        }
        
        return response()->json([
            'success' => true,
            'id' => $customer->id,
            'name' => $name,
            'phone_number' => $customer->phone_number ?? 'N/A',
            'image' => $imageUrl
        ]);
    }
    
    /**
     * Send SMS to individual customer
     */
    public function sendSms(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|integer',
            'message' => 'required|string'
        ]);
        
        $customer = DB::connection('sqlsrv')->table('mother_applications')->find($request->recipient_id);
        
        if (!$customer || empty($customer->phone_number)) {
            return response()->json(['success' => false, 'message' => 'Invalid recipient or phone number']);
        }
        
        // Here you would integrate with SMS API
        // Example: SmsService::send($customer->phone_number, $request->message);
        
        // For now, just return success
        return response()->json(['success' => true, 'message' => 'SMS sent successfully to ' . $customer->phone_number]);
    }
    
    /**
     * Make call to customer
     */
    public function makeCall(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|integer'
        ]);
        
        $customer = DB::connection('sqlsrv')->table('mother_applications')->find($request->recipient_id);
        
        if (!$customer || empty($customer->phone_number)) {
            return response()->json(['success' => false, 'message' => 'Invalid recipient or phone number']);
        }
        
        // Here you would integrate with telephony API
        // Example: TelephonyService::initiateCall($customer->phone_number);
        
        // For now, just return success
        return response()->json(['success' => true, 'message' => 'Call initiated successfully to ' . $customer->phone_number]);
    }
    
    /**
     * Send bulk SMS to multiple customers
     */
    public function sendBulkSms(Request $request)
    {
        $request->validate([
            'recipient_ids' => 'required|array',
            'recipient_ids.*' => 'integer',
            'message' => 'required|string'
        ]);
        
        $customers = DB::connection('sqlsrv')->table('mother_applications')
            ->whereIn('id', $request->recipient_ids)
            ->whereNotNull('phone_number')
            ->get();
            
        if ($customers->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No valid recipients found']);
        }
        
        // Here you would integrate with SMS API for bulk messages
        // Example: SmsService::sendBulk($customers->pluck('phone_number')->toArray(), $request->message);
        
        return response()->json([
            'success' => true, 
            'message' => "Bulk SMS sent successfully to {$customers->count()} recipients"
        ]);
    }
    
    /**
     * View application details
     */
    public function viewApplication($id)
    {
        $application = DB::connection('sqlsrv')->table('mother_applications')->find($id);
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        // Redirect to application details page
        return redirect()->route('mother-applications', ['id' => $application->id]);
    }
    
    /**
     * Open file/documents
     */
    public function openFile($id)
    {
        $application = DB::connection('sqlsrv')->table('mother_applications')->find($id);
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        // Redirect to file details page
        return redirect()->route('documents.view', ['fileno' => $application->fileno]);
    }
}
