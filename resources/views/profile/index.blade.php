@extends('templates/layout')

@section('title', 'Profile')

@section('main')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <h3 class="mt-3">{{ $user->name }}</h3>

    <p>Email: {{ $user->email }}</p>
@endsection