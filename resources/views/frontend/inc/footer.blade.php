<footer class="bg-light theme1 position-relative">
    <div class="footer-bottom pt-80 pb-30 xss">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget mx-w-400">
						@php
							$generalsetting = \App\GeneralSetting::first();
						@endphp
                        <p class="text mb-30">{{ $generalsetting->description }}</p>
                        <div class="address-widget mb-30">
                            <div class="media">
                                <span class="address-icon mr-3">
                                    <img src="{{ my_asset('frontend/images/icon/phone.png') }}" alt="phone">
                                </span>
                                <div class="media-body">
                                    <p class="help-text text-uppercase">{{ translate('NEED HELP?') }}</p>
                                    <h4 class="title text-dark"><a href="tel:{{$generalsetting->phone }}">{{ $generalsetting->phone }}</a></h4>
                                </div>
                            </div>
                        </div>

                        <div class="social-network">
                            <ul class="d-flex">
							@if ($generalsetting->facebook != null)
								<li>
									<a href="{{ $generalsetting->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
										<span class="icon-social-facebook"></span>
									</a>
								</li>
							@endif
							@if ($generalsetting->instagram != null)
								<li>
									<a href="{{ $generalsetting->instagram }}" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
										<span class="icon-social-instagram"></span>
									</a>
								</li>
							@endif
							@if ($generalsetting->twitter != null)
								<li>
									<a href="{{ $generalsetting->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
										<span class="icon-social-twitter"></span>
									</a>
								</li>
							@endif
							@if ($generalsetting->youtube != null)
								<li>
									<a href="{{ $generalsetting->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
										<span class="icon-social-youtube"></span>
									</a>
								</li>
							@endif
							@if ($generalsetting->google_plus != null)
								<li>
									<a href="{{ $generalsetting->google_plus }}" class="google-plus" target="_blank" data-toggle="tooltip" data-original-title="Google Plus">
										
										<span class="icon-social-google"></span>
									</a>
								</li>
							@endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">{{ translate('Information') }}</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="{{ route('home.about') }}">{{ translate('About us') }}</a></li>
                            <li><a href="{{ route('home.contact') }}">{{ translate('Contact us') }}</a></li>
                            <li><a href="{{ route('terms') }}">{{ translate('Terms & Conditions') }}</a></li>
                            <li><a href="{{ route('returnpolicy') }}">{{ translate('Return Policy') }}</a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">{{ translate('Custom Links') }}</h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="{{ route('home.privacy_policy') }}">{{ translate('Privacy Policy') }}</a></li>
                            <li><a href="{{ route('home.faq') }}">{{ translate('FAQs') }}</a></li>

                            <!--<li><a href="{{ route('login') }}">{{ translate('Login') }}</a></li>-->
							@if (Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}">
                                        {{ translate('Logout') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('user.login') }}">
                                        {{ translate('Login') }}
                                    </a>
                                </li>
                            @endif

                            <li><a href="{{ route('profile') }}">{{ translate('My account') }}</a></li>
							@foreach (\App\Link::all() as $key => $link)
                                <li>
                                    <a href="{{ $link->url }}" title="">
                                        {{ $link->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase">{{ translate('Newsletter') }}</h2>
                            </div>
                        </div>
                        <p class="text mb-20">You may unsubscribe at any moment. For that purpose, please find our
                            contact info in the legal notice.</p>
                        <div class="nletter-form mb-35">
							<form class="form-inline position-relative" method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
								<input type="email" class="form-control" placeholder="{{ translate('Your Email Address') }}" name="email" required>
                                 <button type="submit" class="btn nletter-btn text-capitalize">
                                    {{ translate('Sign_up') }}
                                </button>
                               
                            </form>
                        </div>

                        <div class="store d-flex">
                            <a href="https://www.apple.com/" class="d-inline-block mr-3"><img
                                    src="{{ my_asset('frontend/images/icon/apple.png') }}" alt="apple icon"> </a>
                            <a href="https://play.google.com/store/" class="d-inline-block"><img
                                    src="{{ my_asset('frontend/images/icon/play.png') }}" alt="apple icon"> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <!-- coppy-right start -->
    <div class="coppy-right pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-left">
                        <p class="mb-3 mb-md-0">Copyright &copy; {{ date('Y') }} <a href="#">{{ $generalsetting->site_name }}</a>. All
                            Rights Reserved</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="text-left">
                        <img src="{{ my_asset('frontend/images/icon/pay.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>