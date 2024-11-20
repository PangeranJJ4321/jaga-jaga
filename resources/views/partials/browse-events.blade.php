@extends('master')

@section('content')
<section class="section-pagetop bg-gray">
    <div class="m-4">
        <h3 style="font-size:3rem; text-align: center">Browse Events</h3>
    </div>
</section>

<div class="p-3 mb-4 text-center" style="background-color: #f88558;">
    <span style="font-size: 20px;">{{ $events->count() }} event(s) found</span>
</div>

<div class="container mt-5">  
    <div class="row">
        <div class="col-12 col-md-3">
            @include('partials.filters') <!-- Filter Component -->
        </div>
    
        <div class="col-12 col-md-8" >
            <div class="row">
                <!-- Alert jika tidak ada hasil -->
                @if($events->isEmpty())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 2rem;" >
                        <strong>Oops!</strong> No results found matching your search criteria.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                <!-- Start of Event Card -->
                    @foreach($events as $event)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card card-event">
                            <!-- Image Wrapper -->
                            <div class="img-wrap" style="background-image: url('{{ asset($event->gambar_acara) }}');"></div>
                        
                            
                            <!-- Event Date -->
                            <div class="event-date text-center">
                                <div class="event-month  text-light">{{$event->month}}</div>
                                <div class="event-day bg-white">{{$event->day}}</div>
                            </div>
                            
                            <!-- Event Category -->
                            <span class="event-category">{{$event->category_name}}</span>

                            <a class="event-favorite" title="Add to favorites" style="text-decoration: none;" onclick="toggleLike(this)">
                                <i class='bx bx-heart'></i>
                            </a>              
                                
                            <!-- Event Information -->
                            <div class="info-wrap">
                                <p><a href="/en/events/detail?event_id={{ $event->id }}" style="text-decoration: none;">{{$event->nama_acara}}</a></p>
                                <div class="text-black-50 small">
                                    <p style="font-size: 1.5rem">{{$event->lokasi}}<br>{{$event->formatted_date}}<strong class="price-wrap" style="float: inline-end;">${{$event->harga_tiket}}</strong></p>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <!-- End of Event Card -->
                @endif
            </div>
        </div>      
    </div>
</div>
@endsection