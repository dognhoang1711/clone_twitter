@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-3">
          @include('shared.side-bar')
        </div>
        <div class="col-6">
            @include('shared.sucess_mess')
            <h4> Share yours ideas </h4>
            <div class="mt-3">
                @include('shared.idea_card')
            </div>
        </div>
        <div class="col-3">
        @include('shared.search')
        @include('shared.follow')
        </div>
    </div>
@endsection
