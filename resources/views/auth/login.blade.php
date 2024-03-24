@extends('templates/layout')

@section('title', 'Login')

@section('main')

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h3 class="mt-3">Login</h3>

    <form class="mt-3" method="post" action="{{ route('auth.login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        @error('email')
            <div class="mb-3"><small class="text-danger">{{ $message }}</small></div>
        @enderror

        <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        @error('password')
            <div class="mb-3"><small class="text-danger">{{ $message }}</small></div>
        @enderror
        <input type="submit" value="Login" class="btn btn-primary">
    </form>
@endsection