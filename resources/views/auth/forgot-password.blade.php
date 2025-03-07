<x-guest-layout>
        <!-- Session Status -->

        <div class="form__layout">
        <div class="form__logo"></div>

            <form method="POST" action="{{ route('password.email') }}" class="login-form">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('login'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('iniciar sesion') }}
                    </a>
                @endif
                    <x-primary-button class="ml-3">
                        {{ __('Restablecer contraseña') }}
                    </x-primary-button>
                </div>
 
            </form>
        </div>
    </div>
</x-guest-layout>