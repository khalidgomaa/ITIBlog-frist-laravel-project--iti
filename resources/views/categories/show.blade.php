@extends("navbar")
@section('content')
<div class="container">
    <div class="row">
        <!-- Category Section -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-name text-center">{{ $category->name }}</h5>
                    <img src="{{ asset('storage/' . $category->logo) }}" class="card-img-top" alt="{{ $category->name }} logo">
                    <button data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger mt-3">Delete</button>
                    <button data-bs-toggle="modal" data-bs-target="#editcategoryModal" class="btn btn-primary mt-3">Edit</button>
                </div>
            </div>
        </div>

        <!-- Post Section -->
        <div class="col-md-6">
    <h3>Posts of {{ $category->name }}</h3>
    @foreach ($category->posts as $post)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img" alt="Post Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <a href="{{ route('showpost', $post->slug) }}" class="btn btn-primary">View Post</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
    

     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-name fs-5" id="exampleModalLabel">Confirm Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          Are you sure that you want to delete the category?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger">Confirm</button>
</form>

</div>
    </div>
  </div>
</div> 
<!-- end of delete modal -->


<!-- Modal  of update category-->
<div class="modal fade" id="editcategoryModal" tabindex="-1" aria-labelledby="createcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-name" id="createcategoryModalLabel">update New category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.update',$category['id']) }}" method="post" enctype="multipart/form-data">
                @method("put")
                @csrf
                <div class="modal-body"> 
  
    
    <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control">
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="logo">Logo</label>
    <input type="file" name="logo" id="logo" class="form-control">
    @error('logo')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

    @if ($category->logo)
    <img src="{{ asset('storage/' . $category->logo) }}" alt="Category Logo" width="200" height="200">
    @endif
</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form> 
            
        </div> 
     </div> 
</div>

</div>
@endsection