@extends('templates/layout')

@section('title')
    Tutorial: {{ $tutorial->title }}
@endsection

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="mt-1 mb-3">
        <div class="row mt-3">
            <div class="col text-start">
                <a href="{{ route('tutorials.index') }}" class="btn btn-secondary">Back</a>
            </div>
            
            <div class="col text-end">
                @if(Auth::check())
                    <form action="{{ route('tutorials.bookmark', ['id' => $tutorial->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            @php
                                $isBookmarked = false;
                                foreach ($tutorial->users as $user) {
                                    if ($user->pivot->user_id === Auth::id()) {
                                        $isBookmarked = true;
                                        break;
                                    }
                                }
                            @endphp
                            @if ($isBookmarked)
                                Unbookmark
                            @else
                                Bookmark
                            @endif
                        </button>
                    </form>
                @endif
                @if(Auth::check() && Auth::user()->id === $tutorial->user->id)
                    <form action="{{ route('tutorials.delete', ['id' => $tutorial->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="text-center">
            <h1>{{ $tutorial->title }}</h1>
            <p>Posted by: {{ $tutorial->user->name }}</p>
            <p><em> Posted on <?php echo date_format(date_create($tutorial->created_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->created_at), 'g:i A'); ?></em></p>
            <p><em> Last updated on <?php echo date_format(date_create($tutorial->updated_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->updated_at), 'g:i A'); ?></em></p>
            <img src="{{ $tutorial->photo_url }}" alt="Tutorial Photo" style="width: 50%; height: 400px;">
        </div>

        <h2 class="mt-3">Lesson</h2>
        <p class="mt-3">{{ $tutorial->body }}</p>
        <h2 class="mt-5">Tips</h2>
        <ul>
            <li class="mb-5">{{ $tutorial->tips }}</li>
        </ul>
    </div>
@endsection