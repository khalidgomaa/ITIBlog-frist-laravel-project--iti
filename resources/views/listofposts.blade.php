@extends("navbar")
@section('content')

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">Create New Post</button>

<!-- Add this modal at the end of your view.blade.php file -->
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
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"> Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="text-center my-4">
        <h1 class="display-4">Posts</h1>
    </div>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top img-fluid" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
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
</div>
@endsection
