@extends('website.layout.app')

@section('title', 'HAYA TEQ | Industrial Tools & Onsite Machining Solutions')
@section('meta_description', 'HAYA TEQ supplies portable machining tools, hydraulic torque systems, flange maintenance equipment, hydrotest pumps, hand torque tools and industrial accessories.')
@section('body_class', 'page-home')

@section('content')
<main>
    {{-- ========== HERO ==========
         DELETE: solid white menu, eyebrow, product stage, 4 point cards, quick-strip
         REPLACE long lead with "Designed in Australia" at 39px
         KEEP: headline, CTAs, metrics strip (with updated ISO / 48 HR copy)
    --}}
    <section class="hero hero-video-bg">
        {{-- Full-bleed rotating videos (Fisher & Paykel style) --}}
        <div class="hero-video-wrap" aria-hidden="true">
            <video class="hero-video is-active" muted playsinline autoplay preload="auto" data-hero-video>
                <source src="{{ asset('website/assests/videos/hero-1.mp4') }}" type="video/mp4">
            </video>
            <video class="hero-video" muted playsinline preload="auto" data-hero-video>
                <source src="{{ asset('website/assests/videos/hero-2.mp4') }}" type="video/mp4">
            </video>
            <video class="hero-video" muted playsinline preload="auto" data-hero-video>
                <source src="{{ asset('website/assests/videos/hero-3.mp4') }}" type="video/mp4">
            </video>
            <div class="hero-video-overlay"></div>
        </div>
        <div class="container hero-grid hero-grid-clean">
            <div class="hero-main">
                <p class="hero-designed">Designed in Australia</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="#products">Explore Product Range</a>
                    <a class="btn btn-ghost" href="#contact">Speak to a Specialist</a>
                </div>
            </div>
        </div>

        {{-- Scroll-down control (Fisher & Paykel style) --}}
        <a href="#products" class="hero-scroll-down" aria-label="Scroll down — Industrial Tools. Est. 2014">
            <span class="hero-scroll-down-icon" aria-hidden="true">
                <span class="hero-scroll-mouse">
                    <span class="hero-scroll-wheel"></span>
                </span>
            </span>
            <span class="hero-scroll-line">
                <span class="hero-scroll-line-bar" aria-hidden="true"></span>
                <span class="hero-scroll-year">Industrial Tools. Est. 2014</span>
                <span class="hero-scroll-line-bar" aria-hidden="true"></span>
            </span>
        </a>
    </section>

    {{-- ========== PRODUCT CATEGORIES ==========
         DELETE: Visit website button; old H2 + old body copy (struck through in design)
         ADD: "Equipment engineered for the field" + five-line body + card copy notes
    --}}
    <section class="section soft" id="products">
        <div class="container">
            <div class="section-head section-head-stack">
                <div class="section-copy">
                    <div class="kicker">Product Categories</div>
                    <h2>Equipment engineered for the field</h2>
                    <p>Five core product lines covering onsite machining, controlled bolting, flange maintenance, hydrotesting and hydraulic power.</p>
                </div>
            </div>
            @php
                // Red design-note copy from home_page_change.png (replaces generic fallback)
                $designCategoryCopy = [
                    [
                        'match' => ['portable', 'machining'],
                        'title' => 'Portable Machining Tools',
                        'text'  => 'Pipe cutting, beveling, flange facing and onsite machining systems.',
                        'link'  => 'Explore machining',
                    ],
                    [
                        'match' => ['torque', 'bolting', 'hydraulic torque'],
                        'title' => 'Hydraulic Torque Tools & Pumps',
                        'text'  => 'Hydraulic torque wrenches, power packs, hand torque tools and bolting accessories for controlled tightening.',
                        'link'  => 'Explore bolting',
                    ],
                    [
                        'match' => ['flange', 'alignment', 'separation'],
                        'title' => 'Flange Alignment & Separation',
                        'text'  => 'Mechanical and hydraulic spreaders, alignment tools and nut splitters for safe joint maintenance.',
                        'link'  => 'Explore flange tools',
                    ],
                    [
                        'match' => ['hydrotest', 'pressure', 'hydro'],
                        'title' => 'Hydrotest & Pressure Systems',
                        'text'  => 'Pressure-testing equipment for plant, pipeline and workshop use.',
                        'link'  => 'Explore pressure systems',
                    ],
                    [
                        'match' => ['cylinder', 'hydraulic power', 'hand torque', 'accessor'],
                        'title' => 'Hydraulic Cylinders & Pumps',
                        'text'  => 'Single- and double-acting lifting, pressing and pulling solutions for industrial maintenance tasks.',
                        'link'  => 'Explore hydraulic power',
                    ],
                ];
            @endphp
            <div class="category-grid">
                @if(isset($categories) && count($categories) > 0)
                    @foreach ($categories as $key => $category)
                        @php
                            $image = optional($category->categoryDescription)->images
                                ? collect($category->categoryDescription->images)->firstWhere('is_featured', true)
                                : null;
                            $imageUrl = $image && isset($image['file_name'])
                                ? asset('category/' . $image['file_name'])
                                : asset('website/assests/images/img_' . (($key % 5) + 4) . ($key < 4 ? '.webp' : '.jpeg'));

                            // Prefer red design text by name match, then by card order
                            $nameLower = strtolower($category->name ?? '');
                            $copy = $designCategoryCopy[$key] ?? null;
                            foreach ($designCategoryCopy as $item) {
                                foreach ($item['match'] as $needle) {
                                    if (str_contains($nameLower, $needle)) {
                                        $copy = $item;
                                        break 2;
                                    }
                                }
                            }
                            $categoryText = $copy['text']
                                ?? (filled($category->description) && !str_contains(strtolower($category->description), 'industrial equipment for field')
                                    ? $category->description
                                    : 'Pipe cutting, beveling, flange facing and onsite machining systems.');
                            $exploreLabel = $copy['link'] ?? 'Explore';
                        @endphp
                        <article class="category-card">
                            <div class="category-image">
                                <span class="category-number">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <img alt="{{ $category->name }}" src="{{ $imageUrl }}"/>
                            </div>
                            <div class="category-content">
                                <h3>{{ $category->name }}</h3>
                                <p>{{ $categoryText }}</p>
                                <a class="text-link category-link" href="{{ url('category/' . $category->slug) }}">{{ $exploreLabel }} <span>→</span></a>
                            </div>
                        </article>
                    @endforeach
                @else
                    @foreach ($designCategoryCopy as $key => $item)
                        @php
                            $imgIndex = $key + 4;
                            $imgExt = $key < 4 ? 'webp' : 'jpeg';
                        @endphp
                        <article class="category-card">
                            <div class="category-image">
                                <span class="category-number">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <img alt="{{ $item['title'] }}" src="{{ asset('website/assests/images/img_' . $imgIndex . '.' . $imgExt) }}"/>
                            </div>
                            <div class="category-content">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['text'] }}</p>
                                <a class="text-link category-link" href="{{ route('mainProducts') }}">{{ $item['link'] }} <span>→</span></a>
                            </div>
                        </article>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ========== FEATURED PRODUCTS (after Product Categories — from home_page_change.png) ========== --}}
    <section class="section" id="featured">
        <div class="container">
            <div class="section-head section-head-stack">
                <div class="section-copy">
                    <div class="kicker">Featured Products</div>
                </div>
            </div>
            <div class="featured-feature-grid">
                <article class="featured-feature-card">
                    <h3>Onsite Pipe Machining</h3>
                    <p>Split-frame, ID-mounted and narrow-body systems for cutting, beveling, facing and weld preparation.</p>
                    <ul>
                        <li>In-line machining</li>
                        <li>Restricted-access applications</li>
                        <li>Cold-cut weld preparation</li>
                    </ul>
                    <a class="btn featured-feature-btn" href="{{ route('mainProducts') }}">Explore Machining</a>
                </article>
                <article class="featured-feature-card">
                    <h3>Controlled Bolting</h3>
                    <p>Hydraulic torque tools, pumps, manual torque wrenches and accessories for repeatable fastening control.</p>
                    <ul>
                        <li>Square drive, low profile &amp; narrow profile</li>
                        <li>Pneumatic &amp; electric pumps</li>
                        <li>Calibration-oriented selection</li>
                    </ul>
                    <a class="btn featured-feature-btn" href="{{ route('mainProducts') }}">Explore Bolting</a>
                </article>
                <article class="featured-feature-card">
                    <h3>Flange Maintenance</h3>
                    <p>Flange spreaders, alignment tools and facing solutions designed for shutdowns and planned maintenance work.</p>
                    <ul>
                        <li>Safe joint separation</li>
                        <li>Alignment correction</li>
                        <li>Facing &amp; sealing surface restoration</li>
                    </ul>
                    <a class="btn featured-feature-btn" href="{{ route('mainProducts') }}">Explore Flange Tools</a>
                </article>
                <article class="featured-feature-card">
                    <h3>Pressure Testing &amp; Hydraulic Power</h3>
                    <p>Hydrotest pumps, hydraulic cylinders and related equipment for testing, lifting, pressing and support operations.</p>
                    <ul>
                        <li>Single &amp; double acting hydrotest pumps</li>
                        <li>Hydraulic cylinders &amp; pumps</li>
                        <li>Workshop and field use</li>
                    </ul>
                    <a class="btn featured-feature-btn" href="{{ route('mainProducts') }}">Explore Test Systems</a>
                </article>
            </div>
        </div>
    </section>

    {{-- ========== SOLUTIONS (kept — annotation: keep this number on 01–04) ========== --}}
    <section class="section blue-soft" id="solutions">
        <div class="container">
            <div class="section-head">
                <div class="section-copy">
                    <div class="kicker">How HAYA TEQ Supports Projects</div>
                    <h2>More than product supply.</h2>
                    <p>The strongest industrial-tool partner helps customers define the application, select the correct configuration and maintain the equipment throughout its service life.</p>
                </div>
            </div>
            <div class="solution-layout">
                <div class="solution-image">
                    <img alt="Machined industrial component after onsite machining" src="{{ asset('website/assests/images/img_15.webp') }}"/>
                    <div class="solution-image-caption">
                        <strong>Precision work where the equipment is installed.</strong>
                        <span>Portable machining and maintenance solutions reduce unnecessary component movement and support planned shutdown execution.</span>
                    </div>
                </div>
                <div class="solution-cards">
                    <article class="solution-card"><i>01</i><h3>Application Review</h3><p>Review dimensions, material, operating conditions, access and the required technical outcome.</p></article>
                    <article class="solution-card"><i>02</i><h3>Product Selection</h3><p>Match machine range, torque capacity, pressure, force, connection and utility requirements.</p></article>
                    <article class="solution-card"><i>03</i><h3>Documentation</h3><p>Provide datasheets, drawings, manuals, calibration records and controlled technical information.</p></article>
                    <article class="solution-card"><i>04</i><h3>After-Sales Support</h3><p>Support spare parts, tooling, accessories, maintenance, calibration and product service requirements.</p></article>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== INDUSTRIES SERVED (home_page_change.png — full-bleed dark band) ========== --}}
    <section class="section dark industries-section" id="industries">
        <div class="container">
            <div class="section-head section-head-stack industries-head">
                <div class="section-copy">
                    <div class="kicker industries-kicker">Industries Served</div>
                    <h2 class="industries-title">Tools for production-critical and shutdown-critical work.</h2>
                    <p class="industries-lead">HAYA TEQ equipment supports industrial teams working on pipelines, process plants, rotating equipment, heavy machinery, marine systems and engineered structures.</p>
                </div>
            </div>
            {{-- Icons from hayateq.com "Applications Of Our Tools And Equipment" (application-tool-1…8.svg) --}}
            <div class="industry-grid">
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-1.svg') }}" alt="Oil &amp; Gas icon"/>
                    </div>
                    <h3>Oil &amp; Gas</h3>
                    <p>For pipeline flanges, wellhead connections, and valve assemblies.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-2.svg') }}" alt="Offshore icon"/>
                    </div>
                    <h3>Offshore</h3>
                    <p>For rig maintenance, subsea connections, and high-torque applications.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-3.svg') }}" alt="Marine icon"/>
                    </div>
                    <h3>Marine</h3>
                    <p>For propulsion systems, engine mounts, and structural bolting.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-4.svg') }}" alt="Petrochemicals icon"/>
                    </div>
                    <h3>Petrochemicals</h3>
                    <p>For reactor vessels, heat exchangers, and process piping.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-5.svg') }}" alt="Fertilizer Plants icon"/>
                    </div>
                    <h3>Fertilizer Plants</h3>
                    <p>Compressors, process units, and ammonia lines.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-6.svg') }}" alt="Firefighting Systems icon"/>
                    </div>
                    <h3>Firefighting Systems</h3>
                    <p>Pump skids and high-pressure pipeline fittings.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-7.svg') }}" alt="Food &amp; Beverage icon"/>
                    </div>
                    <h3>Food &amp; Beverage</h3>
                    <p>Hygienic piping, processing equipment, and maintenance.</p>
                </article>
                <article class="industry-card">
                    <div class="industry-icon">
                        <img src="{{ asset('website/assests/images/application-tool-8.svg') }}" alt="Water &amp; Irrigation icon"/>
                    </div>
                    <h3>Water &amp; Irrigation</h3>
                    <p>Pipeline connections, pumps, and valves.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- ========== WHY HAYA TEQ (kept) ========== --}}
    <section class="section soft" id="why">
        <div class="container why-grid">
            <div class="why-image">
                <img alt="HAYA TEQ industrial applications" src="{{ asset('website/assests/images/Applications-2.webp') }}"/>
            </div>
            <div class="why-copy">
                <div class="kicker">Why HAYA TEQ?</div>
                <h2>Industrial products presented with the detail professional buyers expect.</h2>
                <p>HAYA TEQ combines a broad tool range with practical product-selection support. The goal is to make it easier for customers to identify the right system, understand the important specifications and receive reliable assistance before and after purchase.</p>
                <div class="why-points">
                    <div class="why-point"><b>✓</b><div><strong>Technical product knowledge</strong><span>Selection support based on the actual application.</span></div></div>
                    <div class="why-point"><b>✓</b><div><strong>Clear product documentation</strong><span>Specifications, drawings, manuals and support information.</span></div></div>
                    <div class="why-point"><b>✓</b><div><strong>Industrial product range</strong><span>Machining, bolting, flange work, testing and maintenance.</span></div></div>
                    <div class="why-point"><b>✓</b><div><strong>Responsive commercial support</strong><span>Quotation assistance and product-availability guidance.</span></div></div>
                    <div class="why-point"><b>✓</b><div><strong>After-sales continuity</strong><span>Accessories, spares, calibration and service support.</span></div></div>
                    <div class="why-point"><b>✓</b><div><strong>Application-specific enquiries</strong><span>Forms capture the information required for better selection.</span></div></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== WHAT SETS US APART (same full-bleed style as Industries Served) ========== --}}
    <section class="section dark trust-section" id="trust">
        <div class="container">
            <div class="section-head section-head-stack trust-head">
                <div class="section-copy">
                    <div class="kicker trust-kicker">What sets us apart</div>
                    <h2 class="trust-title">Trusted by industry professionals</h2>
                </div>
            </div>
            <div class="trust-grid">
                <article class="trust-card">
                    <div class="trust-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <h3>Expert Support</h3>
                    <p>Responsive, knowledgeable support to keep operations running without delays.</p>
                </article>
                <article class="trust-card">
                    <div class="trust-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3>Proven Product Quality</h3>
                    <p>Tools engineered for precision, durability and consistent performance.</p>
                </article>
                <article class="trust-card">
                    <div class="trust-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
                    </div>
                    <h3>Custom Engineering</h3>
                    <p>Tailored solutions designed around actual site conditions.</p>
                </article>
                <article class="trust-card">
                    <div class="trust-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <h3>Reliable Delivery</h3>
                    <p>On-time, dependable delivery you can plan your projects around.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- ========== RESOURCES (kept) ========== --}}
    <section class="section" id="resources">
        <div class="container">
            <div class="section-head">
                <div class="section-copy">
                    <div class="kicker">Resources &amp; Technical Support</div>
                    <h2>Continue from product discovery to technical selection.</h2>
                    <p>Use these direct enquiry paths to request product catalogues, technical charts or application assistance.</p>
                </div>
            </div>
            <div class="resources-grid">
                <article class="resource-card">
                    <div class="resource-icon">PDF</div>
                    <h3>Request Product Catalogues</h3>
                    <p>Receive catalogues for portable machining, bolting, hydrotest and maintenance-tool categories.</p>
                    <a class="text-link" href="mailto:sales@hayateq.com?subject=Request%20for%20HAYA%20TEQ%20Product%20Catalogues">Request catalogues <span>→</span></a>
                </article>
                <article class="resource-card">
                    <div class="resource-icon">CH</div>
                    <h3>Technical Charts &amp; Guides</h3>
                    <p>Request sizing guides, model comparisons, pressure/flow information and torque-tool guidance.</p>
                    <a class="text-link" href="mailto:sales@hayateq.com?subject=Request%20for%20Technical%20Charts%20and%20Guides">Request technical guides <span>→</span></a>
                </article>
                <article class="resource-card">
                    <div class="resource-icon">ENG</div>
                    <h3>Application Support</h3>
                    <p>Send dimensions, drawings, photographs and project conditions for product-selection support.</p>
                    <a class="text-link" href="#contact">Submit application <span>→</span></a>
                </article>
            </div>
        </div>
    </section>

    {{-- ========== TECHNICAL ENQUIRY (full-bleed dark like Industries / What sets us apart) ========== --}}
    <section class="section dark contact-section" id="contact">
        <div class="container">
            <div class="section-head section-head-stack contact-head">
                <div class="section-copy">
                    <div class="kicker contact-kicker">Technical Enquiry</div>
                    <div class="contact-get-started">Get started</div>
                    <h2 class="contact-title">Tell us your application and we’ll guide you to the right product.</h2>
                    <p class="contact-lead">For the best results, share sizes, torque, pressure, materials or site conditions. This supports quotation requests, sales engagement and deeper buyer qualification.</p>
                </div>
            </div>
            <div class="contact-band">
            <div class="contact-copy">
                <div class="contact-chips">
                    <span>Pipe size / flange details</span>
                    <span>Torque requirement</span>
                    <span>Pressure / flow requirement</span>
                    <span>Project industry &amp; site conditions</span>
                </div>
                <div class="contact-detail"><small>Phone</small><strong><a href="tel:+61410555595">+61 410 555 595</a></strong></div>
                <div class="contact-detail"><small>Email</small><strong><a href="mailto:sales@hayateq.com">sales@hayateq.com</a></strong></div>
            </div>
            <form class="contact-form" id="enquiryForm">
                @csrf
                <h3>Request a Quote</h3>
                <div class="form-grid">
                    <div class="field"><label>Full name</label><input id="enq-name" name="name" placeholder="Your name" required/></div>
                    <div class="field"><label>Company</label><input id="enq-company" name="company" placeholder="Company name" required/></div>
                    <div class="field"><label>Email</label><input id="enq-email" name="email" placeholder="name@company.com" required type="email"/></div>
                    <div class="field"><label>Phone</label><input id="enq-phone" name="phone" placeholder="+61 …"/></div>
                    <div class="field">
                        <label>Interested in</label>
                        <select id="enq-category" name="category">
                            <option>Portable Machining Tools</option>
                            <option>Hydraulic Torque Tools &amp; Pumps</option>
                            <option>Hand Torque Wrenches &amp; Accessories</option>
                            <option>Flange Maintenance Tools</option>
                            <option>Hydrotest &amp; Pressure Systems</option>
                            <option>Hydraulic Cylinders &amp; Pumps</option>
                            <option>Other / Request Recommendation</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Industry</label>
                        <select id="enq-industry" name="industry">
                            <option>Oil &amp; Gas</option>
                            <option>Petrochemical &amp; Refining</option>
                            <option>Power Generation</option>
                            <option>Offshore &amp; Marine</option>
                            <option>Mining</option>
                            <option>Fabrication</option>
                            <option>Construction &amp; Steel</option>
                            <option>Wind &amp; Renewable Energy</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="field full">
                        <label>Project requirement</label>
                        <textarea id="enq-details" name="project_requirement" placeholder="Tell us about your application, size range, torque range, pressure requirement, materials or site conditions…" required></textarea>
                    </div>
                </div>
                <p id="enquiryFormMessage" class="enquiry-form-message" style="display:none;margin:12px 0 0;font-size:13px;font-weight:600;"></p>
                <button class="btn btn-primary" type="submit" id="enquirySubmitBtn">Send Enquiry</button>
            </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
