  </main>
  
  <!-- Footer -->
  <footer class="border-t border-current/10 mt-16 py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <!-- Brand -->
        <div>
          <h3 class="text-lg font-bold text-primary-600 mb-2">MyDiary</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Your personal space for thoughts, memories, and reflections.
          </p>
        </div>

        <!-- Features -->
        <div>
          <h4 class="font-semibold text-sm uppercase tracking-wide mb-4 text-gray-700 dark:text-gray-300">Features</h4>
          <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
            <li><a href="#" class="hover:text-primary-600 transition">Create Entries</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">Secure Storage</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">User Profile</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">Media Support</a></li>
          </ul>
        </div>

        <!-- Support -->
        <div>
          <h4 class="font-semibold text-sm uppercase tracking-wide mb-4 text-gray-700 dark:text-gray-300">Support</h4>
          <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
            <li><a href="#" class="hover:text-primary-600 transition">Help Center</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">Privacy Policy</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">Terms of Service</a></li>
            <li><a href="#" class="hover:text-primary-600 transition">Contact Us</a></li>
          </ul>
        </div>

        <!-- Social -->
        <div>
          <h4 class="font-semibold text-sm uppercase tracking-wide mb-4 text-gray-700 dark:text-gray-300">Follow Us</h4>
          <div class="flex gap-3">
            <a href="#" class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center hover:bg-primary-200 dark:hover:bg-primary-900/50 transition text-primary-600">
              <span class="text-lg">f</span>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center hover:bg-primary-200 dark:hover:bg-primary-900/50 transition text-primary-600">
              <span class="text-lg">𝕏</span>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center hover:bg-primary-200 dark:hover:bg-primary-900/50 transition text-primary-600">
              <span class="text-lg">in</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Divider -->
      <div class="border-t border-current/10 pt-8 mt-8">
        <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-600 dark:text-gray-400">
          <p>&copy; 2025 MyDiary. All rights reserved.</p>
          <p>Crafted with ❄️ using Arctic Design</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="<?php echo e(rtrim(app_base_url(),'/')); ?>/assets/js/app.js"></script>
  <script>
function togglePassword(id) {
  const input = document.getElementById(id || "password");
  input.type = (input.type === "password") ? "text" : "password";
}
</script>

</body>
</html>
