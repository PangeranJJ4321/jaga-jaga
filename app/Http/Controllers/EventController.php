<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function browseEvents()
    {
        // Logic untuk menampilkan halaman Browse Events
         // Query dasar
         $events = Event::select(
             DB::raw('LEFT(MONTHNAME(tanggal_waktu), 3) as month'),
             DB::raw('DAY(tanggal_waktu) as day'),
             DB::raw('DATE_FORMAT(tanggal_waktu, "%a %d %b %Y, %h:%i %p") as formatted_date'),
             'categories.category_name as category_name',
             'events.nama_acara',
             'events.gambar_acara',
             'events.lokasi',
             'events.lokasi',
             'events.tanggal_waktu',
             'events.harga_tiket'
         )
         ->join('event_categories', 'events.id', '=', 'event_categories.event_id')
         ->join('categories', 'event_categories.category_id', '=', 'categories.id')
         ->get();
        return view('partials.browse-events', compact('event'));
    }

    public function exploreCategory($category)
    {
        // Query untuk mendapatkan event berdasarkan kategori
        $events = Event::select(
                DB::raw('LEFT(MONTHNAME(tanggal_waktu), 3) as month'),
                DB::raw('DAY(tanggal_waktu) as day'),
                DB::raw('DATE_FORMAT(tanggal_waktu, "%a %d %b %Y, %h:%i %p") as formatted_date'),
                'categories.category_name as category_name',
                'events.id',
                'events.nama_acara',
                'events.gambar_acara',
                'events.lokasi',
                'events.tanggal_waktu',
                'events.harga_tiket'
            )
            ->join('event_categories', 'events.id', '=', 'event_categories.event_id')
            ->join('categories', 'event_categories.category_id', '=', 'categories.id')
            ->where('categories.category_name', $category) // Filter berdasarkan kategori
            ->get();

        // Kirim data ke view browse-events
        return view('partials.browse-events', compact('events', 'category'));
    }


    // public function myTickets()
    // {
    //     // Logic untuk menampilkan halaman My Tickets jika sudah login
    //     return view('my-tickets');
    // }

    // public function myFavoriteEvents()
    // {
    //     // Logic untuk menampilkan halaman My Favorite Events jika sudah login
    //     return view('my-favorite-events');
    // }

    public function showEvents(Request $request)
    {   
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $location = $request->input('location');
        $date = $request->input('date');

        // Query dasar
        $events = Event::select(
            DB::raw('LEFT(MONTHNAME(tanggal_waktu), 3) as month'),
            DB::raw('DAY(tanggal_waktu) as day'),
            DB::raw('DATE_FORMAT(tanggal_waktu, "%a %d %b %Y, %h:%i %p") as formatted_date'),
            'categories.category_name as category_name',
            'events.nama_acara',
            'events.id',
            'events.gambar_acara',
            'events.lokasi',
            'events.lokasi',
            'events.tanggal_waktu',
            'events.harga_tiket'
        )
        ->join('event_categories', 'events.id', '=', 'event_categories.event_id')
        ->join('categories', 'event_categories.category_id', '=', 'categories.id');



        // Tambahkan filter keyword
        if (!empty($keyword)) {
            $events->where('events.nama_acara', 'LIKE', '%' . $keyword . '%');
        }

        // Tambahkan filter kategori
        if ($request->has('category') && !empty($request->category)) {
            $category = urldecode($request->input('category'));
            $events->where('category_name', $category);
        }

        // Tambahkan filter lokasi
        if (!empty($location)) {
            // $events->where('events.lokasi', $location === 'online' ? 'Online' : 'Offline');
            if ($location != 'online') {
                $events->where('events.lokasi', '!=', 'Online'); 
            } else {
                $events->where('events.lokasi', 'Online'); 
            }
            
        }

        if (!empty($date)) {
            $today = now(); // Dapatkan tanggal dan waktu saat ini
        
            switch ($date) {
                case 'today':
                    $events->whereDate('events.tanggal_waktu', $today->toDateString());
                    break;
        
                case 'tomorrow':
                    $events->whereDate('events.tanggal_waktu', $today->addDay()->toDateString());
                    break;
        
                case 'this_week':
                    $events->whereBetween('events.tanggal_waktu', [
                        $today->startOfWeek()->toDateString(),
                        $today->endOfWeek()->toDateString()
                    ]);
                    break;
        
                case 'next_week':
                    $nextWeek = $today->addWeek();
                    $events->whereBetween('events.tanggal_waktu', [
                        $nextWeek->startOfWeek()->toDateString(),
                        $nextWeek->endOfWeek()->toDateString()
                    ]);
                    break;
        
                case 'next_month':
                    $nextMonth = $today->addMonth();
                    $events->whereYear('events.tanggal_waktu', $nextMonth->year)
                           ->whereMonth('events.tanggal_waktu', $nextMonth->month);
                    break;
            }
        }
        

        // Eksekusi query
        $events = $events->get();

        // Kirim data ke view
        return view('partials.browse-events', compact('events'));
        }

}
