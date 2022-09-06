@extends('frontend.layouts.app')

@section('content')

    <div id="page-content">
		<!-- breadcrumb-section start -->
		<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title text-center mb-15">
							<h2 class="title text-dark text-capitalize">{{ translate('check out')}}</h2> 
						</div>
					</div>
					<div class="col-12">
						<ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
							<li class="breadcrumb-item"><a href="https://stitchdeal.com/">Home</a>
							</li>
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
						<div id="accordion">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">										<button class="btn btn-link collapsed">{{ translate('1 Personal Information')}}</button>									</h5>	
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingTwo">
									<h5 class="mb-0">																					<button class="btn btn-link collapsed">2 Addresses</button>																			</h5> 
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0">																	<button class="btn btn-link collapsed"><span>3</span> Delivery Info</button>																			</h5> 
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingFour">
									<h5 class="mb-0">										<button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><span>4</span> Payment</button>									</h5>	
								</div>
								<div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
									<div class="card-body pt-0">
										<form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST" id="checkout-form">@csrf @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test5" name="payment_option" value="paypal" class="online_payment" checked>
												<label for="test5" data-toggle="tooltip" data-title="Paypal">Pay by Paypal</label>
											</div>@endif @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test6" name="payment_option" value="stripe" class="online_payment">
												<label for="test6" data-toggle="tooltip" data-title="Stripe">Pay by stripe</label>
											</div>@endif @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test7" name="payment_option" value="sslcommerz" class="online_payment">
												<label for="test7" data-toggle="tooltip" data-title="sslcommerz">Pay by SSLCOMMERZ</label>
											</div>@endif @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test8" name="payment_option" value="instamojo" class="online_payment">
												<label for="test8" data-toggle="tooltip" data-title="Instamojo">Pay by Instamojo</label>
											</div>@endif @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test9" name="payment_option" value="razorpay" class="online_payment">
								<label for="test9" data-toggle="tooltip" data-title="Online Card and UPI"><img src="https://stitchdeal.com/public/frontend/images/icon/card-icon.jpg" /> </label>
											</div>@endif @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
											<div class="custom-radio mb-4">
												<input type="radio" id="test10" name="payment_option" value="paystack" class="online_payment" </div>@endif @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
												<div class="custom-radio mb-4">
													<input type="radio" id="test11" name="payment_option" value="voguepay" class="online_payment">
													<label for="test11" data-toggle="tooltip" data-title="VoguePay">Pay by VoguePay</label>
												</div>@endif @if(\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
												<div class="custom-radio mb-4">
													<input type="radio" id="test12" name="payment_option" value="payhere" class="online_payment">
													<label for="test12" data-toggle="tooltip" data-title="Payhere">Pay by Payhere</label>
												</div>@endif @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
												<div class="custom-radio mb-4">
													<input type="radio" id="test13" name="payment_option" value="paytm" class="online_payment" checked>
													<label for="test13" data-toggle="tooltip" data-title="Paytm">Pay by Paytm</label>
												</div>@endif @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1) @php $digital = 0; foreach(Session::get('cart') as $cartItem){ if($cartItem['digital'] == 1){ $digital = 1; } } @endphp @if($digital != 1)
												<div class="custom-radio mb-4">
													<input type="radio" id="test14" name="payment_option" value="cash_on_delivery" class="online_payment" checked>
													<label for="test14" data-toggle="tooltip" data-title="Cash on Delivery">Cash on Delivery</label>
												</div>@endif @endif @if (Auth::check()) @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated) @foreach(\App\ManualPaymentMethod::all() as $method)
												<div class="custom-radio mb-4">
													<input type="radio" id="test15" name="payment_option" value="{{ $method->heading }}" onchange="toggleManualPaymentData({{ $method->id }})">
													<label for="test15" data-toggle="tooltip" data-title="{{ $method->heading }}">{{ $method->heading }}</label>
												</div>@endforeach @foreach(\App\ManualPaymentMethod::all() as $method)
												<div id="manual_payment_info_{{ $method->id }}" class="d-none">@php echo $method->description @endphp @if ($method->bank_info != null)
													<ul>@foreach (json_decode($method->bank_info) as $key => $info)
														<li>Bank Name - {{ $info->bank_name }}, Account Name - {{ $info->account_name }}, Account Number - {{ $info->account_number}}, Routing Number - {{ $info->routing_number }}</li>@endforeach</ul>@endif</div>@endforeach @endif @endif
												<div class="card mb-3 bg-gray text-left p-3 d-none mt-3">
													<div id="manual_payment_description"></div>
												</div>@if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
												<div class="or or--1 mt-2">	<span>or</span>	
												</div>
												<div class="row">
													<div class="col-xxl-6 col-lg-8 col-md-10 mx-auto">
														<div class="text-center bg-gray py-4">	<i class="fa"></i>	
															<div class="h5 mb-4">{{ translate('Your wallet balance :')}} <strong>{{ single_price(Auth::user()->balance) }}</strong>
															</div>@if(Auth::user()->balance
															< $total) <button type="button" class="btn btn-base-2" disabled>{{ translate('Insufficient balance')}}</button>@else
																<button type="button" onclick="use_wallet()" class="btn btn-base-1">{{ translate('Pay with wallet')}}</button>@endif</div>
													</div>
												</div>@endif
												<div class="filter-check-box mb-4">
													<input id="agree_checkbox" type="checkbox" required>
													<label class="checkout" for="agree_checkbox">{{ translate('I agree to the')}}	<a href="{{ route('terms') }}">{{ translate('terms and conditions')}}</a>		<a href="{{ route('returnpolicy') }}">{{ translate('return policy')}}</a> &	<a href="{{ route('privacypolicy') }}">{{ translate('privacy policy')}}</a>	
													</label>
												</div>
												<button type="submit" onclick="submitOrder(this)" id="paymentTrigger" class="btn theme-btn--dark1 btn--md text-capitalize">order now</button>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 mb-30">@include('frontend.partials.cart_summary')</div>
					</div>
				</div>
		</section>
		<!-- product tab end -->
	</div>
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
          $(".online_payment").click(function(){
            $('#manual_payment_description').parent().addClass('d-none');
          });
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
            }
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id){
            $('#manual_payment_description').parent().removeClass('d-none');
            $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
        }
    </script>
@endsection