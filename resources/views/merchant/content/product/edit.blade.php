<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProductForm">
                    <input type="hidden" id="productId">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryOption" class="form-label">Category</label>
                        <select class="form-control" name="category_id" id="categoryOption" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="description"></textarea>
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const productionShowRoute = "{{ route('merchant.show-product.show', ':uuid') }}";
    const productionEditRoute = "{{ route('merchant.show-product.edit', ':uuid') }}";
    const productionUpdateRoute = "{{ route('merchant.show-product.update', ':uuid') }}";
    const productionDestroyRoute = "{{ route('merchant.show-product.destroy', ':uuid') }}";
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    // Handle Edit Button Click
    $('body').on('click', '.editProduct', function() {
            var productUUID = $(this).data('uuid');
            const urlEdit = productionEditRoute.replace(':uuid', productUUID);
            $.get(urlEdit)
                .done(function(data) {
                    $('#productId').val(data.uuid);
                    $('#productName').val(data.name);
                    $('#categoryOption').val(data.category_id); // Ensure this matches your DB field
                    $('#productPrice').val(data.price);
                    $('#productDescription').val(data.description);
                    $('#editProductModal').modal('show');
                })
                .fail(function(xhr) {
                    Swal.fire('Error!', 'Failed to load product details.', 'error');
                });
        });
         // Handle Save Changes Button Click
         $('#saveChanges').on('click', function() {
            var productUUID = $('#productId').val();
            const urlUpdate = productionUpdateRoute.replace(':uuid', productUUID);

            var updatedData = {
                name: $('#productName').val(),
                price: $('#productPrice').val(),
                category_id: $('#categoryOption').val(), // Fix key to match validation
                description: $('#productDescription').val()
            };

            $.ajax({
                url: urlUpdate,
                type: 'PUT',
                data: updatedData,
                success: function(response) {
                    $('#editProductModal').modal('hide');
                    $('#products-table').DataTable().ajax.reload();
                    Swal.fire('Updated!', 'Product has been updated.', 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'There was an error updating the product: ' + xhr
                        .responseJSON.message, 'error');
                }
            });
        });

        // Handle Delete Button Click with SweetAlert
        $('body').on('click', '.deleteProduct', function() {
            var productUUID = $(this).data('uuid');
            const urlDestroy = productionDestroyRoute.replace(':uuid', productUUID);

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
                            $('#products-table').DataTable().ajax.reload();
                            Swal.fire('Deleted!', 'Product has been deleted.',
                                'success');
                        },
                        error: function(xhr) {
                            Swal.fire('Error!',
                                'There was an error deleting the product.',
                                'error');
                        }
                    });
                }
            });
        });
    });
    </script>
