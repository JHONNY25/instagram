<template>
    <div style="width:300px; height:300px">
        <img :src="url"
            class="w-full h-full object-cover"
            :alt="name" />
    </div>
</template>

<script>
    export default{
        props:['url','name']
    }
</script>