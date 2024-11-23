@extends('source.template')

@section('location_active', 'active')  <!-- Set the active class for locations -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Locations</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Locations</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">
                <!-- Button to Add New Location -->
                <a href="{{ route('add_location') }}" class="btn btn-primary rounded-pill">Add New Location</a>
              </h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th><b>Location Name</b></th>
                    <th>Description</th>
                    <th>Coordinates</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($locations as $location)
                    <tr>
                      <td>{{ $location->location_name }}</td>
                      <td>{{ $location->description ?? 'N/A' }}</td>
                      <td>{{ $location->coordinates ?? 'N/A' }}</td>
                      <td>
                        <!-- Action buttons (Edit, Delete) -->
                        <a href="{{ route('locations.edit', $location->location_id) }}" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                        
                        <!-- SweetAlert delete confirmation -->
                        <form action="{{ route('locations.delete', $location->location_id) }}" method="POST" style="display:inline;" id="delete-form-{{ $location->location_id }}">
                          @csrf
                          <button type="button" class="btn btn-danger btn-sm rounded-pill" onclick="confirmDelete({{ $location->location_id }})">Delete</button>
                        </form>
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



