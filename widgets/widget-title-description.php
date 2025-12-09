<?php
class TFTitleDescription_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-title-desc';
    }
    
    public function get_title() {
        return esc_html__( 'TF Title Description', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-t-letter';
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
					'type' => \Elementor\Controls_Manager::TEXTAREA,					
					'default' => esc_html__( 'communication', 'themesflat-core' ),
					'label_block' => true,
				]
			);

            $this->add_control(
				'description',
				[
					'label' => esc_html__( 'Description', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,					
					'default' => esc_html__( 'Que signifie communiquer
pour nous ? Texte qui explique
notre méthodologie ipsum
dolor sit amet, consectetuer
adipiscing elit, sed diam
nonummy nibh euismod
tincidunt ut laoreet dolore
magna aliquam Lorem ipsum
dolor sit amet, consectetuer
adipiscing elit, sed diam
nonummy nibh euismod
tincidunt ut laoreet dolore
magna aliquam erat volutpat.', 'themesflat-core' ),
					'label_block' => true,
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
            'h_desc',
            [
                'label' => esc_html__( 'Description', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );	

        $this->add_group_control( 
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography_desc',
                'label' => esc_html__( 'Typography', 'themesflat-core' ),
                'selector' => '{{WRAPPER}} .title-list .description',
            ]
        ); 

        $this->add_control( 
            'desc_color',
            [
                'label' => esc_html__( 'Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-list .description' => 'color: {{VALUE}}',					
                ],
            ]
        );	

        $this->add_responsive_control(
			'desc_list_padding_desc',
			[
				'label' => esc_html__( 'Padding', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-list .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
				 
		 $this->end_controls_section();    
	 // /.End Style 

	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
        ?>

        <div class="title-list st2">
            <h3> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
<path d="M9.04894 1.54302C9.3483 0.621708 10.6517 0.621707 10.9511 1.54302L12.4697 6.21678C12.6035 6.6288 12.9875 6.90776 13.4207 6.90776H18.335C19.3037 6.90776 19.7065 8.14738 18.9228 8.71678L14.947 11.6053C14.5966 11.86 14.4499 12.3113 14.5838 12.7234L16.1024 17.3971C16.4017 18.3184 15.3472 19.0846 14.5635 18.5152L10.5878 15.6266C10.2373 15.372 9.7627 15.372 9.41221 15.6266L5.43648 18.5152C4.65276 19.0846 3.59828 18.3184 3.89763 17.3971L5.41623 12.7234C5.55011 12.3113 5.40345 11.86 5.05296 11.6053L1.07722 8.71678C0.293507 8.14738 0.696283 6.90776 1.66501 6.90776H6.57929C7.01252 6.90776 7.39647 6.6288 7.53035 6.21678L9.04894 1.54302Z" fill="#31F556"/>
</svg> <?php echo $settings['heading']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
<path d="M9.04894 1.54302C9.3483 0.621708 10.6517 0.621707 10.9511 1.54302L12.4697 6.21678C12.6035 6.6288 12.9875 6.90776 13.4207 6.90776H18.335C19.3037 6.90776 19.7065 8.14738 18.9228 8.71678L14.947 11.6053C14.5966 11.86 14.4499 12.3113 14.5838 12.7234L16.1024 17.3971C16.4017 18.3184 15.3472 19.0846 14.5635 18.5152L10.5878 15.6266C10.2373 15.372 9.7627 15.372 9.41221 15.6266L5.43648 18.5152C4.65276 19.0846 3.59828 18.3184 3.89763 17.3971L5.41623 12.7234C5.55011 12.3113 5.40345 11.86 5.05296 11.6053L1.07722 8.71678C0.293507 8.14738 0.696283 6.90776 1.66501 6.90776H6.57929C7.01252 6.90776 7.39647 6.6288 7.53035 6.21678L9.04894 1.54302Z" fill="#31F556"/>
</svg> </h3>

			<?php echo sprintf( '<div class="description">%1$s</div>', $settings['description'] ); ?>
        </div>
        
        <?php
}

}