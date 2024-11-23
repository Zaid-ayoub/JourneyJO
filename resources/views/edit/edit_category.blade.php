@extends('source.template')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category') }}">Categories</a></li>
                <li class="breadcrumb-item active">Edit Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-12"> <!-- Full width card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Edit Category Form</h5>

                        <!-- Category Form -->
                        <form id="editCategoryForm" action="{{ route('categories.update', $category->category_id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                            @csrf
                            @method('PUT')

                            <!-- Category Name -->
                            <div class="col-md-6">
                                <label for="category_name" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category->category_name }}" required>
                            </div>

                            <!-- Category Description -->
                            <div class="col-md-12">
                                <label for="category_description" class="form-label">Category Description</label>
                                <textarea name="category_description" class="form-control" id="category_description" rows="4" required>{{ $category->category_description }}</textarea>
                            </div>

                            <!-- Category Image -->
                            <div class="col-md-6">
                                <label for="category_image" class="form-label">Category Image</label>
                                <input type="file" name="category_image" class="form-control" id="category_image" accept="image/*">
                            </div>

                            <!-- Current Image Display -->
                            <div class="col-md-6">
                                <label class="form-label">Current Image:</label>
                                <div>
                                    @if ($category->category_image)
                                        <img src="{{ asset('assets/img/' . $category->category_image) }}" alt="{{ $category->category_name }}" class="img-thumbnail" width="100">
                                    @else
                                        <p class="text-muted">No image uploaded</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{ route('category') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form><!-- End Category Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



@endsection
