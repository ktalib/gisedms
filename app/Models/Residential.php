<?php

Namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residential extends Model
{
    use SoftDeletes;
    protected $connection = 'sqlsrv';
    protected $table = 'residential';
    protected $fillable = ['name', 'address', 'phone', 'email', 'website', 'description', 'image'];
}
 