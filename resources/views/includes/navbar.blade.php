<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('landing') }}" class="logo d-flex align-items-center me-auto me-xl-0 px-3">
        <h1 class="sitename">Divergent Traveller</h1>
      </a>

      <nav id="navmenu" class="navmenu mx-4">
        <ul>
          <li class="px-3"><a href="{{ route('landing') }}" class="active">Travel Itineraries<br></a></li>
          <li class="dropdown px-3"><a href=""><span>Destinations</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul class="dropdown-list multi-column grid">
                @if(isset($categories) && $categories->isNotEmpty())
                @php
                    $chunks = $categories->chunk(ceil($categories->count() / 2));
                @endphp
                    @foreach ($categories as $parent)
                        @if ($parent->children->isNotEmpty())
                            <li class="dropdown"><a href="{{ route('itinerary.category.nested', $parent->slug) }}"><span>{{ $parent->title }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    @foreach ($parent->children as $child)
                                        @if ($child->children->isNotEmpty())
                                            <li class="dropdown"><a href="{{ route('itinerary.category.nested', [$parent->slug, $child->slug]) }}"><span>{{ $child->title }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                                <ul class="sub-dropdown">
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
                                <a class="dropdown-item" href="{{ route('itinerary.category.nested', $parent->slug) }}">
                                    {{ $parent->title }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
          </li>
          <li class="px-3"><a href="{{ route('landing') }}">About</a></li>
            @auth
            @if (Auth::user()->role === 'admin')
            <li class="px-3"><a href="/admin">Admin Dashboard</a></li>
            @endif
            @endauth
            <form method="POST" action="{{ route('logout') }}">
                <li class="px-3"> 
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                        </a>
                </li>
            </form>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
</header>