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
            columns: [
                {
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
                        return `<a href="/merchant/product/${row.uuid}" class="btn btn-info btn-sm">Lihat Detail</a>`;
                    }
                }
            ]
        });
    });
</script>
