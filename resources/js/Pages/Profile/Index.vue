<template>
    <app-layout>
        <div class="w-10/12">
            <div class="flex justify-center pb-10">
                <div class="flex w-9/12 justify-content-around">
                    <img src="https://instagram.fsjd1-1.fna.fbcdn.net/v/t51.2885-19/s150x150/117756684_324341175604256_3627028918051777584_n.jpg?_nc_ht=instagram.fsjd1-1.fna.fbcdn.net&_nc_ohc=D_s2gyyHqLMAX9Vf2md&oh=9613db0350b7734e521da0918c56f824&oe=5F8EF6E2" 
                        class="h-40 w-40 rounded-full object-cover"
                        alt="Jusnito" />
                    <div class="ml-10">
                        <div class="flex items-center">
                            <h2 class="block text-3xl leading-relaxed font-light"> Juanito</h2>
                            <button class="h-7 px-3 ml-3 focus:outline-none focus:border-gray-400 text-center rounded border border-gray-400 focus:bg-gray-200 bg-transparent text-gray-500 font-semibold">Editar perfil</button>
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
                            <h1 class="text-base font-bold font-light">Juanito Hernandez</h1>
                            <span class="text-base">Soy desarrollador web y megusta el BMX</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray-300"></div>
            <article class="mt-5 grid grid-cols-3 gap-10">
                <div style="width:300px; height:300px">
                    <img src="https://cdn.pixabay.com/photo/2020/10/01/09/35/bee-5618012_960_720.jpg" 
                        class="w-full h-full object-cover"
                        alt="Jusnito" />
                </div>
                <div style="width:300px; height:300px">
                    <img src="https://cdn.pixabay.com/photo/2020/10/03/11/08/girl-5623231_960_720.jpg" 
                        class="w-full h-full object-cover"
                        alt="Jusnito" />
                </div>
                <div style="width:300px; height:300px">
                    <img src="https://cdn.pixabay.com/photo/2020/10/03/17/44/mountain-5624148_960_720.jpg" 
                        class="w-full h-full object-cover"
                        alt="Jusnito" />
                </div>
                <div style="width:300px; height:300px">
                    <img src="https://cdn.pixabay.com/photo/2020/09/17/05/12/river-5578051_960_720.jpg" 
                        class="w-full h-full object-cover"
                        alt="Jusnito" />
                </div>
                <div style="width:300px; height:300px">
                    <img src="https://cdn.pixabay.com/photo/2020/09/23/02/01/microphone-5594702_960_720.jpg" 
                        class="w-full h-full object-cover"
                        alt="Jusnito" />
                </div>
            </article>
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
