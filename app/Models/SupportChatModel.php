<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SupportChatModel extends Model
{
    protected $table = "support_chat";
    protected $fillable = [
        'id_user', 'message','code_chat'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
