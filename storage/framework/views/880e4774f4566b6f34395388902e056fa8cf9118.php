<?php $__env->startSection('content'); ?>
<?php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
?>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no"><?php echo e(translate('Orders')); ?></h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="payment_type" id="payment_type" onchange="sort_orders()">
                            <option value=""><?php echo e(translate('Filter by Payment Status')); ?></option>
                            <option value="paid"  <?php if(isset($payment_status)): ?> <?php if($payment_status == 'paid'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Paid')); ?></option>
                            <option value="unpaid"  <?php if(isset($payment_status)): ?> <?php if($payment_status == 'unpaid'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Un-Paid')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                            <option value=""><?php echo e(translate('Filter by Deliver Status')); ?></option>
                            <option value="pending"   <?php if(isset($delivery_status)): ?> <?php if($delivery_status == 'pending'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Pending')); ?></option>
                            <option value="on_review"   <?php if(isset($delivery_status)): ?> <?php if($delivery_status == 'on_review'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('On review')); ?></option>
                            <option value="on_delivery"   <?php if(isset($delivery_status)): ?> <?php if($delivery_status == 'on_delivery'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('On delivery')); ?></option>
                            <option value="delivered"   <?php if(isset($delivery_status)): ?> <?php if($delivery_status == 'delivered'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Delivered')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"<?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?> placeholder="<?php echo e(translate('Type Order code & hit Enter')); ?>">
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
                    <th><?php echo e(translate('Order Code')); ?></th>
                    <th><?php echo e(translate('Num. of Products')); ?></th>
                    <th><?php echo e(translate('Customer')); ?></th>
                    <th><?php echo e(translate('Amount')); ?></th>
                    <th><?php echo e(translate('Delivery Status')); ?></th>
                    <th><?php echo e(translate('Payment Method')); ?></th>
                    <th><?php echo e(translate('Payment Status')); ?></th>
                    <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                        <th><?php echo e(translate('Refund')); ?></th>
                    <?php endif; ?>
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
                                <?php echo e(count($order->orderDetails->where('seller_id', $admin_user_id))); ?>

                            </td>
                            <td>
                                <?php if($order->user != null): ?>
                                    <?php echo e($order->user->name); ?>

                                <?php else: ?>
                                    Guest (<?php echo e($order->guest_id); ?>)
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('price') + $order->orderDetails->where('seller_id', $admin_user_id)->sum('tax'))); ?>

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
                                    <?php if($order->orderDetails->where('seller_id',  $admin_user_id)->first()->payment_status == 'paid'): ?>
                                        <i class="bg-green"></i> <?php echo e(translate('Paid')); ?>

                                    <?php else: ?>
                                        <i class="bg-red"></i> <?php echo e(translate('Unpaid')); ?>

                                    <?php endif; ?>
                                </span>
                            </td>
                            <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                                <td>
                                    <?php if(count($order->refund_requests) > 0): ?>
                                        <?php echo e(count($order->refund_requests)); ?> <?php echo e(translate('Refund')); ?>

                                    <?php else: ?>
                                        <?php echo e(translate('No Refund')); ?>

                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        <?php echo e(translate('Actions')); ?> <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php echo e(route('orders.show', encrypt($order->id))); ?>"><?php echo e(translate('View')); ?></a></li>
                                        <li><a href="<?php echo e(route('seller.invoice.download', $order->id)); ?>"><?php echo e(translate('Download Invoice')); ?></a></li>
                                        <li><a onclick="confirm_modal('<?php echo e(route('orders.destroy', $order->id)); ?>');"><?php echo e(translate('Delete')); ?></a></li>
                                        <li><a onclick="confirm_modal('<?php echo e(route('orders.cancelled',$order->id)); ?>');" class="dropdown-item" ><?php echo e(translate('Cancel Order')); ?></a></li>
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
                <?php echo e($orders->appends(request()->input())->links()); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/orders/index.blade.php ENDPATH**/ ?>