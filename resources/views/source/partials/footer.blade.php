  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
      <div class="copyright">
          &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
      function confirmDelete(userId) {
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
          }).then((result) => {
              if (result.isConfirmed) {
                  // If user confirms, submit the form
                  document.getElementById('delete-form-' + userId).submit();

                  // Show a success message after submitting the form
                  Swal.fire({
                      title: "Deleted!",
                      text: "The user has been deleted.",
                      icon: "success"
                  });
              }
          });
      }
  </script>

  <script>
      // SweetAlert trigger after form submission
      document.getElementById('userForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from immediately submitting

          // Show SweetAlert success message
          Swal.fire({
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
          }).then(() => {
              // Now submit the form after SweetAlert is shown
              this.submit(); // Submit the form after the SweetAlert is shown
          });
      });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
      // SweetAlert trigger after form submission
      document.getElementById('userForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from immediately submitting

          // Show SweetAlert success message
          Swal.fire({
              icon: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              timer: 1500
          }).then(() => {
              // Now submit the form after SweetAlert is shown
              this.submit(); // Submit the form after the SweetAlert is shown
          });
      });
  </script>

  <script>
      // SweetAlert trigger after form submission
      document.getElementById('editUserForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from immediately submitting

          // Show SweetAlert success message
          Swal.fire({
              icon: 'success',
              title: 'Your changes have been saved',
              showConfirmButton: false,
              timer: 1500
          }).then(() => {
              // Now submit the form after SweetAlert is shown
              this.submit(); // Submit the form after the SweetAlert is shown
          });
      });
  </script>

  <script>
      document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from immediately submitting

          // Show SweetAlert success message
          Swal.fire({
              icon: 'success',
              title: 'Category Updated!',
              text: 'The changes have been saved successfully.',
              showConfirmButton: false,
              timer: 1500
          }).then(() => {
              // Now submit the form after SweetAlert is shown
              this.submit(); // Submit the form after the SweetAlert is shown
          });
      });
  </script>

  <script>
      document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
          e.preventDefault(); // Prevent form from immediately submitting

          // Show SweetAlert success message
          Swal.fire({
              icon: 'success',
              title: 'Category Added!',
              text: 'The new category has been created successfully.',
              showConfirmButton: false,
              timer: 1500
          }).then(() => {
              // Now submit the form after SweetAlert is shown
              this.submit(); // Submit the form after the SweetAlert is shown
          });
      });
  </script>

  <script>
      function confirmDelete(locationId) {
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!"
          }).then((result) => {
              if (result.isConfirmed) {
                  // If user confirms, submit the form
                  document.getElementById('delete-form-' + locationId).submit();

                  // Show a success message after submitting the form
                  Swal.fire({
                      title: "Deleted!",
                      text: "The location has been deleted.",
                      icon: "success"
                  });
              }
          });
      }
  </script>

  <script>
      // Wait until the DOM is loaded
      document.addEventListener('DOMContentLoaded', function() {
          // Listen for form submission
          document.getElementById('editLocationForm').addEventListener('submit', function(e) {
              e.preventDefault(); // Prevent form from immediately submitting

              // Show SweetAlert success message
              Swal.fire({
                  icon: 'success',
                  title: 'Location Updated!',
                  text: 'The changes have been saved successfully.',
                  showConfirmButton: false,
                  timer: 1500
              }).then(() => {
                  // Now submit the form after SweetAlert is shown
                  this.submit(); // Submit the form after the SweetAlert is shown
              });
          });
      });
  </script>

<script>
    // For Edit Tour Form
    document.getElementById('editTourForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent form from immediately submitting

        // Show SweetAlert success message
        Swal.fire({
            icon: 'success',
            title: 'Tour Updated!',
            text: 'The changes have been saved successfully.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Now submit the form after SweetAlert is shown
            this.submit(); // Submit the form after the SweetAlert is shown
        });
    });

    // For Add Tour Form
    document.getElementById('addTourForm').addEventListener('submit', function(e) {
    e.preventDefault();
    console.log('Add Tour Form Submitted'); // Debugging output
});
</script>

<!-- SweetAlert Script -->
<script>
    document.getElementById('confirm-submit').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to update the booking!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show success message immediately
                Swal.fire({
                    title: 'Success!',
                    text: 'Booking updated successfully!',
                    icon: 'success',
                    timer: 1500
                }).then(() => {
                    // Submit the form after showing success message
                    document.getElementById('edit-booking-form').submit();
                });
            }
        });
    });
    </script>

