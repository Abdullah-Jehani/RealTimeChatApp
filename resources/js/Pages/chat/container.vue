<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import MessageContainer from './messageContainer.vue';
import imputMessage from './inputMessage.vue';
import axios from 'axios';
export default {
    components: {
    AppLayout , 
    MessageContainer, 
    imputMessage
    
    } , 

   data() {
        return {
            chatRooms: [] , 
            currentRoom: [],
            messages: []
        }
   }, 
    methods: {
        getRooms() { // this fucntion is used to get rooms from the database ; 
            axios.get('/chat/rooms')
            .then( response => {
                this.chatRooms = response.data;
                this.setRoom(response.data[0]);
            } ).catch(error => {
                console.log(error);
            })
        } , 
        setRoom( room ) { // this function is used to set an active room ; 
            this.currentRoom = room;
            this.getMessages();
        } , 
        getMessages() {
            axios.get('/chat/room/' + this.currentRoom.id + '/messages')
            .then( response => {
                this.messages = response.data;
            })
        }
    } , 
    created() {
        this.getRooms();
    } 
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container></message-container>
                    <imputMessage :room="currentRoom"></imputMessage>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
