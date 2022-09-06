<!DOCTYPE html>
<?php if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1): ?>
<html dir="rtl" lang="en">
<?php else: ?>
<html lang="en">
<?php endif; ?>
<head>

<?php
    $seosetting = \App\SeoSetting::first();
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title><?php echo $__env->yieldContent('meta_title', config('app.name', 'Laravel')); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('meta_description', $seosetting->description); ?>" />
<meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', $seosetting->keyword); ?>">
<meta name="author" content="<?php echo e($seosetting->author); ?>">
<meta name="sitemap_link" content="<?php echo e($seosetting->sitemap_link); ?>">

<?php echo $__env->yieldContent('meta'); ?>

<?php if(!isset($detailedProduct) && !isset($shop) && !isset($page)): ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e(config('app.name', 'Laravel')); ?>">
    <meta itemprop="description" content="<?php echo e($seosetting->description); ?>">
    <meta itemprop="image" content="<?php echo e(my_asset(\App\GeneralSetting::first()->logo)); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo e(config('app.name', 'Laravel')); ?>">
    <meta name="twitter:description" content="<?php echo e($seosetting->description); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo e(my_asset(\App\GeneralSetting::first()->logo)); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e(config('app.name', 'Laravel')); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(route('home')); ?>" />
    <meta property="og:image" content="<?php echo e(my_asset(\App\GeneralSetting::first()->logo)); ?>" />
    <meta property="og:description" content="<?php echo e($seosetting->description); ?>" />
    <meta property="og:site_name" content="<?php echo e(env('APP_NAME')); ?>" />
    <meta property="fb:app_id" content="<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>">
<?php endif; ?>

<!-- Favicon -->
<link type="image/x-icon" href="<?php echo e(my_asset(\App\GeneralSetting::first()->favicon)); ?>" rel="shortcut icon" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo e(my_asset('frontend/css/bootstrap.min.css')); ?>" type="text/css" media="all">

<!-- Icons -->
<link rel="stylesheet" href="<?php echo e(my_asset('frontend/css/font-awesome.min.css')); ?>" type="text/css" media="none" onload="if(media!='all')media='all'">
<link rel="stylesheet" href="<?php echo e(my_asset('frontend/css/line-awesome.min.css')); ?>" type="text/css" media="none" onload="if(media!='all')media='all'">

<link type="text/css" href="<?php echo e(my_asset('frontend/css/bootstrap-tagsinput.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/jodit.min.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/sweetalert2.min.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/slick.css')); ?>" rel="stylesheet" media="all">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/xzoom.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/jssocials.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/jssocials-theme-flat.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/css/intlTelInput.min.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('css/spectrum.css')); ?>" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="<?php echo e(my_asset('frontend/scroll_slider/scrollslider.css')); ?>" rel="stylesheet">

<!-- Global style (main) -->
<!-- Global style (main) -->
<!--<link type="text/css" href="<?php echo e(my_asset('frontend/css/active-shop.css')); ?>" rel="stylesheet" media="all">


<link type="text/css" href="<?php echo e(my_asset('frontend/css/main.css')); ?>" rel="stylesheet" media="all">-->
<link type="text/css" href="<?php echo e(my_asset('frontend/css_updated/vendor/vendor.min.css')); ?>" rel="stylesheet" media="all">
<link type="text/css" href="<?php echo e(my_asset('frontend/css_updated/plugins/plugins.min.css')); ?>" rel="stylesheet" media="all">
<link type="text/css" href="<?php echo e(my_asset('frontend/css_updated/style.min.css')); ?>" rel="stylesheet" media="all">

<?php if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1): ?>
     <!-- RTL -->
    <link type="text/css" href="<?php echo e(my_asset('frontend/css/active.rtl.css')); ?>" rel="stylesheet" media="all">
<?php endif; ?>

<!-- color theme -->
<link href="<?php echo e(my_asset('frontend/css/colors/'.\App\GeneralSetting::first()->frontend_color.'.css')); ?>" rel="stylesheet" media="all">

