<template>
    <app-layout>
        <div class="w-10/12">
            <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
                    <div class="col-span-1 bg-white border-r border-gray-300">
                        <div class="my-3 mx-3 ">
                            <div class="relative text-gray-600 focus-within:text-gray-400">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6 text-gray-500"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </span>
                                <input v-model="search" @keyup="searchFriends" aria-placeholder="Busca tus amigos o contacta nuevos" placeholder="Busca tus amigos"
                                class="py-2 pl-10 block w-full rounded bg-gray-100 outline-none focus:text-gray-700" type="search" name="search" required autocomplete="search" />
                            </div>
                        </div>

                        <div v-if="search.length > 0">
                            <span class="block my-2 mx-2 text-sm text-gray-600">Amigos</span>
                            <ul class="overflow-auto" style="max-height: 400px;">
                                <span v-if="userssearch.length === 0" class="block text-center my-2 mx-2 text-sm text-gray-600">No se encontro el usuario.</span>
                                <li v-else v-for="(user,index) in userssearch" :key="index">
                                    <users-chats :username="user.nick_name"
                                    :userimage="user.profile_photo_url" @getchat="getChat"></users-chats>
                                </li>
                            </ul>
                        </div>

                        <ul class="overflow-auto" style="height: 500px;">
                            <h2 class="ml-2 mb-2 text-gray-600 text-lg my-2">Chats</h2>
                            <span v-if="chats.length === 0" class="block text-center my-2 mx-2 text-sm text-gray-600">No tienes conversaciones.</span>
                            <li v-else v-for="(chat,index) in chats" :key="index">
                                <users-chats :lastmessage="chat.messages[0].text"
                                :messagedate="chat.messages[0].send_date" :username="chat.userrecive.id === $page.user.id ? chat.usersent.nick_name : chat.userrecive.nick_name"
                                :userimage="chat.userrecive.id === $page.user.id ? chat.usersent.profile_photo_url : chat.userrecive.profile_photo_url " @getchat="getChat"></users-chats>
                            </li>
                        </ul>
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

                        <chat v-else :userprop="userchat.userrecive.id === $page.user.id ? userchat.usersent : userchat.userrecive"
                        :messages="userchat.messages" :usercurrent="$page.user.id" :chatid="userchat.id"></chat>
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
                search: '',
                userssearch: [],
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
            },
            async searchFriends(){
                if(this.search !== ''){
                    await axios.get('/users/chat/'+this.search)
                    .then(response => {
                        this.userssearch = response.data
                    })
                    .catch(error => console.log(error))
                }else{
                    this.userssearch = []
                }
            }
        },
    }
</script>
