<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'tour'])->get();
        return view('booking', compact('bookings'));
    }

    public function create()
    {
        $users = User::all();
        $tours = Tour::all();
        return view('bookings.create', compact('users', 'tours'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'tour_id' => 'required|exists:tours,tour_id',
        'status' => 'required|in:pending,completed,cancelled',
        'payment_status' => 'required|in:unpaid,paid,refunded',
        'total_price' => 'required|numeric|min:0',
        'number_of_people' => 'required|integer|min:1',
    ]);

    Booking::create($validated);

    return redirect()->route('booking')->with('success', 'Booking created successfully.');
}


    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
{
    $booking = Booking::with(['user', 'tour'])->findOrFail($id);

    // Retrieve necessary data for dropdowns if needed (e.g., user and tour data)
    $users = User::all();
    $tours = Tour::all();

    return view('edit.edit_booking', compact('booking', 'users', 'tours'));
}


public function update(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    // Validate only the fields that are editable
    $request->validate([
        'status' => 'required|in:pending,cancelled,completed',
        'payment_status' => 'required|in:unpaid,paid,refunded',
    ]);

    // If the status is already 'completed', do not allow it to change
    if ($booking->status === 'completed' && $request->input('status') !== 'completed') {
        return redirect()->back()->with('error', 'Completed bookings cannot change their status.');
    }

    // Update the booking
    $booking->payment_status = $request->input('payment_status');
    if ($booking->status !== 'completed') {
        $booking->status = $request->input('status'); // Only update status if not completed
    }
    $booking->save();

    return redirect()->route('booking')->with('success', 'Booking updated successfully!');
}





    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}