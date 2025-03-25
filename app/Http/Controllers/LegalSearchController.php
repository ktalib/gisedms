<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LegalSearchController extends Controller
{
    public function index()
    {
        $Main_application = DB::connection('sqlsrv')->table('dbo.mother_applications')->get();
        return view('sectionaltitling.index', compact('Main_application'));
    }
    

   
}