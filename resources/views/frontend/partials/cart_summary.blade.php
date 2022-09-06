<ul class="list-group cart-summary rounded-0"> @php $subtotal = 0; $tax = 0; $shipping = 0; $total_shipping = 0; @endphp @foreach (Session::get('cart') as $key => $cartItem) @php $product = \App\Product::find($cartItem['id']); $subtotal += $cartItem['price']*$cartItem['quantity']; $tax += $cartItem['tax']*$cartItem['quantity']; $shipping += $cartItem['shipping']; $product_name_with_choice = $product->name; if ($cartItem['variant'] != null) { $product_name_with_choice = $product->name.' - '.$cartItem['variant']; } @endphp
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<ul class="items">
			<li>{{ $cartItem['quantity'] }} {{translate('item')}}</li>
			<li>{{translate('Total Shipping')}}</li>
		</ul>
		<ul class="amount">
			<li>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</li>
			<li>{{ single_price($shipping) }}</li>
		</ul>
	</li> @endforeach
	<li class="list-group-item d-flex justify-content-between align-items-center">
		<ul class="items">
			<li>Total (tax excl.)</li>
			<li>Total Shipping</li>
			<li>Taxes</li>
		</ul>
		<ul class="amount"> @php $total = $subtotal+$tax+$shipping; if($subtotal >= 599){$total -= $shipping;} if(Session::has('coupon_discount')){ $total -= Session::get('coupon_discount'); } @endphp
			<li>{{ single_price($total) }}</li>
			<li>@if($subtotal < 599) {{ single_price($shipping) }} @else 0  @endif </li>
			<li>{{ single_price($tax) }}</li>
		</ul>
	</li>
	<!---<li class="list-group-item text-center">
		<button type="submit" id="paymentBTN" class="btn theme-btn--dark1 btn--md">Proceed to checkout</button>
	</li>-->
</ul>
<div class="delivery-info mt-20">
	<ul>
		<li> <img src="{{ my_asset('frontend/images/icon/10.png') }}" alt="icon"><a href="https://stitchdeal.com/privacy_policy">Security policy</a> </li>
		<li> <img src="{{ my_asset('frontend/images/icon/11.png') }}" alt="icon"><a href="https://stitchdeal.com/terms">Delivery policy</a>  </li>
		<li class="mb-0"> <img src="{{ my_asset('frontend/images/icon/12.png') }}" alt="icon"><a href="https://stitchdeal.com/faq">Return policy</a> </li>
	</ul>
</div>