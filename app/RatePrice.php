<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatePrice extends Model
{
    protected $table = 'rate_price';
    protected $fillable = ['services','type_services', 'price','created_at','updated_at'];
    public $timestamps = true;
}
