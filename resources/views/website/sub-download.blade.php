@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">{{ $downloadData->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('downloadPage') }}">Resources</a>
                    </li>
                    <li>{{ $downloadData->title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Downloads =============== -->
    <section class="downloads bg-sky_blue" id="downloads">
        <div class="container">
            <div class="all-downloads">
                <div class="row spcl-row">
                    @forelse ($downloadData->sections as $section)
                        <div class="col-lg-4 col-md-6">
                            <div class="each-download">
                                <div class="doc-info">
                                    <div class="icon-pdf">
                                        <img src="{{ asset('website/assests/images/pdf-icon.svg') }}" alt="pdf-icon">
                                    </div>
                                    <h4>{{ $section->title }}</h4>
                                </div>

                                <div class="doc-actions">
                                    <a href="{{ route('mainDownloadPage', [
                                        'slug1' => $section->slug ?? $section->title,
                                        'slug2' => $section->id,
                                    ]) }}"
                                        title="View PDF">
                                        {{-- <img src="{{ asset('website/assests/images/eye.svg') }}" alt="eye"> --}}
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
                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center">
                            <p>No sections available.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
@endsection()
