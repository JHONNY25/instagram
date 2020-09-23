<template>
    <div class="bg-white overflow-hidden shadow-none sm:rounded-lg max-w-2xl">
        <post-component></post-component>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import PostComponent from './../Components/PostComponent'

    export default {
        components: {
            JetApplicationLogo,
            PostComponent
        },
    }
</script>
