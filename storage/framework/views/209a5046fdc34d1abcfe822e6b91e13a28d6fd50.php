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
<div>
    <h1 class="page-header text-overflow"><?php echo e(translate('Edit Product')); ?></h1>
</div>
<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<form class="form form-horizontal mar-top" action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data" id="choice_form">
			<input name="_method" type="hidden" value="POST">
			<input type="hidden" name="id" value="<?php echo e($product->id); ?>">
			<input type="hidden" name="redirects_to" value="<?php echo e(URL::previous()); ?>">
			<?php echo csrf_field(); ?>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product Information')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Product Name')); ?></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="name" placeholder="<?php echo e(translate('Product Name')); ?>" value="<?php echo e($product->name); ?>" required>
                        </div>
                    </div>
                    <div class="form-group" id="category">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Category')); ?></label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="category_id" id="category_id" required>
                            	<option><?php echo e(translate('Select an option')); ?></option>
                            	<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            	    <option value="<?php echo e($category->id); ?>" <?php if($product->category_id == $category->id) echo "selected"; ?> ><?php echo e(__($category->name)); ?></option>
                            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="subcategory">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Subcategory')); ?></label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="subcategory_id" id="subcategory_id" required>

                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="subsubcategory">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Sub Subcategory')); ?></label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="subsubcategory_id" id="subsubcategory_id">

                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="brand">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Brand')); ?></label>
                        <div class="col-lg-7">
                            <select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id">
								<option value=""><?php echo e(('Select Brand')); ?></option>
								<?php $__currentLoopData = \App\Brand::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($brand->id); ?>" <?php if($product->brand_id == $brand->id): ?> selected <?php endif; ?>><?php echo e($brand->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Unit')); ?></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="unit" placeholder="<?php echo e(translate('Unit (e.g. KG, Pc etc)')); ?>" value="<?php echo e($product->unit); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Minimum Qty')); ?></label>
						<div class="col-lg-7">
							<input type="number" class="form-control" name="min_qty" value="<?php if($product->min_qty <= 1): ?><?php echo e(1); ?><?php else: ?><?php echo e($product->min_qty); ?><?php endif; ?>" min="1" required>
						</div>
					</div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Tags')); ?></label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" name="tags[]" id="tags" value="<?php echo e($product->tags); ?>" placeholder="<?php echo e(translate('Type to add a tag')); ?>" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Size Heading')); ?></label>
                        <div class="col-lg-7">
                            <!-- <?php
                                $size_heading = '';
                                //print_r(json_decode($product->size_heading));
                            ?>
                            <?php if(!empty(json_decode($product->size_heading))): ?>
                            <?php
                                $size_heading = implode(', ', json_decode($product->size_heading))
                            ?>
                            <?php endif; ?>
                            <input type="text" class="form-control" name="size_heading[]" id="size_heading" value="<?php echo e($size_heading); ?>" placeholder="<?php echo e(translate('Type to add size heading')); ?>" data-role="tagsinput"> -->
                        	<?php
						        $psize_Array = json_decode($product->size_heading);
						        $selected_psizes = array();
							?>
							<?php $__currentLoopData = $psize_Array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $psize_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    <?php 
							        array_push($selected_psizes, $psize_name)
							    ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        	<select class="form-control demo-select2-size" name="size_heading[]" id="size_heading_id" multiple>
								<?php $__currentLoopData = \App\Psize::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $psize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value='<?php echo e($psize->name); ?>' <?php if(in_array($psize->name, $selected_psizes)) echo 'selected'?> ><?php echo e($psize->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Select Sizes')); ?></label>
						<div class="col-lg-7">
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
                                    //print_r($option->values);
							    ?>
							    
							    <div class="form-group" data="<?php echo e($name); ?>">
							       <label class="col-lg-2 control-label"><?php echo e($size_name[0]); ?> (Inches)</label>
							       <?php if(!$option->values == null): ?>
							        <?php $__currentLoopData = $option->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        					        <div class="col-lg-1">
        					            <input type="number" class="form-control" name="<?php echo e($name); ?>[]" id="" value="<?php echo e($val); ?>" placeholder="S">
        					        </div>
        					        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        					        <?php endif; ?>
        					   </div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					        
					    <?php endif; ?>
					    
					</div>
					<?php
					    $pos_addon = \App\Addon::where('unique_identifier', 'pos_system')->first();
					?>
					<?php if($pos_addon != null && $pos_addon->activated == 1): ?>
						<div class="form-group">
							<label class="col-lg-2 control-label"><?php echo e(translate('Barcode')); ?></label>
							<div class="col-lg-7">
								<input type="text" class="form-control" name="barcode" placeholder="<?php echo e(translate('Barcode')); ?>" value="<?php echo e($product->barcode); ?>">
							</div>
						</div>
					<?php endif; ?>

					<?php
					    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
					?>
					<?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
						<div class="form-group">
							<label class="col-lg-2 control-label"><?php echo e(translate('Refundable')); ?></label>
							<div class="col-lg-7">
								<label class="switch" style="margin-top:5px;">
									<input type="checkbox" name="refundable" <?php if($product->refundable == 1): ?> checked <?php endif; ?>>
		                            <span class="slider round"></span></label>
								</label>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product Images')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Gallery Images')); ?></label>
						<div class="col-lg-7">
							<div id="photos">
								<?php if(is_array(json_decode($product->photos))): ?>
									<?php $__currentLoopData = json_decode($product->photos); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-md-4 col-sm-4 col-xs-6">
											<div class="img-upload-preview">
												<img loading="lazy"  src="<?php echo e(my_asset($photo)); ?>" alt="" class="img-responsive">
												<input type="hidden" name="previous_photos[]" value="<?php echo e($photo); ?>">
												<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
											</div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Thumbnail Image')); ?> <small>(290x300)</small></label>
						<div class="col-lg-7">
							<div id="thumbnail_img">
								<?php if($product->thumbnail_img != null): ?>
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="img-upload-preview">
											<img loading="lazy"  src="<?php echo e(my_asset($product->thumbnail_img)); ?>" alt="" class="img-responsive">
											<input type="hidden" name="previous_thumbnail_img" value="<?php echo e($product->thumbnail_img); ?>">
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product Videos')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Video Provider')); ?></label>
						<div class="col-lg-7">
							<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
								<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> ><?php echo e(translate('Youtube')); ?></option>
								<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> ><?php echo e(translate('Dailymotion')); ?></option>
								<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> ><?php echo e(translate('Vimeo')); ?></option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Video Link')); ?></label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="video_link" value="<?php echo e($product->video_link); ?>" placeholder="<?php echo e(translate('Video Link')); ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product Variation')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="<?php echo e(translate('Colors')); ?>" disabled>
						</div>
						<div class="col-lg-7">
							<select class="form-control color-var-select" name="colors[]" id="colors" multiple>
								<?php $__currentLoopData = \App\Color::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($color->code); ?>" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> ><?php echo e($color->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="col-lg-2">
							<label class="switch" style="margin-top:5px;">
								<input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
								<span class="slider round"></span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-2">
							<input type="text" class="form-control" value="<?php echo e(translate('Attributes')); ?>" disabled>
						</div>
	                    <div class="col-lg-7">
	                        <select name="choice_attributes[]" id="choice_attributes" class="form-control demo-select2" multiple data-placeholder="<?php echo e(translate('Choose Attributes')); ?>">
								<?php $__currentLoopData = \App\Attribute::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($attribute->id); ?>" <?php if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))): ?> selected <?php endif; ?>><?php echo e($attribute->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                        </select>
	                    </div>
	                </div>

					<div class="">
						<p><?php echo e(translate('Choose the attributes of this product and then input values of each attribute')); ?></p>
						<br>
					</div>

					<div class="customer_choice_options" id="customer_choice_options">
						<?php $__currentLoopData = json_decode($product->choice_options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $choice_option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="form-group">
								<div class="col-lg-2">
									<input type="hidden" name="choice_no[]" value="<?php echo e($choice_option->attribute_id); ?>">
									<input type="text" class="form-control" name="choice[]" value="<?php echo e(\App\Attribute::find($choice_option->attribute_id)->name); ?>" placeholder="<?php echo e(translate('Choice Title')); ?>" disabled>
								</div>
								<!-- <div class="col-lg-7">
									<input type="text" class="form-control" name="choice_options_<?php echo e($choice_option->attribute_id); ?>[]" placeholder="<?php echo e(translate('Enter choice values')); ?>" value="<?php echo e(implode(',', $choice_option->values)); ?>" data-role="tagsinput" onchange="update_sku()">
								</div>
								<div class="col-lg-2">
									<button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>
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
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product price + stock')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Unit price')); ?></label>
                        <div class="col-lg-7">
                            <input type="text" placeholder="<?php echo e(translate('Unit price')); ?>" name="unit_price" class="form-control" value="<?php echo e($product->unit_price); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Purchase price')); ?></label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="<?php echo e(translate('Purchase price')); ?>" name="purchase_price" class="form-control" value="<?php echo e($product->purchase_price); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Tax')); ?></label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="<?php echo e(translate('tax')); ?>" name="tax" class="form-control" value="<?php echo e($product->tax); ?>" required>
                        </div>
                        <div class="col-lg-1">
                            <select class="demo-select2" name="tax_type" required>
                            	<option value="amount" <?php if($product->tax_type == 'amount') echo "selected";?> ><?php echo e(translate('Flat')); ?></option>
                            	<option value="percent" <?php if($product->tax_type == 'percent') echo "selected";?> ><?php echo e(translate('Percent')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Discount')); ?></label>
                        <div class="col-lg-7">
                            <input type="number" min="0" step="0.01" placeholder="<?php echo e(translate('Discount')); ?>" name="discount" class="form-control" value="<?php echo e($product->discount); ?>" required>
                        </div>
                        <div class="col-lg-1">
                            <select class="demo-select2" name="discount_type" required>
                            	<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> ><?php echo e(translate('Flat')); ?></option>
                            	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> ><?php echo e(translate('Percent')); ?></option>
                            </select>
                        </div>
                    </div>
					<div class="form-group" id="quantity">
						<label class="col-lg-2 control-label"><?php echo e(translate('Quantity')); ?></label>
						<div class="col-lg-7">
							<input type="number" value="<?php echo e($product->current_stock); ?>" step="1" placeholder="<?php echo e(translate('Quantity')); ?>" name="current_stock" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="sku_combination" id="sku_combination">

					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('Product Description')); ?></h3>
				</div>
				<div class="panel-body">
					<!--<div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Description')); ?></label>
                        <div class="col-lg-9">
                            <textarea class="editor" name="description"><?php echo e($product->description); ?></textarea>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Design Details')); ?></label>
                        <div class="col-lg-9">
                            <textarea name="designdetails" rows="3" class="form-control editor"><?php echo e($product->designdetails); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Size & Fit')); ?></label>
                        <div class="col-lg-9">
                            <textarea name="sizefits" rows="3" class="form-control editor"><?php echo e($product->sizefits); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Fabric & Care')); ?></label>
                        <div class="col-lg-9">
                            <textarea name="fabriccare" rows="3" class="form-control editor"><?php echo e($product->fabriccare); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"><?php echo e(translate('Product Specification')); ?></label>
                        <div class="col-lg-9">
                            <ul class="specification-list">
                                <!--<li><input type="text" class="form-control" name="speciftype" placeholder="Type" value="<?php echo e($product->speciftype); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifpattern" placeholder="Pattern" value="<?php echo e($product->specifpattern); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifoccasion" placeholder="Occasion" value="<?php echo e($product->specifoccasion); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifborder" placeholder="Border" value="<?php echo e($product->specifborder); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifsareefabric" placeholder="Saree Fabric" value="<?php echo e($product->specifsareefabric); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifblouse" placeholder="Blouse" value="<?php echo e($product->specifblouse); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifblousefabric" placeholder="Blouse Fabric" value="<?php echo e($product->specifblousefabric); ?>" /></li>
                                <li><input type="text" class="form-control" name="specifwash" placeholder="Wash" value="<?php echo e($product->specifwash); ?>" /></li>-->
                                
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
			<?php if(\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping'): ?>
                <div class="panel">
    				<div class="panel-heading bord-btm">
    					<h3 class="panel-title"><?php echo e(translate('Product Shipping Cost')); ?></h3>
    				</div>
    				<div class="panel-body">
    					<div class="row bord-btm">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title"><?php echo e(translate('Free Shipping')); ?></h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label"><?php echo e(translate('Status')); ?></label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="free" <?php if($product->shipping_type == 'free'): ?> checked <?php endif; ?>>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    						</div>
    					</div>

    					<div class="row bord-btm">
    						<div class="col-md-2">
    							<div class="panel-heading">
    								<h3 class="panel-title"><?php echo e(translate('Flat Rate')); ?></h3>
    							</div>
    						</div>
    						<div class="col-md-10">
    							<div class="form-group">
    								<label class="col-lg-2 control-label"><?php echo e(translate('Status')); ?></label>
    								<div class="col-lg-7">
    									<label class="switch" style="margin-top:5px;">
    										<input type="radio" name="shipping_type" value="flat_rate" <?php if($product->shipping_type == 'flat_rate'): ?> checked <?php endif; ?>>
    										<span class="slider round"></span>
    									</label>
    								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-lg-2 control-label"><?php echo e(translate('Shipping cost')); ?></label>
    								<div class="col-lg-7">
    									<input type="number" min="0" step="0.01" placeholder="<?php echo e(translate('Shipping cost')); ?>" name="flat_shipping_cost" class="form-control" value="<?php echo e($product->shipping_cost); ?>" required>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
            <?php endif; ?>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('PDF Specification')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('PDF Specification')); ?></label>
						<div class="col-lg-7">
							<input type="file" class="form-control" placeholder="<?php echo e(translate('PDF')); ?>" name="pdf" accept="application/pdf">
						</div>
					</div>
				</div>
			</div>
			<div class="panel">
				<div class="panel-heading bord-btm">
					<h3 class="panel-title"><?php echo e(translate('SEO Meta Tags')); ?></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Meta Title')); ?></label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_title" value="<?php echo e($product->meta_title); ?>" placeholder="<?php echo e(translate('Meta Title')); ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Description')); ?></label>
						<div class="col-lg-7">
							<textarea name="meta_description" rows="8" class="form-control"><?php echo e($product->meta_description); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Keyword')); ?></label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="meta_keyword" value="<?php echo e($product->meta_keyword); ?>" placeholder="<?php echo e(translate('Meta Keyword')); ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label"><?php echo e(translate('Meta Image')); ?></label>
						<div class="col-lg-7">
							<div id="meta_photo">
								<?php if($product->meta_img != null): ?>
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="img-upload-preview">
											<img loading="lazy"  src="<?php echo e(my_asset($product->meta_img)); ?>" alt="" class="img-responsive">
											<input type="hidden" name="previous_meta_img" value="<?php echo e($product->meta_img); ?>">
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mar-all text-right">
				<button type="submit" name="button" class="btn btn-info"><?php echo e(translate('Update Product')); ?></button>
			</div>
		</form>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">

	// var i = $('input[name="choice_no[]"').last().val();
	// if(isNaN(i)){
	// 	i =0;
	// }

	function add_more_customer_choice_option(i, name){
		/*$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="<?php echo e(translate('Enter choice values')); ?>" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');*/
		var size_options = "";
		<?php $__currentLoopData = \App\Psize::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $psize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		size_options += '<option value=<?php echo e($psize->name); ?>><?php echo e($psize->name); ?></option>'
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="'+name+'" readonly></div><div class="col-lg-7"><select name="choice_options_'+i+'[]" id="choice_attributes" onchange="update_sku()" class="form-control demo-select2" multiple="">'+size_options+'</select></div></div>');
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

	function delete_row(em){
		$(em).closest('.form-group').remove();
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

	function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('<?php echo e(route('subcategories.get_subcategories_by_category')); ?>',{_token:'<?php echo e(csrf_token()); ?>', category_id:category_id}, function(data){
		    $('#subcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subcategory_id > option").each(function() {
		        if(this.value == '<?php echo e($product->subcategory_id); ?>'){
		            $("#subcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    get_subsubcategories_by_subcategory();
		});
	}

	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('<?php echo e(route('subsubcategories.get_subsubcategories_by_subcategory')); ?>',{_token:'<?php echo e(csrf_token()); ?>', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
			$('#subsubcategory_id').append($('<option>', {
				value: null,
				text: null
			}));
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#subsubcategory_id > option").each(function() {
		        if(this.value == '<?php echo e($product->subsubcategory_id); ?>'){
		            $("#subsubcategory_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		    //get_brands_by_subsubcategory();
			//get_attributes_by_subsubcategory();
		});
	}

	// function get_brands_by_subsubcategory(){
	// 	var subsubcategory_id = $('#subsubcategory_id').val();
	// 	$.post('<?php echo e(route('subsubcategories.get_brands_by_subsubcategory')); ?>',{_token:'<?php echo e(csrf_token()); ?>', subsubcategory_id:subsubcategory_id}, function(data){
	// 	    $('#brand_id').html(null);
	// 	    for (var i = 0; i < data.length; i++) {
	// 	        $('#brand_id').append($('<option>', {
	// 	            value: data[i].id,
	// 	            text: data[i].name
	// 	        }));
	// 	    }
	// 	    $("#brand_id > option").each(function() {
	// 	        if(this.value == '<?php echo e($product->brand_id); ?>'){
	// 	            $("#brand_id").val(this.value).change();
	// 	        }
	// 	    });
	//
	// 	    $('.demo-select2').select2();
	//
	// 	});
	// }

	function get_attributes_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
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

			$('.demo-select2').select2();
		});
	}

	$(document).ready(function(){
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});

		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    //get_brands_by_subsubcategory();
		//get_attributes_by_subsubcategory();
	});

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
	
	$('.demo-select2-size').select2({
        maximumSelectionLength: 6
    });
    var sizeSelect = $("#size_id");
    sizeSelect.on("select2:select", function(event) {
        //debugger;
        var optionText = event.params.data.text;
        
        var x = optionText.replaceAll(' ', '_');
        var name = x.replace(/[{()}]/g, '').trim().toLowerCase();
        
        var options = '<div class="form-group" data="'+name+'"><label class="col-lg-2 control-label">'+optionText+' (Inches)</label><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XS"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="S"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="M"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="L"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XL"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XXL"></div><div class="col-lg-1"><input type="number" class="form-control" name="'+name+'[]" id="" value="" placeholder="XXXL"></div></div>';
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/products/edit.blade.php ENDPATH**/ ?>