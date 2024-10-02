<div class="container py-5">
    <div class="row g-4 mb-5 justify-content-center mx-auto"> <!-- Centering the row -->
        <div class="col-lg-8 col-xl-9"> <!-- Main content column -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="border rounded">
                            @if($product->images->isNotEmpty())
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                @endforeach
                            @else
                                <p>No images available for this product.</p>
                            @endif
                    </div>
                </div>
                <div class="col-md-8 text-end"> <!-- Align text to the right -->
                    <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                    <p class="mb-3 text-end"><strong>Category:</strong> Vegetables</p> <!-- Align text right -->
                    <h5 class="fw-bold mb-3">{{ $product->price }}</h5>

                    {{-- <p class="mb-4 text-justify"> <!-- Justify the text -->
                        {{ $product->description }}
                    </p> --}}
                    <div class="input-group quantity mb-5 justify-content-end" style="width: 120px;">
                        <!-- Align input group to the right -->

                    </div>
                </div>
                <div class="col-lg-12">
                    <nav>
                        <div class="nav nav-tabs mb-3">
                            <button class="nav-link active" type="button" data-bs-toggle="tab"
                                data-bs-target="#nav-about">Description</button>
                        </div>
                    </nav>
                    <div class="tab-content mb-5">
                        <div class="tab-pane fade show active" id="nav-about">
                            <p class="text-justify">
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
