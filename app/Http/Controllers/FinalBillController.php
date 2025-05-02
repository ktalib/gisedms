<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;
use Carbon\Carbon;

class FinalBillController extends Controller
{
    /**
     * Generate a new final bill or display existing bill
     */
    public function generateBill($applicationId)
    {
        // Get application data
        $application = DB::connection('sqlsrv')
                         ->table('mother_applications')
                         ->where('id', $applicationId)
                         ->first();
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        // Get existing bill if any
        $existingBill = DB::connection('sqlsrv')
                           ->table('final_bills')
                           ->where('application_id', $applicationId)
                           ->first();
        
        // Default fee values based on land use type
        $fees = $this->getDefaultFees($application->land_use);
        
        // If bill exists, use stored values
        if ($existingBill) {
            $fees = [
                'processing_fee' => $existingBill->processing_fee,
                'survey_fee' => $existingBill->survey_fee,
                'assignment_fee' => $existingBill->assignment_fee,
                'bill_balance' => $existingBill->bill_balance,
                'ground_rent' => $existingBill->ground_rent,
                'dev_charges' => $existingBill->dev_charges,
                'total_amount' => $existingBill->total_amount
            ];
        }
        
        // Convert total to words
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $totalInWords = ucfirst($formatter->format($fees['total_amount'])) . ' Naira Only';
        
        // Fix: Changed view name from 'actions.bill' to 'actions.final_bill'
        return view('actions.final_bill', [
            'application' => $application,
            'bill' => $existingBill,
            'fees' => $fees,
            'total_in_words' => $totalInWords,
            'current_date' => Carbon::now()->format('l, F d, Y')
        ]);
    }
    
    /**
     * Save final bill data
     */
    public function saveBill(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'application_id' => 'required|integer',
                'processing_fee' => 'required|numeric',
                'survey_fee' => 'required|numeric',
                'assignment_fee' => 'required|numeric',
                'bill_balance' => 'required|numeric',
                'ground_rent' => 'required|numeric',
                'dev_charges' => 'required|numeric', // Added development charges
                'bill_date' => 'required|date',
                'bill_status' => 'nullable|string|in:generated,sent,paid,cancelled'
            ]);
            
            // Calculate total amount
            $validatedData['total_amount'] = 
                $validatedData['processing_fee'] + 
                $validatedData['survey_fee'] + 
                $validatedData['assignment_fee'] + 
                $validatedData['bill_balance'] + 
                $validatedData['ground_rent'] +
                $validatedData['dev_charges']; // Added to total
            
            // Set default status if not provided
            if (!isset($validatedData['bill_status'])) {
                $validatedData['bill_status'] = 'generated';
            }
            
            // Check if bill already exists
            $existingBill = DB::connection('sqlsrv')
                              ->table('final_bills')
                              ->where('application_id', $validatedData['application_id'])
                              ->first();
            
            if ($existingBill) {
                // Update existing bill
                DB::connection('sqlsrv')
                    ->table('final_bills')
                    ->where('application_id', $validatedData['application_id'])
                    ->update([
                        'processing_fee' => $validatedData['processing_fee'],
                        'survey_fee' => $validatedData['survey_fee'],
                        'assignment_fee' => $validatedData['assignment_fee'],
                        'bill_balance' => $validatedData['bill_balance'],
                        'ground_rent' => $validatedData['ground_rent'],
                        'dev_charges' => $validatedData['dev_charges'], // Added
                        'total_amount' => $validatedData['total_amount'],
                        'bill_date' => $validatedData['bill_date'],
                        'bill_status' => $validatedData['bill_status'],
                        'updated_at' => now()
                    ]);
                
                $message = 'Bill updated successfully';
            } else {
                // Create new bill
                DB::connection('sqlsrv')
                    ->table('final_bills')
                    ->insert([
                        'application_id' => $validatedData['application_id'],
                        'processing_fee' => $validatedData['processing_fee'],
                        'survey_fee' => $validatedData['survey_fee'],
                        'assignment_fee' => $validatedData['assignment_fee'],
                        'bill_balance' => $validatedData['bill_balance'],
                        'ground_rent' => $validatedData['ground_rent'],
                        'dev_charges' => $validatedData['dev_charges'], // Added
                        'total_amount' => $validatedData['total_amount'],
                        'bill_date' => $validatedData['bill_date'],
                        'bill_status' => $validatedData['bill_status'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                
                $message = 'Bill generated successfully';
            }
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 422);
        }
    }
    
    /**
     * Get the default fees based on land use type
     */
    private function getDefaultFees($landUse)
    {
        $landUse = strtolower($landUse ?: 'residential');
        
        // Default fee structure
        if ($landUse == 'residential') {
            $processingFee = 20000;
            $surveyFee = 50000;
            $assignmentFee = 50000;
            $billBalance = 30525;
            $groundRent = 5000;
            $devCharges = 0; // Development charges typically calculated separately
        } else if ($landUse == 'commercial') {
            $processingFee = 40000;
            $surveyFee = 70000;
            $assignmentFee = 100000;
            $billBalance = 50000;
            $groundRent = 10000;
            $devCharges = 0; // Development charges typically calculated separately
        } else {
            // Default/Industrial/Others
            $processingFee = 30000;
            $surveyFee = 60000;
            $assignmentFee = 75000;
            $billBalance = 40000;
            $groundRent = 8000;
            $devCharges = 0; // Development charges typically calculated separately
        }
        
        $totalAmount = $processingFee + $surveyFee + $assignmentFee + $billBalance + $groundRent + $devCharges;
        
        return [
            'processing_fee' => $processingFee,
            'survey_fee' => $surveyFee,
            'assignment_fee' => $assignmentFee,
            'bill_balance' => $billBalance,
            'ground_rent' => $groundRent,
            'dev_charges' => $devCharges,
            'total_amount' => $totalAmount
        ];
    }
    
    /**
     * Print a final bill
     */
    public function printBill($applicationId)
    {
        $application = DB::connection('sqlsrv')
                         ->table('mother_applications')
                         ->where('id', $applicationId)
                         ->first();
        
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }
        
        $bill = DB::connection('sqlsrv')
                  ->table('final_bills')
                  ->where('application_id', $applicationId)
                  ->first();
        
        if (!$bill) {
            $fees = $this->getDefaultFees($application->land_use);
            
            $bill = (object)[
                'processing_fee' => $fees['processing_fee'],
                'survey_fee' => $fees['survey_fee'],
                'assignment_fee' => $fees['assignment_fee'],
                'bill_balance' => $fees['bill_balance'],
                'ground_rent' => $fees['ground_rent'],
                'dev_charges' => $fees['dev_charges'],
                'total_amount' => $fees['total_amount'],
                'bill_date' => Carbon::now()->format('Y-m-d'),
                'bill_status' => 'generated'
            ];
        }
        
        // Convert total to words
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $totalInWords = ucfirst($formatter->format($bill->total_amount)) . ' Naira Only';
        
        return view('actions.print_final_bill', [
            'application' => $application,
            'bill' => $bill,
            'total_in_words' => $totalInWords,
            'current_date' => Carbon::now()->format('l, F d, Y')
        ]);
    }
}
