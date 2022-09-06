<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-12">
        <a href="<?php echo e(route('subsubcategories.create')); ?>" class="btn btn-rounded btn-info pull-right"><?php echo e(translate('Add New Sub Subcategory')); ?></a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no"><?php echo e(translate('Sub-Sub-categories')); ?></h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_subsubcategories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type name & Enter')); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(translate('Sub Subcategory')); ?></th>
                    <th><?php echo e(translate('Subcategory')); ?></th>
                    <th><?php echo e(translate('Category')); ?></th>
                    <th><?php echo e(translate('Icon')); ?></th>
                    
                    <th width="10%"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $subsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subsubcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($subsubcategory->subcategory != null && $subsubcategory->subcategory->category != null): ?>
                        <tr>
                            <td><?php echo e(($key+1) + ($subsubcategories->currentPage() - 1)*$subsubcategories->perPage()); ?></td>
                            <td><?php echo e(__($subsubcategory->name)); ?></td>
                            <td><?php echo e($subsubcategory->subcategory->name); ?></td>
                            <td><?php echo e($subsubcategory->subcategory->category->name); ?></td>
                            <td><img loading="lazy"  class="img-xs" src="<?php echo e(my_asset($subsubcategory->icon)); ?>" alt="<?php echo e(translate('icon')); ?>"></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        <?php echo e(translate('Actions')); ?> <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php echo e(route('subsubcategories.edit', encrypt($subsubcategory->id))); ?>"><?php echo e(translate('Edit')); ?></a></li>
                                        <li><a onclick="confirm_modal('<?php echo e(route('subsubcategories.destroy', $subsubcategory->id)); ?>');"><?php echo e(translate('Delete')); ?></a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                <?php echo e($subsubcategories->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/subsubcategories/index.blade.php ENDPATH**/ ?>