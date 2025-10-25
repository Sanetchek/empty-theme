<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="search-form" role="search">
  <label for="search" class="screen-reader-text"><?php esc_html_e('Search by keyword', 'emptytheme'); ?></label>
  <div class="search-form__container">
    <input
      type="text"
      name="s"
      id="search"
      class="search-field"
      value="<?php the_search_query(); ?>"
      placeholder="<?php esc_attr_e('Search by keyword...', 'emptytheme'); ?>"
      autocomplete="off"
    />
    <button type="submit" class="search-submit">
      <span class="search-submit__text"><?php esc_html_e('Search', 'emptytheme'); ?></span>
    </button>
  </div>
</form>
