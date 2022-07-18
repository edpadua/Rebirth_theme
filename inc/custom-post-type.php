<?php

/*
	
@package rebirththeme
	
	========================
		THEME CUSTOM POST TYPES
	========================
*/

$contact = get_option( 'activate_contact' );
if( @$contact == 1 ){
	
	add_action( 'init', 'rebirth_contact_custom_post_type' );
	
	add_filter( 'manage_rebirth-contact_posts_columns', 'rebirth_set_contact_columns' );
	add_action( 'manage_rebirth-contact_posts_custom_column', 'rebirth_contact_custom_column', 10, 2 );
	
	add_action( 'add_meta_boxes', 'rebirth_contact_add_meta_box' );
	add_action( 'save_post', 'rebirth_save_contact_email_data' );
	
}

/* CONTACT CPT */
function rebirth_contact_custom_post_type() {
	$labels = array(
		'name' 				=> 'Messages',
		'singular_name' 	=> 'Message',
		'menu_name'			=> 'Messages',
		'name_admin_bar'	=> 'Message'
	);
	
	$args = array(
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'supports'			=> array( 'title', 'editor', 'author' )
	);
	
	register_post_type( 'rebirth-contact', $args );
	
}

function rebirth_set_contact_columns( $columns ){
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
}

function rebirth_contact_custom_column( $column, $post_id ){
	
	switch( $column ){
		
		case 'message' :
			echo get_the_excerpt();
			break;
			
		case 'email' :
			//email column
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}
	
}

/* CONTACT META BOXES */

function rebirth_contact_add_meta_box() {
	add_meta_box( 'contact_email', 'User Email', 'rebirth_contact_email_callback', 'rebirth-contact', 'side' );
}

function rebirth_contact_email_callback( $post ) {
	wp_nonce_field( 'rebirth_save_contact_email_data', 'rebirth_contact_email_meta_box_nonce' );
	
	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );
	
	echo '<label for="rebirth_contact_email_field">User Email Address: </lable>';
	echo '<input type="email" id="rebirth_contact_email_field" name="rebirth_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}

function rebirth_save_contact_email_data( $post_id ) {
	
	if( ! isset( $_POST['rebirth_contact_email_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['rebirth_contact_email_meta_box_nonce'], 'rebirth_save_contact_email_data') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['rebirth_contact_email_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['rebirth_contact_email_field'] );
	
	update_post_meta( $post_id, '_contact_email_value_key', $my_data );
	
}

function registrar_projetos() {
	$descricao = 'Usado para listar os projetos';
	$singular = 'Projeto';
	$plural = 'Projetos';

	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'view_item' => 'Ver ' . $singular,
		'edit_item' => 'Editar ' . $singular,
		'new_item' => 'Novo ' . $singular,
		'add_new_item' => 'Adicionar novo ' . $singular
	);

	$supports = array(
		'title',
		'thumbnail',
        'editor',
        'page-attributes'
	);

	$args = array(
		'labels' => $labels,
		'description' => $descricao,
		'public' => true,
		'menu_icon' => 'dashicons-admin-home',
		'supports' => $supports
	);


	register_post_type( 'projeto', $args);	
}

add_action('init', 'registrar_projetos');


function custom_editor_meta_box() {
	 add_meta_box ( 
           	  'custom-editor', 
           	  __('Descrição', 'custom-editor') , 
           	  'custom_editor', 
           	  'projeto'
           );
}




function custom_editor( $post ) { 
	
    ?>
	<style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}
        
        .metabox-textarea{
            width: 100%;
        }
        
        .metabox-descricao {
			flex-basis: 89.7%;
            width: 100%;
		}

		.metabox-item label, .metabox-descricao label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>
    
    <!-- <div class="metabox">
        <div class="metabox-descricao">
			<label for="descricao-input">Descrição:</label>
			<div >
				<textarea id="descricao-input" rows = "10"  class="metabox-textarea" type="text" name="descricao_id"
                          ><?php echo $projetos_meta_data['descricao_id'][0]; ?></textarea>
			</div>
		</div>
    </div>
	<div class="metabox">
		
   
		<div class="metabox-item">
			<label for="vagas-input">Vagas:</label>
			<input id="vagas-input" class="metabox-input" type="number" name="vagas_id"
			value="<?= $projetos_meta_data['vagas_id'][0]; ?>">
		</div>

		<div class="metabox-item">
			<label for="banheiros-input">Banheiros:</label>
			<input id="banheiros-input" class="metabox-input" type="number" name="banheiros_id"
			value="<?= $projetos_meta_data['banheiros_id'][0]; ?>">
		</div>

		<div class="metabox-item">
			<label for="quartos-input">Quartos:</label>
			<input id="quartos-input" class="maluras-metabox-input" type="number" name="quartos_id"
			value="<?= $projetos_meta_data['quartos_id'][0]; ?>">
		</div>

	</div> -->
  
   <div class="metabox-item">

       <?php 

            $projetos_meta_data = get_post_meta( $post->ID );
            $content = get_post_meta($post->ID, 'custom_editor', true);
            
            wp_editor ( 
               $content , 
               'custom_editor', 
               array ( "media_buttons" => true ) 
              );

        ?>
   

   
   </div>
   <?php
}

