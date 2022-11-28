@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Assign Supplier</h4>
                <form action="{{ route('products.assign-supplier', $product) }}"
                      method="post">
                    @csrf

                    <div class="form-group my-3">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id"
                                id="supplier_id"
                                class="form-control"
                                >
                            <option value=""
                                    selected
                                    disabled>Please Select...
                            </option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                        @if(old('supplier_id') === $supplier->id) selected @endif>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
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
                        <a href="{{ route('products.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-success">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
