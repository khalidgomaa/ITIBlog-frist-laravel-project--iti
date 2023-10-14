@extends('navbar')

@section('content')
<div class="container">
    <div class="text-center my-4">
        <h1 class="display-4">Posts</h1>
    </div>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post['title'] }}</h5>
                    <p class="card-text">{{ $post['content'] }}</p>
                    <a href="/allposts/showpost/{{ $post['id'] }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
