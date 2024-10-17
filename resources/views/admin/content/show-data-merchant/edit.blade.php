
<!-- Edit Merchant Modal -->
<div class="modal fade" id="editMerchantModal" tabindex="-1" role="dialog" aria-labelledby="editMerchantModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMerchantModalLabel">Edit Merchant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMerchantForm">
                    @csrf
                    @method('PUT') <!-- Pastikan untuk menambahkan method PUT -->
                    <input type="hidden" id="merchantId">
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
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
     // Handle edit button click
     $(document).on('click', '.btn-edit', function() {
        var merchantId = $(this).data('id');
        var email = $(this).data('email');
        var username = $(this).data('username');

        // Set values in the modal
        $('#merchantId').val(merchantId);
        $('#editEmail').val(email);
        $('#editUsername').val(username);

        // Show the modal
        $('#editMerchantModal').modal('show');
    });

    // Handle form submit for editing
    $('#editMerchantForm').on('submit', function(e) {
        e.preventDefault();
        var id = $('#merchantId').val();
        var email = $('#editEmail').val();
        var username = $('#editUsername').val();

        $.ajax({
            url: '/admin/merchant-data/' + id,
            method: 'PUT',
            data: {
                _token: $('input[name="_token"]').val(),
                email: email,
                username: username
            },
            success: function(response) {
                $('#editMerchantModal').modal('hide');
                $('#merchantTable').DataTable().ajax.reload();
                Swal.fire('Success', 'Merchant updated successfully', 'success');
            },
            error: function(xhr) {
                // Handle error response
                Swal.fire('Error', 'Something went wrong!', 'error');
            }
        });
    });

    // Handle delete button click with SweetAlert2
    $(document).on('click', '.btn-delete', function() {
        var merchantId = $(this).data('id');

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
                    url: '/admin/merchant-data/' + merchantId,
                    method: 'DELETE',
                    data: {
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        $('#merchantTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Merchant has been deleted.', 'success');
                    },
                    error: function(xhr) {
                        // Handle error response
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
    </script>
