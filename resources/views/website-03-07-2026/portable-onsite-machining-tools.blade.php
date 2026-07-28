@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Portable Onsite Machining Tools</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Portable Onsite Machining Tools</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products Details =============== -->
    <section class="productdetail-top bg-sky_blue" id="productdetail-top">
        <div class="container">
            <div class="row spcl-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('website/assests/images/portablemachine-1.svg') }}" alt="portablemachine-1">
                </div>
                <div class="col-lg-6">
                    <div class="productdetail-content">
                        <h2 class="subheading">Portable Onsite Machining Tools</h2>
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
    <!-- =============== Products =============== -->
    <section class="products" id="products">
        <div class="container">
            <div class="mainHeading">
                <h2 class="subheading">Portable Onsite Machining Tools</h2>
                <p class="para">High-performance onsite machining solutions for cutting, beveling, and flange facing.</p>
            </div>
            <div class="all-products">
                <div class="row spcl-row justify-content-center">
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/portablemachine-2.svg') }}" alt="portablemachine-2">
                            <div class="eachproduct-content">
                                <a href="{{ route('clamshellSplitFramesCuttersandAccessories') }}">Clamshell Split-Frames
                                    Cutters and
                                    Accessories</a>
                                <a class="nav-link" href="{{ route('clamshellSplitFramesCuttersandAccessories') }}">View
                                    details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/portablemachine-3.svg') }}" alt="portablemachine-3">
                            <div class="eachproduct-content">
                                <a href="clamshell-split-frames-cutters-accessories.html">I.D Mount Pipe Bevelers</a>
                                <a class="nav-link" href="clamshell-split-frames-cutters-accessories.html">View details </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="each-product">
                            <img src="{{ asset('website/assests/images/portablemachine-4.svg') }}" alt="portablemachine-4">
                            <div class="eachproduct-content">
                                <a href="clamshell-split-frames-cutters-accessories.html">Flange Facers</a>
                                <a class="nav-link" href="clamshell-split-frames-cutters-accessories.html">View details </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
