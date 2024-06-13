<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="{{ asset('storage/' . $idea->user->image) }}" alt="Mario Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>

            </div>
            <div>
                @can('idea.update', $idea)
                    <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">x</button>
                    </form>
                    <a href="{{ route('ideas.edit', $idea->id) }}">edit</a>
                @endcan
                <a href="{{ route('ideas.show', $idea->id) }}">view</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editting ?? false)
            <form action="{{ route('ideas.update', $idea->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea class="form-control" id="idea" rows="3" name="content">{{ $idea->content }}</textarea>
                </div>
                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="">
                    <button class="btn btn-dark" type="submit"> update idea </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            <div>
                <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $idea->like }} </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at }} </span>
            </div>
        </div>
        @include('shared.comment')
    </div>
</div>
