@extends('website.layout.app')
@section('title', $seo->meta_title ?? 'HAYA TEQ | Contact')

@section('meta_description', $seo->meta_description ?? '')

@section('meta_keywords', $seo->meta_keywords ?? '')
@section('content')
    <style>
        .modern-contact-form {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .modern-contact-form label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }

        .modern-contact-form label span {
            color: red;
        }

        .modern-contact-form .form-control,
        .modern-contact-form .form-select {
            height: 48px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modern-contact-form textarea.form-control {
            height: 120px;
        }

        .phone-group {
            display: flex;
            gap: 10px;
        }

        .phone-group select {
            width: 120px;
        }

        .submit-btn {
            background: #0d4ea6;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 25px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        .submit-btn img {
            width: 20px;
        }

        .security-note {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .security-note i {
            color: #0d4ea6;
            margin-right: 8px;
        }

        .sheild {
            height: 20px;
            width: 20px;
        }

        @media(max-width:768px) {

            .phone-group {
                flex-direction: column;
            }

            .phone-group select {
                width: 100%;
            }

        }
    </style>
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Contact us</h2>
                <ul>
                    <li>
                        <a href="{{ route('homepage') }}">Home</a>
                    </li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- =============== Contact us =============== -->
    <section class="contact-us" id="contact-us">
        <div class="container">
            <div class="mainHeading">
                <h2 class="subheading">Contact Our Team</h2>
                <p class="para">Choose the department and we’ll connect you
                    with the right expert</p>
            </div>
            <div class="social-contact">
                <div class="row spcl-row justify-content-center">
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="each-contact">
                            <div class="contact-icon">
                                <img src="{{ asset('website/assests/images/call.svg') }}" alt="call">
                            </div>
                            <div class="contact-content">
                                <p class="para">Call us</p>
                                <a href="tel:61410555595">+61 410 555
                                    595</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="each-contact">
                            <div class="contact-icon">
                                <img src="{{ asset('website/assests/images/mail.svg') }}" alt="mail">
                            </div>
                            <div class="contact-content">
                                <p class="para">Email us</p>
                                <a href="mailto:sales@hayateq.com">sales@hayateq.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="each-contact">
                            <div class="contact-icon">
                                {{-- <img src="{{ asset('website/assests/images/africa-geo-map.png') }}" alt="web"> --}}
                                <img src="{{ asset('website/assests/images/australia-map.png') }}" alt="web">
                            </div>
                            <div class="contact-content">
                                <p class="para">Head Office</p>
                                <a href="javascript:void(0);">Australia</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-wrapper">
                {{-- =============================================================== --}}
                <div class="contact-form modern-contact-form">

                    <div id="formMessage" class="mb-3"></div>

                    <form id="contactForm" action="{{ route('enquiry.contact.store') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Department <span>*</span></label>
                                <select name="department" class="form-select" required>
                                    <option value="">Please select department</option>
                                    <option value="technical_support">Technical Support</option>
                                    <option value="export_sales">Export / Sales</option>
                                    <option value="human_resources">Human Resources</option>
                                    <option value="authorized_agents">Authorized Agents</option>
                                    <option value="management">Management</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Full Name <span>*</span></label>
                                <input type="text" placeholder="Enter your full name" name="name" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Email <span>*</span></label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="Enter your email address" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Business Name <span>*</span></label>
                                <input type="text" name="company" class="form-control"
                                    placeholder="Enter your business name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Phone Number <span>*</span></label>

                                <div class="phone-group">
                                    <input type="text" name="code" class="w-25 form-control" placeholder="+61"
                                        required>

                                    <input type="text" name="phone" class="form-control"
                                        placeholder="Enter your phone number" required>

                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Industry <span>*</span></label>

                                <select name="subject" class="form-select" required>
                                    <option value="">Select your industry</option>
                                    <option>Aerospace</option>
                                    <option>Automotive</option>
                                    <option>Chemical</option>
                                    <option>Construction</option>
                                    <option>General Maintenance</option>
                                    <option>Manufacturing</option>
                                    <option>Military</option>
                                    <option>Mining</option>
                                    <option>Nuclear</option>
                                    <option>Oil & Gas</option>
                                    <option>Power Generation</option>
                                    <option>Pulp & Paper</option>
                                    <option>Rail</option>
                                    <option>Structural</option>
                                    <option>Transportation</option>
                                    <option>Wind</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Message <span>*</span></label>
                                <textarea name="message" rows="4" class="form-control" placeholder="Type your message here..." required></textarea>
                            </div>

                            <div class="col-md-12">

                                <button type="submit" class="submit-btn">
                                    Submit Enquiry
                                    <img src="{{ asset('website/assests/images/paper-plane.png') }}" alt="">
                                </button>

                            </div>

                        </div>
                    </form>

                </div>

            </div>
            <div class="security-note">
                <p class="d-flex text-center justify-content-center">
                    {{-- <span > --}}
                    <img src="{{ asset('website/assests/images/security.png') }}" alt=""
                        class="img-fluid sheild mx-2">
                    {{-- </span> --}}
                    {{-- <i class="fa fa-shield-alt"></i> --}}
                    Your information is secure and will only be used to respond to your inquiry.
                </p>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.tab-item').forEach(tab => {

            tab.addEventListener('click', function() {

                document.querySelectorAll('.tab-item').forEach(t => {
                    t.classList.remove('active');
                });

                this.classList.add('active');

                document.getElementById('department').value = this.dataset.department;

            });

        });
    </script>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {

            e.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let messageBox = document.getElementById('formMessage');

            fetch(form.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {

                    messageBox.style.display = "block";

                    if (data.status) {

                        messageBox.style.color = "green";
                        messageBox.innerHTML = data.message;
                        form.reset();

                    } else {

                        messageBox.style.color = "red";
                        messageBox.innerHTML = data.message;

                    }

                    // ⬇️ message auto hide after 10 seconds
                    setTimeout(function() {
                        messageBox.style.display = "none";
                        messageBox.innerHTML = "";
                    }, 10000);

                })
                .catch(error => {

                    messageBox.style.display = "block";
                    messageBox.style.color = "red";
                    messageBox.innerHTML = "Something went wrong. Please try again.";

                    setTimeout(function() {
                        messageBox.style.display = "none";
                        messageBox.innerHTML = "";
                    }, 10000);

                });

        });
    </script>
@endsection()
