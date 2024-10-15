<!-- Edit Product Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" id="categoryId">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="selection" class="form-control" id="category">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Load jQuery, Bootstrap, DataTables, and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const categoryEditRoute = "{{ route('merchant.show-category.edit', ':uuid') }}";
    const categoryUpdateRoute = "{{ route('merchant.show-category.update', ':uuid') }}";
    const categoryDestroyRoute = "{{ route('merchant.show-category.destroy', ':uuid') }}";

    // Handle Edit Button Click
    $('body').on('click', '.editCategory', function() {
        var categoryUUID = $(this).data('uuid');
        const urlEdit = categoryEditRoute.replace(':uuid', categoryUUID);
        $.get(urlEdit)
            .done(function(data) {
                $('#categoryId').val(data.uuid);
                $('#category').val(data.category); // Make sure this matches the input ID
                $('#editCategoryModal').modal('show'); // Show the modal explicitly
            })
            .fail(function(xhr) {
                console.error(xhr); // Log the entire response for debugging
                Swal.fire('Error!', 'Failed to load category details.', 'error');
            });
    });

    // Handle Save Changes Button Click
    $('#saveChanges').on('click', function() {
        var categoryUUID = $('#categoryId').val();
        const urlUpdate = categoryUpdateRoute.replace(':uuid', categoryUUID);

        var updatedData = {
            category: $('#category').val(), // This should match the input ID
        };

        $.ajax({
            url: urlUpdate,
            type: 'PUT',
            data: updatedData,
            success: function(response) {
                $('#editCategoryModal').modal('hide');
                $('#category-table').DataTable().ajax.reload();
                Swal.fire('Updated!', 'Category has been updated.', 'success');
            },
            error: function(xhr) {
                console.error(xhr); // Log the error response
                Swal.fire('Error!', 'There was an error updating the category: ' + xhr
                    .responseJSON.message, 'error');
            }
        });
    });


    // Handle Delete Button Click with SweetAlert
    $('body').on('click', '.deleteCategory', function() {
        var categoryUUID = $(this).data('uuid');
        const urlDestroy = categoryDestroyRoute.replace(':uuid', categoryUUID);

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlDestroy,
                    type: 'DELETE',
                    success: function(response) {
                        $('#category-table').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Category has been deleted.',
                            'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Error!',
                            'There was an error deleting the category.',
                            'error');
                    }
                });
            }
        });
    });
</script>
