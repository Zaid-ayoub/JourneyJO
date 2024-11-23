@extends('source.template')

@section('bookings_active', 'active') <!-- Set the active class for bookings -->

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bookings</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Home</a></li>
                    <li class="breadcrumb-item active">Bookings</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                {{-- <a href="{{ route('bookings.create') }}" class="btn btn-primary rounded-pill">Add New Booking</a> --}}
                            </h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>User</b></th>
                                        <th>Tour</th>
                                        <th data-type="date" data-format="YYYY/MM/DD">Booking Date</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Total Price</th>
                                        <th>Number of People</th>
                                        @if (auth()->user()->role_id != 3)
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ $booking->tour->name }}</td>
                                            <td>{{ optional($booking->booking_date)->format('Y/m/d') ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if ($booking->status === 'pending') bg-warning
                                                    @elseif ($booking->status === 'completed') bg-success
                                                    @else bg-danger @endif">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge 
                                                    @if ($booking->payment_status === 'unpaid') bg-danger
                                                    @elseif ($booking->payment_status === 'paid') bg-success
                                                    @else bg-secondary @endif">
                                                    {{ ucfirst($booking->payment_status) }}
                                                </span>
                                            </td>
                                            <td>${{ number_format($booking->total_price, 2) }}</td>
                                            <td>{{ $booking->number_of_people }}</td>
                                            @if (auth()->user()->role_id != 3)
                                            <td>
                                                <!-- Action buttons -->
                                                <a href="{{ route('booking.edit', $booking->booking_id) }}" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                                                <!-- Delete Form with SweetAlert -->
                                                {{-- <form action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST" id="delete-form-{{ $booking->booking_id }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm rounded-pill" onclick="confirmDelete({{ $booking->booking_id }})">Delete</button>
                                                </form> --}}
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
