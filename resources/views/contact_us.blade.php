@extends('source.template')

@section('contact_us_active', 'active')  <!-- Set the active class for Contact Us -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact Us</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Contact Us</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Public Messages</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th><b>User Name</b></th>
                    <th>User Email</th>
                    <th>Message</th>
                    <th>Date Sent</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->user->name ?? 'Guest' }}</td>
                        <td>{{ $message->user_email }}</td>
                      <td>{{ Str::limit($message->message, 50) }}</td>
                      <td>{{ $message->created_at->format('d M Y, h:i A') }}</td>
                    </tr>

                    <!-- Modal for viewing full message -->
                    <div class="modal fade" id="messageModal{{ $message->contact_id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->contact_id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="messageModalLabel{{ $message->contact_id }}">Message Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><strong>From:</strong> {{ $message->user->user_name ?? 'Guest' }} ({{ $message->user_email }})</p>
                            <p><strong>Sent On:</strong> {{ $message->created_at->format('d M Y, h:i A') }}</p>
                            <p><strong>Message:</strong></p>
                            <p>{{ $message->message }}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->

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


