@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Edit Car</h4>
                <form action="{{ route('cars.update',$car) }}"
                      method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group my-3">
                        <label for="title">Car Name</label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control"
                               value="{{ old('title') ?? $car->title }}"
                               required>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="driver_id">driver</label>
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
                                        @if(old('driver_id')===$driver->id || $car->driver_id === $driver->id) selected @endif>
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
                               name="car_number"
                               id="car_number"
                               class="form-control"
                               value="{{ old('car_number') ?? $car->car_number }}"
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
                               value="{{ old('model') ?? $car->model  }}">
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
                               value="{{ old('price') ?? $car->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        @if($car->cover_image)
                            <img src="{{ route('cars.image', $car) }}"
                                 width="50px"
                                 alt="cover">
                            <br>
                        @endif
                        <label for="cover_image"> Image</label>
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
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
