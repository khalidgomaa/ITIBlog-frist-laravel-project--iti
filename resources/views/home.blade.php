@extends("navbar")

@section('content')
<div class="container-fluid">
    <div id="appCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 40vh;">
        <ol class="carousel-indicators">
            <li data-bs-target="#appCarousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#appCarousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#appCarousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slide1.jpg') }}" alt="Slide 1" class="d-block w-50 mx-auto">
                <div class="carousel-caption">
                    <h3>Explore Our App</h3>
                    <p>Discover and share amazing posts with our app.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide2.jpg') }}" alt="Slide 2" class="d-block w-50 mx-auto">
                <div class="carousel-caption">
                    <h3>Connect with Others</h3>
                    <p>Join a community of post enthusiasts.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide3.jpg') }}" alt="Slide 3" class="d-block w-50 mx-auto">
                <div class="carousel-caption">
                    <h3>Get Started Today</h3>
                    <p>Download our app and start posting now!</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#appCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#appCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>
</div>
<style>
    .carousel-caption {
        background: rgba(0, 0, 0, 0.6); /* Add a semi-transparent background to captions */
        color: #fff; /* Text color for captions */
    }
</style>
@endsection
