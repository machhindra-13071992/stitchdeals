<style>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css"/>
<style>
  /* slider-wrapper */
  .slider-wrapper {
    display: flex;
    position: relative;
    width: 100%;
    height: 0vw;
    max-height: 500px;
    min-height: 300px;
    background: #ddd;
    overflow: hidden;
  }

  .slider-wrapper ul {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .scrollSlider {
  	bottom: 0px !important;
  }

  /* slider-img */
  ul.slider-img {
    display: flex;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    transition: 0.5s;
  }

  ul.slider-img li {
    flex: 1 0 100%;
  }

  ul.slider-img li img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* slider-arrow */
  ul.slider-arrow {
    position: relative;
    color: #fff;
    font-size: 2rem;
    display: flex;
    justify-content: space-between;
    height: 100%;
    width: 100%;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
  }

  @media  screen and (min-width: 768px) {
    ul.slider-arrow {
      font-size: 2.5rem;
    }
  }

  ul.slider-arrow li {
    display: flex;
    align-items: center;
    cursor: pointer;
    height: 100%;
    padding: 0 15px;
    opacity: 0.4;
    transition: 0.5s;
  }

  ul.slider-arrow li:hover {
    opacity: 1;
  }

  /* slider-dot */
  .slider-dot {
    position: absolute;
    bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    width: 100%;
    color: #fff;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
  }

  .slider-dot li {
    cursor: pointer;
    margin: 0 8px;
    font-size: 0.6rem;
    opacity: 0.4;
  }

  .slider-dot li.active {
    opacity: 1;
  }
  .filter-check-box input[type=radio]:checked+label {
    color: red;
}
.custom-chk.filter-check-box input[type=checkbox]+label:before {
    background-color: var(--my-color-var);
}
.filter-check-box.custom-chk input[type=checkbox]:checked+label:before, .theme1 .filter-check-box.custom-chk input[type=checkbox]:checked+label:before {
    border: 2px solid #565656;
    -webkit-transform: inherit;
    transform: inherit;
    width: 15px;
    border-radius: 3px;
    left: 0;
    top: 5px;
}

.filter-check-box.custom-chk input[type=checkbox]:checked+label:after, .theme1 .filter-check-box.custom-chk input[type=checkbox]:checked+label:after {
    content: "";
    border-radius: 0;
    opacity: 1;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    width: 10px;
    height: 15px;
    position: absolute;
    left: 6px;
    border: 2px solid;
    border-color: transparent #080808 #171616 transparent;
    top: 0px;
}

.check-box-inner { padding-top: 1px !important;}
.single_line { color:#161515 !important;margin-top: 10px;margin-bottom: 0px;}
.card { min-width: 208px !important;}
.scroll-v{max-height: 250px;overflow-y: scroll;}
  @media  screen and (min-width: 768px) {
    .slider-dot li {
      margin: 0 3px;
      font-size: 0.25rem;
    }
  }
</style>
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">


<?php if(isset($subsubcategory_id)): ?>
    <?php
        $meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
        $meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
    ?>
<?php elseif(isset($subcategory_id)): ?>
    <?php
        $meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
        $meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
    ?>
<?php elseif(isset($category_id)): ?>
    <?php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
    ?>
<?php elseif(isset($brand_id) && $brand_id != ""): ?>
    <?php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
    ?>
<?php else: ?>
    <?php
        $meta_title = env('APP_NAME');
        $meta_description = \App\SeoSetting::first()->description;
    ?>
<?php endif; ?>

<?php $__env->startSection('meta_title'); ?><?php echo e($meta_title); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('meta_description'); ?><?php echo e($meta_description); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e($meta_title); ?>">
    <meta itemprop="description" content="<?php echo e($meta_description); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="<?php echo e($meta_title); ?>">
    <meta name="twitter:description" content="<?php echo e($meta_description); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e($meta_title); ?>" />
    <meta property="og:description" content="<?php echo e($meta_description); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 bg-lighten2 pt-1 pb-1">
	<div class="container">
		<div class="row">
			<div class="col-12">
			</div>
			<div class="col-12">
				<ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-left">
					<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(translate('Home')); ?></a></li>
					<!--<li class="breadcrumb-item"><a href="#"><?php echo e(translate('All Categories')); ?></a></li> -->
					<?php if(isset($category_id)): ?>
						<li class="breadcrumb-item active"><?php echo e(\App\Category::find($category_id)->name); ?></li> 
					<?php endif; ?> 
					<?php if(isset($subcategory_id)): ?>
						<li class="breadcrumb-item"><a href="<?php echo e(route('products.category', \App\SubCategory::find($subcategory_id)->category->slug)); ?>"><?php echo e(\App\SubCategory::find($subcategory_id)->category->name); ?></a></li>                            
						<li class="breadcrumb-item active"><?php echo e(\App\SubCategory::find($subcategory_id)->name); ?></li>                        
					<?php endif; ?>                        
					<?php if(isset($subsubcategory_id)): ?>                            
						<li class="breadcrumb-item "><a href="<?php echo e(route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug)); ?>"><?php echo e(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name); ?></a></li>
						<li class="breadcrumb-item "><a href="<?php echo e(route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug)); ?>"><?php echo e(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name); ?></a></li>
						<li class="breadcrumb-item active"><?php echo e(\App\SubSubCategory::find($subsubcategory_id)->name); ?></li> 
					<?php endif; ?> 
				</ol>
			</div>
		</div>
	</div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<div class="product-tab bg-white pt-20 pb-50">
	<form class="" id="search-form" action="<?php echo e(route('search')); ?>" method="GET">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 mb-30">
					
					<?php if(isset($category_id)): ?>

						<input type="hidden" name="category" value="<?php echo e(\App\Category::find($category_id)->slug); ?>">

					<?php endif; ?>

					<?php if(isset($subcategory_id)): ?>

						<input type="hidden" name="subcategory" value="<?php echo e(\App\SubCategory::find($subcategory_id)->slug); ?>">

					<?php endif; ?>

					<?php if(isset($subsubcategory_id)): ?>

						<input type="hidden" name="subsubcategory" value="<?php echo e(\App\SubSubCategory::find($subsubcategory_id)->slug); ?>">

					<?php endif; ?>
					<div class="grid-nav-wraper bg-lighten2 mb-30">
						<div class="row align-items-center">
							<div class="col-12 col-md-8 mb-3 mb-md-0">
								<nav class="shop-grid-nav">
									<ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"> <i class="fa fa-th"></i> </a>
										</li>
										<!--<li> <span class="total-products text-capitalize">There are 13 products.</span></li>-->
									</ul>
								</nav>
							</div>
							<div class="col-12 col-md-4 position-relative">
								<div class="shop-grid-button d-flex align-items-center"> 
									<span class="sort-by"><?php echo e(translate('Sort by')); ?></span>
									<select class="form-control" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
										<option value="1" <?php if(isset($sort_by)): ?> <?php if($sort_by == '1'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Newest')); ?></option>
										<option value="5" <?php if(isset($sort_by)): ?> <?php if($sort_by == '5'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Best seller')); ?></option>
										<option value="2" <?php if(isset($sort_by)): ?> <?php if($sort_by == '2'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Oldest')); ?></option>
										<option value="3" <?php if(isset($sort_by)): ?> <?php if($sort_by == '3'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Price low to high')); ?></option>
										<option value="4" <?php if(isset($sort_by)): ?> <?php if($sort_by == '4'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Price high to low')); ?></option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<!-- product-tab-nav end -->
					<div class="tab-content" id="pills-tabContent">
						<!-- first tab-pane -->
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
							<div class="row grid-view theme1">
								 <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 col-lg-2 col-xl-2 mb-30 mystyle" >
                                        <div class="card product-card">
											<div class="card-body">
												
												<div class="product-thumbnail position-relative"> 
													<span class="badge badge-danger top-right">New</span>
													<a href="<?php echo e(route('product', $product->slug)); ?>"> 
														<div class="slider-wrapper">
	                                                        <ul class="slider-img mystyleimg" >
		                                                       <li>
		                                                            <img src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="" class="mystyleimg" onmouseover="scroll_slider(<?php echo e($product->id); ?>,0)" id="best_selling_main_image<?php echo e($product->id); ?>" data-src="<?php echo e(my_asset($product->thumbnail_img)); ?>"/>
		                                                         </li>
	                                                        </ul>
	                                                        <?php if(is_array(json_decode($product->photos)) && count(json_decode($product->photos)) > 0): ?>
				                                                <div class="scrollSlider" style="display:none" id="best_selling_product<?php echo e($product->id); ?>">
				                                                    
				                                                </div>
				                                            <?php endif; ?>
                                                    	</div>
														<!-- <img class="first-img img-fit lazyload" src="<?php echo e(my_asset('frontend/images/placeholder.jpg')); ?>" data-src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="<?php echo e(__($product->name)); ?>"> -->
													</a>
													<!-- product links -->
													<!-- <ul class="product-links d-flex justify-content-center">
														<li>
															<a href="javascript:voide()" onclick="showAddToCartModal(<?php echo e($product->id); ?>)"> <span data-toggle="tooltip" data-placement="bottom" title="Quick view" class="icon-magnifier"></span> </a>
															
														</li>
													</ul> -->
													<!-- product links end-->
												</div>
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
														<button class="pro-btn" type="button" onclick="showAddToCartModal(<?php echo e($product->id); ?>)"><i class="icon-basket"></i></button>
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
								
								
							</div>
						</div>
						<!-- second tab-pane -->
					</div>
					<div class="row">
						<div class="col-12">
							<nav class="pagination-section mt-30">
								<div class="row align-items-center">
									<div class="col-12">
										<ul class="pagination justify-content-center">
											<?php echo e($products->links()); ?>

										</ul>
									</div>
								</div>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-lg-2 mb-30 order-lg-first">
					<aside class="left-sidebar theme1" style="padding: 0.5ex;/* min-width: 200px; *//* height:300px; *//* background-color: #333; */color: #fff;font-size: 2em;border-radius: 0.5ex;position: sticky;top: -.3em;/* z-index: 10000; */">
						<!-- search-filter start -->
						<div class="search-filter" style="border: 1px solid #e4e4e4;padding-left: 11px;padding-right: 27px;padding-bottom:20px;">
							<form action="#">
								<div class="check-box-inner mt-10">
									<h4 class="title">FILTER BY</h4>
								</div>
								<!-- check-box-inner -->
                <div class="check-box-inner mt-10">
										<a href="javascript:void(0)" onclick="toogleSideFilters('brand');"><h4 class="sub-title" id="show-hidden-menu"> <?php if($request->has('brand')): ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php else: ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php endif; ?> brands</h4></a> 
										<div class="brand-hidden-menu" <?php if($request->has('brand')): ?> style="display: block;" <?php else: ?> style="display: block;" <?php endif; ?>>
                         <?php $__currentLoopData = \App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <div class="filter-check-box brand-<?php echo e($brand->name); ?>">
                            <?php if(in_array($brand->id, $product_exit_brand_ids)): ?>  
                            <input type="checkbox" name="brand[]" value="<?php echo e($brand->slug); ?>" id="brand-<?php echo e($brand->name); ?>" <?php if(isset($brand_id)): ?> <?php if(in_array($brand->id, $brand_ids)): ?> checked <?php endif; ?> <?php endif; ?> onchange="filter()">
                            <label for="brand-<?php echo e($brand->name); ?>" value="<?php echo e($brand->slug); ?>"><?php echo e($brand->name); ?></label>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
                </div>
                <hr class="single_line">
								<div class="check-box-inner mt-10">
									<a href="javascript:void(0)"><h4 class="sub-title" id="show-hidden-menu">Price</h4></a>
									<div class="price-filter mt-10">
										<div class="price-slider-amount"> 
											<span class="range-slider-value value-low" <?php if(isset($min_price)): ?> data-range-value-low="<?php echo e($min_price); ?>" <?php elseif($products->min('unit_price') > 0): ?> data-range-value-low="<?php echo e($products->min('unit_price')); ?>" <?php else: ?> data-range-value-low="0" <?php endif; ?> id="input-slider-range-value-low"></span> - <span class="range-slider-value value-high" <?php if(isset($max_price)): ?> data-range-value-high="<?php echo e($max_price); ?>" <?php elseif($products->max('unit_price') > 0): ?> data-range-value-high="<?php echo e($products->max('unit_price')); ?>" <?php else: ?> data-range-value-high="0" <?php endif; ?> id="input-slider-range-value-high"></span>
										</div>
										<!-- Range slider container -->
										<!--<div id="input-slider-range" data-range-value-min="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->min('unit_price')); ?> <?php endif; ?>" data-range-value-max="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->max('unit_price')); ?> <?php endif; ?>"></div>-->
										<div id="input-slider-range" data-range-value-min="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->min('unit_price')); ?> <?php endif; ?>" data-range-value-max="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->max('unit_price')); ?> <?php endif; ?>"></div>
										<input type="hidden" name="min_price" value="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->min('unit_price')); ?> <?php endif; ?>">
										<input type="hidden" name="max_price" value="<?php if(count(\App\Product::query()->get()) < 1): ?> 0 <?php else: ?> <?php echo e(filter_products(\App\Product::query())->get()->max('unit_price')); ?> <?php endif; ?>">
									</div>
									<hr class="single_line">
                  <?php if($attributes): ?>
									<div class="check-box-inner mt-10">				
										<?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if(\App\Attribute::find($attribute['id']) != null): ?>
												<a href="javascript:void(0)" onclick="toogleSideFilters('size');"><h4 class="sub-title" id="show-hidden-menu"><?php if(isset($selected_attributes) && count($selected_attributes) > 0): ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php else: ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php endif; ?> <?php echo e(\App\Attribute::find($attribute['id'])->name); ?></h4></a>
												<div class="size-hidden-menu scroll-v" <?php if(isset($selected_attributes) && count($selected_attributes) > 0): ?> style="display: block;" <?php else: ?> style="display: block;" <?php endif; ?> >
                        <?php if(array_key_exists('values', $attribute)): ?>
													<?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<?php
															$flag = false;
															if(isset($selected_attributes)){
																foreach ($selected_attributes as $key => $selected_attribute) {
																	if($selected_attribute['id'] == $attribute['id']){
																		if(in_array($value, $selected_attribute['values'])){
																			$flag = true;
																			break;
																		}
																	}
																}
															}
														?>
														<div class="filter-check-box">
															<input type="checkbox" id="attribute_<?php echo e($attribute['id']); ?>_value_<?php echo e($value); ?>" name="attribute_<?php echo e($attribute['id']); ?>[]" value="<?php echo e($value); ?>" <?php if($flag): ?> checked <?php endif; ?> onchange="filter()">
															<label for="attribute_<?php echo e($attribute['id']); ?>_value_<?php echo e($value); ?>"><?php echo e($value); ?></label>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												<?php endif; ?>
                        </div>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
                  <hr class="single_line">
                  <?php endif; ?>
									<!-- check-box-inner -->
									<div class="check-box-inner mt-10">
										<a href="javascript:void(0)" onclick="toogleSideFilters('color');"><h4 class="sub-title" id="show-hidden-menu"><?php if($request->has('color')): ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php else: ?> <i class="fas fa-angle-down" aria-hidden="true"></i> <?php endif; ?> color</h4></a>
										<div class="color-hidden-menu scroll-v" <?php if($request->has('color')): ?> style="display: block;" <?php else: ?> style="display: block;" <?php endif; ?>>
                    <?php $__currentLoopData = $all_colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="filter-check-box custom-chk color-<?php echo e($key); ?>">
												<input type="checkbox" id="color-<?php echo e($key); ?>" name="color[]" value="<?php echo e($color); ?>" <?php if(isset($selected_color) && in_array($color, $selected_color)): ?> checked <?php endif; ?> onchange="filter()">
												<label style="--my-color-var: <?php echo e($color); ?>;" for="color-<?php echo e($key); ?>" data-toggle="tooltip" data-original-title="<?php echo e(\App\Color::where('code', $color)->first()->name); ?>"><?php echo e(\App\Color::where('code', $color)->first()->name); ?></label>
											</div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
									</div>
                                  
									<!-- check-box-inner -->
									<!--<div class="check-box-inner mt-10">
										<h4 class="sub-title">Brand</h4>
										<div class="filter-check-box">
											<input type="checkbox" id="20824">
											<label for="20824">Roadster<span>(5)</span></label>
										</div>
										<div class="filter-check-box">
											<input type="checkbox" id="20825">
											<label for="20825">PUMA<span>(8)</span></label>
										</div>
									</div>-->
									
							</form>
							</div>
							<!-- search-filter end -->
							<!--<div class="product-widget mb-60 mt-30">
								<h3 class="title">Product Tags</h3>
								<ul class="product-tag d-flex flex-wrap">
									<li><a href="#">shopping</a></li>
									<li><a href="#">New products</a></li>
									<li><a href="#">Accessories</a></li>
									<li><a href="#">sale</a></li>
								</ul>
							</div>-->
							<!--second banner start
							<div class="banner hover-animation position-relative overflow-hidden">
								<a href="#" class="d-block"> <img src="<?php echo e(my_asset('frontend/images/banner/2.jpg')); ?>" alt="img"> </a>
							</div>
							second banner end-->
					</aside>
					</div>
				</div>
			</div>
	</form>
	</div>
	<!-- product tab end -->
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
        function toogleSideFilters(filterName){
          $('.'+filterName+'-hidden-menu').slideToggle("fast");
          $('.'+filterName+'-hidden-menu').parent().find('i').toggleClass('fas fa-angle-right fas fa-angle-down');
        }
    </script>
        <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
    <script>
    function (slider) {
    //alert (slider);
    
        // Determine the total amount of images in the carousel.
      let sliderCount = $("#"+slider+"").find(".slider-img li img").length;
      //alert (sliderCount);
      //return false;
      // Load images into the carousel
      let sliderImg = $("#"+slider+"").find(".slider-img");
      // Define the navigation arrows and pagination bullets.
      let sliderArrow = `<ul class="slider-arrow" style="display:none;"><li class="arrow-left" role="button"><i class="fas fa-chevron-left"></i></li><li class="arrow-right" role="button"><i class="fas fa-chevron-right"></i></li></ul>`;
      let sliderDotLi = "";
      for (let i = 0; i < sliderCount; i++) {
        sliderDotLi += `<li><i class="fas fa-circle"></i></li>`;
      }
      let sliderDot = `<ul class="slider-dot">${sliderDotLi}</ul>`;
      $("#"+slider+"").append(sliderArrow + sliderDot);

      let activeDefaultCount = $(".slider-dot li.active").length;
      if (activeDefaultCount != 1) {
        $(".slider-dot li")
          .removeClass()
          .eq(0)
          .addClass("active");
      }
      let sliderIndex = $(".slider-dot li.active").index();
      sliderImg.css("left", -sliderIndex * 100 + "%");

      // switch between images
      function sliderPos() {
        sliderImg.css("left", -sliderIndex * 100 + "%");
        $(".slider-dot li")
          .removeClass()
          .eq(sliderIndex)
          .addClass("active");
      }

      $(".arrow-right").click(function() {
        sliderIndex >= sliderCount - 1 ? (sliderIndex = 0) : sliderIndex++;
        sliderPos();
      });

      $(".arrow-left").click(function() {
        sliderIndex <= 0 ? (sliderIndex = sliderCount - 1) : sliderIndex--;
        sliderPos();
      });

      $(".slider-dot li").click(function() {
        sliderIndex = $(this).index();
        sliderPos();
      });

      let goSlider = setInterval(() => {
        $(".arrow-right").click();
      }, 40000);

      $("#"+slider+"").on({
        mouseenter: () => {
           goSlider = setInterval(() => {
            $(".arrow-right").click();
          }, 3000);
          
        },
        mouseleave: () => {
          clearInterval(goSlider);
        }
      });
    }
     
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/product_listing.blade.php ENDPATH**/ ?>