/* Hero background videos — cycle like fisherpaykel.com */
(function () {
    const videos = Array.from(document.querySelectorAll('[data-hero-video]'));
    if (!videos.length) return;

    let index = 0;

    function show(i) {
        videos.forEach((v, n) => {
            v.classList.toggle('is-active', n === i);
            if (n !== i) {
                try { v.pause(); v.currentTime = 0; } catch (e) {}
            }
        });
        const active = videos[i];
        const playPromise = active.play();
        if (playPromise && typeof playPromise.catch === 'function') {
            playPromise.catch(function () { /* autoplay blocked */ });
        }
    }

    videos.forEach((video, i) => {
        video.addEventListener('ended', function () {
            index = (i + 1) % videos.length;
            show(index);
        });
        video.addEventListener('error', function () {
            index = (i + 1) % videos.length;
            show(index);
        });
    });

    show(0);
})();

document.getElementById('enquiryForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const btn = document.getElementById('enquirySubmitBtn');
    const msg = document.getElementById('enquiryFormMessage');
    const token = form.querySelector('input[name="_token"]')?.value
        || document.querySelector('meta[name="csrf-token"]')?.content
        || '';

    const payload = {
        name: document.getElementById('enq-name').value.trim(),
        company: document.getElementById('enq-company').value.trim(),
        email: document.getElementById('enq-email').value.trim(),
        phone: document.getElementById('enq-phone').value.trim(),
        category: document.getElementById('enq-category').value,
        industry: document.getElementById('enq-industry').value,
        project_requirement: document.getElementById('enq-details').value.trim(),
    };

    btn.disabled = true;
    btn.textContent = 'Sending…';
    msg.style.display = 'none';

    try {
        const res = await fetch(@json(route('enquiry.quote.store')), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(payload),
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok || data.status === false) {
            const firstError = data.errors
                ? Object.values(data.errors).flat()[0]
                : (data.message || 'Something went wrong. Please try again.');
            msg.style.display = 'block';
            msg.style.color = '#c0392b';
            msg.textContent = firstError;
            return;
        }

        msg.style.display = 'block';
        msg.style.color = '#1a7a3c';
        msg.textContent = data.message || 'Enquiry submitted successfully.';
        form.reset();
    } catch (e) {
        msg.style.display = 'block';
        msg.style.color = '#c0392b';
        msg.textContent = 'Network error. Please try again.';
    } finally {
        btn.disabled = false;
        btn.textContent = 'Send Enquiry';
    }
});
</script>
@endpush
