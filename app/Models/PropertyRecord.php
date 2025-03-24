<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRecord extends Model
{
    use HasFactory;

    protected $table = 'gis_datacapture';

    protected $fillable = [
        'planid',
        'mlsfNo',
        'kangisFileNo',
        'plotNo',
        'blockNo',
        'approvedPlanNo',
        'tpPlanNo',
        'surveyedBy',
        'drawnBy',
        'checkedBy',
        'passedBy',
        'plotYearCreated',
        'beaconControlName',
        'beaconControlX',
        'beaconControlY',
        'metricSheetIndex',
        'metricSheetNo',
        'imperialSheet',
        'imperialSheetNo',
        'layoutName',
        'districtName',
        'lgaName',
        'streetName',
        'houseNo',
        'tenancy',
        'areaInHectares',
        'titleStatus',
        'picture',
        'oldTitleSerialNo',
        'oldTitlePageNo',
        'oldTitleVolumeNo',
        'deedsDate',
        'deedsTime',
        'certificateDate',
        'originalAllottee',
        'addressOfOriginalAllottee',
        'titleIssuedYear',
        'currentAllottee',
        'addressOfCurrentAllottee',
        'titleOfCurrentAllottee',
        'currentYearTitleOwned',
        'phoneNo',
        'emailAddress',
        'occupation',
        'nationality',
        'parcelNewlyDigitized',
        'digitizationSource',
        'workTime',
        'electronicSupervisor',
        'directorGeneral',
        'evidenceOfPayment',
        'title',
        'transactionDocument',
        'passportPhoto',
        'nationalId',
        'internationalPassport',
        'businessRegCert',
        'formCO7AndCO4',
        'certOfIncorporation',
        'memorandumAndArticle',
        'letterOfAdmin',
        'courtAffidavit',
        'policeReport',
        'newspaperAdvert',
        'acknowledgementStatus',
        'acknowledgementIssuedDate',
        'acknowledgementIssuedBy',
        'bankDraftSerialNo',
        'bankName',
        'conflictExistence',
        'problemNature1',
        'problemNature2',
        'landUse',
        'specifically',
        'changeOfOwnership',
        'reasonForChange',
    ];

    // New method to switch the data source table
    public function setDataSource(string $source)
    {
        if (in_array($source, ['gis_datacapture', 'property_records'])) {
            $this->table = $source;
        }
    }
}
