<?php
/**
 * Template Name: Form Elements Demo
 *
 * This template demonstrates all form elements with consistent styling
 */

get_header();
?>

<div class="forms-demo-page">
	<div class="container">
		<section class="forms-demo">
			<header class="forms-demo__header">
				<h1><?php esc_html_e('Form Elements Demo', 'emptytheme'); ?></h1>
				<p><?php esc_html_e('All form elements with consistent styling and functionality', 'emptytheme'); ?></p>
			</header>

			<div class="forms-demo__sections">

				<!-- Text Inputs -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Text Inputs', 'emptytheme'); ?></h2>

					<div class="forms-demo__grid">
						<div class="forms-demo__item">
							<h3><?php esc_html_e('Text Input', 'emptytheme'); ?></h3>
							<?php show_form_input('text_input', 'text', '', [
								'label' => __('Your Name', 'emptytheme'),
								'placeholder' => __('Enter your name...', 'emptytheme'),
								'required' => true,
								'description' => __('This field is required', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Email Input', 'emptytheme'); ?></h3>
							<?php show_form_input('email_input', 'email', '', [
								'label' => __('Email Address', 'emptytheme'),
								'placeholder' => __('your@email.com', 'emptytheme'),
								'required' => true,
								'description' => __('We will never share your email', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Password Input', 'emptytheme'); ?></h3>
							<?php show_form_input('password_input', 'password', '', [
								'label' => __('Password', 'emptytheme'),
								'placeholder' => __('Enter your password...', 'emptytheme'),
								'required' => true,
								'description' => __('Minimum 8 characters', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Phone Input', 'emptytheme'); ?></h3>
							<?php show_form_input('phone_input', 'tel', '', [
								'label' => __('Phone Number', 'emptytheme'),
								'placeholder' => __('+1 (555) 123-4567', 'emptytheme'),
								'description' => __('Include country code', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Number Input', 'emptytheme'); ?></h3>
							<?php show_form_input('number_input', 'number', '', [
								'label' => __('Age', 'emptytheme'),
								'placeholder' => __('25', 'emptytheme'),
								'description' => __('Must be 18 or older', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Date Input', 'emptytheme'); ?></h3>
							<?php show_form_input('date_input', 'date', '', [
								'label' => __('Birth Date', 'emptytheme'),
								'description' => __('Select your birth date', 'emptytheme')
							]); ?>
						</div>
					</div>
				</div>

				<!-- Textarea -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Textarea', 'emptytheme'); ?></h2>

					<div class="forms-demo__item">
						<?php show_form_textarea('message_textarea', '', [
							'label' => __('Your Message', 'emptytheme'),
							'placeholder' => __('Tell us about your project...', 'emptytheme'),
							'rows' => 5,
							'required' => true,
							'description' => __('Please provide as much detail as possible', 'emptytheme')
						]); ?>
					</div>
				</div>

				<!-- Select -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Select Dropdown', 'emptytheme'); ?></h2>

					<div class="forms-demo__grid">
						<div class="forms-demo__item">
							<h3><?php esc_html_e('Country Selection', 'emptytheme'); ?></h3>
							<?php
							$countries = [
								'' => __('Select Country', 'emptytheme'),
								'us' => __('United States', 'emptytheme'),
								'ca' => __('Canada', 'emptytheme'),
								'uk' => __('United Kingdom', 'emptytheme'),
								'de' => __('Germany', 'emptytheme'),
								'fr' => __('France', 'emptytheme'),
								'it' => __('Italy', 'emptytheme'),
								'es' => __('Spain', 'emptytheme'),
								'ru' => __('Russia', 'emptytheme'),
								'jp' => __('Japan', 'emptytheme'),
								'cn' => __('China', 'emptytheme'),
								'au' => __('Australia', 'emptytheme')
							];
							show_form_select('country_select', $countries, '', [
								'label' => __('Country', 'emptytheme'),
								'required' => true,
								'description' => __('Select your country of residence', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Service Selection', 'emptytheme'); ?></h3>
							<?php
							$services = [
								'' => __('Choose Service', 'emptytheme'),
								'web-design' => __('Web Design', 'emptytheme'),
								'web-development' => __('Web Development', 'emptytheme'),
								'mobile-app' => __('Mobile App Development', 'emptytheme'),
								'seo' => __('SEO Services', 'emptytheme'),
								'consulting' => __('Consulting', 'emptytheme')
							];
							show_form_select('service_select', $services, '', [
								'label' => __('Service Type', 'emptytheme'),
								'required' => true,
								'description' => __('What service do you need?', 'emptytheme')
							]); ?>
						</div>
					</div>
				</div>

				<!-- Checkboxes and Radio -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Checkboxes & Radio Buttons', 'emptytheme'); ?></h2>

					<div class="forms-demo__grid">
						<div class="forms-demo__item">
							<h3><?php esc_html_e('Checkboxes', 'emptytheme'); ?></h3>
							<?php show_form_checkbox('newsletter_checkbox', '1', false, [
								'label' => __('Subscribe to Newsletter', 'emptytheme'),
								'description' => __('Get updates about new features and offers', 'emptytheme')
							]); ?>

							<?php show_form_checkbox('terms_checkbox', '1', false, [
								'label' => __('I agree to Terms & Conditions', 'emptytheme'),
								'required' => true,
								'description' => __('You must agree to continue', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Radio Buttons', 'emptytheme'); ?></h3>
							<div class="form-group">
								<label class="form-label"><?php esc_html_e('Preferred Contact Method', 'emptytheme'); ?></label>
								<?php show_form_radio('contact_method', 'email', true, [
									'label' => __('Email', 'emptytheme'),
									'wrapper_class' => ''
								]); ?>
								<?php show_form_radio('contact_method', 'phone', false, [
									'label' => __('Phone', 'emptytheme'),
									'wrapper_class' => ''
								]); ?>
								<?php show_form_radio('contact_method', 'sms', false, [
									'label' => __('SMS', 'emptytheme'),
									'wrapper_class' => ''
								]); ?>
								<div class="form-description"><?php esc_html_e('How would you like us to contact you?', 'emptytheme'); ?></div>
							</div>
						</div>
					</div>
				</div>

				<!-- File Upload -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('File Upload', 'emptytheme'); ?></h2>

					<div class="forms-demo__item">
						<div class="form-group">
							<label for="file_input" class="form-label"><?php esc_html_e('Upload File', 'emptytheme'); ?></label>
							<input type="file" id="file_input" name="file_input" class="form-file" accept=".pdf,.doc,.docx,.jpg,.png">
							<div class="form-description"><?php esc_html_e('Upload your resume or portfolio (PDF, DOC, JPG, PNG)', 'emptytheme'); ?></div>
						</div>
					</div>
				</div>

				<!-- Range Slider -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Range Slider', 'emptytheme'); ?></h2>

					<div class="forms-demo__item">
						<div class="form-group">
							<label for="budget_range" class="form-label"><?php esc_html_e('Budget Range', 'emptytheme'); ?></label>
							<input type="range" id="budget_range" name="budget_range" class="form-range" min="1000" max="50000" value="10000" step="1000">
							<div class="form-description"><?php esc_html_e('Select your budget range: $1,000 - $50,000', 'emptytheme'); ?></div>
						</div>
					</div>
				</div>

				<!-- Form States -->
				<div class="forms-demo__section">
					<h2><?php esc_html_e('Form States', 'emptytheme'); ?></h2>

					<div class="forms-demo__grid">
						<div class="forms-demo__item">
							<h3><?php esc_html_e('Error State', 'emptytheme'); ?></h3>
							<?php show_form_input('error_input', 'text', 'invalid@email', [
								'label' => __('Email Address', 'emptytheme'),
								'error' => __('Please enter a valid email address', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Success State', 'emptytheme'); ?></h3>
							<?php show_form_input('success_input', 'text', 'john@example.com', [
								'label' => __('Email Address', 'emptytheme'),
								'success' => __('Email address is valid', 'emptytheme')
							]); ?>
						</div>

						<div class="forms-demo__item">
							<h3><?php esc_html_e('Disabled State', 'emptytheme'); ?></h3>
							<?php show_form_input('disabled_input', 'text', 'Cannot edit this', [
								'label' => __('Read Only Field', 'emptytheme'),
								'disabled' => true,
								'description' => __('This field is disabled', 'emptytheme')
							]); ?>
						</div>
					</div>
				</div>

				<!-- Dark Theme -->
				<div class="forms-demo__section forms-demo__section--dark">
					<h2><?php esc_html_e('Dark Theme Forms', 'emptytheme'); ?></h2>

					<div class="forms-demo__item">
						<div class="form-group form-group--dark">
							<label for="dark_input" class="form-label"><?php esc_html_e('Dark Theme Input', 'emptytheme'); ?></label>
							<input type="text" id="dark_input" name="dark_input" class="form-input" placeholder="<?php esc_attr_e('Enter text...', 'emptytheme'); ?>">
							<div class="form-description"><?php esc_html_e('This input uses dark theme styling', 'emptytheme'); ?></div>
						</div>
					</div>
				</div>

			</div>

			<div class="forms-demo__usage">
				<h3><?php esc_html_e('Usage Examples', 'emptytheme'); ?></h3>
				<div class="forms-demo__code">
					<h4><?php esc_html_e('PHP Code:', 'emptytheme'); ?></h4>
					<pre><code><?php esc_html_e('// Text input
show_form_input("name", "text", "", [
    "label" => "Your Name",
    "placeholder" => "Enter your name...",
    "required" => true
]);

// Textarea
show_form_textarea("message", "", [
    "label" => "Your Message",
    "rows" => 5,
    "required" => true
]);

// Select dropdown
$options = ["option1" => "Option 1", "option2" => "Option 2"];
show_form_select("choice", $options, "", [
    "label" => "Make a Choice",
    "required" => true
]);

// Checkbox
show_form_checkbox("agree", "1", false, [
    "label" => "I agree to terms",
    "required" => true
]);

// Radio button
show_form_radio("contact", "email", true, [
    "label" => "Email"
]);', 'emptytheme'); ?></code></pre>
				</div>
			</div>

		</section>
	</div>
</div>

<style>
.forms-demo-page {
	padding: 4rem 0;
	background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
	min-height: 100vh;
}

.forms-demo {
	max-width: 1200px;
	margin: 0 auto;
}

.forms-demo__header {
	text-align: center;
	margin-bottom: 4rem;
}

.forms-demo__header h1 {
	font-size: 2.5rem;
	color: var(--color-dark);
	margin-bottom: 1rem;
}

.forms-demo__header p {
	font-size: 1.25rem;
	color: var(--color-text);
}

.forms-demo__sections {
	display: flex;
	flex-direction: column;
	gap: 3rem;
}

.forms-demo__section {
	background: var(--color-white);
	padding: 2rem;
	border-radius: 15px;
}

.forms-demo__section--dark {
	background: var(--color-dark);
	color: var(--color-white);
}

.forms-demo__section h2 {
	font-size: 1.75rem;
	margin-bottom: 2rem;
	color: var(--color-dark);
}

.forms-demo__section--dark h2 {
	color: var(--color-white);
}

.forms-demo__grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 2rem;
}

.forms-demo__item {
	margin-bottom: 1.5rem;
}

.forms-demo__item h3 {
	font-size: 1.25rem;
	margin-bottom: 1rem;
	color: var(--color-dark);
}

.forms-demo__section--dark .forms-demo__item h3 {
	color: var(--color-white);
}

.forms-demo__usage {
	background: var(--color-white);
	padding: 2rem;
	border-radius: 15px;
	margin-top: 2rem;
}

.forms-demo__usage h3 {
	font-size: 1.5rem;
	margin-bottom: 1.5rem;
	color: var(--color-dark);
}

.forms-demo__code {
	background: #f8f9fa;
	padding: 1.5rem;
	border-radius: 8px;
	border-left: 4px solid var(--color-yellow);
}

.forms-demo__code h4 {
	font-size: 1.125rem;
	margin-bottom: 1rem;
	color: var(--color-dark);
}

.forms-demo__code pre {
	margin: 0;
	overflow-x: auto;
}

.forms-demo__code code {
	font-family: 'Courier New', monospace;
	font-size: 0.9rem;
	line-height: 1.5;
	color: #333;
}

@media (max-width: 768px) {
	.forms-demo__grid {
		grid-template-columns: 1fr;
		gap: 1rem;
	}

	.forms-demo__section {
		padding: 1.5rem;
	}
}
</style>

<?php
get_footer();
