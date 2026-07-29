<!-- =============== Header =============== -->
{{-- Top bar (from home_page.html) sits above logo/menu; transparent on homepage --}}
<div class="topbar" id="siteTopbar">
    <div class="container">
        <span>Industrial tools and engineered equipment for maintenance, shutdown and field service</span>
        <span><a href="tel:+61410555595">+61 410 555 595</a> &nbsp; · &nbsp; <a href="mailto:sales@hayateq.com">sales@hayateq.com</a></span>
    </div>
</div>

<header class="site-header" id="siteHeader">
    <div class="header-scrim" aria-hidden="true"></div>
    <div class="container header-inner">
        <a href="{{ route('homepage') }}" class="logo-link">
            <img alt="HAYA TEQ Tools &amp; Equipment" class="logo" src="{{ asset('website/assests/images/logo.png') }}"/>
        </a>

        <nav aria-label="Main navigation" class="desktop-nav">
            <a href="{{ route('homepage') }}#products">Products</a>
            <a href="{{ route('homepage') }}#featured">Featured</a>
            <a href="{{ route('homepage') }}#solutions">Solutions</a>
            <a href="{{ route('homepage') }}#industries">Industries</a>
            <a href="{{ route('homepage') }}#why">Why HAYA TEQ</a>
            <a href="{{ route('homepage') }}#resources">Resources</a>
            <a href="{{ route('homepage') }}#contact">Contact</a>
        </nav>

        <button aria-label="Open menu" aria-expanded="false" aria-controls="siteNavPanel" class="menu-button" id="menuButton" type="button">
            <span class="menu-icon" aria-hidden="true">
                <span></span><span></span><span></span>
            </span>
        </button>
    </div>
</header>

{{-- Mobile panel menu — hamburger only on small screens --}}
<div class="nav-overlay" id="navOverlay" hidden></div>
<nav class="nav-panel" id="siteNavPanel" aria-label="Mobile navigation" hidden>
    <div class="nav-panel-inner">
        <div class="nav-panel-top">
            <a href="{{ route('homepage') }}" class="nav-panel-logo">
                <img alt="HAYA TEQ" src="{{ asset('website/assests/images/logo.png') }}"/>
            </a>
            <button type="button" class="nav-panel-close" id="menuClose" aria-label="Close menu">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="nav-panel-links">
            <a href="{{ route('homepage') }}#products">Products</a>
            <a href="{{ route('homepage') }}#featured">Featured</a>
            <a href="{{ route('homepage') }}#solutions">Solutions</a>
            <a href="{{ route('homepage') }}#industries">Industries</a>
            <a href="{{ route('homepage') }}#why">Why HAYA TEQ</a>
            <a href="{{ route('homepage') }}#resources">Resources</a>
            <a href="{{ route('homepage') }}#contact">Contact</a>
            <a href="{{ route('mainProducts') }}">All Products</a>
            <a href="{{ route('aboutPage') }}">About</a>
            <a href="{{ route('servicePage') }}">Services</a>
            <a href="{{ route('downloadPage') }}">Downloads</a>
        </div>
        <div class="nav-panel-meta">
            <a href="tel:+61410555595">+61 410 555 595</a>
            <a href="mailto:sales@hayateq.com">sales@hayateq.com</a>
        </div>
    </div>
</nav>
