document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('mobile-menu');
  const overlay = document.getElementById('mobile-menu-overlay');
  const menuToggle = document.querySelector('.header-burger');
  const menuClose = document.querySelector('.mobile-menu__close');
  const body = document.body;

  // Function to close menu
  function closeMenu() {
    menu.classList.remove('active');
    overlay.classList.remove('active');
    menuToggle.setAttribute('aria-expanded', 'false');
    menuToggle.classList.remove('active');
    body.classList.remove('no-scroll');
    body.classList.remove('mobile-menu-open');

    // Return focus to toggle button
    if (menuToggle) {
      menuToggle.focus();
    }
  }

  // Function to open menu
  function openMenu() {
    menu.classList.add('active');
    overlay.classList.add('active');
    menuToggle.setAttribute('aria-expanded', 'true');
    menuToggle.classList.add('active');
    body.classList.add('no-scroll');

    // Add class to slide content on mobile (< 768px)
    if (window.innerWidth < 768) {
      body.classList.add('mobile-menu-open');
    }

    // Focus management - move focus to first menu item
    const firstMenuItem = menu.querySelector('a, button');
    if (firstMenuItem) {
      // Small delay to ensure menu is visible
      setTimeout(() => {
        firstMenuItem.focus();
      }, 100);
    }
  }

  // Open menu on burger click
  if (menuToggle && menu && overlay) {
    menuToggle.addEventListener('click', () => {
      const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        closeMenu();
      } else {
        openMenu();
      }
    });
  }

  // Close menu on overlay click
  if (overlay) {
    overlay.addEventListener('click', closeMenu);
  }

  // Close menu on close button click
  if (menuClose) {
    menuClose.addEventListener('click', closeMenu);
  }

  // Close menu on ESC key press
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menu && menu.classList.contains('active')) {
      closeMenu();
    }
  });

  // Trap focus within menu when open
  if (menu) {
    menu.addEventListener('keydown', (e) => {
      if (!menu.classList.contains('active')) return;

      // Get all focusable elements in menu
      const focusableElements = menu.querySelectorAll(
        'a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])'
      );

      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      // Handle Tab key
      if (e.key === 'Tab') {
        if (e.shiftKey) {
          // Shift + Tab
          if (document.activeElement === firstElement) {
            e.preventDefault();
            lastElement.focus();
          }
        } else {
          // Tab
          if (document.activeElement === lastElement) {
            e.preventDefault();
            firstElement.focus();
          }
        }
      }
    });
  }
});
