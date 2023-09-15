<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cateM extends Model
{
    protected $table='categrories_tbl';
    protected $fillable=['id','name','status','created_at','updated_at','deleted_at'];
    protected $dates = ['deleted_at'];
    use HasFactory;
}
