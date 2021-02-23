<?php
/**
 * Display EXIF data via Shortcode. 
 * Usage: [exif id="ID of image" lens="Panasonic G Vario 45-150mm" location="Anytown, US"]
 *
 * @author Greg Rickaby <greg@webdevstudios.com>
 * @since 2020/06/23
 * @param array $atts Possible arguments. Filename is required, lens and location are optional.
 * @return string
 */
function grd_display_exif( $atts ) {

	// Set defaults.
	$atts = shortcode_atts(
		array(
			'id'       => '',
			'lens'     => '',
			'location' => '',
		),
		$atts
	);

	// No ID? Bail...
	if ( empty( $atts['id'] ) ) {
		return false;
	}

	// Get attachment meta for image ID.
	$data = get_post_meta( $atts['id'], '_wp_attachment_metadata' );

	// No data? Bail...
	if ( empty( $data ) ) {
		return false;
	}

	// Destructure image meta array and set variables.
	// @see https://stitcher.io/blog/array-destructuring-with-list-in-php
	[
		'aperture'          => $aperture,
		'camera'            => $camera,
		'created_timestamp' => $timestamp,
		'focal_length'      => $focal_length,
		'iso'               => $iso,
		'shutter_speed'     => $shutter_speed,
	] = $data[0]['image_meta'];

	ob_start();
	?>

	<p class="exif-title"><?php esc_html_e( 'EXIF Data:', 'grd' ); ?></p>
	<ul class="exif-list">
		<?php echo ( $timestamp ) ? '<li class="exif-item"><strong>' . esc_html__( 'Date Taken', 'grd' ) . '</strong>: ' . esc_html( date( 'F d, Y', $timestamp ) ) . '</li>' : ''; ?>
		<?php echo ( $camera ) ? '<li class="exif-item"><strong>' . esc_html__( 'Location', 'grd' ) . '</strong>: ' . wp_kses_post( $atts['location'] ) . '</li>' : ''; ?>
		<?php echo ( $camera ) ? '<li class="exif-item"><strong>' . esc_html__( 'Camera', 'grd' ) . '</strong>: ' . esc_html( $camera ) . '</li>' : ''; ?>
		<?php echo ( $atts['lens'] ) ? '<li class="exif-item"><strong>' . esc_html__( 'Lens', 'grd' ) . '</strong>: ' . wp_kses_post( $atts['lens'] ) . '</li>' : ''; ?>
		<?php echo ( $aperture ) ? '<li class="exif-item"><strong>' . esc_html__( 'Aperture', 'grd' ) . '</strong>: ƒ/' . esc_html( $aperture ) . '</li>' : ''; ?>
		<?php echo ( $iso ) ? '<li class="exif-item"><strong>' . esc_html__( 'ISO', 'twentytwenty' ) . '</strong>: ' . esc_html( $iso ) . '</li>' : ''; ?>
		<?php echo ( $shutter_speed ) ? '<li class="exif-item"><strong>' . esc_html__( 'Shutter Speed', 'grd' ) . '</strong>: 1/' . esc_html( round( 1 / $shutter_speed ) ) . '</li>' : ''; ?>
		<?php echo ( $focal_length ) ? '<li class="exif-item"><strong>' . esc_html__( 'Focal Length', 'grd' ) . '</strong>: ' . esc_html( $focal_length ) . 'mm</li>' : ''; ?>
	</ul>

	<?php
	return ob_get_clean();
}
add_shortcode( 'exif', 'grd_display_exif' );
