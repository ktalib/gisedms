<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shareDocument extends Model
{
    use HasFactory;
    public $fillable=[
        'user_id',
        'document_id',
        'start_date',
        'end_date',
        'parent_id',
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
