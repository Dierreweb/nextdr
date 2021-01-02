<?php

if( !defined( 'ABSPATH' ) ) { exit( 'No direct script access allowed' ); }

if( ! class_exists( 'WOODMART_Mega_Menu_Walker' )) {
	class WOODMART_Mega_Menu_Walker extends Walker_Nav_Menu {

		private $color_scheme = 'dark';

		public function __construct() {
			$this->color_scheme = whb_get_dropdowns_color();
		}

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if( $depth == 0) {
				$output .= "\n$indent<div class=\"sub-menu-dropdown color-scheme-" . $this->color_scheme . "\">\n";
				$output .= "\n$indent<div class=\"container\">\n";

			}
			if( $depth < 1 ) {
				$sub_menu_class = "sub-menu";
			} else {
				$sub_menu_class = "sub-sub-menu";
			}

			$output .= "\n$indent<ul class=\"$sub_menu_class color-scheme-" . $this->color_scheme . "\">\n";

			if( $this->color_scheme == 'light' || $this->color_scheme == 'dark' ) $this->color_scheme = whb_get_dropdowns_color() ;
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
			if( $depth == 0) {
				$output .= "$indent</div>\n";
				$output .= "$indent</div>\n";
			}
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'item-level-' . $depth;

			$design = $width = $height = $icon = $label = $label_out = '';
			$design  = get_post_meta( $item->ID, '_menu_item_design',  true );
			$width   = get_post_meta( $item->ID, '_menu_item_width',   true );
			$height  = get_post_meta( $item->ID, '_menu_item_height',  true );
			$icon    = get_post_meta( $item->ID, '_menu_item_icon',    true );
			$event   = get_post_meta( $item->ID, '_menu_item_event',   true );
			$label   = get_post_meta( $item->ID, '_menu_item_label',   true );
			$label_text = get_post_meta( $item->ID, '_menu_item_label-text',   true );
			$block   = get_post_meta( $item->ID, '_menu_item_block',   true );
			$dropdown_ajax = get_post_meta( $item->ID, '_menu_item_dropdown-ajax',  true );
			$opanchor = get_post_meta( $item->ID, '_menu_item_opanchor', true );
			$callbtn  = get_post_meta( $item->ID, '_menu_item_callbtn', true );
			$color_scheme = get_post_meta( $item->ID, '_menu_item_colorscheme', true );

			if ( $color_scheme == 'light' ) {
				$this->color_scheme = 'light';
			}elseif( $color_scheme == 'dark' ){
				$this->color_scheme = 'dark';
			}

			if( empty($design) ) $design = 'default';

			if ( ! is_object( $args ) ) return;

			if( $depth == 0 && $args->menu_class != 'site-mobile-menu' ) {
				$classes[] = 'menu-item-design-' . $design;
				$classes[] = 'menu-' . ( (  in_array( $design, array( 'sized', 'full-width' ) ) ) ? 'mega-dropdown' : 'simple-dropdown' );
				$event = (empty($event)) ? 'hover' : $event;
				$classes[] = 'item-event-' . $event;
			}

			if ( $block && $args->menu_class == 'site-mobile-menu' ) {
				$classes[] = 'menu-item-has-block';
			}

			if( $opanchor == 'enable' ) {
				 $classes[] = 'onepage-link';
				if(($key = array_search('current-menu-item', $classes)) !== false) {
					unset($classes[$key]);
				}
			}

			if( $callbtn == 'enable' ) {
				$classes[] = 'callto-btn';
			}

			if( !empty( $label ) ) {
				$classes[] = 'item-with-label';
				$classes[] = 'item-label-' . $label;
				$label_out = '<span class="menu-label menu-label-' . $label . '">' . esc_attr( $label_text ) . '</span>';
			}

			if( ! empty( $block ) && $design != 'default' ) {
				$classes[] = 'menu-item-has-children';
			}

			if( $dropdown_ajax == 'yes') {
				$classes[] = 'dropdown-load-ajax';
			}

			if ( $height && $design == 'sized' ) {
				$classes[] = 'dropdown-with-height';
			}

			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			/**
			 * Filter the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item  The current menu item.
			 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$atts['class'] = 'woodmart-nav-link';

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$icon_url = '';

			if( $item->object == 'product_cat' ) {
				$icon_url = get_term_meta( $item->object_id, 'category_icon_alt', true );
			}

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';


			$icon_attrs = apply_filters( 'woodmart_megamenu_icon_attrs', false );

			if( ! empty( $icon_url ) ) {
				$item_output .= '<img src="'  . esc_url( $icon_url ) . '" alt="' . esc_attr( $item->title ) . '" ' . $icon_attrs . ' class="category-icon" />';
			}
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= '<span class="nav-link-text">' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</span>';
			$item_output .= $label_out;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$styles = '';

			if( $depth == 0 && $args->menu_class != 'site-mobile-menu' ) {
				/**
				 * Add background image to dropdown
				 **/


				if( has_post_thumbnail( $item->ID ) ) {
					$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'full' );

					//ar($post_thumbnail);

					$styles .= '.menu-item-' . $item->ID . ' > .sub-menu-dropdown {';
						$styles .= 'background-image: url(' . $post_thumbnail[0] .'); ';
					$styles .= '}';
				}

				if( ! empty( $block ) && !in_array("menu-item-has-children", $item->classes) && $design != 'default' ) {
					$item_output .= "\n$indent<div class=\"sub-menu-dropdown color-scheme-" . $this->color_scheme . "\">\n";
					$item_output .= "\n$indent<div class=\"container\">\n";
						if( $dropdown_ajax == 'yes') {
							$item_output .= '<div class="dropdown-html-placeholder" data-id="' . $block . '"></div>';
						} else {
							//$item_output .= woodmart_html_block_shortcode( array( 'id' => $block ) );
						}
					$item_output .= "\n$indent</div>\n";
					$item_output .= "\n$indent</div>\n";

					if( $this->color_scheme == 'light' || $this->color_scheme == 'dark' ) $this->color_scheme = whb_get_dropdowns_color() ;
				}
			}

			if($design == 'sized' && !empty($height) && !empty($width) && $args->menu_class != 'site-mobile-menu' ) {
				$styles .= '.menu-item-' . $item->ID . '.menu-item-design-sized > .sub-menu-dropdown {';
					$styles .= 'min-height: ' . $height .'px; ';
					$styles .= 'width: ' . $width .'px; ';
				$styles .= '}';
			}

			if( $styles != '' && $args->menu_class != 'site-mobile-menu' ) {
				$item_output .= '<style>';
				$item_output .= $styles;
				$item_output .= '</style>';
			}

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}


