@extends('source.template')

@section('users_active', 'active') <!-- Set the active class for users -->


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('dashboard') }}>Home</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="{{ route('add_user') }}" class="btn btn-primary rounded-pill">Add New User</a>
                            </h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><b>Name</b></th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Role</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->city }}</td>
                                            <td>{{ $user->role->role_name ?? 'No Role' }}</td>
                                            <td>{{ $user->created_at->format('Y/d/m') }}</td>
                                            <td>
                                                <!-- Action buttons -->
                                                <a href={{ route('edit_user', $user->id) }}
                                                    class="btn btn-primary btn-sm rounded-pill">Edit</a>
                                                <!-- Soft Delete Form for User with SweetAlert -->
                                                <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                                    id="delete-form-{{ $user->id }}" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>

                                                <!-- SweetAlert Trigger Button -->
                                                <button type="button" class="btn btn-danger btn-sm rounded-pill"
                                                    onclick="confirmDelete({{ $user->id }})">Delete</button>



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
