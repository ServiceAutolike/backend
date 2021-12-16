<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';
    protected $fillable = ['id','user_id','url_services','id_fb','id_instagram','id_tiktok','id_youtube', 'id_shopee','id_lazada', 'name_fb','speed','type_services','warranty','total_price','total_warranty','checkpoint','service_code','transaction_code','number','number_success','status'];
    public $timestamps = true;

}
