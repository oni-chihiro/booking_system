<nav x-data="{ open: false }" class="bg-white shadow-lg border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-xl bg-teal-600 flex items-center justify-center text-white text-2xl shadow-md">
                    <i class="fa-solid fa-spa"></i>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-teal-700">
                        Spa Booking
                    </h2>

                    <p class="text-sm text-gray-500">
                        Reservation System
                    </p>
                </div>

            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center gap-8">

                @auth

                    <a href="{{ Auth::user()->role === 'admin'
                        ? url('/admin/dashboard')
                        : route('dashboard') }}"
                        class="font-semibold text-gray-700 hover:text-teal-600 transition">

                        Dashboard

                    </a>

                    <a href="{{ route('bookings.index') }}"
                        class="font-semibold text-gray-700 hover:text-teal-600 transition">

                        Bookings

                    </a>

                @endauth

            </div>

            <!-- User -->
            <div class="hidden sm:flex items-center gap-4">

                @auth

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold">

                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                            </div>

                            <div class="text-left">

                                <div class="font-semibold">

                                    {{ Auth::user()->name }}

                                </div>

                                <div class="text-xs text-gray-500">

                                    {{ ucfirst(Auth::user()->role) }}

                                </div>

                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        @if(Route::has('profile.edit'))

                        <x-dropdown-link :href="route('profile.edit')">

                            Profile

                        </x-dropdown-link>

                        @endif

                        <form method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

                @endauth

            </div>

            <!-- Mobile Button -->

            <div class="sm:hidden">

                <button @click="open=!open">

                    <i class="fa-solid fa-bars text-2xl"></i>

                </button>

            </div>

        </div>

    </div>

    <!-- Mobile Menu -->

    <div x-show="open"
        class="sm:hidden bg-white border-t">

        @auth

        <div class="p-5 border-b">

            <div class="font-bold">

                {{ Auth::user()->name }}

            </div>

            <div class="text-sm text-gray-500">

                {{ Auth::user()->email }}

            </div>

        </div>

        <div class="p-5 space-y-4">

            <a href="{{ Auth::user()->role==='admin'
                    ? url('/admin/dashboard')
                    : route('dashboard') }}">

                Dashboard

            </a>

            <a href="{{ route('bookings.index') }}">

                Bookings

            </a>

            <form method="POST"
                action="{{ route('logout') }}">

                @csrf

                <button class="text-red-600">

                    Logout

                </button>

            </form>

        </div>

        @endauth

    </div>

</nav>