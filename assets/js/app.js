// Client-side helpers: previews, simple validation, transitions, theme toggle

function previewMedia(input, previewContainerId) {
  const container = document.getElementById(previewContainerId);
  if (!container) return;
  container.innerHTML = '';
  const files = input.files || [];
  Array.from(files).forEach((file) => {
    const url = URL.createObjectURL(file);
    if (file.type.startsWith('image/')) {
      const img = document.createElement('img');
      img.className = 'w-24 h-24 object-cover rounded-xl shadow-md';
      img.src = url;
      container.appendChild(img);
    } else if (file.type.startsWith('audio/')) {
      const audio = document.createElement('audio');
      audio.controls = true;
      audio.src = url;
      audio.className = 'w-full';
      container.appendChild(audio);
    }
  });
}

function attachConfirm(selector, message) {
  document.querySelectorAll(selector).forEach((el) => {
    el.addEventListener('click', (e) => {
      if (!confirm(message)) {
        e.preventDefault();
      }
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  attachConfirm('[data-confirm]','Are you sure? This cannot be undone.');
  
  // Profile dropdown toggle
  try {
    const dropdownBtn = document.getElementById('profileDropdown');
    const dropdownMenu = document.getElementById('profileMenu');
    
    if (dropdownBtn && dropdownMenu) {
      dropdownBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
      });
      
      // Close dropdown when clicking outside
      document.addEventListener('click', (e) => {
        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
      
      // Close dropdown on Escape key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !dropdownMenu.classList.contains('hidden')) {
          dropdownMenu.classList.add('hidden');
        }
      });
    }
  } catch {}
  
  // Theme toggle button
  try {
    const root = document.documentElement;
    const btn = document.getElementById('themeToggle');
    if (btn) {
      let theme = root.getAttribute('data-theme') || 'light';
      const updateIcon = () => {
        const icon = btn.querySelector('span');
        if (icon) {
          icon.textContent = theme === 'dark' ? '☀️' : '🌙';
        }
        btn.setAttribute('aria-label', `Switch to ${theme === 'dark' ? 'light' : 'dark'} theme`);
      };
      updateIcon();
      
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        theme = theme === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        updateIcon();
      });
    }
  } catch {}

  // Toast auto-dismiss
  try {
    document.querySelectorAll('.toast').forEach((el) => {
      const timer = setTimeout(() => { el.remove(); }, 4500);
      const btn = el.querySelector('.toast-dismiss');
      if (btn) btn.addEventListener('click', () => { clearTimeout(timer); el.remove(); });
    });
  } catch {}
});
