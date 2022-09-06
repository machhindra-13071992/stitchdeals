<style>
.product-sync-nav {
    display: flex;
}

.product-sync-nav>.single-product {
    padding: 4px;
}

.product-sync-nav>.single-product img {
    margin: 0;
}
</style>
<div class="row">
    <div class="col-md-8 mx-auto col-lg-5 mb-5 mb-lg-0">
        @if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0)
            <div class="product-sync-init mb-20">
    			<div class="single-product">
    				<div class="product-thumb"> <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom img-fluid lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset(json_decode($product->photos)[0]) }}" xoriginal="{{ my_asset(json_decode($product->photos)[0]) }}" /> </div>
    			</div>
    			<!-- single-product end -->
    		</div>
    		<div class="product-sync-nav"> @foreach (json_decode($product->photos) as $key => $photo)
    			<div class="single-product">
    				<div class="product-thumb">
    					<a href="{{ my_asset(json_decode($product->photos)[0]) }}"> <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" class="xzoom-gallery lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" width="80" data-src="{{ my_asset($photo) }}" @if($key==0 ) xpreview="{{ my_asset($photo) }}" @endif> </a>
    				</div>
    			</div> @endforeach
    			<!-- single-product end -->
    		</div>
        @endif
    </div>
    <div class="col-lg-7 mt-5 mt-md-0">
        <div class="modal-product-info">
            <div class="product-head">
                
				<!--<h2 class="title">{{ $product->brand }}</h2>-->
				<h4 class="sub-title">{{ $product->name }}</h4>
				<div class="star-content mb-20"> {{ renderStarRating($product->rating) }} </div>
			</div>
			<div class="product-body mb-50"> 
			    @if(home_price($product->id) != home_discounted_price($product->id))
			    <span class="product-price text-center">
			        <del>{{ home_price($product->id) }}
			            @if($product->unit != null || $product->unit != '')
			                <span>/{{ $product->unit }}</span> 
			            @endif 
			        </del>
				</span>
				<span class="product-price text-center">
				    <strong>{{ home_discounted_price($product->id) }}</strong>
				    @if($product->unit != null || $product->unit != '')
				        <span class="piece">/{{ $product->unit }}</span>
				    @endif 
				</span>
				@else
				    <span class="product-price text-center">
				        <strong>{{ home_discounted_price($product->id) }}</strong>
				        @if($product->unit != null || $product->unit != '')
				            <span class="piece">/{{ $product->unit }}</span>
				        @endif
				    </span>
				@endif
				<input type="hidden" name="price" value="{{ home_discounted_price($product->id) }}">
				<p>Black printed sweatshirt, has a round neck, long sleeves, straight hem</p>
				<ul>
					<li>Long Sleeves</li>
					<li>Round Neck</li>
					<li>Casual</li>
				</ul>
			</div>
			<div class="product-footer">
			    @php
                    $qty = 0;
                    if($product->variant_product){
                        foreach ($product->stocks as $key => $stock) {
                            $qty += $stock->qty;
                        }
                    }
                    else{
                        $qty = $product->current_stock;
                    }
                @endphp
                <form id="option-choice-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="product-count style d-flex flex-column flex-sm-row my-4">
    					<div class="count d-flex">
    						<input type="number" name="quantity" min="1" max="10" step="1" value="1">
    						<div class="button-group">
    							<button class="count-btn increment btn-number" type="button" data-type="plus" data-field="quantity"><i class="fas fa-chevron-up"></i></button>
    							<button class="count-btn decrement btn-number" type="button" data-type="minus" data-field="quantity"><i class="fas fa-chevron-down"></i></button>
    						</div>
    					</div>
    					<div>
    						<!-- Add to cart button -->@if ($product->digital == 1)
    						<button type="button" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5" onclick="addToCart()"> <span class="mr-2"><i class="ion-android-add"></i></span> {{ translate('Add to cart')}} </button> @elseif($qty > 0)
    						<button type="button" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5" onclick="addToCart()"> <span class="mr-2"><i class="ion-android-add"></i></span> {{ translate('Add to cart')}} </button> @else
    						<button type="button" class="btn btn-styled btn-base-3 btn-icon-left strong-700" disabled> <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock')}} </button> @endif </div>
    				</div>
    				@if($product->digital !=1) 
    					@if ($product->choice_options != null) 
    					@foreach (json_decode($product->choice_options) as $key => $choice)
    					<div class="row no-gutters">
    						<div class="col-2">
    							<div class="product-description-label mt-2 ">{{ \App\Attribute::find($choice->attribute_id)->name }}:</div>
    						</div>
    						<div class="col-10">
    							<ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2"> @foreach ($choice->values as $key => $value)
    								<li>
    									<input type="radio" id="{{ $choice->attribute_id }}-{{ $value }}" name="attribute_id_{{ $choice->attribute_id }}" value="{{ $value }}" @if($key==0 ) checked @endif>
    									<label for="{{ $choice->attribute_id }}-{{ $value }}">{{ $value }}</label>
    								</li> @endforeach </ul>
    						</div>
    					</div> 
    					@endforeach 
    					@endif
    					@if (count(json_decode($product->colors)) > 0)
    					<div class="row no-gutters">
    						<div class="col-2">
    							<div class="product-description-label mt-2">{{ translate('Color')}}:</div>
    						</div>
    						<div class="col-10">
    							<ul class="list-inline checkbox-color mb-1">
    							     @foreach (json_decode($product->colors) as $key => $color)
    								<li>
    									<input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" value="{{ $color }}" @if($key==0 ) checked @endif>
    									<label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip"></label>
    								</li>
    								@endforeach 
    							</ul>
    						</div>
    					</div>
    					<hr> 
    					@endif
    				@endif
    				<div class="row no-gutters pb-3 d-none" id="chosen_price_div">
						<div class="col-2">
							<div class="product-description-label">{{ translate('Total Price')}}:</div>
						</div>
						<div class="col-10">
							<div class="product-price"> <strong id="chosen_price"></strong> </div>
						</div>
					</div>
                </form>
                <div class="addto-whish-list"> <a href="javascript:viod()" onclick="addToWishList({{ $product->id }})"><i class="icon-heart"></i> Add to wishlist</a> <a href="javascript:viod()" onclick="addToCompare({{ $product->id }})"><i class="icon-shuffle"></i> Add to compare</a> </div>
				<div class="pro-social-links mt-10">
					<ul class="d-flex align-items-center">
						<li class="share">Share</li>
						<li><a href="#"><i class="ion-social-facebook"></i></a></li>
						<li><a href="#"><i class="ion-social-twitter"></i></a></li>
						<li><a href="#"><i class="ion-social-google"></i></a></li>
						<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
					</ul>
				</div>
			</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    cartQuantityInitialize();
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>