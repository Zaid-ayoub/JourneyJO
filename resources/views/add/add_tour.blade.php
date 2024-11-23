@extends('source.template')

@section('tour_active', 'active')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Tour</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tour') }}">Tours</a></li>
                <li class="breadcrumb-item active">Add Tour</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Tour Form</h5>

                        <!-- Tour Form -->
                        <form id="addTourForm" action="{{ route('tours.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                            @csrf
                        
                            <!-- Tour Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tour Name</label>
                                <input type="text" name="name" class="form-control" id="name" required placeholder="Enter tour name">
                                @error('name') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="price" required placeholder="Enter price">
                                @error('price') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Cover Image -->
                            <div class="col-md-6">
                                <label for="cover_image" class="form-label">Cover Image</label>
                                <input type="file" name="cover_image" class="form-control" id="cover_image">
                                @error('cover_image') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Additional Images -->
                            <div class="col-md-6">
                                <label for="tour_images" class="form-label">Additional Tour Images</label>
                                <input type="file" name="tour_images[]" class="form-control" id="tour_images" multiple>
                                @error('additional_images') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        
                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="4" required placeholder="Enter description"></textarea>
                                @error('description') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Start Date -->
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date" required>
                                @error('start_date') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- End Date -->
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" required>
                                @error('end_date') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Available Seats -->
                            <div class="col-md-6">
                                <label for="available_seats" class="form-label">Available Seats</label>
                                <input type="number" name="available_seats" class="form-control" id="available_seats" required>
                                @error('available_seats') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        
                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        
                            <!-- Submit Buttons -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <a href="{{ route('tour') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection



