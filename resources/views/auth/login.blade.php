<x-guest-layout>

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-[#2c6e63]">
            Welcome Back
        </h1>

        <p class="text-gray-500 mt-2">
            Sign in to manage your spa bookings
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->

        <div class="mb-5">

            <x-input-label for="email" :value="__('Email Address')" />

            <x-text-input
                id="email"
                class="block mt-2 w-full rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2"/>

        </div>

        <!-- Password -->

        <div class="mb-5">

            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                class="block mt-2 w-full rounded-xl"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>

        </div>

        <div class="flex items-center justify-between mb-6">

            <label class="flex items-center">

                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border-gray-300 text-green-700">

                <span class="ml-2 text-sm text-gray-600">
                    Remember Me
                </span>

            </label>

            @if (Route::has('password.request'))

                <a href="{{ route('password.request') }}"
                   class="text-sm text-[#2c6e63] hover:underline">

                    Forgot Password?

                </a>

            @endif

        </div>

        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>

        <div class="text-center mt-6">

            <span class="text-gray-500">
                Don't have an account?
            </span>

            <a href="{{ route('register') }}"
               class="text-[#2c6e63] font-semibold hover:underline">

                Register

            </a>

        </div>

    </form>

</x-guest-layout>