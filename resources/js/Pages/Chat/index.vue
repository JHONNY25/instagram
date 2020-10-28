<template>
    <app-layout>
        <div class="w-10/12">
            <div class="grid grid-cols-3 min-w-full border rounded" style="min-height: 80vh;">
                    <div class="col-span-1 bg-white border-r border-gray-300">
                        <div>
                            <h2 class="ml-2 text-gray-600 text-lg my-2">Chats</h2>
                            <users-chats></users-chats>
                        </div>
                    </div>
                    <div class="col-span-2 bg-white">

                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    import UsersChats from '../../Components/UsersChats'

    export default {
        components: {
            AppLayout,
            UsersChats
        },
        props: [
            'user',
        ],
    }
</script>
