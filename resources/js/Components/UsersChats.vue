<template>
    <a @click="emmitEvent" class="hover:bg-gray-100 border-b border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
        <img class="h-10 w-10 rounded-full object-cover"
        :src="userimage"
        :alt="username" />
        <div class="w-full pb-2">
            <div class="flex justify-between">
                <span class="block ml-2 font-semibold text-base text-gray-600 ">{{ username }}</span>
                <span v-if="message.length > 0" class="block ml-2 text-sm text-gray-600"> {{ 'Hace '+getDifferenceTime(message[0].send_date) }}</span>
            </div>
            <span v-if="message.length > 0" class="block ml-2 text-sm text-gray-600">{{ message[0].text ? message[0].text : message[0].file_name }}</span>
        </div>
    </a>
</template>

<script>
    import moment from 'moment'

    export default {
        props:{
            message: {
                type: Array,
                required: false
            },
            username:{
                type: String,
                required: true
            },
            chatid:{
                type: Number,
                required: false
            },
            userid:{
                type: Number,
                required: false
            },
            userimage:{
                type: String,
                required: true
            }
        },
        methods:{
            getDifferenceTime(date){
                return moment(date).toNow(true);
            },
            emmitEvent(){
                if(this.chatid){
                    this.$emit('getChat',this.chatid)
                }else{
                    this.$emit('getNewChat',this.userid)
                }
            }
        }
    }
</script>
