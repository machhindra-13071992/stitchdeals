@extends('frontend.layouts.app')

@section('content')

   <div id="page-content">
	<!-- breadcrumb-section start -->
	<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center mb-15">
						<h2 class="title text-dark text-capitalize">{{ translate('check out')}}</h2> </div>
				</div>
				<div class="col-12">
					<ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
						<li class="breadcrumb-item"><a href="index.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">check out</li>
					</ol>
				</div>
			</div>
		</div>
	</nav>
	<!-- breadcrumb-section end -->
	<!-- product tab start -->
	<section class="check-out-section pt-80 pb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-30"> 
					@csrf
					<div id="accordion">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0"><button class="btn btn-link collapsed"> {{ translate('1 Personal Information')}} </button></h5> </div>
						</div>
						<div class="card">
							<div class="card-header" id="headingTwo">
								<h5 class="mb-0">																						<button class="btn btn-link collapsed">2 Addresses</button>																				</h5> </div>
						</div>
						<div class="card">
							<div class="card-header" id="headingThree">
								<h5 class="mb-0">																		<button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><span>3</span> Delivery Info</button>																				</h5> </div>
							<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="card-body">
									<div class="delivery-options-list">
										<form class="form-default" data-toggle="validator" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST"> @csrf @php $admin_products = array(); $seller_products = array(); foreach (Session::get('cart') as $key => $cartItem){ if(\App\Product::find($cartItem['id'])->added_by == 'admin'){ array_push($admin_products, $cartItem['id']); } else{ $product_ids = array(); if(array_key_exists(\App\Product::find($cartItem['id'])->user_id, $seller_products)){ $product_ids = $seller_products[\App\Product::find($cartItem['id'])->user_id]; } array_push($product_ids, $cartItem['id']); $seller_products[\App\Product::find($cartItem['id'])->user_id] = $product_ids; } } @endphp @if (!empty($admin_products))
											<div class="delivery-option">
												<div class="row">
													<div class="col-12">
														<div class="align-items-center">
															<div class="col-sm-11 delivery-option-2">
																<div class="row align-items-center">
																	<div class="col-sm-8 col-12"> @foreach ($admin_products as $key => $id)
																		<div class="row align-items-center">
																			<div class="col-3"> <img loading="lazy" src="{{ my_asset(\App\Product::find($id)->thumbnail_img) }}"> </div>
																			<div class="col-9"> <span class="carrier-name"><a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank" class="d-block c-base-2">{{ \App\Product::find($id)->name }}</a></span> </div>
																		</div> @endforeach </div>
																	<div class="col-sm-4 col-12"> <span class="carrier-delay">																					<label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">																						<input type="radio" name="shipping_type_admin" value="home_delivery" checked class="" onchange="show_pickup_point(this)" data-target=".pickup_point_id_admin">																						<span class="radio-box"></span> <span class="d-block ml-2 strong-600">																							{{  translate('Home Delivery') }}																						</span> </label>
																		</span> @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1) <span class="carrier-delay">																					<label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">																						<input type="radio" name="shipping_type_admin" value="pickup_point" onchange="show_pickup_point(this)" data-target=".pickup_point_id_admin">																						<span class="radio-box"></span> <span class="d-block ml-2 strong-600">																							{{  translate('Local Pickup') }}																						</span> </label>
																		</span> @endif @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1)
																		<div class="mt-3 pickup_point_id_admin d-none">
																			<select class="pickup-select form-control-lg w-100" name="pickup_point_id_admin" data-placeholder="{{ translate('Select a pickup point') }}">
																				<option>{{ translate('Select your nearest pickup point')}}</option> @foreach (\App\PickupPoint::where('pick_up_status',1)->get() as $key => $pick_up_point)
																				<option value="{{ $pick_up_point->id }}" data-address="{{ $pick_up_point->address }}" data-phone="{{ $pick_up_point->phone }}"> {{ $pick_up_point->name }} </option> @endforeach </select>
																		</div> @endif </div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> @endif @if (!empty($seller_products)) @foreach ($seller_products as $key => $seller_product)
											<div class="delivery-option">
												<div class="row">
													<div class="col-12">
														<div class="align-items-center">
															<div class="col-sm-11 delivery-option-2">
																<div class="row align-items-center">
																	<div class="col-sm-8 col-12"> @foreach ($seller_product as $id)
																		<div class="row align-items-center">
																			<div class="col-3"> <img loading="lazy" src="{{ my_asset(\App\Product::find($id)->thumbnail_img) }}"> </div>
																			<div class="col-9"> <span class="carrier-name"><a href="{{ route('product', \App\Product::find($id)->slug) }}" target="_blank" class="d-block c-base-2">{{ \App\Product::find($id)->name }}</a></span> </div>
																		</div> @endforeach </div>
																	<div class="col-sm-4 col-12"> <span class="carrier-delay">																						<label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">																							<input type="radio" name="shipping_type_admin" value="home_delivery" checked class="" onchange="show_pickup_point(this)" data-target=".pickup_point_id_admin">																							<span class="radio-box"></span> <span class="d-block ml-2 strong-600">																								{{  translate('Home Delivery') }}																							</span> </label>
																		</span> @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1) @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id))) <span class="carrier-delay">																								<label class="d-flex align-items-center p-3 border rounded gry-bg c-pointer">																									<input type="radio" name="shipping_type_{{ $key }}" value="pickup_point" onchange="show_pickup_point(this)" data-target=".pickup_point_id_{{ $key }}">																									<span class="radio-box"></span> <span class="d-block ml-2 strong-600">																										{{  translate('Local Pickup') }}																									</span> </label>
																		</span> @endif @endif @if (\App\BusinessSetting::where('type', 'pickup_point')->first()->value == 1) @if (is_array(json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id)))
																		<div class="mt-3 pickup_point_id_{{ $key }} d-none">
																			<select class="pickup-select form-control-lg w-100" name="pickup_point_id_{{ $key }}" data-placeholder="{{ translate('Select a pickup point') }}">
																				<option>{{ translate('Select your nearest pickup point')}}</option> @foreach (json_decode(\App\Shop::where('user_id', $key)->first()->pick_up_point_id) as $pick_up_point) @if (\App\PickupPoint::find($pick_up_point) != null)
																				<option value="{{ \App\PickupPoint::find($pick_up_point)->id }}" data-address="{{ \App\PickupPoint::find($pick_up_point)->address }}" data-phone="{{ \App\PickupPoint::find($pick_up_point)->phone }}"> {{ \App\PickupPoint::find($pick_up_point)->name }} </option> @endif @endforeach </select>
																		</div> @endif @endif </div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> @endforeach @endif
											<div class="order-options">
												<div id="delivery" class="text-right">
													<button type="submit" id="paymentTrigger" class="btn theme-btn--dark1 btn--md"> Continue </button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" id="headingFour">
								<h5 class="mb-0">											<button class="btn btn-link collapsed"><span>4</span> Payment</button>										</h5> </div>
							<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
								<div class="card-body pt-0">
									<div class="custom-radio mb-4">
										<input type="radio" id="test5" name="radio-group">
										<label for="test5">Pay by Check</label>
									</div>
									<div class="custom-radio mb-4">
										<input type="radio" id="test6" name="radio-group">
										<label for="test6">Pay by bank wire</label>
									</div>
									<div class="custom-radio mb-4">
										<input type="radio" id="test7" name="radio-group">
										<label for="test7">Pay by Cash on Delivery</label>
									</div>
									<div class="filter-check-box mb-4">
										<input type="checkbox" id="20828" required="">
										<label class="checkout" for="20828">I agree to the terms and Conditions</label>
									</div>
									<button class="btn theme-btn--dark1 btn--md text-capitalize"> order now </button>
								</div>
							</div>
						</div>
					</div>
					</div>
				<div class="col-lg-4 mb-30"> @include('frontend.partials.cart_summary') </div>
			</div>
		</div>
	</section>
	<!-- product tab end -->
        
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function display_option(key){

        }
        function show_pickup_point(el) {
        	var value = $(el).val();
        	var target = $(el).data('target');

            console.log(value);

        	if(value == 'home_delivery'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
        	}else{
        		$(target).removeClass('d-none');
        	}
        }

    </script>
@endsection