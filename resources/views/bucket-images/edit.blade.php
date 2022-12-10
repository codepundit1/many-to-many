@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Edit Image</h4>
                <form action="{{ route('buckets.update',$bucket) }}"
                      method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @if ($bucket)
                        <img src="{{  $bucket->image }}" alt="" height="60px" width="80px">
                    @endif
                    <div class="form-group my-3">
                        <label for="image">Image</label>
                        <input type="file"
                               name="image"
                               id="image"
                               class="form-control"
                               value="{{ $bucket->image }}"
                               required>
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <a href="{{ route('buckets.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection