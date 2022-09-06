<?php $__env->startSection('content'); ?>
<style>
ul.specification-list {
    list-style: none;
    padding-left: 0;
    display: flex;
    flex-wrap: wrap;
    margin: 0;
}

ul.specification-list>li {
    width: 23%;
    flex-basis: 23%;
    margin: 5px;
}
</style>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    <?php echo $__env->make('frontend.inc.seller_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        <?php echo e(translate('Update your product')); ?>

                                    </h2>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="<?php echo e(route('home')); ?>"><?php echo e(translate('Home')); ?></a></li>
                                            <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(translate('Dashboard')); ?></a></li>
                                            <li><a href="<?php echo e(route('seller.products')); ?>"><?php echo e(translate('Products')); ?></a></li>
                                            <li class="active"><a href="<?php echo e(route('seller.products.edit', $product->id)); ?>"><?php echo e(translate('Edit Product')); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" id="choice_form">
                            <input name="_method" type="hidden" value="POST">
                            <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                            <?php echo csrf_field(); ?>
                    		<input type="hidden" name="added_by" value="seller">

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('General')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Product Name')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="name" placeholder="<?php echo e(translate('Product Name')); ?>" value="<?php echo e(__($product->name)); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Product Category')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <?php if($product->subsubcategory != null): ?>
                                                <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category"><?php echo e($product->category->name.'>'.$product->subcategory->name.'>'.$product->subsubcategory->name); ?></div>
                                            <?php else: ?>
                                                <div class="form-control mb-3 c-pointer" data-toggle="modal" data-target="#categorySelectModal" id="product_category"><?php echo e($product->category->name.'>'.$product->subcategory->name); ?></div>
                                            <?php endif; ?>
                                            <input type="hidden" name="category_id" id="category_id" value="<?php echo e($product->category_id); ?>" required>
                                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="<?php echo e($product->subcategory_id); ?>" required>
                                            <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="<?php echo e($product->subsubcategory_id); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Product Brand')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker" data-placeholder="<?php echo e(translate('Select a brand')); ?>" id="brands" name="brand_id">
                                                    <option value=""><?php echo e(('Select Brand')); ?></option>
                                                    <?php $__currentLoopData = \App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($brand->id); ?>" <?php if($brand->id == $product->brand_id): ?> selected <?php endif; ?>><?php echo e($brand->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Product Unit')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="unit" placeholder="<?php echo e(translate('Product unit')); ?>" value="<?php echo e($product->unit); ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Minimum Qty')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control mb-3" name="min_qty" min="1" value="<?php if($product->min_qty <= 1): ?><?php echo e(1); ?><?php else: ?><?php echo e($product->min_qty); ?><?php endif; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Product Tag')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3 tagsInput" name="tags[]" placeholder="<?php echo e(translate('Type & hit enter')); ?>" data-role="tagsinput" value="<?php echo e($product->tags); ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Select Sizes')); ?></label>
                                        </div>
                						<div class="col-lg-10">
                						    <?php
                						        $size_Array = json_decode($product->sizes);
                						        $size_id = array();
                							?>
                							<?php $__currentLoopData = $size_Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                							    <?php 
                							        array_push($size_id, $array->size_id)
                							    ?>
                							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                							<select class="form-control demo-select2-size" name="size_id[]" id="size_id" multiple>
                								<?php $__currentLoopData = \App\Size::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                									<option value="<?php echo e($size->id); ?>" <?php if(in_array($size->id, $size_id)) echo 'selected'?> ><?php echo e($size->name); ?></option>
                								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                							</select>
                						</div>
                					</div>
                					<div class="size-group-conatiner" id="size-options">
                					    <?php if(!$size_Array == null): ?>
                					       
                					        <?php $__currentLoopData = $size_Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                							    <?php 
                							        $size_name = \App\Size::where('id', $option->size_id)->pluck('name')->toArray();
                							        $x = str_replace(' ', '_', strtolower($size_name[0]));
                                                    $name = trim(str_replace(array('(',')'),'',$x));
                                                    //print_r($option);
                							    ?>
                							    
                							    <div class="row mt-3" data="<?php echo e($name); ?>">
                        					        <label class="col-lg-2 control-label"><?php echo e($size_name[0]); ?> (Inches)</label>
                        					        <div class="col-lg-2">
                        					            <input type="number" class="form-control" name="<?php echo e($name); ?>[]" id="" value="<?php echo e($option->values[0]); ?>" placeholder="S">
                        					        </div>
                        					        <div class="col-lg-2">
                        					            <input type="number" class="form-control" name="<?php echo e($name); ?>[]" id="" value="<?php echo e($option->values[1]); ?>" placeholder="M">
                        					        </div>
                        					        <div class="col-lg-2">
                        					            <input type="number" class="form-control" name="<?php echo e($name); ?>[]" id="" value="<?php echo e($option->values[2]); ?>" placeholder="L">
                        					        </div>
                        					        <div class="col-lg-2">
                        					            <input type="number" class="form-control" name="<?php echo e($name); ?>[]" id="" value="<?php echo e($option->values[3]); ?>" placeholder="XL">
                        					        </div>
                        					   </div>
                							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                					        
                					    <?php endif; ?>
                					    
                					</div>
                                    <?php
                                        $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
                                    ?>
                                    <?php if($pos_addon != null && $pos_addon->activated == 1): ?>
            							<div class="row mt-2">
            								<label class="col-md-2"><?php echo e(translate('Barcode')); ?></label>
            								<div class="col-md-10">
            									<input type="text" class="form-control mb-3" name="barcode" placeholder="<?php echo e(translate('Barcode')); ?>" value="<?php echo e($product->barcode); ?>">
            								</div>
            							</div>
                                    <?php endif; ?>
                                    <?php
                                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                                    ?>
                                    <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
            							<div class="row mt-2">
            								<label class="col-md-2"><?php echo e(translate('Refundable')); ?></label>
            								<div class="col-md-10">
            									<label class="switch" style="margin-top:5px;">
            										<input type="checkbox" name="refundable" <?php if($product->refundable == 1): ?> checked <?php endif; ?>>
            			                            <span class="slider round"></span></label>
            									</label>
            								</div>
            							</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Images')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div id="product-images">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label><?php echo e(translate('Main Images')); ?> <span class="required-star">*</span></label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <?php if($product->photos != null): ?>
                                                        <?php $__currentLoopData = json_decode($product->photos); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-md-3">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="<?php echo e(my_asset($photo)); ?>" alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_photos[]" value="<?php echo e($photo); ?>">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="file" name="photos[]" id="photos-1" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                                <label for="photos-1" class="mw-100 mb-3">
                                                    <span></span>
                                                    <strong>
                                                        <i class="fa fa-upload"></i>
                                                        <?php echo e(translate('Choose image')); ?>

                                                    </strong>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-info mb-3" onclick="add_more_slider_image()"><?php echo e(translate('Add More')); ?></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Thumbnail Image')); ?> <small>(290x300)</small> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <?php if($product->thumbnail_img != null): ?>
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_thumbnail_img" value="<?php echo e($product->thumbnail_img); ?>">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <input type="file" name="thumbnail_img" id="file-2" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-2" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    <?php echo e(translate('Choose image')); ?>

                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Videos')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Video From')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" data-minimum-results-for-search="Infinity" name="video_provider">
                                                    <option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> ><?php echo e(translate('Youtube')); ?></option>
            										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> ><?php echo e(translate('Dailymotion')); ?></option>
            										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> ><?php echo e(translate('Vimeo')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Video URL')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="video_link" placeholder="<?php echo e(translate('Video link')); ?>" value="<?php echo e($product->video_link); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Meta Tags')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Meta Title')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" name="meta_title" value="<?php echo e($product->meta_title); ?>" placeholder="<?php echo e(translate('Meta Title')); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Description')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="meta_description" rows="8" class="form-control mb-3"><?php echo e($product->meta_description); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Meta Image')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <?php if($product->meta_img != null): ?>
                                                    <div class="col-md-3">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="<?php echo e(my_asset($product->meta_img)); ?>" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_meta_img" value="<?php echo e($product->meta_img); ?>">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <input type="file" name="meta_img" id="file-5" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-5" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    <?php echo e(translate('Choose image')); ?>

                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Customer Choice')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row mb-3">
                                        <div class="col-8 col-md-3 order-1 order-md-0">
        									<input type="text" class="form-control" value="<?php echo e(translate('Colors')); ?>" disabled>
        								</div>
        								<div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
        									<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
                                                <?php $__currentLoopData = \App\Color::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        											<option value="<?php echo e($color->code); ?>" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> ><?php echo e($color->name); ?></option>
        										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        									</select>
        								</div>
        								<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
        									<label class="switch" style="margin-top:5px;">
                                                <input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
        										<span class="slider round"></span>
        									</label>
        								</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label><?php echo e(translate('Attributes')); ?></label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="">
                                                <select name="choice_attributes[]" id="choice_attributes" class="form-control selectpicker" multiple data-placeholder="<?php echo e(translate('Choose Attributes')); ?>">
                                                    <?php $__currentLoopData = \App\Attribute::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            											<option value="<?php echo e($attribute->id); ?>" <?php if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))): ?> selected <?php endif; ?>><?php echo e($attribute->name); ?></option>
            										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            			                        </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
        								<p><?php echo e(translate('Choose the attributes of this product and then input values of each attribute')); ?></p>
        							</div>
                                    <div id="customer_choice_options">
                                        <?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        									<div class="row mb-3">
        										<div class="col-8 col-md-3 order-1 order-md-0">
        											<input type="hidden" name="choice_no[]" value="<?php echo e($choice_option->attribute_id); ?>">
        											<input type="text" class="form-control" name="choice[]" value="<?php echo e(\App\Attribute::find($choice_option->attribute_id)->name); ?>" placeholder="<?php echo e(translate('Choice Title')); ?>" disabled>
        										</div>
        										<!-- <div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0">
        											<input type="text" class="form-control" name="choice_options_<?php echo e($choice_option->attribute_id); ?>[]" placeholder="<?php echo e(translate('Enter choice values')); ?>" value="<?php echo e(implode(',', $choice_option->values)); ?>" data-role="tagsinput" onchange="update_sku()">
        										</div>
        										<div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right">
                                                    <button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>
                                                </div> -->
                                                <?php
                                                $psize_Array = $choice_option->values;
                                                $selected_sizes = array();
                                                ?>
                                                <?php $__currentLoopData = $psize_Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psize_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php 
                                                        array_push($selected_sizes, $psize_name)
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-lg-7">
                                                    <select class="form-control demo-select2-size" name="choice_options_<?php echo e($choice_option->attribute_id); ?>[]" id="size_heading_id" multiple onchange="update_sku()">
                                                        <?php $__currentLoopData = \App\Psize::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $psize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value='<?php echo e($psize->name); ?>' <?php if(in_array($psize->name, $selected_sizes)) echo 'selected'?> ><?php echo e($psize->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
        									</div>
        								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Price')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Unit Price')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="unit_price" placeholder="<?php echo e(translate('Unit Price')); ?> (<?php echo e(translate('Base Price')); ?>)" value="<?php echo e($product->unit_price); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Purchase Price')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="purchase_price" placeholder="<?php echo e(translate('Purchase Price')); ?>" value="<?php echo e($product->purchase_price); ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Tax')); ?></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="tax" placeholder="<?php echo e(translate('Tax')); ?>" value="<?php echo e($product->tax); ?>">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="tax_type" data-minimum-results-for-search="Infinity">
                                                    <option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> >$</option>
                                                    <option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> >%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Discount')); ?></label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" min="0" step="0.01" class="form-control mb-3" name="discount" placeholder="<?php echo e(translate('Discount')); ?>" value="<?php echo e($product->discount); ?>">
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="mb-3">
                                                <select class="form-control selectpicker" name="discount_type" data-minimum-results-for-search="Infinity">
                                                    <option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >$</option>
            	                                	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="quantity">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Quantity')); ?> <span class="required-star">*</span></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" step="1" class="form-control mb-3" name="current_stock" placeholder="<?php echo e(translate('Quantity')); ?>" value="<?php echo e($product->current_stock); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="sku_combination">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if(\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping'): ?>
                                <div class="form-box bg-white mt-4">
                                    <div class="form-box-title px-3 py-2">
                                        <?php echo e(translate('Shipping')); ?>

                                    </div>
                                    <div class="form-box-content p-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label><?php echo e(translate('Flat Rate')); ?></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" min="0" step="0.01" class="form-control mb-3" name="flat_shipping_cost" value="<?php echo e($product->shipping_cost); ?>" placeholder="<?php echo e(translate('Flat Rate Cost')); ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="switch" style="margin-top:5px;">
                                                    <input type="radio" name="shipping_type" value="flat_rate" <?php if($product->shipping_type == 'flat_rate'): ?> checked <?php endif; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label><?php echo e(translate('Free Shipping')); ?></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" min="0" step="0.01" class="form-control mb-3" name="free_shipping_cost" value="0" disabled placeholder="<?php echo e(translate('Flat Rate Cost')); ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="switch" style="margin-top:5px;">
                                                    <input type="radio" name="shipping_type" value="free" <?php if($product->shipping_type == 'free'): ?> checked <?php endif; ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Description')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row mb-2">
                                        <label class="col-lg-2 control-label"><?php echo e(translate('Design Details')); ?></label>
                                        <div class="col-lg-10">
                                            <textarea name="designdetails" rows="3" class="form-control editor"><?php echo e($product->designdetails); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-2 control-label"><?php echo e(translate('Size & Fit')); ?></label>
                                        <div class="col-lg-10">
                                            <textarea name="sizefits" rows="3" class="form-control editor"><?php echo e($product->sizefits); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label class="col-lg-2 control-label"><?php echo e(translate('Fabric & Care')); ?></label>
                                        <div class="col-lg-10">
                                            <textarea name="fabriccare" rows="3" class="form-control editor"><?php echo e($product->fabriccare); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-lg-2 control-label"><?php echo e(translate('Product Specification')); ?></label>
                                        <div class="col-lg-10">
                                            <ul class="specification-list">
                                                <li><input type="text" class="form-control" name="specifproducttype" placeholder="Product type" value="<?php echo e($product->specifproducttype); ?>" /></li>
                                                <li><input type="text" class="form-control" name="speciffabrictype" placeholder="Fabric type" value="<?php echo e($product->speciffabrictype); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifweave" placeholder="Weave" value="<?php echo e($product->specifweave); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifborder" placeholder="Border" value="<?php echo e($product->specifborder); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifoccasion" placeholder="Occasion" value="<?php echo e($product->specifoccasion); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifwash" placeholder="Wash" value="<?php echo e($product->specifwash); ?>" /></li> 
                                                <li><input type="text" class="form-control" name="speciffabric" placeholder="Fabric" value="<?php echo e($product->speciffabric); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifblousefabric" placeholder="Blouse Fabric" value="<?php echo e($product->specifblousefabric); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifdupattafabric" placeholder="Dupatta fabric" value="<?php echo e($product->specifdupattafabric); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifbottomfabric" placeholder="Bottom fabric" value="<?php echo e($product->specifbottomfabric); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifsleevelength" placeholder="Sleeve length" value="<?php echo e($product->specifsleevelength); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifneck" placeholder="Neck" value="<?php echo e($product->specifneck); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifbottomshape" placeholder="Bottom Shape" value="<?php echo e($product->specifbottomshape); ?>" /></li>
                                                <li><input type="text" class="form-control" name="specifstylecode" placeholder="Style Code" value="<?php echo e($product->specifstylecode); ?>" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('PDF Specification')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('PDF')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="pdf" id="file-6" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="pdf/*" />
                                            <label for="file-6" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    <?php echo e(translate('Choose PDF')); ?>

                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box mt-4 text-right">
                                <button type="submit" class="btn btn-styled btn-base-1"><?php echo e(translate('Update This Product')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="categorySelectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Select Category')); ?></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="target-category heading-6">
                        <span class="mr-3"><?php echo e(translate('Target Category')); ?>:</span>
                        <span><?php echo e(translate('Category')); ?> > <?php echo e(translate('Subcategory')); ?> > <?php echo e(translate('Sub Subcategory')); ?></span>
                    </div>
                    <div class="row no-gutters modal-categories mt-4 mb-2">
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="<?php echo e(translate('Search Category')); ?>" onkeyup="filterListItems(this, 'categories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="categories">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li onclick="get_subcategories_by_category(this, <?php echo e($category->id); ?>)"><?php echo e(__($category->name)); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="<?php echo e(translate('Search SubCategory')); ?>" onkeyup="filterListItems(this, 'subcategories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="subcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subsubcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="<?php echo e(translate('Search SubSubCategory')); ?>" onkeyup="filterListItems(this, 'subsubcategories')">
                                        <button type="button" class="btn-inner">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-category-list">
                                    <ul id="subsubcategories">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                    <button type="button" class="btn btn-primary" onclick="closeModal()"><?php echo e(translate('Confirm')); ?></button>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<link href="<?php echo e(my_asset('plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
<style>
.select2-container span {
    display: block;
}

.select2-container li>input {
    width: 100% !important;
}
.hidden-field {
    opacity: 0;
    /* visibility: hidden; */
    position: absolute;
    top: 0;
}
</style>
<script src="<?php echo e(my_asset('frontend/js/select2.min.js')); ?>"></script>
    <script type="text/javascript">

        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;

        $(document).ready(function(){
            $('#subcategory_list').hide();
            $('#subsubcategory_list').hide();
            //get_attributes_by_subsubcategory($('#subsubcategory_id').val());
            update_sku();

            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-3").remove();
            });
        });

        function list_item_highlight(el){
            $(el).parent().children().each(function(){
                $(this).removeClass('selected');
            });
            $(el).addClass('selected');
        }

        function get_subcategories_by_category(el, cat_id){
            list_item_highlight(el);
            category_id = cat_id;
            subcategory_id = null;
            subsubcategory_id = null;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategory_list').hide();
            $.post('<?php echo e(route('subcategories.get_subcategories_by_category')); ?>',{_token:'<?php echo e(csrf_token()); ?>', category_id:category_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subcategories').append('<li onclick="get_subsubcategories_by_subcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subcategory_list').show();
            });
        }

        function get_subsubcategories_by_subcategory(el, subcat_id){
            list_item_highlight(el);
            subcategory_id = subcat_id;
            subsubcategory_id = null;
            subcategory_name = $(el).html();
            $('#subsubcategories').html(null);
            $.post('<?php echo e(route('subsubcategories.get_subsubcategories_by_subcategory')); ?>',{_token:'<?php echo e(csrf_token()); ?>', subcategory_id:subcategory_id}, function(data){
                for (var i = 0; i < data.length; i++) {
                    $('#subsubcategories').append('<li onclick="confirm_subsubcategory(this, '+data[i].id+')">'+data[i].name+'</li>');
                }
                $('#subsubcategory_list').show();
            });
        }

        function confirm_subsubcategory(el, subsubcat_id){
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
    	}

        // function get_brands_by_subsubcategory(subsubcat_id){
        //     $('#brands').html(null);
    	// 	$.post('<?php echo e(route('subsubcategories.get_brands_by_subsubcategory')); ?>',{_token:'<?php echo e(csrf_token()); ?>', subsubcategory_id:subsubcategory_id}, function(data){
    	// 	    for (var i = 0; i < data.length; i++) {
    	// 	        $('#brands').append($('<option>', {
    	// 	            value: data[i].id,
    	// 	            text: data[i].name
    	// 	        }));
    	// 	    }
    	// 	});
    	// }

        function get_attributes_by_subsubcategory(subsubcategory_id){
            // var subsubcategory_id = $('#subsubcategories').val();
    		$.post('<?php echo e(route('subsubcategories.get_attributes_by_subsubcategory')); ?>',{_token:'<?php echo e(csrf_token()); ?>', subsubcategory_id:subsubcategory_id}, function(data){
    		    $('#choice_attributes').html(null);
    		    for (var i = 0; i < data.length; i++) {
    		        $('#choice_attributes').append($('<option>', {
    		            value: data[i].id,
    		            text: data[i].name
    		        }));
    		    }
    			$("#choice_attributes > option").each(function() {
    				var str = <?php echo $product->attributes ?>;
    		        $("#choice_attributes").val(str).change();
    		    });
    		});
    	}

        function filterListItems(el, list){
            filter = el.value.toUpperCase();
            li = $('#'+list).children();
            for (i = 0; i < li.length; i++) {
                if ($(li[i]).html().toUpperCase().indexOf(filter) > -1) {
                    $(li[i]).show();
                } else {
                    $(li[i]).hide();
                }
            }
        }

        function closeModal(){
            if(category_id > 0 && subcategory_id > 0 && subsubcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#product_category').html(category_name+'>'+subcategory_name+'>'+subsubcategory_name);
                $('#categorySelectModal').modal('hide');
                //get_brands_by_subsubcategory(subsubcategory_id);
                //get_attributes_by_subsubcategory(subsubcategory_id);
            }
            else{
                alert('Please choose categories...');
                console.log(category_id);
                console.log(subcategory_id);
                console.log(subsubcategory_id);
                //showAlert();
            }
        }

        // var i = $('input[name="choice_no[]"').last().val();
        // if(isNaN(i)){
    	// 	i =0;
    	// }

        function add_more_customer_choice_option(i, name){
            //i++;
    		/*$('#customer_choice_options').append('<div class="row mb-3"><div class="col-8 col-md-3 order-1 order-md-0"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="<?php echo e(translate('Choice Title')); ?>" readonly></div><div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0"><input type="text" class="form-control tagsInput" name="choice_options_'+i+'[]" placeholder="<?php echo e(translate('Enter choice values')); ?>" onchange="update_sku()" data-role="tagsinput"></div><div class="col-4 col-xl-1 col-md-2 order-2 order-md-0 text-right"><button type="button" onclick="delete_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button></div></div>');*/
            var size_options = "";
            <?php $__currentLoopData = \App\Psize::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $psize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            size_options += '<option value=<?php echo e($psize->name); ?>><?php echo e($psize->name); ?></option>'
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            $('#customer_choice_options').append('<div class="row mb-3"><div class="col-8 col-md-3 order-1 order-md-0"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-12 col-md-7 col-xl-8 order-3 order-md-0 mt-2 mt-md-0"><select name="choice_options_'+i+'[]" id="choice_attributes" onchange="update_sku()" class="form-control demo-select2" multiple="">'+size_options+'</select></div></div>');
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
            $('.demo-select2').select2();
        }

    	$('input[name="colors_active"]').on('change', function() {
    	    if(!$('input[name="colors_active"]').is(':checked')){
    			$('#colors').prop('disabled', true);
    		}
    		else{
    			$('#colors').prop('disabled', false);
    		}
    		update_sku();
    	});

    	$('#colors').on('change', function() {
    	    update_sku();
    	});

    	// $('input[name="unit_price"]').on('keyup', function() {
    	//     update_sku();
    	// });
        //
        // $('input[name="name"]').on('keyup', function() {
    	//     update_sku();
    	// });

        $('#choice_attributes').on('change', function() {
    		//$('#customer_choice_options').html(null);
    		$.each($("#choice_attributes option:selected"), function(j, attribute){
    			flag = false;
    			$('input[name="choice_no[]"]').each(function(i, choice_no) {
    				if($(attribute).val() == $(choice_no).val()){
    					flag = true;
    				}
    			});
                if(!flag){
    				add_more_customer_choice_option($(attribute).val(), $(attribute).text());
    			}
            });

    		var str = <?php echo $product->attributes ?>;

    		$.each(str, function(index, value){
    			flag = false;
    			$.each($("#choice_attributes option:selected"), function(j, attribute){
    				if(value == $(attribute).val()){
    					flag = true;
    				}
    			});
                if(!flag){
    				//console.log();
    				$('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
    			}
    		});

    		update_sku();
    	});

    	function delete_row(em){
    		$(em).closest('.row').remove();
    		update_sku();
    	}

    	function update_sku(){
            $.ajax({
    		   type:"POST",
    		   url:'<?php echo e(route('products.sku_combination_edit')); ?>',
    		   data:$('#choice_form').serialize(),
    		   success: function(data){
    			   $('#sku_combination').html(data);
                   if (data.length > 1) {
    				   $('#quantity').hide();
    			   }
    			   else {
    			   		$('#quantity').show();
    			   }
    		   }
    	   });
    	}

        var photo_id = 2;
        function add_more_slider_image(){
            var photoAdd =  '<div class="row">';
            photoAdd +=  '<div class="col-2">';
            photoAdd +=  '<button type="button" onclick="delete_this_row(this)" class="btn btn-link btn-icon text-danger"><i class="fa fa-trash-o"></i></button>';
            photoAdd +=  '</div>';
            photoAdd +=  '<div class="col-10">';
            photoAdd +=  '<input type="file" name="photos[]" id="photos-'+photo_id+'" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" multiple accept="image/*" />';
            photoAdd +=  '<label for="photos-'+photo_id+'" class="mw-100 mb-3">';
            photoAdd +=  '<span></span>';
            photoAdd +=  '<strong>';
            photoAdd +=  '<i class="fa fa-upload"></i>';
            photoAdd +=  "<?php echo e(translate('Choose image')); ?>";
            photoAdd +=  '</strong>';
            photoAdd +=  '</label>';
            photoAdd +=  '</div>';
            photoAdd +=  '</div>';
            $('#product-images').append(photoAdd);

            photo_id++;
            imageInputInitialize();
        }
        function delete_this_row(em){
            $(em).closest('.row').remove();
        }
        
        $('.demo-select2-size').select2({
            maximumSelectionLength: 6
        });
        var sizeSelect = $("#size_id");
        sizeSelect.on("select2:select", function(event) {
            //debugger;
            var optionText = event.params.data.text;
            
            var x = optionText.replaceAll(' ', '_');
            var name = x.replace(/[{()}]/g, '').trim().toLowerCase();
            
            var options = '<div class="row mt-3" data="'+name+'"><label class="col-lg-2 control-label">'+optionText+' (Inches)</label><div class="col-lg-2"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="S" data-role="tagsinput"></div><div class="col-lg-2"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="M" data-role="tagsinput"></div><div class="col-lg-2"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="L" data-role="tagsinput"></div><div class="col-lg-2"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XL" data-role="tagsinput"></div></div>';
            $('#size-options').append(options);
        });
        
        sizeSelect.on('select2:unselecting', function (event) {
            var item = event.params.args.data.text;
            var x = item.replaceAll(' ', '_');
            var name = x.replace(/[{()}]/g, '').trim().toLowerCase();
            $('#size-options').find('div[data="'+name+'"]').remove();
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/seller/product_edit.blade.php ENDPATH**/ ?>