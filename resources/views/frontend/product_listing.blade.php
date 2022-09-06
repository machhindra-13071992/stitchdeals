<style>
@media screen and (min-width: 768px) {
    .mystyle
    {
        width : 19.666667% !important;
    }
}
@media screen and (max-width: 768px) {
    .mystyleimg
    {
        object-fit:contain !important;
        background:#fff ;
    }
}

.myclass
{
    -webkit-box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);
    box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);
    margin-bottom: 20px;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css"/>
<style>
  /* slider-wrapper */
  .slider-wrapper {
    display: flex;
    position: relative;
    width: 100%;
    height: 0vw;
    max-height: 500px;
    min-height: 300px;
    background: #ddd;
    overflow: hidden;
  }

  .slider-wrapper ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .scrollSlider {
  	bottom: 0px !important;
  }

  /* slider-img */
  ul.slider-img {
    display: flex;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    transition: 0.5s;
  }

  ul.slider-img li {
    flex: 1 0 100%;
  }

  ul.slider-img li img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* slider-arrow */
  ul.slider-arrow {
    position: relative;
    color: #fff;
    font-size: 2rem;
    display: flex;
    justify-content: space-between;
    height: 100%;
    width: 100%;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
  }

  @media screen and (min-width: 768px) {
    ul.slider-arrow {
      font-size: 2.5rem;
    }
  }

  ul.slider-arrow li {
    display: flex;
    align-items: center;
    cursor: pointer;
    height: 100%;
    padding: 0 15px;
    opacity: 0.4;
    transition: 0.5s;
  }

  ul.slider-arrow li:hover {
    opacity: 1;
  }

  /* slider-dot */
  .slider-dot {
    position: absolute;
    bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    width: 100%;
    color: #fff;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
  }

  .slider-dot li {
    cursor: pointer;
    margin: 0 8px;
    font-size: 0.6rem;
    opacity: 0.4;
  }

  .slider-dot li.active {
    opacity: 1;
  }
  .filter-check-box input[type=radio]:checked+label {
    color: red;
}
.custom-chk.filter-check-box input[type=checkbox]+label:before {
    background-color: var(--my-color-var);
}
.filter-check-box.custom-chk input[type=checkbox]:checked+label:before, .theme1 .filter-check-box.custom-chk input[type=checkbox]:checked+label:before {
    border: 2px solid #565656;
    -webkit-transform: inherit;
    transform: inherit;
    width: 15px;
    border-radius: 3px;
    left: 0;
    top: 5px;
}

.filter-check-box.custom-chk input[type=checkbox]:checked+label:after, .theme1 .filter-check-box.custom-chk input[type=checkbox]:checked+label:after {
    content: "";
    border-radius: 0;
    opacity: 1;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    width: 10px;
    height: 15px;
    position: absolute;
    left: 6px;
    border: 2px solid;
    border-color: transparent #080808 #171616 transparent;
    top: 0px;
}

