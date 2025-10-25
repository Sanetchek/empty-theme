<?php
/**
 * Maintenance Mode Template
 *
 * @package emptytheme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?php _e('Site Under Construction', 'emptytheme'); ?> - <?php bloginfo('name'); ?></title>

    <?php wp_head(); ?>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .maintenance-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .maintenance-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        .maintenance-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .maintenance-message {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.9;
            color: #fff;
        }

        .maintenance-progress {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .maintenance-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #45a049);
            border-radius: 3px;
            animation: progress 3s ease-in-out infinite;
        }

        .maintenance-contact {
            font-size: 1rem;
            opacity: 0.8;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 1rem;
        }

        .maintenance-contact a {
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            transition: border-color 0.3s ease;
        }

        .maintenance-contact a:hover {
            border-bottom-color: #fff;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes progress {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }

        @media (max-width: 768px) {
            .maintenance-container {
                margin: 1rem;
                padding: 1.5rem;
            }

            .maintenance-title {
                font-size: 2rem;
            }

            .maintenance-message {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="maintenance-container">
        <div class="maintenance-icon">🚧</div>

        <h1 class="maintenance-title">
            <?php _e('Site Under Construction', 'emptytheme'); ?>
        </h1>

        <p class="maintenance-message">
            <?php _e('We\'re working hard to bring you something amazing! Our site is currently undergoing maintenance and improvements.', 'emptytheme'); ?>
        </p>

        <div class="maintenance-progress">
            <div class="maintenance-progress-bar"></div>
        </div>

        <div class="maintenance-contact">
            <?php
            $phone = emptytheme_get_option('phone');
            $email = emptytheme_get_option('email');

            if ($phone || $email) {
                _e('Need to get in touch?', 'emptytheme');
                echo '<br>';

                if ($phone) {
                    printf(
                        '<a href="tel:%s">%s</a>',
                        esc_attr($phone),
                        esc_html($phone)
                    );
                }

                if ($phone && $email) {
                    echo ' | ';
                }

                if ($email) {
                    printf(
                        '<a href="mailto:%s">%s</a>',
                        esc_attr($email),
                        esc_html($email)
                    );
                }
            }
            ?>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>