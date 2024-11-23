@extends('source.template')

@section('category_active', 'active')  <!-- Set the active class for category -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category') }}">Categories</a></li>
                <li class="breadcrumb-item active">Add Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Category Form</h5>

                    <!-- Category Form -->
                    <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="category_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="category_image" class="form-label">Category Image</label>
                            <input type="file" name="category_image" class="form-control" id="category_image">
                        </div>
                        <div class="col-md-6">
                            <label for="category_description" class="form-label">Category Description</label>
                            <textarea name="category_description" class="form-control" id="category_description" rows="4" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <!-- Cancel Button -->
                            <a href="{{ route('category') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form><!-- End Category Form -->

                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
