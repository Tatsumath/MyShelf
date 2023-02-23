<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <img src="{{ asset('/storage/avatars/'.$user->avatar) }}" alt="" class="img-thumbnail rounded-circle avatar-lg d-block mx-auto">
        @else
            <i class="fa-solid fa-circle-user text-center d-block icon-lg text-secondary"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">
                    {{ $user->name }}
                </h2>
            </div>
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit', $user->id) }}"
                        class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                @else
                    <form action="#" method="post">
                        @csrf

                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                    </form>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong> posts
                </a>
            </div>
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>3</strong> Followers
                </a>
            </div>
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>3</strong> Following
                </a>
            </div>
        </div>
        <p class="fw-bold">
            @if ($user->introduction)
                {{ $user->introduction }}
            @else
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo consectetur maiores consequuntur nemo,
                itaque facere ullam sed dolorum animi cumque odit nesciunt velit quia, a pariatur quaerat, alias numquam
                ut?
            @endif
        </p>
    </div>
</div>
