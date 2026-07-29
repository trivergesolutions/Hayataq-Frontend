@extends('website.layout.app')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
    @php
        function formatFraction($value)
        {
            if (!is_string($value)) {
                return e($value);
            }

            // 1️⃣ Mixed fractions (1 5/16)
            $value = preg_replace_callback(
                '/(\d+(?:\.\d+)?)\s+(\d+(?:\.\d+)?)\s*\/\s*(\d+(?:\.\d+)?)/',
                function ($m) {
                    return $m[1] . ' <span class="fraction"><sup>' . $m[2] . '</sup>/<sub>' . $m[3] . '</sub></span>';
                },
                $value,
            );

            // 2️⃣ Simple / decimal fractions (3/4, 1.7/3.7)
            $value = preg_replace_callback(
                '/(\d+(?:\.\d+)?)\s*\/\s*(\d+(?:\.\d+)?)/',
                function ($m) {
                    return '<span class="fraction"><sup>' . $m[1] . '</sup>/<sub>' . $m[2] . '</sub></span>';
                },
                $value,
            );

            // 3️⃣ Units like cm2, mm2, cm3, mm3 → superscript
            $value = preg_replace('/(cm|mm|m|in)(2|3)\b/', '$1<sup>$2</sup>', $value);

            return $value;
        }
    @endphp

    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">{{ $product->name }}</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('mainProducts') }}">Products</a>
                    </li>
                    @php
                        $category = $product->categories->first();
                    @endphp

                    @if ($category && $category->parent)
                        <li>
                            <a href="{{ route('subCategory', $category->parent->slug) }}">{{ $category->parent->name }}</a>
                        </li>
                    @endif

                    @if ($category)
                        <li>
                            <a href="{{ route('sub_category', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @endif
                    {{-- <li>SH Series Drive Unit</li> --}}
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Products Details =============== -->
    <section class="product-details" id="product-details">
        <div class="container">
            <div class="row spcl-row">
                <div class="col-lg-6">
                    <div class="product-gallery-container">

                        {{-- Progress Bars --}}
                        <div class="progress-bars">
                            @foreach ($product->images as $index => $img)
                                <div class="bar-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="fill"></div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Main Image --}}
                        <div class="main-image-box">
                            <img id="mainImage" src="{{ $product->images[0]['image_url'] ?? '' }}" alt="Main Product">
                        </div>

                        {{-- Thumbnails --}}
                        <div class="thumbnail-list">
                            @foreach ($product->images as $index => $img)
                                <div class="thumb {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}">
                                    <img src="{{ $img['image_url'] }}" alt="thumb">
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="detail-right">
                        {{-- <span>DLRHD32</span> --}}
                        <h2 class="subheading">{{ $product->name }}</h2>
                        <p class="para">{!! $product->short_description !!}</p>
                        <div class="detail-bottom">
                            <p>PRICE ON REQUEST</p>
                        </div>
                        <form id="enquiryForm" class="price-from">
                            @csrf {{-- CSRF Token zaroori hai --}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}"> {{-- Product ID bind kiya --}}

                            <div class="row spcl-row">
                                <div class="col-lg-6">
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                        required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Please describe your project..." required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <div id="responseMessage" style="margin-bottom: 10px;"></div> {{-- Success/Error message dikhane ke liye --}}
                                    <div class="btn-wrapper">
                                        <button type="submit" class="btn" id="submitBtn">
                                            Enquiry Now
                                            <img src="{{ asset('website/assests/images/enquire.svg') }}" alt="enquire">
                                        </button>

                                        @php
                                            $catalogue = $product->documents->firstWhere('title', 'Catalogue');
                                        @endphp

                                        @if ($catalogue)
                                            <a href="{{ url($catalogue->file_path) }}" class="btn" download>
                                                Download Catalogue
                                                <img src="{{ asset('website/assests/images/download-img.svg') }}"
                                                    alt="download">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="btn-wrapper">
                                        <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#downloadModal">
                                            Download Manual
                                            <img src="{{ asset('website/assests/images/download-img.svg') }}"
                                                alt="download">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="btn-wrapper">
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#downloadModal">
                                Download Manual
                                <img src="{{ asset('website/assests/images/download-img.svg') }}" alt="download">
                            </button>
                        </div> --}}

                        <!-- Modal -->
                        <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="downloadModalLabel">
                                            Download Manual
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <form id="downloadForm">
                                            @csrf

                                            <input type="hidden" name="file"
                                                value="{{ isset($catalogue) ? url($catalogue->file_path) : '' }}">

                                            <div class="mb-3">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Phone No</label>
                                                <input type="text" name="contact" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label>Company Name</label>
                                                <input type="text" name="company" class="form-control">
                                            </div>

                                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                                Submit & Download
                                            </button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description">
                @if ($product->long_description)
                    <h5>Description</h5>
                    <div class="description-bottom" style="flex-direction: row;">
                        {!! $product->long_description !!}
                    </div>
                @endif
                @if (!empty($product->comparison_accessories) && $product->comparison_accessories->count())
                    <h5 class="mt-3">Accessories</h5>
                    <div class="related-products comparison-section">
                        <div class="all-products">
                            {{-- <div class="swiper comparisonSwiper"> --}}
                            <div class="swiper productSwiper">
                                <div class="swiper-wrapper">

                                    @foreach ($product->comparison_accessories as $acc)
                                        <div class="swiper-slide">
                                            <div class="each-product">

                                                <img src="{{ $acc->image_url ?? asset('website/assests/images/no-image.png') }}"
                                                    alt="{{ $acc->name }}">

                                                <div class="eachproduct-content">
                                                    <a href="#" class="product-title">
                                                        {{ $acc->name }}
                                                    </a>

                                                    <div class="each-links">

                                                        @if ($acc->document_url)
                                                            <a class="nav-link" href="{{ $acc->document_url }}" download>
                                                                View More
                                                            </a>
                                                        @endif

                                                        <a class="nav-link" data-bs-toggle="modal"
                                                            data-bs-target="#enquiryModal"
                                                            data-accessory-id="{{ $acc->id }}"
                                                            href="javascript:void(0)">
                                                            Enquiry Now
                                                        </a>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="prev_next_btn">
                                <div class="prev_btn comparison-prev">
                                    <i class="bi bi-arrow-left"></i>
                                </div>
                                <div class="next_btn comparison-next">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($product->dimensionalDiagram)
                    <h5 class="mt-4">Dimensions</h5>
                    <div class="dimensions">
                        <div class="main-container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="right-side">
                                        <img src="{{ $product->dimensionalDiagram }}" alt="{{ $product->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <h5 class="mt-3">Specifications</h5>
                <!-- @if (!empty($product->dynamic_table['data']))
    <div class="table-container">
                                                                                                                                                                <table>
                                                                                                                                                                    @php
                                                                                                                                                                        $data =
                                                                                                                                                                            $product
                                                                                                                                                                                ->dynamic_table[
                                                                                                                                                                                'data'
                                                                                                                                                                            ] ??
                                                                                                                                                                            [];
                                                                                                                                                                        $merges = collect(
                                                                                                                                                                            $product
                                                                                                                                                                                ->dynamic_table[
                                                                                                                                                                                'mergeCells'
                                                                                                                                                                            ] ??
                                                                                                                                                                                [],
                                                                                                                                                                        );
                                                                                                                                                                        $metadata =
                                                                                                                                                                            $product
                                                                                                                                                                                ->dynamic_table[
                                                                                                                                                                                'rowMetadata'
                                                                                                                                                                            ] ??
                                                                                                                                                                            [];
                                                                                                                                                                        $skip = [];
                                                                                                                                                                        $currentSection = null;

                                                                                                                                                                        // 1. Identify Spacer Columns (Jo upar se niche tak poore khaali hain)
                                                                                                                                                                        $totalCols = count(
                                                                                                                                                                            $data[0] ??
                                                                                                                                                                                [],
                                                                                                                                                                        );
                                                                                                                                                                        $spacerColumns = [];
                                                                                                                                                                        for (
                                                                                                                                                                            $c = 0;
                                                                                                                                                                            $c <
                                                                                                                                                                            $totalCols;
                                                                                                                                                                            $c++
                                                                                                                                                                        ) {
                                                                                                                                                                            $isEntirelyEmpty = true;
                                                                                                                                                                            foreach (
                                                                                                                                                                                $data
                                                                                                                                                                                as $r
                                                                                                                                                                            ) {
                                                                                                                                                                                if (
                                                                                                                                                                                    !empty(
                                                                                                                                                                                        trim(
                                                                                                                                                                                            $r[
                                                                                                                                                                                                $c
                                                                                                                                                                                            ] ??
                                                                                                                                                                                                '',
                                                                                                                                                                                        )
                                                                                                                                                                                    )
                                                                                                                                                                                ) {
                                                                                                                                                                                    $isEntirelyEmpty = false;
                                                                                                                                                                                    break;
                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                                                            if (
                                                                                                                                                                                $isEntirelyEmpty
                                                                                                                                                                            ) {
                                                                                                                                                                                $spacerColumns[
                                                                                                                                                                                    $c
                                                                                                                                                                                ] = true;
                                                                                                                                                                            }
                                                                                                                                                                        }

                                                                                                                                                                        // 2. SMART GROUPING: Columns ko groups mein baantna (Spacers ke basis par)
                                                                                                                                                                        $colToGroup = [];
                                                                                                                                                                        $groupMaxRow = [];
                                                                                                                                                                        $currentGroupId = 0;
                                                                                                                                                                        $inGroup = false;

                                                                                                                                                                        for (
                                                                                                                                                                            $c = 0;
                                                                                                                                                                            $c <
                                                                                                                                                                            $totalCols;
                                                                                                                                                                            $c++
                                                                                                                                                                        ) {
                                                                                                                                                                            if (
                                                                                                                                                                                isset(
                                                                                                                                                                                    $spacerColumns[
                                                                                                                                                                                        $c
                                                                                                                                                                                    ],
                                                                                                                                                                                )
                                                                                                                                                                            ) {
                                                                                                                                                                                $inGroup = false;
                                                                                                                                                                                continue;
                                                                                                                                                                            }
                                                                                                                                                                            if (
                                                                                                                                                                                !$inGroup
                                                                                                                                                                            ) {
                                                                                                                                                                                $currentGroupId++;
                                                                                                                                                                                $inGroup = true;
                                                                                                                                                                            }
                                                                                                                                                                            $colToGroup[
                                                                                                                                                                                $c
                                                                                                                                                                            ] = $currentGroupId;

                                                                                                                                                                            // Is group ki aakhiri data row dhundna
                                                                                                                                                                            $lastRowForThisCol = 0;
                                                                                                                                                                            for (
                                                                                                                                                                                $r =
                                                                                                                                                                                    count(
                                                                                                                                                                                        $data,
                                                                                                                                                                                    ) -
                                                                                                                                                                                    1;
                                                                                                                                                                                $r >=
                                                                                                                                                                                0;
                                                                                                                                                                                $r--
                                                                                                                                                                            ) {
                                                                                                                                                                                if (
                                                                                                                                                                                    !empty(
                                                                                                                                                                                        trim(
                                                                                                                                                                                            $data[
                                                                                                                                                                                                $r
                                                                                                                                                                                            ][
                                                                                                                                                                                                $c
                                                                                                                                                                                            ] ??
                                                                                                                                                                                                '',
                                                                                                                                                                                        )
                                                                                                                                                                                    )
                                                                                                                                                                                ) {
                                                                                                                                                                                    $lastRowForThisCol = $r;
                                                                                                                                                                                    break;
                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                                                            if (
                                                                                                                                                                                !isset(
                                                                                                                                                                                    $groupMaxRow[
                                                                                                                                                                                        $currentGroupId
                                                                                                                                                                                    ],
                                                                                                                                                                                ) ||
                                                                                                                                                                                $lastRowForThisCol >
                                                                                                                                                                                    $groupMaxRow[
                                                                                                                                                                                        $currentGroupId
                                                                                                                                                                                    ]
                                                                                                                                                                            ) {
                                                                                                                                                                                $groupMaxRow[
                                                                                                                                                                                    $currentGroupId
                                                                                                                                                                                ] = $lastRowForThisCol;
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    @endphp

                                                                                                                                                                    @foreach ($data as $rIndex => $row)
    @php
        $rowMeta = $metadata[$rIndex] ?? null;
        $isHeaderRow = $rIndex === 0 || ($rowMeta['isHeader'] ?? false);
        $targetSection = $isHeaderRow ? 'head' : 'body';
        $tag = $isHeaderRow ? 'th' : 'td';
    @endphp

                                                                                                                                                                        @if ($currentSection !== $targetSection)
    @if ($currentSection === 'head')
    </thead>
    @endif
                                                                                                                                                                            @if ($currentSection === 'body')
    </tbody>
    @endif
                                                                                                                                                                            @if ($targetSection === 'head')
    <thead>
    @endif
                                                                                                                                                                            @if ($targetSection === 'body')
    <tbody>
    @endif
                                                                                                                                                                            @php $currentSection = $targetSection; @endphp
    @endif

                                                                                                                                                                        <tr style="{{ $rowMeta['backgroundColor'] ?? '' }}">
                                                                                                                                                                            @foreach ($row as $cIndex => $cell)
    @php
        if (isset($skip[$rIndex][$cIndex])) {
            continue;
        }

        $merge = $merges->firstWhere(function ($m) use ($rIndex, $cIndex) {
            return (int) $m['row'] === (int) $rIndex && (int) $m['col'] === (int) $cIndex;
        });

        $rowspan = $merge['rowspan'] ?? 1;
        $colspan = $merge['colspan'] ?? 1;

        // Rowspan clipping
        $rowsLeftInSection = 0;
        for ($k = $rIndex; $k < count($data); $k++) {
            $nextIsHeader = $k === 0 || ($metadata[$k]['isHeader'] ?? false);
            if ($nextIsHeader === $isHeaderRow) {
                $rowsLeftInSection++;
            } else {
                break;
            }
        }
        if ($rowspan > $rowsLeftInSection) {
            $rowspan = $rowsLeftInSection;
        }

        if ($merge) {
            for ($i = 0; $i < $rowspan; $i++) {
                for ($j = 0; $j < $colspan; $j++) {
                    if ($i === 0 && $j === 0) {
                        continue;
                    }
                    $skip[$rIndex + $i][$cIndex + $j] = true;
                }
            }
        }

        // --- IMPROVED SMART FILL LOGIC ---
        $displayValue = formatFraction($cell);

        if (!$isHeaderRow && empty(trim($cell)) && isset($colToGroup[$cIndex])) {
            $groupId = $colToGroup[$cIndex];
            // Agar is row ka index, is group ki max data row se chhota ya barabar hai
            if ($rIndex <= ($groupMaxRow[$groupId] ?? 0)) {
                $displayValue = '***';
            }
        }
    @endphp

                                                                                                                                                                                <{{ $tag }} class="text-center"
                                                                                                                                                                                    @if ($rowspan > 1) rowspan="{{ $rowspan }}" @endif
                                                                                                                                                                                    @if ($colspan > 1) colspan="{{ $colspan }}" @endif>
                                                                                                                                                                                    {!! $displayValue !!}
                                                                                                                                                                                    </{{ $tag }}>
    @endforeach
                                                                                                                                                                        </tr>
    @endforeach

                                                                                                                                                                    @if ($currentSection === 'head')
    </thead>
    @endif
                                                                                                                                                                    @if ($currentSection === 'body')
    </tbody>
    @endif
                                                                                                                                                                </table>
                                                                                                                                                            </div>
    @endif -->
                @if (!empty($product->dynamic_table['data']))
                    <div class="table-container" style="overflow-x: auto;">
                        <table style="table-layout: fixed; width: 100%;">
                            @php
                                $data = $product->dynamic_table['data'] ?? [];
                                $merges = collect($product->dynamic_table['mergeCells'] ?? []);
                                $metadata = $product->dynamic_table['rowMetadata'] ?? [];
                                // NEW: Get Column Widths
                                $columnWidths = $product->dynamic_table['columnWidths'] ?? [];

                                $skip = [];
                                $currentSection = null;

                                // 1. Identify Spacer Columns
                                $totalCols = count($data[0] ?? []);
                                $spacerColumns = [];
                                for ($c = 0; $c < $totalCols; $c++) {
                                    $isEntirelyEmpty = true;
                                    foreach ($data as $r) {
                                        if (!empty(trim($r[$c] ?? ''))) {
                                            $isEntirelyEmpty = false;
                                            break;
                                        }
                                    }
                                    if ($isEntirelyEmpty) {
                                        $spacerColumns[$c] = true;
                                    }
                                }

                                // 2. SMART GROUPING logic (same as before)
                                $colToGroup = [];
                                $groupMaxRow = [];
                                $currentGroupId = 0;
                                $inGroup = false;

                                for ($c = 0; $c < $totalCols; $c++) {
                                    if (isset($spacerColumns[$c])) {
                                        $inGroup = false;
                                        continue;
                                    }
                                    if (!$inGroup) {
                                        $currentGroupId++;
                                        $inGroup = true;
                                    }
                                    $colToGroup[$c] = $currentGroupId;

                                    $lastRowForThisCol = 0;
                                    for ($r = count($data) - 1; $r >= 0; $r--) {
                                        if (!empty(trim($data[$r][$c] ?? ''))) {
                                            $lastRowForThisCol = $r;
                                            break;
                                        }
                                    }
                                    if (
                                        !isset($groupMaxRow[$currentGroupId]) ||
                                        $lastRowForThisCol > $groupMaxRow[$currentGroupId]
                                    ) {
                                        $groupMaxRow[$currentGroupId] = $lastRowForThisCol;
                                    }
                                }
                            @endphp

                            {{-- NEW: Column Widths binding using colgroup --}}
                            {{-- @if (!empty($columnWidths))
                                <colgroup>
                                    @foreach ($columnWidths as $width)
                                        <col style="width: {{ $width }}px;">
                                    @endforeach
                                </colgroup>
                            @endif --}}

                            @foreach ($data as $rIndex => $row)
                                @php
                                    $rowMeta = $metadata[$rIndex] ?? null;
                                    $isHeaderRow = $rIndex === 0 || ($rowMeta['isHeader'] ?? false);
                                    $targetSection = $isHeaderRow ? 'head' : 'body';
                                    $tag = $isHeaderRow ? 'th' : 'td';
                                @endphp

                                @if ($currentSection !== $targetSection)
                                    @if ($currentSection === 'head')
                                        </thead>
                                    @endif
                                    @if ($currentSection === 'body')
                                        </tbody>
                                    @endif
                                    @if ($targetSection === 'head')
                                        <thead>
                                    @endif
                                    @if ($targetSection === 'body')
                                        <tbody>
                                    @endif
                                    @php $currentSection = $targetSection; @endphp
                                @endif

                                <tr style="{{ $rowMeta['backgroundColor'] ?? '' }}">
                                    @foreach ($row as $cIndex => $cell)
                                        @php
                                            if (isset($skip[$rIndex][$cIndex])) {
                                                continue;
                                            }

                                            $merge = $merges->firstWhere(function ($m) use ($rIndex, $cIndex) {
                                                return (int) $m['row'] === (int) $rIndex &&
                                                    (int) $m['col'] === (int) $cIndex;
                                            });

                                            $rowspan = $merge['rowspan'] ?? 1;
                                            $colspan = $merge['colspan'] ?? 1;

                                            $rowsLeftInSection = 0;
                                            for ($k = $rIndex; $k < count($data); $k++) {
                                                $nextIsHeader = $k === 0 || ($metadata[$k]['isHeader'] ?? false);
                                                if ($nextIsHeader === $isHeaderRow) {
                                                    $rowsLeftInSection++;
                                                } else {
                                                    break;
                                                }
                                            }
                                            if ($rowspan > $rowsLeftInSection) {
                                                $rowspan = $rowsLeftInSection;
                                            }

                                            if ($merge) {
                                                for ($i = 0; $i < $rowspan; $i++) {
                                                    for ($j = 0; $j < $colspan; $j++) {
                                                        if ($i === 0 && $j === 0) {
                                                            continue;
                                                        }
                                                        $skip[$rIndex + $i][$cIndex + $j] = true;
                                                    }
                                                }
                                            }

                                            $displayValue = formatFraction($cell);

                                            if (!$isHeaderRow && empty(trim($cell)) && isset($colToGroup[$cIndex])) {
                                                $groupId = $colToGroup[$cIndex];
                                                if ($rIndex <= ($groupMaxRow[$groupId] ?? 0)) {
                                                    $displayValue = '***';
                                                }
                                            }
                                        @endphp

                                        <{{ $tag }} class="text-center"
                                            @if ($rowspan > 1) rowspan="{{ $rowspan }}" @endif
                                            @if ($colspan > 1) colspan="{{ $colspan }}" @endif
                                            {{-- Optional: inline style width as backup --}} style="word-wrap: break-word; overflow: hidden;">
                                            {!! $displayValue !!}
                                            </{{ $tag }}>
                                    @endforeach
                                </tr>
                            @endforeach

                            @if ($currentSection === 'head')
                                </thead>
                            @endif
                            @if ($currentSection === 'body')
                                </tbody>
                            @endif
                        </table>
                    </div>
                @endif
                @if (!empty($product->related_items))
                    @php
                        $relatedCount = count($product->related_items);
                    @endphp
                    <div class="related-products">
                        <div class="related-product-top">
                            <h2 class="subheading">Related Products</h2>
                            <span class="line"></span>
                            {{-- <a href="{{ route('mainProducts') }}" class="btn">View all<i class="bi bi-arrow-right"></i></a> --}}
                        </div>
                        <div class="all-products">
                            <div class="swiper productSwiper" data-count="{{ $relatedCount }}">
                                <div class="swiper-wrapper">

                                    @foreach ($product->related_items as $item)
                                        <div class="swiper-slide">
                                            <div class="each-product">

                                                <img src="{{ $item['image_url'] ?? asset('website/assests/images/no-image.png') }}"
                                                    alt="{{ $item['name'] }}">

                                                <div class="eachproduct-content">

                                                    <a href="#" class="product-title">
                                                        {{ $item['name'] }}
                                                    </a>
                                                    <div class="each-links">
                                                        {{-- PRODUCT --}}
                                                        @if ($item['type'] === 'product')
                                                            <a class="nav-link"
                                                                href="{{ route('productDetail', $item['id']) }}">
                                                                View Details
                                                            </a>
                                                        @endif

                                                        {{-- ACCESSORY --}}
                                                        @if ($item['type'] === 'accessory')
                                                            @if (!empty($item['document_url']))
                                                                <a class="nav-link" href="{{ $item['document_url'] }}"
                                                                    download>
                                                                    View more
                                                                </a>
                                                            @endif

                                                            <a class="nav-link" data-bs-toggle="modal"
                                                                data-bs-target="#enquiryModal"
                                                                data-accessory-id="{{ $item['id'] }}"
                                                                href="javascript:void(0)">
                                                                Enquiry Now
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if ($relatedCount > 1)
                                <div class="prev_next_btn">
                                    <div class="prev_btn"><i class="bi bi-arrow-left"></i></div>
                                    <div class="next_btn"><i class="bi bi-arrow-right"></i></div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Enquire About Accessories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="enquiryForm" class="price-from">
                        @csrf {{-- CSRF Token zaroori hai --}}
                        {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> Product ID bind kiya --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="exampleInputName1"
                                    aria-describedby="emailHelp" placeholder="First Name" name="first_name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="exampleInputName2"
                                    aria-describedby="emailHelp" placeholder="Last Name" name="last_name">
                            </div>
                            <div class="col-lg-6">
                                <input type="email" class="form-control" id="exampleInputEmail"
                                    aria-describedby="emailHelp" placeholder="Email" name="email">
                            </div>
                            <div class="col-lg-6">
                                <input type="tel" class="form-control" id="exampleInputPhone"
                                    aria-describedby="emailHelp" placeholder="Phone Number" name="phone">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Please describe your project. anything that would help us understand your project better."
                                    name="message"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#enquiryForm').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                let submitBtn = $('#submitBtn');
                let responseMsg = $('#responseMessage');

                submitBtn.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: "{{ route('enquiry.store') }}", // Apna route name yahan check karein
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        responseMsg.html('<span style="color: green;">' + response.message +
                            '</span>');
                        $('#enquiryForm')[0].reset(); // Form clear karne ke liye
                        submitBtn.prop('disabled', false).html(
                            'Enquiry Now <img src="{{ asset('website/assests/images/enquire.svg') }}">'
                        );
                    },
                    error: function(xhr) {
                        let errorMsg = 'Something went wrong.';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMsg = Object.values(xhr.responseJSON.errors).flat().join(
                                '<br>');
                        }
                        responseMsg.html('<span style="color: red;">' + errorMsg + '</span>');
                        submitBtn.prop('disabled', false).html(
                            'Enquiry Now <img src="{{ asset('website/assests/images/enquire.svg') }}">'
                        );
                    }
                });
            });
        });
    </script>
    {{-- <script>
        var accessoryCount = {{ $product->comparison_accessories->count() }};

        var comparisonSwiper = new Swiper(".comparisonSwiper", {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: accessoryCount > 4, // 👈 dynamic loop
            navigation: {
                nextEl: ".comparison-next",
                prevEl: ".comparison-prev",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                },
            }
        });
    </script> --}}

    <script>
        $('#downloadForm').submit(function(e) {

            e.preventDefault();

            let formData = new FormData(this);
            console.log(formData);
            $.ajax({
                url: "{{ route('download.manual') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                // success: function(response) {

                //     Swal.fire({
                //         icon: 'success',
                //         title: 'Download Successful',
                //         text: response.message,
                //         confirmButtonText: 'OK'
                //     });

                //     // download file
                //     // window.location.href = response.file;
                //     let link = document.createElement('a');
                //     link.href = response.file;
                //     link.download = '';
                //     document.body.appendChild(link);
                //     link.click();
                //     document.body.removeChild(link);

                //     // modal close
                //     $('#downloadModal').modal('hide');

                //     // reset form
                //     $('#downloadForm')[0].reset();
                // },
                success: function(response) {

                    // Bootstrap modal instance
                    let modalEl = document.getElementById('downloadModal');
                    let modal = bootstrap.Modal.getInstance(modalEl);

                    // close modal
                    modal.hide();

                    // remove backdrop manually
                    $('.modal-backdrop').remove();

                    // body cleanup
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');

                    // success alert
                    Swal.fire({
                        icon: 'success',
                        title: 'Download Successful',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });

                    // force download
                    let link = document.createElement('a');
                    link.href = response.file;
                    link.download = '';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    // reset form
                    $('#downloadForm')[0].reset();
                },

                error: function(xhr) {

                    let errors = xhr.responseJSON.errors;

                    let errorMessage = '';

                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessage
                    });
                }
            });

        });
    </script>
@endsection()
