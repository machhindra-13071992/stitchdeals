<?php $__env->startSection('content'); ?>

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e(translate('Subcategory Information')); ?></h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="<?php echo e(route('subcategories.update', $subcategory->id)); ?>" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
        	<?php echo csrf_field(); ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Name')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Name')); ?>" id="name" name="name" class="form-control" value="<?php echo e($subcategory->name); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Category')); ?></label>
                    <div class="col-sm-9">
                        <select name="category_id" required class="form-control demo-select2">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php if($subcategory->category_id == $category->id) echo "selected";?> ><?php echo e(__($category->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo e(translate('Meta Title')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="<?php echo e($subcategory->meta_title); ?>" placeholder="<?php echo e(translate('Meta Title')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo e(translate('Meta Keyword')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_keyword" value="<?php echo e($subcategory->meta_keyword); ?>" placeholder="<?php echo e(translate('Meta Keyword')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="icon"><?php echo e(translate('Icon')); ?> <small>(<?php echo e(translate('32x32')); ?>)</small></label>
                    <div class="col-sm-9">
                        <input type="file" id="icon" name="icon" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo e(translate('Description')); ?></label>
                    <div class="col-sm-9">
                        <textarea name="meta_description" rows="8" class="form-control"><?php echo e($subcategory->meta_description); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Slug')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Slug')); ?>" id="slug" name="slug" value="<?php echo e($subcategory->slug); ?>" class="form-control">
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit"><?php echo e(translate('Save')); ?></button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/subcategories/edit.blade.php ENDPATH**/ ?>