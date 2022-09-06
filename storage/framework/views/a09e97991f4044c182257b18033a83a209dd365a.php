<?php $__env->startSection('content'); ?>

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e(translate('Sub Subcategory Information')); ?></h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="<?php echo e(route('subsubcategories.update', $subsubcategory->id)); ?>" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            <?php echo csrf_field(); ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Name')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Name')); ?>" id="name" name="name" class="form-control" required value="<?php echo e($subsubcategory->name); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Category')); ?></label>
                    <div class="col-sm-9">
                        <select name="category_id" id="category_id" class="form-control sub-demo-select2" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e(__($category->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Subcategory')); ?></label>
                    <div class="col-sm-9">
                        <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2" required>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo e(translate('Meta Title')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="<?php echo e($subsubcategory->meta_title); ?>" placeholder="<?php echo e(translate('Meta Title')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo e(translate('Meta Keyword')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_keyword" value="<?php echo e($subsubcategory->meta_keyword); ?>" placeholder="<?php echo e(translate('Meta Keyword')); ?>">
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
                        <textarea name="meta_description" rows="8" class="form-control"><?php echo e($subsubcategory->meta_description); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name"><?php echo e(translate('Slug')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(translate('Slug')); ?>" id="slug" name="slug" value="<?php echo e($subsubcategory->slug); ?>" class="form-control">
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


<?php $__env->startSection('script'); ?>

<script type="text/javascript">


    function get_subcategories_by_category(){
		var category_id = $('#category_id').val();
		$.post('<?php echo e(route('subcategories.get_subcategories_by_category')); ?>',{_token:'<?php echo e(csrf_token()); ?>', category_id:category_id}, function(data){
		    $('#sub_category_id').html(null);
            var extra = "";
		    for (var i = 0; i < data.length; i++) {
                data[i].id == '<?php echo e($subsubcategory->sub_category_id); ?>' ? extra = "selected " : extra = "";
		    
                $('#sub_category_id').append($(`<option value="${data[i].id}" ${extra}>${data[i].name}</option>`));
		    }	    

		    $('.sub-demo-select2').select2();		    
		});
	}

    $('.demo-select2').select2();

    $(document).ready(function(){

        $("#category_id > option").each(function() {
            if(this.value == '<?php echo e($subsubcategory->subcategory->category_id); ?>'){
                $("#category_id").val(this.value).change();
            }
        });

        get_subcategories_by_category();
    });

    $('#category_id').on('change', function() {
        get_subcategories_by_category();
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/subsubcategories/edit.blade.php ENDPATH**/ ?>