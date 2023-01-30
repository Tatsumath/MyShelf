@extends('layouts.app')

@section('content')
    <div class="row gx-5">
        <div class="col-8 ">

            @forelse ($all_posts as $post)

                <div class="card mb-4">
                    {{-- header --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2 class="">Share Photos</h2>
                    <p class="text-muted">
                        When you share photos, they'll appear on your profile
                    </p>
                    <a href="{{ route('posts.create') }}" class="text-decoration-none">Share your first photo</a>

                </div>
            @endforelse
        </div>
        <div class="col-4">
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">

            </div>
            {{-- @if ($suggested_users)
                <div class="row">
                    <div class="col-auto">
                        <p class="fw-bold texxt-secondary">
                            Suggestions For You
                        </p>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="fw-bold text-dark text-decoration-none">
                            See all
                        </a>
                    </div>
                </div>

                @foreach ($suggested_users as $user)
                    <div class="row align-items center mb-3">
                        <div class="col-auto">
                            <a href="#">
                                @if ($user->avatar)
                                    <a href="#">
                                        <img src="{{ asset('/storage/avatars/'.$user->avatar) }}" class="rounded-circle avatar-sm" alt="">
                                    </a>
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0 text-truncate">
                            <a href="#" class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                        </div>
                        <div class="col-auto">
                            <form action="{{ route('follow.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif --}}
        </div>
    </div>
@endsection
