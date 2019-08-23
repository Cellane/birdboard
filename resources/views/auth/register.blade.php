@extends('layouts.app')

@section('content')
<form
    action="{{ route('register') }}"
    method="post"
    class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow"
>
    @csrf

    <h1 class="text-2xl font-normal mb-10 text-center">Register</h1>

    <div class="field mb-6">
        <label for="name" class="label text-sm mb-2 block">Name</label>

        <div class="control">
            <input
                type="text"
                name="name"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full {{ $errors->has('name') ? 'is-invalid' : '' }}"
                value="{{ old('name') }}"
                required
                autofocus
            >
        </div>
    </div>

    <div class="field mb-6">
        <label for="email" class="label text-sm mb-2 block">Email Address</label>

        <div class="control">
            <input
                type="email"
                name="email"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full {{ $errors->has('email') ? 'is-invalid' : '' }}"
                value="{{ old('email') }}"
                required
            >
        </div>
    </div>

    <div class="field mb-6">
        <label for="email" class="label text-sm mb-2 block">Password</label>

        <div class="control">
            <input
                type="password"
                name="password"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full {{ $errors->has('password') ? 'is-invalid' : '' }}"
                required
            >
        </div>
    </div>

    <div class="field mb-6">
        <label for="email" class="label text-sm mb-2 block">Confirm Password</label>

        <div class="control">
            <input
                type="password"
                name="password_confirmation"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                required
            >
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link mr-2">Register</button>
        </div>
    </div>
</form>
@endsection
