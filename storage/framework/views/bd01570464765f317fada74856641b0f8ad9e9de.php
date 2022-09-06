<style>
.custom-search {
    width: 100%;
    height: 46px;
    position: relative;
}

.header-middle .typed-search-box {
    width: 100%;
    padding: 15px;
    border: 1px solid #eee;
    border-top: 0;
    position: absolute;
    top: 43px;
    z-index: 9999;
    background-color: #fff;
}

.header-middle .typed-search-box .title {
    font-size: 18px;
    margin-bottom: 5px;
}

.header-middle .typed-search-box ul>li>a {
    color: #6b6b6b;
}

.header-middle .typed-search-box ul {
    margin-bottom: 14px;
}

.header-middle .typed-search-box ul>li>a:hover {
    color: #F79F1F;
}
.cart-wishlist {
    top: -5px;
    margin-left: 5px;
}
li.on-hever>.mega-menu >li>a {
    font-weight: normal;
    font-family: 'Gilroy-Regular ☞';
}

.cart-block-links .right-menu>li>a {
    display: inline-block;
    /* flex-direction: column; */
    /* align-items: center; */
    /* justify-content: flex-end; */
    text-align: center;
}

.cart-block-links 
 .right-menu>li {
    margin-right: 10px;
    min-width: 40px;
    display: flex;
    justify-content: center;
}

.cart-block-links .right-menu>li>a>span {
    margin: 0;
    display: block;
    text-align: center;
}

span.position-relative.cart-icon {
    /* top: -3px; */
    /* display: block; */
}

.cart-block-links .right-menu>li>a.offcanvas-toggle {
    position: relative;
    top: -2px;
}
li.on-hever:hover>.mega-menu {
    /* display: block; */
    opacity: 1;
    visibility: visible;
    height: auto;
    transform: inherit;
    padding: 12px 20px;
}
@media  screen and (max-width: 600px) {
  .title_message {
   display:none;   
}
    
}

