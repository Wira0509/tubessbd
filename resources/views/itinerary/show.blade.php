@extends('layouts.app')

@push('css')
  @livewireStyles
@endpush

@push('js')
  @livewireScripts
  <script>
      Livewire.on('comment_store', commentId => {
        var helloScroll = document.getElementById('comment-'+ commentId);
        helloScroll.scrollIntoView({behavior: 'smooth'}, true);
      })
  </script>
@endpush

@section('title', $itinerary->title)

@section('content')
<main class="main">

<!-- Gallery Details Section -->
<section id="gallery-details" class="gallery-details section">
  <div class="container" data-aos="fade-up">

    <div class="portfolio-details-slider swiper init-swiper">
      <!-- <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "navigation": {
            "nextEl": ".swiper-button-next",
            "prevEl": ".swiper-button-prev"
          },
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          }
        }
      </script>
      <div class="swiper-wrapper align-items-center"> -->

        <div class="swiper-slide">
          <img src="{{ asset('storage/' . $itinerary->thumbnail) }}" alt="">
        </div>
<!-- 
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div> -->
    </div>

    <div class="row justify-content-between gy-4 mt-4">

      <div class="col-lg-8" data-aos="fade-up">
        <div class="portfolio-description">
          <h2>{{ $itinerary->title }}</h2>
          <p>
            {!! $itinerary->content !!}
          </p>

          <div class="testimonial-item">
            <div>
              <img src="{{ asset('storage/' . $itinerary->author->avatar) }}" class="testimonial-img" alt="">
              <h3>{{ $itinerary->author->name }}</h3>
              <h4>Author</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="portfolio-info">
          <h3>Itinerary information</h3>
          <ul>
            <li><strong>Category</strong>
            @foreach ($itinerary->categories as $category)
                <a href="{{ url('/destination/' . $category->full_slug_path) }}"> {{ $category->title }} </a>
            @endforeach
            </li>
            <li><strong>Created at</strong> {{ $itinerary->created_at->translatedFormat('d F Y') }} </li>
          </ul>
          <div>
            @livewire('articles.comment',['id' => $itinerary->id])
          </div>
        </div>
      </div>

    </div>

  </div>

</section><!-- /Gallery Details Section -->

</main> 
@endsection