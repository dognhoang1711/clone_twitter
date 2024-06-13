<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">top 5 người nhiều idea</h5>
    </div>
    @foreach ($topIdea as $count)
        <div class="card-body">
            <div class="hstack gap-2 mb-3">
                <div class="avatar">
                    <a href="#!"><img style="width: 50px;" class="avatar-img rounded-circle" src="{{ asset('storage/' . $count->image) }}"
                            alt=""></a>
                </div>
                <div class="overflow-hidden">
                    <a class="h6 mb-0" href="#!">{{ $count->name }}</a>
                    <p class="mb-0 small text-truncate">{{ $count->email }}</p>
                </div>
                <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="#"><i
                        class="fa-solid fa-plus">
                    </i></a>
            </div>
        </div>
    @endforeach
</div>
