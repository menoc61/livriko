<?php if(Session::has('success')): ?>
    <div class="toastr-message" data-type="success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <div class="toastr-message" data-type="error"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php if(Session::has('info')): ?>
    <div class="toastr-message" data-type="info"><?php echo e(session('info')); ?></div>
<?php endif; ?>

<?php if(Session::has('warning')): ?>
    <div class="toastr-message" data-type="warning"><?php echo e(session('warning')); ?></div>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.toastr-message').each(function() {
            var messageType = $(this).data('type');
            var messageText = $(this).text();
            toastr.options = {
                "closeButton": false,
                "progressBar": true,
                "extendedTimeOut": 0,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "preventDuplicates": true,
                "preventOpenDuplicates": true
            };

            switch (messageType) {
                case 'success':
                    toastr.success(messageText);
                    break;
                case 'error':
                    toastr.error(messageText);
                    break;
                case 'info':
                    toastr.info(messageText);
                    break;
                case 'warning':
                    toastr.warning(messageText);
                    break;
                default:
                    toastr.info(messageText);
            }
        });
    });
</script>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/inc/alerts.blade.php ENDPATH**/ ?>