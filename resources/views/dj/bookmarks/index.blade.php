@extends('templates/layout')

@section('title', 'Bookmarked Tutorials')

@section('main')
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-center mt-4">Bookmarked Tutorials</h3>
        @if(count($bookmarks) > 0)
                <div class="row row-cols-1 row-cols-md-3 mt-4">
                    @foreach($bookmarks as $tutorial) 
                        <div class="col">
                            <a href="{{ route('tutorials.show', ['id' => $tutorial->id]) }}" class="card-link" style="text-decoration: none;">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img src="{{ $tutorial->photo_url }}" class="card-img" alt="Tutorial Image"
                                        style="width: 100%; height: 200px;">
                                        <h5 class="card-title mt-3">{{ $tutorial->title }}</h5>
                                        <p class="card-text">Author: {{ $tutorial->user->name }}</p>
                                        <p class="card-text"><em> Bookmarked on <?php echo date_format(date_create($tutorial->pivot->created_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->pivot->created_at), 'g:i A'); ?></em></p>
                                    </div>
                                    <div class="col text-start m-3">
                                        <form action="{{ route('bookmarks.unbookmark', ['id' => $tutorial->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Unbookmark</button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <h5 class="mt-3 text-center">No bookmarked dj tutorials created yet. Please browse and bookmark your favorite dj tutorials after logging in!</h5>
            @endif
    </div>
@endsection