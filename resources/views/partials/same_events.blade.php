<div class="text-center my-5" style="margin: 20px">
    <h2 class="fw-bold mb-4">Image Gallery</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <!-- Start of Event Card -->
            @foreach($events as $event)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card card-event">
                    <!-- Image Wrapper -->
                    <div class="img-wrap" style="background-image: url('{{ asset($event->gambar) }}');"></div>

                    <!-- Event Date -->
                    <div class="event-date text-center">
                        <div class="event-month text-light">{{$event->month}}</div>
                        <div class="event-day bg-white">{{$event->day}}</div>
                    </div>

                    <!-- Event Category -->
                    <span class="event-category">{{$event->category_name}}</span>

                    <a class="event-favorite" title="Add to favorites" style="text-decoration: none;" onclick="toggleLike(this)">
                        <i class='bx bx-heart'></i>
                    </a>

                    <!-- Event Information -->
                    <div class="info-wrap">
                        <p><a href="{{ url('/en/events/detail/' . $event->id) }}" style="text-decoration: none;">{{$event->nama_acara}}</a>
                        </p>
                        <div class="text-black-50 small">
                            <p style="font-size: 1.5rem">{{$event->t4}}<br>{{$event->formatted_date}}<strong class="price-wrap" style="float: inline-end;">${{$event->harga}}</strong></p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>