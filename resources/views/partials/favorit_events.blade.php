@extends('master')

@section('content')
    <div class="container py-5">
        {{-- title --}}
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Your Favorite Events</h1>
            <p class="text-muted" style="font-size: 1.7rem">Here are the events you have marked as favorites</p>
        </div>

        {{-- Daftar Event favorit --}}
        <div class="row g-4" style="margin: 20px; margin-bottom: 12rem">
            @foreach ($favoriteEvents as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="position-relative overflow-hidden">
                            <img 
                                src="{{ asset($event->gambar_acara) }}" 
                                class="card-img-top" 
                                alt="{{ $event->nama_acara }}" 
                                style="width: 100%; height: 160px; object-fit: cover; transition: transform 0.3s ease-in-out;"
                            >
                        </div>
                        <div class="card-body">
                            <h2 class="card-title text-primary">{{ $event->nama_acara }}</h2>
                            <p class="card-text text-muted" style="font-size: 1.6rem">
                                <i class='bx bxs-location-plus'></i> Location: {{ $event->lokasi }}<br>
                                <i class='bx bxs-calendar'  ></i> Date: {{ $event->tanggal_waktu }}
                            </p>
                            <p class="card-text" style="font-size: 1.5rem">{{ Str::limit($event->deskripsi, 100, '...') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="/en/events/detail?event_id={{ $event->id }}"" class="btn btn-outline-primary btn-lg mt-2">
                                    <i class="bi bi-eye"></i> View Details
                                </a>
                                <form action="{{ route('favorits.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini dari favorit?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg mt-2">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
@endsection