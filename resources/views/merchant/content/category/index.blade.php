<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lihat Semua Produk</h1>
    <p class="mb-4">DataTables is a third-party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the
        <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.
    </p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="category-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
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

<!-- Load jQuery, Bootstrap, DataTables, and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize DataTable
        $('#category-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('merchant.category.getData') }}',
                dataSrc: function(json) {
                    return json.data;
                }
            },
            columns: [{
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'product_count',
                    name: 'product_count',
                },
                {
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary editCategory" data-uuid="${row.uuid}">Edit</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteCategory" data-uuid="${row.uuid}">Delete</a>`;
                    }
                }
            ]
        });
    });
</script>
