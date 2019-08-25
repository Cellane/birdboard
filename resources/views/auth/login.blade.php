@extends('layouts.app')

@section('content')
<form
    action="{{ route('login') }}"
    method="post"
    class="lg:w-1/2 lg:mx-auto bg-card py-12 px-16 rounded shadow"
>
    @csrf

    <h1 class="text-2xl font-normal mb-10 text-center">Login</h1>

    <div class="field mb-6">
        <label for="email" class="label text-sm mb-2 block">Email Address</label>

        <div class="control">
            <input
                type="email"
                name="email"
                class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email') }}"
                required
            >
        </div>
    </div>

    <div class="field mb-6">
        <label for="password" class="label text-sm mb-2 block">Password</label>

        <div class="control">
            <input
                type="password"
                name="password"
                class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                required
            >
        </div>
    </div>

    <div class="field mb-6">
        <div class="control">
            <input
                type="checkbox"
                name="remember"
                class="form-check-input"
                {{ old('remember') ? 'checked' : '' }}
            >

            <label for="remember" class="text-sm">
                Remember Me
            </label>
        </div>
    </div>

    <div class="field mb-6">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="button mr-2">
                Login
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-default text-sm">
                    Forgot Your Password?
                </a>
            @endif
        </div>
    </div>
</form>
@endsection
