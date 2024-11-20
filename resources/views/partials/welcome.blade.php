@extends('master')

@section('content')
<section id="tranding">
    <div class="container">
        <h1 class="text-center section-heading">Trending Event</h1>
    </div>
    <div class="container">
        <div class="swiper tranding-slider">
            <div class="swiper-wrapper">
                @foreach ($events as $event)
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <img src="{{ asset($event->gambar_acara) }}" alt="Trending">
                        </div>
                        <div class="tranding-slide-content">
                            <h1 class="food-price">{{ $event->harga_tiket }}</h1>
                            <div class="tranding-slide-content-bottom">
                                <h2 class="food-name">{{ $event->nama_acara }}</h2>
                                <h3 class="food-rating">
                                    <span>{{ $event->rating_tertinggi }}</span>
                                    <div class="rating">
                                        @for ($i = 0; $i < floor($event->rating_tertinggi); $i++)
                                            <ion-icon name="star"></ion-icon>
                                        @endfor
                                        @if (floor($event->rating_tertinggi) < $event->rating_tertinggi)
                                            <ion-icon name="star-half"></ion-icon>
                                        @endif
                                        @for ($i = ceil($event->rating_tertinggi); $i < 5; $i++)
                                            <ion-icon name="star-outline"></ion-icon>
                                        @endfor
                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Kontrol navigasi dan pagination -->
            <div class="tranding-slider-control">
                <div class="swiper-button-prev slider-arrow">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </div>
                <div class="swiper-button-next slider-arrow">
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>


<!-- Cards Event Coming -->
<section class="section-content padding-y-lg bg-white">
    <div class="container">
        <header class="section-heading mb-5">
            <h1 class="title-section text-center text-uppercase" style="color: #ff8008;">Upcoming Events</h1>
        </header>
        
        <div class="row">
            @foreach ($upcomingEvents as $coming)
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card card-event">
                    <!-- Image Wrapper -->
                    <div class="img-wrap" style="background-image: url('{{ asset($coming->gambar_acara) }}');"></div>
                  
                    
                    <!-- Event Date -->
                    <div class="event-date text-center">
                        <div class="event-month  text-light">{{$coming->month}}</div>
                        <div class="event-day bg-white">{{$coming->day}}</div>
                    </div>
                    
                    <!-- Event Category -->
                    <span class="event-category">{{$coming->category_name}}</span>

                    <a class="event-favorite" title="Add to favorites" style="text-decoration: none;" onclick="toggleLike(this)">
                        <i class='bx bx-heart'></i>
                    </a>              
                        
                    <!-- Event Information -->
                    <div class="info-wrap">
                        <p>
                            <a href="/en/events/detail?event_id={{ $coming->id }}" style="text-decoration: none;">
                                {{ $coming->nama_acara }}
                            </a>
                        </p>
                        
                        <div class="text-black-50 small">
                            <p style="font-size: 1.5rem">{{$coming->lokasi}}<br>{{$coming->formatted_date}}<strong class="price-wrap" style="float: inline-end;">${{$coming->harga_tiket}}</strong></p>
                            <p ></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Event Category -->
<div class="container py-5">
  <div class="container">
      <h3 class="text-center section-heading mb-5" style="color: rgb(245, 94, 39);">Event Category</h3>
    </div>
  <div class="row g-4">
      <!-- Each category card with col-lg-3 to ensure 4 in one row on large screens -->
      @foreach ($categories as $category)         
      <div class="col-lg-3 col-md-4 col-sm-6">
          <a href="#" class="text-decoration-none">
              <div class="category-card">
                <img src="{{ asset($category->gambar) }}" alt="{{ $category->category_name }}" class="category-image">
                  <div class="category-overlay">
                      <p class="category-title">{{$category->category_name}}</p>
                  </div>
              </div>
          </a>
      </div>
      @endforeach

  </div>
</div>

{{-- Create my event --}}
<hr style="font: 800; margin-top: 20px; margin-bottom:20px">
<section class="section-intro padding-y-lg mt-5">
    <div class="container ">
        <div class="row">
            <div class="col-md-10 text-center">
                <article class="text-center text-lg-left mb-3">
                    <h3 style="font-size:3rem;">Are you ready to take your <b id="category-text"></b> event to the next level?</h3>
                </article>
            </div>
            <div class="col-md-2 text-center ">
                <a href="#" class="btn addt" style="font-size:2rem; font-weight:600;"><i class='bx bx-calendar-star'></i>Create my event</a>
            </div>
        </div>
    </div>
</section>
<hr style="font: 800; margin-top: 20px; margin-bottom:20px">

@endsection