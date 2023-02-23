<div class="card-header bg-white py-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route('profile.show', $post->user->id) }}">
                {{-- #icon --}}
                @if (Auth::user()->avatar)
                    <img src="{{ asset('/storage/avatars/' . $post->user->avatar) }}" alt="#"
                        class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                @endif
            </a>
        </div>
        <div class="col ps-0">
            {{-- name --}}
            <a href="{{ route('profile.show', $post->user->id) }}"
                class="text-decoration-none text-dark">{{ $post->user->name }}</a>
        </div>
        <div class="col-auto">
            {{-- edit or delete / follow/unfollow --}}
            <div class="dropdown">
                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                @if (Auth::user()->id === $post->user->id)
                    <div class="dropdown-menu">
                        <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>

                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#delete-post-{{ $post->id }}">

                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>



                    </div>
                    @include('users.posts.contents.modal.delete')
                @else
                    <div class="dropdown-menu">
                        @if ($post->user->isFollowed())
                            <form action="{{ route('follow.destroy',$post->user->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store') }}" method="post">
                                @csrf

                                <input type="hidden" name="following_id" value="{{ $post->user->id }}">
                                <button type="submit" class="dropdown-item text-primary">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
