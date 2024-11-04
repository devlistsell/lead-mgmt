<!--each category-->
<div class="x-each-category <?php echo e($leads['search_type'] ?? 'all'); ?>">

    <!--heading-->
    <?php if($leads['search_type'] == 'all'): ?>
    <div class="x-heading clearfix">
        <span class="pull-left x-title">
            <?php echo app('translator')->get('lang.leads'); ?>
        </span>
        <span class="pull-right x-count">
            <a href="javascript:void(0);" class="ajax-request" data-url="<?php echo e(url('search?search_type=leads')); ?>"
                data-type="form" data-form-id="global-search-form" data-ajax-type="post"
                data-loading-target="global-search-form" name="search_query"><?php echo app('translator')->get('lang.view_all'); ?>
                (<?php echo e($leads['count']); ?>)</a>
        </span>
    </div>
    <?php endif; ?>

    <!--results-->
    <ul>

        <!-- each result -->
        <?php $__currentLoopData = $leads['results']->take(runtimeSearchDisplyLimit($leads['search_type'])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="leads">
            <a href="javascript:void(0);">
                <!--icon-->
                <span class="x-icon">
                    <i class="sl-icon-call-in"></i>
                </span>
                <!--title-->
                <span class="x-title">
                    <a href="<?php echo e(url('/leads/v/'.$lead->lead_id.'/'.$lead->lead_id)); ?>"><?php echo e($lead->lead_title); ?></a>
                </span>
                <!--matched  on tags-->
                <?php if($lead->tags->isNotEmpty() && $lead->tags->contains('tag_title', $search_query)): ?>
                <span class="ti-bookmark x-tag-match" title="<?php echo app('translator')->get('lang.matched_tags'); ?>" data-toggle="tooltip"></span>
                <?php endif; ?>
                <!--meta-->
                <span class="x-meta">
                    - <?php echo e($lead->lead_firstname); ?> <?php echo e($lead->lead_lastname); ?>

                </span>
            </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!--ajax loading-->

    </ul>
</div><?php /**PATH C:\xampp\htdocs\GROWCRM\application\resources\views/pages/search/results/leads.blade.php ENDPATH**/ ?>