@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <label for="category" class="fw-bold form-label d-block">
            Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>

        @foreach ($all_categories as $category)
            <div class="form-check form-check-inline">
                <input type="checkbox" name="category[]" value="{{ $category->id }}" id="{{ $category->name }}" class="form-check-input">
                <label for="{{ $category->name }}" class="form-check-label">{{ $category->name }}</label>
            </div>
        @endforeach

        <div class="mb-4">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" >
        </div>
        <div class="mb-4">
            <label for="author" class="form-label fw-bold">Author</label>
            <input type="text" name="author" id="author" >
        </div>
        <div class="mb-4">
            <label for="publisher" class="form-label fw-bold">Publisher</label>
            <input type="text" name="publisher" id="publisher" >
        </div>
        <div class="mb-4">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" placeholder="Whats on your mind"></textarea>
        </div>
        <div class="mb-4">
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
