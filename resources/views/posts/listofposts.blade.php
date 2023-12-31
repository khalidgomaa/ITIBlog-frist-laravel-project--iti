@extends('layouts.app')
@section('content')

<style>
    /* Add custom CSS for styling pagination */
    .pagination {
        justify-content: center;
    }

    /* Style to make all images the same width and height */
    .card-img-top {
        object-fit: cover;
        height: 100%;
        max-width: 100%;
    }

    .card {
        max-width: 300px; /* Adjust card width to fit three cards in one row */
    }
 
    /* Customize the pagination links */
    .pagination {
        justify-content: center;
    }

    .pagination .page-item .page-link {
        font-size: 14px; /* Adjust the font size to your preference */
        padding: 5px 10px; /* Adjust the padding to your preference */
    }
</style>

<!--  this modal for creating post-->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control">
                        @error("title")
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" value="{{old('body')}}" class="form-control" rows="5"></textarea>
                        @error("body")
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected>select category this select menu</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" value="{{old('image')}}" id="image" class="form-control">
                        @error("image")
                        <div class="text-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
 <!-- show the posts -->
<div class="container my-10">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">Create New Post</button>

    <div class="text-center my-4">
        <h1 class="display-4">Posts</h1>
    </div>

    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4"> <!-- Use col-md-4 to display three posts in one row on medium screens and above -->
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <small class="text-muted">Category: {{ $post->category->name }}</small><br>
                    <small class="text-muted">created by: {{ $post->user->name }}</small><br>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Created at: {{ $post->created_at }}</small><br>
                    <small class="text-muted">Last updated: {{ $post->updated_at }}</small>
                    <a href="{{ route('showpost', $post->slug) }}" class="btn btn-primary float-end">Show Post</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

 <!-- Display pagination links with the default Bootstrap styling -->
</div>
<!-- Display pagination links -->
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>
@endsection
