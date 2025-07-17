<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingCreated;

class BookingController extends Controller
{
    // Get all bookings for the authenticated user
    public function index()
    {
        $bookings = Auth::user()->bookings()->orderBy('booking_date')->get();
        return response()->json($bookings, 200);
    }

    // Store a new booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date|unique:bookings,booking_date',
        ]);

        $booking = Auth::user()->bookings()->create($validated);

        // Optional: Notify the user
        Auth::user()->notify(new BookingCreated($booking));

        return response()->json([
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    // Show a single booking
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return response()->json($booking, 200);
    }

    // Update a booking
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date|unique:bookings,booking_date,' . $booking->id,
        ]);

        $booking->update($validated);

        return response()->json([
            'message' => 'Booking updated successfully.',
            'data' => $booking
        ], 200);
    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully.'
        ], 204);
    }
}
