@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Create Image</h4>
                <form action="{{ route('private-images.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}"
                            required>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <a href="{{ route('private-images.index') }}" class="btn btn-secondary">Back</a>
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
