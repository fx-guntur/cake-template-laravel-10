<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="transactionModalLabel">Transaction Details</h5>
            <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
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
<script>
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

    </script>
