<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationMother extends Model
{
    use HasFactory;

    protected $table = 'mother_applications';

    protected $fillable = [
        'applicant_title',
        'applicant_type',
        'fileno',
        'first_name',
        'middle_name',
        'surname',
        'passport',
        'corporate_name',
        'rc_number',
        'multiple_owners_names',
        'multiple_owners_passport',
        'address',
        'phone_number',
        'email',
        'identification_type',
        'identification_others',
        'plot_house_no',
        'plot_plot_no',
        'plot_street_name',
        'plot_district',
        'owner_house_no',
        'owner_plot_no',
        'owner_street_name',
        'owner_district',
        'additional_comments',
        'application_fee',
        'payment_date',
        'receipt_number',
        'receipt_date',
        'revenue_accountant',
        'accountant_signature_date',
        'scheme_no',
        'application_status',
        'approval_date',
    ];
}
