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
						
						<div id="accordion">
							<form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
								@csrf 
								@if(Auth::check())
									<div class="card">
										<div class="card-header" id="headingOne">
											<h5 class="mb-0"><button class="btn btn-link collapsed"> {{ translate('1 Personal Information')}} </button></h5> </div>
									</div>
									<div class="card">
										<div class="card-header" id="headingTwo">
											<h5 class="mb-0">																						<button class="btn btn-link collapsed">2 Addresses</button>																				</h5> 
										</div>
										<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
											<div class="card-body">
												<div class="row">
													@foreach (Auth::user()->addresses as $key => $address)
														<div class="col-md-6">

															<label class="aiz-megabox d-block bg-white">

																<input type="radio" name="address_id" value="{{ $address->id }}" @if ($address->set_default)

																	checked

																@endif required>

																<span class="d-flex p-3 aiz-megabox-elem">

																	<span class="aiz-rounded-check flex-shrink-0 mt-1"></span>

																	<span class="flex-grow-1 pl-3">

																		<div>

																			<span class="alpha-6">{{ translate('Address') }}:</span>

																			<span class="strong-600 ml-2">{{ $address->address }}</span>

																		</div>

																		<div>

																			<span class="alpha-6">{{ translate('Postal Code') }}:</span>

																			<span class="strong-600 ml-2">{{ $address->postal_code }}</span>

																		</div>

																		<div>

																			<span class="alpha-6">{{ translate('City') }}:</span>

																			<span class="strong-600 ml-2">{{ $address->city }}</span>

																		</div>

																		<div>

																			<span class="alpha-6">{{ translate('Country') }}:</span>

																			<span class="strong-600 ml-2">{{ $address->country }}</span>

																		</div>

																		<div>

																			<span class="alpha-6">{{ translate('Phone') }}:</span>

																			<span class="strong-600 ml-2">{{ $address->phone }}</span>

																		</div>

																	</span>

																</span>

															</label>
														</div>
													@endforeach
												</div>
													<input type="hidden" name="checkout_type" value="logged">
													<div class="form-group row">
														<div class="col-md-12 text-right">
															<a href="javascript:void()" onclick="add_new_address()" class="btn theme-btn--dark2 btn--md"><i class="la la-plus"></i> {{ translate('Add New Address') }}</a>
															<button type="submit" class="btn theme-btn--dark1 btn--md">{{ translate('Continue') }}</button>
														</div>
													</div>
											</div>
										</div>
									</div>
								@else
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="mb-0">											<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"												aria-expanded="true" aria-controls="collapseOne">												{{ translate('1 Personal Information')}}											</button>										</h5> </div>
									<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											<div class="order-asguest mt-2 mb-4"> <a href="javascript:viod()">{{ translate('Order as a guest')}}</a> <span class="separator"></span> <a class="gray" href="#">{{ translate('Sign in')}}</a> </div>
											<div class="form-group row">
												<label class="col-md-3 col-form-label"> {{ translate('Social title')}} </label>
												<div class="col-md-6">
													<div class="d-flex flex-wrap">
														<div class="custom-radio">
															<input type="radio" id="test1" name="radio-group">
															<label for="test1">{{ translate('Mr')}}</label>
														</div>
														<div class="custom-radio">
															<input type="radio" id="test2" name="radio-group">
															<label for="test2">{{ translate('Mrs')}}</label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label for="firstname" class="col-md-3 col-form-label">{{ translate('Full Name')}}</label>
												<div class="col-md-6">
													<input type="text" id="firstname" class="form-control" name="name" placeholder="{{ translate('Name')}}" required> </div>
											</div>
											<div class="form-group row">
												<label for="email" class="col-md-3 col-form-label">{{ translate('Email')}}</label>
												<div class="col-md-6">
													<input type="email" id="email" class="form-control" name="email" placeholder="{{ translate('Email')}}" required> </div>
											</div>
											<!--<div class="form-group row">
												<label for="Password" class="col-md-3 col-form-label">Password</label>
												<div class="col-md-6">
													<div class="input-group mb-2 mr-sm-2">
														<input type="password" class="form-control" id="Password">
														<div class="input-group-prepend">
															<button type="button" class="input-group-text theme-btn--dark1 btn--md show-password">show</button>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<label><span class="optional">																Optional															</span></label>
												</div>
											</div>
											<div class="form-group row">
												<label for="birthdate" class="col-md-3 col-form-label">Birthdate</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="birthdate" placeholder="MM/DD/YYYY"> </div>
												<div class="col-md-3">
													<label><span class="optional">																Optional															</span></label>
												</div>
											</div>-->
											<div class="form-group row">
												<div class="col-12">
													<div class="sign-btn text-right"> 
														<a href="javascript:void()" class="btn theme-btn--dark1 btn--md" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Continue</a>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingTwo">
										<h5 class="mb-0">											
											<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"												aria-expanded="false" aria-controls="collapseTwo">2 Addresses</button>										
										</h5> 
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="card-body">
											<div class="checkout-inner border-0">
												<div class="checkout-address p-0">
													<p> The selected address will be used both as your personal address (for invoice) and as your delivery address. </p>
												</div>
												<div class="check-out-content">
													<!--<div class="form-group row">
														<label class="col-md-3" for="firstName2">First name</label>
														<div class="col-md-6">
															<input class="form-control" id="firstName2" name="firstname" type="text" required=""> </div>
													</div>
													<div class="form-group row">
														<label class="col-md-3" for="lastName2">Last name</label>
														<div class="col-md-6">
															<input class="form-control" id="lastName2" name="lastname" type="text" required=""> </div>
													</div>
													<div class="form-group row">
														<label class="col-md-3" for="company">Company</label>
														<div class="col-md-6">
															<input class="form-control" id="company" name="company" type="text" required=""> </div>
														<div class="col-md-3"> <span class="optional">																	Optional																</span> </div>
													</div>-->
													<div class="form-group row">
														<label class="col-md-3" for="address1">Address</label>
														<div class="col-md-6">
															<input type="text" class="form-control" id="address1" name="address" placeholder="{{ translate('Address')}}" required> </div>
													</div>
													<!--<div class="form-group row">
														<label class="col-md-3" for="address2">Address Complement</label>
														<div class="col-md-6">
															<input class="form-control" id="address2" name="address2" type="text" required=""> </div>
														<div class="col-md-3"> <span class="optional">																	Optional																</span> </div>
													</div>-->
													<div class="form-group row">
														<label class="col-md-3" for="city">{{ translate('City')}}</label>
														<div class="col-md-6">
															<input type="text" class="form-control" id="city" placeholder="{{ translate('City')}}" name="city" required> </div>
													</div>
													<!--<div class="form-group row">
														<label class="col-md-3">State</label>
														<div class="col-md-6">
															<select class="form-control">
																<option>-- please choose --</option>
																<option value="1">AA</option>
																<option value="2">AE</option>
																<option value="3">AP</option>
																<option value="4">Alabama</option>
																<option value="5">Alaska</option>
															</select>
														</div>
													</div>-->
													<div class="form-group row">
														<label class="col-md-3" for="zip">{{ translate('Zip/Postal Code')}}</label>
														<div class="col-md-6">
															<input type="text" class="form-control" id="zip" placeholder="{{ translate('Postal code')}}" name="postal_code" required> </div>
													</div>
													<div class="form-group row">
														<label class="col-md-3">{{ translate('Country')}}</label>
														<div class="col-md-6">
															<select class="form-control" data-live-search="true" name="country"> @foreach (\App\Country::where('status', 1)->get() as $key => $country)
																<option value="{{ $country->name }}">{{ $country->name }}</option> @endforeach </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-md-3" for="phone">{{ translate('Phone')}}</label>
														<div class="col-md-6">
															<input type="number" min="0" id="phone" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required> </div>
														<div class="col-md-3"> <span class="optional">																	Optional																</span> </div>
													</div>
													<!--<div class="form-group row">
														<div class="col-md-9 col-md-offset-3">
															<div class="filter-check-box mb-0">
																<input type="checkbox" id="20824" required="">
																<label class="checkout" for="20824">check out</label>
															</div>
														</div>
													</div>-->
													<div class="form-group row mb-0">
														<div class="col-12 text-right">
															<button type="submit" id="paymentTrigger" class="btn theme-btn--dark1 btn--md">Continue</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endif
							</form>
							<div class="card">
								<div class="card-header" id="headingThree">
									<h5 class="mb-0">							
										<button class="btn btn-link collapsed"><span>3</span> Delivery Info</button>										
									</h5> 
								</div>
								
							</div>
							<div class="card">
								<div class="card-header" id="headingFour">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed"><span>4</span> Payment</button>
									</h5>
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

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('Your Address')}}" rows="1" name="address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{ translate('Select your country')}}" name="country" required>
                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('City')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your City')}}" name="city" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-base-1">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
</script>
@endsection