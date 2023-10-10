@extends("flowdash::layouts.blank", [
  'bodyClass' => 'layout-login-centered-boxed'
])

@section('content')
{{-- <x-guest-layout> --}}
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <p>
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        @if (session('status'))
            <div class="alert alert-soft-success">
                <strong class="text-body">{{ session('status') }}</strong>
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email') ?? 'contact@mosaicpro.biz'" required autofocus placeholder="{{ __('Enter your email') }}" />
            </div>

            <x-button class="btn-block">
                {{ __('Email Password Reset Link') }}
            </x-button>
        </form>
    </x-authentication-card>
{{-- </x-guest-layout> --}}
@endsection