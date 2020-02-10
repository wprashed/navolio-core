<?php


class Navolio_Instagram_Feed extends \Elementor\Widget_Base {

	// Widget Name

	public function get_name() {
		return 'instagram-feed';
	}

	// Widget Titke

	public function get_title() {
		return __( 'Instagram Feed', 'navolio-core' );
	}

	// Widget Icon

	public function get_icon() {
		return 'fa fa-instagram';
	}

	//	Widget Categories

	public function get_categories() {
		return [ 'navolio_addons' ];
	}

	// Register Widget Control

	protected function _register_controls() {

		$this->register_content_controls();
		$this->register_style_controls();

	}

	// Widget Controls 

	function register_content_controls() {

		// Controls

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Controls', 'navolio-core' ),
			]
		);

		$this->end_controls_section();

	}

	// Style Control

	protected function register_style_controls() {

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style Controls', 'navolio-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();

	}

	// Widget Render Output

	protected function render() {

		$settings   = $this->get_settings_for_display();

		?>
		<?php echo do_shortcode( '[instagram-feed num=8 cols=8 showfollow=true]' ); ?>
		<?php
	}
}