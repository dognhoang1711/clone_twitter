@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.side-bar')
        </div>
        <div class="col-9">
            <h1>User</h1>
            <div class="table-responsive">
                <form action="{{ route('admin.authorize.post') }}" method="post">
                    @csrf
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
                            @foreach ($dataUser as $users)
                                <tr>
                                    <td>{{ $users->id }}</td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->created_at }}</td>

                                    <td>
                                        @if ($users->id !== Auth::user()->id)
                                            <input type="hidden" name="is_admin[{{ $users->id }}]" value="false">
                                            <!-- Checkbox input true if checked -->
                                            <input type="checkbox" name="is_admin[{{ $users->id }}]" value="true"
                                                {{ $users->is_admin ? 'checked' : '' }}>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <button type="submit">update quyền</button>
                    </table>
                </form>
                <div>
                    {{ $dataUser->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
