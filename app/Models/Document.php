<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public $fillable=[
        'name',
        'category_id',
        'sub_category_id',
        'description',
        'tages',
        'parent_id',
        'assign_user',
        'created_by',
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function subCategory(){
        return $this->hasOne('App\Models\SubCategory','id','sub_category_id');
    }

    public function createdBy(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

    public function tags(){
       $docTag=!empty($this->tages)?explode(',',$this->tages):[];
        $tags=[];
        foreach ($docTag as $tag){
            $tags[]=Tag::find($tag);
        }
        return $tags;
    }
}
