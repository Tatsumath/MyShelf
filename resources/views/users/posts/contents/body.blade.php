{{-- clickable image --}}

<div class="container p-0">
    <a href="{{ route('posts.show', $post->id) }}">
        <img src="{{ asset('/storage/images/' . $post->image) }}" class="w-100" alt="{{ $post->image }}">
    </a>
</div>
{{-- displaying the description, like button, categories --}}
<div class="card-body">
    <div class="row align-items-center">
        <div class="col-auto">
            {{-- like button --}}
            @if ($post->isLiked())
                <form action="{{ route('like.destroy',$post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-solid text-danger fa-heart"></i>
                    </button>
                </form>
            @else
                <form action="{{ route('like.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button type="submit" class="btn btn-sm shadow-none p-0">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>
            @endif

        </div>
        <div class="col-auto px-0">
            {{-- like counter --}}
            <span>{{ $post->likes->count() }}</span>
        </div>
        <div class="col text-end">
            {{-- categories --}}
            @foreach ($post->categoryPost as $category_post)
                <div class="badge bg-secondary bg-opacity-50">
                    {{ $category_post->category->name }}
                </div>
            @endforeach
        </div>
    </div>

    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $post->user->name }}</a>&nbsp;
    <p class="d-inline fw-light">{{ $post->description }}</p>
    <div class="text-muted xsmall">{{ $post->created_at->diffForHumans() }}</div>
    {{-- comment section in here --}}
    @include('users.posts.comment')
</div>
