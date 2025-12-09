<?php
class TFGallery_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-gallery';
    }
    
    public function get_title() {
        return esc_html__( 'TF Gallery', 'themesflat-core' );
    }

    public function get_icon() {
		return 'eicon-slider-push';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_style_depends() {
		return ['tf-gallery', 'light-gallery'];
	}

	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Setting', 'themesflat-core'),
	            ]
	        );

			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'style1'  => esc_html__( 'Style 1', 'themesflat-core' ),
						'style2'  => esc_html__( 'Style 2', 'themesflat-core' ),
						'style3'  => esc_html__( 'Style 3', 'themesflat-core' ),
					],
				]
			);

			$repeater = new \Elementor\Repeater();

            $repeater->add_control(
				'image_thumb',
				[
					'label' => esc_html__( 'Choose Image Popup', 'themesflat-core' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
					],
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
							'image_thumb' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
						],
                        [
							'image_thumb' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
						],
                        [
							'image_thumb' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
						],
                        [
							'image_thumb' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME."assets/img/placeholder.jpg",
						],
					],
				]
			);
	        
			$this->end_controls_section();
        // /.End List Setting  
		
	}

	protected function render($instance = []) {
		$settings = $this->get_settings_for_display();
		?>
		<div id="tf-list-gallery" class="tf-list-gallery <?php echo esc_attr($settings['style']); ?>">
			<div class="wrap-gallery">
					<?php $count = 1; foreach ($settings['list'] as $index => $item): 
							if ($count === 1 && $settings['style'] == 'style2') {
								echo '<div class="box">';
							}
						?>

						<div class="item-gallery box-<?php echo $count; ?>" data-src="<?php echo esc_url($item['image_thumb']['url']); ?>">
							<div class="box-gallery">
								<img src="<?php echo esc_url($item['image_thumb']['url']); ?>" alt="gallery">
							</div>
						</div>

					<?php 
					
						if ($count === 2 && $settings['style'] == 'style2') {
							echo '</div>';
						}
					
					$count++; endforeach; ?>
			</div>
		</div>
		<?php
	}
	

}