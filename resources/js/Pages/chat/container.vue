<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import messageContainer from './messageContainer.vue';
import inputMessage from './inputMessage.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection></chat-room-selection>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages="messages" />
                    <input-message :room="currentRoom"
                    v-on:messagesent="getMessages()" />
                 </div>
                <!-- whenever there is an emit of a new messages from the child component , we want to fire the function of getMessages() so it refresh and get the new messages ;  !-->
            </div>
        </div> 
    </AppLayout>
</template>

<script>
import chatRoomSelection from './chatroomSelection';
import axios from 'axios';
export default {
  components: { chatRoomSelection },
    data () {
        return   {
            chatRooms: [] , 
            currentRoom: [] , 
            messages: []
        }
    } , 
    methods : {
        getRooms() {
            axios.get('/chat/rooms').then(Response => {
                this.chatRooms = Response.data ; // here we displayed all of the rooms we have
                this.setRoom(Response.data[0]); // then we caLLed THE FUNCTION THAT SAT THE DEFAULT ACTIVE ROOM 
            }).catch(error => console.log(error)) ; 
        } , 
        setRoom(Room) {
            // so this function is used to set a current room , and get the messages of the current Room . 
        this.currentRoom = Room;
        this.getMessages() ; 
        
        } , 
        getMessages() {
            axios.get('chat/room/' + this.currentRoom.id + '/messages').then(Response => {
                this.messages = Response.data
            }).catch(error => console.log(error)) ; 
        }
    } , 
    created() {
        this.getRooms() ;
    }

}


    
</script>
