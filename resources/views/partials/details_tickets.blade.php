@extends('master')

@section('content')

<div class="container py-5" style="margin: 20px; margin-bottom: 12rem">
    <!-- Back to Tickets Button -->
    <div class="mb-4">
        <a href="{{route('tickets.index')}}" class="btn btn-outline-secondary" style="font-size: 1.6rem"><i class='bx bx-arrow-back'></i> Back to My Tickets</a>
    </div>

     <!-- Event Details -->
     <div class="row g-4">
        <div class="col-md-8">
            <div class="event-banner" style="background-image: url('{{ asset($ticket->gambar_acara) }}'); object-fit: cover"></div>
            <h2 class="mt-4">{{$ticket->nama_acara}}</h2>
            <p class="text-muted" style="font-size: 1.6rem"><i class='bx bx-calendar'></i> Date: {{$ticket->tanggal_waktu}}</p>
            <p class="text-muted" style="font-size: 1.6rem"><i class='bx bx-location-plus'></i> Location: {{$ticket->lokasi}}</p>
            <p class="mt-3" style="font-size: 1.6rem">
                <strong>Event Description:</strong>
                <br>
                {{$ticket->deskripsi}}
                Join us for an unforgettable evening of live music featuring top artists from around the world. Enjoy a vibrant atmosphere, great performances, and much more at Central Park.
            </p>
            @if ($ticket->status === 'active')
                <form action="{{ route('tickets.cancel', $ticket->ticket_code) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger btn-lg" style="font-size: 1.6rem">
                        Cancel Ticket
                    </button>
                </form>                
            @endif
        </div>
        <!-- Ticket Details -->
        <div class="col-md-4">
            <div class="card p-4 shadow-sm">
                <h2 class="card-title">Ticket Details</h2>
                <p class="mb-2" style="font-size: 1.6rem"><strong>Price:</strong> $120</p>
                <p class="mb-2" style="font-size: 1.6rem"><strong>Status:</strong> <span class="text-success">Confirmed</span></p>
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary btn-lg" style="color: white;border: none;font-size: 1.6rem"><i class='bx bxs-printer'></i> Print Ticket</button>
                    <a href="#" class="btn btn-outline-secondary btn-lg" style="font-size: 1.6rem"><i class='bx bx-download'></i> Download Ticket</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection