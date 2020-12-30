<template>
    <div class="">
        <dropdown align="right" width="80" overflow="overflow-y-auto" maxheight="300">
            <template #trigger>
                <div class="mr-3 relative">
                    <div class="bg-red-500 w-2 h-2 text-xs absolute top-0 right-0 rounded-full"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                        <path class="text-gray-600" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
            </template>

            <template #content>
                <a v-if="unreads.length > 0" v-for="(unread,index) in unreads" :key="index" :href="'/profile/'+unread.data.user.nick_name" class="block hover:bg-gray-100 text-xs text-gray-400 flex items-center py-2 px-3">
                    <img :src="unread.data.user.profile_photo_url"
                        class="w-9 h-9 object-cover rounded-full"
                        :alt="unread.data.user.name" />
                    <div class="ml-2">
                        <h1 class="block leading-relaxed font-bold text-gray-700 text-sm"> {{ unread.data.user.nick_name }}</h1>
                        <div class="text-sm font-light text-gray-600">{{ unread.data.message + ' ' +  getDifferenceTime(unread.data.created_at) }}</div>
                    </div>
                </a>
                <div v-else class="flex items-center py-2 px-3">
                    <h2 class="text-sm font-light text-gray-400">No tienes notificaciones</h2>
                </div>
            </template>
        </dropdown>

    </div>
</template>

<script>
    import Dropdown from './Dropdown'
    import moment from 'moment'

    export default {
        data(){
            return {
                notifications: this.unreads
            }
        },
        props:['unreads','userId'],
        components:{
            Dropdown
        },
        methods:{
            getDifferenceTime(date){
                return moment(date).toNow(true);
            },
        },
        mounted(){
            Echo.private('App.Models.User.' + this.userId)
                .notification((notification) => {
                    console.log(notification);
                });
        }
    }
</script>
