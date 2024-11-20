@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Header -->
    <div class="text-center mb-5 " >
        <h1 class="display-4 fw-bold">{{ $events->nama_acara }}</h1>
        <p class="text-muted" style="font-size: 1.7rem" >Location: [{{ $events->lokasi }}] | Date: [{{ $events->tanggal_waktu }}]</p>
    </div>

    <!-- Deskripsi dan Gambar -->
    <div class="row g-4 align-items-center mb-5 " style="margin: 20px">
        <!-- Deskripsi -->
        <div class="col-md-6 pr-5" >
            @if ($events->kouta_tiket > 0) 
                <p class="badge bg-success p-2" style="font-size:1.5rem">Available Tickets: <strong>{{ $events->kouta_tiket }}</strong></p> <br>
            @else
                <p class="badge bg-danger p-2" style="font-size:1.5rem">Available Tickets: <strong>{{ $events->kouta_tiket }}</strong></p><br>
            
            @endif
            <h2 class="fw-bold mb-4">Description</h2> 
            <p class="text-muted " style="font-size: 1.7rem">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit ullamcorper dolor, nec elementum quam faucibus at.
                {{ $events->description }}
            </p>
            <h2>Rating : {{ number_format($averageRating, 1) }} out of 5 
                @for ($i = 1; $i <= floor($averageRating); $i++)
                    <i class='bx bxs-star' style='color:#ffd700'></i> 
                @endfor
                @for ($i = ceil($averageRating); $i < 5; $i++)
                    <i class='bx bx-star' style='color:#ffd700'></i> 
                @endfor
                
                @if ($averageRating - floor($averageRating) >= 0.5)
                    <i class='bx bxs-star-half' style='color:#ffd700'></i> 
                @endif
             
            </h2>
            
                      
            <div class="mt-4">
                <h2>Price: <strong>${{ $events->harga_tiket }}</strong></h2>
                {{-- <a href="{{ route('tickets.buy', $events->id) }}" class="btn btn-warning btn-lg mt-2">Buy Tickets</a> --}}
                @auth  
                <div class="d-flex justify-content-start">

                    <a href="#" class="btn btn-warning btn-lg mt-2 " style="font-size: 1.7rem">Buy Tickets</a>
                    <form action="{{ route('favorite.toggle') }}" method="POST" id="favorite-form">
                        @csrf
                        <input style="display: none" name="event_id" value="{{ $events->id }}">
                        
                        @if(auth()->user() && $events->favorites()->where('user_id', auth()->id())->exists()) 
                            <!-- Jika event sudah ada di favorit -->
                            <button type="submit" class="btn btn-danger btn-lg mt-2" style="font-size: 1.7rem">
                                Remove Favorite
                            </button>
                        @else
                            <!-- Jika event belum ada di favorit -->
                            <button type="submit" class="btn btn-outline-primary btn-lg mt-2" style="font-size: 1.7rem">
                                Add Favorite
                            </button>
                        @endif
                    </form>
                    
                </div>
                
                @else
                <a href="{{ route('login') }}" class="btn btn-warning btn-lg mt-2" style="font-size: 1.7rem"
                       onclick="event.preventDefault(); 
                                sessionStorage.setItem('redirectUrl', window.location.href); 
                                window.location.href = '{{ route('login') }}';">
                        Buy Tickets
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg mt-2" style="font-size: 1.7rem"
                       onclick="event.preventDefault(); 
                                sessionStorage.setItem('redirectUrl', window.location.href); 
                                window.location.href = '{{ route('login') }}';">
                        Add Favorit
                </a>
                @endauth

            </div>
        </div>

        <!-- Gambar -->
        <div class="col-md-6 text-center">
            <img src="{{ asset($events->gambar_acara) }}" alt="Event Image" 
                class="img-fluid rounded shadow" style="width: 500px; height: 300px; object-fit: cover;">
        </div>
        
    </div>

    <!-- Reviews dan Formulir -->
    <div class="row" style="margin: 20px; margin-top: 12rem; margin-bottom: 12rem; background-color: #fce9d4; padding: 20px; border-radius: 20px">
        <!-- Reviews -->
        <div class="col-lg-7">
            <div class="col-lg-7 border-1px">
                <!-- Display Comments -->
                <div id="comments-container" class="comments-container">
                    <h2 class="text-left text-primary mb-4">Reviews</h2>
                    @if (count($reviews) > 0)
                    @foreach($reviews as $review)                       
                    <div class="comment mb-3 p-3 bg-light rounded shadow-sm">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-2">
                                <img src="{{asset('images/image-default.jpg')}}" alt="Profile" class="rounded-circle" width="40" height="40">
                            </div>
                            <strong>{{ $review->user->name }}</strong>
                            <span class="text-muted ms-2">{{ $review->formatted_date }}</span>
                        </div>
                        <!-- Rating Bintang -->
                        <p style="font-size:1.5rem">{{ $review->review_text }}</p>
                        <div class="stars">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span style="font-size: 1.5rem"><i class='bx bxs-star'></i></span>
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++)
                                <span style="font-size: 1.5rem"><i class='bx bx-star'></i></span>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h2 class="text-left text-primary mb-4">Event has no review</h2>
                    @endif
                    {{-- Menampilkan komentar --}}
                   
                </div>
            </div>
        </div>

        <!-- Formulir Review -->
        <div class="col-lg-5">
            <h2 class="fw-bold text-primary mb-4">Leave a Review</h2>
            <form id="review-form" method="POST" >
                @csrf
                @auth
                <input style="display: none" name="event_id" value="{{ $events->id }}">
                <input style="display: none" name="user_id" value="{{ Auth::id() }}">
            
                <div class="mb-3">
                    <label for="review" class="form-label" style="font-size: 1.7rem">Your Review</label>
                    <textarea id="review" class="form-control" rows="4" name="review_text"></textarea>
                </div>
            
                <div class="mb-3">
                    <label for="rating" class="form-label" style="font-size: 1.7rem">Rating</label>
                    <select id="rating" class="form-select" name="rating" style="font-size: 1.7rem">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Very Good</option>
                        <option value="3">3 - Average</option>
                        <option value="2">2 - Poor</option>
                        <option value="1">1 - Terrible</option>
                    </select>
                </div>
            
                
                <button id="submit-review" class="btn btn-outline-primary btn-lg mt-2" type="submit" style="font-size: 1.7rem">Submit</button>
                {{-- <button id="cancel-review" class="btn btn-outline-danger btn-lg mt-2 d-none" data-review-id="{{ $reviews->event_id }}" type="button" style="font-size: 1.7rem">Cancel</button> --}}


            
                @else
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-3" style="font-size: 1.5rem;"></i>
                        <p class="mb-0" style="font-size: 1.7rem" >You need to 
                            <a href="{{ route('login') }}" class="alert-link fw-bold" style="color: orangered" 
                                onclick="event.preventDefault(); 
                                    sessionStorage.setItem('redirectUrl', window.location.href); 
                                    window.location.href = '{{ route('login') }}';" >
                                    login</a> to leave a review.
                        </p>
                    </div>
                </div>
                @endauth
            </form>
            
            
        </div>

    </div>

    <!-- Gallery Event yang mirip berdasarkan categori yang sama-->
    {{-- @include('partials.same_events') --}}
    
</div>

@endsection
