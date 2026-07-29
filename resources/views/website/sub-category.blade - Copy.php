@extends('website.layout.app')
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
                        @foreach ($parentCategory->children as $category)
                            <div class="col-lg-3 col-md-6">
                                <div class="each-product">
                                    @php
                                        // 1. Category Description se images array nikalna
                                        $images = $category->categoryDescription->images ?? [];

                                        // 2. Featured image dhundna (is_featured == true)
                                        $featuredImage = collect($images)->where('is_featured', true)->first();

                                        // 3. Agar featured image milti hai to uska path, warna placeholder
                                        $imagePath =
                                            $featuredImage['full_path'] ??
                                            asset('website/assests/images/placeholder.png');
                                    @endphp

                                    <!-- Dynamic Image Binding -->
                                    <img src="{{ $imagePath }}" alt="{{ $category->name }}">

                                    <div class="eachproduct-content">
                                        <!-- Dynamic Name and Slug Binding -->
                                        <a href="{{ route('sub_category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>

                                        <a class="nav-link" href="{{ route('sub_category', $category->slug) }}">
                                            {{-- View details --}}
                                            Explore Range
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
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
