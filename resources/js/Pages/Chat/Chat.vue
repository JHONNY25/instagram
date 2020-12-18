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
        <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: 700px;" ref="toolbarChat">
            <ul>
                <div v-if="messages.length <= 0" class="w-full flex text-center">
                    <div class="w-full px-5 py-2 my-2 text-gray-500 text-center text-3xl">
                        No existe una conversación, se el primero en conversar!!
                    </div>
                </div>
                <li v-else v-for="(message,index) in messages" :key="index" class="clearfix2">
                    <div class="w-full flex" :class="[message.user_id === usercurrent ? 'justify-end' : 'justify-start']">
                        <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                            <span v-if="message.type === 'text'" class="block">{{ message.text }}</span>
                            <div v-if="message.type === 'image'" style="width: 250px; height: 200px;">
                                <img :src="message.file_path" class="w-full max-w-full min-w-full min-h-full"/>
                            </div>
                            <span class="block text-xs" :class="[message.user_id === usercurrent ? 'text-right' : 'text-left']">{{ getHoursByDate(message.send_date) }}</span>
                            <div class="absolute w-0 h-0"
                            style="border-bottom: 15px solid transparent;
                                top: 0;"
                            :style="getStylesMessage(message)"></div>
                        </div>
                    </div>
                </li>

                <li v-if="url" class="clearfix2">
                    <div class="w-full flex justify-end">
                        <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700">
                            <div>
                                <div class="rounded-t-lg" style="width: 300px; height: 200px;">
                                    <div class="rounded-t-lg w-full max-w-full min-w-full min-h-full"
                                    style="width: 300px; height: 200px;     max-width: 100%;
    margin-top: 12px;
    --saf-0: rgba(var(--sk_foreground_low_solid,221,221,221),1);
    border: 1px solid var(--saf-0);background-repeat: no-repeat;
                                    background-position: top;
                                    background-size: cover;
                                    background-image: url('https://files.slack.com/files-tmb/TJA5RL19S-F014VH0T3C7-13dc94bb96/carta_terminacion_de_residencias_profesionales_thumb_pdf.png');"></div>
                                </div>
                                <div class="rounded-b-lg bg-gray-800 flex items-center p-4 justify-between" style="width: 300px;">
                                    <button class="cursor-pointer">
                                        <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                    <a href="" class="text-white block">Documento js</a>
                                </div>
                            </div>
                            <span class="block text-xs text-right">10:33 am</span>
                        </div>
                    </div>
                </li>
            </ul>

            <div v-show="typing" class="w-full flex justify-start">
                <div class="px-5 py-2 my-2 text-gray-700">{{ usertyping.nick_name + ' esta escribiendo ...' }}</div>
            </div>

            <div v-if="error" class="absolute z-50 bg-red-400 text-white text-xs rounded py-2 px-4" 
                style="bottom: 10px;
                left: 7px;
                right: 7px;">
                {{ error }}
            </div>
        </div>

        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
            <button @click="dispatchInputImage" class="outline-none focus:outline-none">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </button>
            <button @click="dispatchInputFile" class="outline-none focus:outline-none ml-1">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>

            <input @change="fileChange" id="chatfile" type="file" name="file" accept=".pdf,.txt,.doc,.docx" style="display: none"/>
            <input @change="imageChange" id="chatImage" type="file" name="image" accept="image/gif,image/jpeg,image/jpg,image/png" style="display: none"/>

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
                file: null,
                url: null,
                image: null,
                urlImage: null,
                error: null
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
            dispatchInputFile(){
                document.getElementById('chatfile').click()
            },
            fileChange(e){
                const file = e.target.files[0]
                console.log(file)
                this.file = file
                this.url = URL.createObjectURL(file)
            },
            dispatchInputImage(){
                document.getElementById('chatImage').click()
            },
            async imageChange(e){
                const thiscomponent = this;
                const file = e.target.files[0]
                this.image = file

                const formData = new FormData()
                formData.append("chat_id", this.chatid)
                formData.append("user_id", this.usercurrent)
                formData.append('image', this.image)

                await axios.post('/send-image', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.image = null
                })
                .catch(error => {
                    if(error.response.status === 422){
                        this.error = error.response.data.error.image[0]
                    }
                })

                setTimeout(function() {
                    thiscomponent.error = null
                }, 2000);
            },
            getHoursByDate(date){
                return moment(date).format('h:m A')
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
            },
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

