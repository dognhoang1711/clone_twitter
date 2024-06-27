@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>udpate role
                            <a href="{{ url('role') }}"><button class="bnt btn-success float-end">back</button></a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('role.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">role name</label>
                                <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-danger" type="submit">update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
