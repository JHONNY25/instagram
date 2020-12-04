<template>
    <modal :show="show" @close="showModal" maxWidth="5xl">
        <div class="bg-white overflow-hidden shadow-none">
            <div class="grid grid-cols-3 min-w-full">

                <div class="col-span-2 max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                    <img class="w-full max-w-full min-w-full"
                        src="https://images.pexels.com/photos/5286173/pexels-photo-5286173.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
                        alt="Sunset in the mountains">
                </div>

                <div class="col-span-1 relative">
                    <header class="flex items-center border-b border-grey-400">
                        <a :href="'/profile/'+post.user.nick_name" class="block cursor-pointer py-4 flex items-center text-sm outline-none focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img :src="post.user.profile_photo_url" class="h-9 w-9 rounded-full object-cover"
                            :alt="post.user.nick_name" />
                            <p class="block ml-2 font-bold">{{ post.user.nick_name }}</p>
                        </a>
                        <button class="flex items-center ml-3 border border-blue-600 rounded outline-none focus:outline-none bg-transparent text-blue-600 text-sm py-1 px-2">
                            <span class="block">Siguiendo</span>
                            <svg class="block h-5 w-5 pl-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </header>

                    <div class="scroll" ref="scrollMessagePost">
                        <div class="pt-1">
                            <comment-post showUserImage="true" :comment="post.description" :nickName="post.user.nick_name" :urlImage="post.user.profile_photo_url"></comment-post>
                        </div>
                        <comment-post v-if="post.comments.length > 0" v-for="(comment,index) in post.comments" :key="index" showUserImage="true" :comment="comment.comment" :nickName="comment.user.nick_name" :urlImage="comment.user.profile_photo_url"></comment-post>
                        <div v-else class="w-100 text-center text-grey-500"> No hay comentarios</div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0">
                        <div class="pt-4">
                            <div class="mb-2">
                                <div class="flex items-center">
                                    <span v-if="post.likes.find(u => u.user_id === $page.user.id)" @click="likeOrDislike" class="mr-3 inline-flex items-center cursor-pointer">
                                        <svg class="fill-heart text-gray-700 inline-block h-7 w-7 heart" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </span>
                                    <span v-else @click="likeOrDislike" class="mr-3 inline-flex items-center cursor-pointer">
                                        <svg class="fill-heart text-gray-700 inline-block h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </span>
                                    <span class="mr-3 inline-flex items-center cursor-pointer">
                                        <svg class="text-gray-700 inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-gray-600 text-sm font-bold">{{ post.countlikes }} Me gusta</span>
                            </div>
                            <span class="block ml-2 text-xs text-gray-600">{{ 'Hace '+getDifferenceTime(post.created_at) }}</span>
                        </div>

                        <div class="pt-4 pb-1 pr-3">
                            <div class="flex items-start">
                                <textarea v-model="textComment" class="w-full resize-none outline-none appearance-none" aria-label="Agrega un comentario..." placeholder="Agrega un comentario..."  autocomplete="off" autocorrect="off" style="height: 36px;"></textarea>
                                <button @click="postComment($page.user.id)" class="mb-2 focus:outline-none border-none bg-transparent text-blue-600">Publicar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    import Modal from './../Jetstream/Modal'
    import moment from 'moment'
    import CommentPost from './CommentPost'

    export default {
        data(){
            return {
                textComment: '',
            }
        },
        props:['post','show'],
        components:{
            Modal,
            CommentPost
        },
        methods:{
            showModal(){
                this.$emit('show')
            },
            getDifferenceTime(date){
                return moment(date).toNow(true);
            },
            async likeOrDislike(){
                const formData = new FormData()
                formData.append("postId", this.post.id)

                await axios.post('/like-post',formData)
                .then(response => {
                    this.post.likes = response.data.likes
                    if(response.data.like){
                        this.post.countlikes++
                    }else{
                        --this.post.countlikes
                    }
                })
                .catch(error => console.log(error))
            },
            async postComment(userId){
                await axios.post('/post-comment',{post_id:this.post.id,user_comment_id: userId,comment: this.textComment})
                .then(response => {
                    this.post.countcomments++
                    this.post.comments.push(response.data)
                    this.textComment = ''
                    this.scollToBottom()
                })
                .catch(error => console.log(error))
            },
            scollToBottom(){
                setTimeout(()=>{
                    this.$refs.scrollMessagePost.scrollTop = this.$refs.scrollMessagePost.scrollHeight - this.$refs.scrollMessagePost.clientHeight
                },50)
            },
        },
    }
</script>

<style>
    .fill-heart:hover{
        fill: #e53e3e;
        color: #e53e3e;
    }

    .heart{
        fill: #e53e3e;
        color: #e53e3e;
    }

    .scroll {
        height: 240px;
        overflow-y: auto;
    }
    .scroll::-webkit-scrollbar {
        width: 12px;
    }

    .scroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.3); 
        border-radius: 10px;
    }

    .scroll::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.5); 
    }
</style>
