<?php


class Navolio_Sidebar extends \Elementor\Widget_Base {

	// Widget Name

	public function get_name() {
		return 'sidebar';
	}

	// Widget Titke

	public function get_title() {
		return __( 'Sidebar', 'navolio-core' );
	}

	// Widget Icon

	public function get_icon() {
		return 'fa fa-columns';
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

		<div class="blog-sidebar-content">
		    <?php 
		    $sidebar_id = (is_single()) ? "sidebar-single": "sidebar-blog"; 
		    if ( is_active_sidebar( $sidebar_id ) ) : 
		        dynamic_sidebar( $sidebar_id ); 
		    else :
		        the_widget('WP_Widget_Categories', '', 'before_widget=<div class="widget widget_categories">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>'); 

		        the_widget('WP_Widget_Archives', '', 'before_widget=<div class="widget widget_archive">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>'); 

		        the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<div class="widget widget_tag_cloud">&before_title=<h2 class="widget-title" >&after_title=</h2>&after_widget=</div>');
		    endif; ?>
		</div><!-- /.blog-sidebar-content -->
		<?php
	}
}