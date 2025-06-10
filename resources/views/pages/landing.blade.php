@extends('layouts.app')

@section('title', 'DivergentTraveller')

@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
        <h2><span>Travel Itineraries</span></h2>
        <p>Let us help you plan an epic itinerary in one of the many places around the world that we love!</p>
        <a href="contact.html" class="btn-get-started">Ask Question!<br></a>
        </div>
    </div>
    </div>

    </section>
<!-- /Hero Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="section">

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4 justify-content-center"> 
    <!-- CARD START -->
    @foreach ( $featureds as $featured)
        <div class="card text-bg-dark m-3" style="max-width: 22rem; max-height: 30rem">
            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="" class="" style="width: 20rem; object-fit:fill;">
        <div class="card-body">
            <h5 class="card-title">{{ $featured->title }}</h5>
            <p class="card-text">{{ Str::limit(strip_tags($featured->content), 100) }}</p>
        </div>
        <p class="card-text">
            <small>
                @foreach ($featured->categories as $category)
                <a href="{{ url('/destination/' . $category->full_slug_path) }}"> {{ $category->title }} <span>|</span> </a>
                @endforeach
            </small>
            </p>
        <a href="
                {{ route('itinerary.show', $featured->slug) }}
                " class="btn btn-light">Find out more!</a>
        </div>
    @endforeach

    <!-- CARD END -->
        
        <!-- CARD START -->
            <!-- @foreach ( $featureds as $featured)
                <div class="card col-xxl-3 col-lg-5 col-md-6 m-3">
                        <div class="gallery-item">
                        <img src="{{ asset('storage/' . $featured->thumbnail) }}" class="img-fluid" alt="">
                            <div class="gallery-links d-flex align-items-center justify-content-center">
                                <a href="#" class="glightbox preview-link font-body">Find out more!</a>
                            </div>
                        </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $featured->title }}</h4>
                        <p class="pt-2">
                        {{ Str::limit(strip_tags($featured->content), 100) }}
                        </p>
                        <p class="card-text">
                        @foreach ($featured->categories as $category)
                            <a href=""> {{ $category->title }} <span>|</span> </a>
                        @endforeach
                        </p>
                    </div>
                    <div class="card-footer">
                    <a href="#" class="btn btn-light card-footer">Find out more!</a>
                    </div>
                </div>
            @endforeach -->
        <!-- CARD END -->
    </div>

    </div>
</section>
@endsection