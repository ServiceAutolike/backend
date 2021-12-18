<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportModel extends Model
{
    protected $table = "support";
    protected $fillable = [
      'id_user', 'subject', 'service', 'id_port', 'description'
    ];
}
