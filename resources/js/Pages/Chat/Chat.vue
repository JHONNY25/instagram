<template>
    <div v-else class="w-full">
        <div class="flex items-center border-b border-gray-300 pl-3 py-3">
            <img class="h-10 w-10 rounded-full object-cover"
            :src="userimage"
            :alt="username" />
            <span class="block ml-2 font-bold text-base text-gray-600">{{ username }}</span>
        </div>
        <div class="w-full overflow-y-auto p-10" style="height: 700px;">
            <ul>
                <div v-if="messages.lenght <= 0" class="w-full flex text-center">
                    <div class="w-full px-5 py-2 my-2 text-white text-center text-3xl">
                        No existe una conversación, se el primero en conversar!!
                    </div>
                </div>
                <li v-for="(message,index) in messages" :key="index" class="clearfix2">
                    <div class="w-full flex" :class="[message.user_id === usercurrent ? 'justify-end' : 'justify-start']">
                        <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                            {{ message.text }}
                            <div class="absolute w-0 h-0"
                            style="border-bottom: 15px solid transparent;
                                top: 0;"
                            :style="getStylesMessage(message)"></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
            <button class="outline-none focus:outline-none">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>
            <input v-model="message" aria-placeholder="Escribe un mensaje aquí" placeholder="Escribe un mensaje aquí"
                class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required/>

            <button v-if="message !== ''" class="outline-none focus:outline-none" @click="$emit('sendmessage',username)">
                <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                message: ''
            }
        },
        props:[
            'username','userimage','messages','usercurrent'
        ],
        methods:{
            getStylesMessage(message){
                return message.user_id === this.usercurrent ? 'right: -25px; border-left: 15px solid #f4f5f7; border-right: 15px solid transparent;' 
                                    :'left: -25px; border-left: 15px solid transparent; border-right: 15px solid #f4f5f7;'
            }
        }
    }
</script>
