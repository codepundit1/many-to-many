@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Assign Product</h4>
                <form action="{{ route('suppliers.assign-product', $supplier) }}"
                      method="post">
                    @csrf

                    <div class="form-group my-3">
                        <label for="product_id">Product</label>
                        <select name="product_id"
                                id="product_id"
                                class="form-control"
                                >
                            <option value=""
                                    selected
                                    disabled>Please Select...
                            </option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                        @if(old('product_id') === $product->id) selected @endif>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group my-3">
                        <label for="royalty">Royalty</label>
                        <input type="number"
                               name="royalty"
                               id="royalty"
                               min="1"
                               class="form-control"
                               step="0.01"
                               value="{{ old('royalty') }}"
                               required>
                        @error('royalty')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="form-group my-3">
                        <a href="{{ route('suppliers.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-success">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
