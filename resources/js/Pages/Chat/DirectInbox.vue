<template>
    <app-layout>
        <div class="w-10/12">
            <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
                    <div class="col-span-3 bg-white">
                        <chat :userprop="chat.userrecive.id === $page.user.id ? chat.usersent : chat.userrecive"
                        :messages="chat.messages" :usercurrent="$page.user.id" :chatid="chat.id"></chat>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import Chat from './Chat'

    export default {
        components: {
            AppLayout,
            Chat
        },
        props: [
            'chat',
        ]
    }
</script>
