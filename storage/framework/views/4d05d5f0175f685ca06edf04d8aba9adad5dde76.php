<?php $__env->startSection('content'); ?>
<?php if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-danger pad-all text-center mar-btm">
                <h4 class="text-light mar-btm"><?php echo e(translate('Please Configure SMTP Setting to work all email sending funtionality')); ?>.</h4>
                <a class="btn btn-info btn-rounded" href="<?php echo e(route('smtp_settings.index')); ?>">Configure Now</a>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))): ?>
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate"><?php echo e(translate('PRODUCTS')); ?></div>
                </div>
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-lg text-main"><?php echo e(translate('Total published products')); ?>: <span class="text-bold"><?php echo e(\App\Product::where('published', 1)->get()->count()); ?></span></p>
                <?php if(\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1): ?>
                    <p class="text-lg text-main"><?php echo e(translate('Total sellers products')); ?>: <span class="text-bold"><?php echo e(\App\Product::where('published', 1)->where('added_by', 'seller')->get()->count()); ?></span></p>
                <?php endif; ?>
                <p class="text-lg text-main"><?php echo e(translate('Total admin products')); ?>: <span class="text-bold"><?php echo e(\App\Product::where('published', 1)->where('added_by', 'admin')->get()->count()); ?></span></p>
                <p class="text-lg text-main"><?php echo e(translate('Total sales')); ?>: <span class="text-bold"><?php echo e(\App\Order::where('payment_status','paid')->sum('grand_total')); ?></span></p>
                <br>
                <a href="<?php echo e(route('products.admin')); ?>" class="btn btn-primary mar-top"><?php echo e(translate('Manage Products')); ?> <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main"><?php echo e(translate('Total product category')); ?></p>
                        <p class="text-semibold text-3x text-main"><?php echo e(\App\Category::all()->count()); ?></p>
                        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Create Category')); ?></a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main"><?php echo e(translate('Total product sub sub category')); ?></p>
                        <p class="text-semibold text-3x text-main"><?php echo e(\App\SubSubCategory::all()->count()); ?></p>
                        <a href="<?php echo e(route('subsubcategories.create')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Create Sub Sub Category')); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main"><?php echo e(translate('Total product sub category')); ?></p>
                        <p class="text-semibold text-3x text-main"><?php echo e(\App\SubCategory::all()->count()); ?></p>
                        <a href="<?php echo e(route('subcategories.create')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Create Sub Category')); ?></a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main"><?php echo e(translate('Total product brand')); ?></p>
                        <p class="text-semibold text-3x text-main"><?php echo e(\App\Brand::all()->count()); ?></p>
                        <a href="<?php echo e(route('brands.create')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Create Brand')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if((Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1): ?>
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate"><?php echo e(translate('SELLERS')); ?></div>
                </div>
                <br>
                <p class="text-normal text-main"><?php echo e(translate('Total sellers')); ?></p>
                <p class="text-semibold text-3x text-main"><?php echo e(\App\Seller::all()->count()); ?></p>
                <br>
                <a href="<?php echo e(route('sellers.index')); ?>" class="btn-link"><?php echo e(translate('Manage Sellers')); ?> <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main"><?php echo e(translate('Total approved sellers')); ?></p>
                <p class="text-semibold text-3x text-main"><?php echo e(\App\Seller::where('verification_status', 1)->get()->count()); ?></p>
                <br>
                <a href="<?php echo e(route('sellers.index')); ?>" class="btn-link"><?php echo e(translate('Manage Sellers')); ?> <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main"><?php echo e(translate('Total pending sellers')); ?></p>
                <p class="text-semibold text-3x text-main"><?php echo e(\App\Seller::where('verification_status', 0)->count()); ?></p>
                <br>
                <a href="<?php echo e(route('sellers.index')); ?>" class="btn-link"><?php echo e(translate('Manage Sellers')); ?> <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))): ?>
    <div class="row">
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo e(translate('Category wise product sale')); ?></h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th><?php echo e(translate('Category Name')); ?></th>
                                <th><?php echo e(translate('Sale')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(__($category->name)); ?></td>
                                    <td><?php echo e(\App\Product::where('category_id', $category->id)->sum('num_of_sale')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo e(translate('Category wise product stock')); ?></h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th><?php echo e(translate('Category Name')); ?></th>
                                <th><?php echo e(translate('Stock')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $products = \App\Product::where('category_id', $category->id)->get();
                                    $qty = 0;
                                    foreach ($products as $key => $product) {
                                        if ($product->variant_product) {
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        }
                                        else {
                                            $qty += $product->current_stock;
                                        }
                                    }
                                ?>
                                <tr>
                                    <td><?php echo e(__($category->name)); ?></td>
                                    <td><?php echo e($qty); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions))): ?>
    <div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget pad-no">
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-3x text-main bg-primary pad-ver"><?php echo e(translate('Frontend')); ?> <strong><?php echo e(translate('Setting')); ?></strong></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            <?php echo e(translate('Home page')); ?> <br>
                            <?php echo e(translate('setting')); ?>

                        </p>
                        <br>
                        <a href="<?php echo e(route('home_settings.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            <?php echo e(translate('Policy page')); ?> <br>
                            <?php echo e(translate('setting')); ?>

                        </p>
                        <br>
                        <a href="<?php echo e(route('privacypolicy.index', 'privacy_policy')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            <?php echo e(translate('General')); ?> <br>
                            <?php echo e(translate('setting')); ?>

                        </p>
                        <br>
                        <a href="<?php echo e(route('generalsettings.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            <?php echo e(translate('Useful link')); ?> <br>
                            <?php echo e(translate('setting')); ?>

                        </p>
                        <br>
                        <a href="<?php echo e(route('links.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if(Auth::user()->user_type == 'admin' || in_array('8', json_decode(Auth::user()->staff->role->permissions))): ?>
    <div class="flex-row">
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Activation')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('activation.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('SMTP')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('smtp_settings.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Payment method')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('payment_method.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Social media')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('social_login.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-12 flex-col-12">
        <div class="panel">
            <div class="panel-body text-center dash-widget bg-primary">
                <br>
                <br>
                <i class="demo-pli-gear icon-5x"></i>
                <br>
                <br>
                <br>
                <br>
                <p class="text-semibold text-2x text-light mar-ver">
                    <?php echo e(translate('Business')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Currency')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('currency.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no "><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Seller verification')); ?> <br>
                    <?php echo e(translate('form setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('seller_verification_form.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Language')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('languages.index')); ?>" class="btn btn-primary mar-top btn-block top-border-radius-no"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    <?php echo e(translate('Seller commission')); ?> <br>
                    <?php echo e(translate('setting')); ?>

                </p>
                <br>
                <a href="<?php echo e(route('business_settings.vendor_commission')); ?>" class="btn btn-primary mar-top btn-block"><?php echo e(translate('Click Here')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/dashboard.blade.php ENDPATH**/ ?>