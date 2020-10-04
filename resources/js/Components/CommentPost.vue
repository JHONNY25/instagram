<template>
    <div class="text-sm mb-2 flex flex-start" :class="{'relative' : showUserImage}">
        <div v-if="showUserImage" class="absolute top-0 left-0 mr-3">
            <a :href="'/'+nickName" class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                <img class="h-8 w-8 rounded-full object-cover"
                :src="urlImage"
                alt="Jusnito" />
            </a>
        </div>
        <p class="font-bold" :class="{'ml-12' : showUserImage}">
            <a class="cursor-pointer">{{nickName}}:</a>
            <span class="text-gray-700 font-medium">
                {{comment}}
            </span>
        </p>
    </div>
</template>

<script>
    export default {
        props: ['showUserImage','comment','nickName','urlImage']
    }
</script>
