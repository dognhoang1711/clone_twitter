@extends('layouts.layout')
@section('content')
    <div class="row">
       <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create role
                        <a href="{{ url('role') }}" ><button class="bnt btn-success float-end">back</button></a>
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('role') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">permission name</label>
                            <input type="text" name="name" class="form-control">
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
