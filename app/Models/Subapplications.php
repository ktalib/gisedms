<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subapplications extends Model
{
    use HasFactory;
     protected $connection = 'sqlsrv';
    protected $table = 'subapplications';

    protected $fillable = [
        'main_application_id',
        'fileno',
        'applicant_type',
        'applicant_title',
        'first_name',
        'middle_name',
        'surname',
        'passport',
        'corporate_name',
        'rc_number',
        'multiple_owners_names',
        'multiple_owners_passport',
        'multiple_owners_data',
        'address',
        'phone_number',
        'email',
        'identification_type',
        'identification_others',
        'block_number',
        'floor_number',
        'unit_number',
        'ownership',
        'application_status',
        'comments'
    ];

    public function mainApplication()
    {
        return $this->belongsTo(ApplicationMother::class, 'main_application_id');
    }
}
