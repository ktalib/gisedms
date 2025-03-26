<?php
namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{

    private function generateParticularsRegistrationNumber($lastInstrument)
    {
        if ($lastInstrument) {
            $parts = explode('/', $lastInstrument->particularsRegistrationNumber);
            if (count($parts) === 3) {
                list($lastSerial, $lastPage, $lastVolume) = $parts;
                $lastSerial = (int)$lastSerial;
                $lastPage = (int)$lastPage;
                $lastVolume = (int)$lastVolume;
    
                if ($lastSerial == 100) {
                    $newSerial = 1;
                    $newPage = 1;
                    $newVolume = $lastVolume + 1;
                } else {
                    $newSerial = $lastSerial + 1;
                    $newPage = $lastPage + 1;
                    $newVolume = $lastVolume;
                }
            } else {
                $newSerial = 1;
                $newPage = 1;
                $newVolume = 1;
            }
        } else {
            $newSerial = 1;
            $newPage = 1;
            $newVolume = 1;
        }
    
        return "$newSerial/$newPage/$newVolume";
    }
    
    private function generateRegNo($lastInstrument)
    {
        if ($lastInstrument && !empty($lastInstrument->regNo)) {
            $parts = explode('/', $lastInstrument->regNo);
            if (count($parts) === 3) {
                $number = (int)$parts[0];
                $newNumber = $number + 1;
                return "$newNumber/$newNumber/$newNumber";
            }
        }
        return "1/1/1";
    }
         
    private function tempFileNumber($lastInstrument)
    {
        if ($lastInstrument && !empty($lastInstrument->fileNumber)) {
            $lastFileNumber = (int) str_replace('KN/TEMP/', '', $lastInstrument->fileNumber);
            $num = $lastFileNumber + 1;
        } else {
            $num = 1;
        }

        return 'KN/TEMP/' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
    private function NewfileNumber($lastInstrument)
    {
        if ($lastInstrument && !empty($lastInstrument->fileNumber)) {
            $lastFileNumber = (int) str_replace('KN', '', $lastInstrument->fileNumber);
            $num = $lastFileNumber + 1;
        } else {
            $num = 1;
        }
        return 'KN' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    private function generateRootTitleRegNo($lastInstrument) 

    {
        if ($lastInstrument) {
            $lastRootTitleRegNo = (int) str_replace('0/0/', '', $lastInstrument->RootTitleRegNo);
            $newRootTitleRegNo = $lastRootTitleRegNo + 1;
        } else {
            $newRootTitleRegNo = 1;
        }

        return '0/0/' . $newRootTitleRegNo;
    }

 
    public function index()
    {
        if (Auth::user()->can('manage notification')) {
            $instruments = Instrument::paginate(100);
            $lastInstrument = Instrument::orderBy('id', 'desc')->first();
            $particularsRegistrationNumber = $this->generateParticularsRegistrationNumber($lastInstrument);
            $RootTitleRegNo = $this->generateRootTitleRegNo($lastInstrument);
            return view('instruments.index', compact('instruments','RootTitleRegNo', 'particularsRegistrationNumber'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }




    public function powerOfAttorney()
    {
        if (Auth::user()->can('manage notification')) {
            $lastInstrument = Instrument::orderBy('id', 'desc')->first();
            $particularsRegistrationNumber = $this->generateParticularsRegistrationNumber($lastInstrument);
            $lastRegNo = Instrument::orderBy('id', 'desc')->first();
            $regNo = $this->generateRegNo($lastInstrument);
            $RootTitleRegNo = $this->generateRootTitleRegNo($lastInstrument);
            $tempFileNumber = $this->tempFileNumber($lastInstrument);
            
            $title = 'Power Of Attorney';
            return view('instruments.powerOfAttorney', compact('particularsRegistrationNumber', 'title', 'regNo', 'RootTitleRegNo', 'tempFileNumber'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function deedOfMortgage()
    {
        if (Auth::user()->can('manage notification')) {
            $lastInstrument = Instrument::orderBy('id', 'desc')->first();
            $particularsRegistrationNumber = $this->generateParticularsRegistrationNumber($lastInstrument);
            $lastRegNo = Instrument::orderBy('id', 'desc')->first();
            $regNo = $this->generateRegNo($lastInstrument);
            $RootTitleRegNo = $this->generateRootTitleRegNo($lastInstrument);
            $title = 'Deed Of Mortgage';
            return view('instruments.deedOfMortgage', compact('particularsRegistrationNumber', 'title', 'regNo','RootTitleRegNo'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

   

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fileNumber' => 'nullable|unique:instruments',
                'fileSuffix' => 'nullable',
                'fileNoPrefix' => 'nullable',
                'rootTitleRegNo' => 'nullable',
                'particularsRegistrationNumber' => 'nullable',
                'instrumentName' => 'nullable',
                'regNo' => 'nullable',
                'grantorName' => 'nullable',
                'grantorAddress' => 'nullable',
                'granteeName' => 'nullable',
                'granteeAddress' => 'nullable',
                'mortgagorName' => 'nullable',
                'mortgagorAddress' => 'nullable',
                'mortgageeName' => 'nullable',
                'mortgageeAddress' => 'nullable',
                'loanAmount' => 'nullable',
                'interestRate' => 'nullable',
                'duration' => 'nullable',
                'assignorName' => 'nullable',
                'assignorAddress' => 'nullable',
                'assigneeName' => 'nullable',
                'assigneeAddress' => 'nullable',
                'lessorName' => 'nullable',
                'lessorAddress' => 'nullable',
                'lesseeName' => 'nullable',
                'lesseeAddress' => 'nullable',
                'propertyDescription' => 'nullable',
                'propertyAddress' => 'nullable',
                'originalPlotDetails' => 'nullable',
                'newSubDividedPlotDetails' => 'nullable',
                'mergedPlotInformation' => 'nullable',
                'surrenderingPartyName' => 'nullable',
                'receivingPartyName' => 'nullable',
                'propertyDetails' => 'nullable',
                'considerationAmount' => 'nullable',
                'changesVariations' => 'nullable',
                'heirBeneficiaryDetails' => 'nullable',
                'originalPropertyOwnerDetails' => 'nullable',
                'assentTerms' => 'nullable',
                'releaserName' => 'nullable',
                'releaseTerms' => 'nullable',
                'instrumentDate' => 'nullable|date',
                'solicitorName' => 'nullable',
                'solicitorAddress' => 'nullable',
                'surveyPlanNo' => 'nullable',
                'lga' => 'nullable',
                'district' => 'nullable',
                'plotNumber' => 'nullable',
                'size' => 'nullable',
                'leasePeriod' => 'nullable',
                'leaseTerms' => 'nullable'
            ]);

            $lastInstrument = Instrument::orderBy('id', 'desc')->first();

            if (empty($validatedData['fileNumber'])) {
                $validatedData['fileNumber'] = $this->NewfileNumber($lastInstrument);
            }

            if (empty($validatedData['fileNoPrefix'])) {
                $validatedData['fileNoPrefix'] = 'KN';
            }

            if (empty($validatedData['rootTitleRegNo'])) {
                $validatedData['rootTitleRegNo'] = $this->generateRootTitleRegNo($lastInstrument);
            }

            if (empty($validatedData['regNo'])) {
                $validatedData['regNo'] = $this->generateRegNo($lastInstrument);
            }

            $instrument = Instrument::create($validatedData);

            if (!$instrument) {
                return redirect()->back()->with('error', 'Failed to save instrument. Please try again.');
            }

            return redirect('/instruments')->with('success', 'Instrument registered successfully');
        } catch (\Exception $e) {
            \Log::error('Instrument creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while saving the instrument. Please try again.');
        }
    }


     public function Coroi()
    {
        if (Auth::check() && Auth::user()->can('manage notification')) {
            $lastInstrument = Instrument::orderBy('id', 'desc')->first();
            $particularsRegistrationNumber = $this->generateParticularsRegistrationNumber($lastInstrument);
            $lastRegNo = Instrument::orderBy('id', 'desc')->first();
            $regNo = $this->generateRegNo($lastInstrument);

            $title = 'Confirmation Of Instrument Registration';
            return view('instruments.Coroi', compact('particularsRegistrationNumber', 'title', 'regNo'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
 

 
 
    public function update(Request $request, $id)
    {
        $instrument = Instrument::findOrFail($id);
        $lastInstrument = Instrument::orderBy('id', 'desc')->first();
        $particularsRegistrationNumber = $this->generateParticularsRegistrationNumber($lastInstrument);
        
        $data = $request->all();
        $data['particularsRegistrationNumber'] = $particularsRegistrationNumber;
        
        $instrument->update($data);
        return redirect('/instruments')->with('success', 'Instrument updated successfully');
    }

    public function destroy($id)
    {
        Instrument::findOrFail($id)->delete();
        return redirect('/instruments')->with('success', 'Instrument deleted successfully');
    }
}