.check-box-inner { padding-top: 1px !important;}
.single_line { color:#161515 !important;margin-top: 10px;margin-bottom: 0px;}
.card { min-width: 208px !important;}
.scroll-v{max-height: 250px;overflow-y: scroll;}
  @media screen and (min-width: 768px) {
    .slider-dot li {
      margin: 0 3px;
      font-size: 0.25rem;
    }
  }
</style>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@extends('frontend.layouts.app')

@if(isset($subsubcategory_id))
    @php
        $meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
        $meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
    @endphp
@elseif (isset($subcategory_id))
    @php
        $meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
        $meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
    @endphp
@elseif (isset($category_id))
    @php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id) && $brand_id != "")
    @php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title = env('APP_NAME');
        $meta_description = \App\SeoSetting::first()->description;
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-1 pb-1">
	<div class="container">
		<div class="row">
			<div class="col-12">
			</div>
			<div class="col-12">
				<ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-left">
					<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
					<!--<li class="breadcrumb-item"><a href="#">{{ translate('All Categories')}}</a></li> -->
					@if(isset($category_id))
						<li class="breadcrumb-item active">{{ \App\Category::find($category_id)->name }}</li> 
					@endif 
					@if(isset($subcategory_id))
						<li class="breadcrumb-item"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>                            
						<li class="breadcrumb-item active">{{ \App\SubCategory::find($subcategory_id)->name }}</li>                        
					@endif                        
					@if(isset($subsubcategory_id))                            
						<li class="breadcrumb-item "><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
						<li class="breadcrumb-item "><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
						<li class="breadcrumb-item active">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</li> 
					@endif 
				</ol>
			</div>
		</div>
	</div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<div class="product-tab bg-white pt-20 pb-50">
	<form class="" id="search-form" action="{{ route('search') }}" method="GET">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 mb-30">
					
					@isset($category_id)

						<input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">

					@endisset

					@isset($subcategory_id)

						<input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">

					@endisset

					@isset($subsubcategory_id)

						<input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">

					@endisset
					<div class="grid-nav-wraper bg-lighten2 mb-30">
						<div class="row align-items-center">
							<div class="col-12 col-md-8 mb-3 mb-md-0">
								<nav class="shop-grid-nav">
									<ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> <i class="fa fa-th"></i> </a>
										</li>
										<!--<li> <span class="total-products text-capitalize">There are 13 products.</span></li>-->
									</ul>
								</nav>
							</div>
							<div class="col-12 col-md-4 position-relative">
								<div class="shop-grid-button d-flex align-items-center"> 
									<span class="sort-by">{{ translate('Sort by')}}</span>
									<select class="form-control" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
										<option value="1" @isset($sort_by) @if ($sort_by == '1') selected @endif @endisset>{{ translate('Newest')}}</option>
										<option value="5" @isset($sort_by) @if ($sort_by == '5') selected @endif @endisset>{{ translate('Best seller')}}</option>
										<option value="2" @isset($sort_by) @if ($sort_by == '2') selected @endif @endisset>{{ translate('Oldest')}}</option>
										<option value="3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset>{{ translate('Price low to high')}}</option>
										<option value="4" @isset($sort_by) @if ($sort_by == '4') selected @endif @endisset>{{ translate('Price high to low')}}</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- product-tab-nav end -->
					<div class="tab-content" id="pills-tabContent">
						<!-- first tab-pane -->
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							<div class="row grid-view theme1">
								 @foreach($products as $key => $product)
                                    <div class="col-sm-6 col-lg-2 col-xl-2 mb-30 mystyle" >
                                        <div class="card product-card">
											<div class="card-body">
												
												<div class="product-thumbnail position-relative"> 
													<span class="badge badge-danger top-right">New</span>
													<a href="{{ route('product', $product->slug) }}"> 
														<div class="slider-wrapper">
	                                                        <ul class="slider-img mystyleimg" >
		                                                       <li>
		                                                            <img src="{{ my_asset($product->thumbnail_img) }}" alt="" class="mystyleimg" onmouseover="scroll_slider({{ $product->id }},0)" id="best_selling_main_image{{$product->id}}" data-src="{{ my_asset($product->thumbnail_img) }}"/>
		                                                         </li>
	                                                        </ul>
	                                                        @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
				                                                <div class="scrollSlider" style="display:none" id="best_selling_product{{ $product->id }}">
				                                                    
				                                                </div>
				                                            @endif
                                                    	</div>
														<!-- <img class="first-img img-fit lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{  __($product->name) }}"> -->
													</a>
													<!-- product links -->
													<!-- <ul class="product-links d-flex justify-content-center">
														<li>
															<a href="javascript:voide()" onclick="showAddToCartModal({{ $product->id }})"> <span data-toggle="tooltip" data-placement="bottom" title="Quick view" class="icon-magnifier"></span> </a>
															
														</li>
													</ul> -->
													<!-- product links end-->
												</div>
												<div class="product-desc py-0">
												    <a href="{{ route('product', $product->slug) }}" style="color: black;font-weight: bolder;font-size: 14px;">{{  __($product->brand->name) }}</a>
												    <h3 class="title" style="font-weight:bolder;">
														<a href="{{ route('product', $product->slug) }}" style="font-size: 13px;">{{  __($product->name) }}</a>
													</h3>
                          @if($product->size_heading != null)
                              @php
                              $size_headings = json_decode($product->size_heading);
                              @endphp
                              @if(isset($size_headings[0]) && $size_headings[0] != "")
                                  <div class="star-rating">
                                      Sizes:
                                      @foreach($size_headings as $key => $size_name)
                                          {{ $size_name }}
                                      @endforeach 
                                  </div>
                              @endif
                          @endif 
												<!-- 	<div class="star-rating"> 
														{{ renderStarRating($product->rating) }} 
													</div> -->
													
													<div class="d-flex align-items-center justify-content-between">
														<h6 class="product-price">
														    
															@if(home_base_price($product->id) != home_discounted_base_price($product->id))
															<del class="old-product-price strong-400" style="color:lightgrey;">{{ home_base_price($product->id) }}</del><span style="font-size: 11px;margin-left: 6%;color: red;">{{$product->discount}}% Off</span>
															@endif
															{{ home_discounted_base_price($product->id) }}
															<!--@if(home_base_price($product->id) != home_discounted_price($product->id)) <span class="badge position-static bg-dark rounded-0">Save {{$product->discount}}%</span> @endif-->
														</h6>
														<button class="pro-btn" type="button" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket"></i></button>
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                @endforeach
								
								
								
							</div>
						</div>
						<!-- second tab-pane -->
					</div>
					<div class="row">
						<div class="col-12">
							<nav class="pagination-section mt-30">
								<div class="row align-items-center">
									<div class="col-12">
										<ul class="pagination justify-content-center">
											{{ $products->links() }}
										</ul>
									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-lg-2 mb-30 order-lg-first">
					<aside class="left-sidebar theme1" style="padding: 0.5ex;/* min-width: 200px; *//* height:300px; *//* background-color: #333; */color: #fff;font-size: 2em;border-radius: 0.5ex;position: sticky;top: -.3em;/* z-index: 10000; */">
						<!-- search-filter start -->
						<div class="search-filter" style="border: 1px solid #e4e4e4;padding-left: 11px;padding-right: 27px;padding-bottom:20px;">
							<form action="#">
								<div class="check-box-inner mt-10">
									<h4 class="title">FILTER BY</h4>
								</div>
								<!-- check-box-inner -->
                <div class="check-box-inner mt-10">
										<a href="javascript:void(0)" onclick="toogleSideFilters('brand');"><h4 class="sub-title" id="show-hidden-menu"> @if($request->has('brand')) <i class="fas fa-angle-down" aria-hidden="true"></i> @else <i class="fas fa-angle-down" aria-hidden="true"></i> @endif brands</h4></a> 
										<div class="brand-hidden-menu" @if($request->has('brand')) style="display: block;" @else style="display: block;" @endif>
                         @foreach (\App\Brand::all() as $brand)
                         <div class="filter-check-box brand-{{ $brand->name }}">
                            @if (in_array($brand->id, $product_exit_brand_ids))  
                            <input type="checkbox" name="brand[]" value="{{ $brand->slug }}" id="brand-{{ $brand->name }}" @isset($brand_id) @if (in_array($brand->id, $brand_ids)) checked @endif @endisset onchange="filter()">
                            <label for="brand-{{ $brand->name }}" value="{{ $brand->slug }}">{{ $brand->name }}</label>
                            @endif
                        </div>
                        @endforeach
									</div>
                </div>
                <hr class="single_line">
								<div class="check-box-inner mt-10">
									<a href="javascript:void(0)"><h4 class="sub-title" id="show-hidden-menu">Price</h4></a>
									<div class="price-filter mt-10">
										<div class="price-slider-amount"> 
											<span class="range-slider-value value-low" @if (isset($min_price)) data-range-value-low="{{ $min_price }}" @elseif($products->min('unit_price') > 0) data-range-value-low="{{ $products->min('unit_price') }}" @else data-range-value-low="0" @endif id="input-slider-range-value-low"></span> - <span class="range-slider-value value-high" @if (isset($max_price)) data-range-value-high="{{ $max_price }}" @elseif($products->max('unit_price') > 0) data-range-value-high="{{ $products->max('unit_price') }}" @else data-range-value-high="0" @endif id="input-slider-range-value-high"></span>
										</div>
										<!-- Range slider container -->
										<!--<div id="input-slider-range" data-range-value-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{  filter_products(\App\Product::query())->get()->min('unit_price') }} @endif" data-range-value-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"></div>-->
										<div id="input-slider-range" data-range-value-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{  filter_products(\App\Product::query())->get()->min('unit_price') }} @endif" data-range-value-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"></div>
										<input type="hidden" name="min_price" value="@if(count(\App\Product::query()->get()) < 1) 0 @else {{  filter_products(\App\Product::query())->get()->min('unit_price') }} @endif">
										<input type="hidden" name="max_price" value="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif">
									</div>
									<hr class="single_line">
                  @if($attributes)
									<div class="check-box-inner mt-10">				
										@foreach ($attributes as $key => $attribute)
											@if (\App\Attribute::find($attribute['id']) != null)
												<a href="javascript:void(0)" onclick="toogleSideFilters('size');"><h4 class="sub-title" id="show-hidden-menu">@if(isset($selected_attributes) && count($selected_attributes) > 0) <i class="fas fa-angle-down" aria-hidden="true"></i> @else <i class="fas fa-angle-down" aria-hidden="true"></i> @endif {{ \App\Attribute::find($attribute['id'])->name }}</h4></a>
												<div class="size-hidden-menu scroll-v" @if(isset($selected_attributes) && count($selected_attributes) > 0) style="display: block;" @else style="display: block;" @endif >
                        @if(array_key_exists('values', $attribute))
													@foreach ($attribute['values'] as $key => $value)
														@php
															$flag = false;
															if(isset($selected_attributes)){
																foreach ($selected_attributes as $key => $selected_attribute) {
																	if($selected_attribute['id'] == $attribute['id']){
																		if(in_array($value, $selected_attribute['values'])){
																			$flag = true;
																			break;
																		}
																	}
																}
															}
														@endphp
														<div class="filter-check-box">
															<input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
															<label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
														</div>
													@endforeach
												@endif
                        </div>
											@endif
										@endforeach
									</div>
                  <hr class="single_line">
                  @endif
									<!-- check-box-inner -->
									<div class="check-box-inner mt-10">
										<a href="javascript:void(0)" onclick="toogleSideFilters('color');"><h4 class="sub-title" id="show-hidden-menu">@if($request->has('color')) <i class="fas fa-angle-down" aria-hidden="true"></i> @else <i class="fas fa-angle-down" aria-hidden="true"></i> @endif color</h4></a>
										<div class="color-hidden-menu scroll-v" @if($request->has('color')) style="display: block;" @else style="display: block;" @endif>
                    @foreach ($all_colors as $key => $color)
											<div class="filter-check-box custom-chk color-{{ $key }}">
												<input type="checkbox" id="color-{{ $key }}" name="color[]" value="{{ $color }}" @if(isset($selected_color) && in_array($color, $selected_color)) checked @endif onchange="filter()">
												<label style="--my-color-var: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}">{{ \App\Color::where('code', $color)->first()->name }}</label>
											</div>
										@endforeach
                    </div>
									</div>
                                  
									<!-- check-box-inner -->
									<!--<div class="check-box-inner mt-10">
										<h4 class="sub-title">Brand</h4>
										<div class="filter-check-box">
											<input type="checkbox" id="20824">
											<label for="20824">Roadster<span>(5)</span></label>
										</div>
										<div class="filter-check-box">
											<input type="checkbox" id="20825">
											<label for="20825">PUMA<span>(8)</span></label>
										</div>
									</div>-->
									{{-- <button type="submit" class="btn btn-styled btn-block btn-base-4">Apply filter</button> --}}
							</form>
							</div>
							<!-- search-filter end -->
							<!--<div class="product-widget mb-60 mt-30">
								<h3 class="title">Product Tags</h3>
								<ul class="product-tag d-flex flex-wrap">
									<li><a href="#">shopping</a></li>
									<li><a href="#">New products</a></li>
									<li><a href="#">Accessories</a></li>
									<li><a href="#">sale</a></li>
								</ul>
							</div>-->
							<!--second banner start
							<div class="banner hover-animation position-relative overflow-hidden">
								<a href="#" class="d-block"> <img src="{{ my_asset('frontend/images/banner/2.jpg') }}" alt="img"> </a>
							</div>
							second banner end-->
					</aside>
					</div>
				</div>
			</div>
	</form>
	</div>
	<!-- product tab end -->
    

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
        function toogleSideFilters(filterName){
          $('.'+filterName+'-hidden-menu').slideToggle("fast");
          $('.'+filterName+'-hidden-menu').parent().find('i').toggleClass('fas fa-angle-right fas fa-angle-down');
        }
    </script>
        <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
    <script>
    function (slider) {
    //alert (slider);
    
        // Determine the total amount of images in the carousel.
      let sliderCount = $("#"+slider+"").find(".slider-img li img").length;
      //alert (sliderCount);
      //return false;
      // Load images into the carousel
      let sliderImg = $("#"+slider+"").find(".slider-img");
      // Define the navigation arrows and pagination bullets.
      let sliderArrow = `<ul class="slider-arrow" style="display:none;"><li class="arrow-left" role="button"><i class="fas fa-chevron-left"></i></li><li class="arrow-right" role="button"><i class="fas fa-chevron-right"></i></li></ul>`;
      let sliderDotLi = "";
      for (let i = 0; i < sliderCount; i++) {
        sliderDotLi += `<li><i class="fas fa-circle"></i></li>`;
      }
      let sliderDot = `<ul class="slider-dot">${sliderDotLi}</ul>`;
      $("#"+slider+"").append(sliderArrow + sliderDot);

      let activeDefaultCount = $(".slider-dot li.active").length;
      if (activeDefaultCount != 1) {
        $(".slider-dot li")
          .removeClass()
          .eq(0)
          .addClass("active");
      }
      let sliderIndex = $(".slider-dot li.active").index();
      sliderImg.css("left", -sliderIndex * 100 + "%");

      // switch between images
      function sliderPos() {
        sliderImg.css("left", -sliderIndex * 100 + "%");
        $(".slider-dot li")
          .removeClass()
          .eq(sliderIndex)
          .addClass("active");
      }

      $(".arrow-right").click(function() {
        sliderIndex >= sliderCount - 1 ? (sliderIndex = 0) : sliderIndex++;
        sliderPos();
      });

      $(".arrow-left").click(function() {
        sliderIndex <= 0 ? (sliderIndex = sliderCount - 1) : sliderIndex--;
        sliderPos();
      });

      $(".slider-dot li").click(function() {
        sliderIndex = $(this).index();
        sliderPos();
      });

      let goSlider = setInterval(() => {
        $(".arrow-right").click();
      }, 40000);

      $("#"+slider+"").on({
        mouseenter: () => {
           goSlider = setInterval(() => {
            $(".arrow-right").click();
          }, 3000);
          
        },
        mouseleave: () => {
          clearInterval(goSlider);
        }
      });
    }
     
    </script>

@endsection