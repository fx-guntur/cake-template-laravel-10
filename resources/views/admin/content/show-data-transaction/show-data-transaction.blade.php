<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lihat Transaksi</h1>
    <p class="mb-4">DataTables is a third-party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.</p>

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
                            <th>Penjual</th>
                            <th>Pembeli</th>
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
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" aria-label="Close" id="closeModalBtn"></button>
                </div>
                <div class="modal-body" id="transactionContent">
                    <!-- Transaction details will be populated here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModalBtnFooter">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- The Modal -->
</div>
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
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- Tambahkan inisialisasi DataTables -->
<script>
    $(document).ready(function() {
        $('#transactionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.transaction-data.data') }}',
            columns: [{
                    data: 'uuid',
                    name: 'uuid'
                },
                {
                    data: 'merchant_name',
                    name: 'merchant_name'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'payment_code',
                    name: 'payment_code'
                },
                {
                    data: 'invoice',
                    name: 'invoice'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    const transactionShowRoute = "{{ route('admin.transaction-data.show', ':uuid') }}";

    $(document).on('click', '#viewTransactionBtn', function() {
        const uuid = $(this).data('uuid');
        const url = transactionShowRoute.replace(':uuid', uuid);

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                let content = `
                    <p><strong>UUID:</strong> ${data.uuid}</p>
                    <p><strong>Merchant ID:</strong> ${data.merchant_id}</p>
                    <p><strong>Customer ID:</strong> ${data.customer_id}</p>
                    <p><strong>Payment ID:</strong> ${data.payment_id}</p>
                    <p><strong>Payment Code:</strong> ${data.payment_code}</p>
                    <p><strong>Invoice:</strong> ${data.invoice}</p>
                    <p><strong>Type:</strong> ${data.type}</p>
                    <p><strong>Amount:</strong> ${data.amount}</p>
                    <p><strong>Unique Code:</strong> ${data.unique_code}</p>
                    <p><strong>Charge:</strong> ${data.charge}</p>
                    <p><strong>Transaction Date:</strong> ${data.transaction_date}</p>
                    <p><strong>Transaction Paid Date:</strong> ${data.transaction_paid_date}</p>
                    <p><strong>Transaction Deadline:</strong> ${data.transaction_deadline}</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                `;
                $('#transactionContent').html(content);
                var transactionModal = new bootstrap.Modal(document.getElementById('transactionModal'));
                transactionModal.show();
            })
            .catch(error => {
                console.error('Error fetching transaction details:', error);
            });
    });

    // Close modal using native JavaScript
    document.getElementById('closeModalBtn').addEventListener('click', function() {
        const modal = document.getElementById('transactionModal');
        modal.style.display = 'none'; // Hide the modal
        modal.classList.remove('show'); // Remove Bootstrap's show class
        document.body.classList.remove('modal-open'); // Remove the modal-open class from body
        document.querySelector('.modal-backdrop').remove(); // Remove the backdrop
    });

    document.getElementById('closeModalBtnFooter').addEventListener('click', function() {
        const modal = document.getElementById('transactionModal');
        modal.style.display = 'none'; // Hide the modal
        modal.classList.remove('show'); // Remove Bootstrap's show class
        document.body.classList.remove('modal-open'); // Remove the modal-open class from body
        document.querySelector('.modal-backdrop').remove(); // Remove the backdrop
    });
</script>
