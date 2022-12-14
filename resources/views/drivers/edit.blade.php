@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Edit Driver</h4>
                <form action="{{ route('drivers.update', $driver) }}"
                      method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group my-3">
                        <label for="name">Title</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               value="{{ old('name') ?? $driver->name }}"
                               required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               value="{{ old('email') ?? $driver->email }}"
                               required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="phone">Phone</label>
                        <input type="text"
                               name="phone"
                               id="phone"
                               class="form-control"
                               value="{{ old('phone') ?? $driver->phone }}"
                               required>
                        @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="address">Address</label>
                        <textarea name="address"
                                  id="address"
                                  class="form-control"
                                  required>{{ old('address') ?? $driver->address }}</textarea>
                        @error('address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="registration_no">Registration Number</label>
                        <input type="text"
                               name="registration_no"
                               id="registration_no"
                               class="form-control"
                               value="{{ old('registration_no') ?? $driver->registration_no }}">
                        @error('registration_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <label for="nid_no">NID Number</label>
                        <input type="text"
                               name="nid_no"
                               id="nid_no"
                               class="form-control"
                               value="{{ old('nid_no') ?? $driver->nid_no }}">
                        @error('nid_no')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-3">
                        <a href="{{ route('drivers.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
