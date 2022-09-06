@extends('frontend.layouts.app')

@section('content')
    <style>
    
        nav > .nav.nav-tabs{

        border: none;
        color:#fff;
        background:#272e38;
        border-radius:0;

        }
        nav > div a.nav-item.nav-link,
        nav > div a.nav-item.nav-link.active
        {
        border: none;
        padding: 18px 25px;
        color:#fff;
        background:#272e38;
        border-radius:0;
        }

        nav > div a.nav-item.nav-link.active:after
        {
        content: "";
        position: relative;
        bottom: -60px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #e74c3c ;
        }
        .tab-content{
        background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top:5px solid #e74c3c;
        border-bottom:5px solid #e74c3c;
        padding:30px 25px;
        }

        nav > div a.nav-item.nav-link:hover,
        nav > div a.nav-item.nav-link:focus
        {
        border: none;
        background: #e74c3c;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
        }
        #buttons li {
          text-align: center;
          margin:5px;
          background-color: #e7e9ec;
          text-decoration: none;
        }
        #buttons li:hover {
          text-decoration: none;
          color: #000000;
          background-color: #f0c14b;
        }
    </style>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                {{--<div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>--}}

                <div class="col-lg-12">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Purchase History')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('purchase_history.index') }}">{{ translate('Purchase History')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--<div class="card-header">
                                <form id="sort_orders" action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-3 ml-auto">
                                            <select class="form-control mb-3 selectpicker" data-placeholder="{{ translate('Filter by Order Status')}}" name="order_status" onchange="sort_orders()">
                                                <option value="">{{ translate('Filter by Orders')}}</option>
                                                <option value="all_orders" @isset($order_status) @if($order_status == 'all_orders') selected @endif @endisset>{{ translate('Orders')}}</option>
                                                <option value="open_orders" @isset($order_status) @if($order_status == 'open_orders') selected @endif @endisset>{{ translate('Open Orders')}}</option>
                                                <option value="cancelled_orders" @isset($order_status) @if($order_status == 'cancelled_orders') selected @endif @endisset>{{ translate('Cancelled Orders')}}</option>
                                                <option value="buy_again" @isset($order_status) @if($order_status == 'buy_again') selected @endif @endisset>{{ translate('Buy Again')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>-->
                            <div class="row">
                            <div class="col-md-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link @isset($order_status) @if($order_status == 'all_orders') active @endif @endisset " id="nav-home-tab"  href="{{ route('purchase_history.index') }}?order_status=all_orders" role="tab" aria-controls="nav-home" aria-selected="true">Orders</a>
                                        <a class="nav-item nav-link @isset($order_status) @if($order_status == 'buy_again') active @endif @endisset " id="nav-profile-tab"  href="{{ route('purchase_history.index') }}?order_status=buy_again" role="tab" aria-controls="nav-profile" aria-selected="false">Buy Again</a>
                                        <a class="nav-item nav-link @isset($order_status) @if($order_status == 'open_orders') active @endif @endisset" id="nav-contact-tab"  href="{{ route('purchase_history.index') }}?order_status=open_orders" role="tab" aria-controls="nav-contact" aria-selected="false">Open Orders</a>
                                        <a class="nav-item nav-link @isset($order_status) @if($order_status == 'cancelled_orders') active @endif @endisset " id="nav-contact-tab"  href="{{ route('purchase_history.index') }}?order_status=cancelled_orders" role="tab" aria-controls="nav-contact" aria-selected="false">Cancelled Orders</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                            @if($order_status == 'buy_again')
                            <div class="row shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-4">
                            @foreach ($products as $key => $product)
                                @if ($product)
                                    <div class="col-xl-4 col-6" id="wishlist_{{ $product->id }}">
                                        <div class="card card-product mb-3 product-card-2">
                                            <div class="card-body p-3">
                                                <div class="card-image">
                                                    <a href="{{ route('product', $product->slug) }}" class="d-block" style="background-image:url('{{ my_asset($product->thumbnail_img) }}');">
                                                        <img src="{{ my_asset($product->thumbnail_img) }}" alt="" class="mystyleimg"  id="best_selling_main_image{{$product->id}}" data-src="{{ my_asset($product->thumbnail_img) }}"/>
                                                    </a>
                                                </div>
                                                <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                    <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                </h2>
                                                <div class="mt-2">
                                                    <div class="price-box">
                                                        @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                        @endif
                                                        <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="product-buttons">
                                                    <div class="row align-items-center">
                                                        <div class="col-10">
                                                            <button type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal({{ $product->id }})">
                                                                <i class="la la-shopping-cart mr-2"></i>{{ translate('Add to cart')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @endif
                        <!-- end  buy again section -->

                        @if (count($orders) > 0)
                            <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>{{ translate('Product Image')}}</th>
                                                <th>{{ translate('Code')}}</th>
                                                <th>{{ translate('Waybill Number')}}</th>
                                                <th>{{ translate('Date')}}</th>
                                                <th>{{ translate('Amount')}}</th>
                                                <th>{{ translate('Delivery Status')}}</th>
                                                <th>{{ translate('Payment Status')}}</th>
                                                <th>{{ translate('Options')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                @if (count($order->orderDetails) > 0)
                                                <?php  $pslug = isset($order->orderDetails[0]['product']['slug']) ? $order->orderDetails[0]['product']['slug'] : ""; ?>
                                                <tr>
                                                        <td style="width: 110px;">
                                                            <a href="{{ route('product',$pslug) }}" class="d-block" style="background-image:url('{{ my_asset($order->orderDetails[0]['product']['thumbnail_img']) }}');">
                                                                <img src="{{ my_asset($order->orderDetails[0]['product']['thumbnail_img']) }}" alt="" class="mystyleimg"  id="best_selling_main_image{{ $order->orderDetails[0]['product']['id'] }}" data-src="{{ my_asset($order->orderDetails[0]['product']['thumbnail_img']) }}"/>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                                        </td>
                                                        <td>
                                                            <a href="#{{ $order->code }}" onclick="show_purchase_order_tracking_details({{ $order->id }})">{{ $order->waybill_code }}</a>
                                                        </td>
                                                        <td>{{ date('d-m-Y', $order->date) }}</td>
                                                        <td>
                                                            {{ single_price($order->grand_total) }}
                                                        </td>
                                                        <td>
                                                            {{ ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status)) }}
                                                            @if($order->delivery_viewed == 0)
                                                                <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="">
                                                                @if ($order->payment_status == 'paid')
                                                                    <i class="bg-green"></i> {{ translate('Paid')}}
                                                                @else
                                                                    <i class="bg-red"></i> {{ translate('Unpaid') }}
                                                                @endif
                                                                @if($order->payment_status_viewed == 0)
                                                                    <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <!-- <div class="dropdown">
                                                                <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                                    <button onclick="show_purchase_history_details({{ $order->id }})" class="dropdown-item">{{ translate('Order Details')}}</button>
                                                                    <button onclick="show_purchase_order_tracking_details   ({{ $order->id }})" class="dropdown-item">{{ translate('Track Order')}}</button>
                                                                    <a href="{{ route('customer.invoice.download', $order->id) }}" class="dropdown-item">{{ translate('Download Invoice')}}</a>
                                                                    @if($order->orderDetails->first()->delivery_status == 'pending')
                                                                    <a onclick="confirm_modal('{{route('orders.cancelled',$order->id)}}');" class="dropdown-item" >{{translate('Cancel Order')}}</a>
                                                                    @endif
                                                                </div>
                                                            </div> -->
                                                            <ul id="buttons">
                                                                <li><button onclick="show_purchase_history_details({{ $order->id }})" class="">{{ translate('Order Details')}}</button></li>
                                                                <li><button onclick="show_purchase_order_tracking_details   ({{ $order->id }})" class="">{{ translate('Track Order')}}</button></li>
                                                                <li><a href="{{ route('customer.invoice.download', $order->id) }}" class="">{{ translate('Download Invoice')}}</a></li>
                                                                @if($order->orderDetails->first()->delivery_status == 'pending')
                                                                <li><a onclick="confirm_modal('{{route('orders.cancelled',$order->id)}}');" class="" >{{translate('Cancel Order')}}</a></li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                         </div>
                         </div>
                     </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $orders->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="order_tracking_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order_tracking_modal_body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Make Payment')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="payment_modal_body"></div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection