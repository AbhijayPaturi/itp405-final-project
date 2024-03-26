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
                @if(Auth::check() && Auth::user()->id === $tutorial->user->id)
                    <a href="{{ route('tutorials.edit', ['id' => $tutorial->id]) }}" type="submit" class="btn btn-secondary">Edit</a>
                    <form action="{{ route('tutorials.delete', ['id' => $tutorial->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
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
                        <p class="text-info mt-2">Number of Total Bookmarks (All Users): {{ count($bookmarks) }}</p>
                    </form>
                @endif
            </div>
        </div>

        <div class="col text-center">
            <h1>{{ $tutorial->title }}</h1>
            <p class="mt-4">Posted by: {{ $tutorial->user->name }}</p>
            <p><em> Posted on <?php echo date_format(date_create($tutorial->created_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->created_at), 'g:i A'); ?></em></p>
            <p><em> Last updated on <?php echo date_format(date_create($tutorial->updated_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->updated_at), 'g:i A'); ?></em></p>
            <img src="{{ $tutorial->photo_url }}" alt="Tutorial Photo" style="width: 50%; height: 400px;">
        </div>

        <h2 class="mt-3">Lesson</h2>
        <p class="mt-3">{{ $tutorial->body }}</p>
        <h2 class="mt-5">Tips</h2>
        <ul class="mb-4">
            <li>{{ $tutorial->tips }}</li>
        </ul>
        <hr>
        <div class="row align-text-top mt-4">
            <div class="col text-start">
                <h2 class="">Reviews</h2>
            </div>
            <div class="col text-end">
                <a href="{{ route('reviews.create', ['id' => $tutorial->id]) }}" class="btn btn-primary">Write a Review</a>
            </div>
        </div>
        <ul class="mt-5 mb-5">
            <section>
                @for ($i = 0; $i < count($reviews); $i += 2)
                    <div class="row">
                        @for ($j = $i; $j < min($i + 2, count($reviews)); $j++)
                            <div class="col-md-6 mb-4">
                                <div class="card testimonial-card" style="height: 310px;">
                                    <div class="card-body row">
                                        <div class="col text-start">
                                            <h4 class="mb-4">{{ $reviews[$j]->user->name }}</h4>
                                        </div>
                                        <div class="col text-end">
                                            @if(Auth::check() && Auth::user()->id === $reviews[$j]->user->id)
                                                <a href="{{ route('reviews.edit', ['id' => $reviews[$j]->id]) }}" class="btn btn-secondary">Edit</a>
                                                <form action="{{ route('reviews.delete', ['id' => $reviews[$j]->id]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            @for ($starNum = 1; $starNum < 6; $starNum++)
                                                @if ($starNum <= $reviews[$j]->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <hr class="m-0" />
                                        <p class="mt-2">
                                            {{ $reviews[$j]->body }}
                                        </p>
                                        <p><em> Last updated on <?php echo date_format(date_create($reviews[$j]->updated_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($reviews[$j]->updated_at), 'g:i A'); ?></em></p>
                                        <p><em> Posted on <?php echo date_format(date_create($reviews[$j]->created_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($reviews[$j]->created_at), 'g:i A'); ?></em></p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endfor
            </section>
        </ul>
    </div>
@endsection