<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    // Menambahkan event ke favorit
    public function toggleFavorite(Request $request)
    {
        $user = Auth::user(); // Mengambil pengguna yang sedang login
        $eventId = $request->input('event_id'); // ID event yang dikirim dari tombol
    
        // Cek apakah event sudah ada di tabel favorit
        $favorite = Favorit::where('user_id', $user->id)
                            ->where('event_id', $eventId)
                            ->first();
    
        // Gunakan transaksi untuk menghindari kondisi race atau error lainnya
        DB::beginTransaction();
        try {
            if ($favorite) {
                // Jika sudah ada, hapus data favorit
                $favorite->delete();
                DB::commit(); // Commit transaksi setelah berhasil menghapus
                return response()->json([
                    'status' => 'removed', 
                    'message' => 'Favorit berhasil dihapus.',
                    'button_text' => 'Add Favorite', // Bisa mengirimkan teks tombol baru
                    'button_class' => 'btn-outline-primary' // Mengirimkan kelas tombol baru
                ]);
            } else {
                // Jika belum ada, tambahkan ke tabel favorit
                Favorit::create([
                    'user_id' => $user->id,
                    'event_id' => $eventId,
                    'added_date' => now(),
                ]);
                DB::commit(); // Commit transaksi setelah berhasil menambahkan
                return response()->json([
                    'status' => 'added',
                    'message' => 'Favorit berhasil ditambahkan.',
                    'button_text' => 'Remove Favorite', // Bisa mengirimkan teks tombol baru
                    'button_class' => 'btn-danger' // Mengirimkan kelas tombol baru
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika ada error
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses favorit.'
            ]);
        }
    }
    

}
