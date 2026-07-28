@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner clamshell-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Clamshell Split-Frames Cutters and
                    Accessories</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Clamshell Split-Frames Cutters and Accessories</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products Details =============== -->
    <section class="productdetail-top bg-sky_blue" id="productdetail-top">
        <div class="container">
            <div class="row spcl-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('website/assests/images/portablemachine-2.svg') }}" alt="portablemachine-1">
                </div>
                <div class="col-lg-6">
                    <div class="productdetail-content">
                        <h2 class="subheading">Clamshell Split-Frames
                            Cutters and Accessories</h2>
                        <p class="para">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex
                            ea commodo consequat</p>
                        <ul>
                            <li>Sed ut perspiciatis unde omnis</li>
                            <li>Sed ut perspiciatis unde omnis</li>
                            <li>Sed ut perspiciatis unde omnis</li>
                            <li>Sed ut perspiciatis unde omnis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== Clamshell Split-Frames Cutters and Accessories =============== -->
    <section class="clamshell-cutters" id="clamshell-cutters">
        <div class="container">
            <div class="product-heading">
                <h2 class="subheading">All Products</h2>
                <div class="search-wrapper">
                    <div class="search-container">
                        <div class="search-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <div class="separator"></div>
                        <input type="text" id="search-input" placeholder="Search">
                    </div>
                </div>
            </div>
            <div class="all-products">
                <div class="row spcl-row justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/clamshell-1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="{{ route('productDetail') }}">Pipe Cutting & Beveling Machine</a>
                                <p class="para">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium....</p>
                                <a class="nav-link" href="{{ route('productDetail') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/clamshell-2.svg') }}" alt="clamshell-2">
                            <div class="eachproduct-content">
                                <a href="{{ route('productDetail') }}">Pipe Narrow Body Machine</a>
                                <p class="para">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium....</p>
                                <a class="nav-link" href="{{ route('productDetail') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/clamshell-3.svg') }}" alt="clamshell-3">
                            <div class="eachproduct-content">
                                <a href="{{ route('productDetail') }}">Drive Unit </a>
                                <p class="para">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium....</p>
                                <a class="nav-link" href="{{ route('productDetail') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/clamshell-4.svg') }}" alt="clamshell-4">
                            <div class="eachproduct-content">
                                <a href="{{ route('productDetail') }}">Cutters and Accessories</a>
                                <p class="para">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                    doloremque laudantium....</p>
                                <a class="nav-link" href="{{ route('productDetail') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
