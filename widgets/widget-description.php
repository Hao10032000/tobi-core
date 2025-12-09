<?php
class TFDescription_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-description';
    }
    
    public function get_title() {
        return esc_html__( 'TF Description', 'themesflat-core' );
    }

    public function get_icon() {
		return 'eicon-text';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

	protected function register_controls() {

			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-core'),
	            ]
	        );

			$this->add_control(
				'description',
				[
					'label' => esc_html__( 'Title', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,					
					'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate ', 'themesflat-core' ),
					'label_block' => true,
				]
			);

			
			$this->add_control( 
				'show_button',
				[
					'label' => esc_html__( 'Show Button Show More', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'themesflat-core' ),
					'label_off' => esc_html__( 'Hide', 'themesflat-core' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

            $this->add_control(
				'title_show',
				[
					'label' => esc_html__( 'Text Show More', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,					
					'default' => esc_html__( 'Read more', 'themesflat-core' ),
					'label_block' => true,
				]
			);
				 
		 $this->end_controls_section();    

		// Start Content Style 
		 $this->start_controls_section( 
			'section_style_content',
			[
				'label' => esc_html__( 'Style', 'themesflat-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);  

		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .tf-description .description' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .tf-description .description',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-description .description, {{WRAPPER}} .tf-description .btn-show ' => 'color: {{VALUE}};',
				],
			]
		);	

		 $this->end_controls_section();    


	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
        ?>

        <div class="tf-description <?php echo esc_attr($settings['show_button'] == 'yes' ? 'show-more' : '') ; ?>">
			<?php echo sprintf( '<div class="description">%1$s</div>', $settings['description'] ); ?>
			<?php if($settings['show_button'] == 'yes'): ?>
            	<div class="btn-show"><?php echo esc_html($settings['title_show']); ?></div>
			<?php endif;?>
        </div>

        <?php
}

}