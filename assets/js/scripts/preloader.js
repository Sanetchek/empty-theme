/**
 * Preloader JavaScript
 *
 * @package emptytheme
 */

document.addEventListener('DOMContentLoaded', function() {
    initPreloader();
});

/**
 * Initialize preloader functionality
 */
function initPreloader() {
    const preloader = document.getElementById('preloader');

    if (!preloader) {
        return;
    }

    // Show preloader immediately
    showPreloader();

    // Hide preloader when page is fully loaded
    window.addEventListener('load', function() {
        hidePreloader();
    });

    // Fallback: hide preloader after 5 seconds
    setTimeout(function() {
        hidePreloader();
    }, 5000);

    // Additional fallback for slow connections
    setTimeout(function() {
        hidePreloader();
    }, 10000);
}

/**
 * Show preloader
 */
function showPreloader() {
    const preloader = document.getElementById('preloader');

    if (!preloader) {
        return;
    }

    preloader.classList.remove('hidden', 'removed');
    preloader.style.display = 'flex';

    // Add live region for screen readers
    let liveRegion = preloader.querySelector('.preloader-live-region');
    if (!liveRegion) {
        liveRegion = document.createElement('div');
        liveRegion.className = 'preloader-live-region sr-only';
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        preloader.appendChild(liveRegion);
    }
    liveRegion.textContent = 'Page is loading, please wait...';

    // Add loading animation to progress bar
    const progressBar = preloader.querySelector('.preloader-progress-bar');
    if (progressBar) {
        progressBar.style.animation = 'progress 3s ease-in-out infinite';
    }
}

/**
 * Hide preloader with smooth transition
 */
function hidePreloader() {
    const preloader = document.getElementById('preloader');

    if (!preloader || preloader.classList.contains('hidden')) {
        return;
    }

    // Update live region for screen readers
    const liveRegion = preloader.querySelector('.preloader-live-region');
    if (liveRegion) {
        liveRegion.textContent = 'Page has finished loading';
    }

    // Add hidden class for fade out effect
    preloader.classList.add('hidden');

    // Remove from DOM after animation completes
    setTimeout(function() {
        preloader.classList.add('removed');
        preloader.style.display = 'none';
    }, 500);
}

/**
 * Force hide preloader (for manual control)
 */
function forceHidePreloader() {
    const preloader = document.getElementById('preloader');

    if (preloader) {
        preloader.classList.add('hidden', 'removed');
        preloader.style.display = 'none';
    }
}

// Export functions for global access
window.emptythemePreloader = {
    show: showPreloader,
    hide: hidePreloader,
    forceHide: forceHidePreloader
};
