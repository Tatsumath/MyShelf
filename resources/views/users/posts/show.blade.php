@extends('layouts.app')


@section('title', 'Show post')

@section('content')
    <div class="row border shadow">
        <div class="col border-end p-0">
            <img src="{{ asset('/storage/images/' . $post->image) }}" alt="{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- #icon --}}
                            @if (Auth::user()->avatar)
                                <img src="#" alt="#">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </div>
                        <div class="col ps-0">
                            {{-- name --}}
                            <a href="#" class="text-decoration-none text-dark">{{ $post->user->name }}</a>
                        </div>
                        <div class="col-auto">
                            {{-- edit or delete / follow/unfollow --}}
                            <div class="dropdown">
                                <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>

                                @if (Auth::user()->id === $post->user->id)
                                    <div class="dropdown-menu">
                                        <a href="{{ route('posts.edit',$post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>

                                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>


                                    </div>
                                @else
                                    <div class="dropdown-menu">
                                        <form action="#" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                                        </form>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body w-100">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            {{-- like button --}}
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="btn btn-sm shadow-none p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>

                        </div>
                        <div class="col-auto px-0">
                            {{-- like counter --}}
                            <span>3</span>
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
                </div>
            </div>
        </div>
    </div>
@endsection
