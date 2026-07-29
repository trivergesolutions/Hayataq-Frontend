@extends('website.layout.app')
@section('title', $seo->meta_title ?? 'HAYA TEQ | Sevices')

@section('meta_description', $seo->meta_description ?? '')

@section('meta_keywords', $seo->meta_keywords ?? '')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Services</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Services =============== -->
    <section class="services bg-sky_blue" id="services">
        <div class="container">
            <div class="mainHeading">
                <!-- <h2 class="subheading">Our Services</h2> -->
            </div>
            <div class="service-part">
                <div class="row spcl-row">
                    <div class="col-lg-7">
                        <div class="service-left">
                            <div class="row spcl-row">
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/HT-507.png') }}"
                                        data-title="Sales & Rental"
                                        data-description="
                                                        <ol>
                                                            <li>Hydraulic Torque Wrenches (Square Drive &amp; Low Profile Cassette)</li>
                                                            <li>Pneumatic and Battery Torque Nutrunners</li>
                                                            <li>Manual Torque Wrenches</li>
                                                            <li>Electric and Pneumatic Hydraulic Pumps</li>
                                                            <li>Hydraulic Hand and Foot Pumps</li>
                                                            <li>Hydraulic Cylinders and Rams</li>
                                                            <li>10,000 PSI Hydraulic Hose Assemblies</li>
                                                            <li>Impact Sockets, Adapters and Reducers</li>
                                                            <li>Bolt Tensioning Systems</li>
                                                            <li>36,260 PSI Hydraulic Hose Assemblies</li>
                                                            <li>Flange Facing Machines</li>
                                                        </ol>">
                                        <img src="{{ asset('website/assests/images/HT.png') }}" alt="service-4">
                                        <div class="service-content">
                                            <h6>Sales & Rental</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/Calibration Services-orignal.png') }}"
                                        data-title="Calibration & Testing"
                                        data-description="
                                        <ol>
                                                                <li>Hydraulic Torque Wrenches (0–34,000 Nm / 0–25,000 lbf·ft)</li>
                                                                <li>Manual Torque Wrenches (0–1,500 Nm / 0–1,100 lbf·ft)</li>
                                                                <li>Pneumatic and Battery Torque Nutrunners (0–6,750 Nm)</li>
                                                                <li>Hydraulic Torque Wrench Pumps (10,000 PSI)</li>
                                                                <li>Hydraulic Hoses (10,000 PSI)</li>
                                                                <li>Bolt Tensioning Pumps and Tensioners (Up to 36,000 PSI)</li>
                                                                <li>Load Testing Services</li>
                                                                <li>Hydrostatic Testing – Hand and Air-Driven Pumps</li>
                                                                <li>Pressure Gauge Comparison Testing (0–36,000 PSI)</li>
                                                                <li>Digital Pressure Gauge Calibration (NATA Traceable)</li>

                                        </ol>">
                                        <img src="{{ asset('website/assests/images/service-1.png') }}" alt="service-1">
                                        <div class="service-content">
                                            <h6>Calibration & Testing</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/Service and repairs.png') }}"
                                        data-title="Service & Repairs"
                                        data-description="
                                        <ol>
                                                                <li>Hydraulic Torque Wrenches</li>
                                                                <li>Manual Torque Wrenches</li>
                                                                <li>Pneumatic and Battery Torque Nutrunners</li>
                                                                <li>Hydraulic Hand and Foot Pumps</li>
                                                                <li>Hydraulic Hoses</li>
                                                                <li>Bolt Tensioning Equipment</li>
                                                                <li>Hydraulic Rams and Cylinders</li>
                                                                <li>Pneumatic Impact Wrenches</li>
                                        </ol>">
                                        <img src="{{ asset('website/assests/images/Service and repairs.png') }}"
                                            alt="service-2">
                                        <div class="service-content">
                                            <h6>Service & Repairs</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/onsite-execution-orignal.png') }}"
                                        data-title="On-Site Services">
                                        <img src="{{ asset('website/assests/images/On_Site.jpeg') }}" alt="service-8">
                                        <div class="service-content">
                                            <h6>On-Site Services</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/Special-customisation-orignal.png') }}"
                                        data-title="Custom Engineering Solutions">
                                        <img src="{{ asset('website/assests/images/special_customization.jpeg') }}"
                                            alt="service-3">
                                        <div class="service-content">
                                            <h6>Custom Engineering Solutions</h6>
                                        </div>
                                    </div>
                                </div>
                                {{-- <hr class="invisible"> --}}
                                <h5>Additional Services</h5>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/epc-project-orignal.png') }}"
                                        data-title="EPC Projects Deliverables">
                                        <img src="{{ asset('website/assests/images/EPC_Projects.jpeg') }}" alt="service-6">
                                        <div class="service-content">
                                            <h6>EPC Projects Deliverables</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/Commission-orignal.png') }}"
                                        data-title="Commissioning Deliverables">
                                        <img src="{{ asset('website/assests/images/Commissioning.jpeg') }}"
                                            alt="service-7">
                                        <div class="service-content">
                                            <h6>Commissioning Deliverables</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images service-card"
                                        data-img="{{ asset('website/assests/images/Asset-Management-orignal.png') }}"
                                        data-title="Asset Management">
                                        <img src="{{ asset('website/assests/images/Asset_management.jpeg') }}"
                                            alt="service-2">
                                        <div class="service-content">
                                            <h6>Asset Management</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <form action="{{ route('service.enquiry.store') }}" method="POST" class="service-form">
                            @csrf

                            <div class="service-heading">
                                {{-- <h5>Service Enquiry</h5> --}}
                                <h5>Request a Service</h5>
                                <p>Get in touch with our experts</p>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success auto-hide-alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger auto-hide-alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="form-part">
                                <div class="row spcl-row">

                                    <div class="col-12">
                                        <input type="text" name="name" class="form-control" placeholder="Full Name"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="col-12">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ old('email') }}" required>
                                    </div>

                                    <div class="col-12">
                                        <input type="number" name="phone" class="form-control"
                                            placeholder="Phone Number" value="{{ old('phone') }}" required>
                                    </div>

                                    <div class="col-12">
                                        <select name="service" class="form-select" required>
                                            <option value="">Select Service</option>
                                            <option value="Calibration Services">Calibration Services</option>
                                            <option value="Maintenance Repair & Service">Maintenance Repair & Service
                                            </option>
                                            <option value="Special Customisation">Special Customisation</option>
                                            <option value="Tools & Equipment Rental">Tools & Equipment Rental</option>
                                            <option value="Asset Management">Asset Management</option>
                                            <option value="EPC Projects Deliverables">EPC Projects Deliverables</option>
                                            <option value="Commissioning Deliverables">Commissioning Deliverables</option>
                                            <option value="On-Site Execution">On-Site Execution</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <textarea name="requirements" class="form-control" rows="3" placeholder="Write your requirements..." required>{{ old('requirements') }}</textarea>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn">
                                            Submit Request
                                            <img src="{{ asset('website/assests/images/paper-plane.png') }}"
                                                alt="">
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-bg">
            <img src="{{ asset('website/assests/images/service-bg.svg') }}" alt="service-bg">
        </div>
    </section>

    {{-- Normal Modle without swiper --}}
    {{-- <div id="imageModal" class="custom-modal">
        <span class="close-btn">&times;</span>
        <img class="modal-content" id="popupImg">
        <h5 id="popupTitle"></h5>
        <div id="popupDescription"></div>
    </div> --}}

    {{-- Swiper Model --}}
    <div id="imageModal" class="custom-modal">

        <span class="close-btn">&times;</span>

        <div class="popup-slider">

            <!-- Slide 1 -->
            <div class="popup-slide active">

                <img id="popupImg" class="modal-content">

            </div>

            <!-- Slide 2 -->
            <div class="popup-slide">

                <h2 id="popupTitle"></h2>

                <div id="popupDescription"></div>

            </div>

        </div>

        <button class="prev-slide">❮</button>
        <button class="next-slide">❯</button>

    </div>
    {{-- Without swiper script --}}
    {{-- <script>
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', function() {
                document.getElementById("imageModal").style.display = "block";
                document.getElementById("popupImg").src = this.dataset.img;
                document.getElementById("popupTitle").innerText = this.dataset.title;

                document.getElementById("popupDescription").innerHTML =
                    this.dataset.description.replace(/\n/g, "<br>");
            });
        });

        document.querySelector('.close-btn').onclick = function() {
            document.getElementById("imageModal").style.display = "none";
        };
    </script> --}}

    {{-- With swiper script --}}
    <script>
        let scrollTop = 0;
        let currentSlide = 0;

        const slides = document.querySelectorAll('.popup-slide');

        function openModal() {

            scrollTop = window.pageYOffset;

            document.body.style.top = `-${scrollTop}px`;
            document.body.classList.add("modal-open");

            document.getElementById("imageModal").style.display = "block";
        }

        function closeModal() {

            document.getElementById("imageModal").style.display = "none";

            document.body.classList.remove("modal-open");
            document.body.style.top = "";

            window.scrollTo(0, scrollTop);
        }

        function showSlide(index) {

            slides.forEach(slide => slide.classList.remove('active'));

            slides[index].classList.add('active');
        }

        // Service Card Click
        document.querySelectorAll('.service-card').forEach(card => {

            card.addEventListener('click', function() {

                const img = this.dataset.img;
                const title = this.dataset.title;
                const description = this.dataset.description;

                document.getElementById('popupImg').src = img;
                document.getElementById('popupTitle').innerText = title;
                document.getElementById('popupDescription').innerHTML = description || '';

                // ---------- Check Description ----------
                if (description && description.trim() !== '') {

                    // Show Slider Controls
                    document.querySelector('.next-slide').style.display = "block";
                    document.querySelector('.prev-slide').style.display = "block";

                    currentSlide = 0;
                    showSlide(currentSlide);

                } else {

                    // Hide Slider Controls
                    document.querySelector('.next-slide').style.display = "none";
                    document.querySelector('.prev-slide').style.display = "none";

                    // Only Image Slide
                    slides.forEach(slide => slide.classList.remove('active'));
                    slides[0].classList.add('active');
                }

                openModal();

            });

        });

        // Close
        document.querySelector('.close-btn').addEventListener('click', closeModal);

        // Optional: Close on Overlay Click
        document.getElementById("imageModal").addEventListener("click", function(e) {

            if (e.target === this) {
                closeModal();
            }

        });

        // Next
        document.querySelector('.next-slide').addEventListener('click', function() {

            currentSlide++;

            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }

            showSlide(currentSlide);

        });

        // Previous
        document.querySelector('.prev-slide').addEventListener('click', function() {

            currentSlide--;

            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }

            showSlide(currentSlide);

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const alerts = document.querySelectorAll('.auto-hide-alert');

            alerts.forEach(function(alert) {

                setTimeout(function() {

                    alert.style.transition = "opacity 0.6s ease";
                    alert.style.opacity = "0";

                    setTimeout(function() {
                        alert.remove();
                    }, 600);

                }, 15000); // 15 seconds

            });

        });
    </script>

    {{-- NEW CSS --}}
    <style>
        body.modal-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
        }

        /* =========================
                                           MODAL
                                        ========================= */

        .custom-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            background: rgba(0, 0, 0, .88);
            padding: 30px 20px;
            box-sizing: border-box;
        }

        .popup-slider {
            width: 100%;
        }

        /* =========================
                                           IMAGE
                                        ========================= */

        .modal-content {
            display: block;
            width: 58%;
            max-width: 900px;
            height: auto;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .45);
        }

        /* =========================
                                           TITLE
                                        ========================= */

        #popupTitle {
            text-align: center;
            color: #fff;
            margin: 25px auto 20px;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.3;
            width: 90%;
        }

        /* =========================
                                           DESCRIPTION
                                        ========================= */

        #popupDescription {

            width: 58%;
            max-width: 900px;
            margin: auto;
            color: #fff;
            font-size: 16px;
            line-height: 1.8;
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(6px);
            padding: 25px;
            border-radius: 10px;
            box-sizing: border-box;

        }

        /* List */

        #popupDescription ol {

            margin: 0;
            padding-left: 22px;

        }

        #popupDescription li {

            padding: 12px 0;
            /* line-height: 1.7; */
            line-height: 1;

        }

        #popupDescription li {

            border-bottom: 1px solid rgba(255, 255, 255, .15);

        }

        #popupDescription li:last-child {

            border-bottom: none;

        }

        /* =========================
                                           CLOSE
                                        ========================= */

        .close-btn {

            position: fixed;
            top: 15px;
            right: 25px;
            color: #fff;
            font-size: 42px;
            cursor: pointer;
            z-index: 10001;

        }

        /* =========================
                                           SLIDER
                                        ========================= */

        .popup-slide {

            display: none;
            /* text-align: center; */
            text-align: start;

        }

        .popup-slide.active {

            display: block;

        }

        /* =========================
                                           NAVIGATION
                                        ========================= */

        .prev-slide,
        .next-slide {

            position: fixed;
            top: 50%;
            transform: translateY(-50%);

            width: 48px;
            height: 48px;

            border: none;
            border-radius: 50%;

            background: #fff;
            color: #000;

            cursor: pointer;

            z-index: 10000;

            transition: .3s;

        }

        .prev-slide:hover,
        .next-slide:hover {

            background: #0d4fd7;
            color: #fff;

        }

        .prev-slide {

            left: 20px;

        }

        .next-slide {

            right: 20px;

        }

        /* ===================================
                                                   1200px
                                        =================================== */

        @media(max-width:1200px) {

            .modal-content {

                width: 72%;

            }

            #popupDescription {

                width: 72%;

            }

        }

        /* ===================================
                                                   992px
                                        =================================== */

        @media(max-width:992px) {

            .custom-modal {

                padding: 25px 15px;

            }

            .modal-content {

                width: 88%;

            }

            #popupDescription {

                width: 88%;
                padding: 22px;
                font-size: 15px;

            }

            #popupTitle {

                font-size: 28px;

            }

            .prev-slide {

                left: 10px;

            }

            .next-slide {

                right: 10px;

            }

        }

        /* ===================================
                                                   768px
                                        =================================== */

        @media(max-width:768px) {

            .custom-modal {

                padding: 15px 10px;

            }

            .modal-content {

                width: 100%;
                max-width: 100%;

            }

            #popupTitle {

                font-size: 22px;
                margin: 18px auto;

            }

            #popupDescription {

                width: 100%;
                padding: 18px;
                font-size: 14px;
                line-height: 1.7;

            }

            #popupDescription li {

                padding: 10px 0;

            }

            .close-btn {

                top: 10px;
                right: 15px;
                font-size: 34px;

            }

            .prev-slide,
            .next-slide {

                width: 40px;
                height: 40px;
                font-size: 16px;

            }

            .prev-slide {

                left: 5px;

            }

            .next-slide {

                right: 5px;

            }

        }

        /* ===================================
                                                   576px
                                        =================================== */

        @media(max-width:576px) {

            .custom-modal {

                padding: 10px 8px;

            }

            .modal-content {

                width: 100%;

            }

            #popupTitle {

                font-size: 19px;
                line-height: 1.4;

            }

            #popupDescription {

                width: 100%;
                padding: 15px;
                font-size: 13px;

            }

            #popupDescription ol {

                padding-left: 18px;

            }

            #popupDescription li {

                font-size: 13px;
                padding: 8px 0;

            }

            .prev-slide,
            .next-slide {

                width: 34px;
                height: 34px;
                font-size: 14px;

            }

            .close-btn {

                font-size: 30px;

            }

        }
    </style>
@endsection()
