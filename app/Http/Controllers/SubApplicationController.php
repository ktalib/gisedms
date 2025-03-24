<?php

namespace App\Http\Controllers;
use App\Models\ApplicationMother;
use App\Models\Subapplications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('sectionaltitling.create');
    }

 
 
    

    
  
    
    public function AcceptLetter(Request $request)
    {
        
        $application_id = $request->input('application_id');
        if (!$application_id) {
            abort(400, 'Application ID is required');
        }
        
        $application = ApplicationMother::findOrFail($application_id);
        return view('sectionaltitling.AcceptLetter', compact('application'));
    }

   
   

    
}