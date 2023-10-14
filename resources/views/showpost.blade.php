@extends("navbar")

@section('content')
<div class="container">
    <h1 class="mb-4">Post Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Post ID: {{ $post['id'] }}</h5>
            <h2 class="card-subtitle mb-3 text-muted">{{ $post['title'] }}</h2>
            <p class="card-text">{{ $post['content'] }}</p>
        </div>
    </div>

    <a href="/allposts" class="btn btn-primary mt-3">Return to All Posts</a>
</div>
@endsection
