@extends('templates/layout')

@section('title', 'DJ Tutorials')

@section('main')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-3">
        <div class="d-grid">
            <a href="{{ route('tutorials.create') }}" class="btn btn-primary btn-lg btn-block p-3">Create</a>
        </div>
        <div>
            @if(count($tutorials) > 0)
                <div class="row row-cols-1 row-cols-md-3 mt-4">
                    @foreach($tutorials as $tutorial)
                        <div class="col mb-4">
                            <a href="{{ route('tutorials.show', ['id' => $tutorial->id]) }}" class="card-link" style="text-decoration: none;">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <img src="{{ $tutorial->photo_url }}" class="card-img" alt="DJ Tutorial Image"
                                        style="width: 100%; height: 200px;">
                                        <h5 class="card-title mt-3">{{ $tutorial->title }}</h5>
                                        <p class="card-text">Author: {{ $tutorial->user->name }}</p>
                                        <p class="card-text"><em> Posted on <?php echo date_format(date_create($tutorial->created_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->created_at), 'g:i A'); ?></em></p>
                                        <p class="card-text"><em> Last updated on <?php echo date_format(date_create($tutorial->updated_at), 'n/j/Y'); ?> at <?php echo date_format(date_create($tutorial->updated_at), 'g:i A'); ?></em></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div>No dj tutorials created yet. Please log in and create one!</div>
            @endif
        </div>
    </div>
@endsection