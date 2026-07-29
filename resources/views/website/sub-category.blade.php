@extends('website.layout.app')

@section('title', $parentCategory->name . ' | HAYA TEQ Industrial Solutions')
@section('meta_description', 'Explore ' . $parentCategory->name . ' at HAYA TEQ. High-performance industrial tools engineered for shutdown, maintenance, and field service.')

@section('content')
@if ($parentCategory->is_active == 1)
<main>
    <!-- =============== Hero Banner =============== -->
    <section class="hero" style="min-height: auto; padding: 50px 0 55px;">
        <div class="container hero-grid" style="min-height: auto; padding: 0;">
            <div>
                <div class="eyebrow">
                    <i></i> 
                    <a href="{{ route('homepage') }}" style="color:#bad0e1;">Home</a> &nbsp;·&nbsp; 
                    <a href="{{ route('mainProducts') }}" style="color:#bad0e1;">Products</a> &nbsp;·&nbsp; 
                    <span style="color:#fff;">{{ $parentCategory->name }}</span>
                </div>
                <h1 style="font-size: clamp(2.4rem, 4.5vw, 4rem); margin: 16px 0 14px;">
                    {{ $parentCategory->name }}
                </h1>
                <p class="hero-lead">
                    @if ($parentCategory->name == 'Portable Machining Tools')
                        High-performance onsite machining solutions for precision pipe cutting, beveling, flange facing, and field maintenance applications.
                    @elseif ($parentCategory->name == 'Bolt Torque & Tensioning Tools')
                        Reliable hydraulic torque and bolt tensioning solutions designed for accurate, controlled, and safe bolting operations.
                    @elseif ($parentCategory->name == 'Flange Alignment & Maintenance Tools')
                        Industrial tools engineered for safe flange alignment, spreading, and maintenance during pipeline and shutdown operations.
                    @elseif ($parentCategory->name == 'Hydrotest Pumps & Systems')
                        High-pressure hydrostatic testing systems designed for reliable pressure testing, inspection, and industrial maintenance.
                    @elseif ($parentCategory->name == 'Hydraulic Cylinders & Pumps')
                        Heavy-duty hydraulic cylinders and pump systems built for lifting, pulling, pressing, and controlled force applications.
                    @else
                        Industrial equipment engineered for high performance, reliability, and precision field service.
                    @endif
                </p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="#subcategories">Browse Ranges</a>
                    <a class="btn btn-ghost" href="#contact">Speak to a Specialist</a>
                </div>
            </div>
            <div class="hero-product-stage" style="min-height: 260px;">
                <div class="stage-panel"></div>
                @php
                    $heroImg = asset('website/assests/images/portablemachine-1.svg');
                    if (isset($parentCategory->children[0])) {
                        $firstImg = collect($parentCategory->children[0]->categoryDescription->images ?? [])->where('is_featured', true)->first();
                        if ($firstImg) {
                            $heroImg = asset('category/' . $firstImg['file_name']);
                        }
                    }
                @endphp
                <img alt="{{ $parentCategory->name }}" class="hero-machine" src="{{ $heroImg }}" style="max-height: 260px; object-fit: contain; filter: drop-shadow(0 20px 25px rgba(0,0,0,0.35));"/>
            </div>
        </div>
    </section>

    <!-- =============== Sub-Categories Section =============== -->
    <section class="section soft" id="subcategories">
        <div class="container">
            <div class="section-head">
                <div class="section-copy">
                    <div class="kicker">Product Ranges</div>
                    <h2>Explore {{ $parentCategory->name }} Equipment</h2>
                    <p>Select a sub-category range below to view technical specifications, model options, and available drive systems.</p>
                </div>
            </div>

            <div class="category-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">
                @foreach ($parentCategory->children as $category)
                    @php
                        $images = $category->categoryDescription->images ?? [];
                        $featuredImage = collect($images)->where('is_featured', true)->first();
                        $imagePath = $featuredImage 
                            ? asset('category/' . $featuredImage['file_name']) 
                            : asset('website/assests/images/portablemachine-2.svg');
                        $productCount = count($category->products ?? []);
                    @endphp
                    <div class="category-card subcategory-item-card" data-target="products-{{ $category->id }}" data-title="{{ $category->name }}" style="cursor: pointer;">
                        <div class="category-image">
                            <img src="{{ $imagePath }}" alt="{{ $category->name }}">
                            <span class="category-number">{{ sprintf('%02d', $loop->iteration) }}</span>
                        </div>
                        <div class="category-content">
                            <h3>{{ $category->name }}</h3>
                            <p>{{ $productCount }} {{ \Illuminate\Support\Str::plural('Model Range', $productCount) }} available</p>
                            <a href="javascript:void(0)" class="text-link explore-range" data-target="products-{{ $category->id }}" data-title="{{ $category->name }}">
                                Explore Range <span>→</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- =============== Subcategory Products Expandable Area =============== -->
            <div class="col-12" style="margin-top: 36px;">
                <div id="products-wrapper" style="display:none; background: #fff; border: 1px solid var(--line); border-radius: 20px; padding: 32px; box-shadow: var(--shadow);">
                    <div class="section-head" style="margin-bottom: 24px; align-items: center;">
                        <div class="section-copy">
                            <div class="kicker">Available Models</div>
                            <h2 id="subcategoryTitle" style="font-size: 2rem;">Product Models</h2>
                            <p>Browse all available equipment models and specifications under this range.</p>
                        </div>
                        <div>
                            <button id="closeWrapperBtn" class="btn btn-outline" style="min-height: 38px; padding: 0 14px; font-size: 11px;">Close View ✕</button>
                        </div>
                    </div>
                    <div id="subcategoryProducts"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hidden Subcategory Products Templates -->
    @foreach ($parentCategory->children as $category)
        <div id="products-{{ $category->id }}" class="d-none">
            <div class="featured-grid" style="grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));">
                @forelse($category->products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ $product->featured_image_url ?? asset('website/assests/images/img_4.webp') }}" alt="{{ $product->name }}">
                            <span class="product-category">{{ $category->name }}</span>
                        </div>
                        <div class="product-content">
                            <h3>{{ \Illuminate\Support\Str::limit($product->name, 45) }}</h3>
                            <p>High-precision field equipment engineered for demanding applications.</p>
                            <a href="{{ route('productDetailBySlug', $product->slug) }}" class="btn btn-primary" style="width: 100%; min-height: 42px; font-size: 12px; margin-top: 10px;">
                                View Specifications &amp; Range
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                        <p style="color: var(--muted); font-size: 15px;">No products currently listed for this category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach

    <!-- =============== Contact / Technical Enquiry Section =============== -->
    <section class="section blue-soft" id="contact">
        <div class="container contact-band">
            <div class="contact-copy">
                <div class="kicker" style="color:#74d4ef">Technical Selection &amp; Quote</div>
                <h2>Request a recommendation for {{ $parentCategory->name }}</h2>
                <p>Provide your application parameters (dimensions, material, operating pressure or torque). Our engineering specialists will prepare a technical proposal for your project.</p>
                <div class="contact-detail"><small>Phone</small><strong><a href="tel:+61410555595">+61 410 555 595</a></strong></div>
                <div class="contact-detail"><small>Email</small><strong><a href="mailto:sales@hayateq.com">sales@hayateq.com</a></strong></div>
            </div>
            <form class="contact-form" id="enquiryForm">
                <h3>Enquire About {{ $parentCategory->name }}</h3>
                <div class="form-grid">
                    <div class="field"><label>Full name</label><input id="enq-name" required/></div>
                    <div class="field"><label>Company</label><input id="enq-company" required/></div>
                    <div class="field"><label>Email</label><input id="enq-email" required type="email"/></div>
                    <div class="field"><label>Phone</label><input id="enq-phone"/></div>
                    <div class="field full"><label>Application details</label><textarea id="enq-details" placeholder="Describe sizes, pipe wall thickness, torque requirements, working environment or project timeline." required></textarea></div>
                </div>
                <button class="btn btn-primary" type="submit">Prepare Email Enquiry</button>
            </form>
        </div>
    </section>
