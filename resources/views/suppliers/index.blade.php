@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>Supplier</h2>
            <div class="flex-column">
                <a href="{{ route('suppliers.create') }}"
                   class="btn btn-success rounded-pill">
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
                            <th>Supplier Name</th>
                            <th>Assigned Product</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>
                                    @foreach ($supplier->products as $product)
                                        {{ $product->name }}
                                        @continue($loop->last),
                                    @endforeach
                                </td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td class="d-flex">
                                    <div class="flex-column me-1">
                                        <a href="{{ route('suppliers.assign-product.form', $supplier) }}"
                                           class="btn btn-dark btn-sm">
                                           <i class="fa fa-shield"></i>
                                        </a>
                                    </div>
                                    <div class="flex-column me-1">
                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}"
                                          method="post"
                                          class="flex-column">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                                id="delete"
                                                class="btn btn-danger btn-sm">
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
                    <div>{{ $suppliers->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
