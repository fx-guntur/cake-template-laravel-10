<!-- Edit Merchant Modal -->
<div class="modal fade" id="editMerchantModal" tabindex="-1" role="dialog" aria-labelledby="editMerchantModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMerchantModalLabel">Edit Merchant</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="editMerchantForm">
                    <input type="hidden" id="merchantId">
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load jQuery, DataTables, and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Load Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script>
    const merchantEditRoute = "{{ route('admin.merchant-data.edit', ':uuid') }}";
    const merchantUpdateRoute = "{{ route('admin.merchant-data.update', ':uuid') }}";
    const merchantDestroyRoute = "{{ route('admin.merchant-data.destroy', ':uuid') }}";

    // Handle edit button click
    $('body').on('click', '.btn-edit', function() {
        var merchantUuid = $(this).data('uuid');
        const urlEdit = merchantEditRoute.replace(':uuid', merchantUuid)

        $.get(urlEdit)
            .done(function(data) {
                $('#merchantId').val(data.uuid);
                $('#editEmail').val(data.email); // Make sure this matches the input ID
                $('#editUsername').val(data.username);
                $('#editMerchantModal').modal('show'); // Show the modal explicitly
            })
            .fail(function(xhr) {
                console.error(xhr); // Log the entire response for debugging
                Swal.fire('Error!', 'Failed to load category details.', 'error');
            });
    });

    // Handle Save Changes Button Click
    // Handle Save Changes Button Click
    $('#saveChanges').on('click', function() {
        var merchantUUID = $('#merchantId').val();
        const urlUpdate = merchantUpdateRoute.replace(':uuid', merchantUUID);

        var updatedData = {
            email: $('#editEmail').val(), // This should match the input ID
            username: $('#editUsername').val(),
        };

        $.ajax({
            url: urlUpdate,
            type: 'PUT',
            data: updatedData,
            success: function(response) {
                $('#editMerchantModal').modal('hide');
                $('#merchantTable').DataTable().ajax.reload();
                Swal.fire('Updated!', 'Merchant has been updated.', 'success');
            },
            error: function(xhr) {
                console.error(xhr); // Log the error response
                Swal.fire('Error!', 'There was an error updating the merchant: ' + (xhr.responseJSON
                    .message || 'Unknown error'), 'error');
            }
        });
    });

    // Handle delete button click with SweetAlert2
    $(document).on('click', '.btn-delete', function() {
        var merchantUUID = $(this).data('uuid');
        const urlDestroy = merchantDestroyRoute.replace(':uuid', merchantUUID);

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlDestroy,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token here
                    },
                    success: function(response) {
                        $('#merchantTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Merchant has been deleted.', 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
</script>
