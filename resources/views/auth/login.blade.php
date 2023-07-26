<x-guest-layout>
    <div class="header-nav">
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
        <label for="drawer_input" class="drawer_open"><span></span></label>
        <nav class="nav_content">
            <ul class="nav_list">
            <li class="nav_item">
                <a href="http://127.0.0.1:8000">
                    Home
                </a>
            </li>
            <li class="nav_item">
                <a href="http://127.0.0.1:8000/register">
                    Registretion
                </a>
            </li>
            <li class="nav_item">
                <a href="http://127.0.0.1:8000/login">
                    Login
                </a>
            </li>
            </ul>
        </nav>
        <div class="logo">
            Rese
        </div>
    </div>

@if (session('message'))
    <div class="login_message">
        {{ session('message') }}
    </div>
@endif

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>    

        <div class="tilte__login">Login</div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="post" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <span class="select-icon_email"></span>
                <x-input id="email" class="block mt-1 w-full border-text" type="email" name="email" :value="old('email')" required autofocus placeholder="Email"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <span class="select-icon_pass"></span>
                <x-input id="password" class="block mt-1 w-full border-text"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="Password"/>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-3 btn-4">
                    {{ __('ログイン') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

</x-guest-layout>
