@extends('source.template')

@section('booking_active', 'active') <!-- Set the active class for bookings -->

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Booking</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('booking') }}">Bookings</a></li>
                    <li class="breadcrumb-item active">Edit Booking</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Booking</h5>

                            <!-- Edit Form -->
                            <form id="edit-booking-form"
                                action="{{ route('booking.update', ['id' => $booking->booking_id]) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <!-- Status Dropdown -->
                                    <select name="status" id="status" class="form-control"
                                        {{ $booking->status === 'completed' ? 'disabled' : '' }} required>
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>

                                    <!-- Hidden Input to Ensure Status is Submitted -->
                                    @if ($booking->status === 'completed')
                                        <input type="hidden" name="status" value="{{ $booking->status }}">
                                    @endif


                                    <!-- Payment Status -->
                                    <div class="col-md-6">
                                        <label for="payment_status" class="form-label">Payment Status</label>
                                        <select name="payment_status" id="payment_status" class="form-control"
                                            {{ $booking->status === 'cancelled' ? 'disabled' : '' }} required>
                                            <option value="unpaid"
                                                {{ $booking->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid
                                            </option>
                                            <option value="paid"
                                                {{ $booking->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="refunded"
                                                {{ $booking->payment_status === 'refunded' ? 'selected' : '' }}>Refunded
                                            </option>
                                        </select>
                                        @error('payment_status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><!-- End Row -->

                                <!-- Submit Buttons -->
                                <div class="text-center mt-4">
                                    <button type="button" id="confirm-submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('booking') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form><!-- End Edit Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->


@endsection
