

@extends('frontend.layouts.app')

@section('content')
    <section class="bg-light position-relative" style="margin-top:-2%;">
		
		<div class="main-slider dots-style theme1">
			 <!-- slider-item end -->
			@foreach (\App\Slider::where('published', 1)->get() as $key => $slider)
				<div class="slider-item bg-img" style="background-image:url({{ my_asset($slider->photo) }});">
					<div class="container">
						<div class="row align-items-center slider-height2">
							<div class="col-12">
								<!-- <div class="slider-content">
									<p class="text text-white text-uppercase animated mb-25" data-animation-in="fadeInLeft">
										organics Food</p>
									<h4 class="title text-white animated text-capitalize mb-25" data-animation-in="fadeInRight"
										data-delay-in="1">Dried Persimmon</h4>
									<h2 class="sub-title text-white animated" data-animation-in="fadeInUp" data-delay-in="2">Up
										Sale Up To 40% Off</h2>
									<a href="#"
										class="btn theme--btn1 btn--lg text-uppercase rounded-5 animated mt-45 mt-sm-25"
										data-animation-in="zoomIn" data-delay-in="3">Shop now</a>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			@endforeach
			
			<!-- slider-item end -->
		</div>
		<!-- slick-progress -->
		<div class="slick-progress">
			<span></span>
		</div>
		<!-- slick-progress end-->
	</section>
	
	<!-- main slider end -->


<!-- product tab start -->
<section class="product-tab bg-white pt-50 pb-80">
    <div class="container">
        <div class="product-tab-nav mb-35">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="section-title text-center mb-30">
                        <h2 class="title text-dark text-capitalize">Our products</h2>
                        <p class="text mt-10">Add our products to weekly line up</p>
                    </div>
                </div>
                <!--<div class="col-12">
                    <nav class="product-tab-menu theme1">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Mens Wear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Women Wear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                    role="tab" aria-controls="pills-contact" aria-selected="false">Kids</a>
                            </li>
                        </ul>
                    </nav>
                </div>-->
            </div>
        </div>
		
		<div id="section_best_selling" class="row">

		</div>
        <!-- product-tab-nav end -->
        
    </div>
</section>
<!-- product tab end -->
<!-- common banner  start -->
<div class="common-banner bg-white">
    <div class="container">
        <div class="row">
			@foreach (\App\Banner::where('position', 1)->where('published', 1)->get() as $key => $banner)
				<div class="col-lg-{{ 12/count(\App\Banner::where('position', 1)->where('published', 1)->get()) }} mb-30">
					<div class="banner-thumb">
						<a href="{{ $banner->url }}" target="_blank" class="zoom-in d-block overflow-hidden">
							<img src="{{ my_asset('frontend/images/placeholder-rect.jpg') }}" data-src="{{ my_asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
						</a>
					</div>
				</div>
			@endforeach
        </div>
    </div>
</div>
<!-- common banner  end -->
@endsection 
@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                slickInit();
            });

            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
              var $productSliderInit = $(".product-slider-init");
                  $productSliderInit.slick({
                    autoplay: false,
                    rows: 3,
                    autoplaySpeed: 10000,
                    dots: false,
                    infinite: false,
                    arrows: true,
                    speed: 1000,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    prevArrow: '<button class="slick-prev"><i class="ion-chevron-left"></i></button>',
                    nextArrow: '<button class="slick-next"><i class="ion-chevron-right"></i></button>',
                    responsive: [{
                      breakpoint: 1280,
                      settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                      }
                    }, {
                      breakpoint: 1024,
                      settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: true,
                        autoplay: true
                      }
                    }, {
                      breakpoint: 768,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true
                      }
                    }, {
                      breakpoint: 480,
                      settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: true
                      }
                    } // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                    ]
                  });
            });

            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                slickInit();
            });
            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                slickInit();
            });
            @endif
        });
    </script>
@endsection