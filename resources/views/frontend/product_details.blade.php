<style>
.disableSizeClass{
  height:35px !important;  
  background:linear-gradient(40deg,#ffffff 45%,#aaa 46%,#ffffff 49%);
}


ul.specification-list-frontend {
    display: flex;
    flex-wrap: wrap;
}

ul.specification-list-frontend>li {
    width: 25%;
    margin-top: 10px;
    flex-basis: 25%;
    font-size: 13px;
}
     .myclass
    {
        -webkit-box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);margin-bottom: 20px;
    }
	 @media screen and (min-width: 768px) {
			   .mywidth
			{
				width:530px !important;
				float:right !important;
			}
			.thumbwidth
			{
				float:left;display:grid;padding-right:30px;
			}
      }	  	  .sizes-table {		border: 0;		background-color: transparent;	}	table.sizes-table td {		background-color: transparent;		/* border: 0; */	}	table.sizes-table tr {		border: 0;		background-color: transparent;	}	table.sizes-table thead {		background-color: transparent !important;		border: 0;	}	table.table-options {		width: 100%;	}	table.sizes-table>tbody>tr>td {		padding: 0;		border: 0;	}	table.sizes-table>tbody>tr>td:first-child {		border-left: 1px solid #dee2e6;	}	table.table-options td {		border-left: 0;	}.size-controll {    text-align: right;    margin-bottom: 15px;}
	 @media screen and (min-width: 768px) {


    .mystyle
    {
        width : 19.666667% !important;
    }
    
}
</style>

@extends('frontend.layouts.app')

@section('meta_title'){{ $detailedProduct->meta_title }}@stop

@section('meta_description'){{ $detailedProduct->meta_description }}@stop

@section('meta_keywords'){{ $detailedProduct->meta_keyword }}@stop

@section('meta')
    <script src="https://cannadex.world/js/setup.js"></script>
    <script src="https://cannadex.world/js/vendor/jquery.js"></script>
    <!-- xzoom plugin here -->
  <script type="text/javascript" src="https://cannadex.world/js/xzoom.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cannadex.world/css/xzoom.css" media="all" /> 
      <script src="https://cannadex.world/js/setup.js"></script>

    <!-- hammer plugin here -->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ my_asset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ my_asset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ my_asset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />
    <meta property="product:price:currency" content="{{ \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}"><style>.product-thumb>img {    width: 100%;}</style>
@endsection

@section('content')
    <!-- SHOP GRID WRAPPER -->		<!-- breadcrumb-section start -->	<nav class="breadcrumb-section theme3 bg-lighten2 pt-1 pb-1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-1 align-items-center justify-content-left">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item">
                        @foreach (\App\Category::all()->take(11) as $key => $category) @if($category->id == json_decode($detailedProduct->category_id))
                        <a href="{{ route('products.category', $category->slug) }}">{{ __($category->name) }}</a> @endif @endforeach
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __($detailedProduct->name) }}</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product-single start -->
<section class="product-single theme3 pt-60">
    <div class="container">
        <div class="row">
            @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="position-relative"><span class="badge badge-danger top-right">New</span></div>
                  <section id="default" class="padding-top0">
                <div class="row">
                  <div class="large-5 column">
                    <div class="xzoom-container">
                       @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                       @if($key==0)
                            <img class="xzoom mywidth" src="{{ my_asset($photo) }}" xoriginal="{{ my_asset($photo) }}" style="width:530px;float:right !important;" />
                        @endif
                       @endforeach
                      <div class="xzoom-thumbs thumbwidth">
                        @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                        <a href="{{ my_asset($photo) }}"><img class="xzoom-gallery" width="80" src="{{ my_asset($photo) }}""  xpreview="{{ my_asset($photo) }}"></a>
                        @endforeach
                      </div>

                    </div>        
                  </div>
                  <div class="large-7 column"></div>
                </div>
                </section>
               <!--  <div class="product-sync-init mb-0" style="max-height: 708px !important;">
                    @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                    <div class="single-product" >
                        <div class="product-thumb">
                            <img
                                src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                class="xzoom img-fluid lazyload"
                                src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                data-src="{{ my_asset($photo) }}"
                                xoriginal="{{ my_asset($photo) }}"
                            />
                        </div>
                    </div>
                    @endforeach
                </div> -->
             <!--    <div class="product-sync-nav single-product">
                    @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                    <div class="single-product" style="height: 86px;">
                        <div class="product-thumb" style="height: 86px !important;">
                            <a href="javascript:void(0)">
                                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ my_asset($photo) }}" @if($key == 0)
                                xpreview="{{ my_asset($photo) }}" @endif>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div> -->
            </div>
            <div class="col-lg-6 mt-5 mt-md-0">
                <div class="single-product-info">
                    <div class="single-product-head">
                        <h2 class="title mb-20" style="font-weight:bolder;color:black;">{{ __($detailedProduct->brand->name) }}</h2>
                        <h3 class="title mb-20" style="font-size:16px;">{{ __($detailedProduct->name) }}</h3>
                        <div class="star-content mb-20">
                            @php $total = 0; $total += $detailedProduct->reviews->count(); @endphp <span class="star-rating"> {{ renderStarRating($detailedProduct->rating) }} </span>
                        <!--    <a href="#" id="write-comment">
                                <span class="ml-2"><i class="far fa-comment-dots"></i></span> {{ translate('Read reviews')}} <span>({{ $total }})</span>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter">
                                <span class="edite"><i class="far fa-edit"></i></span> Write a review
                            </a> -->
                        </div>
                    </div>
                    <div class="product-body mb-40">
                        <div class="d-flex align-items-center mb-30">
                            <h6 class="product-price mr-20">
                                @if(home_base_price($detailedProduct->id) != home_discounted_price($detailedProduct->id)) <del class="del">{{ home_base_price($detailedProduct->id) }}</del> @endif
                                <span class="onsale">{{ home_discounted_price($detailedProduct->id) }}</span>
                            </h6>
                            
                            @if(home_base_price($detailedProduct->id) != home_discounted_price($detailedProduct->id)) <span class="badge position-static bg-dark rounded-0" style="z-index:-111;">Save {{$detailedProduct->discount}}%</span> @endif
                     
                        </div>
                       
                    </div>
                    <div class="product-footer">
                        @php $qty = 0; if($detailedProduct->variant_product){ foreach ($detailedProduct->stocks as $key => $stock) { $qty += $stock->qty; } } else{ $qty = $detailedProduct->current_stock; } @endphp
                       
                       
						<form id="option-choice-form">
							@csrf
							<input type="hidden" name="id" value="{{ $detailedProduct->id }}">
                            
							@if ($detailedProduct->choice_options != null)
								@foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                                @php
                                $color_name = "";
                                $colors = json_decode($detailedProduct->colors);
                                foreach($colors as $colorCode){
                                    $color_name = \App\Color::where('code',$colorCode)->first()->name;
                                }
                                $variant_sizes = array();
                                if($detailedProduct->variant_product){
                                    foreach($detailedProduct->stocks as $key => $stock) {
                                        if($stock->qty > 0){
                                            $variant_sizes[$stock->variant] = $stock->variant;
                                        }
                                    }
                                }
                                @endphp
								<div class="row">
									<div class="col-2">
										<div class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}:</div>
									</div>
									<div class="col-10">
										<ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
											@foreach ($choice->values as $key => $value)
											@php $variant_color_name = $color_name.'-'.$value; $disabledAttr = ''; $disableSizeClass= ""; @endphp
											@if($detailedProduct->variant_product && !in_array($variant_color_name,$variant_sizes))
											@php    $disabledAttr = ' disabled=disabled'; $disableSizeClass = "disableSizeClass"; @endphp
											@endif
												<li class="{{ $disableSizeClass }}">
													<input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 20) checked @endif {{ $disabledAttr }}>
													<label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
												</li>
											@endforeach
										</ul>
									</div>
								</div>

								@endforeach
							@endif

							@if (count(json_decode($detailedProduct->colors)) > 0)
								<div class="row">
									<div class="col-2">
										<div class="product-description-label mt-2">{{ translate('Color')}}:</div>
									</div>
									<div class="col-10">
										<ul class="list-inline checkbox-color mb-1">
											@foreach (json_decode($detailedProduct->colors) as $key => $color)
												<li>
													<input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
													<label style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
												</li>
											@endforeach
										</ul>
									</div>
								</div>

								<hr>
							@endif

							<div class="row d-none">
                                <div class="col-2"><div class="product-description-label mt-2">{{ translate('Quantity')}}:</div></div>
                                <div class="col-10">
                                    <div class="product-quantity d-flex align-items-center">
                                        <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                            <span class="input-group-btn">
                                                <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled"><i class="la la-minus"></i></button>
                                            </span>
                                            <input type="text" name="quantity" class="form-control input-number h-auto text-center" placeholder="1" value="1" min="1" max="10" />
                                            <span class="input-group-btn">
                                                <button class="btn btn-number" type="button" data-type="plus" data-field="quantity"><i class="la la-plus"></i></button>
                                            </span>
                                        </div>
                                        <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})</div>
                                    </div>
                                </div>
                            </div>

							
							<div class="row pb-3 d-none" id="chosen_price_div">
                                <div class="col-2"><div class="product-description-label">{{ translate('Total Price')}}:</div></div>
                                <div class="col-10">
                                    <div class="product-price"><strong id="chosen_price"></strong></div>
                                </div>
                            </div>

						</form>
						  <div class="product-count style d-flex flex-column flex-sm-row my-4">
                            <div class="count d-flex">
                                <input type="text" name="quantity" class="input-number text-center" placeholder="1" value="1" min="1" max="10" />
                                <div class="button-group">
                                    <button class="count-btn btn-number" type="button" data-type="plus" data-field="quantity"><i class="fas fa-chevron-up"></i></button>
                                    <button class="count-btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled"><i class="fas fa-chevron-down"></i></button>
                                </div>
                            </div>
                            <div style="display:flex;width:100%;">
                            <div style="width: 100%;">
                                <!-- Add to cart button -->
                                @if ($detailedProduct->digital == 1)
                                <button type="button" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5" onclick="addToCart()" style="width: 100%;">
                                    <span class="mr-2"><i class="ion-android-add"></i></span> {{ translate('Add to cart')}}
                                </button>
                                
                                @elseif($qty > 0)
                                <button type="button" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5" onclick="addToCart()" style="width: 100%;">
                                    <span class="mr-2"><i class="ion-android-add"></i></span> {{ translate('Add to cart')}}
                                </button>
                                @else <button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" style="width: 100%;" disabled><i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}</button> @endif
                            </div>
                            <div style="width: 100%;margin-left:2%;">
                            <a href="javascript:viod()" onclick="addToWishList({{ $detailedProduct->id }})" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5"><i class="icon-heart"></i> Add to wishlist</a>    
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-inline" action="{{ route('checkout.check_pincode_delhivery') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group flex-grow-1">
                                        <input type="text" class="form-control w-100" value="@if(Session::has('postal_code')) {{ Session::get('postal_code') }} @endif" name="postal_code" placeholder="{{translate('Enter a PIN code')}}" required style="width: 77% !important;display: inline;">
                                        <button type="submit" class="btn theme-btn--dark1 btn-lg rounded-5" style="height:37px;">{{translate('Check')}}</button>

                                    </div>
                                </form>
                            </div>
                        </div>    
                        <p>Please enter PIN code to check delivery time & Pay on Delivery Availability</p>
                        <p style="font-weight: bold;font-size: 15px;line-height: 32px;color: black;">
                            * Free delivery on orders above 599 INR<br>
                            * Cash on delivery might be available<br>
                            * Easy 7 days returns and exchanges
                        </p>
                        <br>
                        <br>
                    <!--    <div class="pro-social-links mt-10">
                            <ul class="d-flex align-items-center">
                                <li class="share">Share</li>
                               <div id="share"></div>
                            </ul>
                        </div> -->
                    </div>
                   <div class="product-tab-nav">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <nav class="product-tab-menu single-product">
                                    <ul class="nav nav-pills justify-content-left" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                                role="tab" aria-controls="pills-home" aria-selected="true" style="font-size: 16px;">{{ translate('Description')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-size-tab" data-toggle="pill" href="#pills-size" role="tab" aria-controls="pills-size" aria-selected="true" style="font-size: 16px;">{{ translate('Size')}}</a>
                                        </li>
                                        
                                        @if($detailedProduct->video_link != null)
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video"
                                                    role="tab" aria-controls="pills-video" aria-selected="false" style="font-size: 20px;">{{ translate('Video')}}</a>
                                            </li>
                                        @endif
                                        @if($detailedProduct->pdf != null)
                                            <li class="nav-item">
                                                <a href="#pills-pdf" data-toggle="tab" class="nav-link" style="font-size: 16px;">{{ translate('Size')}}</a>
                                            </li>
                                        @endif
                                       <!-- <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                                role="tab" aria-controls="pills-profile" aria-selected="false" style="font-size: 16px;">{{ translate('Product Details')}}</a>
                                        </li>-->
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                                role="tab" aria-controls="pills-contact" aria-selected="false" style="font-size: 16px;">{{ translate('Reviews')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="pills-tabContent">
                    <!-- first tab-pane -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="single-product-desc">
                            <?php echo $detailedProduct->description; ?>
                            @if(!empty($detailedProduct->designdetails))
                            <div class="product-group mb-2">
                                <p class="mb-1"><b style="color:black;font-size:15px;">{{translate('Design Highlights')}}</b></p>
                                <p><?php echo $detailedProduct->designdetails; ?></p>
                            </div>
                            @endif
                            @if(!empty($detailedProduct->sizefits))
                            <div class="product-group mb-2">
                                <p class="mb-1"><b style="color:black;font-size:15px;">{{translate('Fits')}}</b></p>
                                <p><?php echo $detailedProduct->sizefits; ?></p>
                            </div>
                            @endif
                            @if(!empty($detailedProduct->fabriccare))
                            <div class="product-group mb-2">
                                <p class="mb-1"><b style="color:black;font-size:15px;">{{translate('Fabric & Care')}}</b></p>
                                <p><?php echo $detailedProduct->fabriccare; ?></p>
                            </div>
                            @endif
                            <div class="product-group">
                                <p class="mb-1"><b style="color:black;font-size:15px;">{{translate('Product Specification')}}</b></p>
                                <ul class="specification-list-frontend">
                                    @if(!empty($detailedProduct->specifproducttype))
                                    <li>
                                        <p><b style="color:black;">{{translate('Product Type')}}</b></p>
                                        <p><?php echo $detailedProduct->specifproducttype; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->speciffabrictype))
                                    <li>
                                        <p><b style="color:black;">{{translate('Fabric type')}}</b></p>
                                        <p><?php echo $detailedProduct->speciffabrictype; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifweave))
                                    <li>
                                        <p><b style="color:black;">{{translate('Weave')}}</b></p>
                                        <p><?php echo $detailedProduct->specifweave; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifborder))
                                    <li>
                                        <p><b style="color:black;">{{translate('Border')}}</b></p>
                                        <p><?php echo $detailedProduct->specifborder; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifoccasion))
                                    <li>
                                        <p><b style="color:black;">{{translate('Occasion')}}</b></p>
                                        <p><?php echo $detailedProduct->specifoccasion; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifwash))
                                    <li>
                                        <p><b style="color:black;">{{translate('Wash')}}</b></p>
                                        <p><?php echo $detailedProduct->specifwash; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->speciffabric))
                                    <li>
                                        <p><b style="color:black;">{{translate('Fabric')}}</b></p>
                                        <p><?php echo $detailedProduct->speciffabric; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifblousefabric))
                                    <li>
                                        <p><b style="color:black;">{{translate('Blouse Fabric')}}</b></p>
                                        <p><?php echo $detailedProduct->specifblousefabric; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifdupattafabric))
                                    <li>
                                        <p><b style="color:black;">{{translate('Dupatta fabric')}}</b></p>
                                        <p><?php echo $detailedProduct->specifdupattafabric; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifbottomfabric))
                                    <li>
                                        <p><b style="color:black;">{{translate('Bottom fabric')}}</b></p>
                                        <p><?php echo $detailedProduct->specifbottomfabric; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifsleevelength))
                                    <li>
                                        <p><b style="color:black;">{{translate('Sleeve length')}}</b></p>
                                        <p><?php echo $detailedProduct->specifsleevelength; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifneck))
                                    <li>
                                        <p><b style="color:black;">{{translate('Neck')}}</b></p>
                                        <p><?php echo $detailedProduct->specifneck; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifbottomshape))
                                    <li>
                                        <p><b style="color:black;">{{translate('Bottom Shape')}}</b></p>
                                        <p><?php echo $detailedProduct->specifbottomshape; ?></p>
                                    </li>
                                    @endif
                                    @if(!empty($detailedProduct->specifstylecode))
                                    <li>
                                        <p><b style="color:black;">{{translate('Style Code')}}</b></p>
                                        <p><?php echo $detailedProduct->specifstylecode; ?></p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-size" role="tabpanel" aria-labelledby="pills-size-tab">
                        <div class="single-product-desc">
                            @php
                            $size_Array = json_decode($detailedProduct->sizes);
                            $SizeHeading = json_decode($detailedProduct->size_heading);
                            $size_name = array();
                            $values = array();
                            //print_r($SizeHeading);
                            @endphp
                            
                            @if(!$size_Array == null)
                            @foreach($size_Array as $key => $option)
                            @php
                            $size_name[] = \App\Size::where('id', $option->size_id)->pluck('name')->toArray();
                            $values[] = $option->values;
                            //$SizeHeading = \App\Size::where('id', $option->size_id)->pluck('name')->toArray();
                            @endphp
                            @endforeach
                            @endif
                            
                            <div class="size-controll">
                                <button type="button" class="convert-inch-btn btn btn-success" onclick="convertInch()">Inch</button>
                                <button type="button" class="convert-cm-btn btn btn-default" onclick="convertCm()">CM</button>
                            </div>
                            <table class="table sizes-table table-inch">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        @if(!empty($size_name))
                                        @foreach($size_name as $name)
                                        <th>
                                        {{$name[0]}} (Inch)
                                        </th>
                                        @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table-options" cellspacing="0" border="0" bgcolor="transparent">
                                                @foreach($SizeHeading as $Skey =>$option)
                                                    <tr>
                                                    <td><strong>{{$option}}</strong></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        @if(!empty($values))
                                        @foreach($values as $option)
                                        <td>
                                            <table class="table-options dynamic-records" cellspacing="0" border="0" bgcolor="transparent" data="inch">
                                                @if(!$option == null)
                                                @foreach($option as $key=>$opt)
                                                @if(!empty($opt))
                                                <tr>
                                                    <td>
                                                        {{$opt}}
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endif
                                            </table>
                                        </td>
                                        @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="table sizes-table table-cm" style="display:none">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        @if(!empty($size_name))
                                        @foreach($size_name as $name)
                                        <th>
                                        {{$name[0]}} (Cm)
                                        </th>
                                        @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table-options" cellspacing="0" border="0" bgcolor="transparent">
                                                 @foreach($SizeHeading as $Skey =>$option)
                                                    <tr>
                                                    <td><strong>{{$option}}</strong></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        @if(!empty($values))
                                        @foreach($values as $option)
                                        <td>
                                            <table class="table-options dynamic-records" cellspacing="0" border="0" bgcolor="transparent" data="inch">
                                                @if(!$option == null)
                                                @foreach($option as $key=>$opt)
                                                @if(!empty($opt))
                                                <tr>
                                                    <td>
                                                        {{round($opt*2.54, 0)}}
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                @endif
                                            </table>
                                        </td>
                                        @endforeach
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            
                            
                        </div>
                    </div>
                    <!-- second tab-pane -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="single-product-desc">
                            <div class="studio-thumb">
                                <a href="#"><img class="mb-30" src="assets/img/stodio.jpg" alt="studio-thumb"></a>
                                <h6 class="mb-2">Reference <small>demo_1</small> </h6>
                                <h6>In stock <small>300 Items</small> </h6>
                                <h3>Data sheet</h3>
                            </div>
                            <div class="product-features">
                                <ul>
                                    <li><span>Compositions</span></li>
                                    <li><span>Cotton</span></li>
                                    <li><span>Paper Type</span></li>
                                    <li><span>Doted</span></li>
                                    <li><span>Color</span></li>
                                    <li><span>Black</span></li>
                                    <li><span>Size</span></li>
                                    <li><span>L</span></li>
                                    <li><span>Frame Size</span></li>
                                    <li><span>40x60cm</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-video" role="tabpanel"
                        aria-labelledby="pills-video-tab">
                        <div class="fluid-paragraph py-2">
                            <div class="embed-responsive embed-responsive-16by9 mb-5">
                                @if ($detailedProduct->video_provider == 'youtube' && $detailedProduct->video_link != null)
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'dailymotion' && $detailedProduct->video_link != null)
                                    <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                @elseif ($detailedProduct->video_provider == 'vimeo' && $detailedProduct->video_link != null)
                                    <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-pdf" role="tabpanel"
                        aria-labelledby="pills-pdf-tab">
                        <div class="py-2 px-4">
                            <div class="row">
                                <div class="col-md-12">
                        	        <embed src="{{ my_asset($detailedProduct->pdf) }}" style="width: 100%;height: 300px;" />
                                    <a href="{{ my_asset($detailedProduct->pdf) }}">{{  translate('Download') }}</a>
                                </div>
                            </div>
                            <span class="space-md-md"></span>
                        </div>
                    </div>
                    <!-- third tab-pane -->
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="single-product-desc">
                            @foreach ($detailedProduct->reviews as $key => $review)
                                <div class="block block-comment">
                                    <div class="block-body">
                                        <div class="block-body-inner">
                                            <div class="row no-gutters">
                                                <div class="col">
                                                    <p class="heading heading-6">
                                                        <a href="javascript:;">{{ $review->user->name }}</a>
                                                        <span class="comment-date">
                                                            {{ date('d-m-Y', strtotime($review->created_at)) }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <div class="rating text-right clearfix d-block">
                                                        <span class="star-rating star-rating-sm float-right">
                                                            @for ($i=0; $i < $review->rating; $i++)
                                                                <i class="fa fa-star active"></i>
                                                            @endfor
                                                            @for ($i=0; $i < 5-$review->rating; $i++)
                                                                <i class="fa fa-star"></i>
                                                            @endfor
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="comment-text">
                                                {{ $review->comment }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           @if(count($detailedProduct->reviews) <= 0)
                            <div class="text-center">
                                {{  translate('There have been no reviews for this product yet.') }}
                            </div>
                        @endif

                        @if(Auth::check())
                            @php
                                $commentable = false;
                            @endphp
                            @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id &&  \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                    @php
                                        $commentable = true;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($commentable)
                                <div class="leave-review">
                                    <div class="section-title section-title--style-1">
                                        <h3 class="section-title-inner heading-6 strong-600 text-uppercase">
                                            {{ translate('Write a review')}}
                                        </h3>
                                    </div>
                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                                    <input type="radio" id="star5" name="rating" value="5" required/>
                                                    <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" required/>
                                                    <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" required/>
                                                    <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" required/>
                                                    <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" required/>
                                                    <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-styled btn-base-1 btn-circle mt-4">
                                                {{ translate('Send review')}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="addto-whish-list">
                            <!--<a href="javascript:viod()" onclick="addToWishList({{ $detailedProduct->id }})"><i class="icon-heart"></i> Add to wishlist</a>-->
                         <!--   <a href="javascript:viod()" onclick="addToCompare({{ $detailedProduct->id }})"><i class="icon-shuffle"></i> Add to compare</a> -->
                        </div>
                        <br>
                        <br>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- product-single end -->

<!-- product tab start -->
<!-- new arrival section start -->
<!-- new arrival section start -->
<section class="theme3 bg-white pb-80">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-30">
                    <h2 class="title text-dark text-capitalize">SIMILAR PRODUCTS</h2>

                </div>
            </div>
            <div class="col-12">
              <div class="tab-content" id="pills-tabContent">
                    <!-- first tab-pane -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="row grid-view theme1">
                          @foreach (filter_products(\App\Product::where('subsubcategory_id', $detailedProduct->subsubcategory_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                            <div class="col-sm-6 col-lg-4 col-xl-3 mb-30 mystyle">
                                <div class="card product-card">
                                    <div class="card-body">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="{{ route('product', $related_product->slug) }}">
                                                <img class="first-img" src="{{ my_asset($related_product->thumbnail_img) }}"  data-src="{{ my_asset($related_product->thumbnail_img) }}" alt="thumbnail">
                                            </a>
                                           
                                        </div>
                                      
                                        <div class="product-desc py-0">
                                        
                                       <h3 class="title" style="font-weight:bolder;"><a href="{{ route('product', $related_product->slug) }}">{{  __($related_product->name) }}</a></h3>
                                            <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="product-price">
                                             @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                    <del class="old-product-price strong-400" style="color:lightgrey;">{{ home_base_price($related_product->id) }}</del><span style="font-size: 11px;margin-left: 6%;color: red;">{{$related_product->discount}}% Off</span>
                                            @endif
                                            {{ home_discounted_base_price($related_product->id) }}
                                            </h6>
                                                <button class="pro-btn" data-toggle="modal"
                                                    data-target="#add-to-cart"><i class="icon-basket"></i></button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- product-list End -->
                            </div>
                            @endforeach
                        </div>
                    </div>
              </div>      
</section>
<!-- new arrival section end -->

<!-- product tab end -->



	<!--				
    <section class="product-details-area gry-bg">
        <div class="container">

            <div class="bg-white">
                <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-6">
                        <div class="product-gal sticky-top d-flex flex-row-reverse">
                            @if(is_array(json_decode($detailedProduct->photos)) && count(json_decode($detailedProduct->photos)) > 0)
                                <div class="product-gal-img">
                                    <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset(json_decode($detailedProduct->photos)[0]) }}" xoriginal="{{ my_asset(json_decode($detailedProduct->photos)[0]) }}" />
                                </div>
                                <div class="product-gal-thumb">
                                    <div class="xzoom-thumbs">
                                        @foreach (json_decode($detailedProduct->photos) as $key => $photo)
                                            <a href="{{ my_asset($photo) }}">
                                                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ my_asset($photo) }}"  @if($key == 0) xpreview="{{ my_asset($photo) }}" @endif>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="product-description-wrapper">
                            <h1 class="product-title mb-2">
                                {{  __($detailedProduct->name) }}
                            </h1>

                            <div class="row align-items-center my-1">
                                <div class="col-6">
                                    <div class="rating">
                                        @php
                                            $total = 0;
                                            $total += $detailedProduct->reviews->count();
                                        @endphp
                                        <span class="star-rating">
                                            {{ renderStarRating($detailedProduct->rating) }}
                                        </span>
                                        <span class="rating-count ml-1">({{ $total }} {{ translate('reviews')}})</span>
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <ul class="inline-links inline-links--style-1">
                                        @php
                                            $qty = 0;
                                            if($detailedProduct->variant_product){
                                                foreach ($detailedProduct->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $detailedProduct->current_stock;
                                            }
                                        @endphp
                                        @if ($qty > 0)
                                            <li>
                                                <span class="badge badge-md badge-pill bg-green">{{ translate('In stock')}}</span>
                                            </li>
                                        @else
                                            <li>
                                                <span class="badge badge-md badge-pill bg-red">{{ translate('Out of stock')}}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            <hr>

                            <div class="row align-items-center">
                                <div class="sold-by col-auto">
                                    <small class="mr-2">{{ translate('Sold by')}}: </small><br>
                                    @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                        <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}">{{ $detailedProduct->user->shop->name }}</a>
                                    @else
                                        {{  translate('Inhouse product') }}
                                    @endif
                                </div>
                                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                    <div class="col-auto">
                                        <button class="btn btn-secondary" onclick="show_chat_modal()">{{ translate('Message Seller')}}</button>
                                    </div>
                                @endif

                                @if ($detailedProduct->brand != null)
                                    <div class="col-auto">
                                        <img src="{{ my_asset($detailedProduct->brand->logo) }}" alt="{{ $detailedProduct->brand->name }}" height="30">
                                    </div>
                                @endif
                            </div>

                            <hr>

                            @if(home_price($detailedProduct->id) != home_discounted_price($detailedProduct->id))

                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ translate('Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price-old">
                                            <del>
                                                {{ home_price($detailedProduct->id) }}
                                                @if($detailedProduct->unit != null)
                                                    <span>/{{ $detailedProduct->unit }}</span>
                                                @endif
                                            </del>
                                        </div>
                                    </div>
                                </div>

                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label mt-1">{{ translate('Discount Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong>
                                                {{ home_discounted_price($detailedProduct->id) }}
                                            </strong>
                                            @if($detailedProduct->unit != null)
                                                <span class="piece">/{{ $detailedProduct->unit }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ translate('Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong>
                                                {{ home_discounted_price($detailedProduct->id) }}
                                            </strong>
                                            <span class="piece">/{{ $detailedProduct->unit }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated && $detailedProduct->earn_point > 0)
                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label">{{  translate('Club Point') }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="d-inline-block club-point bg-soft-base-1 border-light-base-1 border">
                                            <span class="strong-700">{{ $detailedProduct->earn_point }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

                                @if ($detailedProduct->choice_options != null)
                                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <div class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}:</div>
                                        </div>
                                        <div class="col-10">
                                            <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                                @foreach ($choice->values as $key => $value)
                                                    <li>
                                                        <input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key == 0) checked @endif>
                                                        <label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    @endforeach
                                @endif

                                @if (count(json_decode($detailedProduct->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <div class="product-description-label mt-2">{{ translate('Color')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <ul class="list-inline checkbox-color mb-1">
                                                @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $detailedProduct->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};" for="{{ $detailedProduct->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <hr>
                                @endif

                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2">{{ translate('Quantity')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                                        <i class="la la-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class="form-control h-auto input-number text-center" placeholder="1" value="1" min="1" max="10">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="avialable-amount">(<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ translate('Total Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong id="chosen_price">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    @if ($qty > 0)
                                        <button type="button" class="btn btn-styled btn-base-1 btn-icon-left strong-700 hov-bounce hov-shaddow buy-now" onclick="buyNow()">
                                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now')}}
                                        </button>
                                        <button type="button" class="btn btn-styled btn-alt-base-1 c-white btn-icon-left strong-700 hov-bounce hov-shaddow ml-2 add-to-cart" onclick="addToCart()">
                                            <i class="la la-shopping-cart"></i>
                                            <span class="d-none d-md-inline-block"> {{ translate('Add to cart')}}</span>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" disabled>
                                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}}
                                        </button>
                                    @endif
                                </div>
                            </div>



                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    <button type="button" class="btn pl-0 btn-link strong-700" onclick="addToWishList({{ $detailedProduct->id }})">
                                        {{ translate('Add to wishlist')}}
                                    </button>
                                    <button type="button" class="btn btn-link btn-icon-left strong-700" onclick="addToCompare({{ $detailedProduct->id }})">
                                        {{ translate('Add to compare')}}
                                    </button>
                                    @if(Auth::check() && \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && (\App\AffiliateOption::where('type', 'product_sharing')->first()->status || \App\AffiliateOption::where('type', 'category_wise_affiliate')->first()->status) && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                        @php
                                            if(Auth::check()){
                                                if(Auth::user()->referral_code == null){
                                                    Auth::user()->referral_code = substr(Auth::user()->id.Str::random(10), 0, 10);
                                                    Auth::user()->save();
                                                }
                                                $referral_code = Auth::user()->referral_code;
                                                $referral_code_url = URL::to('/product').'/'.$detailedProduct->slug."?product_referral_code=$referral_code";
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <textarea id="referral_code_url" class="form-control" readonly type="text" style="display:none">{{$referral_code_url}}</textarea>
                                        </div>
                                        <button type=button id="ref-cpurl-btn" class="btn btn-sm btn-secondary" data-attrcpy="{{ translate('Copied')}}" onclick="CopyToClipboard('referral_code_url')">{{ translate('Copy the Promote Link')}}</button>
                                    @endif
                                </div>
                            </div>

                            <hr class="mt-2">

                            @php
                                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                $refund_sticker = \App\BusinessSetting::where('type', 'refund_sticker')->first();
                            @endphp
                            @if ($refund_request_addon != null && $refund_request_addon->activated == 1 && $detailedProduct->refundable)
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ translate('Refund')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <a href="{{ route('returnpolicy') }}" target="_blank"> @if ($refund_sticker != null && $refund_sticker->value != null) <img src="{{ my_asset($refund_sticker->value) }}" height="36"> @else <img src="{{ my_asset('frontend/images/refund-sticker.jpg') }}" height="36"> @endif</a>
                                        <a href="{{ route('returnpolicy') }}" class="ml-2" target="_blank">View Policy</a>
                                    </div>
                                </div>
                            @endif
                            @if ($detailedProduct->added_by == 'seller')
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label">{{ translate('Seller Guarantees')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        @if ($detailedProduct->user->seller->verification_status == 1)
                                            {{ translate('Verified seller')}}
                                        @else
                                            {{ translate('Non verified seller')}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="row no-gutters mt-4">
                                <div class="col-2">
                                    <div class="product-description-label mt-2">{{ translate('Share')}}:</div>
                                </div>
                                <div class="col-10">
                                    <div id="share"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gry-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">
                    <div class="seller-info-box mb-3">
                        <div class="sold-by position-relative">
                            @if ($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && $detailedProduct->user->seller->verification_status == 1)
                                <div class="position-absolute medal-badge">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">
                                        <polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>
                                        <circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>
                                        <circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>
                                        <polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3
                                        60,116.6 124.1,116.6 "/>
                                    </svg>
                                </div>
                            @endif
                            <div class="title">{{ translate('Sold By')}}</div>
                            @if($detailedProduct->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="name d-block">{{ $detailedProduct->user->shop->name }}
                                @if ($detailedProduct->user->seller->verification_status == 1)
                                    <span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>
                                @else
                                    <span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>
                                @endif
                                </a>
                                <div class="location">{{ $detailedProduct->user->shop->address }}</div>
                            @else
                                {{ env('APP_NAME') }}
                            @endif
                            @php
                                $total = 0;
                                $rating = 0;
                                foreach ($detailedProduct->user->products as $key => $seller_product) {
                                    $total += $seller_product->reviews->count();
                                    $rating += $seller_product->reviews->sum('rating');
                                }
                            @endphp

                            <div class="rating text-center d-block">
                                <span class="star-rating star-rating-sm d-block">
                                    @if ($total > 0)
                                        {{ renderStarRating($rating/$total) }}
                                    @else
                                        {{ renderStarRating(0) }}
                                    @endif
                                </span>
                                <span class="rating-count d-block ml-0">({{ $total }} {{ translate('customer reviews')}})</span>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            @if($detailedProduct->added_by == 'seller')
                                <div class="col">
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="d-block store-btn">{{ translate('Visit Store')}}</a>
                                </div>
                                <div class="col">
                                    <ul class="social-media social-media--style-1-v4 text-center">
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->google }}" class="google" target="_blank" data-toggle="tooltip" data-original-title="Google">
                                                <i class="fa fa-google"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="seller-top-products-box bg-white sidebar-box mb-3">
                        <div class="box-title">
                            {{ translate('Top Selling Products From This Seller')}}
                        </div>
                        <div class="box-content">
                            @foreach (filter_products(\App\Product::where('user_id', $detailedProduct->user_id)->orderBy('num_of_sale', 'desc'))->limit(6)->get() as $key => $top_product)
                            <div class="mb-3 product-box-3">
                                <div class="clearfix">
                                    <div class="product-image float-left">
                                        <a href="{{ route('product', $top_product->slug) }}">
                                            <img class="img-fit lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($top_product->thumbnail_img) }}" alt="{{  translate($top_product->name) }}">
                                        </a>
                                    </div>
                                    <div class="product-details float-left">
                                        <h4 class="title text-truncate">
                                            <a href="{{ route('product', $top_product->slug) }}" class="d-block">{{ $top_product->name }}</a>
                                        </h4>
                                        <div class="star-rating star-rating-sm mt-1">
                                            {{ renderStarRating($top_product->rating) }}
                                        </div>
                                        <div class="price-box">
                                            <span class="product-price strong-600">{{ home_discounted_base_price($top_product->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="product-desc-tab bg-white">
                        <div class="tabs tabs--style-2">
                            <ul class="nav nav-tabs justify-content-center sticky-top bg-white">
                                <li class="nav-item">
                                    <a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show">{{ translate('Description')}}</a>
                                </li>
                                @if($detailedProduct->video_link != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_2" data-toggle="tab" class="nav-link text-uppercase strong-600">{{ translate('Video')}}</a>
                                    </li>
                                @endif
                                @if($detailedProduct->pdf != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_3" data-toggle="tab" class="nav-link text-uppercase strong-600">{{ translate('Downloads')}}</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="#tab_default_4" data-toggle="tab" class="nav-link text-uppercase strong-600">{{ translate('Reviews')}}</a>
                                </li>
                            </ul>

                            <div class="tab-content pt-0">
                                <div class="tab-pane active show" id="tab_default_1">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mw-100 overflow--hidden aiz-product-description">
                                                    <?php echo $detailedProduct->description; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_2">
                                    <div class="fluid-paragraph py-2">
                                        <div class="embed-responsive embed-responsive-16by9 mb-5">
                                            @if ($detailedProduct->video_provider == 'youtube' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'dailymotion' && $detailedProduct->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                                            @elseif ($detailedProduct->video_provider == 'vimeo' && $detailedProduct->video_link != null)
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ my_asset($detailedProduct->pdf) }}">{{  translate('Download') }}</a>
                                            </div>
                                        </div>
                                        <span class="space-md-md"></span>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <div class="fluid-paragraph py-4">
                                        @foreach ($detailedProduct->reviews as $key => $review)
                                            <div class="block block-comment">
                                                <div class="block-image">
                                                    <img
                                                        src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                        @if($review->user->avatar_original !=null)
                                                            data-src="{{ my_asset($review->user->avatar_original) }}"
                                                        @else
                                                            data-src="{{ my_asset('img/avatar-place.png') }}"
                                                        @endif
                                                        class="rounded-circle lazyload"
                                                        >
                                                </div>
                                                <div class="block-body">
                                                    <div class="block-body-inner">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <h3 class="heading heading-6">
                                                                    <a href="javascript:;">{{ $review->user->name }}</a>
                                                                </h3>
                                                                <span class="comment-date">
                                                                    {{ date('d-m-Y', strtotime($review->created_at)) }}
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="rating text-right clearfix d-block">
                                                                    <span class="star-rating star-rating-sm float-right">
                                                                        @for ($i=0; $i < $review->rating; $i++)
                                                                            <i class="fa fa-star active"></i>
                                                                        @endfor
                                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                                            <i class="fa fa-star"></i>
                                                                        @endfor
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(count($detailedProduct->reviews) <= 0)
                                            <div class="text-center">
                                                {{  translate('There have been no reviews for this product yet.') }}
                                            </div>
                                        @endif

                                        @if(Auth::check())
                                            @php
                                                $commentable = false;
                                            @endphp
                                            @foreach ($detailedProduct->orderDetails as $key => $orderDetail)
                                                @if($orderDetail->order != null && $orderDetail->order->user_id == Auth::user()->id && $orderDetail->delivery_status == 'delivered' && \App\Review::where('user_id', Auth::user()->id)->where('product_id', $detailedProduct->id)->first() == null)
                                                    @php
                                                        $commentable = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($commentable)
                                                <div class="leave-review">
                                                    <div class="section-title section-title--style-1">
                                                        <h3 class="section-title-inner heading-6 strong-600 text-uppercase">
                                                            {{ translate('Write a review')}}
                                                        </h3>
                                                    </div>
                                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Your name')}}</label>
                                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{ translate('Email')}}</label>
                                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                                                    <input type="radio" id="star5" name="rating" value="5" required/>
                                                                    <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4" required/>
                                                                    <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" required/>
                                                                    <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2" required/>
                                                                    <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1" required/>
                                                                    <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" rows="4" name="comment" placeholder="{{ translate('Your review')}}" required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-styled btn-base-1 btn-circle mt-4">
                                                                {{ translate('Send review')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="my-4 bg-white p-3">
                        <div class="section-title-1">
                            <h3 class="heading-5 strong-700 mb-0">
                                <span class="mr-4">{{ translate('Related products')}}</span>
                            </h3>
                        </div>
                        <div class="caorusel-box arrow-round gutters-5">
                            <div class="slick-carousel" data-slick-items="3" data-slick-xl-items="2" data-slick-lg-items="3"  data-slick-md-items="2" data-slick-sm-items="1" data-slick-xs-items="1"  data-slick-rows="2">
                                @foreach (filter_products(\App\Product::where('subcategory_id', $detailedProduct->subcategory_id)->where('id', '!=', $detailedProduct->id))->limit(10)->get() as $key => $related_product)
                                <div class="caorusel-card my-1">
                                    <div class="row no-gutters product-box-2 align-items-center">
                                        <div class="col-5">
                                            <div class="position-relative overflow-hidden h-100">
                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block product-image h-100 text-center">
                                                    <img class="img-fit lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($related_product->thumbnail_img) }}" alt="{{  __($related_product->name) }}">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7 border-left">
                                            <div class="p-3">
                                                <h2 class="product-title mb-0 p-0 text-truncate">
                                                    <a href="{{ route('product', $related_product->slug) }}">{{  __($related_product->name) }}</a>
                                                </h2>
                                                <div class="star-rating star-rating-sm mb-2">
                                                    {{ renderStarRating($related_product->rating) }}
                                                </div>
                                                <div class="clearfix">
                                                    <div class="price-box float-left">
                                                        @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                            <del class="old-product-price strong-400">{{ home_base_price($related_product->id) }}</del>
                                                        @endif
                                                        <span class="product-price strong-600">{{ home_discounted_base_price($related_product->id) }}</span>
                                                    </div>
                                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                        <div class="float-right club-point bg-soft-base-1 border-light-base-1 border">
                                                            {{  translate('Club Point') }}:
                                                            <span class="strong-700 float-right">{{ $related_product->earn_point }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Any query about this product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="" action="{{ route('conversations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form-group">
                            <input type="text" class="form-control mb-3" name="title" value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="8" name="message" required placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">{{ translate('Cancel')}}</button>
                        <button type="submit" class="btn btn-base-1 btn-styled">{{ translate('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>-->

    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                <span>{{  translate('Use country code before number') }}</span>
                            @endif
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg h-auto" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="#" class="link link-xs link--style-3">{{ translate('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{ translate('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                        <div class="text-center pt-3">
                            <p class="text-md">
                                {{ translate('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{ translate('Register Now')}}</a>
                            </p>
                        </div>
                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <div class="or or--1 my-3 text-center">
                                <span>{{ translate('or')}}</span>
                            </div>
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{ translate('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{ translate('Login with Facebook')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{ translate('Login with Twitter')}}
                            </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function convertCm() {
			$('.table-inch').hide();
			$('.table-cm').show();
			$('.convert-cm-btn').removeClass('btn-default').addClass('btn-success');
			$('.convert-inch-btn').removeClass('btn-success').addClass('btn-default');
			
		}
		function convertInch() {
			$('.table-cm').hide();
			$('.table-inch').show();
			$('.convert-cm-btn').removeClass('btn-success').addClass('btn-default');
			$('.convert-inch-btn').removeClass('btn-default').addClass('btn-success');
			
		}
        $(document).ready(function() {
    		$('#share').jsSocials({
    			showLabel: false,
                showCount: false,
                shares: ["email", "twitter", "facebook", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
    		});
            getVariantPrice();
    	});

        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("Copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                document.getElementById(containerid).style.display = "block";
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("Copy");
                document.getElementById(containerid).style.display = "none";

            }
            showFrontendAlert('success', 'Copied');
        }

        function show_chat_modal(){
            @if (Auth::check())
                $('#chat_modal').modal('show');
            @else
                $('#login_modal').modal('show');
            @endif
        }				

    </script>
@endsection