<template>
    <app-layout>
        <div class="w-screen flex items-center">
            <div class="container flex flex-col md:flex-row items-center justify-center px-5 text-gray-700">
                <div class="max-w-md">
                    <div class="text-5xl font-dark font-bold">404</div>
                    <p class="text-2xl md:text-3xl font-light leading-normal">Esta página no está disponible.</p>
                    <p class="mb-8">Es posible que el enlace que seleccionaste esté roto o que se haya eliminado la página.</p>

                    <a href="/home" class="block px-4 inline py-2 text-sm font-medium leading-5 shadow text-white transition-colors duration-150 border border-transparent rounded-lg focus:outline-none focus:shadow-outline-blue bg-blue-600 active:bg-blue-600 hover:bg-blue-700">Volver al inicio</a>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
    }
</script>
