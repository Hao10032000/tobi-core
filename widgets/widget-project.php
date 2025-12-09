<?php

class TFProject_Widget extends \Elementor\Widget_Base {



	public function get_name() {

        return 'tf-project';

    }

    

    public function get_title() {

        return esc_html__( 'TF Project', 'themesflat-core' );

    }



    public function get_icon() {

        return 'eicon-posts-grid';

    }

    

    public function get_categories() {

        return [ 'themesflat_addons' ];

    }

	public function get_script_depends() {
		return ['owl-carousel','tf-project'];
	}



	public function get_style_depends() {
		return ['owl-carousel','tf-project'];
	}



	protected function register_controls() {

        // Start Posts Query        

			$this->start_controls_section( 

				'section_posts_query',

	            [

	                'label' => esc_html__('Query', 'themesflat-core'),

	            ]

	        );

	        $this->add_control( 

					'posts_per_page',

		            [

		                'label' => esc_html__( 'Posts Per Page', 'themesflat-core' ),

		                'type' => \Elementor\Controls_Manager::NUMBER,

		                'default' => '4',

		            ]

		        );



		        $this->add_control( 

		        	'order_by',

					[

						'label' => esc_html__( 'Order By', 'themesflat-core' ),

						'type' => \Elementor\Controls_Manager::SELECT,

						'default' => 'date',

						'options' => [						

				            'date' => 'Date',

				            'ID' => 'Post ID',			            

				            'title' => 'Title',

						],

					]

				);



				$this->add_control( 

					'order',

					[

						'label' => esc_html__( 'Order', 'themesflat-core' ),

						'type' => \Elementor\Controls_Manager::SELECT,

						'default' => 'desc',

						'options' => [						

				            'desc' => 'Descending',

				            'asc' => 'Ascending',	

						],

					]

				);



				$this->add_control( 

					'posts_categories',

					[

						'label' => esc_html__( 'Categories', 'themesflat-core' ),

						'type' => \Elementor\Controls_Manager::SELECT2,

						'options' => ThemesFlat_Addon_For_Elementor_proty::tf_get_taxonomies('project_category'),

						'label_block' => true,

		                'multiple' => true,

					]

				);



				$this->add_control( 

					'exclude',

					[

						'label' => esc_html__( 'Exclude', 'themesflat-core' ),

						'type'	=> \Elementor\Controls_Manager::TEXT,	

						'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'themesflat-core' ),

						'default' => '',

						'label_block' => true,				

					]

				);



				$this->add_control( 

					'sort_by_id',

					[

						'label' => esc_html__( 'Sort By ID', 'themesflat-core' ),

						'type'	=> \Elementor\Controls_Manager::TEXT,	

						'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'themesflat-core' ),

						'default' => '',

						'label_block' => true,				

					]

				);



				$this->add_group_control( 

					\Elementor\Group_Control_Image_Size::get_type(),

					[

						'name' => 'thumbnail',

						'default' => 'full',

					]

				);


			$this->end_controls_section();

        // /.End Posts Query

		// Start Post
		$this->start_controls_section( 
			'section_style_post',
			[
				'label' => esc_html__( 'Style', 'themesflat-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		); 

		$this->add_control(
			'heading_catgory',
			[
				'label' => esc_html__( 'Category', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);
	
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'selector' => '{{WRAPPER}} .tf-project-wrap .project-post .project-category a ',
			]
		);
	
		$this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .project-category a ' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'category_color_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .project-category a:hover ' => 'color: {{VALUE}};',
				],
			]
		);	
	
		$this->add_responsive_control(
			'category_margin',
			[
				'label'     => esc_html__( 'Spacing', 'themesflat-core' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .project-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__( 'Title', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);
	
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tf-project-wrap .project-post .title a',
			]
		);
	
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .title a' => 'color: {{VALUE}};',
				],
			]
		);	
	
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Hover', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .title a:hover ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__( 'Spacing', 'themesflat-core' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_desc',
			[
				'label' => esc_html__( 'Description', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);
	
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .tf-project-wrap .project-post .description',
			]
		);
	
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-project-wrap .project-post .description' => 'color: {{VALUE}};',
				],
			]
		);	
	

		$this->end_controls_section();


	}


	protected function render($instance = []) {

		$settings = $this->get_settings_for_display();


		$this->add_render_attribute( 'tf_project_wrap', ['class' => ['tf-project-wrap', 'themesflat-project-taxonomy' ], 'data-tabid' => $this->get_id()] );



		if ( get_query_var('paged') ) {

           $paged = get_query_var('paged');

        } elseif ( get_query_var('page') ) {

           $paged = get_query_var('page');

        } else {

           $paged = 1;

        }

		$query_args = array(

            'post_type' => 'project',

            'posts_per_page' => $settings['posts_per_page'],

            'paged'     => $paged

        );



        if (! empty( $settings['posts_categories'] )) {        	

        	$query_args['tax_query'] = array(

							        array(

							            'taxonomy' => 'project_category',

							            'field'    => 'slug',

							            'terms'    => $settings['posts_categories']

							        ),

							    );

        }        

        if ( ! empty( $settings['exclude'] ) ) {				

			if ( ! is_array( $settings['exclude'] ) )

				$exclude = explode( ',', $settings['exclude'] );



			$query_args['post__not_in'] = $exclude;

		}



		$query_args['orderby'] = $settings['order_by'];

		$query_args['order'] = $settings['order'];



		if ( $settings['sort_by_id'] != '' ) {	

			$sort_by_id = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );

			$query_args['post__in'] = $sort_by_id;

			$query_args['orderby'] = 'post__in';

		}



		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ) : ?>

		<div <?php echo $this->get_render_attribute_string('tf_project_wrap'); ?>>

			<div class="wrap-project-post">

				

					<div  class="swiper slider-project">
					<div class="owl-carousel" data-bullets="yes" data-spacer="8" data-loop="false" data-auto="false" data-column="2" data-column2="2" data-column3="2">
							<?php while ( $query->have_posts() ) : $query->the_post(); 
							global $post;
								$data_desc = get_post_meta($post->ID, 'desc_project_value', true);
							?>


									<div class="swiper-slide">
										<div class="item">				
	
											<div class="project-post scale-hover">
	
	
												<div class="featured-post">
	
													<a href="<?php echo get_the_permalink(); ?>">
	
														<?php 
		
															$get_id_post_thumbnail = get_post_thumbnail_id();
				
															echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
			
														?>
	
													</a>
	
												</div>
	
												<div class="content"> 

													<div class="project-category"><?php echo esc_attr ( the_terms( get_the_ID(), 'project_category', '', ', ', '' ) ); ?></div>

													<h5 class="title border_eff">
														<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
													</h5>

													<?php if(!empty(themesflat_get_opt_elementor('description_project'))): ?>
														<div class="description">
															<?php echo themesflat_get_opt_elementor('description_project'); ?>
														</div>
													<?php else: ?>
														<div class="description"><?php echo wp_trim_words( get_the_content(), 4, '' ); ?></div>
													<?php endif; ?>

	
													</div>
	
												</div>
	
											</div>
									</div>	


	
							<?php endwhile; ?>
						</div>

					</div>

				
				<?php wp_reset_postdata(); ?>

			</div>

		</div>

		<?php

		else:

			esc_html_e('No posts found', 'themesflat-core');

		endif;

			

	}	



}