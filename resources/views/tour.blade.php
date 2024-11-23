@extends('source.template')

@section('tour_active', 'active') <!-- Set the active class for tours -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tours</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Tours</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Only show "Add New Tour" button if the user's role is not super_admin -->
                        @if (auth()->user()->role_id != 3)
                            <h5 class="card-title text-center">
                                <a href="{{ route('add_tour') }}" class="btn btn-primary rounded-pill">Add New Tour</a>
                            </h5>
                        @endif

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th><b>Tour Name</b></th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Price</th>
                                    <th>Seats</th>
                                    <th>Cover Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tours as $tour)
                                    <tr>
                                        <td>{{ $tour->name }}</td>
                                        <td>{{ $tour->company->name }}</td>
                                        <td>{{ $tour->category->category_name }}</td>
                                        <td>{{ $tour->start_date }}</td>
                                        <td>{{ $tour->end_date }}</td>
                                        <td>${{ number_format($tour->price, 2) }}</td>
                                        <td>{{ $tour->available_seats }}</td>
                                        <td>
                                            <img src="{{ asset('assets/img/tours/'.$tour->cover_image) }}" alt="{{ $tour->name }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                        </td>
                                        <td>
                                            <!-- Show action buttons based on user role -->
                                            @if (auth()->user()->role_id != 3)
                                                <a href="{{ route('tours.edit', $tour->tour_id) }}" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                                            @endif

                                            <!-- Soft Delete Form for Tour with SweetAlert -->
                                            <form action="{{ route('tours.delete', $tour->tour_id) }}" method="POST" id="delete-form-{{ $tour->tour_id }}" style="display: none;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>

                                            <!-- SweetAlert Trigger Button (Visible for all roles) -->
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill" onclick="confirmDelete({{ $tour->tour_id }})">Delete</button>
                                        </td>
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
