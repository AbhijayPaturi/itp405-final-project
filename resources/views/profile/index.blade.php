@extends('templates/layout')

@section('title', 'Profile')

@section('main')
    <h1>{{ $user->name }}</h1>

    <p>Email: {{ $user->email }}</p>
@endsection