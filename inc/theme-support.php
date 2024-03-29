<?php

/*
	@package ribirththeme
	
	========================
		THEME SUPPORT OPTIONS
	========================
*/

$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach ( $formats as $format ){
	$output[] = ( @$options[$format] == 1 ? $format : '' );
}
if( !empty( $options ) ){
	add_theme_support( 'post-formats', $output );
}

$header = get_option( 'custom_header' );
if( @$header == 1 ){
	add_theme_support( 'custom-header' );
}

$background = get_option( 'custom_background' );
if( @$background == 1 ){
	add_theme_support( 'custom-background' );
}



add_theme_support( 'post-thumbnails' );

add_image_size( 'admin-list-thumb', 80, 80, true);

add_image_size( 'gallery-thumb', 400, 300, true );

add_image_size( 'square-thumb', 600, 600, true );

add_image_size( 'gallerys', 300, 244, true);

add_image_size( 'gallerys-thumb', 600, 488, true);


/* Activate Nav Menu Option */
function rebirth_register_nav_menu() {
	register_nav_menu( 'primary', 'Header Navigation Menu' );
    register_nav_menu( 'mobile', 'Mobile Navigation Menu' );
}
add_action( 'after_setup_theme', 'rebirth_register_nav_menu' );




add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
return array_merge( $sizes, array(
'gallery-thumb' => __( 'Gallery-Thumb' ),
'gallerys' => __( 'Gallerys' ),
) );
}




add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="link-pages"';
}


function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

/*
	========================
		BLOG LOOP CUSTOM FUNCTIONS
	========================
*/
function rebirth_posted_meta(){
	$posted_on = get_the_date();
	$categories = get_the_category();
	$separator = ',';
	$output = '';
	$i = 1;
	
	if( !empty($categories) ):
		foreach( $categories as $category ):
			if( $i > 1 ): $output .= $separator; endif;
			$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name ) .'">' . esc_html( $category->name ) .'</a>';
			$i++; 
		endforeach;
	endif;
	
	return '<span class="posted-on">' . $posted_on . '</span>';
}
function rebirth_posted_footer(){
	$comments_num = get_comments_number();
	if( comments_open() ){
		if( $comments_num == 0 ){
			$comments = __('No Comments');
		} elseif ( $comments_num > 1 ){
			$comments= $comments_num . __(' Comments');
		} else {
			$comments = __('1 Comment');
		}
		$comments = '<a href="' . get_comments_link() . '">'. $comments .' <span class="rebirth-icon rebirth-comment"></span></a>';
	} else {
		$comments = __('Comments are closed');
	}
	
	return '<div class="post-footer-container"><div class="row-theme"><div class="col-xs-12 col-sm-6">'. get_the_tag_list('<div class="tags-list"><span class="rebirth-icon rebirth-tag"></span>', ' ', '</div>') .'</div><div class="col-xs-12 col-sm-6 text-right">'. $comments .'</div></div></div>';

}


function rebirth_get_attachment( $num = 1 ){
	
	$output = '';
    if (has_post_thumbnail() && $num == 1):
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); else:
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => $num,
            'post_parent' => get_the_ID(),
        ));
    if ($attachments && $num == 1):
            foreach ($attachments as $attachment):
                $output = wp_get_attachment_url($attachment->ID);
    endforeach; elseif ($attachments && $num > 1):
            $output = $attachments;
    endif;
    
    wp_reset_postdata();
    endif;
    return $output;
}


function rebirth_get_all_attachments_id( $id ){
	
    $attachments = get_children(array('post_parent'=>$id));
 
    $num = count($attachments);
	if( has_post_thumbnail() && $num == 1 ): 
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
       
	else:
        
		$attachments = get_posts( array( 
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' =>$id,
            'order' => 'ASC',
            'orderby' => 'menu_order'
		) );
         
		if( $attachments && $num == 1 ):
			foreach ( $attachments as $attachment ):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif( $attachments && $num > 1 ):
			$output = $attachments;
		endif;
		$output = $attachments;
       
		wp_reset_postdata();
        
		
	endif;
	
	return $output;
}


function rebirth_get_all_attachments( $num = 1 ){
	
	$output = '';
    $attachments = get_children(array('post_parent'=>$post->ID));
    $num = count($attachments);
	if( has_post_thumbnail() && $num == 1 ): 
		$output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
	else:
		$attachments = get_posts( array( 
			'post_type' => 'attachment',
			'posts_per_page' => $num,
			'post_parent' => get_the_ID()
		) );
		if( $attachments && $num == 1 ):
			foreach ( $attachments as $attachment ):
				$output = wp_get_attachment_url( $attachment->ID );
			endforeach;
		elseif( $attachments && $num > 1 ):
			$output = $attachments;
		endif;
		
		wp_reset_postdata();
		
	endif;
	
	return $output;
}





function rebirth_get_embedded_media( $type = array() ){
	$content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
	$embed = get_media_embedded_in_content( $content, $type );
	
	if( in_array( 'audio' , $type) ):
		$output = str_replace( '?visual=true', '?visual=false', $embed[0] );
	else:
		$output = $embed[0];
	endif;
	
	return $output;
}




