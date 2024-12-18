<!--user-->
<?php $__currentLoopData = $assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span 
        class="x-assigned-user js-card-settings-button-static card-lead-assigned card-assigned-listed-user" tabindex="0"
        data-user-id="<?php echo e($user->user_id); ?>" data-popover-content="card-lead-team" 
        data-title="<?php echo e(cleanLang(__('lang.assign_users'))); ?>" data-toggle="tooltip" 
        data-placement="top" title="<?php echo e($user->first_name); ?>">
        <img src="<?php echo e(getUsersAvatar($user->avatar_directory, $user->avatar_filename)); ?>" data-placement="top"
            alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall">
        <span>Leads: <strong><?php echo e($user->total_leads); ?></strong></span>
    </span>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--user--><?php /**PATH C:\xampp\htdocs\growcrm\application\resources\views/pages/lead/components/assigned.blade.php ENDPATH**/ ?>