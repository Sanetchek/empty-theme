/**
 * Options Page JavaScript
 *
 * @package emptytheme
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initPreloader();
        initMaintenanceMode();
        initOptionsPageFeatures();
    });

    /**
     * Initialize preloader functionality
     */
    function initPreloader() {
        const preloaderEnabled = window.emptythemeOptions && window.emptythemeOptions.preloaderEnabled;

        if (!preloaderEnabled) {
            return;
        }

        // Show preloader on page load
        showPreloader();

        // Hide preloader when page is fully loaded
        $(window).on('load', function() {
            hidePreloader();
        });

        // Fallback: hide preloader after 5 seconds
        setTimeout(function() {
            hidePreloader();
        }, 5000);
    }

    /**
     * Show preloader
     */
    function showPreloader() {
        const $preloader = $('#preloader');

        if ($preloader.length === 0) {
            return;
        }

        $preloader.removeClass('hidden removed').show();

        // Add loading text animation
        const $content = $preloader.find('.preloader-content');
        if ($content.length > 0) {
            $content.attr('data-text', 'Loading...');
        }
    }

    /**
     * Hide preloader
     */
    function hidePreloader() {
        const $preloader = $('#preloader');

        if ($preloader.length === 0) {
            return;
        }

        $preloader.addClass('hidden');

        // Remove from DOM after animation
        setTimeout(function() {
            $preloader.addClass('removed');
        }, 500);
    }

    /**
     * Initialize maintenance mode functionality
     */
    function initMaintenanceMode() {
        const maintenanceMode = window.emptythemeOptions && window.emptythemeOptions.maintenanceMode;

        if (!maintenanceMode) {
            return;
        }

        // Add maintenance mode indicator to admin bar
        addMaintenanceIndicator();

        // Add maintenance mode notice to frontend
        addMaintenanceNotice();
    }

    /**
     * Add maintenance mode indicator to admin bar
     */
    function addMaintenanceIndicator() {
        if (!$('#wpadminbar').length) {
            return;
        }

        const $adminBar = $('#wpadminbar');
        const $maintenanceItem = $(`
            <li id="wp-admin-bar-maintenance-mode">
                <a href="#" class="ab-item">
                    <span class="ab-icon">⚠️</span>
                    <span class="ab-label">Maintenance Mode</span>
                </a>
            </li>
        `);

        $adminBar.find('#wp-admin-bar-top-secondary').prepend($maintenanceItem);

        // Add click handler to show maintenance info
        $maintenanceItem.on('click', function(e) {
            e.preventDefault();
            showMaintenanceInfo();
        });
    }

    /**
     * Add maintenance mode notice to frontend
     */
    function addMaintenanceNotice() {
        if ($('body').hasClass('logged-in')) {
            return;
        }

        const $notice = $(`
            <div class="maintenance-notice" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: #f39c12;
                color: #fff;
                text-align: center;
                padding: 10px;
                z-index: 9998;
                font-weight: 500;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            ">
                🚧 Site is currently under maintenance. We'll be back soon!
            </div>
        `);

        $('body').prepend($notice);

        // Auto-hide after 10 seconds
        setTimeout(function() {
            $notice.fadeOut();
        }, 10000);
    }

    /**
     * Show maintenance mode information
     */
    function showMaintenanceInfo() {
        const info = `
            <div class="maintenance-info-modal" style="
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 100000;
                max-width: 500px;
                text-align: center;
            ">
                <h3>🚧 Maintenance Mode Active</h3>
                <p>Your site is currently in maintenance mode. Visitors will see a "Site under construction" page.</p>
                <p><strong>Only logged-in users and administrators can see the normal site.</strong></p>
                <button class="button button-primary" onclick="this.parentElement.remove()">Got it!</button>
            </div>
            <div class="maintenance-info-overlay" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 99999;
            " onclick="this.remove(); this.previousElementSibling.remove();"></div>
        `;

        $('body').append(info);
    }

    /**
     * Initialize options page specific features
     */
    function initOptionsPageFeatures() {
        // Add character counters to textareas
        addCharacterCounters();

        // Add field validation
        addFieldValidation();

        // Add auto-save functionality
        addAutoSave();

        // Add field dependencies
        addFieldDependencies();
    }

    /**
     * Add character counters to textareas
     */
    function addCharacterCounters() {
        $('.large-text, .code').each(function() {
            const $textarea = $(this);
            const maxLength = $textarea.attr('maxlength') || 1000;

            const $counter = $(`
                <div class="char-counter" style="
                    font-size: 12px;
                    color: #666;
                    margin-top: 5px;
                    text-align: right;
                ">0 / ${maxLength}</div>
            `);

            $textarea.after($counter);

            $textarea.on('input', function() {
                const length = $(this).val().length;
                const remaining = maxLength - length;

                $counter.text(`${length} / ${maxLength}`);

                if (remaining < 100) {
                    $counter.css('color', remaining < 50 ? '#d63638' : '#f39c12');
                } else {
                    $counter.css('color', '#666');
                }
            });
        });
    }

    /**
     * Add field validation
     */
    function addFieldValidation() {
        $('form').on('submit', function(e) {
            let hasErrors = false;

            // Clear previous errors
            $('.field-error').removeClass('field-error');
            $('.error-message').remove();

            // Validate required fields
            $('input[required], textarea[required]').each(function() {
                const $field = $(this);
                const value = $field.val().trim();

                if (value === '') {
                    $field.addClass('field-error');
                    showFieldError($field, 'This field is required.');
                    hasErrors = true;
                }
            });

            // Validate email format
            const $email = $('#email');
            if ($email.val() && !isValidEmail($email.val())) {
                $email.addClass('field-error');
                showFieldError($email, 'Please enter a valid email address.');
                hasErrors = true;
            }

            // Validate phone format
            const $phone = $('#phone');
            if ($phone.val() && !isValidPhone($phone.val())) {
                $phone.addClass('field-error');
                showFieldError($phone, 'Please enter a valid phone number.');
                hasErrors = true;
            }

            if (hasErrors) {
                e.preventDefault();
                showFormError('Please fix the errors above before saving.');
                return false;
            }
        });
    }

    /**
     * Show field error message
     */
    function showFieldError($field, message) {
        const $error = $(`
            <div class="error-message" style="
                color: #d63638;
                font-size: 12px;
                margin-top: 5px;
                font-style: italic;
            ">${message}</div>
        `);

        $field.after($error);
    }

    /**
     * Show form error message
     */
    function showFormError(message) {
        const $error = $(`
            <div class="form-error" style="
                background: #d63638;
                color: #fff;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
                text-align: center;
            ">${message}</div>
        `);

        $('.theme-settings h1').after($error);

        // Auto-hide after 5 seconds
        setTimeout(function() {
            $error.fadeOut();
        }, 5000);
    }

    /**
     * Add auto-save functionality
     */
    function addAutoSave() {
        let autoSaveTimer;
        const autoSaveDelay = 3000; // 3 seconds

        $('input, textarea, select').on('input change', function() {
            clearTimeout(autoSaveTimer);

            autoSaveTimer = setTimeout(function() {
                autoSaveForm();
            }, autoSaveDelay);
        });
    }

    /**
     * Auto-save form
     */
    function autoSaveForm() {
        const $form = $('.theme-settings form');
        const $submitButton = $form.find('.submit .button-primary');

        // Show auto-saving indicator
        $submitButton.addClass('auto-saving').text('Auto-saving...');

        // Simulate auto-save (in real implementation, you'd use AJAX)
        setTimeout(function() {
            $submitButton.removeClass('auto-saving').text('Save Settings');

            // Show success message
            showAutoSaveSuccess();
        }, 1000);
    }

    /**
     * Show auto-save success message
     */
    function showAutoSaveSuccess() {
        const $success = $(`
            <div class="auto-save-success" style="
                background: #00a32a;
                color: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                margin-bottom: 20px;
                text-align: center;
                font-size: 14px;
            ">✓ Settings auto-saved successfully!</div>
        `);

        $('.theme-settings h1').after($success);

        // Auto-hide after 3 seconds
        setTimeout(function() {
            $success.fadeOut();
        }, 3000);
    }

    /**
     * Add field dependencies
     */
    function addFieldDependencies() {
        // Show/hide fields based on maintenance mode
        $('#maintenance_mode').on('change', function() {
            const isChecked = $(this).is(':checked');

            if (isChecked) {
                showMaintenanceFields();
            } else {
                hideMaintenanceFields();
            }
        });

        // Show/hide fields based on preloader toggle
        $('#preloader_enabled').on('change', function() {
            const isChecked = $(this).is(':checked');

            if (isChecked) {
                showPreloaderFields();
            } else {
                hidePreloaderFields();
            }
        });
    }

    /**
     * Show maintenance-related fields
     */
    function showMaintenanceFields() {
        $('.maintenance-field').slideDown();
        showMaintenanceWarning();
    }

    /**
     * Hide maintenance-related fields
     */
    function hideMaintenanceFields() {
        $('.maintenance-field').slideUp();
        hideMaintenanceWarning();
    }

    /**
     * Show preloader-related fields
     */
    function showPreloaderFields() {
        $('.preloader-field').slideDown();
    }

    /**
     * Hide preloader-related fields
     */
    function hidePreloaderFields() {
        $('.preloader-field').slideUp();
    }

    /**
     * Show maintenance mode warning
     */
    function showMaintenanceWarning() {
        const $warning = $(`
            <div class="maintenance-warning" style="
                background: #f39c12;
                color: #fff;
                padding: 15px;
                border-radius: 5px;
                margin: 20px 0;
                border-left: 4px solid #e67e22;
            ">
                <strong>⚠️ Warning:</strong> Enabling maintenance mode will hide your site from visitors.
                Only logged-in users and administrators will be able to see the normal site.
            </div>
        `);

        $('#maintenance_mode').closest('td').after($warning);
    }

    /**
     * Hide maintenance mode warning
     */
    function hideMaintenanceWarning() {
        $('.maintenance-warning').remove();
    }

    /**
     * Utility functions
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{7,}$/;
        return phoneRegex.test(phone);
    }

    // Expose functions globally for use in shortcodes
    window.emptythemeOptions = {
        showPreloader: showPreloader,
        hidePreloader: hidePreloader,
        showMaintenanceInfo: showMaintenanceInfo
    };

})(jQuery);