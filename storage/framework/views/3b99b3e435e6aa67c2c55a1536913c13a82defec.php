<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-12">
        <a href="<?php echo e(route('pick_up_points.create')); ?>" class="btn btn-rounded btn-info pull-right"><?php echo e(translate('Add New Pick-up Point')); ?></a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo e(translate('Pick-up Point')); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th><?php echo e(translate('Name')); ?></th>
                    <th><?php echo e(translate('Manager')); ?></th>
                    <th><?php echo e(translate('Location')); ?></th>
                    <th><?php echo e(translate('Pickup Station Contact')); ?></th>
                    <th><?php echo e(translate('Status')); ?></th>
                    
                    <th width="10%"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pickup_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pickup_point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td><?php echo e($pickup_point->name); ?></td>
                        <?php if($pickup_point->staff != null && $pickup_point->staff->user != null): ?>
                            <td><?php echo e($pickup_point->staff->user->name); ?></td>
                        <?php else: ?>
                            <td><div class="label label-table label-danger">
                                <?php echo e(translate('No Manager')); ?>

                            </div></td>
                        <?php endif; ?>
                        <td><?php echo e($pickup_point->address); ?></td>
                        <td><?php echo e($pickup_point->phone); ?></td>
                        <td>
                            <?php if($pickup_point->pick_up_status != 1): ?>
                                <div class="label label-table label-danger">
                                    <?php echo e(translate('Close')); ?>

                                </div>
                            <?php else: ?>
                                <div class="label label-table label-success">
                                    <?php echo e(translate('Open')); ?>

                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    <?php echo e(translate('Actions')); ?> <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="<?php echo e(route('pick_up_points.edit', encrypt($pickup_point->id))); ?>"><?php echo e(translate('Edit')); ?></a></li>
                                    <li><a onclick="confirm_modal('<?php echo e(route('pick_up_points.destroy', $pickup_point->id)); ?>');"><?php echo e(translate('Delete')); ?></a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                <?php echo e($pickup_points->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/pickup_point/index.blade.php ENDPATH**/ ?>