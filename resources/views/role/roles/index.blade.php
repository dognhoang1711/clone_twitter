@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>Role
                        <a href="{{ url('role/create') }}" class="bnt btn-primary float-end">create role</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $items)
                                    <tr>
                                        <td>{{ $items->id }}</td>
                                        <td>{{ $items->name }}</td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('role.edit', $items->id) }}"
                                                class="btn btn-success me-2">Edit</a>
                                            <a href="{{ route('add_permission', $items->id) }}"
                                                class="btn btn-warning me-2">Add Permission</a>

                                            <form action="{{ route('role.destroy', $items->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có muốn xóa role không?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
