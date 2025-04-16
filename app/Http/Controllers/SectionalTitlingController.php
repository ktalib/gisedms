<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class  SectionalTitlingController extends Controller
{

 

    

    public function index()
    {
        $PageTitle = 'Sectional Titling Module (STM)';
        $PageDescription = 'Process CofO for individually owned sections of multi-unit developments.';
        $Primary = DB::connection('sqlsrv')->table('dbo.mother_applications')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        
        $Secondary = DB::connection('sqlsrv')->table('dbo.subapplications')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();


        return view('sectionaltitling.index', compact(
            'Primary', 
            'Secondary',
            'PageTitle',
            'PageDescription'
        ));
    }

  public function Primary(Request $request)

    {
        $PageTitle = 'Sectional Titling Module (STM)';
        $PageDescription = 'Process CofO for individually owned sections of multi-unit developments.';
        $PrimaryApplications = DB::connection('sqlsrv')->table('dbo.mother_applications')->get();
         

        return view('sectionaltitling.primary', compact('PrimaryApplications', 'PageTitle', 'PageDescription'));
    }

  public function Secondary(Request $request)
    {
        $PageTitle = 'Sectional Titling Module (STM)';
        $PageDescription = 'Process CofO for individually owned sections of multi-unit developments.';

        $SecondaryApplications = DB::connection('sqlsrv')->table('dbo.subapplications')
            ->leftJoin('dbo.mother_applications', 'dbo.subapplications.main_application_id', '=', 'dbo.mother_applications.id')
            ->select(
            'dbo.subapplications.fileno',
            'dbo.subapplications.main_application_id',
            'dbo.subapplications.applicant_title',
            'dbo.subapplications.first_name',
            'dbo.subapplications.surname',
            'dbo.subapplications.corporate_name',
            'dbo.subapplications.multiple_owners_names',
            'dbo.subapplications.phone_number',
            'dbo.subapplications.planning_recommendation_status',
            'dbo.subapplications.application_status',
            'dbo.subapplications.created_at',
            'dbo.subapplications.unit_number',
            'dbo.mother_applications.fileno as mother_fileno',
            'dbo.mother_applications.applicant_title as mother_applicant_title',
            'dbo.mother_applications.first_name as mother_first_name',
            'dbo.mother_applications.surname as mother_surname',
            'dbo.mother_applications.corporate_name as mother_corporate_name',
            'dbo.mother_applications.multiple_owners_names as mother_multiple_owners_names',
            'dbo.mother_applications.land_use'
            )
            ->get();
         

        return view('sectionaltitling.secondary', compact('SecondaryApplications', 'PageTitle', 'PageDescription')); 
    }

  
}