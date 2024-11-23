@extends('source.template')

@section('category_active', 'active') <!-- Set the active class for category -->

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Categories</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                              <a href="{{ route('add_category') }}" class="btn btn-primary rounded-pill">Add New Category</a>
                            </h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>Category Name</b></th>
                                        <th>Category Description</th>
                                        <th>Category Image</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->category_description }}</td>
                                            <td>
                                              @if ($category->category_image)
                                              <img src="{{ asset('assets/img/' . $category->category_image) }}" alt="{{ $category->category_name }}" width="80" />
                                              @else
                                              No image
                                          @endif
                                            </td>
                                            <td>{{ $category->created_at->format('Y/d/m') }}</td>
                                            <td>
                                                <!-- Action buttons -->
                                                <a href="{{ route('categories.edit', $category->category_id) }}" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                                                <!-- Soft Delete Form for Category with SweetAlert -->
                                                <form action="{{ route('categories.delete', $category->category_id) }}" method="POST" id="delete-form-{{ $category->category_id }}" style="display: inline;">
                                                  @csrf
                                                  @method('POST')
                                                  <button type="button" class="btn btn-danger btn-sm rounded-pill" onclick="confirmDelete({{ $category->category_id }})">Delete</button>
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
