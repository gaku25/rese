<x-guest-layout>
    <div class="header-nav">
        <input id="drawer_input" class="drawer_hidden" type="checkbox">
        <label for="drawer_input" class="drawer_open">
            <span>
            </span>
        </label>
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

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>    

        <div class="tilte__login">Register</div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="post" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <span class="select-icon_user"></span>
                <x-input id="name" class="block mt-1 w-full border-text" type="text" name="name" :value="old('name')" required autofocus placeholder="Usemame"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <span class="select-icon_email"></span>
                <x-input id="email" class="block mt-1 w-full border-text" type="email" name="email" :value="old('email')" required placeholder="Email"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <span class="select-icon_pass"></span>
                <x-input id="password" class="block mt-1 w-full border-text"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Password" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4 btn-4">
                    {{ __('登録') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
