@extends("navbar")
@section('content')
<div class="container">
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>

    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $category->name }}</h5>
                    <img src="{{ asset('storage/' . $category->logo) }}" class="card-img-top" alt="{{ $category->name }} logo">
                </div>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary float-end">Show category</a>

            </div>
        </div>

        @if($loop->iteration % 3 === 0)
    </div>
    <div class="row">
        @endif

        @endforeach
    </div>
</div>
@endsection