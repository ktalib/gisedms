<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    use HasFactory;
    public $fillable=[
        'comment',
        'user_id',
        'document_id',
        'parent_id',
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
