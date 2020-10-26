<template>
    <app-layout>
        <div class="w-10/12">
            <div class="flex justify-center pb-10">
                    <user-details class="flex w-9/12 justify-content-around" :urlprofileconfig="hrefprofile" :imageurl="user.profile_photo_url" :name="user.name" :nickname="user.nick_name" :website="user.web_site" :presentation="user.presentation" ></user-details>
            </div>
            <div class="border-b border-gray-300"></div>
            <article class="mt-5 grid grid-cols-3 gap-10">
                <image-post v-for="index in 5" :url="url" :name="name" :key="index"></image-post>
            </article>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import ImagePost from './ImagePost'
    import UserDetails from './UserDetails'

    export default {
        data(){
            return{
                url: 'https://cdn.pixabay.com/photo/2020/10/03/11/08/girl-5623231_960_720.jpg',
                userimage: 'https://instagram.fsjd1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/117756684_324341175604256_3627028918051777584_n.jpg?_nc_ht=instagram.fsjd1-1.fna.fbcdn.net&_nc_ohc=D_s2gyyHqLMAX9Vf2md&oh=9613db0350b7734e521da0918c56f824&oe=5F8EF6E2',
                name:'Juanito',
                nickname: 'JRH',
                website: 'https://www.google.com/',
                presentation: 'Soy desarrollador web y megusta el BMX',
                hrefprofile: '/user/profile',
            }
        },
        components: {
            AppLayout,
            ImagePost,
            UserDetails
        },
        props: [
            'user',
        ],
    }
</script>
