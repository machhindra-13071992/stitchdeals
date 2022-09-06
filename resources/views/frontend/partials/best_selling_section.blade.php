
<style>.slider-item {    width: 20%;    padding: 10px;}.product-slider-init.theme1.slick-nav {    display: flex;    flex-wrap: wrap;} .product-slider-init .slick-list {
    width: 100%;
    
}
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
@if (\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1)
	<div class="col-12">
		<div class="tab-content" id="pills-tabContent">
		    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="row grid-view theme1"> @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(30)->get() as $key => $product)
					<div class="col-sm-6 col-lg-2 col-xl-2 mb-30 mystyle">
						<div class="product-list mb-30">
							<div class="card product-card">
								<div class="card-body p-3">
									<div class="media flex-column">
										<div class="product-thumbnail position-relative"> 
											<span class="badge badge-danger top-right">New</span> 
											<a href="{{ route('product', $product->slug) }}">												
												<img class="img-fit mx-auto mystyleimg" src="{{ my_asset($product->thumbnail_img) }}" onmouseover="scroll_slider({{ $product->id }},0)" id="best_selling_main_image{{$product->id}}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">											
											</a>
                                            @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
                                                <div class="scrollSlider" style="display:none" id="best_selling_product{{ $product->id }}">
                                                    
                                                </div>
                                            @endif
										</div>
										<div class="media-body">
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
														<button type="button" class="pro-btn" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})"><i class="icon-basket"></i></button>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
							<!-- product-list End -->
						</div>
					</div> @endforeach </div>
			</div>
		</div>
	</div>
<!--<section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4">{{translate('Best Selling')}}</span>
                    </h3>
                    <ul class="inline-links float-right">
                        <li><a  class="active">{{translate('Top 20')}}</a></li>
                    </ul>
                </div>
                <div class="caorusel-box arrow-round gutters-5">
                    <div class="slick-carousel" data-slick-items="3" data-slick-lg-items="2"  data-slick-md-items="2" data-slick-sm-items="1" data-slick-xs-items="1" data-slick-rows="2">
                        @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get() as $key => $product)
                            <div class="caorusel-card my-1">
                                <div class="row no-gutters product-box-2 align-items-center">
                                    <div class="col-4">
                                        <div class="position-relative overflow-hidden h-100">
                                            <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100">
                                                <img class="img-fit lazyload mx-auto" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{ __($product->name) }}">
                                            </a>
                                            <div class="product-btns">
                                                <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})">
                                                    <i class="la la-heart-o"></i>
                                                </button>
                                                <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})">
                                                    <i class="la la-refresh"></i>
                                                </button>
                                                <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})">
                                                    <i class="la la-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 border-left">
                                        <div class="p-3">
                                            <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                <a href="{{ route('product', $product->slug) }}">{{ __($product->name) }}</a>
                                            </h2>
                                            <div class="star-rating star-rating-sm mb-2">
                                                {{ renderStarRating($product->rating) }}
                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">
                                                        {{ home_discounted_base_price($product->id) }}
                                                    </span>
                                                </div>
                                                <div class="float-right">
                                                    <button class="add-to-cart btn" title="Add to Cart" onclick="showAddToCartModal({{ $product->id }})">
                                                        <i class="la la-shopping-cart"></i>
                                                    </button>
                                                </div>
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
    </section>-->
@endif