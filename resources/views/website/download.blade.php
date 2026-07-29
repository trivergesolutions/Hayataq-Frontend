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
                <h2 class="heading">Resources</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Resources</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Downloads =============== -->
    <section class="downloads bg-sky_blue" id="downloads">
        <div class="container">
            {{-- <div class="mainHeading">
                <h2 class="subheading">Downloads</h2>
            </div> --}}
            <div class="all-downloads">
                <div class="row spcl-row">

                    @forelse ($downloads as $download)
                        <div class="col-lg-4 col-md-6">
                            <div class="each-download">
                                <div class="doc-info">
                                    <div class="icon-pdf">
                                        <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                    </div>
                                    <h4>{{ $download->title }}</h4>
                                </div>
                                @if ($download->single_page == 1)
                                    <div class="doc-actions">
                                        <a href="{{ asset($download->file_path) }}" target="_blank" title="View PDF">
                                            <img src="{{ asset('website/assests/images/eye.svg') }}" alt="eye">
                                        </a>
                                        <a href="{{ asset($download->file_path) }}" download title="Download PDF">
                                            <img src="{{ asset('website/assests/images/download.svg') }}" alt="download">
                                        </a>
                                    </div>
                                @endif
                                @if ($download->single_page == 0)
                                    <div class="doc-actions">
                                        <a href="{{ route('downloadSubPage', $download->slug) }}" title="View PDF">
                                            <svg width="25px" height="25px" viewBox="0 0 24.00 24.00" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"
                                                stroke-width="0.00024000000000000003"
                                                transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke="#CCCCCC" stroke-width="0.048"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z"
                                                        fill="#073e98"></path>
                                                </g>
                                            </svg>
                                        </a>

                                    </div>
                                @endif
                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center">
                            <p>No downloads available.</p>
                        </div>
                    @endforelse

                </div>
            </div>
            <div class="all-downloads d-none">
                <div class="row spcl-row">
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Product Catalogue</h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Manual <span>(Catalogue)</span></h4>
                            </div>
                            <div class="doc-actions">
                                <a href="downloads-manual.html"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Certificates</h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Conversion Charts</h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Flange Bolt Pattern</h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>Bolt Pattern <span>(API Charts)</span></h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="each-download">
                            <div class="doc-info">
                                <div class="icon-pdf">
                                    <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                </div>
                                <h4>BOP & WELLHEAD</h4>
                            </div>
                            <div class="doc-actions">
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" target="_blank"
                                    title="View PDF"><img src="{{ asset('website/assests/images/eye.svg') }}"
                                        alt="eye"></a>
                                <a href="{{ asset('website/assests/pdf/sample-local-pdf.pdf') }}" download
                                    title="Download PDF"><img src="{{ asset('website/assests/images/download.svg') }}"
                                        alt="download"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()
