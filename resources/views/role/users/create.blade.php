@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Create user
                            <a href="{{ url('user') }}"><button class="bnt btn-success float-end">back</button></a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('user') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">user name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" id="" multiple>
                                    <option value="">select role</option>
                                    @foreach ($role as $roles)
                                        <option value="{{ $roles }}">{{ $roles }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-danger" type="submit">save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
