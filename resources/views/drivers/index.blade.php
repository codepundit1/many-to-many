@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>DRIVERS</h2>
            <div class="flex-column">
                <a href="{{ route('drivers.create') }}"
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
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Registration No.</th>
                            <th>NID No.</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->phone }}</td>
                                <td>{{ $driver->email }}</td>
                                <td>{{ $driver->address }}</td>
                                <td>{{ $driver->registration_no }}</td>
                                <td>{{ $driver->nid_no }}</td>
                                <td class="d-flex">
                                    {{-- <div class="flex-column me-1">
                                        <a href="{{ route('drivers.show', $driver) }}"
                                           class="btn btn-dark btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div> --}}
                                    <div class="flex-column me-1">
                                        <a href="{{ route('drivers.edit', $driver) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('drivers.destroy', $driver) }}"
                                          method="post"
                                          class="flex-column">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
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
                    <div>{{ $drivers->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
