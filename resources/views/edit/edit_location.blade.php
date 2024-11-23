@extends('source.template')

@section('location_active', 'active')  <!-- Set the active class for locations -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Location</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('location') }}">Locations</a></li>
          <li class="breadcrumb-item active">Edit Location</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Edit Location Form</h5>

              <!-- Edit Location Form -->
              <form action="{{ route('locations.update', $location->location_id) }}" method="POST" id="editLocationForm">
                @csrf
                @method('PUT') <!-- This is needed to make a PUT request -->
                <div class="mb-3">
                    <label for="location_name" class="form-label">Location Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" value="{{ $location->location_name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ $location->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="coordinates" class="form-label">Coordinates</label>
                    <input type="text" class="form-control" id="coordinates" name="coordinates" value="{{ $location->coordinates }}">
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-primary">Save Location</button>
                    <a href="{{ route('location') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
              <!-- End Edit Location Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

