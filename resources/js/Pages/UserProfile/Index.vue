<template>
    <app-layout>
        <div class="w-10/12">
            <div class="flex justify-center pb-10">
                    <user-details class="flex w-9/12 justify-content-around" :followerscount="followers" :postscount="postsCount" :followedcount="followed" :imageurl="user.profile_photo_url" :user="user"></user-details>
            </div>
            <div class="border-b border-gray-300"></div>
            <article v-if="posts.length > 0" class="mt-5 grid grid-cols-3 gap-10">
                <image-post v-for="(post,index) in posts" @show="changeStateShowAndSetPost" :post="post" :key="index"></image-post>
            </article>
            <div v-else class="w-full text-center text-3xl pt-10">No tiene publicaciones</div>

            <modal-post :show="show" :post="post" @show="changeState"></modal-post>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import ImagePost from './ImagePost'
    import UserDetails from './UserDetails'
    import ModalPost from './../../Components/ModalPost'

    export default {
        data(){
            return{
                url: 'https://cdn.pixabay.com/photo/2020/10/03/11/08/girl-5623231_960_720.jpg',
                show: false,
                post: [],
            }
        },
        components: {
            AppLayout,
            ImagePost,
            UserDetails,
            ModalPost
        },
        props: [
            'user',
            'followers',
            'postsCount',
            'followed',
            'posts',
        ],
        methods:{
            changeState(){
                this.show = !this.show
            },
            changeStateShowAndSetPost(post){
                this.post = post
                this.show = !this.show
            }
        }
    }
</script>
