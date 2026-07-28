@extends('website.layout.app')
@section('content')
    <!-- =============== Inner Banner =============== -->
    <section class="inner-banner" id="inner-banner"
        style="background-image: url({{ asset('website/assests/images/about-bg.png') }});">
        <div class="container">
            <div class="inner-content">
                <h2 class="heading">Services</h2>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
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
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/service-1.png') }}"
                                                    alt="service-1">
                                                <div class="service-content">
                                                    <h6>Calibration Services</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Traceable calibration of torque, tensioning, and precision measurement equipment in accordance with applicable standards, ensuring measurement integrity and compliance.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/service-4.png') }}"
                                                    alt="service-2">
                                                <div class="service-content">
                                                    <h6>Maintenance Repair & Service</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Diagnostics, servicing, and overhaul of hydraulic, mechanical, and bolting equipment to restore performance, maintain tolerances, and extend service life.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/special_customization.jpeg') }}"
                                                    alt="service-3">
                                                <div class="service-content">
                                                    <h6>Special Customisation</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Design and modification of tools and equipment to suit applicationspecific constraints, including low-clearance, high-load, and restricted-access environments.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/service-2.png') }}"
                                                    alt="service-4">
                                                <div class="service-content">
                                                    <h6>Tools & Equipment Rental</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Provision of calibrated and certified tools ready for deployment, supporting short-term and project-based operational requirements.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/Asset_management.jpeg') }}"
                                                    alt="service-2">
                                                <div class="service-content">
                                                    <h6>Asset Management</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Asset tracking, inspection scheduling, calibration control, and lifecycle management to maintain compliance and operational readiness.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/EPC_Projects.jpeg') }}"
                                                    alt="service-6">
                                                <div class="service-content">
                                                    <h6>EPC Projects Deliverables</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Supply of technical documentation, tooling specifications, QA/QC records, and compliance data aligned with EPC project requirements and standards.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/Commissioning.jpeg') }}"
                                                    alt="service-7">
                                                <div class="service-content">
                                                    <h6>Commissioning Deliverables</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Preparation of method statements, torque/tension procedures, calibration records, and verification reports to support system commissioning and acceptance.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="services-images">
                                        <div class="flip-inner">
                                            <div class="flip-front">
                                                <img src="{{ asset('website/assests/images/On_Site.jpeg') }}"
                                                    alt="service-8">
                                                <div class="service-content">
                                                    <h6>On-Site Execution</h6>
                                                </div>
                                            </div>
                                            <div class="flip-back">
                                                <p>Controlled bolting operations and on-site machining services, executed in accordance with approved procedures, safety standards, and project specifications.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        {{-- <form action="#" class="service-form">
                            <div class="service-heading">
                                <h5>Service Enquiry</h5>
                                <p>Get in touch with our experts</p>
                            </div>
                            <div class="form-part">
                                <div class="row spcl-row">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="exampleInputName1"
                                            aria-describedby="emailHelp" placeholder="Full Name">
                                    </div>
                                    <div class="col-12">
                                        <input type="email" class="form-control" id="exampleInputEmail2"
                                            aria-describedby="emailHelp" placeholder="Email">
                                    </div>
                                    <div class="col-12">
                                        <input type="number" class="form-control" id="exampleInputPhone1"
                                            aria-describedby="emailHelp" placeholder="Phone Number">
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select Service</option>
                                            <option value="calibration services">Calibration Services</option>
                                            <option value="maintenance repair & service">Maintenance Repair & Service
                                            </option>
                                            <option value="special customisation">Special Customisation</option>
                                            <option value="tools & equipment rental">Tools & Equipment Rental</option>
                                            <option value="asset management">Asset Management</option>
                                            <option value="epc projects deliverables">EPC Projects Deliverables</option>
                                            <option value="commissioning deliverables">Commissioning Deliverables</option>
                                            <option value="on-site execution">On-Site Execution</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                            placeholder="Write your requirements..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn">Enquiry Now <img
                                                src="{{ asset('website/assests/images/enquire.svg') }}"
                                                alt="enquire"></button>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                        <form action="{{ route('service.enquiry.store') }}" method="POST" class="service-form">
                            @csrf

                            <div class="service-heading">
                                <h5>Service Enquiry</h5>
                                <p>Get in touch with our experts</p>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
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
                                            Enquiry Now
                                            <img src="{{ asset('website/assests/images/enquire.svg') }}" alt="enquire">
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
@endsection()