/**
 * Nav Menu Images Nav Menu Edit Walker
 *
 * @package Nav Menu Images
 * @subpackage Nav Menu Edit Walker
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Filter nav menu items on edit screen.
 *
 * @since 1.0
 *
 * @uses Walker_Nav_Menu_Edit
 */
class NMI_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	/**
	 * @see Walker_Nav_Menu_Edit::start_el()
	 * @since 1.0
	 * @access public
	 *
	 * @global $wp_version
	 * @uses Walker_Nav_Menu_Edit::start_el()
	 * @uses admin_url() To get URL of uploader.
	 * @uses esc_url() To escape URL.
	 * @uses add_query_arg() To append variables to URL.
	 * @uses esc_attr() To escape string.
	 * @uses has_post_thumbnail() To check if item has thumb.
	 * @uses get_the_post_thumbnail() To get item's thumb.
	 * @uses version_compare() To compare WordPress versions.
	 * @uses wp_create_nonce() To create item's nonce.
	 * @uses esc_html__() To translate & escape string.
	 * @uses esc_html() To escape string.
	 * @uses do_action_ref_array() Calls 'nmi_menu_item_walker_output' with the output.
	 *                        post object, depth and arguments to overwrite item's output.
	 * @uses NMI_Walker_Nav_Menu_Edit::get_settings() To get JSONed item's data.
	 * @uses do_action_ref_array() Calls 'nmi_menu_item_walker_end' with the output.
	 *                        post object, depth and arguments to overwrite item's output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args Not used.
	 * @param int $id Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_version;

		// First, make item with standard class
		parent::start_el( $output, $item, $depth, $args, $id );

		// Now add additional content
		$item_id = $item->ID;

		// Form upload link
		$upload_url = admin_url( 'media-upload.php' );
		$query_args = array(
			'post_id'   => $item_id,
			'tab'       => 'gallery',
			'TB_iframe' => '1',
			'width'     => '640',
			'height'    => '425'
		);
		$upload_url = esc_url( add_query_arg( $query_args, $upload_url ) );


		// Hidden field with item's ID
		$output .= '<input type="hidden" name="nmi_item_id" id="nmi_item_id" value="' . esc_attr( $item_id ) . '" />';

		$output .= '<div class="nmi-item-custom-fields">';

		$blocks = woodmart_get_static_blocks_array();

		ob_start();

		$design = $width = $height = $icon = $label = '';
		$design  = get_post_meta( $item_id, '_menu_item_design',  true );
		$width   = get_post_meta( $item_id, '_menu_item_width',   true );
		$icon    = get_post_meta( $item_id, '_menu_item_icon',    true );
		$height  = get_post_meta( $item_id, '_menu_item_height',  true );
		$event   = get_post_meta( $item_id, '_menu_item_event',  true );
		$label   = get_post_meta( $item_id, '_menu_item_label',  true );
		$label_text = get_post_meta( $item_id, '_menu_item_label-text',  true );
		$block   = get_post_meta( $item_id, '_menu_item_block',  true );
		$dropdown_ajax = get_post_meta( $item_id, '_menu_item_dropdown-ajax',  true );
		$opanchor   = get_post_meta( $item_id, '_menu_item_opanchor',  true );
		$color_scheme = get_post_meta( $item_id, '_menu_item_colorscheme',  true );
		$callbtn = get_post_meta( $item_id, '_menu_item_callbtn',  true );

		?>
			<h4><?php esc_html_e('Custom fields [for theme]', 'woodmart') ?></h4>
			<p class="description description-wide nmi-design">
				<label for="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Design', 'woodmart'); ?><br>
					<select id="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>" data-field="nmi-design" class="widefat" name="menu-item-design[<?php echo esc_attr( $item_id ); ?>]">
						<option value="default" <?php selected( $design, 'default', true); ?>><?php esc_html_e('Default', 'woodmart'); ?></option>
						<option value="full-width" <?php selected( $design, 'full-width', true); ?>><?php esc_html_e('Full width', 'woodmart'); ?></option>
						<option value="sized" <?php selected( $design, 'sized', true); ?>><?php esc_html_e('Set sizes', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
			<p class="description description-thin nmi-width" style="display:none;">
				<label for="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Dropdown Width', 'woodmart'); ?><br>
					<input type="number" id="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-width[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $width ); ?>">
				</label>
			</p>
			<p class="description description-thin nmi-height" style="display:none;">
				<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Dropdown Height', 'woodmart'); ?><br>
					<input type="number" id="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-height[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $height ); ?>">
				</label>
			</p>
			<p class="description description-wide nmi-block" style="display:none;">
				<label for="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('HTML Block for the dropdown', 'woodmart'); ?><br>
					<select id="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-block[<?php echo esc_attr( $item_id ); ?>]">
						<option value="" <?php selected( $block, '', true); ?>><?php esc_html_e('None', 'woodmart'); ?></option>
						<?php foreach ($blocks as $title => $id): ?>
							<option value="<?php echo esc_attr( $id ); ?>" data-edit-link="<?php echo admin_url( 'post.php?post=' . $id . '&action=edit' ); ?>" <?php selected( $block, $id, true); ?>><?php echo esc_html( $title ); ?></option>
						<?php endforeach ?>
					</select>
					<a href="<?php echo admin_url( 'post.php?post=' . $block . '&action=edit' ); ?>" <?php if ( empty( $block ) ): ?>style="display:none;"<?php endif ?> class="edit-block-link" target="_blank"><?php esc_html_e( 'Edit this block with WPBakery Page Builder', 'woodmart' ); ?></a> |
					<a href="<?php echo admin_url( 'post-new.php?post_type=cms_block' ); ?>" class="add-block-link" target="_blank"><?php esc_html_e( 'Add new', 'woodmart' ); ?></a>
				</label>
			</p>
			<p class="description description-wide nmi-dropdown-ajax">
				<label for="edit-menu-item-dropdown-ajax-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Load HTML dropdown with AJAX', 'woodmart'); ?><br>
					<select id="edit-menu-item-dropdown-ajax-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-dropdown-ajax[<?php echo esc_attr( $item_id ); ?>]">
						<option></option>
						<option value="yes" <?php selected( $dropdown_ajax, 'yes', true); ?>><?php esc_html_e('Yes', 'woodmart'); ?></option>
						<option value="no" <?php selected( $dropdown_ajax, 'no', true); ?>><?php esc_html_e('No', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
			<p class="description description-wide nmi-icon">
				<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Icon name (from FontAwesome set)', 'woodmart'); ?><br>
					<input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $icon ); ?>">
				</label>
			</p>
			<p class="description description-wide nmi-event">
				<label for="edit-menu-item-event-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Open on mouse event', 'woodmart'); ?><br>
					<select id="edit-menu-item-event-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-event[<?php echo esc_attr( $item_id ); ?>]">
						<option value="hover" <?php selected( $event, 'hover', true); ?>><?php esc_html_e('Hover', 'woodmart'); ?></option>
						<option value="click" <?php selected( $event, 'click', true); ?>><?php esc_html_e('Click', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
			<p class="description description-wide nmi-label-text">
				<label for="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Label text', 'woodmart'); ?><br>
					<input type="text" id="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label-text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $label_text ); ?>">
				</label>
			</p>
			<p class="description description-wide nmi-label">
				<label for="edit-menu-item-label-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Label color', 'woodmart'); ?><br>
					<select id="edit-menu-item-label-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""></option>
						<option value="primary" <?php selected( $label, 'primary', true); ?>><?php esc_html_e('Primary Color', 'woodmart'); ?></option>
						<option value="secondary" <?php selected( $label, 'secondary', true); ?>><?php esc_html_e('Secondary', 'woodmart'); ?></option>
						<option value="red" <?php selected( $label, 'red', true); ?>><?php esc_html_e('Red', 'woodmart'); ?></option>
						<option value="green" <?php selected( $label, 'green', true); ?>><?php esc_html_e('Green', 'woodmart'); ?></option>
						<option value="blue" <?php selected( $label, 'blue', true); ?>><?php esc_html_e('Blue', 'woodmart'); ?></option>
						<option value="orange" <?php selected( $label, 'orange', true); ?>><?php esc_html_e('Orange', 'woodmart'); ?></option>
						<option value="grey" <?php selected( $label, 'grey', true); ?>><?php esc_html_e('Grey', 'woodmart'); ?></option>
						<option value="black" <?php selected( $label, 'black', true); ?>><?php esc_html_e('Black', 'woodmart'); ?></option>
						<option value="white" <?php selected( $label, 'white', true); ?>><?php esc_html_e('White', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
			<p class="description description-wide nmi-color-scheme">
				<label for="edit-menu-item-colorscheme-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Dropdown text color scheme', 'woodmart'); ?><br>
					<select id="edit-menu-item-colorscheme-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-colorscheme[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""></option>
						<option value="light" <?php selected( $color_scheme, 'light', true); ?>><?php esc_html_e('Light', 'woodmart'); ?></option>
						<option value="dark" <?php selected( $color_scheme, 'dark', true); ?>><?php esc_html_e('Dark', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
			<p class="description description-wide nmi-opanchor">
				<label for="edit-menu-item-opanchor-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('One page anchor', 'woodmart'); ?><br>
					<select id="edit-menu-item-opanchor-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-opanchor[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""></option>
						<option value="enable" <?php selected( $opanchor, 'enable', true); ?>><?php esc_html_e('Enable', 'woodmart'); ?></option>
						<option value="disable" <?php selected( $opanchor, 'disable', true); ?>><?php esc_html_e('Disable', 'woodmart'); ?></option>
					</select>
					<span class="description"><?php esc_html_e('Enable this to use one page navigation menu. If enabled you need to set the link for this item to be like this: http://your_site.com/home_page/#anchor_id where anchor_id will be the ID of the ROW on your home page.', 'woodmart'); ?></span>
				</label>
			</p>
			<p class="description description-wide nmi-callbtn">
				<label for="edit-menu-item-callbtn-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('"Call to action" button', 'woodmart'); ?><br>
					<select id="edit-menu-item-callbtn-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-callbtn[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""></option>
						<option value="enable" <?php selected( $callbtn, 'enable', true); ?>><?php esc_html_e('Enable', 'woodmart'); ?></option>
						<option value="disable" <?php selected( $callbtn, 'disable', true); ?>><?php esc_html_e('Disable', 'woodmart'); ?></option>
					</select>
				</label>
			</p>
		<?php
		$output .= ob_get_contents();
		ob_end_clean();


		// Generate menu item image & link's text string
		if ( has_post_thumbnail( $item_id ) ) {
			$post_thumbnail = get_the_post_thumbnail( $item_id, 'thumb' );
			$output .= '<div class="nmi-current-image nmi-div" style="display: none;"><a href="' . $upload_url . '" data-id="' . $item_id . '" class="thickbox add_media link-with-image">' . $post_thumbnail . '</a></div>';
			$link_text = esc_html__( 'Change image', 'woodmart' );

			// For WP 3.5+, add 'remove' action link
			if ( version_compare( $wp_version, '3.5', '>=' ) ) {
				$ajax_nonce = wp_create_nonce( 'set_post_thumbnail-' . $item_id );
				$remove_link = ' | <a href="#" data-id="' . $item_id . '" class="nmi_remove" onclick="NMIRemoveThumbnail(\'' . $ajax_nonce . '\',' . $item_id . ');return false;">' . esc_html__( 'Remove image', 'woodmart' ) . '</a>';
			}
		} else {
			$output .= '<div class="nmi-current-image nmi-div" style="display: none;"></div>';
			$link_text = esc_html__( 'Upload image', 'woodmart' );
		}

		// Append menu item upload link
		$output .= '<div class="nmi-upload-link nmi-div" style="display: none;"><a href="' . $upload_url . '" data-id="' . $item_id . '" class="thickbox add_media">' . esc_html( $link_text ) . '</a>';

		// Append menu item 'remove' link
		if ( isset( $remove_link ) )
			$output .= $remove_link;

		// Close menu item
		$output .= '</div>';

		$output .= '</div><!-- .nmi-item-custom-fields -->';

		// Filter output
		do_action_ref_array( 'nmi_menu_item_walker_output', array( &$output, $item, $depth, $args ) );

		// Add JSONed meta data
		$output .= $this->get_settings( $item_id );

		do_action_ref_array( 'nmi_menu_item_walker_end', array( &$output, $item, $depth, $args ) );
	}

	/**
	 * Get JSONed item's data.
	 *
	 * Heavily based on wp_enqueue_media() and
	 * WP_Scripts::localize()
	 *
	 * @see wp_enqueue_media()
	 * @see WP_Scripts::localize()
	 *
	 * @since 2.0
	 * @access public
	 *
	 * @uses version_compare() To compare WordPress versions.
	 * @uses wp_create_nonce() To create item's nonce.
	 * @uses get_post() To get post's object.
	 * @uses get_post_meta() To get post's meta data.
	 * @uses apply_filters() Calls 'media_view_settings' with the settings
	 *                        and post object to overwrite item's settings.
	 * @uses did_action() To check if action was done.
	 * @uses do_action() Calls 'nmi_setup_settings_var' with the item ID.
	 *
	 * @param int $post_id The item's post ID.
	 * @return string New HTML output.
	 */
	public function get_settings( $post_id ) {
		global $wp_version;

		// Only works for WP 3.5+
		if ( ! version_compare( $wp_version, '3.5', '>=' ) )
			return;

		// Prepare general settings
		$settings = array();

		// Prepare post specific settings
		$post = null;
		if ( isset( $post_id ) ) {
			$post = get_post( $post_id );
			$settings['post'] = array(
				'id' => $post->ID,
				'nonce' => wp_create_nonce( 'update-post_' . $post->ID ),
			);

			$featured_image_id = get_post_meta( $post->ID, '_thumbnail_id', true );
			$settings['post']['featuredImageId'] = $featured_image_id ? $featured_image_id : -1;
			$settings['post']['featuredExisted'] = $featured_image_id ? 1 : -1;
		}

		// Filter item's settins
		$settings = apply_filters( 'media_view_settings', $settings, $post );

		// Prepare Javascript varible name
		$object_name = 'nmi_settings[' . $post->ID . ']';

		// Loop through each setting and prepare it for JSON
		foreach ( (array) $settings as $key => $value ) {
			if ( ! is_scalar( $value ) )
				continue;

			$settings[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );
		}

		// Encode settings to JSON
		$script = "$object_name = " . json_encode( $settings ) . ';';

		// If this is first item, register variable
		if ( ! did_action( 'nmi_setup_settings_var' ) ) {
			$script = "var nmi_settings = [];\n" . $script;
			do_action( 'nmi_setup_settings_var', $post->ID );
		}

		// Wrap everythig
		$output = "<script>\n";
		$output .= "/* <![CDATA[ */\n";
		$output .= "$script\n";
		$output .= "/* ]]> */\n";
		$output .= "</script>\n";

		return $output;
	}
}
