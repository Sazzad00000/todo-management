

<?php $__env->startSection('content'); ?>
<h1><?php echo e($task ? 'Edit Task' : 'New Task'); ?></h1>

<?php if($errors->any()): ?>
    <ul style="color:#d33;">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($e); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<form action="<?php echo e($task ? route('tasks.update',$task['id']) : route('tasks.store')); ?>" method="POST" style="margin-top:1.5rem;">
    <?php echo csrf_field(); ?>
    <?php if($task): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <label>Title
        <input type="text" name="title" value="<?php echo e(old('title', $task['title'] ?? '')); ?>" required>
    </label>

    <label>Description
        <textarea name="description" rows="3"><?php echo e(old('description', $task['description'] ?? '')); ?></textarea>
    </label>

    <label>Status
        <select name="status">
            <option value="0" <?php if(old('status',$task['status'] ?? 0)==0): echo 'selected'; endif; ?>>Pending</option>
            <option value="1" <?php if(old('status',$task['status'] ?? 0)==1): echo 'selected'; endif; ?>>Done</option>
        </select>
    </label>

    <button type="submit" style="margin-top:1.5rem;">Save</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\todo-session\resources\views/tasks/form.blade.php ENDPATH**/ ?>