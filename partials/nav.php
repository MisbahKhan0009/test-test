<?php
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../lib/utils.php';
$authed = is_logged_in();
$base = rtrim(app_base_url(), '/');
?>
<nav class="w-full">
  <div class="container mx-auto px-4 pt-6 pb-4">
    <div class="glass rounded-2xl shadow-xl p-4 flex items-center justify-between">
      <a href="<?php echo e($base); ?>/dashboard.php" class="text-xl font-bold bg-gradient-to-r from-primary-600 to-accent bg-clip-text text-transparent hover:from-primary-700 hover:to-primary-600 transition">
        ❄️ MyDiary
      </a>
      <div class="flex items-center gap-2 md:gap-4 flex-wrap justify-end">
        <?php if ($authed): ?>
          <a href="<?php echo e($base); ?>/dashboard.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition shadow-sm hover:shadow-md text-sm md:text-base">Dashboard</a>
          <a href="<?php echo e($base); ?>/profile.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition text-sm md:text-base">Profile</a>
          <span class="hidden lg:inline text-gray-600 text-sm px-2">Hi, <?php echo e(current_username()); ?></span>
          <a href="<?php echo e($base); ?>/logout.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition text-sm md:text-base">Logout</a>
        <?php else: ?>
          <a href="<?php echo e($base); ?>/index.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition text-sm md:text-base">Login</a>
          <a href="<?php echo e($base); ?>/signup.php" class="px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white transition shadow-md hover:shadow-lg text-sm md:text-base font-medium">Sign Up</a>
        <?php endif; ?>
        <button id="themeToggle" class="px-3 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition border border-primary-200 text-sm" aria-label="Switch theme" title="Toggle dark/light theme">
          <span class="inline-block">🌙</span>
        </button>
      </div>
    </div>
  </div>
</nav>
