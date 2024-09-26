<!-- ======= Main Content ======= -->
<main id="main">
    <div class="container">
        <div class="card border-0 shadow mb-4">
            <div class="card-header bg-primary text-white rounded-top">
                <h5 class="card-title mb-0">Tambah Produk</h5>
            </div>
            <div class="card-body mt-4">
                <form action="{{ route('merchant.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- CSRF Token -->
                    <div class="row mb-3">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter the product name" required style="border-radius: 13px;" />
                        </div>
                        <!-- Price Field -->
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="Set the price" required style="border-radius: 13px;" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <!-- Image Field -->
                        <div class="col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" accept=".png,.jpg,.jpeg"
                                    name="image"  />
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Describe the product"
                                required style="border-radius: 13px;"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex flex-row-reverse mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- ======= End of Main Content ======= -->
