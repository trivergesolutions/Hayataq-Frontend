@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">{{ $section->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('downloadPage') }}">Resources</a>
                    </li>
                    <li>{{ $section->title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Downloads =============== -->
    <section class="downloads bg-sky_blue" id="downloads">
        <div class="container">
            <div class="all-downloads">
                <div class="row spcl-row">

                    @forelse ($section->documents as $doc)
                        <div class="col-lg-4 col-md-6">
                            <div class="each-download">

                                <div class="doc-info">
                                    <div class="icon-pdf">
                                        <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                    </div>
                                    <h4>{{ $doc->title }}</h4>
                                </div>

                                <div class="doc-actions">
                                    <a href="{{ $doc->file_url }}" target="_blank" title="View PDF">
                                        <img src="{{ asset('website/assests/images/eye.svg') }}" alt="eye">
                                    </a>

                                    <a href="{{ $doc->file_url }}" download title="Download PDF">
                                        <img src="{{ asset('website/assests/images/download.svg') }}" alt="download">
                                    </a>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center">
                            <p>No documents available.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
@endsection()
