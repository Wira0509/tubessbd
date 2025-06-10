<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Divergent Traveller</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Cardo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center me-auto me-xl-0 px-3">
        <h1 class="sitename">Divergent Traveller</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li class="px-3"><a href="index.html" class="active">Travel Itineraries<br></a></li>
          <li class="px-3"><a href="about.html">About</a></li>
          <li class="dropdown px-3"><a href="#"><span>Destinations</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
            @foreach ($categories as $parent)
                @if ($parent->children->isNotEmpty())
                    <li class="dropdown"><a href="{{ route('itinerary.category.nested', $parent->slug) }}"><span>{{ $parent->title }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @foreach ($parent->children as $child)
                                @if ($child->children->isNotEmpty())
                                    <li class="dropdown"><a href="{{ route('itinerary.category.nested', [$parent->slug, $child->slug]) }}"><span>{{ $child->title }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                        <ul>
                                            @foreach ($child->children as $grandchild)
                                                <li class="dropdown"><a href="{{ route('itinerary.category.nested', [$parent->slug, $child->slug, $grandchild->slug]) }}"><span>{{ $grandchild->title }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="dropdown">
                                        <a href="{{ route('itinerary.category.nested', [$parent->slug, $child->slug]) }}">{{ $child->title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a class="dropdown-item" href="{{ route('itinerary.category', $parent->slug) }}">
                            {{ $parent->title }}
                        </a>
                    </li>
                @endif
            @endforeach
            </ul>
          </li>
          <li class="px-3"><a href="#">Services</a></li>
          <li class="px-3"><a href="#">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">

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

    </section><!-- /Hero Section -->

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
                    <a href=""> {{ $category->title }} <span>|</span> </a>
                  @endforeach
                </small>
              </p>
            <a href="#" class="btn btn-light">Find out more!</a>
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

    </section><!-- /Gallery Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Teteng Finance.</strong> <span>All Rights Reserved</span></p>
      </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>