<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public $fillable=[
        'title',
        'category_id',
        'parent_id',
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