function custom_editor_save_postdata($post_id) {
        
    if( isset( $_POST['custom_editor_nonce'] ) && isset( $_POST['projeto'] ) ) {
 
        //Not save if the user hasn't submitted changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
        } 
 
        // Verifying whether input is coming from the proper form
        if ( ! wp_verify_nonce ( $_POST['custom_editor_nonce'] ) ) {
        return;
        } 
 
        // Making sure the user has permission
        if( 'post' == $_POST['projeto'] ) {
               if( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
               }
        } 
    } 
 
    if (!empty($_POST['custom_editor'])) {
    
        $data = $_POST['custom_editor'];
        update_post_meta($post_id, 'custom_editor', $data);
        
    }
 }
 
add_action('save_post', 'custom_editor_save_postdata');
 
add_action('admin_init', 'custom_editor_meta_box');

/* Tipo realização */

function registrar_realizacoes() {
	$descricao = 'Usado para listar os realização';
	$singular = 'Realização';
	$plural = 'Realizações';

	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'view_item' => 'Ver ' . $singular,
		'edit_item' => 'Editar ' . $singular,
		'new_item' => 'Nova ' . $singular,
		'add_new_item' => 'Adicionar nova ' . $singular
	);

	$supports = array(
		'title',
		'thumbnail',
        'page-attributes'
	);

	$args = array(
		'labels' => $labels,
		'description' => $descricao,
		'public' => true,
		'menu_icon' => 'dashicons-hammer',
		'supports' => $supports
	);


	register_post_type( 'realizacao', $args);	
}

add_action('init', 'registrar_realizacoes');



/* Tipo galeria */

function registrar_galeria() {
	$gallery_labels = array(
	'name' => _x('Galerias', 'post type general name'),
	'singular_name' => _x('Galeria', 'post type singular name'),
	'add_new' => _x('Adicionar Nova', 'gallery'),
	'add_new_item' => __("Adicionar nova galeria"),
	'edit_item' => __("Edit Gallery"),
	'new_item' => __("New Gallery"),
	'view_item' => __("View Gallery"),
	'search_items' => __("Search Gallery"),
	'not_found' =>  __('No galleries found'),
	'not_found_in_trash' => __('No galleries found in Trash'), 
	'parent_item_colon' => ''
		
);
$gallery_args = array(
	'labels' => $gallery_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt', 'editor', 'thumbnail'),
	'menu_icon' => 'dashicons-images-alt'
); 
register_post_type('gallery', $gallery_args);
}

add_action('init', 'registrar_galeria');


add_action( 'init', 'jss_create_gallery_taxonomies', 0);
 
function jss_create_gallery_taxonomies(){
	register_taxonomy(
		'phototype', 'gallery', 
		array(
			'hierarchical'=> true, 
			'label' => 'Photo Types',
			'singular_label' => 'Photo Type',
			'rewrite' => true
		)
	);	
}


add_action('manage_posts_custom_column', 'jss_custom_columns');
add_filter('manage_edit-gallery_columns', 'jss_add_new_gallery_columns');
 
function jss_add_new_gallery_columns( $columns ){
	$columns = array(
		'cb'				=>		'<input type="checkbox">',
		'jss_post_thumb'	=>		'Thumbnail',
		'title'				=>		'Photo Title',
		'phototype'			=>		'Photo Type',
		'author'			=>		'Author',
		'date'				=>		'Date'
		
	);
	return $columns;
}
 
function jss_custom_columns( $column ){
	global $post;
	
	switch ($column) {
		case 'jss_post_thumb' : echo the_post_thumbnail('admin-list-thumb'); break;
		case 'description' : the_excerpt(); break;
		case 'phototype' : echo get_the_term_list( $post->ID, 'phototype', '', ', ',''); break;
	}
}
 
