@extends('website.layout.app')
@section('title', $seo->meta_title ?? 'HAYA TEQ')

@section('meta_description', $seo->meta_description ?? '')

@section('meta_keywords', $seo->meta_keywords ?? '')
@section('content')
    <!-- =============== Banner =============== -->
    <section class="banner" id="banner">
        <div class="container">
            <div class="banner-content">
                {{-- <h1 class="heading">Precision Tools. Real-World Performance.</h1> --}}
                <h1 class="heading">Industrial Tools & Onsite Machining Solutions.</h1>
                <h6 class="sub-heading"> Built for Industry. Made to Last.</h6>
                {{-- <h1 class="heading">Driving Excellence in High-Pressure
                    Hydraulic Tools</h1> --}}
                <p class="para text-white mb-3" style="position: relative; z-index:1;">Providing portable machining, bolt
                    torque and tensioning, flange maintenance, hydrotesting, and hydraulic solutions for safe, efficient,
                    and reliable industrial operations.</p>
                {{-- <p class="para text-white mb-3" style="position: relative; z-index:1;">High-pressure hydraulic and portable
                    machining solutions
                    engineered to keep industries running safely, efficiently, and
                    reliably.</p> --}}
                <a href="{{ route('mainProducts') }}" class="btn">Explore Now</a>
            </div>
        </div>
    </section>
    <!-- =============== Shop By Category =============== -->
    <section class="shopby" id="shopby">
        <div class="container">
            <div class="mainHeading">
                <h2 class="heading">Category</h2>
                <p class="para">Explore our range of onsite machining
                    and industrial tooling solutions.</p>
            </div>
            <div class="totalShop">
                <div class="row spcl-row">
                    @foreach ($categories as $category)
                        @php
                            $image = optional($category->categoryDescription)->images
                                ? collect($category->categoryDescription->images)->firstWhere('is_featured', true)
                                : null;

                            // $imageUrl = $image['full_path'] ?? asset('website/assests/images/default-category.svg');
                            $imageUrl =
                                asset('category/' . $image['file_name']) ??
                                asset('website/assests/images/default-category.svg');
                        @endphp

                        <div class="col-lg col-md-6 col-sm-6 col-12">
                            <div class="shop-card">
                                <div class="imageshop-part">
                                    <div class="shop-image">
                                        <img src="{{ $imageUrl }}" alt="{{ $category->name }}">
                                    </div>
                                </div>

                                <div class="card-bottom">
                                    <h2 class="card-heading">
                                        {{ $category->name }}
                                    </h2>

                                    <a href="{{ url('category/' . $category->slug) }}" class="corner-shape">
                                        <img src="{{ asset('website/assests/images/arrow.svg') }}" alt="arrow">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- =============== Industries We Serve =============== -->
    <section class="industry-serve bg-blue" id="industry-serve">
        <div class="container">
            <div class="mainHeading">
                <h2 class="heading">Industries We Serve</h2>
                {{-- <p class="para">We have consistently provided the right
                    tools and solutions for a wide range of industries.</p> --}}
                <p class="para">HAYA TEQ provides reliable industrial tools and onsite machining solutions for a wide
                    range of industries, including oil & gas, steel manufacturing, power generation, renewable energy, sugar
                    processing, cement production, and heavy industrial maintenance. Our equipment supports critical
                    applications such as controlled bolting, flange maintenance, hydrotesting, hydraulic lifting, and
                    precision onsite machining, helping industries improve safety, efficiency, and operational performance.
                </p>
            </div>
        </div>
        <div class="industry-part">
            <div class="swiper industrySlider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-1.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Oil & Gas <br> (Onshore
                                    & Offshore)</h2>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-2.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Steel Manufacturing</h2>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-3.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Power Plants</h2>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-4.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Solar & Wind Energy</h2>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-5.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Sugar Processing</h2>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="each-industry"
                            style="background-image: url({{ asset('website/assests/images/industry-6.png') }});">
                            <div class="eachindustry-content">
                                <h2 class="heading">Cement Production</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="prev_next_btn">
                <div class="prev_btn"><i class="bi bi-arrow-left"></i></div>
                <div class="next_btn"><i class="bi bi-arrow-right"></i></div>
            </div>
        </div>
    </section>

    <!-- =============== What We Do =============== -->
    <section class="what-we bg-sky_blue" id="what-we">
        <div class="container">
            <div class="mainHeading">
                <h2 class="heading">What We Do ?</h2>
                <p class="para">Our expertise lies in the design and
                    manufacture of tools engineered to customer
                    specifications. Each solution is developed to meet exact
                    technical, operational, and site requirements, ensuring
                    consistent performance in real-world conditions</p>
            </div>
            <div class="all-doing">
                <div class="row spcl-row justify-content-center">
                    <div class="col-lg col-md-6 col-6">
                        <div class="we-all">
                            <div class="weall_img">
                                <img src="{{ asset('website/assests/images/1.svg') }}" alt="do-1">
                            </div>
                            <div class="weall-content">
                                <p class="para" style="font-size:16px;">Portable Machining Tools</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-6">
                        <div class="we-all">
                            <div class="weall_img">
                                <img src="{{ asset('website/assests/images/2.svg') }}" alt="do-1">
                            </div>
                            <div class="weall-content">
                                <p class="para" style="font-size:16px;">
                                    Bolt Torque & Tensioning Tools</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-6">
                        <div class="we-all">
                            <div class="weall_img">
                                <img src="{{ asset('website/assests/images/3.svg') }}" alt="do-1">
                            </div>
                            <div class="weall-content">
                                <p class="para" style="font-size:16px;">Flange Alignment & Maintenance Tools</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-6">
                        <div class="we-all">
                            <div class="weall_img">
                                <img src="{{ asset('website/assests/images/4.svg') }}" alt="do-1">
                            </div>
                            <div class="weall-content">
                                <p class="para" style="font-size:16px;">Pressure Testing Systems</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-6">
                        <div class="we-all">
                            <div class="weall_img">
                                <img src="{{ asset('website/assests/images/5.svg') }}" alt="do-1">
                            </div>
                            <div class="weall-content">
                                <p class="para" style="font-size:16px;">Hydraulic Cylinders & Pumps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== What Sets Our Products Apart =============== -->
    <section class="set-products" id="set-products">
        <div class="container">
            <div class="row spcl-row align-items-center">
                <div class="col-lg-6">
                    <div class="product-visual">
                        <div class="visual-container">
                            <img src="{{ asset('website/assests/images/about-product-apart.png') }}"
                                alt="Industrial Excellence">

                            {{-- <div class="spec-label p1"><span>High-PSI
                                    Resistance</span></div> --}}
                            {{-- <div class="spec-label p2"><span>Anti-Corrosion
                                    Tech</span></div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-right">
                        <h2 class="subheading">What Sets Our Products
                            Apart ?</h2>
                        <p class="subpara" style="text-align: justify;">Our tools are built for longevity. Every design
                            decision is driven by real load conditions, duty
                            cycles, and on-site realities-not catalogue
                            assumptions. Materials, tolerances, and finishes are carefully selected to withstand repeated
                            use in harsh environments, reducing downtime and extending service life.</p>
                        <p class="subpara" style="text-align: justify;">Each solution is developed and tested with
                            performance and durability in mind, ensuring
                            consistent reliability long after commissioning.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== WHY HAYA TEQ =============== -->
    <section class="why-hayateq" id="why-hayateq">
        <div class="container">
            <div class="mainHeading">
                <span>WHY HAYA TEQ ?</span>
                <h2 class="subheading">Engineering Solutions Built for
                    Real-World Performance</h2>
                <p class="para">At HAYA TEQ, we combine technical expertise with practical, field-proven solutions. Every
                    tool we supply is designed to meet the demands of real-world operations. Our focus is
                    straightforward: precision, reliability, and
                    performance you can depend on.</p>
            </div>
            <div class="real-world">
                <div class="row spcl-row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="each-world">
                            <span>01</span>
                            <div class="world-content">
                                <h2>Precision</h2>
                                <p class="para">Accuracy engineered for critical industrial standards.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-world">
                            <span>02</span>
                            <div class="world-content">
                                <h2>Reliability</h2>
                                <p class="para">Performance you can trust, even in harsh field conditions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-world">
                            <span>03</span>
                            <div class="world-content">
                                <h2>Performance</h2>
                                <p class="para">Efficiency, safety, and consistency built into every tool.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== Applications of Our Tools and Equipment =============== -->
    <section class="application-tools bg-sky_blue" id="application-tools">
        <div class="container">
            <div class="mainHeading">
                <h2 class="subheading">Applications Of Our Tools And
                    Equipment</h2>
                <p class="para">Our tools are used for precision assembly,
                    maintenance, and shutdown activities across multiple
                    industries, including:</p>
            </div>
            <div class="all-application">
                <div class="swiper applicationSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-1.svg') }}"
                                        alt="application-tool-1">
                                </div>
                                <div class="application-content">
                                    <p class="para">Oil & Gas</p>
                                    <p class="subpara">For pipeline flanges,
                                        wellhead connections, and valve
                                        assemblies</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-2.svg') }}"
                                        alt="application-tool-2">
                                </div>
                                <div class="application-content">
                                    <p class="para">Offshore</p>
                                    <p class="subpara">For rig maintenance,
                                        subsea connections, and high-torque
                                        applications</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-3.svg') }}"
                                        alt="application-tool-3">
                                </div>
                                <div class="application-content">
                                    <p class="para">Marine </p>
                                    <p class="subpara">For propulsion
                                        systems, engine mounts, and
                                        structural bolting</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-4.svg') }}"
                                        alt="application-tool-4">
                                </div>
                                <div class="application-content">
                                    <p class="para">Petrochemicals</p>
                                    <p class="subpara">For reactor vessels,
                                        heat exchangers, and process
                                        piping</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper applicationSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-5.svg') }}"
                                        alt="application-tool-5">
                                </div>
                                <div class="application-content">
                                    <p class="para">Fertilizer Plants</p>
                                    <p class="subpara">Compressors, process
                                        units, and ammonia lines</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-6.svg') }}"
                                        alt="application-tool-6">
                                </div>
                                <div class="application-content">
                                    <p class="para">Firefighting Systems</p>
                                    <p class="subpara">Pump skids and
                                        high-pressure pipeline fittings</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-7.svg') }}"
                                        alt="application-tool-7">
                                </div>
                                <div class="application-content">
                                    <p class="para">Food & Beverage</p>
                                    <p class="subpara">Hygienic piping,
                                        processing equipment, and
                                        maintenance</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="each-application">
                                <div class="app-icon">
                                    <img src="{{ asset('website/assests/images/application-tool-8.svg') }}"
                                        alt="application-tool-8">
                                </div>
                                <div class="application-content">
                                    <p class="para">Water & Irrigation</p>
                                    <p class="subpara">Pipeline connections,
                                        pumps, and valves</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prev_next_btn">
                    <div class="prev_btn"><i class="bi bi-arrow-left"></i></div>
                    <div class="next_btn"><i class="bi bi-arrow-right"></i></div>
                </div>
            </div>
        </div>
    </section>

    <!-- =============== Articles & Blog Post =============== -->
    {{-- <section class="articles bg-gray" id="articles">
        <div class="container">
            <div class="mainHeading">
                <h2 class="heading">Articles & Blog Post</h2>
            </div>
            <div class="allarticles">
                <div class="row spcl-row">
                    <div class="col-lg-4">
                        <div class="article-left">
                            <img src="{{ asset('website/assests/images/article1.svg') }}" alt="article1">
                            <div class="article-content">
                                <div class="articleunit">
                                    <h3>Manufacturing Unit</h3>
                                    <div class="articledate">Jan 25,
                                        2025</div>
                                </div>
                                <h2>TOP SELLING TRENDS</h2>
                                <p class="para">Lorem Ipsum has been the
                                    industry's standard dummy text ever
                                    since the 1500s,</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row article-row spcl-row">
                            <div class="col-lg-12">
                                <div class="article-right">
                                    <div class="eacharticle-left">
                                        <h2>TOP SELLING TRENDS</h2>
                                        <p class="para">Lorem Ipsum has been
                                            the industry's standard dummy
                                            text ever since the 1500s,</p>
                                    </div>
                                    <div class="eacharticle-right">
                                        <img src="{{ asset('website/assests/images/article2.svg') }}" alt="article2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="article-right">
                                    <div class="eacharticle-left">
                                        <h2>TOP SELLING TRENDS</h2>
                                        <p class="para">Lorem Ipsum has been
                                            the industry's standard dummy
                                            text ever since the 1500s,</p>
                                    </div>
                                    <div class="eacharticle-right">
                                        <img src="{{ asset('website/assests/images/article3.svg') }}" alt="article3">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="article-right">
                                    <div class="eacharticle-left">
                                        <h2>TOP SELLING TRENDS</h2>
                                        <p class="para">Lorem Ipsum has been
                                            the industry's standard dummy
                                            text ever since the 1500s,</p>
                                    </div>
                                    <div class="eacharticle-right">
                                        <img src="{{ asset('website/assests/images/article4.svg') }}" alt="article4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- =============== Why Choose Us? =============== -->
    <section class="why-choose" id="why-choose">
        <div class="container">
            <div class="mainHeading">
                <h2 class="heading">What Sets Us Apart ?</h2>
                <p class="para">Trusted by Industry Professionals</p>
            </div>
            <div class="totalchoose">
                <div class="row spcl-row">
                    <div class="col-lg-3 col-md-6">
                        <div class="eachchoose">
                            <div class="chooseimage">
                                <img src="{{ asset('website/assests/images/choose1.png') }}" alt="choose1">
                            </div>
                            <div class="eachchoose-content">
                                <h5>Expert Support</h5>
                                <p class="para">Responsive, knowledgeable support to keep your operations running
                                    without delays.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="eachchoose">
                            <div class="chooseimage">
                                <img src="{{ asset('website/assests/images/choose2.png') }}" alt="choose2">
                            </div>
                            <div class="eachchoose-content">
                                <h5>Proven Product Quality</h5>
                                <p class="para">Tools engineered for precision, durability, and consistent performance in
                                    demanding industrial environments.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="eachchoose">
                            <div class="chooseimage">
                                <img src="{{ asset('website/assests/images/choose3.png') }}" alt="choose3">
                            </div>
                            <div class="eachchoose-content">
                                <h5>Custom Engineering Solutions</h5>
                                <p class="para">Tailored solutions designed around actual site conditions,
                                    not standard assumptions.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="eachchoose">
                            <div class="chooseimage">
                                <img src="{{ asset('website/assests/images/choose4.png') }}" alt="choose4">
                            </div>
                            <div class="eachchoose-content">
                                <h5>Reliable Delivery</h5>
                                <p class="para">On-time, dependable delivery you can plan your projects
                                    around with confidence.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
