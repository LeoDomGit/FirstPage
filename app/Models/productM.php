<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productM extends Model
{
    protected $table='products';
    protected $fillable=['id','name','price','discount','quantity','status','idBrand','idCate','images','content','created_at','updated_at','deleted_at'];
    use HasFactory;
}
