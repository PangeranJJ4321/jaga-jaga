<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FavoritEventController extends Controller
{
    // Menampilkan daftar favorit
    public function index()
    {

        $favoriteEvents = Favorit::join('events', 'favorits.event_id', '=', 'events.id')
            ->where('favorits.user_id', Auth::id())
            ->select([
                'favorits.id as id',
                'events.nama_acara',
                'events.lokasi',
                DB::raw('DATE(events.tanggal_waktu) as tanggal_waktu'),
                'events.deskripsi',
                DB::raw('COALESCE(events.gambar_acara, "https://via.placeholder.com/500x300") as gambar_acara')
            ])
            ->get();


        return view('partials.favorit_events', compact('favoriteEvents'));
    }

    // Menghapus favorit
    public function destroy($id)
    {
        $favorit = Favorit::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $favorit->delete();

        return redirect()->route('favorits.index')->with('success', 'Event berhasil dihapus dari favorit.');
    }
}
