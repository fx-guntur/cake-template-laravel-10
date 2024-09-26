<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lihat Transaksi</h1>
    <p class="mb-4">DataTables is a third-party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi Digimikro</h6>
            {{-- <a href="{{ route('transaksi.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Daftar Transaksi
            </a> --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>UUID</th>
                            <th>Kode Pembayaran</th>
                            <th>Invoice</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created At</th>
                            {{-- <th>Updated At</th> --}}
                            <th>Action</th> <!-- Action column -->
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

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
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
<!-- Load jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- Tambahkan inisialisasi DataTables -->
<script>
$(document).ready(function() {
    $('#transactionTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: '{{ route("merchant.transaction.getData") }}', // URL untuk request data via AJAX
        columns: [
            { data: 'uuid', name: 'uuid' },
            { data: 'payment_code', name: 'payment_code' },
            { data: 'invoice', name: 'invoice' },
            { data: 'type', name: 'type' },
            { data: 'amount', name: 'amount' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            // { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false } // Column Action untuk tombol
        ]
    });
});
</script>
