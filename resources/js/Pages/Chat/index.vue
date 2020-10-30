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
                        <users-chats @getchat="getChat"></users-chats>
                    </div>
                    <div class="col-span-2 bg-white">
                        <div v-if="chat.length <= 0">
                            <div class="w-full flex items-center justify-center" style="height: 75vh;">
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
                        </div>
                        <div v-else>
                            <div class="w-full">
                                <div class="flex items-center border-b border-gray-300 pl-3 py-3">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://images.pexels.com/photos/5286173/pexels-photo-5286173.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                                    alt="Juanito" />
                                    <span class="block ml-2 font-bold text-base text-gray-600">Juanito</span>
                                </div>
                                <div class="w-full overflow-y-auto p-10" style="height: 700px;">
                                    <ul>
                                        <!--<div class="w-full flex text-center">
                                            <div class="w-full px-5 py-2 my-2 text-white text-center text-3xl">
                                                No existe una conversación, se el primero en conversar!!
                                            </div>
                                        </div> -->
                                        <li class="clearfix2">
                                            <div class="w-full flex justify-end">
                                                <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                                    Probandooo
                                                    <div class="absolute w-0 h-0"
                                                    style="border-bottom: 15px solid transparent;
                                                        right: -25px;
                                                        border-left: 15px solid #f4f5f7;
                                                        border-right: 15px solid transparent;
                                                        top: 0;"></div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="clearfix2">
                                            <div class="w-full flex justify-start">
                                                <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                                                    Probandooo
                                                    <div class="absolute w-0 h-0"
                                                    style="border-bottom: 15px solid transparent;
                                                        left: -25px;
                                                        border-left: 15px solid transparent;
                                                        border-right: 15px solid #f4f5f7;
                                                        top: 0;"></div>
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
                                    <input aria-placeholder="Escribe un mensaje aquí" placeholder="Escribe un mensaje aquí"
                                        class="py-2 mx-3 pl-5 block w-full rounded-full bg-gray-100 outline-none focus:text-gray-700" type="text" name="message" required/>

                                    <button class="outline-none focus:outline-none">
                                        <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import UsersChats from '../../Components/UsersChats'

    export default {
        data(){
            return {
                chat: []
            }
        },
        components: {
            AppLayout,
            UsersChats
        },
        props: [
            'chats',
        ],
        methods:{
            getChat(){
                this.chat.push({user:'sadasd'})
            }
        }
    }
</script>
