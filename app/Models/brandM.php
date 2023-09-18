<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class brandM extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table="brands_tbl";
    protected $fillable=['id','name','status','created_at','updated_at','deleted_at'];
}
