<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    public $fillable=[
        'subject',
        'message',
        'date',
        'time',
        'assign_user',
        'document_id',
        'parent_id',
        'created_by',
    ];

    public function createdBy(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

    public function users(){
        $users=!empty($this->assign_user)?explode(',',$this->assign_user):[];
        $user=[];
        foreach ($users as $u){
            $user[]=User::find($u);
        }
        return $user;
    }
}
