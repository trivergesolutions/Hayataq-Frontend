@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Blogs</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Blogs =============== -->
    <section class="blogs bg-sky_blue" id="blogs">
        <div class="container">
            <div class="mainHeading">
                <h2 class="subheading">Our Blogs & Resources</h2>
                <p class="para">Catalogues, operation manuals and
                    certifications – all in one place</p>
            </div>
            <div class="all-blogs">
                <div class="row">
                    @if ($blogs->count())
                        @foreach ($blogs as $blog)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="glass-card">

                                    {{-- Image --}}
                                    <div class="image-box">
                                        {{-- <img src="{{ asset('website/assests/images/blog1.svg') }}" --}}
                                        <img src="{{ $blog->featured_image ?? asset('website/assests/images/no-image.png') }}"
                                            alt="{{ $blog->title }}">
                                        {{-- <img src="{{ $blog->featured_image ? $blog->featured_image : asset('website/assets/images/blog1.svg') }}"
                                            alt="{{ $blog->title }}"> --}}

                                        {{-- Category (first only) --}}
                                        @if ($blog->categories->isNotEmpty())
                                            <div class="tag-overlay">
                                                {{ $blog->categories->first()->name }}
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div class="content-float">
                                        <span class="date-text">
                                            {{ $blog->created_at->format('d M, Y') }}
                                        </span>

                                        <h3>{{ \Illuminate\Support\Str::limit(strip_tags($blog->title), 50) }}</h3>

                                        <p>
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 50) }}
                                        </p>

                                        <a href="{{ route('blogDetailPage', $blog->slug) }}" class="explore-link">
                                            Read Full Story
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>No blogs found.</p>
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-container">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
