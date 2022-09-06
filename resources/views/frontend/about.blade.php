@extends('frontend.layouts.app')



@section('content')

<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-110 pb-110">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center mb-15">
                    <h2 class="title text-dark text-capitalize">About Us</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="about-section pt-80 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-30">
                <div class="about-content">
                    <h2 class="title mb-20">Welcome To Stitchdeal.com</h2>
                    <p class="mb-20">
                        STITCHDEAL is an online fashion clothing market place, offers our customers quality products from hundreds of brands and online stores that specialize in selling trendy and fashion clothing online. You can choose from over thousands trendy clothing products available on the online fashion shop. All the products on STITCHDEAL are handpicked by its editors to ensure that they meet customer expectations
                    </p>
                    <p>
                        You’ve come to the right place. STITCHDEAL is here to bring you the best fashion trends. We carry both homegrown and leading international brands, ensuring that you always have the perfect out*t on hand no matter where or when. Our comprehensive selection keeps you looking fresh from top to bottom
                    </p>
                    <p>
                        With a stylish selection of clothes online, STITCHDEAL  is your one-stop shop for your wardrobe essentials
                    </p>
                </div>
            </div>
           
        </div>
       
    </div>
</section>
<!-- product tab end -->


@endsection