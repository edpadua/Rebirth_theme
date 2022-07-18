<?php
/**
 * Rebirth-Theme 
 *
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sunset_customize_register( $wp_customize ) {

// add a setting for the site logo
$wp_customize->add_setting('your_theme_logo');
// Add a control to upload the logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
    array(
    'label' => 'Baixar logo',
    'section' => 'title_tagline',
    'settings' => 'your_theme_logo',
    ) ) );
    
$wp_customize->add_setting('copyright');
// Add a control to upload the logo
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "copyright", // campo2
        array(
            "label"    => "Copyright", // Rótulo do campo
            "section"  => "title_tagline", // A seção
            "settings" => "copyright", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));

    
/* Informações de contato */    
$wp_customize->add_section('contact_section', array(
      'title' => 'Informações de contato',
      'description' => 'Altere as informações de contato.',
      'priority'    => 30,
 ));

$wp_customize->add_setting(
        'email_site', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'rua_endereco_site', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'numero_endereco_site', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'cep_endereco_site', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'cidade_endereco_site', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'estado_endereco_site', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'telefone_site1', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
    
$wp_customize->add_setting(
        'telefone_site2', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'telefone_site3', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "email_site", // campo1
        array(
            "label"    => "E-mail", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "email_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "rua_endereco_site", // campo2
        array(
            "label"    => "Rua", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "rua_endereco_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "numero_endereco_site", // campo3
        array(
            "label"    => "Número", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "numero_endereco_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "cep_endereco_site", // campo4
        array(
            "label"    => "Cep", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "cidade_endereco_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
));
    
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "cidade_endereco_site", // campo5
        array(
            "label"    => "Cidade", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "cidade_endereco_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
));
    

    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "estado_endereco_site", // campo6
        array(
            "label"    => "Estado", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "estado_endereco_site", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "telefone_site1", // campo1
        array(
            "label"    => "Telefone 1", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "telefone_site1", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "telefone_site2", // campo1
        array(
            "label"    => "Telefone 2", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "telefone_site2", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "telefone_site3", // campo1
        array(
            "label"    => "Telefone 3", // Rótulo do campo
            "section"  => "contact_section", // A seção
            "settings" => "telefone_site3", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
    ));
    


/* Redes Sociais */ 
$wp_customize->add_section(
        'redes_sociais_sec',
        array(
            'title' =>  'Redes Sociais',
            'description' => 'Editar redes sociais',
            'priority' => 35,
        )
);
    
$wp_customize->add_setting(
		'facebook_link',
		array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);    
    
$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'facebook_link', // campo2
        array(
            "label"    => "Facebook", // Rótulo do campo
            "section"  => "redes_sociais_sec", // A seção
            "settings" => "facebook_link", // Settings do campo
            "type"     => "text", // Input do tipo "text"
        )
));

    
/* Slider options */
$wp_customize->add_section(
        'slider_sec',
        array(
            'title' =>  'Slider de imagens',
            'description' => 'Seleção das imagens para o slider',
            'priority' => 35,
        )
);

//slide images settings
    
$wp_customize->add_setting(
        'slide_interval',
        array(
            'default'   => '6000', // Valor padrão 
            'transport' => 'refresh', // Transport
        )                 
);    
    
    
$wp_customize->add_setting('imagem_slide1');
    
    
$wp_customize->add_setting(
        'slide_title1', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'slide_desc1', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    

    
$wp_customize->add_setting('imagem_slide2');
    
$wp_customize->add_setting(
        'slide_title2', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'slide_desc2', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
    
$wp_customize->add_setting('imagem_slide3');
    
$wp_customize->add_setting(
        'slide_title3', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'slide_desc3', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
    
$wp_customize->add_setting('imagem_slide4');
    
$wp_customize->add_setting(
        'slide_title4', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'slide_desc4', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
    
$wp_customize->add_setting('imagem_slide5');
    
$wp_customize->add_setting(
        'slide_title5', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    
$wp_customize->add_setting(
        'slide_desc5', // campo1
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);
    

//slide images controls

    
$wp_customize->add_control( 'rebirth_slide_interval', array(
		'label'        => __( 'Duração do slide', 'rebirth' ),
		'type'=>'6000',
		'section'    => 'slider_sec',
		'settings'   => 'slide_interval'
	) );    

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imagem_slide1', array(
		'label'        => 'Imagem 1 (1920x900)',
		'section'    => 'slider_sec',
		'settings'   => 'imagem_slide1',
        'transport' => 'refresh',
) ) );
    
    
$wp_customize->add_control( 'rebirth_slide_title_1', array(
		'label'        => __( 'Imagem 1 título', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_title1'
	) );
    
$wp_customize->add_control( 'rebirth_slide_desc_1', array(
		'label'        => __( 'Descrição slide 1', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc1'
	) );
    
    
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imagem_slide2', array(
		'label'        => 'Imagem 2 (1920x900)',
		'section'    => 'slider_sec',
		'settings'   => 'imagem_slide2',
        'transport' => 'refresh',
) ) );
    
    
$wp_customize->add_control( 'rebirth_slide_title_2', array(
		'label'        => __( 'Imagem 2 título', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_title2'
	) );
    
    
$wp_customize->add_control( 'rebirth_slide_desc_2', array(
		'label'        => __( 'Descrição slide 2', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc2'
	) );
    
    
    
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imagem_slide3', array(
		'label'        => 'Imagem 3 (1920x900)',
		'section'    => 'slider_sec',
		'settings'   => 'imagem_slide3',
        'transport' => 'refresh',
) ) );
    
$wp_customize->add_control( 'rebirth_slide_title_3', array(
		'label'        => __( 'Imagem 3 título', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_title3'
) );
    
    
$wp_customize->add_control( 'rebirth_slide_desc_3', array(
		'label'        => __( 'Descrição slide 3', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc3'
	) );
    
 
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imagem_slide4', array(
		'label'        => 'Imagem 4 (1920x900)',
		'section'    => 'slider_sec',
		'settings'   => 'imagem_slide4',
        'transport' => 'refresh',
) ) );
    
$wp_customize->add_control( 'rebirth_slide_title_4', array(
		'label'        => __( 'Imagem 4 título', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_title4'
) );
    
    
$wp_customize->add_control( 'rebirth_slide_desc_4', array(
		'label'        => __( 'Descrição slide 4', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc4'
	) );
    
    
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'imagem_slide5', array(
		'label'        => 'Imagem 5 (1920x1280)',
		'section'    => 'slider_sec',
		'settings'   => 'imagem_slide5',
        'transport' => 'refresh',
) ) );
    
$wp_customize->add_control( 'rebirth_slide_title_5', array(
		'label'        => __( 'Imagem 5 título', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_title5'
) );
    
    
$wp_customize->add_control( 'rebirth_slide_desc_5', array(
		'label'        => __( 'Descrição slide 5', 'rebirth' ),
		'type'=>'text',
		'section'    => 'slider_sec',
		'settings'   => 'slide_desc5'
	) );

	

/* Posts mais recentes */
$wp_customize->add_section(
        'posts_sec',
        array(
            'title' =>  'Posts mais recentes',
            'description' => 'Editar a seção posts mais recentes',
            'priority' => 100,
        )
);


/* Geral */


// Mostrar esta seção
$wp_customize->add_setting( 'posts_general_show',
    array(
        'sanitize_callback' => 'rebirth_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . 'posts_general_show',
    array(
        'type'      => 'checkbox',
        'label'     => __( 'Mostrar esta seção ?', 'rebirth_theme' ),
        'section'   => 'posts_sec',
        'priority'  => 1
    )
);
    
    
/* Posts mais recentes */
$wp_customize->add_section(
        'sobre_sec',
        array(
            'title' =>  'Sobre',
            'description' => 'Editar a seção posts mais recentes',
            'priority' => 100,
        )
);


/* Geral */


// Mostrar esta seção
$wp_customize->add_setting( 'sobre_general_show',
    array(
        'sanitize_callback' => 'rebirth_sanitize_checkbox',
        'default'           => 1,
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    $prefix . 'sobre_general_show',
    array(
        'type'      => 'checkbox',
        'label'     => __( 'Mostrar esta seção ?', 'rebirth_theme' ),
        'section'   => 'sobre_sec',
        'priority'  => 1
    )
);    
    

$wp_customize->add_setting(
        'resumo_sobre', // campo2
        array(
            'default'   => '', // Valor padrão 
            'transport' => 'refresh', // Transport
        )
);

$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "resumo_sobre", // campo4
        array(
            "label"    => "Apresentação", // Rótulo do campo
            "section"  => "sobre_sec", // A seção
            "settings" => "resumo_sobre", // Settings do campo
            "type"     => "textarea", // Input do tipo "text"
        )
));
    
    
}


add_action( 'customize_register', 'sunset_customize_register' );





if ( ! function_exists( 'rebirth_sanitize_checkbox' ) ) {
	/**
	 * Function to sanitize checkboxes
	 *
	 * @param $value
	 *
	 * @return int
	 */
	function rebirth_sanitize_checkbox( $value ) {
		if ( $value == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
}