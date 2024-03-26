@extends('templates/layout')

@section('title', 'Register')

@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-3">Register</h3>
                        <form method="post" action="{{ route('registration.create') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Full name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    <div>
                                        <ul><li class="text-danger">Need a space. Full name needed.</li></ul>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    <div>
                                        <ul><li class="text-danger">Need at least one special character and number.</li></ul>
                                    </div>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection