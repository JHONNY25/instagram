<template>
    <div id="post-profile" class="cursor-pointer relative" style="width:300px; height:300px">
        <img :src="post.image_path"
            class="foto w-full h-full object-cover"
            :alt="post.description" />
        <div id="hover-post" class="absolute top-0 left-0 right-0 bottom-0 items-center justify-center" style="background-color: rgba(0,0,0,0.6);">
            <div>
                <svg class="text-white h-7 w-7 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                <span class="ml-1 text-white">{{ post.countlikes }}</span>
            </div>

            <div class="ml-5">
                <svg class="text-white h-7 w-7 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                </svg>
                <span class="ml-1 text-white">{{ post.countcomments }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:['post']
    }
</script>

<style>
    #hover-post{
        display: none;
    }

    #post-profile:hover #hover-post{
        display: flex;
    }
</style>