function wp_pagination($query) {
           $total = $query->max_num_pages;
                             
           if ( $total > 1 )  {
               // get the current page 
              
               if ( !$current_page = get_query_var('paged') )
                 $current_page = 1;
              
         // structure of "format" depends on whether we're using pretty permalinks
                if( get_option('permalink_structure') ) {
                     $format = 'page/%#%/';
                 } else {
                     $format = 'page/%#%/';
                 }
               
               
               
               echo paginate_links(array(
                  'base'     => get_pagenum_link(1) . '%_%',
                  'format'   => $format,
                  'current'  => $current_page,
                  'total'    => $total,
                  'mid_size' => 4,
                  'type'     => 'list'
                ));

           }

}

function search_paging_nav($query) {
    
    $total = $query->max_num_pages;
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $total,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '<span class="meta-nav-prev"></span> Previous', 'awaken' ),
		'next_text' => __( 'Next <span class="meta-nav-next"></span>', 'awaken' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'awaken' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}

function geraTitle() {
    bloginfo('name');
    if( !is_home() ){
        echo ' | ';
        the_title();
    }
}

/* Envio de E-mail */

function enviar_e_checar_email($nome, $email, $mensagem) {
        return wp_mail( '', 'Email teste', 'Nome: ' . $nome . "\n" . $mensagem  );
}


// Registrar áreas de widgets
function theme_widgets_init() {
 // Área 1
 register_sidebar( array (
 'name' => 'Primary Widget Area',
 'id' => 'primary_widget_area',
 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
 'after_widget' => "</li>",
 'before_title' => '<h3 class="widget-title">',
 'after_title' => '</h3>',
  ) );
 
 // Área 2
 register_sidebar( array (
 'name' => 'Secondary Widget Area',
 'id' => 'secondary_widget_area',
 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
 'after_widget' => "</li>",
 'before_title' => '<h3 class="widget-title">',
 'after_title' => '</h3>',
  ) );
    
    
  // Área 3
 register_sidebar( array (
 'name' => 'Services Sidebar',
 'id' => 'services_widget_area',
 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
 'after_widget' => "</li>",
 'before_title' => '<h3 class="widget-title">',
 'after_title' => '</h3>',
  ) );
    
  // Área 4
 register_sidebar( array (
 'name' => 'Consulting Sidebar',
 'id' => 'consulting_widget_area',
 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
 'after_widget' => "</li>",
 'before_title' => '<h3 class="widget-title">',
 'after_title' => '</h3>',
  ) );
    
  // Área 5  
  register_sidebar( array (
 'name' => 'Services Frontpage Sidebar',
 'id' => 'services_frontpage_widget_area',
 'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
 'after_widget' => "</li>",
 'before_title' => '<h3 class="widget-title">',
 'after_title' => '</h3>',
  ) );
    
    
   
} // end theme_widgets_init
 
add_action( 'init', 'theme_widgets_init' );


$preset_widgets = array (
 'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
 'secondary_widget_area'  => array( 'links', 'meta' )
);
if ( isset( $_GET['activated'] ) ) {
 update_option( 'sidebars_widgets', $preset_widgets );
}
// update_option( 'sidebars_widgets', NULL );


// Verificar widgets nas áreas de widgets
function is_sidebar_active( $index ){
  global $wp_registered_sidebars;
 
  $widgetcolums = wp_get_sidebars_widgets();
 
  if ($widgetcolums[$index]) return true;
 
 return false;
} // end is_sidebar_active

function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
    $excerpt = preg_replace("/<iframe[^>]+\>/i", "(video) ", $excerpt);       
  $excerpt = strip_tags($excerpt);
  $excerpt =  mb_substr($excerpt, 0, $count, 'UTF-8');
  $excerpt = $excerpt.'...';

  $string="value1
        value2
        value3
        value4
        value5";
    
$quebra = explode("\n", str_replace("\r","\n",get_the_content()));


    
  return $excerpt;
}


function custom_excerpt_length( $length ) {
 return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length');




function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


function sk23_remove_contactForm7_css() {
$handle =  'contact-form-7';
wp_deregister_style( $handle );
}
add_action( 'wp_print_styles', 'sk23_remove_contactForm7_css', 100 );



//Funções para lista de comentários

// Chamada customizada de comentários
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
 $GLOBALS['comment_depth'] = $depth;
  ?>
   <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
    <div class="comment-author vcard"><?php commenter_link() ?></div>
    <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'seu-template'),
       get_comment_date(),
       get_comment_time(),
       '#comment-' . get_comment_ID() );
       edit_comment_link(__('Edit', 'seu-template'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'seu-template') ?>
          <div class="comment-content">
        <?php comment_text() ?>
    </div>
  <?php // echo the comment reply link
   if($args['type'] == 'all' || get_comment_type() == 'comment') :
    comment_reply_link(array_merge($args, array(
     'reply_text' => __('Reply','seu-template'),
     'login_text' => __('Log in to reply.','seu-template'),
     'depth' => $depth,
     'before' => '<div class="comment-reply-link">',
     'after' => '</div>'
    )));
   endif;
  ?>
<?php }


// Chamada customizada para listar trackbacks
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
      <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
       <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'seu-template'),
         get_comment_author_link(),
         get_comment_date(),
         get_comment_time() );
         edit_comment_link(__('Edit', 'seu-template'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'seu-template') ?>
            <div class="comment-content">
       <?php comment_text() ?>
   </div>
<?php } // end custom_pings


// Produz um avatar compatível com hCard
function commenter_link() {
 $commenter = get_comment_author_link();
 if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
  $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
 } else {
  $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
 }
 $avatar_email = get_comment_author_email();
 $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
 echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );




