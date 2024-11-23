@extends('source.template')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Tour</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tour') }}">Tours</a></li>
                <li class="breadcrumb-item active">Edit Tour</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12"> <!-- Full width card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Tour Form</h5>

                        <!-- Tour Form -->
                        <form id="editTourForm" action="{{ route('tours.update', $tour->tour_id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')

                            <!-- Tour Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tour Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $tour->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $tour->price) }}" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" {{ old('category_id', $tour->category_id) == $category->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date" value="{{ old('start_date', $tour->start_date) }}" required>
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" value="{{ old('end_date', $tour->end_date) }}" required>
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Available Seats -->
                            <div class="col-md-6">
                                <label for="available_seats" class="form-label">Available Seats</label>
                                <input type="number" name="available_seats" class="form-control" id="available_seats" value="{{ old('available_seats', $tour->available_seats) }}" required>
                                @error('available_seats')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description', $tour->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cover Image -->
                            <div class="col-md-6">
                                <label for="cover_image" class="form-label">Cover Image</label>
                                <input type="file" name="cover_image" class="form-control" id="cover_image" accept="image/*">
                                @error('cover_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Cover Image Display -->
                            <div class="col-md-6">
                                <label class="form-label">Current Cover:</label>
                                <div>
                                    @if ($tour->cover_image)
                                        <img src="{{ asset('assets/img/tours/'.$tour->cover_image) }}" alt="{{ $tour->name }}" class="img-thumbnail" width="100">
                                    @else
                                        <p class="text-muted">No cover image uploaded</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Additional Images -->
                            <div class="col-md-6">
                                <label for="tour_images" class="form-label">Additional Images</label>
                                <input type="file" name="tour_images[]" class="form-control" id="tour_images" multiple>
                                @error('tour_images.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Additional Images -->
                            <div class="col-md-6">
                                <label class="form-label">Current Additional Images:</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($tour->images as $image)
                                        <div>
                                            <img src="{{ asset('assets/img/tour_images/' . $image->image_path) }}" alt="Tour Image" class="img-thumbnail" width="100">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="submitButton">Save Changes</button>
                                <a href="{{ route('tour') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form><!-- End Tour Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection

