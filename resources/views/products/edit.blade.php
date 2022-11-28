@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Edit Product</h4>
                <form action="{{ route('products.update',$product) }}"
                      method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group my-3">
                        <label for="name">Product Name</label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               value="{{ $product->name }}"
                               required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="form-group my-3">
                        <label for="publisher_id">Publisher</label>
                        <select name="publisher_id"
                                id="publisher_id"
                                class="form-control"
                                required>
                            <option value=""
                                    selected
                                    disabled>Please Select...
                            </option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                        @if($product->publisher_id') === $publisher->id) selected @endif>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group my-3">
                        <label for="price">Price</label>
                        <input type="number"
                               step="0.01"
                               min="1"
                               name="price"
                               id="price"
                               class="form-control"
                               value="{{ $product->price }}">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="latest_printing_date">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $product->description }}</textarea>
                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <a href="{{ route('products.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
