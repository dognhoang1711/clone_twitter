@auth
<h3>chia sẻ ý tưởng</h3>
<div class="row">
    <form action="{{ route('ideas.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <textarea class="form-control" id="idea" rows="3" name="content"></textarea>
        </div>
        @error('content')
        <span class="text-danger">{{$message}}</span>
        @enderror
         <div class="">
            <button class="btn btn-dark" type="submit"> Share </button>
        </div>
    </form>
</div>
@endauth
@guest
    <h3>đăng nhập để chia sẻ ý tưởng</h3>
@endguest
