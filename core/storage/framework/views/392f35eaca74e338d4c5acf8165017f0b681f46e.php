<?php $__env->startSection('content'); ?>
    <div class="login-main" style="background-image: url('<?php echo e(asset('assets/admin/images/login.jpg')); ?>')">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-8 col-sm-11">
                    <div class="login-area">
                        <div class="login-wrapper">
                            <div class="login-wrapper__top">
                                <a class="site-logo site-title" href="<?php echo e(route('home')); ?>"><img
                                        src="<?php echo e(getImage(getFilePath('logoIcon') . '/logo.png')); ?>" alt="logo"></a>
                                <h4 class="title text-white mt-1"><?php echo app('translator')->get('Welcome to'); ?>
                                    <strong><?php echo e(__($general->site_name)); ?></strong>
                                </h4>

                            </div>
                            <div class="login-wrapper__body">
                                <form method="POST" class="cmn-form verify-gcaptcha login-form route">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Select Access'); ?></label>

                                        <select name="access" id="access" class="form-select" required>
                                            <option value="" selected disabled> <?php echo app('translator')->get('Select One'); ?></option>
                                            <option value="" data-route="<?php echo e(route('doctor.login')); ?>"
                                                data-href="<?php echo e(route('doctor.password.reset')); ?>"><?php echo app('translator')->get('Doctor'); ?>
                                            </option>
                                            <option value="" data-route="<?php echo e(route('assistant.login')); ?>"
                                                data-href="<?php echo e(route('assistant.password.reset')); ?>"><?php echo app('translator')->get('Assistant'); ?>
                                            </option>
                                            <option value="" data-route="<?php echo e(route('staff.login')); ?>"
                                                data-href="<?php echo e(route('staff.password.reset')); ?>"><?php echo app('translator')->get('Staff'); ?>
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Username'); ?></label>
                                        <input type="text" class="form-control" value="<?php echo e(old('username')); ?>"
                                            name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo app('translator')->get('Password'); ?></label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>

                                    <?php if (isset($component)) { $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243 = $component; } ?>
<?php $component = App\View\Components\Captcha::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('captcha'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Captcha::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243)): ?>
<?php $component = $__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243; ?>
<?php unset($__componentOriginalc0af13564821b3ac3d38dfa77d6cac9157db8243); ?>
<?php endif; ?>

                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                            <label class="form-check-label" for="remember"><?php echo app('translator')->get('Remember Me'); ?></label>
                                        </div>
                                        <a class="forget-text forget"><?php echo app('translator')->get('Forgot Password?'); ?></a>
                                    </div>
                                    <button type="submit" class="btn cmn-btn w-100"><?php echo app('translator')->get('LOGIN'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>
    <style>
        .form-select {
            line-height: 2.2 !important;
            box-shadow: unset !important
        }

        .login-wrapper__top {
            padding: 34px 12px 34px 12px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        'use strict';
        $(document).ready(function() {
            var elemData = $("select[name=access]");

            var targetRoute = elemData.find('option:selected').data('route');
            var forget = elemData.find('option:selected').data('href');
            $('.route').attr('action', targetRoute);
            $(".forget").attr("href", forget);

            $("select[name=access]").on('change', function() {
                var targetRoute = $(this).find('option:selected').data('route');
                var forget = $(this).find('option:selected').data('href');
                $('.route').attr('action', targetRoute);
                $(".forget").attr("href", forget);
            });

            // function submitUserForm() {
            //     var response = grecaptcha.getResponse();
            //     if (response.length == 0) {
            //         document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;"><?php echo app('translator')->get('Captcha field is required.'); ?></span>';
            //         return false;
            //     }
            //     return true;
            // }
            // function verifyCaptcha() {
            //     document.getElementById('g-recaptcha-error').innerHTML = '';
            // }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('staff.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Laravel\docrib\core\resources\views/templates/basic/login.blade.php ENDPATH**/ ?>