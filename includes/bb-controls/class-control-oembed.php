<?php
/**
 * Contact control class for ButterBean.
 */
if ( ! class_exists( 'ButterBean_Control' ) ) {
	return;
}

/**
 * Textarea control class.
 *
 * @since  1.0.0
 * @access public
 */
class ButterBean_Control_Oembed extends ButterBean_Control {


	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'oembed';

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['value'] = esc_url( $this->get_value() );
	}

	public function get_template() {
	?>
		<p>
	        <label>
	            <span class="butterbean-label">{{ data.label }}</span>
	            <input type="url" class="u-1of1" name="{{ data.field_name }}" placeholder="http://website.com" value="{{ data.value }}">
	        </label>
		</p>
<div class="FlexEmbed arch-video-embed">
  <div class="FlexEmbed-ratio FlexEmbed-ratio--16by9"></div>
	<?php echo wp_oembed_get( esc_url( $this->get_value() ) ); ?>
</div>
<?php	}
}
