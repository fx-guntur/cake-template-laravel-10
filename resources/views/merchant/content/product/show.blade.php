<!-- The Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productContent">
                <!-- Product details will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const productShowRoute = "{{ route('merchant.show-product.show', ':uuid') }}";

    $(document).on('click', '#viewProductBtn', function() {
        const uuid = $(this).data('uuid');
        const url = productShowRoute.replace(':uuid', uuid);

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                let content = `
                    <div class="row g-4 mb-5 justify-content-center">
                        <div class="col-md-4">
                            <div class="border rounded">
                                ${data.images.length > 0 ? data.images.map(image => `
                                    <img src="/storage/${image.path}" alt="${data.name}" class="img-fluid rounded">
                                `).join('') : '<p>No images available for this product.</p>'}
                            </div>
                        </div>
                        <div class="col-md-8 text-end">
                            <h4 class="fw-bold mb-3">${data.name}</h4>
                            <p class="mb-3 text-end"><strong>Category:</strong> ${data.category_id ? data.category_name : 'No Category'}</p>
                            <h5 class="fw-bold mb-3">${data.price}</h5>
                            <p class="mb-4 text-justify">${data.description}</p>
                        </div>
                    </div>
                `;

                $('#productContent').html(content);
                var productModal = new bootstrap.Modal(document.getElementById('productModal'));
                productModal.show(); // Show the modal
            })
            .catch(error => {
                console.error('Error fetching product details:', error);
            });
    });
</script>