</style>
<!-- header start -->
<header>
   <!-- header top start -->    

   <!-- header top end -->    <!-- header-middle satrt -->    
   <div id="sticky" class="header-middle pt-20 myclass" style="background: white;">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-sm-6 col-lg-2 order-first">
               <div class="logo text-center text-sm-left mb-17 mb-sm-0">                        
               <a href="<?php echo e(route('home')); ?>">
            <?php
            $generalsetting = \App\GeneralSetting::first();
            ?>
            <?php if($generalsetting->logo != null): ?>
            <img src="<?php echo e(my_asset($generalsetting->logo)); ?>" alt="<?php echo e(env('APP_NAME')); ?>">							<?php else: ?>								<img src="<?php echo e(my_asset('frontend/images/logo/logo.png')); ?>" alt="<?php echo e(env('APP_NAME')); ?>">							<?php endif; ?>						</a>                    </div>
            </div>
            <div class="col-sm-6 col-lg-2 col-xl-2">
               <!-- search-form end -->                    
               <div class="d-flex align-items-center justify-content-center justify-content-sm-end">
                  
                  <!-- static-media end -->                        
                  <div class="cart-block-links theme1">
                     <ul class="d-flex right-menu">
                        <?php if(auth()->guard()->check()): ?>
                        <li class="on-hever">
                            <a href="<?php echo e(route('dashboard')); ?>" class="top-bar-item">
                                <i class="la la-user"></i>
                                <!--<span class="cart-wishlist position-relative">Profile</span>-->
                            </a>
                            <ul class="mega-menu c-scrollbar">
                 <li>
                  <a href="javascript:void(0)" class="top-bar-item"><b>Hello, <?php $explodeNameArry = explode(' ',Auth::user()->name); echo $explodeNameArry[0]; ?></b></a>
                </li>             
								<li>
									<a href="<?php echo e(route('dashboard')); ?>" class="top-bar-item"><?php echo e(translate('Dashboard')); ?></a>
								</li>
                <li><a href="<?php echo e(route('profile')); ?>"><?php echo e(translate('Your Account')); ?></a></li>
                <?php if(Auth::user()->user_type == 'customer'): ?>
                <li><a href="<?php echo e(route('purchase_history.index')); ?>?order_status=all_orders"><?php echo e(translate('Your Orders')); ?></a></li>
                <?php else: ?>
                <li><a href="<?php echo e(route('orders.index')); ?>"><?php echo e(translate('Your Orders')); ?></a></li>
                <?php endif; ?>
                <li><a href="<?php echo e(route('wishlists.index')); ?>"><?php echo e(translate('Your Wish List')); ?></a></li>
                <li>
                    <a href="<?php echo e(route('support_ticket.index')); ?>">
                        <span class="category-name">
                            <?php echo e(translate('Support Ticket')); ?> 
                        </span>
                    </a>
                </li>
								<li>
                     <a href="<?php echo e(route('logout')); ?>" class="top-bar-item"><?php echo e(translate('Logout')); ?></a>
                </li>
							</ul>
                        </li>
                        <?php else: ?>
                        <li class="on-hever">
                            <a href="<?php echo e(route('user.login')); ?>" class="top-bar-item">
                                <i class="la la-user"></i>
                                
                            </a>
                            <ul class="mega-menu c-scrollbar">
								<li>
									<a href="<?php echo e(route('user.login')); ?>" class="top-bar-item"><?php echo e(translate('Login')); ?></a>
								</li>
								<li>
                                    <a href="<?php echo e(route('user.registration')); ?>" class="top-bar-item"><?php echo e(translate('Registration')); ?></a>
                                </li>
							</ul>
                        </li>
                        <?php endif; ?>
                        <li class="cart-block position-relative" id="cart_items">
                           <a class="offcanvas-toggle" href="#offcanvas-cart">
								<span class="position-relative">               
									<i class="icon-bag"></i>                       
									<span class="badge cbdg1">			
									<?php if(Session::has('cart')): ?>			
										<?php echo e(count(Session::get('cart'))); ?>	
									<?php else: ?>									
										0										
									<?php endif; ?>										
									</span>                          
								</span>                                        
								<span class="cart-total position-relative">
									<span>
                                    <?php if(Session::has('cart')): ?>
										<?php if(count($cart = Session::get('cart')) > 0): ?>	
										<span>							
										<?php	
										$total = 0;	
										?>		
										<?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php									
										$product = \App\Product::find($cartItem['id']);		
										$total = $total + ($cartItem['price']+$cartItem['tax'])*$cartItem['quantity'];	
										?>														
											<span>														
												
											</span>		
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
										</span>								
										<span style="margin-top: 7px;">		
											<span><?php echo e(single_price($total)); ?></span>	
										</span>
										<?php else: ?>
										<span>
										<?php echo e(translate('')); ?>

										</span>
										<?php endif; ?>
										<?php else: ?>
										<span>
										<?php echo e(translate('')); ?>

										</span>
										<?php endif; ?>
									</span>
								</span>
							</a>
                        </li>
                        <!-- cart block end -->  
                        <!--<li>
                            <a class="pl-15" href="<?php echo e(route('wishlists.index')); ?>">
                                <i class="la la-heart-o"></i>
                                
                            </a>
                        </li>-->
                     </ul>
                  </div>
                  <div class="mobile-menu-toggle theme1 d-lg-none">
                     <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                        <svg viewbox="0 0 800 600">
                           <path                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"                                        id="top"></path>
                           <path d="M300,320 L540,320" id="middle"></path>
                           <path                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"                                        id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318)">                                    </path>
                        </svg>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-5 col-xl-4 order-lg-first title_message">
               <div class="search-form pt-30 pt-lg-0">
                   <ul class="main-menu d-flex">
				
					<?php $__currentLoopData = \App\Category::all()->take(11); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
							$brands = array();
						?>
						<li class="position-static category-nav-element" data-id="<?php echo e($category->id); ?>">
							<a href="<?php echo e(route('products.category', $category->slug)); ?>" style="color:black;"><?php echo e(__($category->name)); ?> <i class="ion-ios-arrow-down"></i></a>
							<?php if(count($category->subcategories)>0): ?>
								<ul class="mega-menu sub-cat-menu c-scrollbar" style="margin-top:-3%;">
									<li class="c-preloader">
										<i class="fa fa-spin fa-spinner"></i>
									</li>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
               </div>
            </div>
            <div class="col-lg-5 col-xl-4 order-lg-first">
               <div class="search-form pt-30 pt-lg-0">
                  <form class="form-inline position-relative" action="<?php echo e(route('search')); ?>" method="GET">
					<div class="custom-search">
						<input class="form-control theme1-border" type="text"  aria-label="Search" id="search" name="q" placeholder="<?php echo e(translate('I am shopping for...')); ?>" autocomplete="off" style="background:#eee;">
						<button class="btn search-btn theme-bg btn-rounded" type="submit" style="background:#eee !important;">
							<i class="icon-magnifier" style="color:black;"></i>
						</button>		
					</div>
                     <div class="typed-search-box d-none">
                        <!--<div class="search-preloader">
                           <div class="loader">
                              <div></div>
                              <div></div>
                              <div></div>
                           </div>
                        </div>-->
                        <div class="search-nothing d-none">									</div>
                        <div id="search-content">									</div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- header-middle end -->	<!-- header bottom start     
   <nav id="sticky" class="header-bottom theme1 d-none d-lg-block">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-10 offset-lg-2 d-flex flex-wrap align-items-center position-relative">
               <ul class="main-menu d-flex">
				
					<?php $__currentLoopData = \App\Category::all()->take(11); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
							$brands = array();
						?>
						<li class="position-static category-nav-element" data-id="<?php echo e($category->id); ?>">
							<a href="<?php echo e(route('products.category', $category->slug)); ?>"><?php echo e(__($category->name)); ?> <i class="ion-ios-arrow-down"></i></a>
							<?php if(count($category->subcategories)>0): ?>
								<ul class="mega-menu sub-cat-menu c-scrollbar">
									<li class="c-preloader">
										<i class="fa fa-spin fa-spinner"></i>
									</li>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </ul>
            </div>
         </div>
      </div>
   </nav>
    header bottom end -->
   <!-- header End -->
