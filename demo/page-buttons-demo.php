<?php
/**
 * Template Name: Form Buttons Demo
 *
 * Demo page to show different styles of submit buttons
 *
 * @package emptytheme
 */

get_header();
?>

<div class="container">
    <article class="page-content-wrapper">
        <div class="page-wrapper">
            <header class="entry-header">
                <div class="container">
                    <h1 class="entry-title"><?php esc_html_e('Form Buttons Demo', 'emptytheme'); ?></h1>
                    <div class="entry-excerpt">
                        <?php esc_html_e('Different styles of submit buttons for various use cases', 'emptytheme'); ?>
                    </div>
                </div>
            </header>

            <div class="entry-content">
                <div class="container">
                    <div class="buttons-demo">

                        <!-- Basic Styles -->
                        <section class="demo-section">
                            <h2><?php esc_html_e('Basic Styles', 'emptytheme'); ?></h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3><?php esc_html_e('Standard Button', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Submit', 'emptytheme'); ?>">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Button Element', 'emptytheme'); ?></h3>
                                    <form>
                                        <button type="submit"><?php esc_html_e('Submit Form', 'emptytheme'); ?></button>
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('With Icon', 'emptytheme'); ?></h3>
                                    <form>
                                        <button type="submit">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M22 2L11 13M22 2L15 22L11 13M22 2L2 9L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php esc_html_e('Submit', 'emptytheme'); ?>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Alternative Styles -->
                        <section class="demo-section">
                            <h2><?php esc_html_e('Alternative Styles', 'emptytheme'); ?></h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3><?php esc_html_e('Outline Style', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Outline Button', 'emptytheme'); ?>" class="outline">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Dark Style', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Dark Button', 'emptytheme'); ?>" class="dark">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('With form-submit-button Class', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('With form-submit-button Class', 'emptytheme'); ?>" class="form-submit-button">
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Sizes -->
                        <section class="demo-section">
                            <h2><?php esc_html_e('Button Sizes', 'emptytheme'); ?></h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3><?php esc_html_e('Small', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="Small" class="small">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Normal', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="Normal">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Large', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Large Button', 'emptytheme'); ?>" class="large">
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- States -->
                        <section class="demo-section">
                            <h2><?php esc_html_e('Button States', 'emptytheme'); ?></h2>
                            <div class="demo-grid">
                                <div class="demo-item">
                                    <h3><?php esc_html_e('Normal', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Normal', 'emptytheme'); ?>">
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Disabled', 'emptytheme'); ?></h3>
                                    <form>
                                        <input type="submit" value="<?php esc_html_e('Disabled', 'emptytheme'); ?>" disabled>
                                    </form>
                                </div>

                                <div class="demo-item">
                                    <h3><?php esc_html_e('Loading', 'emptytheme'); ?></h3>
                                    <form>
                                        <button type="submit" class="loading"><?php esc_html_e('Loading...', 'emptytheme'); ?></button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <!-- Full Form -->
                        <section class="demo-section">
                            <h2><?php esc_html_e('Full Form', 'emptytheme'); ?></h2>
                            <form class="demo-form">
                                <div class="form-group">
                                    <label for="name" class="form-label"><?php esc_html_e('Name', 'emptytheme'); ?></label>
                                    <input type="text" id="name" name="name" class="form-input" placeholder="<?php esc_attr_e('Enter your name', 'emptytheme'); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label"><?php esc_html_e('Email', 'emptytheme'); ?></label>
                                    <input type="email" id="email" name="email" class="form-input" placeholder="<?php esc_attr_e('your@email.com', 'emptytheme'); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="message" class="form-label"><?php esc_html_e('Message', 'emptytheme'); ?></label>
                                    <textarea id="message" name="message" class="form-textarea" placeholder="<?php esc_attr_e('Your message', 'emptytheme'); ?>"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="<?php esc_html_e('Send Message', 'emptytheme'); ?>">
                                </div>
                            </form>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </article>
</div>

<style>
.buttons-demo {
    padding: 2rem 0;
}

.demo-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.demo-section h2 {
    margin-bottom: 2rem;
    color: var(--color-dark);
    font-family: var(--font-urbanist);
    font-size: 1.75rem;
    border-bottom: 2px solid var(--color-yellow);
    padding-bottom: 0.5rem;
}

.demo-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.demo-item {
    background: var(--color-white);
    padding: 1.5rem;
    border-radius: 12px;
}

.demo-item h3 {
    margin-bottom: 1rem;
    color: var(--color-dark);
    font-family: var(--font-urbanist);
    font-size: 1.125rem;
}

.demo-form {
    max-width: 500px;
    margin: 0 auto;
}

.demo-form .form-group {
    margin-bottom: 1.5rem;
}

.demo-form .form-group:last-child {
    margin-bottom: 0;
    text-align: center;
}
</style>

<?php
get_footer();
