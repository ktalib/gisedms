<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionHistory extends Model
{
    use HasFactory;
    public $fillable=[
        'document',
        'current_version',
        'document_id',
        'created_by',
        'parent_id',
    ];

    public function createdBy(){
        return $this->hasOne('App\Models\User','id','created_by');
    }
}
