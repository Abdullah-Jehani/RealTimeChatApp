<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    // this fucntion is used to ewturnback all the rooms that we have created . 
    public function rooms(Request $request) {
            return ChatRoom::all(); // it will bring all the data in the model ChatRoom 
    }
    public function messages(request $request , $RoomId) { // so with route we are expecting to pass the room id along with the request so we know the message belongs to which room 
            return ChatMessage::where('chat_room_id' , $RoomId) // here we returned all the chatMessages and we matched the chatRoomId's we have in our model with the id that passed with route . 
            ->with('user') // and we returned with The user that has sent the message . 
            ->orderBy('created_at' , 'DESC')->get();
    }

    public function newMessage(Request $request , $RoomId) {
        $newMessage = new ChatMessage; // here , we created an instance of the model chatMessage called newMessage ; 
        $newMessage->user_id = Auth::id(); // here , we are matching the user id if its a valid Id or not.
        $newMessage->chat_room_id = $RoomId; // here , we are assigning the chatRoomId table to the roomId that we recived from the route .
        $newMessage->message = $request->message; // here we are assigning the coulumn message to the message we have recived .
        $newMessage->save();

        return $newMessage;
    }

}

