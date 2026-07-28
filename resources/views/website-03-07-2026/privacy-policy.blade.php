@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Privacy Policy</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== About =============== -->

    <section class="privacy-policy-section">
        <div class="privacy-container">

            <div class="privacy-header">
                {{-- <span class="privacy-badge">Privacy Policy</span>
                <h1>Privacy Policy</h1> --}}
                <p class="last-updated">Last Updated: 20 May 2026</p>
            </div>

            <div class="privacy-card">
                <p>
                    <strong>HAYATEQ</strong> respects your privacy and is committed to protecting your personal information.
                    This Privacy Policy explains how we collect, use, store, and protect information when you use our
                    website.
                </p>

                <div class="policy-block">
                    <h2>1. Information We Collect</h2>
                    <p>We may collect the following information:</p>
                    <ul>
                        <li>Name and company details</li>
                        <li>Email address and office phone number</li>
                        <li>Shipping or billing information</li>
                        <li>Enquiry and quotation details</li>
                        <li>Website usage data and analytics</li>
                    </ul>
                </div>

                <div class="policy-block">
                    <h2>2. How We Use Your Information</h2>
                    <p>We use collected information to:</p>
                    <ul>
                        <li>Respond to enquiries and quote requests</li>
                        <li>Process orders and provide customer support</li>
                        <li>Improve our products and website performance</li>
                        <li>Send technical or commercial updates where relevant</li>
                        <li>Maintain internal business records</li>
                    </ul>
                </div>

                <div class="policy-block">
                    <h2>3. Cookies &amp; Website Analytics</h2>
                    <p>
                        Our website may use cookies and analytics tools to improve user experience and understand website
                        traffic.
                        Users may disable cookies through their browser settings if preferred.
                    </p>
                </div>

                <div class="policy-block">
                    <h2>4. Data Sharing</h2>
                    <p>
                        HAYATEQ does not sell or rent personal information to third parties.
                        Information may be shared only where necessary with:
                    </p>
                    <ul>
                        <li>Freight and logistics providers</li>
                        <li>Payment service providers</li>
                        <li>Technical or service partners</li>
                        <li>Legal or regulatory authorities when required by law</li>
                    </ul>
                </div>

                <div class="policy-block">
                    <h2>5. Data Security</h2>
                    <p>
                        We take reasonable measures to protect personal information from unauthorized access, misuse,
                        disclosure, or loss. However, no internet transmission or electronic storage method can be
                        guaranteed
                        as completely secure.
                    </p>
                </div>

                <div class="policy-block">
                    <h2>6. Third-Party Links</h2>
                    <p>
                        Our website may include links to third-party websites.
                        We are not responsible for the privacy practices or content of external websites.
                    </p>
                </div>

                <div class="policy-block">
                    <h2>7. Your Rights</h2>
                    <p>
                        You may request access, correction, or removal of your personal information by contacting us.
                        We will respond to reasonable requests in accordance with applicable laws.
                    </p>
                </div>

                <div class="policy-block">
                    <h2>8. Policy Updates</h2>
                    <p>
                        HAYATEQ reserves the right to update this Privacy Policy at any time.
                        Changes will be posted on this page with the updated revision date.
                    </p>
                </div>

                <div class="policy-block contact-block">
                    <h2>9. Contact Us</h2>
                    <p>
                        If you have any questions regarding this Privacy Policy or how your information is handled,
                        please contact:
                    </p>

                    <div class="contact-box">
                        <h3>HAYATEQ</h3>
                        <p>
                            Email:
                            <a href="mailto:sales@hayateq.com">sales@hayateq.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