//add thumbnail images to column
add_filter('manage_posts_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'jss_add_post_thumbnail_column', 5);
add_filter('manage_custom_post_columns', 'jss_add_post_thumbnail_column', 5);
 
// Add the column
function jss_add_post_thumbnail_column($cols){
	$cols['jss_post_thumb'] = __('Thumbnail');
	return $cols;
}
 
function jss_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'jss_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'admin-list-thumb' );
      else
        echo 'Not supported in this theme';
      break;
  }
}



/* Tipo depoimento */

function registrar_depoimento() {
	$depoimento_labels = array(
	'name' => _x('Depoimentos', 'post type general name'),
	'singular_name' => _x('Depoimento', 'post type singular name'),
	'add_new' => _x('Adicionar Novo', 'depoimento'),
	'add_new_item' => __("Adicionar Novo depoimento"),
	'edit_item' => __("Editar depoimento"),
	'new_item' => __("Novo depoimento"),
	'view_item' => __("Visualizar depoimento"),
	'search_items' => __("Buscar depoimento"),
	'not_found' =>  __('Nenhum depoimento encontrado'),
	'not_found_in_trash' => __('Nenhum depoimento encontrado na lixeira'), 
	'parent_item_colon' => ''
		
);
    
  
$depoimento_args = array(
	'labels' => $depoimento_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt','thumbnail','page-attributes'),
	'menu_icon' => 'dashicons-format-quote' //16x16 png if you want an icon
); 
register_post_type('depoimento', $depoimento_args);
}

add_action('init', 'registrar_depoimento');



function adicionar_meta_info_depoimento() {
	add_meta_box(
		'informacoes_depoimento',
		'Informações',
		'informacoes_depoimento_view',
		'depoimento',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'adicionar_meta_info_depoimento');

function informacoes_depoimento_view( $post ) { 
	$depoimentos_meta_data = get_post_meta( $post->ID ); ?>

	<style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}
        
        .metabox-textarea{
            width: 100%;
        }
        
        .metabox-descricao {
			flex-basis: 89.7%;
            width: 100%;
		}

		.metabox-item label, .metabox-descricao label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>
    <div class="metabox">
        <div class="metabox-descricao">
			<label for="descricao-input">Depoimento:</label>
			<div >
				<textarea id="depoimento-input" rows = "10"  class="metabox-textarea" type="text" name="depoimento_id"
                          ><?php echo $depoimentos_meta_data['depoimento_id'][0]; ?></textarea>
			</div>
		</div>
    </div>
	
		

		<div class="metabox-item">
			<label for="autor-input">Autor:</label>
			<input id="autor-input" class="metabox-input" type="text" name="autor_id"
			value="<?= $depoimentos_meta_data['autor_id'][0]; ?>">
		</div>

		

	
<?php

}

function salvar_meta_info_depoimentos( $post_id ) {
	if( isset($_POST['depoimento_id']) ) {
		update_post_meta( $post_id, 'depoimento_id', sanitize_text_field( $_POST['depoimento_id'] ) );
	}
	if( isset($_POST['autor_id']) ) {
		update_post_meta( $post_id, 'autor_id', sanitize_text_field( $_POST['autor_id'] ) );
	}
	
}

add_action('save_post', 'salvar_meta_info_depoimentos');




/* Tipo serviço */

function registrar_servico() {
	$servico_labels = array(
	'name' => _x('Serviços', 'post type general name'),
	'singular_name' => _x('Servico', 'post type singular name'),
	'add_new' => _x('Adicionar Novo', 'serviço'),
	'add_new_item' => __("Adicionar Novo serviço"),
	'edit_item' => __("Editar serviço"),
	'new_item' => __("Novo serviço"),
	'view_item' => __("Visualizar serviço"),
	'search_items' => __("Buscar serviço"),
	'not_found' =>  __('Nenhum serviço encontrado'),
	'not_found_in_trash' => __('Nenhum serviço encontrado na lixeira'), 
	'parent_item_colon' => ''
		
);
$servico_args = array(
	'labels' => $servico_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt','thumbnail','page-attributes'),
	'menu_icon' => 'dashicons-clipboard' //16x16 png if you want an icon
); 
register_post_type('servico', $servico_args);
}

add_action('init', 'registrar_servico');