function get_fontawesome_icons() {
        $icons = array(
            'fa-adjust' => 'fa-adjust',
            'fa-adn' => 'fa-adn',
            'fa-align-center' => 'fa-align-center',
            'fa-align-justify' => 'fa-align-justify',
            'fa-align-left' => 'fa-align-left',
            'fa-align-right' => 'fa-align-right',
            'fa-ambulance' => 'fa-ambulance',
            'fa-anchor' => 'fa-anchor',
            'fa-android' => 'fa-android',
            'fa-angellist' => 'fa-angellist',
            'fa-angle-double-down' => 'fa-angle-double-down',
            'fa-angle-double-left' => 'fa-angle-double-left',
            'fa-angle-double-right' => 'fa-angle-double-right',
            'fa-angle-double-up' => 'fa-angle-double-up',
            'fa-angle-down' => 'fa-angle-down',
            'fa-angle-left' => 'fa-angle-left',
            'fa-angle-right' => 'fa-angle-right',
            'fa-angle-up' => 'fa-angle-up',
            'fa-apple' => 'fa-apple',
            'fa-archive' => 'fa-archive',
            'fa-area-chart' => 'fa-area-chart',
            'fa-arrow-circle-down' => 'fa-arrow-circle-down',
            'fa-arrow-circle-left' => 'fa-arrow-circle-left',
            'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down',
            'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left',
            'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right',
            'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up',
            'fa-arrow-circle-right' => 'fa-arrow-circle-right',
            'fa-arrow-circle-up' => 'fa-arrow-circle-up',
            'fa-arrow-down' => 'fa-arrow-down',
            'fa-arrow-left' => 'fa-arrow-left',
            'fa-arrow-right' => 'fa-arrow-right',
            'fa-arrow-up' => 'fa-arrow-up',
            'fa-arrows' => 'fa-arrows',
            'fa-arrows-alt' => 'fa-arrows-alt',
            'fa-arrows-h' => 'fa-arrows-h',
            'fa-arrows-v' => 'fa-arrows-v',
            'fa-asterisk' => 'fa-asterisk',
            'fa-at' => 'fa-at',
            'fa-automobile' => 'fa-automobile',
            'fa-backward' => 'fa-backward',
            'fa-ban' => 'fa-ban',
            'fa-bank' => 'fa-bank',
            'fa-bar-chart' => 'fa-bar-chart',
            'fa-bar-chart-o' => 'fa-bar-chart-o',
            'fa-barcode' => 'fa-barcode',
            'fa-bars' => 'fa-bars',
            'fa-bed' => 'fa-bed',
            'fa-beer' => 'fa-beer',
            'fa-behance' => 'fa-behance',
            'fa-behance-square' => 'fa-behance-square',
            'fa-bell' => 'fa-bell',
            'fa-bell-o' => 'fa-bell-o',
            'fa-bell-slash' => 'fa-bell-slash',
            'fa-bell-slash-o' => 'fa-bell-slash-o',
            'fa-bicycle' => 'fa-bicycle',
            'fa-binoculars' => 'fa-binoculars',
            'fa-birthday-cake' => 'fa-birthday-cake',
            'fa-bitbucket' => 'fa-bitbucket',
            'fa-bitbucket-square' => 'fa-bitbucket-square',
            'fa-bitcoin' => 'fa-bitcoin',
            'fa-bold' => 'fa-bold',
            'fa-bolt' => 'fa-bolt',
            'fa-bomb' => 'fa-bomb',
            'fa-book' => 'fa-book',
            'fa-bookmark' => 'fa-bookmark',
            'fa-bookmark-o' => 'fa-bookmark-o',
            'fa-briefcase' => 'fa-briefcase',
            'fa-btc' => 'fa-btc',
            'fa-bug' => 'fa-bug',
            'fa-building' => 'fa-building',
            'fa-building-o' => 'fa-building-o',
            'fa-bullhorn' => 'fa-bullhorn',
            'fa-bullseye' => 'fa-bullseye',
            'fa-bus' => 'fa-bus',
            'fa-buysellads' => 'fa-buysellads',
            'fa-cab' => 'fa-cab',
            'fa-calculator' => 'fa-calculator',
            'fa-calendar' => 'fa-calendar',
            'fa-calendar-o' => 'fa-calendar-o',
            'fa-camera' => 'fa-camera',
            'fa-camera-retro' => 'fa-camera-retro',
            'fa-car' => 'fa-car',
            'fa-caret-down' => 'fa-caret-down',
            'fa-caret-left' => 'fa-caret-left',
            'fa-caret-right' => 'fa-caret-right',
            'fa-caret-square-o-down' => 'fa-caret-square-o-down',
            'fa-caret-square-o-left' => 'fa-caret-square-o-left',
            'fa-caret-square-o-right' => 'fa-caret-square-o-right',
            'fa-caret-square-o-up' => 'fa-caret-square-o-up',
            'fa-caret-up' => 'fa-caret-up',
            'fa-cart-arrow-down' => 'fa-cart-arrow-down',
            'fa-cart-plus' => 'fa-cart-plus',
            'fa-cc' => 'fa-cc',
            'fa-cc-amex' => 'fa-cc-amex',
            'fa-cc-discover' => 'fa-cc-discover',
            'fa-cc-mastercard' => 'fa-cc-mastercard',
            'fa-cc-paypal' => 'fa-cc-paypal',
            'fa-cc-stripe' => 'fa-cc-stripe',
            'fa-cc-visa' => 'fa-cc-visa',
            'fa-certificate' => 'fa-certificate',
            'fa-chain' => 'fa-chain',
            'fa-chain-broken' => 'fa-chain-broken',
            'fa-check' => 'fa-check',
            'fa-check-circle' => 'fa-check-circle',
            'fa-check-circle-o' => 'fa-check-circle-o',
            'fa-check-square' => 'fa-check-square',
            'fa-check-square-o' => 'fa-check-square-o',
            'fa-chevron-circle-down' => 'fa-chevron-circle-down',
            'fa-chevron-circle-left' => 'fa-chevron-circle-left',
            'fa-chevron-circle-right' => 'fa-chevron-circle-right',
            'fa-chevron-circle-up' => 'fa-chevron-circle-up',
            'fa-chevron-down' => 'fa-chevron-down',
            'fa-chevron-left' => 'fa-chevron-left',
            'fa-chevron-right' => 'fa-chevron-right',
            'fa-chevron-up' => 'fa-chevron-up',
            'fa-child' => 'fa-child',
            'fa-circle' => 'fa-circle',
            'fa-circle-o' => 'fa-circle-o',
            'fa-circle-o-notch' => 'fa-circle-o-notch',
            'fa-circle-thin' => 'fa-circle-thin',
            'fa-clipboard' => 'fa-clipboard',
            'fa-clock-o' => 'fa-clock-o',
            'fa-close' => 'fa-close',
            'fa-cloud' => 'fa-cloud',
            'fa-cloud-download' => 'fa-cloud-download',
            'fa-cloud-upload' => 'fa-cloud-upload',
            'fa-cny' => 'fa-cny',
            'fa-code' => 'fa-code',
            'fa-code-fork' => 'fa-code-fork',
            'fa-codepen' => 'fa-codepen',
            'fa-coffee' => 'fa-coffee',
            'fa-cog' => 'fa-cog',
            'fa-cogs' => 'fa-cogs',
            'fa-columns' => 'fa-columns',
            'fa-comment' => 'fa-comment',
            'fa-comment-o' => 'fa-comment-o',
            'fa-comments' => 'fa-comments',
            'fa-comments-o' => 'fa-comments-o',
            'fa-compass' => 'fa-compass',
            'fa-compress' => 'fa-compress',
            'fa-connectdevelop' => 'fa-connectdevelop',
            'fa-copy' => 'fa-copy',
            'fa-copyright' => 'fa-copyright',
            'fa-credit-card' => 'fa-credit-card',
            'fa-crop' => 'fa-crop',
            'fa-crosshairs' => 'fa-crosshairs',
            'fa-css3' => 'fa-css3',
            'fa-cube' => 'fa-cube',
            'fa-cubes' => 'fa-cubes',
            'fa-cut' => 'fa-cut',
            'fa-cutlery' => 'fa-cutlery',
            'fa-dashboard' => 'fa-dashboard',
            'fa-dashcube' => 'fa-dashcube',
            'fa-database' => 'fa-database',
            'fa-dedent' => 'fa-dedent',
            'fa-delicious' => 'fa-delicious',
            'fa-desktop' => 'fa-desktop',
            'fa-deviantart' => 'fa-deviantart',
            'fa-diamond' => 'fa-diamond',
            'fa-digg' => 'fa-digg',
            'fa-dollar' => 'fa-dollar',
            'fa-dot-circle-o' => 'fa-dot-circle-o',
            'fa-download' => 'fa-download',
            'fa-dribbble' => 'fa-dribbble',
            'fa-dropbox' => 'fa-dropbox',
            'fa-drupal' => 'fa-drupal',
            'fa-edit' => 'fa-edit',
            'fa-eject' => 'fa-eject',
            'fa-ellipsis-h' => 'fa-ellipsis-h',
            'fa-ellipsis-v' => 'fa-ellipsis-v',
            'fa-empire' => 'fa-empire',
            'fa-envelope' => 'fa-envelope',
            'fa-envelope-o' => 'fa-envelope-o',
            'fa-envelope-square' => 'fa-envelope-square',
            'fa-eraser' => 'fa-eraser',
            'fa-eur' => 'fa-eur',
            'fa-euro' => 'fa-euro',
            'fa-exchange' => 'fa-exchange',
            'fa-exclamation' => 'fa-exclamation',
            'fa-exclamation-circle' => 'fa-exclamation-circle',
            'fa-exclamation-triangle' => 'fa-exclamation-triangle',
            'fa-expand' => 'fa-expand',
            'fa-external-link' => 'fa-external-link',
            'fa-external-link-square' => 'fa-external-link-square',
            'fa-eye' => 'fa-eye',
            'fa-eye-slash' => 'fa-eye-slash',
            'fa-eyedropper' => 'fa-eyedropper',
            'fa-facebook' => 'fa-facebook',
            'fa-facebook-f' => 'fa-facebook-f',
            'fa-facebook-official' => 'fa-facebook-official',
            'fa-facebook-square' => 'fa-facebook-square',
            'fa-fast-backward' => 'fa-fast-backward',
            'fa-fast-forward' => 'fa-fast-forward',
            'fa-fax' => 'fa-fax',
            'fa-female' => 'fa-female',
            'fa-fighter-jet' => 'fa-fighter-jet',
            'fa-file' => 'fa-file',
            'fa-file-archive-o' => 'fa-file-archive-o',
            'fa-file-audio-o' => 'fa-file-audio-o',
            'fa-file-code-o' => 'fa-file-code-o',
            'fa-file-excel-o' => 'fa-file-excel-o',
            'fa-file-image-o' => 'fa-file-image-o',
            'fa-file-movie-o' => 'fa-file-movie-o',
            'fa-file-o' => 'fa-file-o',
            'fa-file-pdf-o' => 'fa-file-pdf-o',
            'fa-file-photo-o' => 'fa-file-photo-o',
            'fa-file-picture-o' => 'fa-file-picture-o',
            'fa-file-powerpoint-o' => 'fa-file-powerpoint-o',
            'fa-file-sound-o' => 'fa-file-sound-o',
            'fa-file-text' => 'fa-file-text',
            'fa-file-text-o' => 'fa-file-text-o',
            'fa-file-video-o' => 'fa-file-video-o',
            'fa-file-word-o' => 'fa-file-word-o',
            'fa-file-zip-o' => 'fa-file-zip-o',
            'fa-files-o' => 'fa-files-o',
            'fa-film' => 'fa-film',
            'fa-filter' => 'fa-filter',
            'fa-fire' => 'fa-fire',
            'fa-fire-extinguisher' => 'fa-fire-extinguisher',
            'fa-flag' => 'fa-flag',
            'fa-flag-checkered' => 'fa-flag-checkered',
            'fa-flag-o' => 'fa-flag-o',
            'fa-flash' => 'fa-flash',
            'fa-flask' => 'fa-flask',
            'fa-flickr' => 'fa-flickr',
            'fa-floppy-o' => 'fa-floppy-o',
            'fa-folder' => 'fa-folder',
            'fa-folder-o' => 'fa-folder-o',
            'fa-folder-open' => 'fa-folder-open',
            'fa-folder-open-o' => 'fa-folder-open-o',
            'fa-font' => 'fa-font',
            'fa-forumbee' => 'fa-forumbee',
            'fa-forward' => 'fa-forward',
            'fa-foursquare' => 'fa-foursquare',
            'fa-frown-o' => 'fa-frown-o',
            'fa-futbol-o' => 'fa-futbol-o',
            'fa-gamepad' => 'fa-gamepad',
            'fa-gavel' => 'fa-gavel',
            'fa-gbp' => 'fa-gbp',
            'fa-ge' => 'fa-ge',
            'fa-gear' => 'fa-gear',
            'fa-gears' => 'fa-gears',
            'fa-genderless' => 'fa-genderless',
            'fa-gift' => 'fa-gift',
            'fa-git' => 'fa-git',
            'fa-git-square' => 'fa-git-square',
            'fa-github' => 'fa-github',
            'fa-github-alt' => 'fa-github-alt',
            'fa-github-square' => 'fa-github-square',
            'fa-gittip' => 'fa-gittip',
            'fa-glass' => 'fa-glass',
            'fa-globe' => 'fa-globe',
            'fa-google' => 'fa-google',
            'fa-google-plus' => 'fa-google-plus',
            'fa-google-plus-square' => 'fa-google-plus-square',
            'fa-google-wallet' => 'fa-google-wallet',
            'fa-graduation-cap' => 'fa-graduation-cap',
            'fa-gratipay' => 'fa-gratipay',
            'fa-group' => 'fa-group',
            'fa-h-square' => 'fa-h-square',
            'fa-hacker-news' => 'fa-hacker-news',
            'fa-hand-o-down' => 'fa-hand-o-down',
            'fa-hand-o-left' => 'fa-hand-o-left',
            'fa-hand-o-right' => 'fa-hand-o-right',
            'fa-hand-o-up' => 'fa-hand-o-up',
            'fa-hdd-o' => 'fa-hdd-o',
            'fa-header' => 'fa-header',
            'fa-headphones' => 'fa-headphones',
            'fa-heart' => 'fa-heart',
            'fa-heart-o' => 'fa-heart-o',
            'fa-heartbeat' => 'fa-heartbeat',
            'fa-history' => 'fa-history',
            'fa-home' => 'fa-home',
            'fa-hospital-o' => 'fa-hospital-o',
            'fa-hotel' => 'fa-hotel',
            'fa-html5' => 'fa-html5',
            'fa-ils' => 'fa-ils',
            'fa-image' => 'fa-image',
            'fa-inbox' => 'fa-inbox',
            'fa-indent' => 'fa-indent',
            'fa-info' => 'fa-info',
            'fa-info-circle' => 'fa-info-circle',
            'fa-inr' => 'fa-inr',
            'fa-instagram' => 'fa-instagram',
            'fa-institution' => 'fa-institution',
            'fa-ioxhost' => 'fa-ioxhost',
            'fa-italic' => 'fa-italic',
            'fa-joomla' => 'fa-joomla',
            'fa-jpy' => 'fa-jpy',
            'fa-jsfiddle' => 'fa-jsfiddle',
            'fa-key' => 'fa-key',
            'fa-keyboard-o' => 'fa-keyboard-o',
            'fa-krw' => 'fa-krw',
            'fa-language' => 'fa-language',
            'fa-laptop' => 'fa-laptop',
            'fa-lastfm' => 'fa-lastfm',
            'fa-lastfm-square' => 'fa-lastfm-square',
            'fa-leaf' => 'fa-leaf',
            'fa-leanpub' => 'fa-leanpub',
            'fa-legal' => 'fa-legal',
            'fa-lemon-o' => 'fa-lemon-o',
            'fa-level-down' => 'fa-level-down',
            'fa-level-up' => 'fa-level-up',
            'fa-life-bouy' => 'fa-life-bouy',
            'fa-life-buoy' => 'fa-life-buoy',
            'fa-life-ring' => 'fa-life-ring',
            'fa-life-saver' => 'fa-life-saver',
            'fa-lightbulb-o' => 'fa-lightbulb-o',
            'fa-line-chart' => 'fa-line-chart',
            'fa-link' => 'fa-link',
            'fa-linkedin' => 'fa-linkedin',
            'fa-linkedin-square' => 'fa-linkedin-square',
            'fa-linux' => 'fa-linux',
            'fa-list' => 'fa-list',
            'fa-list-alt' => 'fa-list-alt',
            'fa-list-ol' => 'fa-list-ol',
            'fa-list-ul' => 'fa-list-ul',
            'fa-location-arrow' => 'fa-location-arrow',
            'fa-lock' => 'fa-lock',
            'fa-long-arrow-down' => 'fa-long-arrow-down',
            'fa-long-arrow-left' => 'fa-long-arrow-left',
            'fa-long-arrow-right' => 'fa-long-arrow-right',
            'fa-long-arrow-up' => 'fa-long-arrow-up',
            'fa-magic' => 'fa-magic',
            'fa-magnet' => 'fa-magnet',
            'fa-mail-forward' => 'fa-mail-forward',
            'fa-mail-reply' => 'fa-mail-reply',
            'fa-mail-reply-all' => 'fa-mail-reply-all',
            'fa-male' => 'fa-male',
            'fa-map-marker' => 'fa-map-marker',
            'fa-mars' => 'fa-mars',
            'fa-mars-double' => 'fa-mars-double',
            'fa-mars-stroke' => 'fa-mars-stroke',
            'fa-mars-stroke-h' => 'fa-mars-stroke-h',
            'fa-mars-stroke-v' => 'fa-mars-stroke-v',
            'fa-maxcdn' => 'fa-maxcdn',
            'fa-meanpath' => 'fa-meanpath',
            'fa-medium' => 'fa-medium',
            'fa-medkit' => 'fa-medkit',
            'fa-meh-o' => 'fa-meh-o',
            'fa-mercury' => 'fa-mercury',
            'fa-microphone' => 'fa-microphone',
            'fa-microphone-slash' => 'fa-microphone-slash',
            'fa-minus' => 'fa-minus',
            'fa-minus-circle' => 'fa-minus-circle',
            'fa-minus-square' => 'fa-minus-square',
            'fa-minus-square-o' => 'fa-minus-square-o',
            'fa-mobile' => 'fa-mobile',
            'fa-mobile-phone' => 'fa-mobile-phone',
            'fa-money' => 'fa-money',
            'fa-moon-o' => 'fa-moon-o',
            'fa-mortar-board' => 'fa-mortar-board',
            'fa-motorcycle' => 'fa-motorcycle',
            'fa-music' => 'fa-music',
            'fa-navicon' => 'fa-navicon',
            'fa-neuter' => 'fa-neuter',
            'fa-newspaper-o' => 'fa-newspaper-o',
            'fa-openid' => 'fa-openid',
            'fa-outdent' => 'fa-outdent',
            'fa-pagelines' => 'fa-pagelines',
            'fa-paint-brush' => 'fa-paint-brush',
            'fa-paper-plane' => 'fa-paper-plane',
            'fa-paper-plane-o' => 'fa-paper-plane-o',
            'fa-paperclip' => 'fa-paperclip',
            'fa-paragraph' => 'fa-paragraph',
            'fa-paste' => 'fa-paste',
            'fa-pause' => 'fa-pause',
            'fa-paw' => 'fa-paw',
            'fa-paypal' => 'fa-paypal',
            'fa-pencil' => 'fa-pencil',
            'fa-pencil-square' => 'fa-pencil-square',
            'fa-pencil-square-o' => 'fa-pencil-square-o',
            'fa-phone' => 'fa-phone',
            'fa-phone-square' => 'fa-phone-square',
            'fa-photo' => 'fa-photo',
            'fa-picture-o' => 'fa-picture-o',
            'fa-pie-chart' => 'fa-pie-chart',
            'fa-pied-piper' => 'fa-pied-piper',
            'fa-pied-piper-alt' => 'fa-pied-piper-alt',
            'fa-pinterest' => 'fa-pinterest',
            'fa-pinterest-p' => 'fa-pinterest-p',
            'fa-pinterest-square' => 'fa-pinterest-square',
            'fa-plane' => 'fa-plane',
            'fa-play' => 'fa-play',
            'fa-play-circle' => 'fa-play-circle',
            'fa-play-circle-o' => 'fa-play-circle-o',
            'fa-plug' => 'fa-plug',
            'fa-plus' => 'fa-plus',
            'fa-plus-circle' => 'fa-plus-circle',
            'fa-plus-square' => 'fa-plus-square',
            'fa-plus-square-o' => 'fa-plus-square-o',
            'fa-power-off' => 'fa-power-off',
            'fa-print' => 'fa-print',
            'fa-puzzle-piece' => 'fa-puzzle-piece',
            'fa-qq' => 'fa-qq',
            'fa-qrcode' => 'fa-qrcode',
            'fa-question' => 'fa-question',
            'fa-question-circle' => 'fa-question-circle',
            'fa-quote-left' => 'fa-quote-left',
            'fa-quote-right' => 'fa-quote-right',
            'fa-ra' => 'fa-ra',
            'fa-random' => 'fa-random',
            'fa-rebel' => 'fa-rebel',
            'fa-recycle' => 'fa-recycle',
            'fa-reddit' => 'fa-reddit',
            'fa-reddit-square' => 'fa-reddit-square',
            'fa-refresh' => 'fa-refresh',
            'fa-remove' => 'fa-remove',
            'fa-renren' => 'fa-renren',
            'fa-reorder' => 'fa-reorder',
            'fa-repeat' => 'fa-repeat',
            'fa-reply' => 'fa-reply',
            'fa-reply-all' => 'fa-reply-all',
            'fa-retweet' => 'fa-retweet',
            'fa-rmb' => 'fa-rmb',
            'fa-road' => 'fa-road',
            'fa-rocket' => 'fa-rocket',
            'fa-rotate-left' => 'fa-rotate-left',
            'fa-rotate-right' => 'fa-rotate-right',
            'fa-rouble' => 'fa-rouble',
            'fa-rss' => 'fa-rss',
            'fa-rss-square' => 'fa-rss-square',
            'fa-rub' => 'fa-rub',
            'fa-ruble' => 'fa-ruble',
            'fa-rupee' => 'fa-rupee',
            'fa-save' => 'fa-save',
            'fa-scissors' => 'fa-scissors',
            'fa-search' => 'fa-search',
            'fa-search-minus' => 'fa-search-minus',
            'fa-search-plus' => 'fa-search-plus',
            'fa-sellsy' => 'fa-sellsy',
            'fa-send' => 'fa-send',
            'fa-send-o' => 'fa-send-o',
            'fa-server' => 'fa-server',
            'fa-share' => 'fa-share',
            'fa-share-alt' => 'fa-share-alt',
            'fa-share-alt-square' => 'fa-share-alt-square',
            'fa-share-square' => 'fa-share-square',
            'fa-share-square-o' => 'fa-share-square-o',
            'fa-shekel' => 'fa-shekel',
            'fa-sheqel' => 'fa-sheqel',
            'fa-shield' => 'fa-shield',
            'fa-ship' => 'fa-ship',
            'fa-shirtsinbulk' => 'fa-shirtsinbulk',
            'fa-shopping-cart' => 'fa-shopping-cart',
            'fa-sign-in' => 'fa-sign-in',
            'fa-sign-out' => 'fa-sign-out',
            'fa-signal' => 'fa-signal',
            'fa-simplybuilt' => 'fa-simplybuilt',
            'fa-sitemap' => 'fa-sitemap',
            'fa-skyatlas' => 'fa-skyatlas',
            'fa-skype' => 'fa-skype',
            'fa-slack' => 'fa-slack',
            'fa-sliders' => 'fa-sliders',
            'fa-slideshare' => 'fa-slideshare',
            'fa-smile-o' => 'fa-smile-o',
            'fa-soccer-ball-o' => 'fa-soccer-ball-o',
            'fa-sort' => 'fa-sort',
            'fa-sort-alpha-asc' => 'fa-sort-alpha-asc',
            'fa-sort-alpha-desc' => 'fa-sort-alpha-desc',
            'fa-sort-amount-asc' => 'fa-sort-amount-asc',
            'fa-sort-amount-desc' => 'fa-sort-amount-desc',
            'fa-sort-asc' => 'fa-sort-asc',
            'fa-sort-desc' => 'fa-sort-desc',
            'fa-sort-down' => 'fa-sort-down',
            'fa-sort-numeric-asc' => 'fa-sort-numeric-asc',
            'fa-sort-numeric-desc' => 'fa-sort-numeric-desc',
            'fa-sort-up' => 'fa-sort-up',
            'fa-soundcloud' => 'fa-soundcloud',
            'fa-space-shuttle' => 'fa-space-shuttle',
            'fa-spinner' => 'fa-spinner',
            'fa-spoon' => 'fa-spoon',
            'fa-spotify' => 'fa-spotify',
            'fa-square' => 'fa-square',
            'fa-square-o' => 'fa-square-o',
            'fa-stack-exchange' => 'fa-stack-exchange',
            'fa-stack-overflow' => 'fa-stack-overflow',
            'fa-star' => 'fa-star',
            'fa-star-half' => 'fa-star-half',
            'fa-star-half-empty' => 'fa-star-half-empty',
            'fa-star-half-full' => 'fa-star-half-full',
            'fa-star-half-o' => 'fa-star-half-o',
            'fa-star-o' => 'fa-star-o',
            'fa-steam' => 'fa-steam',
            'fa-steam-square' => 'fa-steam-square',
            'fa-step-backward' => 'fa-step-backward',
            'fa-step-forward' => 'fa-step-forward',
            'fa-stethoscope' => 'fa-stethoscope',
            'fa-stop' => 'fa-stop',
            'fa-street-view' => 'fa-street-view',
            'fa-strikethrough' => 'fa-strikethrough',
            'fa-stumbleupon' => 'fa-stumbleupon',
            'fa-stumbleupon-circle' => 'fa-stumbleupon-circle',
            'fa-subscript' => 'fa-subscript',
            'fa-subway' => 'fa-subway',
            'fa-suitcase' => 'fa-suitcase',
            'fa-sun-o' => 'fa-sun-o',
            'fa-superscript' => 'fa-superscript',
            'fa-support' => 'fa-support',
            'fa-table' => 'fa-table',
            'fa-tablet' => 'fa-tablet',
            'fa-tachometer' => 'fa-tachometer',
            'fa-tag' => 'fa-tag',
            'fa-tags' => 'fa-tags',
            'fa-tasks' => 'fa-tasks',
            'fa-taxi' => 'fa-taxi',
            'fa-tencent-weibo' => 'fa-tencent-weibo',
            'fa-terminal' => 'fa-terminal',
            'fa-text-height' => 'fa-text-height',
            'fa-text-width' => 'fa-text-width',
            'fa-th' => 'fa-th',
            'fa-th-large' => 'fa-th-large',
            'fa-th-list' => 'fa-th-list',
            'fa-thumb-tack' => 'fa-thumb-tack',
            'fa-thumbs-down' => 'fa-thumbs-down',
            'fa-thumbs-o-down' => 'fa-thumbs-o-down',
            'fa-thumbs-o-up' => 'fa-thumbs-o-up',
            'fa-thumbs-up' => 'fa-thumbs-up',
            'fa-ticket' => 'fa-ticket',
            'fa-times' => 'fa-times',
            'fa-times-circle' => 'fa-times-circle',
            'fa-times-circle-o' => 'fa-times-circle-o',
            'fa-tint' => 'fa-tint',
            'fa-toggle-down' => 'fa-toggle-down',
            'fa-toggle-left' => 'fa-toggle-left',
            'fa-toggle-off' => 'fa-toggle-off',
            'fa-toggle-on' => 'fa-toggle-on',
            'fa-toggle-right' => 'fa-toggle-right',
            'fa-toggle-up' => 'fa-toggle-up',
            'fa-train' => 'fa-train',
            'fa-transgender' => 'fa-transgender',
            'fa-transgender-alt' => 'fa-transgender-alt',
            'fa-trash' => 'fa-trash',
            'fa-trash-o' => 'fa-trash-o',
            'fa-tree' => 'fa-tree',
            'fa-trello' => 'fa-trello',
            'fa-trophy' => 'fa-trophy',
            'fa-truck' => 'fa-truck',
            'fa-try' => 'fa-try',
            'fa-tty' => 'fa-tty',
            'fa-tumblr' => 'fa-tumblr',
            'fa-tumblr-square' => 'fa-tumblr-square',
            'fa-turkish-lira' => 'fa-turkish-lira',
            'fa-twitch' => 'fa-twitch',
            'fa-twitter' => 'fa-twitter',
            'fa-twitter-square' => 'fa-twitter-square',
            'fa-umbrella' => 'fa-umbrella',
            'fa-underline' => 'fa-underline',
            'fa-undo' => 'fa-undo',
            'fa-university' => 'fa-university',
            'fa-unlink' => 'fa-unlink',
            'fa-unlock' => 'fa-unlock',
            'fa-unlock-alt' => 'fa-unlock-alt',
            'fa-unsorted' => 'fa-unsorted',
            'fa-upload' => 'fa-upload',
            'fa-usd' => 'fa-usd',
            'fa-user' => 'fa-user',
            'fa-user-md' => 'fa-user-md',
            'fa-user-plus' => 'fa-user-plus',
            'fa-user-secret' => 'fa-user-secret',
            'fa-user-times' => 'fa-user-times',
            'fa-users' => 'fa-users',
            'fa-venus' => 'fa-venus',
            'fa-venus-double' => 'fa-venus-double',
            'fa-venus-mars' => 'fa-venus-mars',
            'fa-viacoin' => 'fa-viacoin',
            'fa-video-camera' => 'fa-video-camera',
            'fa-vimeo-square' => 'fa-vimeo-square',
            'fa-vine' => 'fa-vine',
            'fa-vk' => 'fa-vk',
            'fa-volume-down' => 'fa-volume-down',
            'fa-volume-off' => 'fa-volume-off',
            'fa-volume-up' => 'fa-volume-up',
            'fa-warning' => 'fa-warning',
            'fa-wechat' => 'fa-wechat',
            'fa-weibo' => 'fa-weibo',
            'fa-weixin' => 'fa-weixin',
            'fa-whatsapp' => 'fa-whatsapp',
            'fa-wheelchair' => 'fa-wheelchair',
            'fa-wifi' => 'fa-wifi',
            'fa-windows' => 'fa-windows',
            'fa-won' => 'fa-won',
            'fa-wordpress' => 'fa-wordpress',
            'fa-wrench' => 'fa-wrench',
            'fa-xing' => 'fa-xing',
            'fa-xing-square' => 'fa-xing-square',
            'fa-yahoo' => 'fa-yahoo',
            'fa-yelp' => 'fa-yelp',
            'fa-yen' => 'fa-yen',
            'fa-youtube' => 'fa-youtube',
            'fa-youtube-play' => 'fa-youtube-play',
            'fa-youtube-square' => 'fa-youtube-square'
        );

        foreach( $icons as $icon ) {
            $all_icons[$icon] = $icon;
        }

        return $all_icons;
    }