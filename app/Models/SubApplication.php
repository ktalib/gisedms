<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubApplication extends Model
{
    use HasFactory;

    protected $table = 'subapplications';
    
    protected $guarded = [];
    
    public function landAdministration()
    {
        return $this->hasOne(LandAdministration::class, 'sub_application_id');
    }
}
