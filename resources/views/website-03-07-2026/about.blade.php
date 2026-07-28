@extends('website.layout.app')
@section('title', $seo->meta_title ?? 'HAYA TEQ')

@section('meta_description', $seo->meta_description ?? '')

@section('meta_keywords', $seo->meta_keywords ?? '')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">About Company</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== About =============== -->
    <section class="about" id="about">
        <div class="container">
            <div class="row spcl-row">
                <div class="col-lg-6">
                    <div class="about-left">
                        <h2 class="heading">About Us</h2>
                        {{-- <p class="para text-justify">We started as an engineering-driven company, supporting construction
                            and commissioning projects with practical, site-focused solutions. By developing
                            detailed procedures and defining the exact tools required for each job, we ensured our customers
                            were fully prepared before work began.</p>
                        <p class="para text-justify">Established in 2014, we have grown into a trusted
                            provider of industrial tools and equipment fordemanding environments. Our products are built
                            from real field experience, with a clear focus on reliability, safety, and long service life.
                        </p>
                        <p class="para text-justify">Today, Haya TEQ Tools and Equipment has a proven
                            track record in supplying specialised tools for engineering and industrial applications. Our
                            solutions
                            are trusted on major projects across Australia, Asia, the United States, and the Middle East.
                        </p> --}}
                        {{-- <p>================================================================</p> --}}
                        <p class="para text-justify">
                            We started as an engineering-driven company, supporting construction and commissioning projects
                            with practical, site-focused solutions. By developing detailed procedures and defining the exact
                            tools required for each job, we ensured that our customers were fully prepared before work
                            began.
                        </p>

                        <p class="para text-justify">
                            Established in 2014, we have grown into a trusted provider of industrial tools and equipment for
                            demanding environments. Our products are built from real field experience, with a clear focus on
                            reliability, safety, and long service life.
                        </p>

                        <p class="para text-justify">
                            Today, Haya TEQ Tools and Equipment has a proven track record of supplying specialised tools for
                            engineering and industrial applications. Our solutions are trusted on major projects across
                            Australia, Asia, United States, and Middle East.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="aboutsec-image">
                        <div class="aboutsec-right">
                            <img src="{{ asset('website/assests/images/aboutimage-1.png') }}" alt="aboutimage-1">
                        </div>
                        <div class="yearsExp">
                            {{-- <h5 class="heading">2014</h5> --}}
                            {{-- <p class="para">Since</p> --}}
                            {{-- <h5 class="heading">2014</h5>
                            <p class="para">Since</p> --}}
                            <h5 class="heading">12+</h5>
                            <p class="para">Years of Industry Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-none">
                    <div class="about-bottom">
                        <p class="para" style="text-align: justify;">Today, Haya TEQ Tools and Equipment has a proven
                            track record in supplying specialised tools forengineering and industrial applications. Our
                            solutions
                            are trusted on major projects across Australia, Asia, the United States, and the Middle East.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =============== About Us =============== -->
    <section class="about-sec" id="about-sec">
        <div class="container">
            <div class="row align-items-center spcl-row">
                <div class="col-lg-5">
                    <img src="{{ asset('website/assests/images/home-about.png') }}" alt="home-about">
                </div>
                <div class="col-lg-7">
                    <div class="about-right">
                        {{-- <span>About Us</span> --}}
                        {{-- <h2 class="heading">We Work for you Since 2014
                            Industrial Around the World</h2> --}}
                        <h2 class="heading">Supporting Industrial Operations Worldwide Since 2014</h2>
                        <p class="para w-100">Welcome to HAYA TEQ, where practical engineering meets
                            industrial precision. Over the years, we’ve built a reputation
                            for delivering reliable tools and solutions that stand up to the
                            toughest industrial challenges</p>
                        <div class="tab-container">
                            <div class="tabs-header">
                                <div class="tab-link active" data-tab="history">Our
                                    History</div>
                                <div class="tab-link" data-tab="mission">Our
                                    Mission</div>
                                <div class="tab-link" data-tab="vision">Our Vision</div>
                            </div>
                            <div id="history" class="tab-content current">
                                <p>
                                    From a modest workshop to a trusted partner for global
                                    industries, our journey has always been guided by quality,
                                    innovation, and real-world performance. We’ve grown by
                                    listening to our customers and pushing the limits of what
                                    industrial tools can achieve.
                                </p>
                                {{-- <a href="#" class="btn">Read
                                    More</a> --}}
                            </div>
                            <div id="mission" class="tab-content">
                                <p>
                                    To deliver durable, efficient, and safe industrial solutions that
                                    help our clients succeed. We focus on practical innovation,
                                    continuous improvement, and creating tangible value in
                                    every project we serve.
                                </p>
                                {{-- <a href="#" class="btn">Read
                                    More</a> --}}
                            </div>
                            <div id="vision" class="tab-content">
                                <p>
                                    To empower industries worldwide with precision-engineered tools and solutions. We aim to
                                    set the standard for reliability, performance, and innovation, helping
                                    industries thrive today and into the future.
                                </p>
                                {{-- <a href="#" class="btn">Read
                                    More</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="homeabout">
            <img src="{{ asset('website/assests/images/homeabout-bg.png') }}" alt="homeabout-bg">
        </div>
    </section>
@endsection
