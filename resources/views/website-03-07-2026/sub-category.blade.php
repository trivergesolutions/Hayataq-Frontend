@extends('website.layout.app')
<style>
    .subcategory-card {
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        background: #fff;
        transition: .3s;
    }

    .subcategory-products {
        display: none;
        margin-top: 30px;
        border-top: 1px solid #ddd;
        padding-top: 25px;
    }

    .product-card {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        transition: .3s;
        height: 100%;
    }

    .product-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
    }

    .product-card img {
        height: 170px;
        object-fit: contain;
    }

    .product-card h6 {
        margin-top: 15px;
        font-size: 16px;
    }

    .explore-btn {
        border: none;
        background: #e30613;
        color: #fff;
        padding: 10px 22px;
        border-radius: 6px;
        cursor: pointer;
    }
</style>
@if ($parentCategory->is_active == 1)
    @section('content')
        <!-- =============== Inner Banner =============== -->
        <section class="inner-banner" id="inner-banner"
            style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
            <div class="container">
                <div class="inner-content">
                    <h2 class="heading">{{ $parentCategory->name }}</h2>
                    <ul>
                        <li>
                            <a href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('mainProducts') }}">Products</a>
                        </li>
                        <li>{{ $parentCategory->name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- =============== Products =============== -->
        <section class="products bolt-torque" id="products">
            <div class="container">
                <div class="mainHeading main-product">
                    @if ($parentCategory->name == 'Portable Machining Tools')
                        <p class="para">High-performance onsite machining solutions for cutting, beveling, flange facing,
                            and
                            precision industrial maintenance applications.
                        </p>
                    @elseif ($parentCategory->name == 'Bolt Torque & Tensioning Tools')
                        <p class="para">Reliable hydraulic torque and bolt tensioning solutions designed for accurate,
                            controlled, and safe bolting operations.
                        </p>
                    @elseif ($parentCategory->name == 'Flange Alignment & Maintenance Tools')
                        <p class="para">Industrial tools engineered for safe flange alignment, spreading, and maintenance
                            during pipeline and shutdown operations.
                        </p>
                    @elseif ($parentCategory->name == 'Hydrotest Pumps & Systems')
                        <p class="para">High-pressure hydrostatic testing systems designed for reliable pressure testing,
                            inspection, and industrial maintenance applications.
                        </p>
                    @elseif ($parentCategory->name == 'Hydraulic Cylinders & Pumps')
                        <p class="para">Heavy-duty hydraulic cylinders and pump systems built for lifting, pulling,
                            pressing,
                            and controlled force applications.
                        </p>
                    @endif
                </div>
                <div class="all-products">
                    <div class="row spcl-row justify-content-center">
                        {{-- <div class="row"> --}}
                        @foreach ($parentCategory->children as $category)
                            @php
                                $images = $category->categoryDescription->images ?? [];
                                $featuredImage = collect($images)->where('is_featured', true)->first();
                                $imagePath =
                                    asset('category/' . $featuredImage['file_name']) ??
                                    asset('website/assests/images/placeholder.png');
                            @endphp
                            <div class="col-lg-3 col-md-6">
                                <div class="each-product">
                                    <img src="{{ $imagePath }}" alt="{{ $category->name }}">
                                    <div class="eachproduct-content">
                                        <a href="javascript:void(0)">
                                            {{ $category->name }}
                                        </a>
                                        <a href="javascript:void(0)" class="nav-link explore-range"
                                            data-target="products-{{ $category->id }}" data-title="{{ $category->name }}">
                                            Explore Range &nbsp;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                        <div id="products-wrapper" style="display:none">
                            <hr>
                            <div class="subcategory-product-section">
                                <div class="subcategory-heading">
                                    <span class="badge">Products</span>
                                    <h3 id="subcategoryTitle"></h3>
                                    <p>
                                        Browse all available products under this category.
                                    </p>
                                </div>
                                <div id="subcategoryProducts"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($parentCategory->children as $category)
                <div id="products-{{ $category->id }}" class="d-none">
                    <div class="all-products">
                        <div class="row spcl-row justify-content-center">
                            @forelse($category->products as $product)
                                <div class="col-lg-3 col-md-6">
                                    <div class="each-product">
                                        <img
                                            src="{{ $product->featured_image_url ?? asset('website/assests/images/no-image.png') }}">
                                        <div class="eachproduct-content">
                                            <a href="{{ route('productDetailBySlug', $product->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($product->name, 35) }}
                                            </a>
                                            <a class="nav-link" href="{{ route('productDetailBySlug', $product->slug) }}">
                                                View Range
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p>No products found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
        <script>
            const wrapper = document.getElementById("products-wrapper");
            document.querySelectorAll(".explore-range").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();
                    let target = this.dataset.target;
                    let title = this.dataset.title;
                    document.getElementById("subcategoryTitle").innerHTML = title;
                    document.getElementById("subcategoryProducts").innerHTML =
                        document.getElementById(target).innerHTML;
                    wrapper.style.display = "block";
                    wrapper.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                });
            });


            // document.addEventListener("DOMContentLoaded", function() {

            //     const wrapper = document.getElementById("products-wrapper");

            //     document.querySelectorAll(".explore-range").forEach(btn => {

            //         btn.addEventListener("click", function(e) {

            //             e.preventDefault();

            //             const id = this.dataset.target;

            //             const html = document.getElementById(id).innerHTML;

            //             if (wrapper.dataset.current == id) {

            //                 wrapper.style.display = "none";
            //                 wrapper.innerHTML = "";
            //                 wrapper.dataset.current = "";

            //                 return;

            //             }

            //             wrapper.innerHTML = html;
            //             wrapper.dataset.current = id;

            //             wrapper.style.display = "block";

            //             wrapper.scrollIntoView({
            //                 behavior: "smooth",
            //                 block: "start"
            //             });

            //         });

            //     });

            // });
        </script>
    @endsection()
@endif
@if ($parentCategory->is_active == 0)
    @section('content')
        <!-- =============== Inner Banner =============== -->
        <section class="inner-banner" id="inner-banner"
            style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
            <div class="container">
                <div class="inner-content">
                    <h2 class="heading">{{ $parentCategory->name }}</h2>
                    <ul>
                        <li>
                            <a href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('mainProducts') }}">Products</a>
                        </li>
                        <li>{{ $parentCategory->name }}</li>
                    </ul>
                </div>
            </div>
        </section>
        {{-- <section class="products bolt-torque" id="products"> --}}
        <section class="bolt-torque">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <img src="{{ asset('website/assests/images/comming-soon.jpeg') }}" alt="">
                    </div>
                </div>
                {{-- http://127.0.0.1:8000/website/assests/images/aboutimage-1.svg --}}
            </div>
        </section>
    @endsection
@endif
