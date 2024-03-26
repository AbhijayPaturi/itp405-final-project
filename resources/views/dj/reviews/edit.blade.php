@extends('templates/layout')

@section('title')
    Edit Review for {{ $review->tutorial->title }}
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('tutorials.show', ['id' => $review->tutorial->id]) }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="text-center">
                            <h3 class="mt-3">Edit Tutorial Review</h3>
                        </div>
                    </div>
                    
                    <form action="{{ route('reviews.update', ['id' => $review->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tutorial" class="form-label">Tutorial</label>
                            <select name="tutorial" id="tutorial" class="form-select">
                                <option value="">-- Select tutorial --</option>
                                @foreach ($tutorials as $tutorial)
                                    <option
                                        value="{{ $tutorial->id }}"
                                        {{ (string) $tutorial->id === (string) old('tutorial', $review->tutorial->id) ? "selected" : "" }}
                                    >
                                        {{ $tutorial->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tutorial')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Review</label>
                            <textarea rows="4" name="body" id="body" class="form-control">{{ old('body', $review->body) }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="1" {{ (string) old('rating', $review->rating) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('rating', $review->rating) == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('rating', $review->rating) == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('rating', $review->rating) == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('rating', $review->rating) == '5' ? 'selected' : '' }}>5</option>
                            </select>
                            @error('rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection