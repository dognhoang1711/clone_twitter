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
                @include('shared.user_edit_cart')
            </div>
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    @include('shared.idea_card')
                </div>
            @empty
                <p>không có ý tưởng nào </p>
            @endforelse
            {{ $ideas->withQueryString()->links() }}
        </div>
        <div class="col-3">
            @include('shared.search')
            @include('shared.follow')
        </div>
    </div>
@endsection
