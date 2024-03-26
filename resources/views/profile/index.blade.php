@extends('templates/layout')

@section('title', 'Profile')

@section('main')

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-4">
        <div class="col text-center">
            <h3 class="mt-3">Profile Details</h3>
            <p class="mt-3">Full Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
        </div>
        <div class="col text-center" style="border-left: 3px solid black;">
            <h3 class="mt-3">Profile Statistics</h3>
            <p class="mt-3">Total number of tutorials created: <span class="text-success">{{ count($tutorials) }}</span></p>
            <p>Total number of reviews posted: <span class="text-success">{{ count($reviews) }}</span></p>
        </div>
    </div>
@endsection