@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h2>S3 Bucket Image</h2>
            <div class="flex-column">
                <a href="{{ route('buckets.create') }}" class="btn btn-success rounded-pill">
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
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buckets as $bucket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{  $bucket->image }}" alt="" height="60px"
                                            width="80px">
                                    </td>
                                    <td class="" style="position: relative;">
                                        <div class="">
                                            <a href="{{ route('buckets.edit', $bucket) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                        <form action="{{ route('buckets.destroy', $bucket) }}" method="post"
                                            class="" style="position: absolute; top: 8%; right: 80%">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you want to sure Removed?')">
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
                    <div>{{ $buckets->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
