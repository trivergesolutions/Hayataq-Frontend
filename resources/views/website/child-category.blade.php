@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner clamshell-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">{{ $category->name }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('mainProducts') }}">Products</a>
                    </li>
                    <li>
                        <a href="{{ route('subCategory', $category->parent->slug) }}">{{ $category->parent->name }}</a>
                    </li>
                    <li>{{ $category->name }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products Details =============== -->
    {{-- <section class="productdetail-top bg-sky_blue" id="productdetail-top">
        <div class="container">
            <div class="row spcl-row align-items-center">
                <div class="col-lg-6">
                    @php
                        // 1. Category Description se images array nikalna
                        $images = $category->categoryDescription->images ?? [];

                        // 2. Featured image dhundna (is_featured == true)
                        $featuredImage = collect($images)->where('is_featured', true)->first();

                        // 3. Agar featured image milti hai to uska path, warna placeholder
                        $imagePath = $featuredImage['full_path'] ?? asset('website/assests/images/placeholder.png');
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $category->name }}">
                </div>
                <div class="col-lg-6">
                    <div class="productdetail-content">
                        <h2 class="subheading">{{ $category->name }}</h2>
                        <p class="para">{!! $category->categoryDescription->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- =============== Clamshell Split-Frames Cutters and Accessories =============== -->
    <section class="clamshell-cutters" id="clamshell-cutters">
        <div class="container">
            {{-- <div class="product-heading">
                <h2 class="subheading">Related Products</h2>
                <div class="search-wrapper">
                    <div class="search-container">
                        <div class="search-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="separator"></div>
                        <input type="text" id="search-input" class="search-input" placeholder="Search">
                    </div>
                </div>
            </div> --}}
            <div class="all-products">
                <div class="row spcl-row justify-content-center">

                    @forelse($category->products as $product)
                        <div class="col-lg-3 col-md-6">
                            <div class="each-product">

                                {{-- Product Image --}}
                                <img src="{{ $product->featured_image_url ?? asset('website/assests/images/no-image.png') }}"
                                    alt="{{ $product->name }}">

                                <div class="eachproduct-content">

                                    {{-- Product Name --}}
                                    <a href="{{ route('productDetail', $product->id) }}">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($product->name ?? $product->name), 38) }}
                                    </a>

                                    {{-- Short Description --}}
                                    {{-- <p class="para">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($product->short_description ?? $product->long_description), 65) }}
                                    </p> --}}

                                    {{-- View Details --}}
                                    {{-- <a class="nav-link" href="{{ route('productDetail', $product->id) }}"> --}}
                                    <a class="nav-link" href="{{ route('productDetailBySlug', $product->slug) }}">
                                        View details
                                        {{-- Explore Range --}}
                                    </a>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No products found in this category.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
        // 'querySelectorAll' se hum jitne bhi 'search-input' class wale inputs hain sabko select kar lenge
        const searchInputs = document.querySelectorAll('.search-input');

        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                let searchQuery = this.value.toLowerCase().trim();

                // Apne product list ko target karein
                let productColumns = document.querySelectorAll('.all-products .row > div');

                productColumns.forEach(column => {
                    let productLink = column.querySelector('.eachproduct-content a');
                    if (productLink) {
                        let productName = productLink.innerText.toLowerCase();
                        // Match hone par show, nahi to hide
                        column.style.display = productName.includes(searchQuery) ? "block" : "none";
                    }
                });
            });
        });
    </script>
@endsection()
