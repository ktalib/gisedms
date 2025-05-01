<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandAdministration extends Model
{
    use HasFactory;

    protected $table = 'landAdministration';
    
    protected $guarded = [];
    
    public function subApplication()
    {
        return $this->belongsTo(SubApplication::class, 'sub_application_id');
    }
}
