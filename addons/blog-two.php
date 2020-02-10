<?php


class Navolio_Blog_Two extends \Elementor\Widget_Base {

	// Widget Name

	public function get_name() {
		return 'blog-two';
	}

	// Widget Titke

	public function get_title() {
		return __( 'Blog Two', 'navolio-core' );
	}

	// Widget Icon

	public function get_icon() {
		return 'fa fa-rss';
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

		$args = array(
			'orderby' => 'name',
			'order' => 'ASC'
		);

		$categories=get_categories($args);
		$cate_array = array();
		$arrayCateAll = array( 'all' => 'All categories ' );
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->cat_name] = $cate->slug;
			}
		} else {
			$cate_array["No content Category found"] = 0;
		}

		// Controls

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content Controls', 'navolio-core' ),
			]
		);

		// Category

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => array_merge($arrayCateAll,$cate_array),
			]
		);

		// Total Count

		$this->add_control(
			'total_count',
			[
				'label' => __( 'Total Post', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		// Order By

		$this->add_control(
			'order_by',
			[
				'label' => __('Order By', 'navolio-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __('ASC', 'navolio-core'),
					'desc' => __('DESC', 'navolio-core'),
				]
			]
		);

		// Meta Condition

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Show Date', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'navolio-core' ),
				'label_off' => __( 'Hide', 'navolio-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_admin',
			[
				'label' => __( 'Show Admin', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'navolio-core' ),
				'label_off' => __( 'Hide', 'navolio-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' => __( 'Show Excerpt', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'navolio-core' ),
				'label_off' => __( 'Hide', 'navolio-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label' => __( 'Show Thumbnail', 'navolio-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'navolio-core' ),
				'label_off' => __( 'Hide', 'navolio-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();

	}

	// Style Control

	protected function register_style_controls() {

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title Style', 'navolio-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#2d2d2d',
				'selectors' => [
					'{{WRAPPER}} .entry-title a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .entry-title',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'date_style_section',
			[
				'label' => __( 'Date Style', 'navolio-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => __( 'Date Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#e53632',
				'selectors' => [
					'{{WRAPPER}} .entry-date' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'label'    => __( 'Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .entry-date',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'excerpt_style_section',
			[
				'label' => __( 'Excerpt Style', 'navolio-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => __( 'Excerpt Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#666666',
				'selectors' => [
					'{{WRAPPER}} .entry-content p' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => __( 'Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .entry-content p',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'author_style_section',
			[
				'label' => __( 'Author Style', 'navolio-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'author_color',
			[
				'label'     => __( 'Author Color', 'navolio-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#e53632',
				'selectors' => [
					'{{WRAPPER}} .entry-author a' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typography',
				'label'    => __( 'Typography', 'navolio-core' ),
				'scheme'   => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .entry-author a',
			]
		);

		$this->end_controls_section();

	}

	// Widget Render Output

	protected function render() {

		$settings   = $this->get_settings_for_display();

		$category = $settings['category'];
		$total_count = $settings['total_count'];
		$order = $settings['order_by'];

		$args = [];
		if ($category == 'all') {
			$args=[
				'post_type' => 'post',
				'posts_per_page' => $total_count,
				'order' => $order,
			];
		} else {
			$args=[
				'post_type' => 'post', 
				'category_name'=>$category,
				'posts_per_page' => $total_count,
				'order' => $order,
			];
		}

		$blog = new \WP_Query($args);

		?>

		<div class="row">
			<?php
				if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();
			?>
			<div class="col-md-6">
				<div class="blog-page-content">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						
						<?php if ($settings['show_thumb']) : ?>

					    <?php if ( has_post_thumbnail() ) {  ?>
					        <figure class="entry-thumb">          
					            <a href="<?php the_permalink(); ?>">
					                <?php 
					                $sidebar_position = navolio_light_get_options('blog_sidebar_dispay');
					                if ( $sidebar_position == 'full' ) {
					                    navolio_light_post_featured_image(924, 450, true, false);
					                } elseif ( $sidebar_position == 'left' ) {
					                   navolio_light_post_featured_image(652, 418, true, false);
					                } else {
					                    navolio_light_post_featured_image(652, 418, true, false);
					                } ?>            
					            </a> 
					        </figure><!-- /.entry-thumb -->
					    <?php } ?>

					    <?php endif ?>

					    <div class="entry-content">
					        <div class="post-meta-content">

					        	<?php if ($settings['show_date']) : ?>
					            <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
					            <?php endif ?>

					            <?php if ($settings['show_admin']) : ?>
					            <span class="entry-author"><?php echo the_author_posts_link(); ?></span><!--  /.entry-author -->
					            <?php endif ?>

					        </div><!--  /.post-meta-content --> 
					        <?php 
					            /* translators: %s: Permalinks of Posts */
					            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
					        ?>

					        <?php if ($settings['show_excerpt']) : ?>
					        <?php the_excerpt(); ?>
					        <?php endif ?>

					    </div><!-- /.entry-content -->
					</article><!-- /.post -->
				</div>
			</div>
			<?php
				endwhile; endif; wp_reset_postdata();
			?>
		</div>
		<?php
	}
}