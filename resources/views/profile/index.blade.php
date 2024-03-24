@extends('templates/layout')

@section('title', 'Profile')

@section('main')
    <h3 class="mt-3">{{ $user->name }}</h3>

    <p>Email: {{ $user->email }}</p>
@endsection