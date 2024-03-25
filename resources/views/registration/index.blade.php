@extends('templates/layout')

@section('title', 'Register')

@section('main')
    <h3 class="mt-3 text-center">Register</h3>
    
    <form method="post" action="{{ route('registration.create') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="name">Full name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        @error('name')
            <div class="mb-3"><small class="text-danger">{{ $message }}</small></div>
            <div>
                <ul><li class="text-danger">Need a space. Full name needed.</li></ul>
            </div>
        @enderror

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
            <div>
                <ul><li class="text-danger">Need at least one special character and number.</li></ul>
            </div>
        @enderror

        <input type="submit" value="Register" class="btn btn-primary">
    </form>
@endsection