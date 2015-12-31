<?php
/**
 * Pure Customizer functionality
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Pure 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function pure_customize_register( $wp_customize ) {
    // Add postMessage support for site title and description.
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /* 个人简介 */
    $wp_customize->add_section( 'pure_profile_options', array(
        'title'             => __( 'Profile', 'pure' ),
        'description'       => __( 'Add profile here. This may be shown publicly', 'pure' ),
        'priority'          => 25,
    ) );

    // 是否显示
    $wp_customize->add_setting( 'pure_profile_show_on', array(
        'default'           => get_option('pure_profile_show_on', 'off'),
        'sanitize_callback' => 'pure_sanitize_show_on',
    ) );

    $wp_customize->add_control( 'pure_profile_show_on', array(
        'label'             => __( 'Front page displays', 'pure' ),
        'section'           => 'pure_profile_options',
        'type'              => 'radio',
        'choices'           => array(
            'on'   => __( 'Show on', 'pure' ),
            'off'  => __( 'Show off', 'pure' ),
        ),
    ) );

    // 邮箱
    $wp_customize->add_setting( 'pure_profile_email', array(
        'default'           => '',
        'sanitize_callback' => 'pure_sanitize_email',
    ) );

    $wp_customize->add_control( 'pure_profile_email', array(
        'label'             => __( 'Email address', 'pure' ),
        'section'           => 'pure_profile_options',
        'type'              => 'text',
    ) );

    // 昵称
    $wp_customize->add_setting( 'pure_profile_nickname', array(
        'default'           => '',
        'sanitize_callback' => 'pure_sanitize_nohtml',
    ) );

    $wp_customize->add_control( 'pure_profile_nickname', array(
        'label'             => __( 'Nickname', 'pure' ),
        'section'           => 'pure_profile_options',
        'type'              => 'text',
    ) );

    // 简介
    $wp_customize->add_setting( 'pure_profile_description', array(
        'default'           => '',
        'sanitize_callback' => 'pure_sanitize_nohtml',
    ) );

    $wp_customize->add_control( 'pure_profile_description', array(
        'label'             => __( 'Description', 'pure' ),
        'section'           => 'pure_profile_options',
        'type'              => 'textarea',
    ) );

    /* copyright */
    $wp_customize->add_section( 'pure_copyright_options', array(
        'title'             => __( 'Copyright', 'pure' ),
        'description'       => __( 'Add copyright here. This may be shown publicly', 'pure' ),
        'priority'          => 25,
    ) );

    // 备案号
    $wp_customize->add_setting( 'pure_copyright_icp', array(
        'default'           => '',
        'sanitize_callback' => 'pure_sanitize_nohtml',
    ) );

    $wp_customize->add_control( 'pure_copyright_icp', array(
        'label'             => __( 'ICP Licensing', 'pure' ),
        'section'           => 'pure_copyright_options',
        'type'              => 'text',
    ) );

}
add_action( 'customize_register', 'pure_customize_register' );

function pure_sanitize_show_on( $show ) {
    if ( ! in_array( $show, array( 'on', 'off' ) ) ) {
        $show = 'off';
    }

    return $show;
}

function pure_sanitize_email( $value ) {
    $value = trim($value);
    if ( '' != $value && is_email( $value ) ) {
        $value = sanitize_email( $value );
    } else {
        $value = '';
    }

    return $value;
}

/**
 * Sanitization: nohtml
 * Control: text, textarea, password
 *
 * Sanitization callback for 'nohtml' type text inputs. This
 * callback sanitizes $input to remove all HTML.
 *
 * @since  1.0.0
 */
function pure_sanitize_nohtml( $input ) {
  return wp_filter_nohtml_kses( $input );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Twenty Fifteen 1.0
 */
function pure_customize_preview_js() {
    wp_enqueue_script( 'pure-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'pure_customize_preview_js' );