function adicionar_meta_info_servico() {
	add_meta_box(
		'informacoes_servico',
		'Informações',
		'informacoes_servico_view',
		'servico',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'adicionar_meta_info_servico');

function informacoes_servico_view( $post ) { 
	$servicos_meta_data = get_post_meta( $post->ID ); 
     $get_fontawesome_icons = get_fontawesome_icons();
    ?>

    <style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}
        
        .metabox-textarea{
            width: 100%;
        }
        
        .metabox-descricao {
			flex-basis: 89.7%;
            width: 100%;
		}

		.metabox-item label, .metabox-descricao label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>

    <div class="metabox-item">
			<label for="nome-input">Icone:</label>
			<!--<input id="nome-input" class="metabox-input" type="text" name="icon_id"
			value="<?= $servicos_meta_data['nome_id'][0]; ?>">-->
          
           <!-- <select class="widefat" >
                
                <option value="all-font-awesome-icons"><?php _e( 'All Font Awesome Icons', 'illdy' ); ?></option>
                <?php foreach( $get_fontawesome_icons as $key => $get_fontawesome_icon ): ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $icon, $key ); ?>><?php echo esc_html( $get_fontawesome_icon ); ?></option>
                <?php endforeach; ?>
                
                
                
            </select>-->
            <input id="icone-input" class="metabox-input" type="text" name="icone_id" value="<?= $servicos_meta_data['icone_id'][0]; ?>">
    </div>	


    <div class="metabox-item">
			<label for="nome-input">Nome:</label>
			<input id="nome-input" class="metabox-input" type="text" name="nome_id"
			value="<?= $servicos_meta_data['nome_id'][0]; ?>">
    </div>	

    <div class="metabox">
        <div class="metabox-descricao">
			<label for="descricao-input">Serviço:</label>
			<div >
				<textarea id="servico-input" rows = "10"  class="metabox-textarea" type="text" name="servico_id"
                          ><?php echo $servicos_meta_data['servico_id'][0]; ?></textarea>
			</div>
		</div>
    </div>
	
		

		

		

	
<?php

}

function salvar_meta_info_servicos( $post_id ) {
	if( isset($_POST['servico_id']) ) {
		update_post_meta( $post_id, 'servico_id', sanitize_text_field( $_POST['servico_id'] ) );
	}
	if( isset($_POST['nome_id']) ) {
		update_post_meta( $post_id, 'nome_id', sanitize_text_field( $_POST['nome_id'] ) );
	}
    if( isset($_POST['icone_id']) ) {
		update_post_meta( $post_id, 'icone_id', sanitize_text_field( $_POST['icone_id'] ) );
	}
	
}

add_action('save_post', 'salvar_meta_info_servicos');







/* Tipo colaborador */

function registrar_colaborador() {
	$colaborador_labels = array(
	'name' => _x('Colaboradores', 'post type general name'),
	'singular_name' => _x('Colaborador', 'post type singular name'),
	'add_new' => _x('Adicionar Novo', 'colaborador'),
	'add_new_item' => __("Adicionar Novo colaborador"),
	'edit_item' => __("Editar colaborador"),
	'new_item' => __("Novo colaborador"),
	'view_item' => __("Visualizar colaborador"),
	'search_items' => __("Buscar colaborador"),
	'not_found' =>  __('Nenhum colaborador encontrado'),
	'not_found_in_trash' => __('Nenhum colaborador encontrado na lixeira'), 
	'parent_item_colon' => ''
		
);
$colaborador_args = array(
	'labels' => $colaborador_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt','thumbnail','page-attributes'),
	'menu_icon' => 'dashicons-groups' //16x16 png if you want an icon
); 
register_post_type('colaborador', $colaborador_args);
}

add_action('init', 'registrar_colaborador');



function adicionar_meta_info_colaborador() {
	add_meta_box(
		'informacoes_colaborador',
		'Informações',
		'informacoes_colaborador_view',
		'colaborador',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'adicionar_meta_info_colaborador');

function informacoes_colaborador_view( $post ) { 
	$colaboradores_meta_data = get_post_meta( $post->ID ); 
     $get_fontawesome_icons = get_fontawesome_icons();
    ?>

    <style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}
        
        .metabox-textarea{
            width: 100%;
        }
        
        .metabox-descricao {
			flex-basis: 89.7%;
            width: 100%;
		}

		.metabox-item label, .metabox-descricao label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>

    


    <div class="metabox-item">
			<label for="nome-input">Nome:</label>
			<input id="nome-input" class="metabox-input" type="text" name="nome_id"
			value="<?= $colaboradores_meta_data['nome_id'][0]; ?>">
    </div>	

    <div class="metabox-item">
			<label for="cargo-input">Cargo:</label>
			<input id="cargo-input" class="metabox-input" type="text" name="cargo_id"
			value="<?= $colaboradores_meta_data['cargo_id'][0]; ?>">
    </div>	

    <div class="metabox">
        <div class="metabox-descricao">
			<label for="descricao-input">Descrição:</label>
			<div >
				<textarea id="servico-input" rows = "10"  class="metabox-textarea" type="text" name="descricao_id"
                          ><?php echo $colaboradores_meta_data['descricao_id'][0]; ?></textarea>
			</div>
		</div>
    </div>
	
		

		

		

	
<?php

}

