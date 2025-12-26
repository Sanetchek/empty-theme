/**
 * Breadcrumbs Block JavaScript
 *
 * Handles any interactive functionality for the breadcrumbs block.
 */

(function($) {
    'use strict';

    /**
     * Initialize breadcrumbs block functionality
     */
    function initBreadcrumbsBlock() {
        const $breadcrumbsBlock = $('.breadcrumbs-block');

        if (!$breadcrumbsBlock.length) {
            return;
        }

        // Add smooth scroll behavior for anchor links
        $breadcrumbsBlock.find('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));

            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 100
                }, 500);
            }
        });

        // Add accessibility improvements
        $breadcrumbsBlock.attr('role', 'navigation');
        $breadcrumbsBlock.attr('aria-label', 'Breadcrumb navigation');
    }

    // Initialize on document ready
    $(document).ready(function() {
        initBreadcrumbsBlock();
    });

    // Re-initialize for dynamically loaded content (AJAX)
    $(document).on('breadcrumbsBlockLoaded', function() {
        initBreadcrumbsBlock();
    });

})(jQuery);
