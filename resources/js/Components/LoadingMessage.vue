<template>
    <div v-if="visible" class="w-full pb-2 ml-4">
        <div class="w-full h-full flex items-center">
            <span class="text-gray-600 w-0 h-0">
                <i class="fas fa-circle-notch fa-spin fa-1x"></i>
            </span>
        </div>
        <div class="ml-6 font-semibold text-base text-gray-600">
            Enviando ...
        </div>
    </div>
</template>

<script>

    export default {
        props:['visible']
    }
</script>