function salvar_meta_info_colaboradores( $post_id ) {
	if( isset($_POST['nome_id']) ) {
		update_post_meta( $post_id, 'nome_id', sanitize_text_field( $_POST['nome_id'] ) );
	}
	if( isset($_POST['descricao_id']) ) {
		update_post_meta( $post_id, 'descricao_id', sanitize_text_field( $_POST['descricao_id'] ) );
	}
	
}

add_action('save_post', 'salvar_meta_info_colaboradores');


/* Tipo clientes */

function registrar_cliente() {
	$cliente_labels = array(
	'name' => _x('Clientes', 'post type general name'),
	'singular_name' => _x('Cliente', 'post type singular name'),
	'add_new' => _x('Adicionar Novo', 'clientes'),
	'add_new_item' => __("Adicionar Novo clientes"),
	'edit_item' => __("Editar cliente"),
	'new_item' => __("Novo cliente"),
	'view_item' => __("Visualizar cliente"),
	'search_items' => __("Buscar cliente"),
	'not_found' =>  __('Nenhum cliente encontrado'),
	'not_found_in_trash' => __('Nenhum cliente encontrado na lixeira'), 
	'parent_item_colon' => ''
		
);
$cliente_args = array(
	'labels' => $cliente_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true, 
	'query_var' => true,
	'rewrite' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'capability_type' => 'post',
	'supports' => array('title', 'excerpt','thumbnail','page-attributes'),
	'menu_icon' => 'dashicons-groups' //16x16 png if you want an icon
); 
register_post_type('cliente', $cliente_args);
}

add_action('init', 'registrar_cliente');



function adicionar_meta_info_cliente() {
	add_meta_box(
		'informacoes_cliente',
		'Informações',
		'informacoes_cliente_view',
		'cliente',
		'normal',
		'high'
	);
}

add_action('add_meta_boxes', 'adicionar_meta_info_cliente');

function informacoes_cliente_view( $post ) { 
	$clientes_meta_data = get_post_meta( $post->ID ); 
     $get_fontawesome_icons = get_fontawesome_icons();
    ?>

    <style>
		.metabox {
			display: flex;
			justify-content: space-between;
		}

		.metabox-item {
			flex-basis: 30%;

		}
        
        .metabox-textarea{
            width: 100%;
        }
        
        .metabox-descricao {
			flex-basis: 89.7%;
            width: 100%;
		}

		.metabox-item label, .metabox-descricao label {
			font-weight: 700;
			display: block;
			margin: .5rem 0;

		}

		.input-addon-wrapper {
			height: 30px;
			display: flex;
			align-items: center;
		}

		.input-addon {
			display: block;
			border: 1px solid #CCC;
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			height: 100%;
			width: 30px;
			text-align: center;
			line-height: 30px;
			box-sizing: border-box;
			background-color: #888;
			color: #FFF;
		}

		.metabox-input {
			height: 100%;
			border: 1px solid #CCC;
			border-left: none;
			margin: 0;
		}

	</style>

    


    <div class="metabox-item">
			<label for="nome-input">Nome:</label>
			<input id="nome-input" class="metabox-input" type="text" name="nome_id"
			value="<?= $clientes_meta_data['nome_id'][0]; ?>">
    </div>	


    <div class="metabox-item">
			<label for="link-input">Link:</label>
			<input id="link-input" class="metabox-input" type="text" name="link_id"
			value="<?= $clientes_meta_data['link_id'][0]; ?>">
    </div>	

    
	
		

		

		

	
<?php

}

function salvar_meta_info_clientes( $post_id ) {
	if( isset($_POST['nome_id']) ) {
		update_post_meta( $post_id, 'nome_id', sanitize_text_field( $_POST['nome_id'] ) );
	}
	if( isset($_POST['descricao_id']) ) {
		update_post_meta( $post_id, 'descricao_id', sanitize_text_field( $_POST['descricao_id'] ) );
	}
	
}

add_action('save_post', 'salvar_meta_info_clientes');
