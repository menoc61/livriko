
<!-- jquery JS -->
<script src="<?php echo e(asset('front/js/jquery.js')); ?>"></script>

<!-- Bootstrap JS -->
<script src="<?php echo e(asset('front/js/bootstrap.js')); ?>"></script>

<!-- JQuery Validation js -->
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>

<!-- Toaster Js -->
<script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>

<!-- Swiper JS -->
<script src="<?php echo e(asset('front/js/swiper.js')); ?>"></script>
<script src="<?php echo e(asset('front/js/custom-swiper.js')); ?>"></script>

<!-- Custom Script JS -->
<script src="<?php echo e(asset('front/js/script.js')); ?>"></script>
<script src="<?php echo e(asset('front/js/dark-mode.js')); ?>"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('js/select2.full.min.js')); ?>"></script>


<?php if(Request::is('/')): ?>
    <?php
        $tawkToPropertyId = $content['analytics']['tawk_to_property_id'] ?? null;
    ?>

    <?php if($tawkToPropertyId): ?>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/<?php echo e($tawkToPropertyId); ?>/1imjq4fqu';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    <?php endif; ?>
<?php endif; ?>

<?php echo $__env->yieldPushContent('js'); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/layouts/script.blade.php ENDPATH**/ ?>