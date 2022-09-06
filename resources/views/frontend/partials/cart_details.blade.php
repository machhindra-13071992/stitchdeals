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
					<th class="text-center" scope="col">Checkout</th>
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
					<td class="text-center"> <span class="whish-list-price">                                        {{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}                                    </span></td>
					<td class="text-center"> <a href="javascript:void()" onclick="removeFromCartView(event, {{ $key }})"><span class="trash"><i class="fas fa-trash-alt"></i> </span></a> </td>
					<td class="text-center"> @if(Auth::check()) <a href="{{ route('checkout.shipping_info') }}" class="btn theme-btn--dark1 btn--lg">{{ translate('buy now')}}</a> @else <a href="javascript:void()" class="btn theme-btn--dark1 btn--lg" onclick="showCheckoutModal()">{{ translate('buy now')}}</a> @endif </td>
				</tr> @endforeach </tbody>
		</table>
	</div> @else
	<div class="dc-header">
		<h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty')}}</h3>
		<a href="{{ route('home') }}" class="link link--style-3"> <i class="la la-mail-reply"></i> {{ translate('Return to shop')}} </a>
	</div> 
	@endif 
	@endif 
</div>
<script type="text/javascript">
    cartQuantityInitialize();
</script>