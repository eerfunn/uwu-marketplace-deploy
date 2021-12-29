<x-guest-layout>
    @section('title')
    Login
    @endsection
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
        <div class="page-content page-auth">
            <div class="section-store-auth" data-aos="fade-up">
                <div class="container">
                    <div class="row align-items-center row-login">
                        <div class="col-lg-6 text-center">
                            <img
                                src="images/login-placeholder.png"
                                alt=""
                                class="w-50 mb-4 mb-lg-none"
                            />
                        </div>
                        <div class="col-lg-5">
                            <h2>
                                Belanja kebutuhan <br />
                                menjadi lebih mudah
                            </h2>
                            <x-auth-validation-errors class="mb-4" style="color: red" :errors="$errors" />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group">
                                    <x-label for="email" :value="__('Email')"/>

                                    <x-input id="email" class="form-control w-75" type="email" name="email" :value="old('email')" required autofocus />
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <x-label for="password" :value="__('Password')"/>

                                    <x-input id="password" class="form-control w-75"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="current-password" />
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                            {{ __('Not Registered Yet?') }}
                                        </a>
                                    {{-- @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif --}}

                                    <x-button class="btn btn-success btn-block w-75 mt-4">
                                        {{ __('Log in') }}
                                    </x-button>
                                    {{-- <a
                                        href="/register"
                                        class="btn btn-signup btn-block w-75 mt-2"
                                        >Sign Up Instead</a
                                    > --}}
                                            </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </x-auth-card>
</x-guest-layout>
