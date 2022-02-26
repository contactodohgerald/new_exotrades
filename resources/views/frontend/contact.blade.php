@php 
$pageName = 'World Leading Cryptocurrency Platform'; 
$headerValue = 'inner-page';
@endphp

@extends('layouts.design')

@section('extra_style')
    
@endsection

@section('content')
    <!-- Breadcrumb Area Start -->
	<section class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="title">Contact Us</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./"> <i class="fas fa-home"></i> Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							<a href="{{ route('contact') }}">Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Area End -->

	<!-- Calculator Area Start -->
	<div class="calculator mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="calculator-box"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Calculator Area End -->

	<!-- Contact Area Start -->
	<section class="contact">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle">Contact Us</h5>
						<h2 class="title"> Get in Touch</h2>
						<p class=""> Please complete the form below and one of our team members will get in touch with you as soon as possible.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8">
					<div class="contact-form-wrapper">
						<h4 class="title">Drop us a Line</h4>
						<form action="{{ route('contact-mail') }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="name">Name :</label>
										<input type="text" class="input-field" id="name" name="name" placeholder="Enter Your Name" required>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="email">Email :</label>
										<input type="email" class="input-field" id="email" name="email" placeholder="Enter Your Email" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="subjict">Subjict :</label>
										<input type="text" class="input-field" id="subjict" name="subjict" placeholder="Write Your Subjict" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group button-area">
										<label for="message">Message :</label>
										<textarea id="message" name="message" class="input-field textarea" placeholder="Write Your Message" required></textarea>
										<button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-lg-4 d-flex">
					<div class="address-area">
						<h4 class="title">Contact Information</h4>
						<ul class="address-list">
							<li>
								<p>
                                    <i class="fas fa-map-marker-alt"></i>
                                    ADDRESS: {{ $setting->site_address }}
                                </p>
							</li>
							<li>
								<p>
                                    <i class="fas fa-phone"></i> 
                                    Phone:  {{ $setting->site_phone }}
                                </p>
							</li>
                            <li>
								<p>
                                    <i class="far fa-envelope"></i>
									Email:  <a href="mailto:{{ $setting->site_email }}" class="__cf_email__"> {{ $setting->site_email }}</a>
								</p>
							</li>
						</ul>
						<ul class="social-links">
							<li>
								<a href="#">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-linkedin-in"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fab fa-pinterest-p"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact Area End -->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection