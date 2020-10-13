<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center p-6 bg-white">
        <div class="mr-10" style="width: 300px; ">
            <img class="min-w-full" src="https://lamanzanamordida.net/app/uploads-lamanzanamordida.net/2019/01/4362B680-AF00-4B6E-9BC5-BC1C63F048F7.jpeg" alt="">
        </div>
        <div style="width: 350px;">
            <x-authentication-card>
                <x-slot name="logo">
                    <img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" class="h-9 w-auto"/>
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label value="{{ __('Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center justify-end mt-4">
                        <x-jet-button class="ml-4 w-full text-center" style="display: block !important;">
                            {{ __('Login') }}
                        </x-jet-button>

                        @if (Route::has('password.request'))
                            <a class="mt-3 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </x-authentication-card>
            @if (Route::has('register'))
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <div class="flex justify-center">
                        <p class="text-gray-600 text-sm">¿No tienes una cuenta? <a href="{{ route('register') }}">
                            <span class="text-blue-600 text-base font-semibold">Regístrate</span> </a>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-guest-layout>
