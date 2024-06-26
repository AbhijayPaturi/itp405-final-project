@extends('templates/layout')

@section('title')
    Edit Tutorial '{{ $tutorial->title }}'
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('tutorials.show', ['id' => $tutorial->id]) }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="text-center">
                            <h3 class="mt-3">New Tutorial</h3>
                        </div>
                    </div>
                    
                    <form action="{{ route('tutorials.update', ['id' => $tutorial->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Tutorial Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $tutorial->title) }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo_url" class="form-label">Tutorial Photo URL</label>
                            <input type="text" name="photo_url" id="photo_url" class="form-control" value="{{ old('photo_url', $tutorial->photo_url) }}">
                            @error('photo_url')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Tutorial Main Body</label>
                            <textarea rows="4" name="body" id="body" class="form-control">{{ old('body', $tutorial->body) }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tips" class="form-label">Tutorial Tips</label>
                            <textarea rows="2" name="tips" id="tips" class="form-control">{{ old('tips', $tutorial->tips) }}</textarea>
                            @error('tips')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('main')