<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo e(config('app.name', 'To-Do')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { background: #f5f5f5; color: #000; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        body.dark { background: #121212; color: #fff; }
        .card { max-width: 800px; background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        body.dark .card { background: #1e1e1e; box-shadow: 0 4px 8px rgba(255,255,255,0.1); }
        .btn { background: #007bff; color: #fff; padding: 0.5rem 1rem; border-radius: 24px; text-decoration: none; }
        body.dark .btn { background: #0d6efd; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem; border: 1px solid #ddd; }
        body.dark .table th, body.dark .table td { border-color: #444; }
    </style>
</head>
<body class="<?php echo e(request()->cookie('theme', 'light')); ?>">

    <!-- থিম টগল বাটন -->
    <?php if(auth()->guard()->check()): ?>
        <form action="<?php echo e(route('theme.toggle')); ?>" method="POST" style="position:fixed;top:1rem;right:1rem;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn">
                <?php echo e(request()->cookie('theme', 'light') === 'dark' ? '☀️' : '🌙'); ?>

            </button>
        </form>
    <?php endif; ?>

    <!-- লগআউট -->
    <?php if(auth()->guard()->check()): ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="position:fixed;top:1rem;right:6rem;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn">Logout</button>
        </form>
    <?php endif; ?>

    <div class="card">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- অটো থিম অ্যাপ্লাই JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const theme = document.cookie.split('; ').find(row => row.startsWith('theme='))
                ?.split('=')[1] || 'light';
            document.body.classList.toggle('dark', theme === 'dark');
        });
    </script>

</body>
</html>
<?php /**PATH C:\Users\USER\todo-session\resources\views/layouts/app.blade.php ENDPATH**/ ?>