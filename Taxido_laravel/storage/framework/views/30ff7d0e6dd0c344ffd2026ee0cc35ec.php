<?php use \App\Models\Category; ?>
<?php use \App\Models\Tag; ?>
<?php use \App\Models\Blog; ?>
<?php
    $locale = Session::get('front-locale', getDefaultLangLocale());
    $categories = Category::where('status', true)?->whereNull('deleted_at')?->get();
    $categories = $categories ? $categories->map(function ($category) use ($locale) {
        return $category->toArray($locale);
    })->toArray() : [];

    $tags = Tag::where('status', true)->paginate(10);

    $tags = $tags ? $tags->map(function ($tag) use ($locale) {
        return $tag->toArray($locale);
    })->toArray() : [];

    $blogs = Blog::with(['blog_thumbnail'])?->where('status', true)->paginate(5);

    $recentBlogs = $blogs ? $blogs->map(function ($blog) use ($locale) {
        return $blog->toArray($locale);
    })->toArray() : [];
?>


<?php $__env->startSection('title', __('static.blogs.blog')); ?>
<?php $__env->startSection('content'); ?>

<body>
    
    <section class="blog-details-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="blog-box">
                        <div class="blog-image">
                            <img class="img-fluid" src="<?php echo e(asset(@$blog['blog_thumbnail']['original_url'] ?? '')); ?>"
                                 alt="<?php echo e(@$blog['title'] ?? 'Blog Image'); ?>">
                        </div>
                        <div class="blog-title">
                            <ul class="top-title">
                                <li>
                                    <i class="ri-calendar-line"></i>
                                    <?php echo e(@$blog['created_at'] ? \Carbon\Carbon::parse(@$blog['created_at'])->format('d M, Y') : ''); ?>

                                </li>
                                <li>By <span><?php echo e(@$blog['created_by']['name']); ?></span></li>
                                <li>
                                    <?php $__currentLoopData = $blog['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge"><?php echo e(@$tag['name']); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </li>
                            </ul>
                            <h1><?php echo e(@$blog['title'] ?? ''); ?></h1>
                            <p><?php echo @$blog['description']; ?></p>
                        </div>
                        <div class="blog-contain">
                            <?php echo @$blog['content'] ?? ''; ?>

                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <form class="blog-sidebar-box">
                        
                        <div class="category-list-box">
                            <div class="blog-title">
                                <h3>Category</h3>
                            </div>
                            <ul class="category-list">
                                <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <a href="<?php echo e(route('web.blog.index', ['category' => $category['slug']])); ?>"
                                           class="<?php echo e(request('category') == $category['slug'] ? 'active' : ''); ?>">
                                            <?php echo e(@$category['name']); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>No Categories Found</li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        
                        <div class="recent-post-box">
                            <div class="blog-title">
                                <h3>Recent Posts</h3>
                            </div>
                            <ul class="recent-blog-list">
                                <?php $__empty_1 = true; $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="recent-box">
                                        <a href="<?php echo e(route('blog.slug', ['slug' => $blog['slug']])); ?>" class="recent-image">
                                            <img src="<?php echo e(asset(@$blog['blog_thumbnail']['original_url'] ?? '')); ?>" class="img-fluid recent-image" alt="">
                                        </a>
                                        <div class="post-content">
                                            <h5>
                                                <a href="<?php echo e(route('blog.slug', ['slug' => $blog['slug']])); ?>"><?php echo e(@$blog['title'] ?? ''); ?></a>
                                            </h5>
                                            <h6>
                                                <i class="ri-calendar-line"></i>
                                                <?php echo e(@$blog['created_at'] ? \Carbon\Carbon::parse(@$blog['created_at'])->format('d M, Y') : ''); ?>

                                            </h6>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>No Recent Posts</li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        
                        <div class="tags-list-box">
                            <div class="blog-title">
                                <h3>Tags</h3>
                            </div>
                            <ul class="tags-list">
                                <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li>
                                        <a href="<?php echo e(route('web.blog.index', ['tag' => $tag['slug']])); ?>"
                                           class="<?php echo e(request('tag') == $tag['slug'] ? 'active' : ''); ?>">
                                            <?php echo e(@$tag['name']); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <li>No Tags Found</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/blogs/details.blade.php ENDPATH**/ ?>