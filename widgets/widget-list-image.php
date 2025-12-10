<?php
class TFListImage_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-list-image';
	}

	public function get_title() {
		return esc_html__( 'TF List Image', 'themesflat-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}

	public function get_style_depends() {
		return [ 'owl-carousel' ];
	}

	public function get_script_depends() {
		return [ 'tf-image-list', 'owl-carousel' ];
	}

	// ============================
	// CONTROLS
	// ============================
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Images', 'themesflat-core' ),
			]
		);

		// Repeater Image List
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Image List', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ] ],
				],
			]
		);

		// Enable Nav
		$this->add_control(
			'show_nav',
			[
				'label'        => esc_html__( 'Enable Navigation', 'themesflat-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'default'      => 'yes',
			]
		);

		// Spacing
		$this->add_control(
			'item_margin',
			[
				'label'   => esc_html__( 'Item Spacing (px)', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 0,
				'max'     => 100,
			]
		);

		// Responsive items
		$this->add_responsive_control(
			'items_responsive',
			[
				'label' => esc_html__( 'Items Per Row', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 4,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'min' => 1,
				'max' => 10,
			]
		);

		$this->end_controls_section();
	}

	// ============================
	// RENDER
	// ============================
	protected function render() {
		$s = $this->get_settings_for_display();

		$show_nav = $s['show_nav'] === 'yes';

		$item_margin     = $s['item_margin'];
		?>

<div class="tf-list-image" style="position: relative;">

    <div class="owl-carousel owl-theme" data-nav="<?php echo $show_nav ? 'true' : 'false'; ?>"
        data-margin="<?php echo esc_attr($item_margin); ?>">

        <?php foreach ( $s['list'] as $item ) : ?>
        <div class="item">
            <div class="image-partner" style="text-align:center;">
                <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="">
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <?php if ( $show_nav ) : ?>

    <div class="nav-button nav-prev">
        <svg width="10" height="17" viewBox="0 0 10 17" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M0 8.44995L8.35 0L9.53999 1.19995L6.66 4.08984L2.35999 8.44995L6.66 12.8101L9.52 15.7L8.32999 16.8999L0 8.44995Z"
                fill="#BF61A3" />
        </svg>
    </div>

    <div class="nav-button nav-next">
        <svg width="10" height="17" viewBox="0 0 10 17" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M9.54004 8.44995L1.19006 0L0 1.19995L2.88 4.08984L7.18005 8.44995L2.88 12.8101L0.0200195 15.7L1.20996 16.8999L9.54004 8.44995Z"
                fill="#BF61A3" />
        </svg>
    </div>

    <?php endif; ?>

</div>

<?php
	}
}