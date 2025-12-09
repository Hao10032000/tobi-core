<?php
class TFHistory_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-history';
    }
    
    public function get_title() {
        return esc_html__( 'TF History', 'themesflat-core' );
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
					'type' => \Elementor\Controls_Manager::TEXTAREA,					
					'label_block' => true,
				]
			);

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
				'content',
				[
					'label' => esc_html__( 'Content', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
				]
			);

            $this->add_control(
				'list',
				[
					'label' => esc_html__( 'List', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
				]
			);

	        
			$this->end_controls_section();
        // /.End List Setting              

	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
        ?>

			<div class="tf-wg-history">
				<div class="shape1">
				<svg width="100%" height="300" viewBox="0 0 1500 200" preserveAspectRatio="none">
    <path	class="wave" d="" />
  </svg>
				</div>

				<div class="shape2">
				<svg width="100%" height="300" viewBox="0 0 1500 200" preserveAspectRatio="none">
    <path	class="wave" d="" />
  </svg>
				</div>

				<h2 class="title animation-up">
					<?php echo wp_kses_post($settings['heading']); ; ?>
				</h2>

				<div class="roadmap">

					<div class="col-line"></div>

					<?php foreach ( $settings['list'] as $index => $item ): ?>
						<div class="wrap-box animation-up">
							<div class="contentbox">
								<?php echo wp_kses_post($item['content']); ?>
							</div>
							<div class="content-spacing"></div>
						</div>
					<?php endforeach; ?>

				</div>

			</div>
        
        <?php
}

}