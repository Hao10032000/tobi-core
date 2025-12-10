<?php

class TFbutton_Widget extends \Elementor\Widget_Base {



	public function get_name() {

        return 'tf-button';

    }

    

    public function get_title() {

        return esc_html__( 'TF Button', 'themesflat-core' );

    }



    public function get_icon() {

        return 'eicon-button';

    }

    

    public function get_categories() {

        return [ 'themesflat_addons' ];

    }

	 public function get_style_depends() {
		return ['tf-button'];
	}




	protected function register_controls() {

		// Start List Setting        

			$this->start_controls_section( 'section_setting',

	            [

	                'label' => esc_html__('Setting', 'themesflat-core'),

	            ]

	        );



			$this->add_control( 

                'button_text',

                [

                    'label' => esc_html__( 'Button Text', 'tobi' ),

                    'type' => \Elementor\Controls_Manager::TEXT,

                    'default' => esc_html__( 'Unverbindliches Angebot', 'tobi' ),

                ]

            );	

            

            $this->add_control(

                'post_icon_readmore',

                [

                    'label' => esc_html__( 'Post Icon ', 'tobi' ),

                    'type' => \Elementor\Controls_Manager::ICONS,

                    'default' => [

                        'value' => 'icon-atu-logistik-icon-right1',

                        'library' => 'theme_icon',

                    ],

                ]

            );	

	        

            $this->add_control(

				'link',

				[

					'label' => esc_html__( 'Link', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::URL,

					'placeholder' => esc_html__( 'https://your-link.com', 'themesflat-core' ),

					'default' => [

						'url' => '#',

						'is_external' => false,

						'nofollow' => false,

					],

				]

			);

	        

			$this->end_controls_section();

        // /.End List Setting  



	    // Start Style Style

			$this->start_controls_section(

				'section_style',

				[

					'label' => esc_html__( 'Style', 'themesflat-core' ),

					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

				]

			);

			$this->add_control(

				'h_general',

				[

					'label' => esc_html__( 'General', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::HEADING,

					'separator' => 'before',

				]

			);

			$this->add_responsive_control(

				'align_btn',

				[

					'label' => esc_html__( 'Alignment', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::CHOOSE,

					'default' => 'left',

					'options' => [

						'left'    => [

							'title' => esc_html__( 'Left', 'themesflat-core' ),

							'icon' => 'eicon-text-align-left',

						],

						'center' => [

							'title' => esc_html__( 'Center', 'themesflat-core' ),

							'icon' => 'eicon-text-align-center',

						],

						'right' => [

							'title' => esc_html__( 'Right', 'themesflat-core' ),

							'icon' => 'eicon-text-align-right',

						]

					],

					'selectors' => [

						'{{WRAPPER}} .wrap-tf-button' => 'text-align: {{VALUE}}',

					],

				]

			);

			$this->add_responsive_control( 'padding',

	            [

	                'label' => esc_html__( 'Padding', 'themesflat-core' ),

	                'type' => \Elementor\Controls_Manager::DIMENSIONS,

	                'size_units' => ['px', 'em', '%'],

	                'selectors' => [

	                    '{{WRAPPER}} .tf-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

	                ],

	            ]

	        );		

			

			$this->add_responsive_control( 

				'margin',

				[

					'label' => esc_html__( 'Margin', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::DIMENSIONS,

					'selectors' => [

						'{{WRAPPER}} .tf-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					],

				]

			);



			$this->add_group_control(

				\Elementor\Group_Control_Typography::get_type(),

				[

					'label' => esc_html__( 'Typo Button', 'themesflat-core' ),

					'name' => 'typography_number_df',

					'selector' => '{{WRAPPER}} .tf-button span',

				]

			);



			$this->add_control(
    'icon_size',
    [
        'label' => esc_html__( 'Icon Size', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 300,
                'step' => 1,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .tf-button i' => 'font-size: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .tf-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]
);



			$this->add_group_control( 

				\Elementor\Group_Control_Border::get_type(),

				[

					'name' => 'border',

					'label' => esc_html__( 'Border', 'themesflat-core' ),

					'selector' => '{{WRAPPER}} .tf-button',

				]

			);

			$this->add_responsive_control( 

				'border_radius',

				[

					'label' => esc_html__( 'Border Radius', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::DIMENSIONS,

					'size_units' => [ 'px' , '%' ],

					'selectors' => [

						'{{WRAPPER}} .tf-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					],

				]

			);

			$this->add_control( 

				'color_icon',

				[

					'label' => esc_html__( 'Color Icon', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
            '{{WRAPPER}} .tf-button i' => 'color: {{VALUE}}',
            '{{WRAPPER}} .tf-button svg path' => 'fill: {{VALUE}}',
        ],

				]

			);





            $this->add_control( 

				'color_content',

				[

					'label' => esc_html__( 'Color', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [

						'{{WRAPPER}} .tf-button' => 'color: {{VALUE}}',

					],

				]

			);



			$this->add_control( 

				'bg_content',

				[

					'label' => esc_html__( 'Background', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [

						'{{WRAPPER}} .tf-button' => 'background: {{VALUE}}',

					],

				]

			);
				$this->add_control( 

				'color_icon_hover',

				[

					'label' => esc_html__( 'Color Icon Hover', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [
            '{{WRAPPER}} .tf-button:hover i' => 'color: {{VALUE}}',
            '{{WRAPPER}} .tf-button:hover svg path' => 'fill: {{VALUE}}',
        ],

				]

			);





            $this->add_control( 

				'color_content_hover',

				[

					'label' => esc_html__( 'Color Hover', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [

						'{{WRAPPER}} .tf-button:hover' => 'color: {{VALUE}}',

					],

				]

			);



			$this->add_control( 

				'bg_content_hover',

				[

					'label' => esc_html__( 'Background Hover', 'themesflat-core' ),

					'type' => \Elementor\Controls_Manager::COLOR,

					'selectors' => [

						'{{WRAPPER}} .tf-button:hover, {{WRAPPER}} .tf-button:hover::after' => 'background: {{VALUE}}',

					],

				]

			);

			$this->end_controls_section();

		// /.End Style 

	}	


protected function render( $instance = [] ) {
    $settings = $this->get_settings_for_display();

    // Add button attributes
    $this->add_render_attribute('tf_button', 'class', 'tf-button');

    if (!empty($settings['link']['url'])) {
        $this->add_render_attribute('tf_button', 'href', $settings['link']['url']);

        if (!empty($settings['link']['is_external'])) {
            $this->add_render_attribute('tf_button', 'target', '_blank');
        }

        if (!empty($settings['link']['nofollow'])) {
            $this->add_render_attribute('tf_button', 'rel', 'nofollow');
        }
    }

    // Wrapper
    $this->add_render_attribute('wrap_tf_button', [
        'id'        => "tf-step-{$this->get_id()}",
        'class'     => 'wrap-tf-button',
        'data-tabid'=> $this->get_id(),
    ]);

    /**
     * ============================
     *   ICON MERGE LOGIC
     * ============================
     *
     * Nếu icon Elementor có → dùng icon đó (2 lần)
     * Nếu không có icon → dùng SVG fallback (2 lần)
     */
    $icon_html = '';
    $icon_html_copy = '';

    if (!empty($settings['post_icon_readmore']['value'])) {

        // Elementor icon (render icon into HTML)
        ob_start();
        \Elementor\Icons_Manager::render_icon($settings['post_icon_readmore'], ['aria-hidden' => 'true']);
        $rendered_icon = ob_get_clean();

        $icon_html      = '<span class="button__icon-svg">'.$rendered_icon.'</span>';
        $icon_html_copy = '<span class="button__icon-svg button__icon-svg--copy">'.$rendered_icon.'</span>';

    } else {

        // Fallback SVG
        $fallback_svg = '
            <svg viewBox="0 0 14 15" fill="currentColor" width="10">
                <path d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
            </svg>
        ';

        $icon_html      = '<span class="button__icon-svg">'.$fallback_svg.'</span>';
        $icon_html_copy = '<span class="button__icon-svg button__icon-svg--copy">'.$fallback_svg.'</span>';
    }
?>
<div <?php echo $this->get_render_attribute_string('wrap_tf_button') ?>>

    <a <?php echo $this->get_render_attribute_string('tf_button'); ?>>

        <span class="tf-button__text">
            <?php echo esc_html($settings['button_text']); ?>
        </span>

        <span class="button__icon-wrapper">
            <?php echo $icon_html; ?>
            <?php echo $icon_html_copy; ?>
        </span>

    </a>

</div>
<?php
}

}