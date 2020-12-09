<template>
    <div class="cursor-pointer" style="width:300px; height:300px">
        <img :src="url"
            class="foto w-full h-full object-cover relative hover:opacity-75"
            :alt="name" />
    </div>
</template>

<script>
    export default{
        props:['url','name']
    }
</script>

