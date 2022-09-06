<style>
#addToCart-modal-body .product-box .block {
    display: flex;
}

#addToCart-modal-body .product-box .block .block-image {
    max-width: 132px;
    margin-right: 20px;
}
.added-cart-text {
    margin-top: -56px;
    margin-bottom: 39px;
    /* display: flex; */
    /* align-items: center; */
    /* justify-content: center; */
}

.added-cart-text>i {
    width: 50px;
    height: 50px;
    border: 1px solid;
    background-color: #28a745;
    color: #fff;
    font-size: 25px;
    border-radius: 50%;
    margin-right: 15px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 14px;
}
</style>
<div class="modal-body p-4 added-to-cart">
    <div class="text-center text-success added-cart-text">
        <i class="fa fa-check"></i>
        <h3>{{ translate('Item added to your cart!')}}</h3>
    </div>
    <div class="product-box">
        <div class="block">
            <div class="block-image">
                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" class="lazyload" alt="Product Image">
            </div>
            <div class="block-body">
                <h6 class="strong-600">
                    {{ __($product->name) }}
                </h6>
                <div class="addtocart-price">
                    <div class="addtocart-price">
						<div>{{ translate('Price')}}:</div>
						<div class="heading-6 text-danger">
							<strong>
								{{ single_price(($data['price']+$data['tax'])*$data['quantity']) }}
							</strong>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button class="btn theme-btn--dark2 btn--xl mt-5 mt-sm-0 rounded-5" data-dismiss="modal">{{ translate('Back to shopping')}}</button>
        <a href="{{ route('checkout.shipping_info') }}" class="btn theme-btn--dark1 btn--xl mt-5 mt-sm-0 rounded-5">{{ translate('Proceed to Checkout')}}</a>
    </div>
</div>