@extends('templates/layout')

@section('title')
    Create Review for '{{ $preSelectedTutorial->title }}'
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <a href="{{ route('tutorials.show', ['id' => $preSelectedTutorial->id]) }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="text-center">
                            <h3 class="text-center mt-3">Create Tutorial Review</h3>
                        </div>
                    </div>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tutorial" class="form-label">Tutorial</label>
                            <select name="tutorial" id="tutorial" class="form-select">
                                <option value="">-- Select tutorial --</option>
                                @foreach ($tutorials as $tutorial)
                                    <option
                                        value="{{ $tutorial->id }}"
                                        {{ (string) $tutorial->id === (string) old('tutorial', $preSelectedTutorial->id) ? "selected" : "" }}
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
                            <textarea rows="4" name="body" id="body" class="form-control">{{ old('body') }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="1" {{ (string) old('rating') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5</option>
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