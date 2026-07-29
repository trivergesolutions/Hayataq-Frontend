@extends('website.layout.app')
@section('content')
    <style>
        .why-us-section {
            padding: 40px 0;
        }

        /*============================
                                                                                                                                                                                                        FEATURE BOX
                                                                                                                                                                                                    =============================*/

        .feature-box {

            background: #fff;

            border: 1px solid #e8edf7;

            border-radius: 16px;

            padding: 22px 28px;

            box-shadow: 0 8px 25px rgba(0, 0, 0, .05);

            margin-bottom: 22px;

        }

        .feature-item {

            display: flex;

            align-items: flex-start;

            gap: 14px;

            height: 100%;

        }

        .feature-icon {

            min-width: 42px;

            width: 42px;

            height: 42px;

            border-radius: 50%;

            /* background: #f4f7ff; */
            background: #e9eefc;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid #e5eaf6;

        }

        .feature-icon i {
            color: #072677;
            font-size: 20px;
        }

        .feature-content strong {

            /* font-size: 17px; */
            font-size: 15px;

            font-weight: 700;

            color: #1b1b1b;

            margin-bottom: 3px;

            line-height: 1.3;

        }

        .feature-content p {

            margin: 0;

            color: #707070;

            font-size: 14px;

            line-height: 1.4;

        }

        /*============================
                                                                                                                                                                                                            CTA
                                                                                                                                                                                                    =============================*/

        .cta-box {

            background: #12358d;

            border-radius: 14px;

            /* padding: 34px 38px; */
            padding: 20px 38px;

            /* display: flex; */

            align-items: center;

            box-shadow: 0 10px 30px rgba(18, 53, 141, .25);

        }

        .cta-box h3 {

            color: #fff;

            /* font-size: 34px; */
            font-size: 25px;

            font-weight: 700;

            margin-bottom: 10px;

        }

        .cta-box p {

            color: #d9e3ff;

            /* font-size: 16px; */
            font-size: 15px;

            margin: 0;

        }

        .contact-btn {
            width: 100% !important;
            height: auto !important;
            display: inline-flex;
            align-items: center;
            gap: 14px;
            background: #fff !important;
            color: #12358d !important;
            text-decoration: none !important;
            font-weight: 600 !important;
            /* padding: 16px 34px !important; */
            padding: 11px 16px !important;
            border-radius: 10px !important;
            transition: .35s !important;
            border: 2px solid transparent !important;
            font-size: 15px !important;
        }

        .contact-btn:hover {

            background: transparent;

            color: #fff;

            border-color: #fff;

        }

        .contact-btn i {

            transition: .35s;

        }

        .contact-btn:hover i {

            transform: translateX(6px);

        }

        /*============================
                                                                                                                                                                                                          RESPONSIVE
                                                                                                                                                                                                    =============================*/

        @media(max-width:991px) {

            .feature-box {

                padding: 20px;

            }

            .feature-item {

                margin-bottom: 20px;

            }

            .cta-box {

                padding: 30px;

                text-align: center;

            }

            .cta-box h3 {

                font-size: 28px;

            }

            .contact-btn {

                margin-top: 15px;

            }

        }

        @media(max-width:767px) {

            .feature-item {

                margin-bottom: 25px;

            }

            .feature-content strong {

                font-size: 15px;

            }

            .feature-content p {

                font-size: 13px;

            }

            .cta-box {

                padding: 25px 20px;

            }

            .cta-box h3 {

                font-size: 24px;

            }

            .cta-box p {

                font-size: 14px;

            }

            .contact-btn {

                width: 100%;

                justify-content: center;

            }

        }

        .feature-box .row {
            /* display: grid; */
            grid-template-columns: repeat(5, 1fr);
            /* gap: 30px; */
        }

        @media(max-width:991px) {
            .feature-box .row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:576px) {
            .feature-box .row {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Products</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Products</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products =============== -->
    <section class="products bg-sky_blue" id="products">
        <div class="container">
            <div class="mainHeading main-product">
                <h2 class="subheading">Product Categories</h2>
                <p class="para">Explore our range of onsite machining and industrial tooling solutions.</p>
            </div>
            <div class="all-products">
                <div class="row spcl-row justify-content-center">
                    @foreach ($categories as $category)
                        <div class="col-lg-3 col-md-6">
                            <div class="each-product">
                                @php
                                    $imageUrl = asset(
                                        'category/' . $category->categoryDescription->images[0]['file_name'],
                                    );
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $category->name }}"
                                    style="width: 100%; height: auto;">
                                <div class="eachproduct-content">
                                    <a href="{{ route('subCategory', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                    <p class="mb-3">
                                        {{ \Illuminate\Support\Str::limit($category->categoryDescription->description, 100) }}
                                    </p>
                                    <a class="learnmorebutton" href="{{ route('subCategory', $category->slug) }}">
                                        {{-- View details --}}
                                        View Products
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <section class="why-us-section">
                <div class="container">
                    <!-- Top Features -->
                    <div class="feature-box">
                        <div class="row g-0 justify-content-center">
                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fa-solid fa-globe"></i>
                                    </div>
                                    <div class="feature-content">
                                        <strong>Global Quality Standards</strong>
                                        <p>ISO-certified products</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                    </div>
                                    <div class="feature-content">
                                        <strong>Onsite Solutions</strong>
                                        <p>Minimize downtime</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fa-regular fa-user"></i>
                                    </div>
                                    <div class="feature-content">
                                        <strong>Expert Support</strong>
                                        <p>From selection to service</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div class="feature-content">
                                        <strong>Fast & Reliable Delivery</strong>
                                        <p>Worldwide shipping</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-6 my-1">
                                <div class="feature-item">
                                    <div class="feature-icon">
                                        <i class="fa-solid fa-industry"></i>
                                    </div>
                                    <div class="feature-content">
                                        <strong>Trusted by Industries</strong>
                                        <p>Oil & Gas, Power, Marine & more</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="cta-box">

                        <div class="row align-items-center">

                            <div class="col-lg-9 col-md-9">

                                <h3>Need Help Choosing the Right Solution?</h3>

                                <p>
                                    Our experts are here to help you find the best tools for your project.
                                </p>

                            </div>

                            <div class="col-lg-3 col-md-3 text-lg-end mt-4 mt-lg-0">

                                <a href="{{ route('contactPage') }}" class="contact-btn">

                                    Contact Our Experts

                                    <i class="fa-solid fa-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>
        </div>
    </section>
@endsection()
