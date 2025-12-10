<?php
class TFListImage_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-list-image';
    }
    
    public function get_title() {
        return esc_html__( 'TF Partner', 'tobi' );
    }

    public function get_icon() {
		return 'eicon-slider-push';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-list-image'];
	}

	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'tobi'),
	            ]
	        );

			$this->add_control(
				'partner_style',
				[
					'label' => esc_html__( 'Partner Style', 'tobi' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'options' => [
						'style-text' => [
							'title' => esc_html__( 'Style Text', 'tobi' ),
							'icon' => 'fa fa-edit',
						],
						'style-image' => [
							'title' => esc_html__( 'Style Image', 'tobi' ),
							'icon' => 'fa fa-image',
						],
					],
					'default' => 'style-image',
					'toggle' => false,
				]
			);

			$repeater = new \Elementor\Repeater();
			$repeater2 = new \Elementor\Repeater();

			$repeater->add_control(
				'image',
				[
					'label' => esc_html__( 'Choose Image', 'tobi' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
					],
				]
			);

			$repeater->add_control(
				'link_image',
				[
					'label' => esc_html__( 'Link', 'tobi' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'tobi' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);

			$repeater2->add_control(
				'partner_text',
				[
					'label' => esc_html__( 'Content Text', 'tobi' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'IT Services', 'tobi' ),
				]
			);

			$repeater2->add_control(
				'icon_text',
				[
					'label' => esc_html__( 'Icon', 'tobi' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-star-of-life',
						'library' => 'theme_icon',
					],
				]
			);

			$repeater2->add_control(
				'link_text',
				[
					'label' => esc_html__( 'Content Link', 'tobi' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'tobi' ),
					'default' => [
						'url' => '#',
						'is_external' => false,
						'nofollow' => false,
					],
				]
			);

			$this->add_control(
				'list2',
				[
					'label' => esc_html__( 'List', 'tobi' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater2->get_controls(),
					'default' => [
						[
							'partner_text' => esc_html__( 'IT Services', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'Cyber Security', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'Data Security', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'IT Services', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'Cyber Security', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'Data Security', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'IT Services', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
						[
							'partner_text' => esc_html__( 'Cyber Security', 'tobi' ),
							'link_text' => esc_html__( '#', 'tobi' ),
						],
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

			$this->add_control(
				'list',
				[
					'label' => esc_html__( 'List', 'tobi' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
						[
							'image' =>  URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
							'link' => esc_html__( '#', 'tobi' ),
						],
					],
					'condition' => [
						'partner_style' => 'style-image'
					]
				]
			);

			$this->add_control(
				'hover_image',
				[
					'label' => esc_html__( 'Enable Hover Filter', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'tobi' ),
					'label_off' => esc_html__( 'Off', 'tobi' ),
					'return_value' => 'yes',
					'default' => 'no',
					'condition' => [
						'partner_style' => 'style-image'
					]
				]
			);

			$this->add_control(
				'hover_stop',
				[
					'label' => esc_html__( 'Hover Stop', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'tobi' ),
					'label_off' => esc_html__( 'Off', 'tobi' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);

	        
			$this->end_controls_section();
        // /.End List Setting              

	    // Start Style
	        $this->start_controls_section( 'section_style',
	            [
	                'label' => esc_html__( 'Style', 'tobi' ),
	                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
	            ]
	        );

			$this->add_control(
				'h_image',
				[
					'label' => esc_html__( 'Image', 'tobi' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'condition' => [
						'partner_style' => 'style-image'
					]
				]
			);

			$this->add_responsive_control( 
	        	'image_size',
				[
					'label' => esc_html__( 'Image Width', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .box-item .item  ' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'partner_style' => 'style-image'
					]
				]
			);

			$this->add_responsive_control( 
	        	'image_size_h',
				[
					'label' => esc_html__( 'Image Height', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .box-item .item  ' => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'partner_style' => 'style-image'
					]
				]
			);

			$this->add_control(
				'heading_spacing',
				[
					'label' => esc_html__( 'Spacing Item', 'tobi' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control( 
	        	'image_size_spc',
				[
					'label' => esc_html__( 'Spacing', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .box-item .item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'heading_icon',
				[
					'label' => esc_html__( 'Icon', 'tobi' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

			$this->add_responsive_control( 
	        	'size_icon',
				[
					'label' => esc_html__( 'Icon Size', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .tf-list-image .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

			$this->add_control( 
				'icon_color',
				[
					'label' => esc_html__( 'Color', 'tobi' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .icon i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-list-image .icon svg path' => 'fill: {{VALUE}}',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			); 

			$this->add_responsive_control( 
	        	'icon_text_spacing',
				[
					'label' => esc_html__( 'Icon Spacing', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .list-text .icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

			$this->add_control(
				'heading_text',
				[
					'label' => esc_html__( 'Text', 'tobi' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

	        $this->add_group_control( 
	        	\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'label' => esc_html__( 'Text Typography', 'tobi' ),
					'selector' => '{{WRAPPER}} .tf-list-image .list-text a',
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);
			
			$this->add_control( 
				'text_color',
				[
					'label' => esc_html__( 'Color', 'tobi' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .list-text a' => 'color: {{VALUE}}',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			); 

			$this->add_control( 
				'text_color_hover',
				[
					'label' => esc_html__( 'Color Hover', 'tobi' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .list-text a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-list-image .list-text a:hover i' => 'color: {{VALUE}}',
						'{{WRAPPER}} .tf-list-image .list-text a:hover svg path' => 'fill: {{VALUE}}',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			); 

			$this->add_responsive_control( 
	        	'line_hover_hieght',
				[
					'label' => esc_html__( 'Height Line Bottom Hover', 'tobi' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tf-list-image .list-text a .text::after' => 'height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'partner_style' => 'style-text'
					]
				]
			);

        	$this->end_controls_section();    
	    // /.End Style 
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display(); ?>
<div class="owl-carousel owl-theme">
    <div class="item">
	<div class="image-partner">
	 <img src="" alt="">
	</div>
	</div>
</div>
	<?php	
	}

}