</header>
	<div class="header bg-white hh">
    <!-- Top Bar -->
   
    <!-- END Top Bar -->
    
    
    <!-- offcanvas-overlay start -->
    <div class="offcanvas-overlay"></div>
    <!-- offcanvas-mobile-menu start -->
<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
    <div class="inner">
        <div class="menu-header">
            <div class="border-bottom mb-4 pb-4 text-right">
                <button class="offcanvas-close">×</button>
            </div>
            <?php if(auth()->guard()->check()): ?>
                <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                    <?php if(Auth::user()->avatar_original != null): ?>
                        <div class="image " style="background-image:url('<?php echo e(my_asset(Auth::user()->avatar_original)); ?>')"></div>
                    <?php else: ?>
                        <div class="image " style="background-image:url('<?php echo e(my_asset('frontend/images/user.png')); ?>')"></div>
                    <?php endif; ?>
                    <div class="name"><b>Hello, <?php $explodeNameArry = explode(' ',Auth::user()->name); echo $explodeNameArry[0]; ?></b></div>
                </div>
                <!-- <div class="side-login px-3 pb-3">
                    <a href="<?php echo e(route('logout')); ?>"><?php echo e(translate('Sign Out')); ?></a>
                </div>
                <div class="side-login px-3 pb-3">
                    <a href="<?php echo e(route('logout')); ?>"><?php echo e(translate('Sign Out')); ?></a>
                </div> -->
            <?php else: ?>
                <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                        <div class="image " style="background-image:url('<?php echo e(my_asset('frontend/images/icons/user-placeholder.jpg')); ?>')"></div>
                </div>
                <div class="side-login px-3 pb-3">
                    <a href="<?php echo e(route('user.login')); ?>"><?php echo e(translate('Sign In')); ?></a>
                    <a href="<?php echo e(route('user.registration')); ?>"><?php echo e(translate('Registration')); ?></a>
                </div>
            <?php endif; ?>
        </div>
       
        <nav class="offcanvas-menu">
            <ul>
                <li  class="active ml-0">
                    <a href="<?php echo e(route('home')); ?>">
                        <i class="la la-home"></i>
                        <span><?php echo e(translate('Home')); ?></span>
                    </a>
                </li>
                <?php $__currentLoopData = \App\Category::all()->take(11); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
						$brands = array();
					?>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span> <?php echo e(__($category->name)); ?></span>
                      </a>
                      <?php if(count($category->subcategories)>0): ?>
                        <ul class="dropdown-menu ml-0" aria-labelledby="navbarDropdown">
                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a  href="<?php echo e(route('products.subcategory', $subcategory->slug)); ?>">- <?php echo e(__($subcategory->name)); ?></a></li>
                                <?php $__currentLoopData = $subcategory->subsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('products.subsubcategory', $subsubcategory->slug)); ?>">-- <?php echo e(__($subsubcategory->name)); ?></a></li>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                      <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            <!--<?php $__currentLoopData = \App\Category::all()->take(11); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            	$brands = array();
            ?>
            <li data-id="<?php echo e($category->id); ?>">
            	<a href="<?php echo e(route('products.category', $category->slug)); ?>" style="color:black;"><?php echo e(__($category->name)); ?> </a>
            	<?php if(count($category->subcategories)>0): ?>
            		<ul class="offcanvas-submenu">
            		    <li><i class="fa fa-spin fa-spinner"></i></li>
            		</ul>
            		<?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul class="sub-cat-items">
                                <li class="sub-cat-name">
                                    <a href="<?php echo e(route('products.subcategory', $subcategory->slug)); ?>" style="margin-bottom:12px;"><?php echo e(__($subcategory->name)); ?></a>
                                    <ul class="">
                                        <?php $__currentLoopData = $subcategory->subsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('products.subsubcategory', $subsubcategory->slug)); ?>"><?php echo e(__($subsubcategory->name)); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            	<?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
				
                <?php if(auth()->guard()->check()): ?>
                <li><a href="<?php echo e(route('profile')); ?>"><?php echo e(translate('Your Account')); ?></a></li>
                <?php if(Auth::user()->user_type == 'customer'): ?>
                <li><a href="<?php echo e(route('purchase_history.index')); ?>?order_status=all_orders"><?php echo e(translate('Your Orders')); ?></a></li>
                <?php else: ?>
                <li><a href="<?php echo e(route('orders.index')); ?>"><?php echo e(translate('Your Orders')); ?></a></li>
                <?php endif; ?>
                <li><a href="<?php echo e(route('wishlists.index')); ?>"><?php echo e(translate('Your Wish List')); ?></a></li>
                <li><a href="<?php echo e(route('logout')); ?>" class="top-bar-item"><?php echo e(translate('Logout')); ?></a></li>
                    <?php
                        $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', '1')->get();
                    ?>
                    <?php if(\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1): ?>
                        <li>
                            <a href="<?php echo e(route('conversations.index')); ?>" class="<?php echo e(areActiveRoutesHome(['conversations.index', 'conversations.show'])); ?>">
                                <i class="la la-comment"></i>
                                <span class="category-name">
                                    <?php echo e(translate('Conversations')); ?>

                                    <?php if(count($conversation) > 0): ?>
                                        <span class="ml-2" style="color:green"><strong>(<?php echo e(count($conversation)); ?>)</strong></span>
                                    <?php endif; ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!--<li>-->
                <!--    <a href="<?php echo e(route('compare')); ?>">-->
                <!--        <i class="la la-refresh"></i>-->
                <!--        <span><?php echo e(translate('Compare')); ?></span>-->
                <!--        <?php if(Session::has('compare')): ?>-->
                <!--            <span class="badge" id="compare_items_sidenav"><?php echo e(count(Session::get('compare'))); ?></span>-->
                <!--        <?php else: ?>-->
                <!--            <span class="badge" id="compare_items_sidenav">0</span>-->
                <!--        <?php endif; ?>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <a href="<?php echo e(route('cart')); ?>">-->
                <!--        <i class="la la-shopping-cart"></i>-->
                <!--        <span><?php echo e(translate('Cart')); ?></span>-->
                <!--        <?php if(Session::has('cart')): ?>-->
                <!--            <span class="badge" id="cart_items_sidenav"><?php echo e(count(Session::get('cart'))); ?></span>-->
                <!--        <?php else: ?>-->
                <!--            <span class="badge" id="cart_items_sidenav">0</span>-->
                <!--        <?php endif; ?>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li>-->
                <!--    <a href="<?php echo e(route('wishlists.index')); ?>">-->
                <!--        <i class="la la-heart-o"></i>-->
                <!--        <span><?php echo e(translate('Wishlist')); ?></span>-->
                <!--    </a>-->
                <!--</li>-->

                <!--<?php if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1): ?>-->
                <!--<li>-->
                <!--    <a href="<?php echo e(route('customer_products.index')); ?>">-->
                <!--        <i class="la la-diamond"></i>-->
                <!--        <span><?php echo e(translate('Classified Products')); ?></span>-->
                <!--    </a>-->
                <!--</li>-->
                <!--<?php endif; ?>-->

                <!--<?php if(\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1): ?>-->
                <!--    <li>-->
                <!--        <a href="<?php echo e(route('wallet.index')); ?>">-->
                <!--            <i class="la la-dollar"></i>-->
                <!--            <span><?php echo e(translate('My Wallet')); ?></span>-->
                <!--        </a>-->
                <!--    </li>-->
                <!--<?php endif; ?>-->

                <!--<li>-->
                <!--    <a href="<?php echo e(route('profile')); ?>">-->
                <!--        <i class="la la-user"></i>-->
                <!--        <span><?php echo e(translate('Manage Profile')); ?></span>-->
                <!--    </a>-->
                <!--</li>-->

                <?php
                $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                ?>
                <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                    <li>
                        <a href="<?php echo e(route('customer_refund_request')); ?>" class="<?php echo e(areActiveRoutesHome(['customer_refund_request'])); ?>">
                            <i class="la la-file-text"></i>
                            <span class="category-name">
                                <?php echo e(translate('Sent Refund Request')); ?>

                            </span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($club_point_addon != null && $club_point_addon->activated == 1): ?>
                    <li>
                        <a href="<?php echo e(route('earnng_point_for_user')); ?>" class="<?php echo e(areActiveRoutesHome(['earnng_point_for_user'])); ?>">
                            <i class="la la-dollar"></i>
                            <span class="category-name">
                                <?php echo e(translate('Earning Points')); ?>

                            </span>
                        </a>
                    </li>
                <?php endif; ?>

                <!--<li>-->
                <!--    <a href="<?php echo e(route('support_ticket.index')); ?>" class="<?php echo e(areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])); ?>">-->
                <!--        <i class="la la-support"></i>-->
                <!--        <span class="category-name">-->
                <!--            <?php echo e(translate('Support Ticket')); ?>-->
                <!--        </span>-->
                <!--    </a>-->
                <!--</li>-->
            </ul>
        </nav>
        <div class="offcanvas-social py-30">
            <ul>
                <li>
                    <a href="#"><i class="icon-social-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- offcanvas-mobile-menu end -->

    <!-- mobile menu -->
    <div class="mobile-side-menu d-lg-none d-none">
        <div class="side-menu-overlay opacity-0" onclick="sideMenuClose()"></div>
        <div class="side-menu-wrap opacity-0">
            <div class="side-menu closed">
                <div class="side-menu-header ">
                    <div class="side-menu-close" onclick="sideMenuClose()">
                        <i class="la la-close"></i>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                            <?php if(Auth::user()->avatar_original != null): ?>
                                <div class="image " style="background-image:url('<?php echo e(my_asset(Auth::user()->avatar_original)); ?>')"></div>
                            <?php else: ?>
                                <div class="image " style="background-image:url('<?php echo e(my_asset('frontend/images/user.png')); ?>')"></div>
                            <?php endif; ?>

                            <div class="name"><?php echo e(Auth::user()->name); ?></div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="<?php echo e(route('logout')); ?>"><?php echo e(translate('Sign Out')); ?></a>
                        </div>
                    <?php else: ?>
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                                <div class="image " style="background-image:url('<?php echo e(my_asset('frontend/images/icons/user-placeholder.jpg')); ?>')"></div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="<?php echo e(route('user.login')); ?>"><?php echo e(translate('Sign In')); ?></a>
                            <a href="<?php echo e(route('user.registration')); ?>"><?php echo e(translate('Registration')); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="side-menu-list px-3">
                    <ul class="side-user-menu">
                        <li>
                            <a href="<?php echo e(route('home')); ?>">
                                <i class="la la-home"></i>
                                <span><?php echo e(translate('Home')); ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('dashboard')); ?>">
                                <i class="la la-dashboard"></i>
                                <span><?php echo e(translate('Dashboard')); ?></span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo e(route('purchase_history.index')); ?>">
                                <i class="la la-file-text"></i>
                                <span><?php echo e(translate('Purchase History')); ?></span>
                            </a>
                        </li>
                        <?php if(auth()->guard()->check()): ?>
                            <?php
                                $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', '1')->get();
                            ?>
                            <?php if(\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1): ?>
                                <li>
                                    <a href="<?php echo e(route('conversations.index')); ?>" class="<?php echo e(areActiveRoutesHome(['conversations.index', 'conversations.show'])); ?>">
                                        <i class="la la-comment"></i>
                                        <span class="category-name">
                                            <?php echo e(translate('Conversations')); ?>

                                            <?php if(count($conversation) > 0): ?>
                                                <span class="ml-2" style="color:green"><strong>(<?php echo e(count($conversation)); ?>)</strong></span>
                                            <?php endif; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('compare')); ?>">
                                <i class="la la-refresh"></i>
                                <span><?php echo e(translate('Compare')); ?></span>
                                <?php if(Session::has('compare')): ?>
                                    <span class="badge" id="compare_items_sidenav"><?php echo e(count(Session::get('compare'))); ?></span>
                                <?php else: ?>
                                    <span class="badge" id="compare_items_sidenav">0</span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('cart')); ?>">
                                <i class="la la-shopping-cart"></i>
                                <span><?php echo e(translate('Cart')); ?></span>
                                <?php if(Session::has('cart')): ?>
                                    <span class="badge" id="cart_items_sidenav"><?php echo e(count(Session::get('cart'))); ?></span>
                                <?php else: ?>
                                    <span class="badge" id="cart_items_sidenav">0</span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('wishlists.index')); ?>">
                                <i class="la la-heart-o"></i>
                                <span><?php echo e(translate('Wishlist')); ?></span>
                            </a>
                        </li>

                        <?php if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1): ?>
                        <li>
                            <a href="<?php echo e(route('customer_products.index')); ?>">
                                <i class="la la-diamond"></i>
                                <span><?php echo e(translate('Classified Products')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1): ?>
                            <li>
                                <a href="<?php echo e(route('wallet.index')); ?>">
                                    <i class="la la-dollar"></i>
                                    <span><?php echo e(translate('My Wallet')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="<?php echo e(route('profile')); ?>">
                                <i class="la la-user"></i>
                                <span><?php echo e(translate('Manage Profile')); ?></span>
                            </a>
                        </li>

                        <?php
                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                        $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                        ?>
                        <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                            <li>
                                <a href="<?php echo e(route('customer_refund_request')); ?>" class="<?php echo e(areActiveRoutesHome(['customer_refund_request'])); ?>">
                                    <i class="la la-file-text"></i>
                                    <span class="category-name">
                                        <?php echo e(translate('Sent Refund Request')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if($club_point_addon != null && $club_point_addon->activated == 1): ?>
                            <li>
                                <a href="<?php echo e(route('earnng_point_for_user')); ?>" class="<?php echo e(areActiveRoutesHome(['earnng_point_for_user'])); ?>">
                                    <i class="la la-dollar"></i>
                                    <span class="category-name">
                                        <?php echo e(translate('Earning Points')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="<?php echo e(route('support_ticket.index')); ?>" class="<?php echo e(areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])); ?>">
                                <i class="la la-support"></i>
                                <span class="category-name">
                                    <?php echo e(translate('Support Ticket')); ?>

                                </span>
                            </a>
                        </li>

                    </ul>
                    <?php if(Auth::check() && Auth::user()->user_type == 'seller'): ?>
                        <div class="sidebar-widget-title py-0">
                            <span><?php echo e(translate('Shop Options')); ?></span>
                        </div>
                        <ul class="side-seller-menu">
                            <li>
                                <a href="<?php echo e(route('seller.products')); ?>">
                                    <i class="la la-diamond"></i>
                                    <span><?php echo e(translate('Products')); ?></span>
                                </a>
                            </li>

                            <?php if(\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated): ?>
                                <li>
                                    <a href="<?php echo e(route('poin-of-sales.seller_index')); ?>">
                                        <i class="la la-fax"></i>
                                        <span>
                                            <?php echo e(translate('POS Manager')); ?>

                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li>
                                <a href="<?php echo e(route('orders.index')); ?>">
                                    <i class="la la-file-text"></i>
                                    <span><?php echo e(translate('Orders')); ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('shops.index')); ?>">
                                    <i class="la la-cog"></i>
                                    <span><?php echo e(translate('Shop Setting')); ?></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('withdraw_requests.index')); ?>">
                                    <i class="la la-money"></i>
                                    <span>
                                        <?php echo e(translate('Money Withdraw')); ?>

                                    </span>
                                </a>
                            </li>

                            <?php
                                $conversation = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', '1')->get();
                            ?>
                            <?php if(\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1): ?>
                                <li>
                                    <a href="<?php echo e(route('conversations.index')); ?>" class="<?php echo e(areActiveRoutesHome(['conversations.index', 'conversations.show'])); ?>">
                                        <i class="la la-comment"></i>
                                        <span class="category-name">
                                            <?php echo e(translate('Conversations')); ?>

                                            <?php if(count($conversation) > 0): ?>
                                                <span class="ml-2" style="color:green"><strong>(<?php echo e(count($conversation)); ?>)</strong></span>
                                            <?php endif; ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li>
                                <a href="<?php echo e(route('payments.index')); ?>">
                                    <i class="la la-cc-mastercard"></i>
                                    <span><?php echo e(translate('Payment History')); ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="sidebar-widget-title py-0">
                            <span><?php echo e(translate('Earnings')); ?></span>
                        </div>
                        <div class="widget-balance py-3">
                            <div class="text-center">
                                <div class="heading-4 strong-700 mb-4">
                                    <?php
                                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-30d'))->get();
                                        $total = 0;
                                        foreach ($orderDetails as $key => $orderDetail) {
                                            if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                $total += $orderDetail->price;
                                            }
                                        }
                                    ?>
                                    <small class="d-block text-sm alpha-5 mb-2"><?php echo e(translate('Your earnings (current month)')); ?></small>
                                    <span class="p-2 bg-base-1 rounded"><?php echo e(single_price($total)); ?></span>
                                </div>
                                <table class="text-left mb-0 table w-75 m-auto">
                                    <tbody>
                                        <tr>
                                            <?php
                                                $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                                $total = 0;
                                                foreach ($orderDetails as $key => $orderDetail) {
                                                    if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                        $total += $orderDetail->price;
                                                    }
                                                }
                                            ?>
                                            <td class="p-1 text-sm">
                                                <?php echo e(translate('Total earnings')); ?>:
                                            </td>
                                            <td class="p-1">
                                                <?php echo e(single_price($total)); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-60d'))->where('created_at', '<=', date('-30d'))->get();
                                                $total = 0;
                                                foreach ($orderDetails as $key => $orderDetail) {
                                                    if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                        $total += $orderDetail->price;
                                                    }
                                                }
                                            ?>
                                            <td class="p-1 text-sm">
                                                <?php echo e(translate('Last Month earnings')); ?>:
                                            </td>
                                            <td class="p-1">
                                                <?php echo e(single_price($total)); ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end mobile menu -->

