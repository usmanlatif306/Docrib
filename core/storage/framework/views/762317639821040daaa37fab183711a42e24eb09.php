<?php
    $contactUsContent = getContent('contact_us.content',true);
?>
<!-- map-section start -->
<section class="map-section pd-t-80">
    <div class="container-fluid p-0">
        <div class="row justify-content-center m-0">
            <div class="col-lg-12 p-0">
                <div class="row justify-content-center ml-b-30">
                    <div class="col-lg-12 mrb-30">
                        <div class="maps"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- map-section end -->

<?php $__env->startPush('script'); ?>
    <!-- main -->
    <script src="https://maps.google.com/maps/api/js?key=<?php echo e($contactUsContent->data_values->google_map_key); ?>"></script>
    <script src="<?php echo e(asset($activeTemplateTrue.'js/map.js')); ?>"></script>
    <script>
        (function ($) {
            "use strict";

            var mapOptions = {
                center: new google.maps.LatLng(<?php echo e($contactUsContent->data_values->latitude); ?>, <?php echo e($contactUsContent->data_values->longitude); ?>),
                zoom: 12,
                scrollwheel: true,
                backgroundColor: 'transparent',
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementsByClassName("maps")[0],
                mapOptions);
            var myLatlng = new google.maps.LatLng(<?php echo e($contactUsContent->data_values->latitude); ?>, <?php echo e($contactUsContent->data_values->longitude); ?>);
            var focusplace = {lat: <?php echo e($contactUsContent->data_values->latitude); ?> , lng: <?php echo e($contactUsContent->data_values->longitude); ?> };
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
            })
        })(jQuery);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\wamp64\www\Laravel\docrib\core\resources\views/templates/basic/sections/map.blade.php ENDPATH**/ ?>