</main>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const wrapper = document.getElementById("products-wrapper");
    const closeBtn = document.getElementById("closeWrapperBtn");

    document.querySelectorAll(".explore-range, .subcategory-item-card").forEach(item => {
        item.addEventListener("click", function(e) {
            let target = this.dataset.target || this.querySelector(".explore-range")?.dataset.target;
            let title = this.dataset.title || this.querySelector(".explore-range")?.dataset.title;
            if (!target) return;

            document.getElementById("subcategoryTitle").innerText = title;
            document.getElementById("subcategoryProducts").innerHTML = document.getElementById(target).innerHTML;
            wrapper.style.display = "block";
            wrapper.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    });

    if (closeBtn) {
        closeBtn.addEventListener("click", function() {
            wrapper.style.display = "none";
        });
    }

    const enquiryForm = document.getElementById('enquiryForm');
    if (enquiryForm) {
        enquiryForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const name = document.getElementById('enq-name').value.trim();
            const company = document.getElementById('enq-company').value.trim();
            const email = document.getElementById('enq-email').value.trim();
            const phone = document.getElementById('enq-phone').value.trim();
            const details = document.getElementById('enq-details').value.trim();
            const categoryName = @json($parentCategory->name);

            const subject = encodeURIComponent('HAYA TEQ Category Enquiry - ' + categoryName);
            const body = encodeURIComponent(
                'Category: ' + categoryName + '\n' +
                'Full name: ' + name + '\n' +
                'Company: ' + company + '\n' +
                'Email: ' + email + '\n' +
                'Phone: ' + phone + '\n\n' +
                'Application details:\n' + details
            );
            window.location.href = 'mailto:sales@hayateq.com?subject=' + subject + '&body=' + body;
        });
    }
});
</script>
@endpush

@else
<main>
    <section class="hero" style="min-height: auto; padding: 60px 0;">
        <div class="container text-center">
            <h1 style="color: #fff;">{{ $parentCategory->name }}</h1>
            <p class="hero-lead" style="margin: 15px auto;">This category page is currently being updated. Please check back soon or contact our sales team.</p>
            <div style="margin-top: 25px;">
                <a class="btn btn-primary" href="{{ route('homepage') }}">Return to Homepage</a>
            </div>
        </div>
    </section>
</main>
@endif
@endsection
