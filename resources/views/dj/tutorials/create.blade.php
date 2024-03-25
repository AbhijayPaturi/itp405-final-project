@extends('templates/layout')

@section('title', 'Create DJ Tutorial')

@section('main')
    <h3 class="mt-4">New Tutorial</h3>  
    
    <form action="{{ route('tutorials.store', ['userId' => Auth::user()->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tutorial Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo_url" class="form-label">Tutorial Photo URL</label>
            <input type="text" name="photo_url" id="photo_url" class="form-control" value="{{ old('photo_url') }}">
            @error('photo_url')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Tutorial Main Body</label>
            <textarea rows="4" name="body" id="body" class="form-control">{{ old('body') }}</textarea>
            @error('body')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tips" class="form-label">Tutorial Tips</label>
            <textarea rows="2" name="tips" id="tips" class="form-control">{{ old('tips') }}</textarea>
            @error('tips')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection('main')