@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>CAR</h2>
            <div class="flex-column">
                <a href="{{ route('cars.create') }}"
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
                            <th>Image</th>
                            <th>Driver Name</th>
                            <th>Car Name</th>
                            <th>Car Number</th>
                            <th>Model</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ route('cars.image', $car) }}"
                                         width="35px"
                                         height="auto"
                                         alt="cover">
                                </td>
                                <td>{{ $car->driver->name }}</td>
                                <td>{{ $car->title }}</td>
                                <td>{{ $car->car_number }}</td>
                                <td>{{ $car->model }}</td>
                                <td>{{ $car->price }}</td>
                                <td class="d-flex">
                                    <div class="flex-column me-1">
                                        <a href="{{ route('cars.edit', $car) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <form action="{{ route('cars.destroy', $car) }}"
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
                    <div>{{ $cars->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
