<template>
    <div class="max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl w-full">
        <button class="flex justify-center w-full mb-5 text-center bg-blue-500 rounded text-white py-2 outline-none focus:outline-none hover:bg-blue-600" @click="changeStateShowPost">Agregar publicación</button>

        <post-component v-if="posts.length > 0" v-for="(post,index) in posts" :key="index"
        @show="changeStateShowAndSetPost" :post="post"></post-component>

        <div v-else class="text-3xl">No hay publicaciones</div>

        <modal-post :show="show" :post="post"></modal-post>

        <modal :show="showPost" @close="changeStateShowPost">
            <div class="p-5">
                <div class="border rounded border-gray-300 p-5">
                    <textarea v-model="textpost" id="posttext" class="w-full h-16 resize-none outline-none p-2 rounded focus:boutline-none appearance-none" name="posttext" cols="30" rows="10" placeholder="En que estas pensando ...?"></textarea>
                    <div id="preview" class="my-5">
                        <img v-if="url" :src="url" style="max-width: 100%; max-height: 400px; margin: 0 auto;"/>
                    </div>
                    <div class="flex justify-end">
                        <button @click="dispatchInputFile" class="outline-none focus:outline-none mr-3 inline-flex items-center cursor-pointer bg-blue-500 p-2 rounded-full" >
                            <svg class="text-white inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                        <input @change="fileChange" id="image" type="file" name="image" accept="image/gif,image/jpeg,image/jpg,image/png" style="display: none"/>
                    </div>
                </div>
                <button type="submit" class="flex justify-center w-full outline-none focus:outline-none my-3 text-center bg-blue-500  hover:bg-blue-600 rounded text-white py-2" @click="createPost">Publicar</button>
            </div>
        </modal>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import PostComponent from './../Components/PostComponent'
    import Modal from './../Jetstream/Modal'
    import ModalPost from './../Components/ModalPost'

    export default {
        data(){
            return {
                posts: [],
                show: false,
                showPost: false,
                imagepost: null,
                textpost: null,
                url: null,
                post: [],
            }
        },
        components: {
            JetApplicationLogo,
            PostComponent,
            Modal,
            ModalPost
        },
        methods:{
            fileChange(e){
                const file = e.target.files[0]
                this.imagepost = file
                this.url = URL.createObjectURL(file)
            },
            async getPost(){
                await axios.get('/get-posts')
                .then(response => {
                    this.posts = response.data
                })
                .catch(error => console.log(error))
            },
            changeStateShowAndSetPost(post){
                this.show = !this.show
                this.post = post
            },
            changeStateShowPost(){
                this.showPost = !this.showPost
            },
            dispatchInputFile(){
                document.getElementById('image').click()
            },
            resetData(){
                this.showPost = false
                this.imagepost = null
                this.textpost = null
                this.url = null
            },
            async createPost(){
                const formData = new FormData()
                formData.append("image", this.imagepost)
                formData.append('textpost', this.textpost)

                await axios.post('/create-post', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.posts.unshift(response.data)
                })
                .catch(error => console.log(error))
                .finally(() => {
                    this.resetData()
                })
            }
        },
        created(){
            this.getPost()
        }
    }
</script>
