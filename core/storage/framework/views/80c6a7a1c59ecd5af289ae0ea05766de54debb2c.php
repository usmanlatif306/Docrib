<?php
    $doctorContent = getContent('doctor.content', true);
    $doctors    = \App\Models\Doctor::active()
        ->with('department', 'location')
        ->orderBy('id', 'DESC')
        ->get(['id', 'name', 'qualification', 'mobile', 'image', 'department_id', 'location_id']);
?>
<!-- our doctor section start -->
<section class="booking-section ptb-80">
    <div class="container-fluid">
        <div class="row ml-b-20">
            <div class="booking-right-area">
                <div class="col-lg-12">
                    <div class="section-header">
                        <h2 class="section-title"><?php echo e(__($doctorContent->data_values->heading)); ?></h2>
                        <p class="m-0"><?php echo e(__($doctorContent->data_values->subheading)); ?></p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="booking-slider">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <div class="booking-item">
                                        <div class="booking-thumb">
                                            <img src="<?php echo e(getImage(getFilePath('doctorProfile') . '/' . @$doctor->image, getFileSize('doctorProfile'))); ?>"
                                                alt="<?php echo app('translator')->get('doctor'); ?>">
                                            <div class="doc-deg"><?php echo e(__($doctor->department->name)); ?></div>
                                            <?php if($doctor->featured): ?>
                                                <span class="fav-btn"><i class="las la-medal"></i></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="booking-content">
                                            <span class="sub-title"><a
                                                    href="<?php echo e(route('doctors.departments', $doctor->department->id)); ?>"><?php echo e(__($doctor->department->name)); ?></a></span>
                                            <h5 class="title"><?php echo e(__($doctor->name)); ?> <i
                                                    class="fas fa-check-circle"></i></h5>
                                            <p><?php echo e(strLimit(__($doctor->qualification), 50)); ?></p>
                                            <ul class="booking-list">
                                                <li><i class="las la-street-view"></i><a
                                                        href="<?php echo e(route('doctors.locations', $doctor->location->id)); ?>"><?php echo e(__($doctor->location->name)); ?></a>
                                                </li>
                                                <li><i class="la la-phone"></i> <?php echo e(__($doctor->mobile)); ?></li>
                                            </ul>
                                            <div class="booking-btn">
                                                <a href="<?php echo e(route('doctors.booking',$doctor->id)); ?>" class="cmn-btn w-100 text-center"><?php echo app('translator')->get('Book Now'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="ruddra-next">
                            <i class="las la-angle-right"></i>
                        </div>
                        <div class="ruddra-prev">
                            <i class="las la-angle-left"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- booking-section end -->
<?php /**PATH C:\wamp64\www\Laravel\docrib\core\resources\views/templates/basic/sections/doctor.blade.php ENDPATH**/ ?>