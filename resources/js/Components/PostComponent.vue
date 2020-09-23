<template>
    <div class="max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl xl:max-w-2xl rounded overflow-hidden shadow-none">
        <header class="flex flex-start">
            <div>
                <a class="cursor-pointer m-4 flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                    <img class="h-9 w-9 rounded-full object-cover"
                    src="https://instagram.fsjd1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/117756684_324341175604256_3627028918051777584_n.jpg?_nc_ht=instagram.fsjd1-1.fna.fbcdn.net&_nc_ohc=D_s2gyyHqLMAX9Vf2md&oh=9613db0350b7734e521da0918c56f824&oe=5F8EF6E2"
                    alt="Jusnito" />
                    <div>
                        <span class="block ml-2 font-bold">Juanito</span>
                        <span class="block ml-2 text-xs text-gray-600">5 horas</span>
                    </div>
                </a>
            </div>
        </header>
        <img class="w-full max-w-full min-w-full"
            src="https://images.pexels.com/photos/5286173/pexels-photo-5286173.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260"
            alt="Sunset in the mountains">

        <div class="px-6 pt-4">
            <div class="mb-2">
                <div class="flex items-center">
                    <span class="mr-3 inline-flex items-center cursor-pointer">
                        <svg class="fill-heart text-gray-700 inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </span>
                    <span class="mr-3 inline-flex items-center cursor-pointer">
                        <svg class="text-gray-700 inline-block h-7 w-7 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </span>
                </div>
                <span class="text-gray-600 text-sm font-bold">2,300 Me gusta</span>
            </div>
            <div class="">
                <div class="text-sm mb-2 flex flex-start" :class="{'relative' : false}">
                    <div v-if="false" class="absolute top-0 left-0 mr-3">
                        <a class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full object-cover"
                            src="https://instagram.fsjd1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/117756684_324341175604256_3627028918051777584_n.jpg?_nc_ht=instagram.fsjd1-1.fna.fbcdn.net&_nc_ohc=D_s2gyyHqLMAX9Vf2md&oh=9613db0350b7734e521da0918c56f824&oe=5F8EF6E2"
                            alt="Jusnito" />
                        </a>
                    </div>
                    <p class="font-bold" :class="{'ml-12' : false}">
                        <a class="cursor-pointer">Juanito:</a> 
                        <span class="text-gray-700 font-medium">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                        </span>
                    </p>
                </div>
                <a class="text-gray-400 text-sm cursor-pointer font-semibold">ver los 200 comentarios</a>
            </div>
            
        </div>

        <div class="px-6 pt-4 pb-3">
            <form method="POST" class="flex items-start">
                <textarea class="w-full outline-none appearance-none" aria-label="Agrega un comentario..." placeholder="Agrega un comentario..."  autocomplete="off" autocorrect="off" style="height: 36px;"></textarea>
                <button class="mb-2 focus:outline-none border-none bg-transparent text-blue-600">Publicar</button>
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['posts'],
    }
</script>

<style>
    .fill-heart:hover{
        fill: #e53e3e;
        color: #e53e3e;
    }
</style>
