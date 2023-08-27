<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    public function messages() {
        return $this->hasMany('App/Models/chatMessage');
        // we didn't make a relationship because chat room its not connected with anything .
    }
}
