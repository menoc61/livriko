<?php $__env->startComponent('mail::message'); ?>
    <strong>Test Mail details: </strong><br>
    <strong>Mail From Name: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_from_name); ?> <br>
    <strong>Mail From Email: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_from_address); ?> <br>
    <strong>Mail Mailer: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_mailer); ?> <br>
    <strong>Mail Host: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_from_address); ?> <br>
    <strong>Mail Port: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_port); ?> <br>
    <strong>Mail Encryption: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_from_address); ?> <br>
    <strong>Mail Username: </strong><?php echo new \Illuminate\Support\EncodedHtmlString($request?->mail_username); ?> <br><br>
<?php echo $__env->renderComponent(); ?>

<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/emails/test-mail.blade.php ENDPATH**/ ?>