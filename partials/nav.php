<?php
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../lib/utils.php';
$authed = is_logged_in();
$base = rtrim(app_base_url(), '/');
?>
<nav class="w-full">
  <div class="container mx-auto px-4 pt-6 pb-4">
    <div class="glass rounded-2xl shadow-xl p-4 flex items-center justify-between">
      <!-- Fancy Logo -->
      <a href="<?php echo e($base); ?>/dashboard.php" class="flex items-center gap-3 hover:opacity-90 transition group no-underline">
        <!-- Logo Icon with gradient and artistic elements -->
        <div class="relative w-12 h-12 flex items-center justify-center">
          <div class="relative bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg w-10 h-10 flex items-center justify-center text-white text-xl font-bold shadow-lg">
            <i class="fas fa-palette"></i>
          </div>
        </div>
        <!-- Fancy Logo Text -->
        <div class="flex flex-col leading-tight">
          <span class="font-display text-2xl font-black bg-gradient-to-r from-primary-600 via-primary-500 to-primary-700 bg-clip-text text-transparent group-hover:from-primary-700 group-hover:to-primary-600 transition no-underline">
            Life Canvas
          </span>
          <span class="font-body text-xs text-gray-500 dark:text-gray-400 tracking-widest uppercase font-medium">
            Your Stories, Our Canvas
          </span>
        </div>
      </a>
      <div class="flex items-center gap-2 md:gap-4 flex-wrap justify-end">
        <?php if ($authed): ?>
          <a href="<?php echo e($base); ?>/dashboard.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 dark:text-gray-200 dark:bg-gray-800/70 dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md text-sm md:text-base">
            <i class="fas fa-home mr-1"></i>My Posts
          </a>
          <?php if (is_admin()): ?>
          <a href="<?php echo e($base); ?>/categories.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 dark:text-gray-200 dark:bg-gray-800/70 dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md text-sm md:text-base">
            <i class="fas fa-tags mr-1"></i>Categories
          </a>
          <?php else: ?>
          <a href="<?php echo e($base); ?>/feed.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 dark:text-gray-200 dark:bg-gray-800/70 dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md text-sm md:text-base">
            <i class="fas fa-globe mr-1"></i>Feed
          </a>
          <?php endif; ?>
          <a href="<?php echo e($base); ?>/analytics.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 dark:text-gray-200 dark:bg-gray-800/70 dark:hover:bg-gray-800 transition shadow-sm hover:shadow-md text-sm md:text-base">
            <i class="fas fa-chart-line mr-1"></i>Analytics
          </a>
          <?php if (is_admin()): ?>
          <a href="<?php echo e($base); ?>/admin.php" class="px-4 py-2 rounded-full bg-red-500/20 hover:bg-red-500/30 text-red-700 dark:text-red-300 transition shadow-sm hover:shadow-md text-sm md:text-base">
            <i class="fas fa-shield-alt mr-1"></i>Admin
          </a>
          <?php endif; ?>
          <!-- Profile Dropdown -->
          <div class="relative">
            <button id="profileDropdown" class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold shadow-md hover:shadow-lg transition text-lg" aria-label="Profile menu">
              <?php echo strtoupper(substr(current_username(), 0, 1)); ?>
            </button>
            <!-- Dropdown Menu -->
            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-2xl shadow-xl py-2 z-50 border border-gray-200 dark:border-gray-700">
              <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                <p class="text-sm font-medium text-gray-800 dark:text-white"><?php echo e(current_username()); ?></p>
              </div>
              <a href="<?php echo e($base); ?>/profile.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition">
                Profile
              </a>
              <a href="<?php echo e($base); ?>/create.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition">
                ➕ New Entry
              </a>
              <a href="<?php echo e($base); ?>/logout.php" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                Logout
              </a>
            </div>
          </div>
        <?php else: ?>
          <a href="<?php echo e($base); ?>/index.php" class="px-4 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 transition text-sm md:text-base">Login</a>
          <a href="<?php echo e($base); ?>/signup.php" class="px-4 py-2 rounded-full bg-primary-600 hover:bg-primary-700 text-white transition shadow-md hover:shadow-lg text-sm md:text-base font-medium">Sign Up</a>
        <?php endif; ?>
        <button id="themeToggle" class="px-3 py-2 rounded-full bg-white/70 hover:bg-white/90 text-gray-700 dark:bg-gray-700/70 dark:text-gray-200 transition border border-primary-200 dark:border-gray-600 text-sm" aria-label="Switch theme" title="Toggle dark/light theme">
          <i class="fas fa-moon"></i>
        </button>
      </div>
    </div>
  </div>
</nav>
