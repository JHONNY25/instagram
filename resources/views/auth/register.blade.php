<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center p-6 bg-white">
        <div style="width: 350px;">
            <x-authentication-card>
                <x-slot name="logo">
                    <x-jet-authentication-card-logo />
                </x-slot>

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-jet-label value="{{ __('Name') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Email') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Confirm Password') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex flex-col items-center justify-end mt-4">
                        <x-jet-button class="ml-4 w-full text-center" style="display: block !important;">
                            {{ __('Register') }}
                        </x-jet-button>

                        <a class="mt-3 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                </form>
            </x-authentication-card>
        </div>
    </div>
</x-guest-layout>
