@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <form action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <label for="category" class="fw-bold form-label d-block">
            Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>

        @foreach ($all_categories as $category)
            {{-- [1,2,3,4,5,6,7] / [2,3,4]  --}}
            <div class="form-check form-check-inline">
                @if (in_array($category->id, $selected_categories))
                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name }}"
                        class="form-check-input" checked>
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                @else
                    <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name }}"
                        class="form-check-input" >
                    <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
                @endif
            </div>
        @endforeach

        <div class="mb-4">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Whats on your mind">
                {{ $post->description }}
            </textarea>
        </div>
        <div class="mb-4">
            <img src="{{ asset('/storage/images/' . $post->image) }}" style="height: 300px; width:300px"
                alt="{{ $post->image }}" class="img-thumbnail">
            <label for="image" class="form-label fw-bold">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <div class="form-text">
                Acceptable formats: jpeg, jpg, png, gif only <br>
                Max file size is 1048kb
            </div>
        </div>
        <button type="submit" class="btn btn-primary px-5">Post</button>
    </form>
@endsection
