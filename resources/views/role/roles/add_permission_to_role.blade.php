@extends('layouts.layout')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role:{{ $role->name }}
                            <a href="{{ url('role') }}"><button class="bnt btn-success float-end">back</button></a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_permission_to_role', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Permission</label><br>
                                @foreach ($permission as $permissions)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="permission[]"
                                            value="{{ $permissions->name }}"
                                            {{ in_array($permissions->id, $role_permission) ? 'checked' : '' }}>{{ $permissions->name }}

                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-danger" type="submit">thêm quyền cho chức vụ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
