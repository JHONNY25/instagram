<template>
    <app-layout>
        <div class="w-10/12">
            <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
                    <div class="col-span-1 bg-white border-r border-gray-300">
                        <h2 class="ml-2 mb-2 text-gray-600 text-lg my-2">Chats</h2>
                        <div class="my-3 mx-3 ">
                            <div class="relative text-gray-600 focus-within:text-gray-400">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-500"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </span>
                                <input  aria-placeholder="Busca tus amigos o contacta nuevos" placeholder="Busca tus amigos"
                                class="py-2 pl-10 block w-full rounded bg-gray-100 outline-none focus:text-gray-700" type="search" name="search" required autocomplete="search" />
                            </div>
                        </div>

                        <span v-if="chats.length === 0" class="block text-center my-2 mx-2 text-sm text-gray-600">No tienes conversaciones.</span>
                        <users-chats v-else v-for="(chat,index) in chats" :key="index" :chatid="chat.id" :lastmessage="chat.messages[0].text" 
                        :messagedate="chat.messages[0].send_date" :username="chat.userrecive.id === $page.user.id ? chat.usersent.nick_name : chat.userrecive.nick_name" 
                        :userimage="chat.userrecive.id === $page.user.id ? $chat.usersent.profile_photo_url : chat.userrecive.profile_photo_url " @getchat="getChat"></users-chats>
                    </div>
                    <div class="col-span-2 bg-white">
                        <div v-if="userchat.length <= 0" class="w-full flex items-center justify-center" style="height: 75vh;">
                            <div class="text-center">
                                <div class="border border-gray-600 rounded-full w-24 h-24 relative" style="margin: 0 auto;">
                                    <svg style="right: 21px; top: 19px;" class="absolute text-gray-600 h-12 w-12 origin-center transform rotate-45" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </div>
                                <h5 class="text-gray-600 text-lg my-2">Tus mensajes</h5>
                                <span class="block ml-2 text-sm text-gray-600">Envía fotos y mensajes privados a un amigo o un grupo.</span>
                            </div>
                        </div>

                        <chat v-else :userimage="userchat.userrecive.id === $page.user.id ? userchat.usersent.profile_photo_url : userchat.userrecive.profile_photo_url"
                        :username="userchat.userrecive.id === $page.user.id ? userchat.usersent.nick_name : userchat.userrecive.name"
                        :messages="userchat.messages" :usercurrent="$page.user.id"></chat>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import UsersChats from '../../Components/UsersChats'
    import Chat from './Chat'

    export default {
        data(){
            return {
                userchat: [],
            }
        },
        components: {
            AppLayout,
            UsersChats,
            Chat
        },
        props: [
            'chats',
        ],
        methods:{
            async getChat(username){
                await axios.get('/user-chats/'+username)
                .then(response => {
                    this.userchat = response.data
                })
                .catch(error => console.log(error))
            }
        }
    }
</script>
