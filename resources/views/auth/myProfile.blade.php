@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron">
        <h1 class="display-4">My Profile</h1>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Name: <strong>{{ auth()->user()->name }}</strong></p>
            </div>
            <div class="col-md-6">
                <p class="lead">Email: <strong>{{ auth()->user()->email }}</strong></p>
            </div>
            <div class="col-md-6">
                <p class="lead">Created At: <strong>{{ auth()->user()->created_at }}</strong></p>
            </div>
            <div class="col-md-6">
                <p class="lead">Updated At: <strong>{{ auth()->user()->updated_at }}</strong></p>
            </div>
        </div>
        <button data-bs-toggle="modal" data-bs-target="#editProfileModal" class="btn btn-primary mt-3">Edit</button>
    </div>

    
  <!-- Edit model -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('myprofile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="old_password" name="old_password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- Add more fields for updating the profile as needed -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Edit model -->
</div>



<!-- Show Success and Error Messages -->
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
@endsection
