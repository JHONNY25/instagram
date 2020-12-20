<template>
    <div>
        <img :src="imageurl"
            class="h-40 w-40 rounded-full object-cover"
            :alt="user.name" />
        <div class="ml-10">
            <div class="flex items-center">
                <h2 class="block leading-relaxed font-light text-gray-700 text-3xl"> {{ user.nick_name }}</h2>
                <a v-if="userLoggedIn.id !== user.id" :href="'/direct/inbox/'+user.id" class="cursor-pointer h-7 px-3 ml-3 outline-none border-transparent text-center rounded border bg-blue-500 hover:bg-blue-600 text-white bg-transparent font-semibold">Enviar mensaje</a>
                <a v-if="userLoggedIn.id === user.id" href="/user/profile" class="cursor-pointer h-7 px-3 ml-3 focus:outline-none hover:border-transparent text-center rounded border border-gray-400 hover:bg-blue-500 hover:text-white bg-transparent text-gray-500 font-semibold">Editar perfil</a>
                <div v-else>
                    <button v-if="followState" @click="unFollow" class="flex items-center ml-3 border border-blue-600 rounded outline-none focus:outline-none bg-transparent text-blue-600 text-sm py-1 px-2">
                        <span class="block">Dejar de seguir</span>
                        <svg class="block h-5 w-5 pl-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                    <button v-else @click="follow" class="flex items-center ml-3 border border-blue-600 hover:bg-blue-600 hover:text-white rounded outline-none focus:outline-none bg-transparent text-blue-600 text-sm py-1 px-2">
                        <span class="block">Seguir</span>
                        <svg class="block h-5 w-5 pl-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
                <a v-if="userLoggedIn.id === user.id" href="/user/profile" class="cursor-pointer ml-2 p-1 border-transparent text-gray-700 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                aria-label="Notifications">
                    <svg class="h-8 w-8" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            </div>
            <ul class="flex justify-content-around items-center">
                <li>
                    <span class="block text-base flex"><span class="font-bold mr-2">{{postscount}} </span> {{postscount === 1 ? 'Publicación' : 'Publicaciones'}} </span>
                </li>
                <li>
                    <span class="cursor-pointer block text-base flex ml-5"><span class="font-bold mr-2">{{followerscount}} </span> {{followerscount === 1 ? 'Seguidor' : 'Seguidores'}}</span>
                </li>
                <li>
                    <span class="cursor-pointer block text-base flex ml-5"><span class="font-bold mr-2">{{followedcount}} </span> {{followedcount === 1 ? 'Seguido' : 'Seguidos'}}</span>
                </li>
            </ul>
            <br>
            <div class="">
                <h1 class="text-base font-bold font-light">{{ user.name }}</h1>
                <span v-if="user.presentation !== null" class="text-base">{{ user.presentation }}</span>
                <a v-if="user.web_site !== null" :href="user.web_site" class="block text-base text-blue-500 mt-2" target="_blank">{{ user.web_site }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                userLoggedIn:'',
                followState: false
            }
        },
        props:['user','imageurl','followerscount','postscount','followedcount'],
        methods:{
            async follow(){
                await axios.post('/follow-user',{user_id: this.user.id})
                    .then(response => {
                        this.followState = !this.followState
                    })
                    .catch(error => console.log(error))
            },
            async unFollow(){
                await axios.post('/unfollow-user',{user_id: this.user.id})
                    .then(response => {
                        this.followState = !this.followState
                    })
                    .catch(error => console.log(error))
            },
            async existsFollow(){
                await axios.get('/exists-follow/'+this.user.id)
                    .then(response => {
                        if(response.data.exists){
                            this.followState = !this.followState
                        }
                    })
                    .catch(error => console.log(error))
            }
        },
        mounted(){
            this.userLoggedIn = Laravel.user
        },
        created(){
            this.existsFollow()
        }
    }
</script>
