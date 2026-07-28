<!-- =============== Header =============== -->
<header class="header-area">
    <!-- Top Blue Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <ul class="topLinks">
                        <li> <a href="{{ route('blogPage') }}">Blogs</a></li>
                        <li>
                            <div class="dropdown lang-dropdown" tabindex="0">
                                <button id="dropdown-btn"></button>
                                <ul class="dropdown-content" id="dropdown-content"></ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Navigation Area -->
    <div class="nav-wrapper">
        <div class="container">
            <div class="d-flex align-items-stretch">
                <a href="{{ route('homepage') }}" class="logo-box">
                    <img src="{{ asset('website/assests/images/header-logo.svg') }}" alt="Logo" class="img-fluid">
                </a>
                <nav class="main-nav flex-grow-1 d-flex align-items-center">
                    <ul class="nav w-100 justify-content-end">
                        <li class="nav-item"><a class="nav-link" href="{{ route('aboutPage') }}">ABOUT US</a></li>
                        <li class="nav-item dropdown-mega">
                            <a class="nav-link" href="{{ route('mainProducts') }}">PRODUCTS</a>
                            <div class="mega-menu-content shadow-lg">
                                <div class="container">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-5">
                                            <ul class="list-group product-hover-list">
                                                @foreach ($categories as $key => $category)
                                                    @php
                                                        $image = optional($category->categoryDescription)->images
                                                            ? collect(
                                                                $category->categoryDescription->images,
                                                            )->firstWhere('is_featured', true)
                                                            : null;
                                                        $imageUrl =
                                                            asset('category/' . $image['file_name']) ??
                                                            asset('website/assests/images/default-category.png');
                                                    @endphp
                                                    <a class="list-group-item {{ $key == 0 ? 'active' : '' }}"
                                                        data-img1="{{ $imageUrl }}" {{-- data-img2="{{ $imageUrl }}" --}}
                                                        data-text1="{{ $category->name }}" {{-- data-text2="{{ $category->name }}" --}}
                                                        href="{{ url('category/' . $category->slug) }}" type="button"
                                                        class="list-group-item list-group-item-action">
                                                        {{ $category->name }}

                                                    </a>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="img-frame">
                                                        <img id="view-img-1"
                                                            src="{{ asset('website/assests/images/default-category.png') }}"
                                                            class="img-fluid rounded-3" alt="Product">
                                                        <p class="content" id="view-text-1">
                                                            Category Preview
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <div class="img-frame">
                                                        <img id="view-img-2"
                                                            src="{{ asset('website/assests/images/default-category.png') }}"
                                                            class="img-fluid rounded-3" alt="Product">
                                                        <p class="content" id="view-text-2">
                                                            Category Preview
                                                        </p>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('servicePage') }}">SERVICES</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="{{ route('downloadPage') }}">DOWNLOADS</a></li> --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('downloadPage') }}">RESOURCES</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contactPage') }}">CONTACT
                                US</a></li>
                    </ul>
                    {{-- <div class="search-btn">
                        <div class="header-search" tabindex="0">
                            <input type="text" placeholder="Search Something Here..." aria-label="Search">
                            <button class="search-trigger">
                                <i class="bi bi-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </div> --}}
                    <div class="search-btn" style="position: relative;">
                        <div class="header-search" tabindex="0">
                            <input type="text" id="search-input" placeholder="Search Something Here..."
                                autocomplete="off">
                            <button class="search-trigger">
                                <i class="bi bi-search"></i>
                            </button>
                            <div id="suggestions-box">
                            </div>
                        </div>
                        <!-- Yeh box CSS se style hona chahiye -->
                        {{-- <div id="suggestions-box"
                            style="position: absolute; top: 100%; left: 0; width: 100%; background: #fff; border: 1px solid #ccc; z-index: 9999; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </div> --}}

                    </div>
                    <!-- MOBILE TOGGLE BUTTON -->
                    <span class="toggle-menu mobile-only">
                        <img src="{{ asset('website/assests/images/menu-icon.png') }}" alt="menu">
                    </span>
                </nav>
            </div>
        </div>
    </div>

    <!-- MOBILE NAV -->
    <nav class="mobile-nav">
        <ul class="mobile-menu">

            <li>
                <a href="{{ route('aboutPage') }}" class="menu-toggle">ABOUT US</a>
            </li>

            <li>
                <a href="{{ route('mainProducts') }}" class="menu-toggle">PRODUCTS</a>
                <ul class="submenu">
                    <li><a href="#">Portable Onsite Machining
                            Tools</a></li>
                    <li><a href="#">Bolt Torque & Tension Tools</a></li>
                    <li><a href="#">Flange Alignment & Maintenance
                            Tools</a></li>
                    <li><a href="#">Pressure Testing Equipment</a></li>
                    <li><a href="#">Hydraulic Cylinders & Pumps</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('servicePage') }}" class="menu-toggle">SERVICES</a>
            </li>

            <li>
                <a href="{{ route('downloadPage') }}" class="menu-toggle">DOWNLOADS</a>
            </li>

            <li>
                <a href="{{ route('contactPage') }}" class="menu-toggle">CONTACT
                    US</a>
            </li>

        </ul>
    </nav>
    <div class="overlay"></div>

</header>
<script>
    const searchInput = document.getElementById('search-input');
    const suggestionsBox = document.getElementById('suggestions-box');

    // Search bar band hone par suggestions hide karne ka logic
    document.querySelector('.search-trigger').addEventListener('click', function() {
        // Agar search input band ho raha hai to box bhi band karo
        if (searchInput.style.display === 'none') {
            suggestionsBox.style.display = 'none';
        }
    });

    // Click outside logic
    document.addEventListener('click', function(e) {
        if (!document.querySelector('.header-search').contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });

    searchInput.addEventListener('input', function() {
        let query = this.value;

        if (query.length < 2) {
            suggestionsBox.style.display = 'none';
            return;
        }

        fetch(`/search-suggestions?q=${query}`)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Console mein check karein
                suggestionsBox.innerHTML = ''; // Box clear karein

                if (data.length > 0) {
                    suggestionsBox.style.display = 'block'; // Show करें
                    data.forEach(product => {
                        // Agar image path storage mein hai
                        let imgPath = product.featured_image_url;

                        suggestionsBox.innerHTML += `
                            <a href="/product/${product.slug}" class="suggestion-item">
                                <img src="${imgPath}" alt="${product.name}">
                                <span>${product.name}</span>
                            </a>
                        `;
                    });
                } else {
                    // suggestionsBox.style.display = 'none';
                    suggestionsBox.innerHTML = '<strong class="suggestion-item">No product match</strong>';
                }
            })
            .catch(err => console.error("Error:", err));
    });
</script>
