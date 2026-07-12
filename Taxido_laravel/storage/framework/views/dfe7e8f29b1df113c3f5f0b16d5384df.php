
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['text', 'name', 'multiple', 'data', 'unallowed_types' => [], 'allowed_types' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['text', 'name', 'multiple', 'data', 'unallowed_types' => [], 'allowed_types' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $unallowed_types_str = is_array($unallowed_types) ? implode(',', $unallowed_types) : $unallowed_types;
    $allowed_types_str = is_array($allowed_types) ? implode(',', $allowed_types) : $allowed_types;
?>
<div class="d-flex gap-3 align-items-start media-relative">
    <div>
        <div class="media-manager" data-name="<?php echo e($name); ?>" data-multiple="<?php echo e($multiple); ?>" data-unallowed-types="<?php echo e($unallowed_types_str); ?>" data-allowed-types="<?php echo e($allowed_types_str); ?>">
            <i class="ri-add-line"></i>
        </div>
        <input type="hidden" name="<?php echo e($name); ?>" value="">
    </div>
    <ul class="image-select-list cursor-pointer" data-name="<?php echo e($name); ?>">
        <?php if($multiple == false && !is_null($data)): ?>
            <li class="selected-media">
                <div class="image-list-detail">
                    <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e(optional($data)->id); ?>">
                    <img src="<?php echo e(optional($data)->original_url); ?>" class="img-fluid">
                    <a href="javascript:void(0)" class="remove-media" data-id="<?php echo e(optional($data)->id); ?>" data-name="<?php echo e($name); ?>">
                        <i class="ri-close-line remove-icon"></i>
                    </a>
                </div>
            </li>
        <?php elseif($multiple == true && !is_null($data) && is_array($data)): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="selected-media">
                    <div class="image-list-detail">
                        <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e($media?->id); ?>">
                        <img src="<?php echo e($media?->original_url); ?>" class="img-fluid">
                        <a href="javascript:void(0)" class="remove-media" data-id="<?php echo e($media?->id); ?>" data-name="<?php echo e($name); ?>">
                            <i class="ri-close-line remove-icon"></i>
                        </a>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>
<?php if(isset($text)): ?>
<p class="description"><?php echo e($text); ?></p>
<?php endif; ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function($) {
    // Media Manager
    window.Media = {
        data: [],
        selectedFiles: [],
        values: [],
        multiple: false,
        id: null,
        name: null
    }
    <?php if (isset($data) && isset($name)): ?>
        window.Media.name = '<?php echo $name; ?>';
        var imageIds = $('input[name="' + window.Media.name + '"]').map(function() {
            return parseInt($(this).val());
        }).get();
        window.Media.values.push({ name: window.Media.name, id: imageIds });
    <?php endif; ?>
})(jQuery);
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/components/image.blade.php ENDPATH**/ ?>