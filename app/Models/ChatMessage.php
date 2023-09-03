<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    public function room() {
        return $this->hasOne('App\Models\ChatRoom' , 'id' , 'chat_room_id');
        // this is read as this chatMessages has only on room , then we place the two columns to make relationship , the first one {id} from the chatRoom table, the second on {chatRoomID} is from the table chatMessage Table
    }

    public function user() {
        return $this->hasOne('App\Models\User' , 'id' , 'user_id');
        // rach chatMessage Has only one user , then we bind the usertable id with the user_id from the table chatMessages.
    }
}