</div>


<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title"><?php echo e(translate('Cart Items')); ?></span>
            <button class="offcanvas-close">×</button>
        </div>
		<div id="sidebarCartItem">
			<ul class="minicart-product-list">
				<?php if(Session::has('cart')): ?>
				<?php	
					$total = 0;	
				?>	
				<?php if(count($cart = Session::get('cart')) > 0): ?>	
											
								
						<?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php									
								$product = \App\Product::find($cartItem['id']);		
								$total = $total + ($cartItem['price']+$cartItem['tax'])*$cartItem['quantity'];
							?>	
							<li>
								<a href="#" class="image">
									<img src="<?php echo e(my_asset('frontend/images/placeholder.jpg')); ?>" data-src="<?php echo e(my_asset($product->thumbnail_img)); ?>" class="img-fluid lazyload" alt="<?php echo e(__($product->name)); ?>">
								</a>
								<div class="content">
									<a href="#" class="title"><?php echo e(__($product->name)); ?></a>
									<span class="quantity-price">x<?php echo e($cartItem['quantity']); ?> <span class="amount"><?php echo e(single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity'])); ?></span></span>
									<a href="#" class="remove" onclick="removeFromCart(<?php echo e($key); ?>)">×</a>
								</div>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					<?php else: ?>
					<li><?php echo e(translate('Your Cart is empty')); ?></li>
					<?php endif; ?>
					
					
			</ul>
			<div class="sub-total d-flex flex-wrap justify-content-between">
				<strong>Subtotal :</strong>
				<span class="amount"><?php echo e(single_price($total)); ?></span>
			</div>
			<a href="<?php echo e(route('cart')); ?>" class="btn theme--btn-default btn--lg d-block d-sm-inline-block rounded-5 mr-sm-2">view
				cart</a>
			<a href="<?php echo e(route('checkout.shipping_info')); ?>" class="btn theme-btn--dark1 btn--lg d-block d-sm-inline-block mt-4 mt-sm-0 rounded-5">checkout</a>
			<?php endif; ?>
		</div>
    </div>
</div>
<!-- OffCanvas Cart End -->
<?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/inc/nav.blade.php ENDPATH**/ ?>