@extends('templates/layout')

@section('title', 'Create DJ Tutorial')

@section('main')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col">
                            <a href="{{ route('tutorials.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="text-center">
                            <h3 class="text-center mt-3">New Tutorial</h3>
                        </div>
                    </div>
                    <form action="{{ route('tutorials.store') }}" method="POST">
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

                        <div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection('main')