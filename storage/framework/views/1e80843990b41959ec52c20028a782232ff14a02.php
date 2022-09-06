<?php $__env->startSection('content'); ?>

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    <?php if(Auth::user()->user_type == 'seller'): ?>
                        <?php echo $__env->make('frontend.inc.seller_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif(Auth::user()->user_type == 'customer'): ?>
                        <?php echo $__env->make('frontend.inc.customer_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        <?php echo e(translate('Manage Profile')); ?>

                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="<?php echo e(route('home')); ?>"><?php echo e(translate('Home')); ?></a></li>
                                            <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(translate('Dashboard')); ?></a></li>
                                            <li class="active"><a href="<?php echo e(route('profile')); ?>"><?php echo e(translate('Manage Profile')); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class="" action="<?php echo e(route('seller.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Basic info')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Your Name')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Your Name')); ?>" name="name" value="<?php echo e(Auth::user()->name); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Your Phone')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Your Phone')); ?>" name="phone" value="<?php echo e(Auth::user()->phone); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Photo')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="file" name="photo" id="file-3" class="custom-input-file custom-input-file--4" data-multiple-caption="{count} files selected" accept="image/*" />
                                            <label for="file-3" class="mw-100 mb-3">
                                                <span></span>
                                                <strong>
                                                    <i class="fa fa-upload"></i>
                                                    <?php echo e(translate('Choose image')); ?>

                                                </strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Your Password')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="<?php echo e(translate('New Password')); ?>" name="new_password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Confirm Password')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control mb-3" placeholder="<?php echo e(translate('Confirm Password')); ?>" name="confirm_password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Addresses')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row gutters-10">
                                        <?php $__currentLoopData = Auth::user()->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-6">
                                                <div class="border p-3 pr-5 rounded mb-3 position-relative">
                                                    <div>
                                                        <span class="alpha-6"><?php echo e(translate('Address')); ?>:</span>
                                                        <span class="strong-600 ml-2"><?php echo e($address->address); ?></span>
                                                    </div>
                                                    <div>
                                                        <span class="alpha-6"><?php echo e(translate('Postal Code')); ?>:</span>
                                                        <span class="strong-600 ml-2"><?php echo e($address->postal_code); ?></span>
                                                    </div>
                                                    <div>
                                                        <span class="alpha-6"><?php echo e(translate('City')); ?>:</span>
                                                        <span class="strong-600 ml-2"><?php echo e($address->city); ?></span>
                                                    </div>
                                                    <div>
                                                        <span class="alpha-6"><?php echo e(translate('Country')); ?>:</span>
                                                        <span class="strong-600 ml-2"><?php echo e($address->country); ?></span>
                                                    </div>
                                                    <div>
                                                        <span class="alpha-6"><?php echo e(translate('Phone')); ?>:</span>
                                                        <span class="strong-600 ml-2"><?php echo e($address->phone); ?></span>
                                                    </div>
                                                    <?php if($address->set_default): ?>
                                                        <div class="position-absolute right-0 bottom-0 pr-2 pb-3">
                                                            <span class="badge badge-primary bg-base-1"><?php echo e(translate('Default')); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="dropdown position-absolute right-0 top-0">
                                                        <button class="btn bg-gray px-2" type="button" data-toggle="dropdown">
                                                            <i class="la la-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <?php if(!$address->set_default): ?>
                                                                <a class="dropdown-item" href="<?php echo e(route('addresses.set_default', $address->id)); ?>"><?php echo e(translate('Make This Default')); ?></a>
                                                            <?php endif; ?>
                                                            
                                                            <a class="dropdown-item" href="<?php echo e(route('addresses.destroy', $address->id)); ?>"><?php echo e(translate('Delete')); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-6 mx-auto" onclick="add_new_address()">
                                            <div class="border p-3 rounded mb-3 c-pointer text-center bg-light">
                                                <i class="la la-plus la-2x"></i>
                                                <div class="alpha-7"><?php echo e(translate('Add New Address')); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Payment Setting')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Cash Payment')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="switch mb-3">
                                                <input value="1" name="cash_on_delivery_status" type="checkbox" <?php if(Auth::user()->seller->cash_on_delivery_status == 1): ?> checked <?php endif; ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Bank Payment')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <label class="switch mb-3">
                                                <input value="1" name="bank_payment_status" type="checkbox" <?php if(Auth::user()->seller->bank_payment_status == 1): ?> checked <?php endif; ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Bank Name')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Bank Name')); ?>" value="<?php echo e(Auth::user()->seller->bank_name); ?>" name="bank_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Bank Account Name')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Bank Account Name')); ?>" value="<?php echo e(Auth::user()->seller->bank_acc_name); ?>" name="bank_acc_name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Bank Account Number')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Bank Account Number')); ?>" value="<?php echo e(Auth::user()->seller->bank_acc_no); ?>" name="bank_acc_no">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Bank Routing Number')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control mb-3" placeholder="<?php echo e(translate('Bank Routing Number')); ?>" value="<?php echo e(Auth::user()->seller->bank_routing_no); ?>" name="bank_routing_no">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-styled btn-base-1"><?php echo e(translate('Update Profile')); ?></button>
                            </div>
                        </form>

                        <form action="<?php echo e(route('user.change.email')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-title px-3 py-2">
                                    <?php echo e(translate('Change your email')); ?>

                                </div>
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label><?php echo e(translate('Your Email')); ?></label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="input-group mb-3">
                                              <input
                                                  type="email"
                                                  class="form-control"
                                                  placeholder="<?php echo e(translate('Your Email')); ?>"
                                                  name="email"
                                                  value="<?php echo e(Auth::user()->email); ?>"
                                              />
                                              <div class="input-group-append">
                                                 <button type="button" class="btn btn-outline-secondary new-email-verification">
                                                     <span class="d-none loading">
                                                         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                         Sending Email...
                                                     </span>
                                                     <span class="default">Verify</span>
                                                 </button>
                                              </div>
                                            </div>
                                            <button class="btn btn-styled btn-base-1" type="submit">Update Email</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel"><?php echo e(translate('New Address')); ?></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-default" role="form" action="<?php echo e(route('addresses.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo e(translate('Address')); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <textarea class="form-control textarea-autogrow mb-3" placeholder="<?php echo e(translate('Your Address')); ?>" rows="1" name="address" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo e(translate('Country')); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <select class="form-control mb-3 selectpicker" data-placeholder="<?php echo e(translate('Select your country')); ?>" name="country" required>
                                            <?php $__currentLoopData = \App\Country::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->name); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo e(translate('City')); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Your City')); ?>" name="city" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo e(translate('Postal code')); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('Your Postal Code')); ?>" name="postal_code" value="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label><?php echo e(translate('Phone')); ?></label>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-3" placeholder="<?php echo e(translate('+880')); ?>" name="phone" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-base-1"><?php echo e(translate('Save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function add_new_address(){
            $('#new-address-modal').modal('show');
        }

        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('<?php echo e(route('user.new.verify')); ?>', {_token:'<?php echo e(csrf_token()); ?>', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    showFrontendAlert('warning', data.message);
                else if(data.status == 1)
                    showFrontendAlert('success', data.message);
                else
                    showFrontendAlert('danger', data.message);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/seller/profile.blade.php ENDPATH**/ ?>