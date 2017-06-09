<?php
use Mexitek\PHPColors\Color;

function arch_post_types() {
	return get_post_types_by_support( 'arch-post' );
}

function is_arch_post() {
	$post_type = get_post_type( get_the_ID() );
	return in_array( $post_type, arch_post_types() );
}

function arch_is_home() {
	return is_home() && 1 == get_theme_mod( 'arch_front_page', '' );
}

function arch_title() {
	$arch_title = get_post_meta( get_the_ID(), 'arch_title', true );
	if ( 'no-title' === $arch_title ) {

		return;

	} elseif ( 'no-link-title' === $arch_title ) { ?>

		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '>', '</h2>' ); ?>
		</header>

	<?php
	} elseif ( locate_template( 'components/entry-header.php' ) ) {

			get_template_part( 'components/entry', 'header' );

	} else { ?>

		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<h2 <?php hybrid_attr( 'entry-title' ); ?>>
				<a class="u-1of1 u-inline-flex u-flex-center u-p u-py1" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?><?php arch_do_svg( 'arrow-right' ) ?></a>
			</h2>
		</header>
	<?php
	}
}

function arch_excerpt() {
	$arch_excerpt = get_post_meta( get_the_ID(), 'arch_excerpt', true );
	if ( 'none' === $arch_excerpt || ! hybrid_post_has_content() ) {
		return;
	} ?>
	<div <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php 'content' === $arch_excerpt ? the_content() : the_excerpt(); ?>
	</div>
	<?php
}

// Set default components.
if ( ! function_exists( 'arch_title_choices' ) ) {

	function arch_title_choices() {
		return array(
			''              => ' ',
			'link-title'    => 'Linked Title',
			'no-link-title' => 'Title (no link)',
			'no-title'      => 'Hide Title',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_excerpt_choices' ) ) {

	function arch_excerpt_choices() {
		return array(
			''              => ' ',
			'excerpt'       => 'Excerpt',
			'content'       => 'Content',
			'none'          => 'None',
		);
	}
}

// Set default components.
if ( ! function_exists( 'arch_block_choices' ) ) {

	function arch_block_choices() {
		return array(
			''          => ' ',
			'card'      => 'Card',
			'flag'      => 'Flag',
			'tabs'      => 'Tab Group',
			'accordion' => 'Accordion Group',
			'slides'    => 'Slideshow Group',
		);
	}
}

	// Set default widths.
if ( ! function_exists( 'arch_width_options' ) ) {

	function arch_width_options() {
		return array(
			''              => ' ',
			'u-1of1-md'     => '1/1',
			'u-1of4-md'     => '1/4',
			'u-1of3-md'     => '1/3',
			'u-1of2-md'     => '1/2',
			'u-2of3-md'     => '2/3',
			'u-3of4-md'     => '3/4',
		);
	}
}

function get_arch_block( $post_id ) {
	return get_post_meta( $post_id, 'arch_component', true );
}

function get_arch_bg( $post_id ) {
	return get_post_meta( $post_id, 'arch_bg_color', true );
}




function my_searchwp_exclude( $ids, $engine, $terms ) {
	$entries_to_exclude = get_posts(
		array(
			'post_type' => 'any',
			'key' => 'arch_title',
			'value' => 'no-link-title',
			'compare' => '=',
		)
	);
	$ids = array_unique( array_merge( $ids, array_map( 'absint', $entries_to_exclude ) ) );
	return $ids;
}
add_filter( 'searchwp_exclude', 'my_searchwp_exclude', 10, 3 );


function arch_do_svg( $icon ) {

	$args = array(
		'icon'   => $icon,
		'title'  => $icon,
		'desc'   => '',
		'class'  => 'arch-icon u-flexed-s0',
		'inline' => true,
	);
	echo arch_get_svg( $args );
}
function arch_get_svg( $args = array() ) {

	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'arch' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'arch' );
	}

	// Set defaults.
	$defaults = array(
		'icon'   => '',
		'height' => '',
		'width'  => '',
		'title'  => '',
		'desc'   => '',
		'class'  => '',
		'inline' => true,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Sets unique IDs for use by aria-labelledby.
	$title_id = $args['title'] ? uniqid( 'title-' ) : '';
	$desc_id = $args['desc'] ? uniqid( 'desc-' ) : '';

	// Sets SVG title.
	$title = $args['title'] ? '<title id="' . $title_id . '">' . esc_html( $args['title'] ) . '</title>' : '';

	// Sets SVG desc.
	$desc = $args['desc'] ? '<desc id="' . $desc_id . '">' . esc_html( $args['desc'] ) . '</desc>' : '';

	// Set ARIA labeledby.
	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = 'aria-labelledby="' . $title_id . ' ' . $desc_id . '"';
	} elseif ( $args['title'] ) {
		$aria_labelledby = 'aria-labelledby="' . $title_id . '"';
	} elseif ( $args['desc'] ) {
		$aria_labelledby = 'aria-labelledby="' . $desc_id . '"';
	} else {
		$aria_labelledby = '';
	}

	// Set ARIA hidden.
	if ( $args['title'] || $args['desc'] ) {
		$aria_hidden = '';
	} else {
		$aria_hidden = 'aria-hidden="true"';
	}

	// Sets icon class.
	$class = $args['class'] ? esc_html( $args['class'] ) : 'icon icon-' . esc_html( $args['icon'] );

	$height = $args['height'] ? esc_html( $args['height'] ) : '1em';
	$width = $args['width'] ? esc_html( $args['width'] ) : $height;

	// If our SVG is inline.
	if ( true === $args['inline'] ) {

		// Begin SVG markup.
		$svg = file_get_contents( locate_template( 'images/icons/' . esc_html( $args['icon'] ) . '.svg' ) );

		// Add ARIA hidden, ARIA labeledby and class markup.
		$svg = str_replace( '<svg', '<svg class="' . $class . '" height="' . $height . '" width="' . $width . '"' . $aria_hidden . $aria_labelledby . 'role="img"', $svg );

		if ( $title && $desc ) {

			// Get the intro SVG markup and save as $svg_intro.
			preg_match( '/<svg(.*?)>/', $svg, $svg_intro );

			// Add the title/desc to the markup.
			$svg = str_replace( $svg_intro[0], $svg_intro[0] . $title . $desc, $svg );
		}
	} else { // Otherwise, use our sprite.

		// Begin SVG markup.
		$svg = '<svg class="' . $class . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

		// If there is a title, display it.
		if ( $title ) {
			$svg .= '<title  id="' . $title_id . '">' . esc_html( $args['title'] ) . '</title>';
		}

		// If there is a description, display it.
		if ( $desc ) {
			$svg .= '<desc id="' . $desc_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}

		// Use absolute path in the Customizer so that icons show up in there.
		if ( is_customize_preview() ) {
			$svg .= '<use xlink:href="' . get_template_directory_uri() . '/assets/img/svg-icons.svg' . '#icon-' . esc_html( $args['icon'] ) . '"></use>';
		} else {
			$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
		}

			$svg .= '</svg>';

	}// End if().

	return $svg;
}

