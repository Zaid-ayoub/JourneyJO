@extends('source.template')

@section('location_active', 'active')  <!-- Set the active class for locations -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add New Location</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('location') }}">Locations</a></li>
          <li class="breadcrumb-item active">Add Location</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Add New Location Form</h5>

              <!-- Location Form -->
              <form action="{{ route('locations.store') }}" method="POST" id="addLocationForm">
                @csrf
                <div class="mb-3">
                  <label for="location_name" class="form-label">Location Name</label>
                  <input type="text" class="form-control" id="location_name" name="location_name" required>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <!-- Coordinates Field (Single Text Input) -->
                <div class="mb-3">
                  <label for="coordinates" class="form-label">Coordinates (Optional)</label>
                  <input type="text" class="form-control" id="coordinates" name="coordinates" placeholder="Enter coordinates in format: latitude,longitude">
                </div>

                <div class="mb-3 text-center">
                  <button type="submit" class="btn btn-primary">Save Location</button>
                  <a href="{{ route('location') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
              <!-- End Location Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Wait until the DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Listen for form submission
        document.getElementById('addLocationForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form from immediately submitting

            // Show SweetAlert success message
            Swal.fire({
                icon: 'success',
                title: 'Location Added!',
                text: 'The new location has been added successfully.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Now submit the form after SweetAlert is shown
                this.submit(); // Submit the form after the SweetAlert is shown
            });
        });
    });
</script>
