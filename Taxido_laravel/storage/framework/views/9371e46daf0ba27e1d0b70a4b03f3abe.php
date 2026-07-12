<?php use \App\Models\Blog; ?>
<?php use \App\Enums\RoleEnum; ?>
<?php
    $dateRange = getStartAndEndDate(request('sort'), request('start'), request('end'));
    $start_date = $dateRange['start'] ?? null;
    $end_date = $dateRange['end'] ?? null;
    $blogs = Blog::where('status', true)->orderby('created_at')->limit(2)
        ?->whereBetween('created_at', [$start_date, $end_date])
        ->get();
?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('blog.index')): ?>
    <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <div>
                            <h5 class="m-0"><?php echo e(__('static.blogs.recent_blog')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('admin.blog.index')); ?>"><span><?php echo e(__('static.view_all')); ?></span></a>
                    </div>
                </div>
                <div class="card-body top-blogs pt-0">
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-sm-6">
                                    <?php
                                        $route = route('admin.blog.edit', [$blog->id]) .
                                        '?locale=' .
                                        app()->getLocale();
                                    ?>
                                    <a href="<?php echo e($route); ?>"><img src="<?php echo e(asset($blog?->blog_thumbnail?->asset_url ?? '')); ?>" class="img-fluid"
                                    alt=""></a>
                                <h5><?php echo e($blog->title); ?></h5>
                                <p><?php echo e($blog->description); ?></p>
                                <div class="d-flex">
                                    <a href="<?php echo e(route('blog.slug',@$blog['slug'])); ?>"><?php echo e(__('static.blogs.read_more')); ?></a>
                                    <span>| <?php echo e($blog->created_at->format('d M, Y')); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <div class="table-no-data">
                                <img src = "<?php echo e(asset('images/dashboard/data-not-found.svg')); ?>" alt="data not found">
                                <h6 class="text-center"><?php echo e(__('static.widgets.no_data_available')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/admin/widgets/top-blogs.blade.php ENDPATH**/ ?>