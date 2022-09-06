@extends('frontend.layouts.app')

@section('content')
	<!-- breadcrumb-section start -->
	<nav class="breadcrumb-section theme1 bg-lighten2 pt-20 pb-20">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center mb-15">
						<h2 class="title text-dark text-capitalize">{{ translate('Cart')}}</h2> </div>
				</div>
				<div class="col-12">
					<ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">{{ translate('Cart')}}</li>
					</ol>
				</div>
			</div>
		</div>
	</nav>
	<!-- breadcrumb-section end -->
	<!-- product tab start -->
	<section class="whish-list-section theme1 pt-20 pb-80" id="cart-summary">
		<div class="container">
			<div class="row">
				<div class="col-12"> @if(Session::has('cart'))
					
					@if(count(Session::get('cart'))>0)
					<h3 class="title mb-30 pb-25 text-capitalize">Your cart items</h3>
					<div class="table-responsive">
						<table class="table">
							<thead class="thead-light">
								<tr>
									<th class="text-center" scope="col">Product Image</th>
									<th class="text-center" scope="col">Product Name</th>
									<th class="text-center" scope="col">Stock Status</th>
									<th class="text-center" scope="col">Qty</th>
									<th class="text-center" scope="col">Price</th>
									<th class="text-center" scope="col">action</th>
								</tr>
							</thead>
							<tbody> @php $total = 0; @endphp @foreach (Session::get('cart') as $key => $cartItem) @php $product = \App\Product::find($cartItem['id']); $total = $total + $cartItem['price']*$cartItem['quantity']; $product_name_with_choice = $product->name; if ($cartItem['variant'] != null) { $product_name_with_choice = $product->name.' - '.$cartItem['variant']; } // if(isset($cartItem['color'])){ // $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name; // } // foreach (json_decode($product->choice_options) as $choice){ // $str = $choice->name; // example $str = choice_0 // $product_name_with_choice .= ' - '.$cartItem[$str]; // } @endphp
								<tr>
									<th class="text-center" scope="row"> <img loading="lazy" src="{{ my_asset($product->thumbnail_img) }}"> </th>
									<td class="text-center"> <span class="whish-title">{{ $product_name_with_choice }}</span> </td>
									<td class="text-center"> <span class="badge badge-danger position-static">In Stock</span> </td>
									<td class="text-center"> @if($cartItem['digital'] != 1)
										<div class="product-count style">
											<div class="count d-flex justify-content-center">
												<input type="text" name="quantity[{{ $key }}]" class="form-control h-auto input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" onchange="updateQuantity({{ $key }}, this)">
												<div class="button-group">
													<button class="count-btn btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]"><i class="fas fa-chevron-up"></i></button>
													<button class="count-btn btn-number" type="button" data-type="minus" data-field="quantity[{{ $key }}]"><i class="fas fa-chevron-down"></i></button>
												</div>
											</div>
										</div> @endif </td>
									<td class="text-center"> 
									    <span class="whish-list-price">
									    {{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}
									    </span>
									</td>
									<td class="text-center"> 
									    <a href="javascript:void()" onclick="removeFromCartView(event, {{ $key }})">
									        <span class="trash"><i class="fas fa-trash-alt"></i> </span>
									    </a> 
									</td>
								</tr> 
								@endforeach 
								<tr>
								    <td colspan="5">
								        <h4>Checkout</h4>
								    </td>
								    <td class="text-center"> 
									    @if(Auth::check()) 
									        <a href="{{ route('checkout.shipping_info') }}" class="btn theme-btn--dark1 btn--lg">
									            {{ translate('buy now')}}
									        </a> 
									   @else 
									        <a href="javascript:void()" class="btn theme-btn--dark1 btn--lg" onclick="showCheckoutModal()">{{ translate('buy now')}}</a>
									   @endif 
								    </td>
								</tr>
							</tbody>
						</table>
					</div> @else
					<div class="dc-header">
						<h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty')}}</h3>
						<a href="{{ route('home') }}" class="link link--style-3"> <i class="la la-mail-reply"></i> {{ translate('Return to shop')}} </a>
					</div> 
					@endif 
					@endif 
				</div>
			</div>
		</div>
	</section>
	<!-- product tab end -->

    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{ translate('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{ translate('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="text-center pt-3">
                        <p class="text-md">
                            {{ translate('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{ translate('Register Now')}}</a>
                        </p>
                    </div>
                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 my-3 text-center">
                            <span>{{ translate('or')}}</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{ translate('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{ translate('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{ translate('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>{{ translate('or')}}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{ translate('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', key:key, quantity: element.value}, function(data){			debugger
            updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    </script>
@endsection