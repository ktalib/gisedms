<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileNumber',
        'fileSuffix',
        'fileNoPrefix',
        'particularsRegistrationNumber',
        'regNo',
        'rootTitleRegNo',
        'instrumentName',
        'grantorName',
        'grantorAddress',
        'granteeName',
        'granteeAddress',
        'mortgagorName',
        'mortgagorAddress',
        'mortgageeName',
        'mortgageeAddress',
        'loanAmount',
        'interestRate',
        'duration',
        'assignorName',
        'assignorAddress',
        'assigneeName',
        'assigneeAddress',
        'lessorName',
        'lessorAddress',
        'lesseeName',
        'lesseeAddress',
        'propertyDescription',
        'leasePeriod',
        'leaseTerms',
        'propertyAddress',
        'originalPlotDetails',
        'newSubDividedPlotDetails',
        'mergedPlotInformation',
        'surrenderingPartyName',
        'receivingPartyName',
        'propertyDetails',
        'considerationAmount',
        'changesVariations',
        'heirBeneficiaryDetails',
        'originalPropertyOwnerDetails',
        'assentTerms',
        'releaserName',
        'releaseTerms',
        'instrumentDate',
        'solicitorName',
        'solicitorAddress',
        'surveyPlanNo',
        'lga',
        'district', 
        'size',
        'plotNumber',
    ];
}
