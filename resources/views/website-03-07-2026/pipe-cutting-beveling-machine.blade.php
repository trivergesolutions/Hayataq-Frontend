@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner clamshell-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Pipe Cutting & Beveling Machine</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Pipe Cutting & Beveling Machine</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products Details =============== -->
    <section class="productdetail-top bg-sky_blue" id="productdetail-top">
        <div class="container">
            <div class="row spcl-row align-items-center">
                <div class="col-lg-5">
                    <img src="{{ asset('website/assests/images/pipe-cutting.svg') }}" alt="pipe-cutting">
                </div>
                <div class="col-lg-7">
                    <div class="productdetail-content">
                        <h2 class="subheading">Pipe Cutting & Beveling Machine</h2>
                        <p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                            in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
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
    <!-- =============== Pipe Cutting & Beveling Machine =============== -->
    <section class="clamshell-cutters pipe-cutting" id="clamshell-cutters">
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
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="{{ route('productDetail') }}">DLRHD32, Heavy Duty Clamshell Pipe Cutter, 20-32"
                                    (508-813
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="{{ route('productDetail') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD36, Heavy Duty Clamshell Pipe Cutter, 24-36" (610-914
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD39, Heavy Duty Clamshell Pipe Cutter, 27-39" (686-990
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD43, Heavy Duty Clamshell Pipe Cutter, 31-43" (787-1092
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD45, Heavy Duty Clamshell Pipe Cutter, 33-45" (838-1143
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD53, Heavy Duty Clamshell Pipe Cutter, 41-53" (1042-1346
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD43, Heavy Duty Clamshell Pipe Cutter, 31-43" (787-1092
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD45, Heavy Duty Clamshell Pipe Cutter, 33-45" (838-1143
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 product-item">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/beveling-machine1.svg') }}" alt="clamshell-1">
                            <div class="eachproduct-content">
                                <a href="product-details.html">DLRHD53, Heavy Duty Clamshell Pipe Cutter, 41-53" (1042-1346
                                    mm) Mounting Diameter</a>
                                <span>Heavy Duty Clamshell</span>
                                <a class="nav-link" href="product-details.html">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn load-more">Load more <img
                                src="{{ asset('website/assests/images/reload.svg') }}" alt="reload"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
