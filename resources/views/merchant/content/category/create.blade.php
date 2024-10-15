<!-- Create Product Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createCategoryForm" method="POST">
                @csrf <!-- CSRF Token -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
$(document).ready(function() {
    // Handle Create Category Form Submission
    $('#createCategoryForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Get form data
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route('merchant.show-category.store') }}', // The URL to send the request to
            type: 'POST',
            data: formData,
            success: function(response) {
                // Close the modal
                $('#createCategoryModal').modal('hide');

                // Remove the backdrop
                $('.modal-backdrop').remove();
                
                // Optionally, display a success message
                Swal.fire('Success!', response.message, 'success');

                // You can also refresh your category list here if needed
                // location.reload(); // or update the category list dynamically
            },
            error: function(xhr) {
                // Handle errors
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var key in errors) {
                    errorMessage += errors[key][0] + '\n'; // Get the first error message for each field
                }
                Swal.fire('Error!', errorMessage, 'error');
            }
        });
    });
});
</script>

