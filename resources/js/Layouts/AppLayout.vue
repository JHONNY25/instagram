<template>
    <div class="min-h-screen" style="background-color: #fafafa">
        <nav class="bg-white border-b border-gray-300">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/dashboard">
                                <img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" class="h-7 w-auto"/>
                            </a>
                        </div>

                    </div>

                    <div class="flex items-center relative">
                    <dropdown align="center" width="100" overflow="overflow-y-auto" maxheight="300">
                            <template #trigger>
                                <div class="relative rounded border border-gray-300">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-1">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
                                            <path class="text-gray-400" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </span>
                                    <input v-model="search" aria-placeholder="Busca tus amigos o contacta nuevos" placeholder="Buscar"
                                    class="h-7 py-2 pr-2 pl-10 block w-full rounded-lg focus:outline-none text-gray-900" type="search" required style="background-color: #fafafa"/>
                                </div>
                            </template>

                            <template #content>
                                <a v-if="users.length > 0" v-for="(user,index) in users" :key="index" :href="'/profile/'+user.nick_name" class="block hover:bg-gray-100 text-xs text-gray-400 flex items-center py-2 px-3">
                                    <img :src="user.profile_photo_url"
                                        class="w-9 h-9 object-cover rounded-full"
                                        :alt="user.name" />
                                    <div class="ml-2">
                                        <h1 class="block leading-relaxed font-bold text-gray-700 text-sm"> {{ user.nick_name }}</h1>
                                        <h2 class="text-sm font-light text-gray-400">{{ user.name }}</h2>
                                    </div>
                                </a>
                                <div v-if="search == ''" class="flex items-center py-2 px-3">
                                    <h2 class="text-sm font-light text-gray-400">Busca a tus amigos...</h2>
                                </div>
                                <div v-if="!accountexists" class="flex items-center py-2 px-3">
                                    <h2 class="text-sm font-light text-gray-400">No existe una cuenta</h2>
                                </div>
                            </template>
                        </dropdown>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="mr-3">
                            <a href="/dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path class="text-gray-600" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </a>
                        </div>
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                <path class="text-gray-600" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="mr-3">
                            <a href="/user-chats">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path class="text-gray-600" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </a>
                        </div>
                        <div class="ml-3 relative">
                            <dropdown align="right" width="48">
                                <template #trigger>
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                                    </button>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Cuenta
                                    </div>

                                    <jet-dropdown-link :href="'/profile/' + $page.user.nick_name">
                                        Perfil
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/user/profile">
                                        Configuración
                                    </jet-dropdown-link>

                                    <jet-dropdown-link href="/user/api-tokens" v-if="$page.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-dropdown-link>

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Management -->
                                    <template v-if="$page.jetstream.hasTeamFeatures">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="'/teams/' + $page.user.current_team_id">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link href="/teams/create" v-if="$page.jetstream.canCreateTeams">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>

                                        <div class="border-t border-gray-100"></div>
                                    </template>

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Logout
                                        </jet-dropdown-link>
                                    </form>
                                </template>
                            </dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.name" />
                        </div>

                        <div class="ml-3">
                            <div class="font-medium text-base text-gray-800">{{ $page.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <jet-responsive-nav-link :href="'/profile/' + $page.user.nick_name" :active="$page.currentRouteName == 'profile.show'">
                            Perfil
                        </jet-responsive-nav-link>

                        <jet-dropdown-link href="/user/profile">
                            Configuración
                        </jet-dropdown-link>

                        <jet-responsive-nav-link href="/user/api-tokens" :active="$page.currentRouteName == 'api-tokens.index'" v-if="$page.jetstream.hasApiFeatures">
                            API Tokens
                        </jet-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" @submit.prevent="logout">
                            <jet-responsive-nav-link as="button">
                                Logout
                            </jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        <template v-if="$page.jetstream.hasTeamFeatures">
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Team
                            </div>

                            <!-- Team Settings -->
                            <jet-responsive-nav-link :href="'/teams/' + $page.user.current_team_id" :active="$page.currentRouteName == 'teams.show'">
                                Team Settings
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link href="/teams/create" :active="$page.currentRouteName == 'teams.create'">
                                Create New Team
                            </jet-responsive-nav-link>

                            <div class="border-t border-gray-200"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.user.all_teams">
                                <form @submit.prevent="switchToTeam(team)">
                                    <jet-responsive-nav-link as="button">
                                        <div class="flex items-center">
                                            <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <div>{{ team.name }}</div>
                                        </div>
                                    </jet-responsive-nav-link>
                                </form>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
        <div class="py-12">
            <div class="max-w-7xl min-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-full flex justify-center">
                    <slot></slot>
                </div>
            </div>
        </div>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    import JetApplicationLogo from './../Jetstream/ApplicationLogo'
    import JetApplicationMark from './../Jetstream/ApplicationMark'
    import Dropdown from './../Components/Dropdown'
    import JetDropdownLink from './../Jetstream/DropdownLink'
    import JetNavLink from './../Jetstream/NavLink'
    import JetResponsiveNavLink from './../Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationLogo,
            JetApplicationMark,
            Dropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                search: '',
                users:[],
                loading: true,
                errored: false,
                accountexists: true
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put('/current-team', {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                axios.post(`/user/${Laravel.user.id}/offline`,{})

                axios.post('/logout').then(response => {
                    window.location = '/';
                })
            },
            listen(){
                Echo.join('instagram-chat')
                .joining((user) => {
                    if(user.status === 0){
                        axios.post(`/user/${user.id}/online`,{})
                    }
                })
            },
        },
        computed: {
            path() {
                return window.location.pathname
            },
            searchUsers(){
                this.accountexists = true
                if(this.search !== ""){

                    axios.get('/users-search/'+this.search)
                        .then(response => {
                            if(response.data.length > 0 && Array.isArray(response.data)){
                                this.accountexists = true
                                this.users = response.data
                            }else{
                                this.accountexists = false
                                this.users = []
                            }
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                            this.accountexists = true
                        })
                        .finally(() => this.loading = false)

                }else{
                    this.users = []
                    this.accountexists = true
                }
            }
        },
        mounted(){
            const pusher = new Pusher('6176ca3de88da98be835', {
                cluster: 'us2'
            });

            const channel = pusher.subscribe('instagram-chat');

            this.listen()
        }
    }
</script>
