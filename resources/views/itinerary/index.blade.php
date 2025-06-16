@extends('layouts.app')

@section('title', $category->title ?? 'Divergent Traveller')

@section('content')

<!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center" data-aos="fade-up" data-aos-delay="100">
                <h2><span>{{ $category->title ?? 'Explore Travel Itineraries' }}</span></h2>
                <p>Let us help you plan an epic itinerary in one of the many places around the world that we love!</p>
                <a href="contact.html" class="btn-get-started">Ask Question!<br></a>
                </div>
            </div>
        </div>
    </section>
<!-- /Hero Section -->

<section id="gallery" class="section">
    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center"> 
        <!-- CARD START -->
            @foreach ( $itineraries as $itinerary)
                <div class="card text-bg-dark m-3" style="max-width: 22rem; max-height: 30rem">
                    <img src="{{ asset('storage/' . $itinerary->thumbnail) }}" alt="" class="" style="width: 20rem; object-fit:fill;">
                    <div class="card-body">
                    <h5 class="card-title">{{ $itinerary->title }}</h5>
                    <p class="card-text">{{ Str::limit(strip_tags($itinerary->content), 100) }}</p>
                    </div>
                    <p class="card-text">
                        <small>
                        @foreach ($itinerary->categories as $category)
                            <a href="{{ route('itinerary.category.nested', ['slug1' => $category->slug]) }}"> {{ $category->title }} <span>|</span> </a>
                        @endforeach
                        </small>
                    </p>
                    <a href="
                    {{ route('itinerary.show', $itinerary->slug) }}
                    " 
                    class="btn btn-light">
                        Find out more!
                    </a>
                </div>
            @endforeach
        <!-- CARD STOP -->
        </div>
    </div>
</section>

@endsection