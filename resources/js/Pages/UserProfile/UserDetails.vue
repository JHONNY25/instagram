<template>
    <div>
        <img :src="imageurl"
            class="h-40 w-40 rounded-full object-cover"
            :alt="name" />
        <div class="ml-10">
            <div class="flex items-center">
                <h2 class="block leading-relaxed font-light text-gray-700 text-3xl"> {{ nickname }}</h2>
                <a :href="urlprofileconfig" class="h-7 px-3 ml-3 focus:outline-none hover:border-transparent text-center rounded border border-gray-400 hover:bg-blue-500 hover:text-white bg-transparent text-gray-500 font-semibold">Editar perfil</a>
                <a class="ml-2 p-1 border-transparent text-gray-700 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                aria-label="Notifications">
                    <svg class="h-8 w-8" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
            </div>
            <ul class="flex justify-content-around items-center">
                <li>
                    <span class="block text-base flex"><span class="font-bold mr-2">20 </span> Publicaciones</span>
                </li>
                <li>
                    <span class="cursor-pointer block text-base flex ml-5"><span class="font-bold mr-2">40 </span> Seguidores</span>
                </li>
                <li>
                    <span class="cursor-pointer block text-base flex ml-5"><span class="font-bold mr-2">230 </span> Seguidos</span>
                </li>
            </ul>
            <br>
            <div class="">
                <h1 class="text-base font-bold font-light">{{ name }}</h1>
                <span v-if="presentation !== null" class="text-base">{{ presentation }}</span>
                <a v-if="website !== null" :href="website" class="block text-base text-blue-500 mt-2" target="_blank">{{ website }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:['name','nickname','presentation','website','imageurl','urlprofileconfig']
    }
</script>
