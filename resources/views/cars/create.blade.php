@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Create Car</h4>
                <form action="{{ route('cars.store') }}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-3">
                        <label for="title">Title</label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="driver_id">Driver</label>
                        <select name="driver_id"
                                id="driver_id"
                                class="form-control"
                                required>
                            <option value=""
                                    selected
                                    disabled>Please Select...
                            </option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}"
                                        @if(old('driver_id') === $driver->id) selected @endif>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('driver_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="car_number">Car Number</label>
                        <input type="number"
                               step="1"
                               min="1"
                               name="car_number"
                               id="car_number"
                               class="form-control"
                               value="{{ old('car_number') }}"
                               required>
                        @error('car_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="model">Model</label>
                        <input type="text"
                               step="1"
                               min="1"
                               name="model"
                               id="model"
                               class="form-control"
                               value="{{ old('model') }}">
                        @error('model')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="price">Price</label>
                        <input type="number"
                               step="0.01"
                               min="1"
                               name="price"
                               id="price"
                               class="form-control"
                               value="{{ old('price') }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="cover_image">Image</label>
                        <input type="file"
                               name="cover_image"
                               id="cover_image"
                               class="form-control"
                               value="{{ old('cover_image') }}">
                        @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <a href="{{ route('cars.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
