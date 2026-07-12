<?php use \App\Models\Category; ?>
<?php use \App\Models\Tag; ?>
<?php use \App\Models\Blog; ?>
<?php
    $locale = Session::get('front-locale', getDefaultLangLocale());
    $categories = Category::where('status', true)->get();
    $categories = $categories ? $categories->map(fn($category) => $category->toArray($locale))->toArray() : [];

    $tags = Tag::where('status', true)->paginate(10);
    $tags = $tags ? $tags->map(fn($tag) => $tag->toArray($locale))->toArray() : [];

    // Fetch filtered blogs
    $categorySlug = request('category');
    $tagSlug = request('tag');
    $query = Blog::with(['blog_thumbnail'])?->where('status', true);
    if ($categorySlug) {
        $query->whereHas('categories', fn($q) => $q->where('slug', $categorySlug));
    }

    if ($tagSlug) {
        $query->whereHas('tags', fn($q) => $q->where('slug', $tagSlug));
    }

    $blogs = $query->paginate(9);
    $recentBlogs = $blogs ? $blogs?->map(function ($blog) use ($locale) {
        return $blog->toArray($locale);
    })?->toArray() : [];

?>
<?php $__env->startSection('title', __('static.blogs.all_blogs')); ?>
<?php $__env->startSection('content'); ?>
    
    <section id="blog" class="blog-list-section section-b-space">
        <div class="container">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-lg-4">
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
                                <h3><?php echo e(__('static.blogs.all_blogs')); ?></h3>
                            </div>

                            <ul class="recent-blog-list">
                                <?php $__empty_1 = true; $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <li class="recent-box">
                                        <a href="#!" class="recent-image">
                                            <img src="<?php echo e(asset(@$blog['blog_thumbnail']['original_url'] ?? '')); ?>"
                                                class="img-fluid recent-image" alt="">
                                        </a>
                                        <div class="post-content">
                                            <h5>
                                                <a href="#!"><?php echo e(@$blog['title'] ?? ''); ?></a>
                                            </h5>
                                            <h6><i class="ri-calendar-line"></i>
                                                <?php echo e(@$blog['created_at'] ? \Carbon\Carbon::parse($blog['created_at'])->format('d M, Y') : ''); ?>

                                            </h6>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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

                <div class="col-xxl-9 col-lg-8">
                    <div class="row g-sm-4 g-3">
                        <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-12">
                                <div class="blog-box">
                                    <a href="<?php echo e(route('blog.slug', @$blog['slug'])); ?>" class="blog-img">
                                        <img class="img-fluid"
                                            src="<?php echo e(asset($blog['blog_thumbnail']['original_url'] ?? '')); ?>"
                                            alt="">
                                    </a>
                                    <div class="blog-details">
                                        <h4>
                                            <a
                                                href="<?php echo e(route('blog.slug', @$blog['slug'])); ?>"><?php echo e(@$blog['title'] ?? ''); ?></a>
                                        </h4>
                                        <p><?php echo e(@$blog['description'] ?? ''); ?></p>
                                        <button onclick="location.href = '<?php echo e(route('blog.slug', @$blog['slug'])); ?>';"
                                            class="link-btn btn">Know More</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p>Not Blogs Found</p>
                        <?php endif; ?>
                    </div>

                    <div class="pagination-box">
                        <?php echo e($blogs->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/livriko.fr/Taxido_laravel/resources/views/front/blogs/index.blade.php ENDPATH**/ ?>