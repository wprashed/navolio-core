<?php


class Navolio_About_Author extends \Elementor\Widget_Base {

	// Widget Name

	public function get_name() {
		return 'about-author';
	}

	// Widget Titke

	public function get_title() {
		return __( 'About Author', 'navolio-core' );
	}

	// Widget Icon

	public function get_icon() {
		return 'fa fa-user';
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

		// Title

		$this->add_control(
			'name',
			[
				'label'     => __( 'Name', 'navolio-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Title', 'navolio-core' ),
				'default'     => __( 'Hello, Im Mahmoud', 'navolio-core' ),
			]
		);

		// Description

		$this->add_control(
			'description',
			[
				'label'     => __( 'Description', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'rows'		=> '6',
				'placeholder' => __( 'Enter Description', 'navolio-core' ),
				'default'     => __( "Hi there, my name is Arnold from Binard. Lorem ipsum dolor sitters amet from suez", 'navolio-core' ),
			]
		);

		// Profile Photo

		$this->add_control(
			'profile_photo',
			[
				'label' => __( 'Profile Photo', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		// Signature

		$this->add_control(
			'signature',
			[
				'label' => __( 'Signature', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'navolio-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bt-about-me-widget',
			]
		);

		// Padding

		$this->add_control(
			'padding',
			[
				'label' => __( 'Padding', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bt-about-me-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Margin

		$this->add_control(
			'margin',
			[
				'label' => __( 'Margin', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bt-about-me-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Title

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .name a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .name',
			]
		);

		// Description

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Description Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#727272',
				'selectors' => [
					'{{WRAPPER}} .description' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => __( 'Description Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .description',
			]
		);

		$this->end_controls_section();

	}

	// Widget Render Output

	protected function render() {

		$settings   = $this->get_settings_for_display();

		?>
		<aside class="widget clearfix bt-about-me-widget">
            <div class="widget-content">
                <div class="author-thumb">
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>"><img src="<?php echo $settings['profile_photo']['url'] ?>" alt="img"></a>
                </div>
                <div class="author-info">
                    <h3 class="name"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>"><?php echo $settings['name'] ?></a></h3>
                    <p class="description"><?php echo $settings['description'] ?></p>
                    <div class="author-sign">
                        <img src="<?php echo $settings['signature']['url'] ?>" alt="img">
                    </div>
                </div>
            </div>
        </aside><!--~./ end about me widget ~-->
		<?php
	}
}