/**
 * Return style for using in html.
 *
 * @param  [type] $post_id [description]
 * @param  string $alpha   [description]
 * @return [type]          [description]
 */
function arch_color_style( $post_id, $alpha = '1' ) {
	$post_id = get_the_ID();
	$style = '';
	$style .= 'background-color:';
	$style .= arch_color_rgb( $post_id, $alpha );
	$style .= ';color:';
	$style .= arch_color_text( $post_id );
	$style .= ';';
	return $style;
}

/**
 * [arch_color_hex description]
 *
 * @param  [type] $post_id [description]
 * @return [type]          [description]
 */
function arch_color_hex( $post_id ) {
	$post_id = get_the_ID();
	$arch_color = get_post_meta( $post_id, 'arch_color_picker', true );
	$arch_hex = $arch_color ? trim( $arch_color, '#' ) : get_theme_mod( 'primary_color', '' );
	return "#{$arch_hex}";
}

/**
 * [arch_color_rgb description]
 *
 * @param  [type] $post_id [description]
 * @param  [type] $alpha   [description]
 * @return [type]          [description]
 */
function arch_color_rgb( $post_id, $alpha ) {
	$post_id = get_the_ID();
	$arch_hex = arch_color_hex( $post_id );
	$arch_rgb = implode( ',', hybrid_hex_to_rgb( $arch_hex ) );
	return 'rgba(' . $arch_rgb . ',' . $alpha . ')';
}

/**
 * [arch_color_text description]
 *
 * @param  [type] $post_id [description]
 * @return [type]          [description]
 */
function arch_color_text( $post_id ) {
	$post_id = get_the_ID();
	$arch_color = new Color( arch_color_hex( $post_id ) );
	$text_color = $arch_color->isDark() ? 'fff':'333';
	return "#{$text_color}";
}
