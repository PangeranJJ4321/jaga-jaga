@extends('master')

@section('content')
    <div class="container py-5" >
        <h1 class="text-center mb-4" >My Tickets</h1>
        @if ($events->count() > 0)
            <div class="row g-4" style="margin: 20px;margin-bottom: 12rem; margin-top: 5rem">
                @foreach ($events as $event)
                <div class="col-md-4">
                    <div class="card ticket-card">
                        <img src="{{ asset($event->gambar_acara) }}" class="card-img-top" alt="Event Image" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.8rem">{{$event->nama_acara}}</h5>
                            <p class="card-text" style="font-size: 1.6rem"><i class='bx bxs-calendar'></i> Date: {{$event->tanggal_waktu}}</p>
                            <p class="card-text" style="font-size: 1.6rem"><i class='bx bx-location-plus'></i> Location: {{$event->lokasi}}</p>
                            <p class="card-text" style="font-size: 1.6rem"><i class='bx bx-info-circle'></i> Status: {{ ucfirst($event->status) }}</p>
                            <a href="{{ route('tickets.show', $event->ticket_code) }}" class="btn btn-orange w-100 btn-lg mt-2" style="font-size: 1.6rem"><i class='bx bx-show'></i> View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
        <div class="alert alert-info text-center">
            You have no tickets booked.
        </div>
        @endif
    </div>
@endsection