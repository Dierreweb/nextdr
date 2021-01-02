<?php

if( !defined( 'DIERREWEB_THEME_DIR' ) ) { exit( 'No direct script access allowed' ); }

/* ------------------------------------------------------------------------
 * MAINTENANCE SECTION
 * ------------------------------------------------------------------------ */

$wp_customize->add_section( 'dierreweb_maintenance' , array(
  'title'    => esc_html__( 'Maintenance', 'dr' ),
  'priority' => 100,
  'panel'		 => 'dierreweb_theme_options'
) );

$wp_customize->add_setting( 'dierreweb_maintenance_mode', array(
  'default'           => false,
  'transport'         => 'refresh',
  'sanitize_callback' => 'absint'
) );

$wp_customize->add_control( 'dierreweb_maintenance_mode', array(
  'label'       => esc_html__( 'Enable maintenance mode', 'dr' ),
  'description' => esc_html__( 'If enabled you need to create maintenance page in Dashboard - Pages - Add new. Choose "Template" to be "Maintenance" in "Page attributes".', 'dr' ),
  'section'     => 'dierreweb_maintenance',
  'type'        => 'checkbox',
) );
