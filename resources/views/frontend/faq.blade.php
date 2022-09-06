@extends('frontend.layouts.app')



@section('content')

<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-15">
                    <h2 class="title text-dark text-capitalize">FAQ's</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">FAQ's</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->

<!-- FAQ Heading start -->
<section class="about-section pt-80">
    <div class="container">
        <div class="row">
          
            <div class="col-lg-12 mb-30">
                <div class="faq-info">
                    <h4 class="title mb-20" style="text-align: center;color: black;text-decoration: underline;text-transform: uppercase;">FAQ</h4>
                   
                </div>
            </div>
        </div>
       
    </div>
</section>
<!-- FAQ Heading end -->

<!-- FAQ start -->
<section class="check-out-section pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-30">
                   <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    HOW DO I KNOW IF MY ORDER IS PLACED??
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>Once your order is placed, you will receive an email confirming the details of your order. Orders typically ship within 24-hours of purchase.Once your order is fulfilled, you will receive an email confirmation with tracking information</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    WHATS THE SHIPPING CHARGES AT STITCH DEAL?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                 <p>
									A fixed shipping charge of INR 50 is applicable on all orders below INR 599/- 
									<br>
									The shipping charge applicable per quantity of the product can be checked by entering your pin code details on the product pages and the total shipping charge applicable on the order will be the sum of the charges for all chargeable product(s) in your order (+ INR 50 for orders below INR 599). The order level charge will be visible to you in the cart as well as when you enter the shipping address while you are checking out with your order. 
									<br>
									These shipping charges applicable are not refundable in the case of return/cancellation of the product or the order. <br>
									The shipping charges can be modified by SticthDeal at any point without prior intimation. The new charges would reflect on the product page as well as in the checkout flow
								</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    HOW DO I CHANGE SHIPPING ADDRESS?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>
									You can modify the shipping address of your order before we have processed (packed) it, by updating it under 'change address' option which is available under ‘My order’ section of App/Website/M-site
								</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    ESTIMATED DELIVERY TIME FOR THE ORDER
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body pt-0">
                               <p>
									For all areas serviced by reputed couriers, the delivery time would be within 7 to 10 business days of shipping (business days exclude Sundays and other holidays). 
								</p>
								<p>
								    The delivery date displayed while placing the order i.e. on the Product Details, Cart, Checkout and Order Confirmation page and in the order confirmation email are tentative. It may change once the order is shipped. Post shipment of the order, an Estimated Delivery Date will be displayed in the 'Order Details' under 'My Account ' section which will help you to keep a track of the shipment status of your order.
								</p>
								<p>
								    StitchDeal ensures to provide a delightful customer experience by delivering the products as per the Estimated Delivery Date communicated as above, however, at times there might be unexpected delays in the delivery of your order due to unavoidable and undetermined logistics challenges beyond our control for which SticthDeal is not liable and would request its users to cooperate as StitchDeal continuously tries to nought such instances. Also, StitchDeal reserves the right to cancel your order at its sole discretion in cases where it takes longer than usual delivery time or the shipment is physically untraceable and refund the amount paid for cancelled product(s) into the source account. 
								</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    HOW CAN I TRACK THE PACKAGE?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body pt-0">
                               <p>
									We will mail you the name of the courier company and the tracking number of your consignment in your registered email address. In case you do not receive a mail from us within 24hrs of placing an order please check your spam folder. Tracking may not appear online for up to another 24 hours in some cases, so please wait until your package is scanned by the courier company
								</p>
								<p>
								    Our delivery partners will attempt to deliver the package thrice before it is returned back. Please provide your mobile number in the delivery address as it will help in making a faster delivery
								</p>
								</div>
                        </div>
                    </div>
                      <div class="card">
                        <div class="card-header" id="headingSix">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    HOW CAN I CANCEL THE ORDER?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body pt-0">
                               <p>
								If you wish to cancel your Order after it has been placed or after being paid for by you, please contact our Customer care center on 
                                return@stitchdeal.com.For orders cancelled before dispatch, no cancellation fee will be applicable. In case the Order or a part of
                                it has been dispatched and received by you, it will need to be returned back to Stitchdeal and such returns will take place, on the
                                basis of Stitchdeal Returns and Refunds Policy. The Customer Happiness Team and Stitchdeal, however, reserve the right to
                                assess the returns and refunds on a case by case basis, as mentioned in the Stitchdeal Returns and Refunds Policy.
								</p>
								</div>
                        </div>
                    </div>
                     <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    INTERNATIONAL SHIPPING
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body pt-0">
                               <p>
									Currently we do not deliver to locations outside India
								</p>
								</div>
                        </div>
                    </div>
                </div>
                  <h4 class="title mb-20" style="text-align: center;color: black;text-decoration: underline;text-transform: uppercase;">Payment Policy</h4>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    WHATS THE PAYMENT METHOD AVIALABLE AT STITCHDEAL?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>We accept VISA, MASTER and AMERICAN EXPRESS Credit Cards issued in India and we accept Debit cards of all banks issued in India.</p>
                                <p>StitchDeal.com is committed to provide you safe way of transacting online. All your transactions online are protected &amp; secured by
SSL (secure socket layer) technology from GoDaddy.com. It encrypts your credit card and relevant information during the entire
transaction process. This encryption makes your shopping experience safe and secure.</p>
<p>All Credit card and Debit card payments on StitchDeal are processed through secure and trusted payment gateways managed by
leading Indian banks and payment gateway service providers.</p>
<p>
    StitchDeal does not store Credit / Debit card numbers, CVV / Security Code, Pin for 3D Secure, Expiry date on any of its servers
and only collects in a session while making a transaction. The said information may however be stored by Risk Management / Fraud
Management Systems of banks/payment gateways with authority to do so. Risk Management / Fraud Management Systems are
used for ensuring that payment card frauds are kept to minimum and all necessary information regarding payment cards is secure
for you, us and the payment card industry.
</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    IS THERE ANY HIDDEN CHARGES?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                 <p>
									You will get the final price during check out. Our prices are all inclusive and you need not pay anything extra.
								
								</p>
                            </div>
                        </div>
                    </div>
                 
                </div>
                
                                  <h4 class="title mb-20" style="text-align: center;color: black;text-decoration: underline;text-transform: uppercase;">RETURN &amp; EXCHANGE POLICY</h4>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    WHATS STITCH DEAL RETURN POLICY??
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>Items are eligible for return or exchange within 7 days of your ship date*. All items must be returned in its original condition
(unworn, unwashed, unaltered, tags attached) and in original packaging. To avoid delayed processing, returns must include the
packing slip supplied upon shipment. Items that appear to be worn and/or washed and not in its original/sellable condition may result
in delayed refund, or may not qualify for a refund. In these cases, the item(s) will be returned to you. Items marked as “Final Sale”
cannot be returned or exchanged. Please note that shipping and handling charges are non-refundable.
</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    WHATS STITCH DEAL EXCHANGE POLICY?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                 <p>
									We now offer exchanges through our automated return center. Items can be exchanged for a different size or color within 7 days of
the original ship date. Once your return item(s) are picked up from our courier partners, you will receive an email confirmation with
the details of your new order. Additional courier charges will be applicable for your new order for changing color and size..
								
								</p>
                            </div>
                        </div>
                    </div>
                     <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    IF I RECEIVE ANY DAMAGED ITEM ?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>
									If you receive an item that you believe is damaged or incorrect, please reach out to our customer service team by
emailing service@stitchdeal.com
								</p>
                            </div>
                        </div>
                    </div>
                 
                </div>

            </div>
        </div>
    </div>
</section>
<!-- FAQ Heading end -->

@endsection