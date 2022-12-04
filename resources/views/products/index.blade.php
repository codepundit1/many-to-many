@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>Products</h2>
            <div class="flex-column">
                <a href="{{ route('products.create') }}" class="btn btn-success rounded-pill">
                    <i class="fa fa-plus"></i>
                    Create
                </a>
            </div>
        </div>
        <br>
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Assigned Supplier</th>
                                {{-- <th>Description</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @foreach ($product->suppliers as $supplier)
                                            <span class="badge rounded-pill bg-success py-2 px-4"
                                                style="position: relative">
                                                {{ $supplier->name }}
                                                <form
                                                    action="{{ route('products.remove-supplier', ['product' => $product, 'supplier'=>$supplier]) }}"
                                                    style="position: absolute; top: 25%; right: 0" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        {{-- id="delete" --}}
                                                        style="border: 0; background: transparent; color: white"
                                                        onclick="return confirm('Are you want to sure Remove Product?')">
                                                        <i class="fa fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            </span>

                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $product->description }}</td> --}}
                                    <td class="d-flex">
                                        <div class="flex-column me-1">
                                            <a href="{{ route('products.assign-supplier.form', $product) }}"
                                                class="btn btn-dark btn-sm">
                                                <i class="fa fa-shield"></i>
                                            </a>
                                        </div>
                                        <div class="flex-column me-1">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <form action="{{ route('products.destroy', $product) }}" method="post"
                                            class="flex-column">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" id="delete" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    <div>{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
