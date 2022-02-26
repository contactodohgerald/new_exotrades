<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61a3e5ea9099530957f706bd/1flk3k7ma';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<style>
.titles{
    color: #ffff !important;
}
.link-list li a{
    color: #ffff !important;
}
.link-list li a:hover{
    color: #2364d2 !important;
}
</style>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="position: fixed; top: 720px; width: 100%; z-index: 3000;">
    <div class="tradingview-widget-container__widget"></div>
    <div class="tradingview-widget-copyright">
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
            {
                "symbols": [
                {
                    "proName": "FOREXCOM:SPXUSD",
                    "title": "S&P 500"
                },
                {
                    "proName": "FOREXCOM:NSXUSD",
                    "title": "Nasdaq 100"
                },
                {
                    "proName": "FX_IDC:EURUSD",
                    "title": "EUR/USD"
                },
                {
                    "proName": "BITSTAMP:BTCUSD",
                    "title": "BTC/USD"
                },
                {
                    "proName": "BITSTAMP:ETHUSD",
                    "title": "ETH/USD"
                }
            ],
                "showSymbolLogo": true,
                "colorTheme": "dark",
                "isTransparent": false,
                "displayMode": "adaptive",
                "locale": "en"
            }
        </script>
    </div>
</div>
<!-- TradingView Widget END -->
<!-- Footer Area Start -->
<footer class="footer" id="footer">
    <div class="subscribe-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="subscribe-box">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 ">
                                <div class="image-area">
                                    <img src="{{ asset('frontend/assets/images/subimg.png') }}" alt="{{ env('APP_NAME') }}">
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 d-flex">
                                <div class="right-area">
                                    <h5 class="sub-title"> Subscribe to {{ $setting->site_name }} </h5>
                                    <h4 class="title">To Get Exclusive Benefits</h4>
                                    <form action="{{ route('subscribe') }}" method="POST">
                                        @csrf
                                        <input type="email" name="email" placeholder="Your Email Address" required>
                                        <button type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-3">
                <div class="footer-widget info-link-widget">
                    <h4 class="title titles">Company</h4>
                    <ul class="link-list">
                        @if(Request::get('ref'))
                            <li>
                                <a href="./?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Home</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>About</a>
                            </li>
                            <li>
                                <a href="{{ route('affiliate') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Affiliate</a>
                            </li>
                        @else
                            <li>
                                <a href="./"><i class="fas fa-angle-double-right"></i>Home</a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}"><i class="fas fa-angle-double-right"></i>About</a>
                            </li>
                            <li>
                                <a href="{{ route('affiliate') }}"><i class="fas fa-angle-double-right"></i>Affiliate</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="footer-widget info-link-widget">
                    <h4 class="title titles">Help & Support</h4>
                    <ul class="link-list">
                        @if(Request::get('ref'))
                            <li>
                                <a href="{{ route('contact') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i> Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i>Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Register</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('contact') }}"><i class="fas fa-angle-double-right"></i> Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}"><i class="fas fa-angle-double-right"></i>Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}"><i class="fas fa-angle-double-right"></i>Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="footer-widget info-link-widget">
                    <h4 class="title titles">Links</h4>
                    <ul class="link-list">
                        @if(Request::get('ref'))
                            <li>
                                <a href="{{ route('terms-of-use') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Terms Of Use</a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Services</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i> FAQ</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('terms-of-use') }}"><i class="fas fa-angle-double-right"></i>Terms Of Use</a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}"><i class="fas fa-angle-double-right"></i>Services</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}"><i class="fas fa-angle-double-right"></i> FAQ</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3">
                <div class="footer-widget info-link-widget">
                    <h4 class="title titles">Legal Info </h4>
                    <ul class="link-list">
                        @if(Request::get('ref'))
                            <li>
                                <a href="{{ route('plan') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Plans</a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i>Services</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}?ref={{Request::get('ref')}}"><i class="fas fa-angle-double-right"></i> FAQ</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('plan') }}"><i class="fas fa-angle-double-right"></i>Plans</a>
                            </li>
                            <li>
                                <a href="{{ route('services') }}"><i class="fas fa-angle-double-right"></i>Services</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}"><i class="fas fa-angle-double-right"></i> FAQ</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="content">
                            <p class="text-white">Copyright © 2017 - <?php $d=date('Y'); print $d;?>. All Rights Reserved By <a href="./">{{ $setting->site_name }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->