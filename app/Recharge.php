<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    protected $table = 'recharge';
    protected $fillable = ['id_user','type', 'transaction_code','amount','fee','amount_end','discount','memo','status','type_recharge','updated_at'];
    public $timestamps = true;
}
