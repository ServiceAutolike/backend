<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['content','image','created_at','updated_at'];
    public $timestamps = true;
}
