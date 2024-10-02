<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lihat Semua Produk</h1>
    <p class="mb-4">DataTables is a third-party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
            <a href="{{ route('merchant.add-catalog.index') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="products-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
{{-- edit modal --}}
<!-- Modal -->
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
                        <input type="text" class="form-control" id="productName">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="text" class="form-control" id="productPrice">
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription"></textarea>
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

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2024</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Load jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('merchant.product.getData') }}',
                dataSrc: function(json) {
                    // Log the response to check if data is present
                    // console.log(json);
                    return json.data; // Ensure this matches your response structure
                }
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                    title: 'Product Name'
                },
                {
                    data: 'price',
                    name: 'price',
                    title: 'Price'
                },
                {
                    data: 'description',
                    name: 'description',
                    title: 'Description'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status',
                    render: function(data) {
                        return data ? 'Active' : 'Inactive';
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created At'
                },
                {
                    data: null, // Use null to access the whole row
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<a href="/merchant/product/${row.uuid}" class="btn btn-info btn-sm">Lihat Detail</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary editProduct" data-id="${row.uuid}">Edit</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteProduct" data-id="${row.uuid}">Delete</a>`;
                    }
                }
            ]
        });
         // Handle Edit Button Click
         $('body').on('click', '.editProduct', function() {
            var productId = $(this).data('id');
            // Fetch the product details and populate the form
            $.get(`/merchant/products/${productId}/edit`)
                .done(function(data) {
                    $('#productId').val(data.id);
                    $('#productName').val(data.name);
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
            var productId = $('#productId').val();
            var updatedData = {
                name: $('#productName').val(),
                price: $('#productPrice').val(),
                description: $('#productDescription').val()
            };

            $.ajax({
                url: `/merchant/products/${productId}`, // Adjust the URL if needed
                type: 'PUT',
                data: updatedData,
                success: function(response) {
                    $('#editProductModal').modal('hide');
                    $('#products-table').DataTable().ajax.reload(); // Reload the DataTable
                    Swal.fire('Updated!', 'Product has been updated.', 'success');
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'There was an error updating the product: ' + xhr.responseJSON.message, 'error');
                }
            });
        });

        // Handle Delete Button Click with SweetAlert
        $('body').on('click', '.deleteProduct', function() {
            var productId = $(this).data('id');

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
                        url: `/merchant/products/${productId}`,
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                            $('#products-table').DataTable().ajax.reload(); // Reload DataTable after deletion
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Failed to delete the product: ' + xhr.responseJSON.message, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
