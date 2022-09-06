<footer class="bg-light theme1 position-relative">
    <div class="footer-bottom pt-80 pb-30 xss">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget mx-w-400">
						<?php
							$generalsetting = \App\GeneralSetting::first();
						?>
                        <p class="text mb-30"><?php echo e($generalsetting->description); ?></p>
                        <div class="address-widget mb-30">
                            <div class="media">
                                <span class="address-icon mr-3">
                                    <img src="<?php echo e(my_asset('frontend/images/icon/phone.png')); ?>" alt="phone">
                                </span>
                                <div class="media-body">
                                    <p class="help-text text-uppercase"><?php echo e(translate('NEED HELP?')); ?></p>
                                    <h4 class="title text-dark"><a href="tel:<?php echo e($generalsetting->phone); ?>"><?php echo e($generalsetting->phone); ?></a></h4>
                                </div>
                            </div>
                        </div>

                        <div class="social-network">
                            <ul class="d-flex">
							<?php if($generalsetting->facebook != null): ?>
								<li>
									<a href="<?php echo e($generalsetting->facebook); ?>" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">
										<span class="icon-social-facebook"></span>
									</a>
								</li>
							<?php endif; ?>
							<?php if($generalsetting->instagram != null): ?>
								<li>
									<a href="<?php echo e($generalsetting->instagram); ?>" class="instagram" target="_blank" data-toggle="tooltip" data-original-title="Instagram">
										<span class="icon-social-instagram"></span>
									</a>
								</li>
							<?php endif; ?>
							<?php if($generalsetting->twitter != null): ?>
								<li>
									<a href="<?php echo e($generalsetting->twitter); ?>" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">
										<span class="icon-social-twitter"></span>
									</a>
								</li>
							<?php endif; ?>
							<?php if($generalsetting->youtube != null): ?>
								<li>
									<a href="<?php echo e($generalsetting->youtube); ?>" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
										<span class="icon-social-youtube"></span>
									</a>
								</li>
							<?php endif; ?>
							<?php if($generalsetting->google_plus != null): ?>
								<li>
									<a href="<?php echo e($generalsetting->google_plus); ?>" class="google-plus" target="_blank" data-toggle="tooltip" data-original-title="Google Plus">
										
										<span class="icon-social-google"></span>
									</a>
								</li>
							<?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase"><?php echo e(translate('Information')); ?></h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="<?php echo e(route('home.about')); ?>"><?php echo e(translate('About us')); ?></a></li>
                            <li><a href="<?php echo e(route('home.contact')); ?>"><?php echo e(translate('Contact us')); ?></a></li>
                            <li><a href="<?php echo e(route('terms')); ?>"><?php echo e(translate('Terms & Conditions')); ?></a></li>
                            <li><a href="<?php echo e(route('returnpolicy')); ?>"><?php echo e(translate('Return Policy')); ?></a></li>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-2 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase"><?php echo e(translate('Custom Links')); ?></h2>
                            </div>
                        </div>
                        <!-- footer-menu start -->
                        <ul class="footer-menu">
                            <li><a href="<?php echo e(route('home.privacy_policy')); ?>"><?php echo e(translate('Privacy Policy')); ?></a></li>
                            <li><a href="<?php echo e(route('home.faq')); ?>"><?php echo e(translate('FAQs')); ?></a></li>

                            <!--<li><a href="<?php echo e(route('login')); ?>"><?php echo e(translate('Login')); ?></a></li>-->
							<?php if(Auth::check()): ?>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>">
                                        <?php echo e(translate('Logout')); ?>

                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo e(route('user.login')); ?>">
                                        <?php echo e(translate('Login')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <li><a href="<?php echo e(route('profile')); ?>"><?php echo e(translate('My account')); ?></a></li>
							<?php $__currentLoopData = \App\Link::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($link->url); ?>" title="">
                                        <?php echo e($link->name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <!-- footer-menu end -->
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-30">
                    <div class="footer-widget">
                        <div class="border-bottom cbb1 mb-25">
                            <div class="section-title pb-20">
                                <h2 class="title text-dark text-uppercase"><?php echo e(translate('Newsletter')); ?></h2>
                            </div>
                        </div>
                        <p class="text mb-20">You may unsubscribe at any moment. For that purpose, please find our
                            contact info in the legal notice.</p>
                        <div class="nletter-form mb-35">
							<form class="form-inline position-relative" method="POST" action="<?php echo e(route('subscribers.store')); ?>">
                                <?php echo csrf_field(); ?>
								<input type="email" class="form-control" placeholder="<?php echo e(translate('Your Email Address')); ?>" name="email" required>
                                 <button type="submit" class="btn nletter-btn text-capitalize">
                                    <?php echo e(translate('Sign_up')); ?>

                                </button>
                               
                            </form>
                        </div>

                        <div class="store d-flex">
                            <a href="https://www.apple.com/" class="d-inline-block mr-3"><img
                                    src="<?php echo e(my_asset('frontend/images/icon/apple.png')); ?>" alt="apple icon"> </a>
                            <a href="https://play.google.com/store/" class="d-inline-block"><img
                                    src="<?php echo e(my_asset('frontend/images/icon/play.png')); ?>" alt="apple icon"> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer bottom end -->
    <!-- coppy-right start -->
    <div class="coppy-right pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text-left">
                        <p class="mb-3 mb-md-0">Copyright &copy; <?php echo e(date('Y')); ?> <a href="#"><?php echo e($generalsetting->site_name); ?></a>. All
                            Rights Reserved</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="text-left">
                        <img src="<?php echo e(my_asset('frontend/images/icon/pay.png')); ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><?php /**PATH D:\xampp\htdocs\stitchdeal\resources\views/frontend/inc/footer.blade.php ENDPATH**/ ?>