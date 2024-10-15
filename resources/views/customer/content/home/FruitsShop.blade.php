<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">
                                <span class="text-dark" style="width: 130px;">All</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-{{ $category->uuid }}">
                                <span class="text-dark" style="width: 130px;">{{ $category->category }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <!-- All Products Tab -->
                <div id="tab-all" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($products as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3" onclick="viewDetails('{{ $product->uuid }}')">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                @if ($product->images->isNotEmpty())
                                                    @foreach ($product->images as $image)
                                                        <img src="{{ asset('storage/' . $image->path) }}"
                                                            alt="{{ $product->name }}" class="img-fluid rounded">
                                                    @endforeach
                                                @else
                                                    <p>No image available for this product.</p>
                                                @endif
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $product->category_id ? $product->category->category : 'No Category' }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $product->name }}</h4>
                                                <p>{{ $product->description }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Tabs -->
                @foreach ($categories as $category)
                <div id="tab-{{ $category->uuid }}" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($products->where('category_id', $category->id) as $product) <!-- Filter by category -->
                                    <div class="col-md-6 col-lg-4 col-xl-3" onclick="viewDetails('{{ $product->uuid }}')">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                @if ($product->images->isNotEmpty())
                                                    @foreach ($product->images as $image)
                                                        <img src="{{ asset('storage/' . $image->path) }}"
                                                            alt="{{ $product->name }}" class="img-fluid rounded">
                                                    @endforeach
                                                @else
                                                    <p>No image available for this product.</p>
                                                @endif
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $product->category_id ? $product->category->category : 'No Category' }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $product->name }}</h4>
                                                <p>{{ $product->description }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }}</p>
                                                    <a href="#"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

<script>
    const productionShowRoute = "{{ route('public.product.show', ':uuid') }}";

    function viewDetails(uuid) {
        const url = productionShowRoute.replace(':uuid', uuid);
        window.location.href = url; // Redirect to the product detail page
    }
</script>