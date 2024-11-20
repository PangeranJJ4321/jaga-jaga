<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Menyimpan review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'review_text' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        // Simpan review
        $review = new Review();
        $review->event_id = $validated['event_id'];
        $review->user_id = Auth::id();
        $review->review_text = $validated['review_text'];
        $review->rating = $validated['rating'];
        $review->review_date = now();
        $review->save();

        return response()->json(['status' => 'success']);
    }


    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);
    
        $review = Review::where('event_id', $validated['event_id'])
            ->where('user_id', Auth::id())
            ->first();
    
        if ($review) {
            $review->delete();
            return response()->json(['status' => 'success']);
        }
    
        return response()->json(['status' => 'error', 'message' => 'Review tidak ditemukan'], 404);
    }

    
    public function getReviews($eventId)
{
    $reviews = Review::where('event_id', $eventId)->with('user')->latest()->get();

    return response()->json([
        'html' => view('partials.reviews', compact('reviews'))->render(),
    ]);
}

}
