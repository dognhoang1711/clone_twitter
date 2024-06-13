@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.side-bar')
        </div>
        <div class="col-9">
            <h1>Ideas</h1>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">người tạo ý tưởng</th>
                            <th scope="col">content</th>
                            <th scope="col">ngày tạo</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($idea as $ideas)
                            <tr>
                                <td>{{ $ideas->id }}</td>
                                <td>{{ $ideas->user->name }}</td>
                                <td>{{ $ideas->content }}</td>
                                <td>{{ $ideas->created_at }}</td>
                                <td>
                                    <form action="{{ route('ideas.destroy', $ideas->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger">xóa idea</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $idea->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
