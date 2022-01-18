<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListComment extends Model
{
    protected $table = 'listcomment';
    protected $fillable = ['id_user', 'id_comment','name','content','created_at','updated_at'];
    public $timestamps = true;
}
