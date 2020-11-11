<template>
    <ul class="overflow-auto" style="height: 500px;">
        <li>
            <a @click="$emit('getchat',username)" class="hover:bg-gray-100 border-b border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                <img class="h-10 w-10 rounded-full object-cover"
                :src="userimage"
                :alt="username" />
                <div class="w-full pb-2">
                    <div class="flex justify-between">
                        <span class="block ml-2 font-semibold text-base text-gray-600 ">{{ username }}</span>
                        <span class="block ml-2 text-sm text-gray-600"> {{ 'Hace '+getDifferenceTime(messagedate) }}</span>
                    </div>
                    <span class="block ml-2 text-sm text-gray-600">{{ lastmessage }}</span>
                </div>
            </a>
        </li>
    </ul>
</template>

<script>
    import moment from 'moment'

    export default {
        props:[
            'lastmessage','messagedate','username','userimage','chatid'
        ],
        methods:{
            getDifferenceTime(date){
                return moment(date).tz('America/Mazatlan').toNow(true);
            }
        }
    }
</script>
