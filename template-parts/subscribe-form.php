<form class="label-top subscription" novalidate>
  <div class="form-group">
    <label for="subscription_email"><?php _e('Enter your email', 'emptytheme') ?></label>
    <input
      type="email"
      id="subscription_email"
      name="subscription_email"
      required
      aria-describedby="subscription_error"
    />
    <div id="subscription_error" class="form-error" role="alert" aria-live="polite"></div>
  </div>
  <button type="submit" class="btn btn__green subscription__btn">
    <?php _e('Sign up', 'emptytheme') ?>
  </button>
</form>