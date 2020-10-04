<template>
    <app-layout>
        <div>
            holaaaaaa {{ user.nick_name }}
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props: [
            'user',
        ],
    }
</script>
