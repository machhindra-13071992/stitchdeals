<?php $__env->startSection('content'); ?>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo e(translate('Orders')); ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo e(translate('Order Code')); ?></th>
                    <th><?php echo e(translate('Num. of Products')); ?></th>
                    <th><?php echo e(translate('Customer')); ?></th>
                    <th><?php echo e(translate('Amount')); ?></th>
                    <th><?php echo e(translate('Delivery Status')); ?></th>
                    <th><?php echo e(translate('Payment Method')); ?></th>
                    <th><?php echo e(translate('Payment Status')); ?></th>
                    <th width="10%"><?php echo e(translate('Options')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $order = \App\Order::find($order_id->id);
                    ?>
                    <?php if($order != null): ?>
                        <tr>
                            <td>
                                <?php echo e(($key+1) + ($orders->currentPage() - 1)*$orders->perPage()); ?>

                            </td>
                            <td>
                                <?php echo e($order->code); ?> <?php if($order->viewed == 0): ?> <span class="pull-right badge badge-info"><?php echo e(translate('New')); ?></span> <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(count($order->orderDetails)); ?>

                            </td>
                            <td>
                                <?php if($order->user_id != null): ?>
                                    <?php echo e($order->user->name); ?>

                                <?php else: ?>
                                    Guest (<?php echo e($order->guest_id); ?>)
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax'))); ?>

                            </td>
                            <td>
                                <?php
                                    $status = $order->orderDetails->first()->delivery_status;
                                ?>
                                <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                            </td>
                            <td>
                                <?php echo e(ucfirst(str_replace('_', ' ', $order->payment_type))); ?>

                            </td>
                            <td>
                                <span class="badge badge--2 mr-4">
                                    <?php if($order->orderDetails->first()->payment_status == 'paid'): ?>
                                        <i class="bg-green"></i> <?php echo e(translate('Paid')); ?>

                                    <?php else: ?>
                                        <i class="bg-red"></i> <?php echo e(translate('Unpaid')); ?>

                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        <?php echo e(translate('Actions')); ?> <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php echo e(route('pick_up_point.order_show', encrypt($order->id))); ?>"><?php echo e(translate('View')); ?></a></li>
                                        <li><a href="<?php echo e(route('admin.invoice.download', $order->id)); ?>"><?php echo e(translate('Download Invoice')); ?></a></li>
                                        <li><a onclick="confirm_modal('<?php echo e(route('orders.destroy', $order->id)); ?>');"><?php echo e(translate('Delete')); ?></a></li>
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
                <?php echo e($orders->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/pickup_point/orders/index.blade.php ENDPATH**/ ?>