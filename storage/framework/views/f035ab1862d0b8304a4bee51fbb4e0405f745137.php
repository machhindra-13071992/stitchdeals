
<style>.slider-item {    width: 20%;    padding: 10px;}.product-slider-init.theme1.slick-nav {    display: flex;    flex-wrap: wrap;} .product-slider-init .slick-list {
    width: 100%;
    
}
    @media  screen and (min-width: 768px) {


    .mystyle
    {
        width : 19.666667% !important;
    }
}
@media  screen and (max-width: 768px) {
    .mystyleimg
    {
        object-fit:contain !important;
        background:#fff ;
    }
}

    .myclass
    {
        -webkit-box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);
        box-shadow: 0 4px 12px 0 rgba(0,0,0,.05);
        margin-bottom: 20px;
    }
</style>
<?php if(\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1): ?>
	<div class="col-12">
		<div class="tab-content" id="pills-tabContent">
		    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="row grid-view theme1"> <?php $__currentLoopData = filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(30)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-sm-6 col-lg-2 col-xl-2 mb-30 mystyle">
						<div class="product-list mb-30">
							<div class="card product-card">
								<div class="card-body p-3">
									<div class="media flex-column">
										<div class="product-thumbnail position-relative"> 
											<span class="badge badge-danger top-right">New</span> 
											<a href="<?php echo e(route('product', $product->slug)); ?>">												
												<img class="img-fit mx-auto mystyleimg" src="<?php echo e(my_asset($product->thumbnail_img)); ?>" onmouseover="scroll_slider(<?php echo e($product->id); ?>,0)" id="best_selling_main_image<?php echo e($product->id); ?>" data-src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="<?php echo e(__($product->name)); ?>">											
											</a>
                                            <?php if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0): ?>
                                                <div class="scrollSlider" style="display:none" id="best_selling_product<?php echo e($product->id); ?>">
                                                    
                                                </div>
                                            <?php endif; ?>
										</div>
										<div class="media-body">
											<div class="product-desc py-0">
											   <a href="<?php echo e(route('product', $product->slug)); ?>" style="color: black;font-weight: bolder;font-size: 14px;"><?php echo e(__($product->brand->name)); ?></a> 
												    <h3 class="title" style="font-weight:bolder;">
														<a href="<?php echo e(route('product', $product->slug)); ?>" style="font-size: 13px;"><?php echo e(__($product->name)); ?></a>
													</h3>
                                                    <?php if($product->size_heading != null): ?>
                                                        <?php
                                                        $size_headings = json_decode($product->size_heading);
                                                        ?>
                                                        <?php if(isset($size_headings[0]) && $size_headings[0] != ""): ?>
                                                            <div class="star-rating">
                                                                Sizes:
                                                                <?php $__currentLoopData = $size_headings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $size_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php echo e($size_name); ?>

                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>    
												<!-- 	<div class="star-rating"> 
														<?php echo e(renderStarRating($product->rating)); ?> 
													</div> -->
													
													<div class="d-flex align-items-center justify-content-between">
														<h6 class="product-price">
															<?php if(home_base_price($product->id) != home_discounted_base_price($product->id)): ?>
															<del class="old-product-price strong-400" style="color:lightgrey;"><?php echo e(home_base_price($product->id)); ?></del><span style="font-size: 11px;margin-left: 6%;color: red;"><?php echo e($product->discount); ?>% Off</span>
															<?php endif; ?>
															<?php echo e(home_discounted_base_price($product->id)); ?>

															<!--<?php if(home_base_price($product->id) != home_discounted_price($product->id)): ?> <span class="badge position-static bg-dark rounded-0">Save <?php echo e($product->discount); ?>%</span> <?php endif; ?>-->
														</h6>
														<button type="button" class="pro-btn" title="Add to Cart" onclick="showAddToCartModal(<?php echo e($product->id); ?>)"><i class="icon-basket"></i></button>
													</div>
												</div>
										</div>
									</div>
								</div>
							</div>
							<!-- product-list End -->
						</div>
					</div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div>
			</div>
		</div>
	</div>
<!--<section class="mb-4">
        <div class="container">
            <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                <div class="section-title-1 clearfix">
                    <h3 class="heading-5 strong-700 mb-0 float-left">
                        <span class="mr-4"><?php echo e(translate('Best Selling')); ?></span>
                    </h3>
                    <ul class="inline-links float-right">
                        <li><a  class="active"><?php echo e(translate('Top 20')); ?></a></li>
                    </ul>
                </div>
                <div class="caorusel-box arrow-round gutters-5">
                    <div class="slick-carousel" data-slick-items="3" data-slick-lg-items="2"  data-slick-md-items="2" data-slick-sm-items="1" data-slick-xs-items="1" data-slick-rows="2">
                        <?php $__currentLoopData = filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(20)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="caorusel-card my-1">
                                <div class="row no-gutters product-box-2 align-items-center">
                                    <div class="col-4">
                                        <div class="position-relative overflow-hidden h-100">
                                            <a href="<?php echo e(route('product', $product->slug)); ?>" class="d-block product-image h-100">
                                                <img class="img-fit lazyload mx-auto" src="<?php echo e(my_asset('frontend/images/placeholder.jpg')); ?>" data-src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="<?php echo e(__($product->name)); ?>">
                                            </a>
                                            <div class="product-btns">
                                                <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList(<?php echo e($product->id); ?>)">
                                                    <i class="la la-heart-o"></i>
                                                </button>
                                                <button class="btn add-compare" title="Add to Compare" onclick="addToCompare(<?php echo e($product->id); ?>)">
                                                    <i class="la la-refresh"></i>
                                                </button>
                                                <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal(<?php echo e($product->id); ?>)">
                                                    <i class="la la-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-8 border-left">
                                        <div class="p-3">
                                            <h2 class="product-title mb-0 p-0 text-truncate-2">
                                                <a href="<?php echo e(route('product', $product->slug)); ?>"><?php echo e(__($product->name)); ?></a>
                                            </h2>
                                            <div class="star-rating star-rating-sm mb-2">
                                                <?php echo e(renderStarRating($product->rating)); ?>

                                            </div>
                                            <div class="clearfix">
                                                <div class="price-box float-left">
                                                    <?php if(home_base_price($product->id) != home_discounted_base_price($product->id)): ?>
                                                        <del class="old-product-price strong-400"><?php echo e(home_base_price($product->id)); ?></del>
                                                    <?php endif; ?>
                                                    <span class="product-price strong-600">
                                                        <?php echo e(home_discounted_base_price($product->id)); ?>

                                                    </span>
                                                </div>
                                                <div class="float-right">
                                                    <button class="add-to-cart btn" title="Add to Cart" onclick="showAddToCartModal(<?php echo e($product->id); ?>)">
                                                        <i class="la la-shopping-cart"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
<?php endif; ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/partials/best_selling_section.blade.php ENDPATH**/ ?>