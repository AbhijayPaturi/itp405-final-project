@extends('templates/layout')

@section('title', 'Home Page')

@section('main')
    <div>
         <h3 class="text-center mt-3">
            <a href="/" class="text-dark">Welcome to the DJ Learning Center</a>
        </h3>
        <div class="row mt-5 text-center align-items-center">
            <div class="col-6">
                <h2>Tutorials</h2>
                <p>You want to become a DJ? I know you do. I did too. But I didn't know where to start from. Hence, this web application. Browse through tutorials to get started on your DJ career. All you need to learn are these tricks to be able to start DJing at events!</p>
            </div>
            <div class="col-6">
                <a href="{{ route('tutorials.index') }}" class="btn btn-primary">Browse</a>
            </div>
        </div>
        <hr class="my-5">
        <div class="row mt-5 text-center align-items-center">
            <div class="col-6">
                <a href="{{ route('tutorials.index') }}" class="btn btn-primary">Write a Review</a>
            </div>
            <div class="col-6">
                <h2>Reviews</h2>
                <p>Saw a tutorial you loved? Write a review. Let others know what type of songs work best for the transition.</p>
            </div>
        </div>
        <hr class="my-5">
        <div class="row mt-5 text-center align-items-center">
            <div class="col-6">
                <h2>Bookmarks</h2>
                <p>Bookmark your favorite tutorials so you can come back to them faster!</p>
            </div>
            <div class="col-6">
                <a href="{{ route('bookmarks.index') }}" class="btn btn-primary">Bookmarks</a>
            </div>
        </div>
    </div>
@endsection