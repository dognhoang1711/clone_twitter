@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.side-bar')
        </div>
        <div class="col-9">
            <h1>User</h1>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">tên</th>
                            <th scope="col">email</th>
                            <th scope="col">ngày tạo</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                            <tr>
                                <td>{{ $users->id }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->created_at }}</td>
                                <td><a href="{{ route('users.show', $users) }}">xem</a><a
                                        href="{{ route('users.edit', $users) }}"> sửa</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $user->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