<!-- Custom style -->
<link type="text/css" href="<?php echo e(my_asset('frontend/css/custom-style.css')); ?>" rel="stylesheet" media="all">

<!-- jQuery -->
<script src="<?php echo e(my_asset('frontend/js/vendor/jquery.min.js')); ?>"></script>


<?php if(\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('TRACKING_ID')); ?>"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo e(env('TRACKING_ID')); ?>');
    </script>
<?php endif; ?>

<?php if(\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1): ?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', <?php echo e(env('FACEBOOK_PIXEL_ID')); ?>);
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id=<?php echo e(env('FACEBOOK_PIXEL_ID')); ?>/&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<?php endif; ?>

</head>
<body>


<!-- MAIN WRAPPER -->
<div class="body-wrap shop-default shop-cards shop-tech gry-bg">

    <!-- Header -->
    <?php echo $__env->make('frontend.inc.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('frontend.inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('frontend.partials.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1): ?>
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="<?php echo e(env('FACEBOOK_PAGE_ID')); ?>">
        </div>
    <?php endif; ?>

    <div class="modal fade theme1 style1" id="addToCart" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="addToCart-modal-body" class="modal-body">
					
				</div>
			</div>
		</div>
	</div>

</div><!-- END: body-wrap -->

<!-- SCRIPTS -->
<!-- <a href="#" class="back-to-top btn-back-to-top"></a> -->

<!-- Core -->



<!-- Plugins: Sorted A-Z -->
<script src="<?php echo e(my_asset('frontend/js/jquery.countdown.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/nouislider.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/jssocials.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/jodit.min.js')); ?>"></script>

<script src="<?php echo e(my_asset('frontend/js/fb-script.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/lazysizes.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/intlTelInput.min.js')); ?>"></script>

<!-- App JS -->
<script src="<?php echo e(my_asset('frontend/js/active-shop.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/vendor/vendor.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/plugins/plugins.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/main2.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/bootstrap-tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/vendor/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/vendor/popper.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/js/xzoom.min.js')); ?>"></script>
<script src="<?php echo e(my_asset('frontend/scroll_slider/scrollslider.js')); ?>"></script>
<script>
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>

<?php $__currentLoopData = session('flash_notification', collect())->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <script>
        showFrontendAlert('<?php echo e($message['level']); ?>', '<?php echo e($message['message']); ?>');
    </script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<script>

    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('<?php echo e(route('category.elements')); ?>', {_token: '<?php echo e(csrf_token()); ?>', id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('<?php echo e(route('language.change')); ?>',{_token:'<?php echo e(csrf_token()); ?>', locale:locale}, function(data){
                        location.reload();
                    });

                });
            });
        }

        if ($('#currency-change').length > 0) {
            $('#currency-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var currency_code = $this.data('currency');
                    $.post('<?php echo e(route('currency.change')); ?>',{_token:'<?php echo e(csrf_token()); ?>', currency_code:currency_code}, function(data){
                        location.reload();
                    });

                });
            });
        }
    });

    $('#search').on('keyup', function(){
        search();
    });

    $('#search').on('focus', function(){
        search();
    });

    function search(){
        var search = $('#search').val();
        if(search.length > 0){
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('<?php echo e(route('search.ajax')); ?>', { _token: '<?php echo e(@csrf_token()); ?>', search:search}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
                    $('.search-preloader').addClass('d-none');

                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }

    function updateNavCart(){
        $.post('<?php echo e(route('cart.nav_cart')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
			updatesideNavCart();
			$('#cart_items').find('a.offcanvas-toggle').html(data);
			window.location.reload();
        });
    }
	function updatesideNavCart() {
		$.post('<?php echo e(route('cart.nav_side_cart')); ?>', {_token:'<?php echo e(csrf_token()); ?>'}, function(data){
			$('#sidebarCartItem').html(null)
			$('#sidebarCartItem').html(data)
        });
	}
	

    function removeFromCart(key){
        $.post('<?php echo e(route('cart.removeFromCart')); ?>', {_token:'<?php echo e(csrf_token()); ?>', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            window.location.reload();
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
        });
    }

    function addToCompare(id){
        $.post('<?php echo e(route('compare.addToCompare')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:id}, function(data){
            $('#compare').html(data);
            showFrontendAlert('success', 'Item has been added to compare list');
            $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
        });
    }

    function addToWishList(id){
        <?php if(Auth::check() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'seller')): ?>
            $.post('<?php echo e(route('wishlists.store')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:id}, function(data){
                if(data != 0){
                    $('#wishlist').html(data);
                    showFrontendAlert('success', 'Item has been added to wishlist');
                }
                else{
                    showFrontendAlert('warning', 'Please login first');
                }
            });
        <?php else: ?>
            showFrontendAlert('warning', 'Please login first');
        <?php endif; ?>
    }

    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal('show');
        $('.c-preloader').show();
        $.post('<?php echo e(route('cart.showCartModal')); ?>', {_token:'<?php echo e(csrf_token()); ?>', id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }

    $('#option-choice-form input').on('change', function(){
        getVariantPrice();
    });

    function getVariantPrice(){
        if($('#option-choice-form input[name=quantity]').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '<?php echo e(route('products.variant_price')); ?>',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div').removeClass('d-none');
                   $('#option-choice-form #chosen_price_div #chosen_price').html(data.price);
                   $('#available-quantity').html(data.quantity);
                   $('.input-number').prop('max', data.quantity);
                   //console.log(data.quantity);
                   if(parseInt(data.quantity) < 1 && data.digital  != 1){
                       $('.buy-now').hide();
                       $('.add-to-cart').hide();
                   }
                   else{
                       $('.buy-now').show();
                       $('.add-to-cart').show();
                   }
               }
           });
        }
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });

        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }

        return false;
    }

    function addToCart(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '<?php echo e(route('cart.addToCart')); ?>',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '<?php echo e(route('cart.addToCart')); ?>',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   //$('#addToCart-modal-body').html(null);
                   //$('.c-preloader').hide();
                   //$('#modal-size').removeClass('modal-lg');
                   //$('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("<?php echo e(route('cart')); ?>");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('<?php echo e(route('purchase_history.details')); ?>', { _token : '<?php echo e(@csrf_token()); ?>', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_purchase_order_tracking_details(order_id)
    {
        $('#order_tracking_modal_body').html(null);
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $.post('<?php echo e(route('purchase_order_tracking.details')); ?>', { _token : '<?php echo e(@csrf_token()); ?>', order_id : order_id}, function(data){
            $('#order_tracking_modal_body').html(data);
            $('#order_tracking_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('<?php echo e(route('orders.details')); ?>', { _token : '<?php echo e(@csrf_token()); ?>', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();

             $input.on('change', function(e) {
                 var fileName = '';

                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();

                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });

             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }

     function scroll_slider(productId,flag){
            console.log(productId);   
            /*$(".mystyleimg").show();
            $(".scrollSlider").empty();
            $(".scrollSlider").hide();
            if(flag == 0){   
                $('#best_selling_product'+productId).empty();
                 setTimeout(function(){ $.post('<?php echo e(route('home.section.scroll_sliders')); ?>', {_token:'<?php echo e(csrf_token()); ?>','product_id':productId}, function(data){
                    $(".scrollSlider").empty();
                    $(".scrollSlider").hide();
                    $(".mystyleimg").show();
                    $('#best_selling_product'+productId).html(data);
                    slickInit();
                    $("#best_selling_main_image"+productId).hide();
                    $("#best_selling_product"+productId).show();    
                    setTimeout(function(){ $("#best_selling_product"+productId).jscrollSlider({titlebar:{enable:false},enable:true,timeout:3000}); },1000);
                });
             },1000);
            }*/
        }
</script>

<?php echo $__env->yieldContent('script'); ?>

</body>
</html>
<?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>