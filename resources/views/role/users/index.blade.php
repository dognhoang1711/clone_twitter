@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>user
                        <a href="{{ url('user/create') }}" class="bnt btn-primary float-end">create user</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">role</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $items)
                                    <tr>
                                        <td>{{ $items->id }}</td>
                                        <td>{{ $items->name }}</td>
                                        <td>{{ $items->email }}</td>
                                        <td>
                                            @if (!empty($items->getRoleNames()))
                                                @foreach ($items->getRoleNames() as $rolename)
                                                    <label for=""
                                                        class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td><a href="{{ route('user.edit', $items->id) }}" class="btn btn-success">edit</a>

                                            <form action="{{ route('user.destroy', $items->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
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
