@extends("layouts.blank", [
  'bodyClass' => 'layout-login-centered-boxed'
])

@section('content')
{{-- <x-guest-layout> --}}
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Enter your name') }}" />
            </div>

            <div class="form-group">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="{{ __('Enter your email') }}" />
            </div>

            <div class="form-group">
                <x-label for="email" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')" required placeholder="{{ __('Enter your phone number') }}" />
            </div>

            <div class="form-group">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="{{ __('Choose your password') }}" />
            </div>

            <div class="form-group">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm your password') }}" />
            </div>

            <div class="d-flex flex-column text-center">
                <p>
                    <x-button class="btn-block">
                        {{ __('Register') }}
                    </x-button>
                </p>

                {{ __('Already registered?') }} <a class="text-body text-underline" href="{{ route('login') }}">{{ __('Login') }}!</a>
            </div>
        </form>
    </x-authentication-card>
{{-- </x-guest-layout> --}}
@endsection
