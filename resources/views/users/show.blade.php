@extends("navbar")
@section('content')
<div class="container">
    <div class="row">
   
        <!-- Post Section -->
        <div >
    <h3>Posts of {{ $user->name }}</h3>
    @foreach ($user->posts as $post)
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
    
<!-- model of delete -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-name fs-5" id="exampleModalLabel">Confirm Message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          Are you sure that you want to delete the user?
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <form action="{{ route('categories.destroy', $user['id']) }}" method="POST">
    @method('delete')
    @csrf
    <button type="submit" class="btn btn-danger">Confirm</button>
</form>

</div>
    </div>
  </div>
</div> 
<!-- end of delete modal -->





        
     </div> 
</div>

</div>
@endsection