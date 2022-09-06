<span class="position-relative">               
		<i class="icon-bag"></i>                       
		<span class="badge cbdg1">			
		@if(Session::has('cart'))			
			{{ count(Session::get('cart'))}}	
		@else									
			0										
		@endif										
		</span>                          
	</span>                                        
	<span class="cart-total position-relative">
		<span>
		@if(Session::has('cart'))
			@if(count($cart = Session::get('cart')) > 0)	
			<span>							
			@php	
			$total = 0;	
			@endphp		
			@foreach($cart as $key => $cartItem)
			@php									
			$product = \App\Product::find($cartItem['id']);		
			$total = $total + $cartItem['price']*$cartItem['quantity'];	
			@endphp														
				<span>														
					
				</span>		
				@endforeach	
			</span>								
			<span>		
				<span>{{ single_price($total) }}</span>	
			</span>
			@else
			<span>
			{{translate('Cart')}}
			</span>
			@endif
			@else
			<span>
			{{translate('Cart')}}
			</span>
			@endif
		</span>
	</span>