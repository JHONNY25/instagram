<template>
    <div class="overflow-hidden shadow-none sm:rounded-lg max-w-2xl">
        <post-component @show="changeStateShow" :userName="userName" :likes="likes" :commentsnum="comments" :comment="comment" :urlImage="urlImage" :publicationTime="publicationTime"></post-component>

        <modal :show="show">
            <div>que pasaaaaaa padreeee</div>
        </modal>   
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import PostComponent from './../Components/PostComponent'
    import Modal from './../Jetstream/Modal'

    export default {
        data(){
            return {
                posts: [],
                userName: 'Juanito',
                likes: '2300',
                comments: 24,
                urlImage: 'https://instagram.fsjd1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/117756684_324341175604256_3627028918051777584_n.jpg?_nc_ht=instagram.fsjd1-1.fna.fbcdn.net&_nc_ohc=D_s2gyyHqLMAX9Vf2md&oh=9613db0350b7734e521da0918c56f824&oe=5F8EF6E2',
                publicationTime: '5 horas',
                comment: 'Un par de jugadas que se dieron en la cancha xd',
                show: false,

            }
        },
        components: {
            JetApplicationLogo,
            PostComponent,
            Modal
        },
        methods:{
            async getPost(){

            },
            changeStateShow(value){
                this.show = value
            }
        },
        created(){
            //this.getPost()
        }
    }
</script>
