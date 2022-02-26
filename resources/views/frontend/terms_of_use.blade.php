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
					<h4 class="title">Rules & Agreements</h4>
					<ul class="breadcrumb-list">
						<li>
							<a href="./"><i class="fas fa-home"></i> Home</a>
						</li>
						<li>
							<span><i class="fas fa-chevron-right"></i> </span>
						</li>
						<li>
							@if(Request::get('ref'))
								<a href="{{ route('terms-of-use') }}?ref={{Request::get('ref')}}">Rules & Agreements</a>
							@else
								<a href="{{ route('terms-of-use') }}">Rules & Agreements</a>
							@endif
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
					<div class="calculator-box"> </div>
				</div>
			</div>
		</div>
	</div>
	<!-- Calculator Area End -->

    <!-- Rules & Agreements Area Start  -->
    <div class="term-container">
        <div class="container">
            <div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="section-heading">
						<h5 class="subtitle"> Terms Of Use</h5>
						<h2 class="title extra-padding">Rules & Agreements </h2>
					</div>
				</div>
			</div>
            <div class="terms">
                <p>Welcome to {{ $setting->site_name }} . By accessing our company website, through a mobile device, mobile application or computer you agree to be bound by these Terms of Use (this “Agreement”). If you wish to create an account and make use of the Service, please read these Terms of Use.</p>
                <div class="rule-info general-rule">
                    <h3>General Rules</h3>
                    <ul>
                        <li>Our company accepts individuals aged 18.</li>
                        <li>The registration procedure is necessary for each our company client.</li>
                        <li>You agree with terms and conditions by being a client of our company.</li>
                    </ul>
                </div>
                <div class="rule-info invest-rule">
                    <h3>Investment Rules</h3>
                    <ul>
                        <li>Every deposit is considered to be a private transaction between our company and its Client.</li>
                        <li>As a private transaction, this program is exempt from the US Securities Act of 1933, the US Securities Exchange Act of 1934 and the US Investment Company Act of 1940 and all other rules, regulations and amendments thereof. We are not FDIC insured. We are not a licensed bank or a security firm.</li>

                        <li>Accrual of interest on the investment is calculated and credited to Client's account daily or at the end of investment term depending on the investment plan you use.</li>
                        <li>Client can use our Profit Calculator for an accurate calculation of his/her profit.</li>
                        <li>Client can open only one account. If you have multiple accounts, our company reserve the rights to frozen or suspend the related accounts.</li>
                        <li>You agree to hold all principals and members harmless of any liability. You are investing at your own risk and you agree that a past performance is not an explicit guarantee for the same future performance.</li>
                        <li>You agree to create only one account in our site.Our company reserves the rights to freeze or suspend multiple accounts.</li>
                    </ul> 
                </div>
                <div class="rule-info Anti-Spam">
                    <h3>Anti-Spam Policy</h3>
                    <p>Spam is commercial e-mail or unsolicited bulk e-mail, including "junk mail", which has not been requested by the recipient. It is intrusive and often irrelevant or offensive, and it wastes valuable resources. Inappropriate newsgroup activities, consisting of excessive posting of the same materials to several newsgroups, are also deemed to be spam.</p>
                    <ul>
                        <li>We don't tolerate SPAM or any type of UCE in our company.</li>
                        <li>We forbid unsolicited e-mails of any kind in connection with the marketing of the services provided by our company.</li>
                        <li>If you didn't receive a letter from our company, please don't forget to check your Spam folder because some email services may mark our email as Spam.</li>
                    </ul>
                </div>
                <div class="rule-info present rules">
                    <h3>Procedure of amending the present rules</h3>
                    <ul>
                        <li>Administration of our company reserves the right to make changes to the current document without the consent of investors.</li>
                        <li>Administration of our company will inform clients about changes by publishing notice on the site of the company.</li>
                        <li>Terms and Conditions changes come into force since the date of publishing information on the site, unless otherwise provided in the text.</li>
                    </ul>
                </div>
                <div class="rule-info customer-services">
                    <h3>Customer Service and Support </h3>
                    <ul>
                        <li>Every client has the right to get any additional information from our support service.</li>
                        <li>Client may contact our support service via our Support Form or another method which is convinient for him.</li>
                        <li>Client agrees to behave politely with our support service and follow the instructions to prevent anyone from potentially negative situation.</li>
                    </ul>
                </div>
            </div> 
        </div>
    </div>
    <!-- Rules & Agreements Area End  -->

    <!-- How It Works Start -->
	@include('frontend.how_it_work')
	<!-- How It Works  End -->

@endsection

@section('extra_div')
    
@endsection

@section('extra_script')
    
@endsection