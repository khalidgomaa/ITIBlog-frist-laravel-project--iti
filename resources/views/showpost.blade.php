@extends("navbar")

@section('content')
<div class="container">
    <h1 class="mb-4">Post Details</h1>
    <div class="card custom-card">
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top custom-card-img" alt="Post Image">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->body }}</p>
        </div>
        <div class="card-footer">
            <small class="text-muted">Created at: {{ $post->created_at }}</small><br>
            <small class="text-muted">Last updated: {{ $post->updated_at }}</small>
        </div>
    </div>

    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Return to All Posts</a>
    <button data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger mt-3">Delete</button>
    <button data-bs-toggle="modal" data-bs-target="#editPostModal" class="btn btn-primary mt-3">Edit</button>
</div>

<style>
    /* Add this CSS to match card width with image width */
    .custom-card {
        width: 100%; /* Set the width to match the image width */
    }
    .custom-card-img {
        max-height: 500px; /* Set the maximum height you want */
        width: 100%; /* Set the width to match the card width */
        object-fit: contain;
    }
</style>



<!-- Modal  of deleting alert-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          Are you sure that you want to delete the post?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('showpost.delete', ['id' => $post->id]) }}" type="button" class="btn btn-primary">Confirm</a>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal  of update post-->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">update New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('showpost.updatepost', ['slug' => $post->slug]) }}" method="POST" enctype="multipart/form-data">
            <button type="submit" class="btn btn-primary">Confirm</button>

            @method("put")
                @csrf
                <div class="modal-body">
    <!-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="form-control">
        @error("title")
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" id="body" class="form-control">{{ old('body', $post->body) }}</textarea>
        @error("body")
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        @error("image")
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
    @endif
</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

@endsection
