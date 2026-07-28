@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Terms and Conditions</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Terms and Conditions</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== About =============== -->

    <section class="terms-section">
        <div class="terms-container">

            <div class="terms-header">
                {{-- <span class="terms-badge">Terms &amp; Conditions</span>
                <h1>Terms &amp; Conditions</h1> --}}
                <p class="last-updated">Last Updated: 20 May 2026</p>
            </div>

            <div class="terms-card">
                <p>
                    Welcome to <strong>HAYATEQ</strong>. By accessing or using this website, you agree to comply with
                    and be bound by the following Terms &amp; Conditions. Please read them carefully before using our
                    website.
                </p>

                <div class="terms-block">
                    <h2>1. General Information</h2>
                    <p>
                        This website is operated by HAYATEQ. Throughout the site, the terms “we”, “us”, and “our”
                        refer to HAYATEQ.
                    </p>
                    <p>
                        By visiting our website, submitting enquiries, or purchasing products from us, you agree to these
                        Terms &amp; Conditions.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>2. Products &amp; Services</h2>
                    <p>
                        All products, specifications, descriptions, images, and technical information displayed on this
                        website are provided for general informational purposes only.
                    </p>
                    <p>We reserve the right to:</p>
                    <ul>
                        <li>Modify product specifications without prior notice</li>
                        <li>Correct any errors or omissions</li>
                        <li>Discontinue products at any time</li>
                        <li>Update pricing without notice</li>
                    </ul>
                    <p>
                        Product images may be representative only and actual products may vary depending on manufacturing
                        updates or customer requirements.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>3. Quotations &amp; Pricing</h2>
                    <p>All quotations provided by HAYATEQ are subject to:</p>
                    <ul>
                        <li>Final technical confirmation</li>
                        <li>Product availability</li>
                        <li>Shipping and freight costs</li>
                        <li>Applicable taxes and duties</li>
                    </ul>
                    <p>
                        Quoted prices are valid only for the specified period mentioned in the quotation.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>4. Orders &amp; Acceptance</h2>
                    <p>
                        Orders are considered accepted only after written confirmation from HAYATEQ.
                    </p>
                    <p>We reserve the right to reject or cancel orders due to:</p>
                    <ul>
                        <li>Product unavailability</li>
                        <li>Incorrect pricing or specifications</li>
                        <li>Payment issues</li>
                        <li>Compliance concerns</li>
                    </ul>
                </div>

                <div class="terms-block">
                    <h2>5. Payment Terms</h2>
                    <p>
                        Payment terms are specified on quotations, invoices, or sales agreements.
                        Late payments may result in delays, suspension of supply, or additional charges where applicable.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>6. Shipping &amp; Delivery</h2>
                    <p>
                        Delivery times are estimates only and may vary depending on production schedules, freight
                        availability,
                        customs clearance, or other external factors.
                    </p>
                    <p>
                        HAYATEQ is not liable for delays caused by third-party logistics providers, customs authorities,
                        weather conditions, or force majeure events.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>7. Warranty</h2>
                    <p>
                        HAYATEQ products are manufactured and supplied to high industrial standards.
                    </p>
                    <p>Unless otherwise stated in writing:</p>
                    <ul>
                        <li>Warranty applies only to manufacturing defects</li>
                        <li>
                            Warranty does not cover misuse, improper installation, unauthorized modification, wear and tear,
                            or damage caused by improper operation
                        </li>
                        <li>Warranty claims must be submitted with supporting details and proof of purchase</li>
                    </ul>
                </div>

                <div class="terms-block">
                    <h2>8. Limitation of Liability</h2>
                    <p>
                        To the maximum extent permitted by law, HAYATEQ shall not be liable for:
                    </p>
                    <ul>
                        <li>Indirect or consequential losses</li>
                        <li>Downtime or production losses</li>
                        <li>Loss of profits or business interruption</li>
                        <li>Damage caused by misuse or improper application of products</li>
                    </ul>
                    <p>
                        Users are responsible for ensuring products are suitable for their intended application.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>9. Intellectual Property</h2>
                    <p>
                        All website content including text, graphics, logos, product descriptions, images, and technical
                        material is the property of HAYATEQ unless otherwise stated.
                    </p>
                    <p>
                        No content may be copied, reproduced, distributed, or used without prior written permission.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>10. Website Use</h2>
                    <p>You agree not to:</p>
                    <ul>
                        <li>Use the website for unlawful purposes</li>
                        <li>Attempt unauthorized access to systems or data</li>
                        <li>Upload malicious software or harmful content</li>
                        <li>Misrepresent your identity or affiliation</li>
                    </ul>
                </div>

                <div class="terms-block">
                    <h2>11. External Links</h2>
                    <p>
                        This website may contain links to third-party websites for informational purposes.
                        HAYATEQ is not responsible for the content, security, or practices of external websites.
                    </p>
                </div>

                <div class="terms-block">
                    <h2>12. Governing Law</h2>
                    <p>
                        These Terms &amp; Conditions shall be governed by and interpreted in accordance with the laws
                        applicable in Western Australia, Australia.
                    </p>
                </div>

                <div class="terms-block contact-block">
                    <h2>13. Contact Information</h2>
                    <p>
                        For any enquiries regarding these Terms &amp; Conditions, please contact:
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
