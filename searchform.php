

<form method="get" accept-charset="utf-8" id="searchform" role="search" action="<?php echo home_url( '/' ); ?>">
  <div >
    <input id="search-input" class="wpcf7-text" type="text" name="s" id="s"  placeholder="Pesquisar" value="<?php the_search_query(); ?>" />
      <button role="button" type="submit" class="searchform-submit">
          <span class="fa fa-search" aria-hidden="true"></span>
          <span class="screen-reader-text">Submit</span>
      </button>
  </div>
</form>