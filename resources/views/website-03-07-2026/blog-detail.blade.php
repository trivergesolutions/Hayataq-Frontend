@extends('website.layout.app')
@section('title', $seo->meta_title ?? 'HAYA TEQ')

@section('meta_description', $seo->meta_description ?? '')

@section('meta_keywords', $seo->meta_keywords ?? '')
@section('content')
    <div id="progress-bar"></div>
    <!-- =============== Inner Banner =============== -->
    <div class="blog-hero">
        <div class="hero-overlay"></div>
        {{-- <img src="{{ asset('website/assests/images/blog1.svg') }}" alt="Offshore Rig" class="hero-img"> --}}
        {{-- <img src="{{ asset('website/assests/images/blog1.svg') }}" alt="Offshore Rig" class="hero-img"> --}}
        <img src="{{ $blog->featured_image ? $blog->featured_image : asset('website/assests/images/blog1.svg') }}"
            alt="Offshore Rig" class="hero-img">
        <div class="hero-content">
            <span class="category-tag">{{ $blog->categories->first()->name }}</span>
            <h1 class="blog_title">{{ $blog->title }}</h1>
            <div class="post-meta mb-3">
                <span class="author"><i class="bi bi-person-fill"></i> By
                    {{ $blog->author->name }}</span>
                <span class="date"><i class="bi bi-calendar-week-fill"></i>
                    {{ $blog->created_at->format('M d, Y') }}</span>
                {{-- <span class="read-time"><i class="bi bi-clock-fill"></i> 8 Min
                    Read</span> --}}
            </div>
        </div>
    </div>
    <!-- =============== Blogs =============== -->
    <div class="blog-details" id="blog-details">
        <div class="content-container">
            <aside class="share-sidebar">
                <p>SHARE</p>
                <a href="#">
                    <!--<i class="fa fa-facebook" aria-hidden="true"></i>-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        class="bi bi-twitter-x" fill="currentColor"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M240 363.3L240 576L356 576L356 363.3L442.5 363.3L460.5 265.5L356 265.5L356 230.9C356 179.2 376.3 159.4 428.7 159.4C445 159.4 458.1 159.8 465.7 160.6L465.7 71.9C451.4 68 416.4 64 396.2 64C289.3 64 240 114.5 240 223.4L240 265.5L174 265.5L174 363.3L240 363.3z" />
                    </svg>
                    </a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        class="bi bi-twitter-x" fill="currentColor"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M196.3 512L103.4 512L103.4 212.9L196.3 212.9L196.3 512zM149.8 172.1C120.1 172.1 96 147.5 96 117.8C96 103.5 101.7 89.9 111.8 79.8C121.9 69.7 135.6 64 149.8 64C164 64 177.7 69.7 187.8 79.8C197.9 89.9 203.6 103.6 203.6 117.8C203.6 147.5 179.5 172.1 149.8 172.1zM543.9 512L451.2 512L451.2 366.4C451.2 331.7 450.5 287.2 402.9 287.2C354.6 287.2 347.2 324.9 347.2 363.9L347.2 512L254.4 512L254.4 212.9L343.5 212.9L343.5 253.7L344.8 253.7C357.2 230.2 387.5 205.4 432.7 205.4C526.7 205.4 544 267.3 544 347.7L544 512L543.9 512z" />
                    </svg></a>
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path
                            d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg></a>
            </aside>

            <main class="main-article">
                {{-- <p class="lead-text">
                    Managing high-pressure environments in offshore drilling
                    and
                    the energy sector is currently one of the greatest
                    technical
                    challenges. Today, we discuss how modern technology is
                    simplifying these complexities.
                </p>

                <h3>The Role of Industrial Automation</h3>
                <p class="para">
                    Over the past decade, the use of automation in offshore
                    rigs
                    has increased manifold. Especially in the deep layers of
                    the
                    ocean where human reach is difficult, smart sensors and
                    robotic equipment are operating with extreme precision.
                </p>

                <blockquote class="quote-box">
                    "There is no alternative to the right equipment for safe and efficient industrial operation."
                </blockquote>

                <p>
                    The high-pressure equipment we supply is not only
                    durable
                    but also capable of maintaining its performance in
                    extreme
                    weather conditions. From steel manufacturing to cement
                    production, these innovations are bringing revolutionary
                    changes to every step of the industrial process.
                </p>

                <p>
                    By integrating IoT-enabled monitoring systems, companies
                    can
                    now predict maintenance needs before a failure occurs,
                    ensuring zero downtime and maximum safety for the
                    workforce.
                </p> --}}
                {!! $blog->content !!}
            </main>
        </div>
    </div>
    <script>
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progress-bar").style.width = scrolled + "%";
        };
    </script>
@endsection
