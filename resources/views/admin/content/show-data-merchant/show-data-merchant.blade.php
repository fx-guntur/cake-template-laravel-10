<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Merchant</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Merchant List</h6>
            <a href="{{ route('admin.merchant-data.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Merchant
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="merchantTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->

<!-- Load jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $('#merchantTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "{{ route('admin.merchant-data.data') }}", // This route should now be properly defined
        "type": "GET"
    },
    "columns": [
        { "data": "email" },
        { "data": "username" },
        {
            "data": "action",
            "orderable": false,
            "searchable": false
        }
    ]
});
</script>
