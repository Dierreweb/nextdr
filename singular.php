<?php
/**
  * The template for displaying Single Page
  */

get_header();

	get_template_part( 'content', get_post_type() );

get_footer();
