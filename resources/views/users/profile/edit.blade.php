@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('profile.update', $user->id) }}" method="post" class="bg-white shadow rounded-3 p-5" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h2 class="h3 mb-3 fw-light text-muted">
                    Update Profile
                </h2>

                <div class="row mb-3">
                    <div class="col-4">
                        @if ($user->avatar)
                            <img src="{{ asset('/storage/avatars/'.$user->avatar) }}" alt="" class="img-thumnail rounded-circle d-block mx-auto avatar-lg">
                        @else
                            <i class="fa-solid fa-circle-user d-block text-center icon-lg text-secondary"></i>
                        @endif

                    </div>
                    <div class="col-auto self-align-end">
                        <input type="file" name="avatar" id="" class="form-control form-control-sm mt-1">
                        <div class="form-text">
                            Acceptable formats: jpeg, jpg, png, gif only <br>
                            Max file size is 1048kb
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="fw-bold form-label">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="fw-bold form-label">Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="introduction" class="fw-bold form-label">Introduction</label>
                    <textarea name="introduction" id="introduction" rows="3" class="form-control">
                    {{ $user->introduction }}
                   </textarea>
                </div>

                <button type="submit" class="btn btn-warning px-5">Save</button>

            </form>
        </div>
    </div>
@endsection
