<template>
    <div class="w-full">
        <div class="flex items-center border-b border-gray-300 pl-3 py-3">
            <img class="h-10 w-10 rounded-full object-cover"
            :src="userprop.profile_photo_url"
            :alt="userprop.nick_name" />
            <span class="block ml-2 font-bold text-base text-gray-600">{{ userprop.nick_name }}</span>
            <span v-if="user.status === 1" class="connected text-green-500 ml-2" >
                <svg width="6" height="6">
                    <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                </svg>
            </span>
        </div>
        <div id="chat" class="w-full overflow-y-auto p-10" style="height: 700px;" ref="toolbarChat">
            <ul>
                <div v-if="messages.lenght <= 0" class="w-full flex text-center">
                    <div class="w-full px-5 py-2 my-2 text-white text-center text-3xl">
                        No existe una conversación, se el primero en conversar!!
                    </div>
                </div>
                <li v-for="(message,index) in messages" :key="index" class="clearfix2">
                    <div class="w-full flex" :class="[message.user_id === usercurrent ? 'justify-end' : 'justify-start']">
                        <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                            <span class="block">{{ message.text }}</span>
                            <span class="block text-xs" :class="[message.user_id === usercurrent ? 'text-right' : 'text-left']">{{ getHoursByDate(message.send_date) }}</span>
                            <div class="absolute w-0 h-0"
                            style="border-bottom: 15px solid transparent;
                                top: 0;"
                            :style="getStylesMessage(message)"></div>
                        </div>
                    </div>
                </li>
            </ul>

            <div v-show="typing" class="w-full flex justify-start">
                <div class="px-5 py-2 my-2 text-gray-700">{{ usertyping.nick_name + ' esta escribiendo ...' }}</div>
            </div>
        </div>

        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
            <button class="outline-none focus:outline-none">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>
            <input v-model="message" @keydown="isTyping" @keyup.enter="sendMessage" aria-placeholder="Escribe un mensaje aquí" placeholder="Escribe un mensaje aquí"
                class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required/>

            <button v-if="message !== ''" class="outline-none focus:outline-none" @click="sendMessage" type="submit">
                <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        data(){
            return{
                message: '',
                typing: false,
                usertyping: '',
                user: this.userprop,
            }
        },
        props:{
            userprop: {
                type: Object,
                required: true
            },
            messages: {
                type: Array,
                required: true
            },
            usercurrent: Number,
            chatid: Number
        },
        methods:{
            getHoursByDate(date){
                return moment(date).format('h:m A');
            },
            getStylesMessage(message){
                return message.user_id === this.usercurrent ? 'right: -25px; border-left: 15px solid #f4f5f7; border-right: 15px solid transparent;'
                                    :'left: -25px; border-left: 15px solid transparent; border-right: 15px solid #f4f5f7;'
            },
            async sendMessage(){
                const formData = new FormData()
                formData.append("chat_id", this.chatid)
                formData.append("user_id", this.usercurrent)
                formData.append('message', this.message)

                await axios.post('/chat/send-message',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.message = ''
                })
                .catch(error => console.log(error))

            },
            newMessage(message){
                this.messages.push(message)
            },
            isTyping(){
                const thiscomponent = this;
                let chat = Echo.private(`chat.${this.chatid}`);

                setTimeout(function() {
                    chat.whisper('typing', {
                        user: Laravel.user,
                        typing: true,
                        chatid: thiscomponent.chatid
                    });
                }, 300);
            },
            scollToBottom(){
                setTimeout(()=>{
                    this.$refs.toolbarChat.scrollTop = this.$refs.toolbarChat.scrollHeight - this.$refs.toolbarChat.clientHeight
                },50)
            },
            reset(){
                Object.assign(this.$data, this.$options.data.apply(this))
            }
        },
        watch:{
            messages(messages){
                this.scollToBottom()
            },
            chatid(chatid){
                this.scollToBottom()
                this.reset()
            }
        },
        mounted(){
            const content = document.getElementById("chat");
            content.scrollTo(0, 1500);

            const thiscomponent = this;
            const pusher = new Pusher('6176ca3de88da98be835', {
                cluster: 'us2'
            });

            const channel = pusher.subscribe('instagram-chat');

            channel.bind('message-event', function(data) {
                thiscomponent.newMessage(data.message)
            });

            channel.bind('offline', function(data) {
                if(thiscomponent.userprop.id === data.user.id){
                    thiscomponent.user = data.user
                }
            });

            channel.bind('online', function(data) {
                if(thiscomponent.userprop.id === data.user.id){
                    thiscomponent.user = data.user
                }
            });

            Echo.private(`chat.${this.chatid}`)
            .listenForWhisper('typing', (e) => {
                if(e.chatid === thiscomponent.chatid){
                    thiscomponent.usertyping = e.user;
                    thiscomponent.typing = e.typing;

                    // remove is typing indicator after 0.9s
                    setTimeout(function() {
                        thiscomponent.typing = false
                    }, 900);
                }
            });
        }
    }
</script>
