<?php
class TFListIcon_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-list-icon';
    }
    
    public function get_title() {
        return esc_html__( 'TF List Icon', 'themesflat-core' );
    }

    public function get_icon() {
		return 'eicon-slider-push';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-core'),
	            ]
	        );

			$this->add_control(
				'heading',
				[
					'label' => esc_html__( 'Title', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,					
					'default' => esc_html__( 'communication', 'themesflat-core' ),
					'label_block' => true,
				]
			);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'fa4compatibility' => 'icon_',
				]
			);

            $repeater->add_control(
				'name',
				[
					'label' => esc_html__( 'Name', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Stratégie', 'themesflat-core' ),
				]
			);

            $this->add_control(
				'list',
				[
					'label' => esc_html__( 'List', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'name' => esc_html__( 'Stratégie', 'themesflat-core' ),
						],
                        [
							'name' => esc_html__( 'Relations médias', 'themesflat-core' ),
						],
                        [
							'name' => esc_html__( 'Communication de crise', 'themesflat-core' ),
						],
                        [
							'name' => esc_html__( 'Social media', 'themesflat-core' ),
						],
                        [
							'name' => esc_html__( 'Veille', 'themesflat-core' ),
						],
                        [
							'name' => esc_html__( 'Identité', 'themesflat-core' ),
						],
					],
				]
			);

			$this->add_responsive_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::CHOOSE,
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
						'{{WRAPPER}} .title-list h3' => 'justify-content: {{VALUE}}',
					],
				]
			);

	        
			$this->end_controls_section();
        // /.End List Setting              

			 // Start Style
			 $this->start_controls_section( 'section_style',
			 [
				 'label' => esc_html__( 'Style', 'themesflat-core' ),
				 'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			 ]
		 );	

		 $this->add_control(
			 'h_title',
			 [
				 'label' => esc_html__( 'Title', 'themesflat-core' ),
				 'type' => \Elementor\Controls_Manager::HEADING,
				 'separator' => 'before',
			 ]
		 );	

		 $this->add_group_control( 
			 \Elementor\Group_Control_Typography::get_type(),
			 [
				 'name' => 'typography_title',
				 'label' => esc_html__( 'Typography', 'themesflat-core' ),
				 'selector' => '{{WRAPPER}} .title-list h3',
			 ]
		 ); 

		 $this->add_control( 
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-list h3' => 'color: {{VALUE}}',					
					'{{WRAPPER}} .title-list h3 path' => 'fill: {{VALUE}}',					
				],
			]
		);			


		 $this->add_control(
			'h_title_list',
			[
				'label' => esc_html__( 'Title List', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		$this->add_group_control( 
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title_list',
				'label' => esc_html__( 'Typography', 'themesflat-core' ),
				'selector' => '{{WRAPPER}} .title-list ul li',
			]
		); 

		$this->add_control( 
			'subtitle_list_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-list ul li' => 'color: {{VALUE}}',					
				],
			]
		);	

		$this->add_responsive_control(
			'title_list_padding_desc',
			[
				'label' => esc_html__( 'Padding', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-list ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_list_margin_desc',
			[
				'label' => esc_html__( 'Margin', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-list ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

				 
		 $this->end_controls_section();    
	 // /.End Style 

	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
        ?>

        <div class="title-list">
            <h3> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
<path d="M9.04894 1.54302C9.3483 0.621708 10.6517 0.621707 10.9511 1.54302L12.4697 6.21678C12.6035 6.6288 12.9875 6.90776 13.4207 6.90776H18.335C19.3037 6.90776 19.7065 8.14738 18.9228 8.71678L14.947 11.6053C14.5966 11.86 14.4499 12.3113 14.5838 12.7234L16.1024 17.3971C16.4017 18.3184 15.3472 19.0846 14.5635 18.5152L10.5878 15.6266C10.2373 15.372 9.7627 15.372 9.41221 15.6266L5.43648 18.5152C4.65276 19.0846 3.59828 18.3184 3.89763 17.3971L5.41623 12.7234C5.55011 12.3113 5.40345 11.86 5.05296 11.6053L1.07722 8.71678C0.293507 8.14738 0.696283 6.90776 1.66501 6.90776H6.57929C7.01252 6.90776 7.39647 6.6288 7.53035 6.21678L9.04894 1.54302Z" fill="#31F556"/>
</svg> <?php echo $settings['heading']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
<path d="M9.04894 1.54302C9.3483 0.621708 10.6517 0.621707 10.9511 1.54302L12.4697 6.21678C12.6035 6.6288 12.9875 6.90776 13.4207 6.90776H18.335C19.3037 6.90776 19.7065 8.14738 18.9228 8.71678L14.947 11.6053C14.5966 11.86 14.4499 12.3113 14.5838 12.7234L16.1024 17.3971C16.4017 18.3184 15.3472 19.0846 14.5635 18.5152L10.5878 15.6266C10.2373 15.372 9.7627 15.372 9.41221 15.6266L5.43648 18.5152C4.65276 19.0846 3.59828 18.3184 3.89763 17.3971L5.41623 12.7234C5.55011 12.3113 5.40345 11.86 5.05296 11.6053L1.07722 8.71678C0.293507 8.14738 0.696283 6.90776 1.66501 6.90776H6.57929C7.01252 6.90776 7.39647 6.6288 7.53035 6.21678L9.04894 1.54302Z" fill="#31F556"/>
</svg> </h3>
            <ul>
                <?php foreach ( $settings['list'] as $index => $item ): ?>

                    <li><?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?> <?php echo esc_html($item['name']); ?></li>

                <?php endforeach; ?>
            </ul>
        </div>
        
        <?php
}

}