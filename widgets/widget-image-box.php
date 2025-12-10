<?php
class TFImagebox_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'tf-image-box';
	}

	public function get_title() {
		return esc_html__( 'TF Image Box', 'themesflat-core' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'themesflat_addons' ];
	}
	 public function get_style_depends() {
		return ['tf-image-box'];
	}

	protected function register_controls() {

		/* -------------------------------------------------------------
		*  SECTION: CONTENT
		* ------------------------------------------------------------- */
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'themesflat-core' ),
			]
		);

		// NUMBER OF COLUMNS
		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => '1 Column',
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
				],
			]
		);

		// REPEATER
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Sample Title', 'themesflat-core' ),
			]
		);
		$repeater->add_control(
    'title_tag',
    [
        'label' => esc_html__( 'Title HTML Tag', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'h3',
        'options' => [
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
            'div' => 'DIV',
            'span' => 'SPAN',
            'p' => 'P',
        ],
    ]
);


		$repeater->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Sample description text goes here.', 'themesflat-core' ),
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'items',
			[
				'label' => esc_html__( 'Items', 'themesflat-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'title' => 'Title 1' ],
					[ 'title' => 'Title 2' ],
					[ 'title' => 'Title 3' ],
				],
			]
		);

		$this->end_controls_section();

/* -------------------------------------------------------------
 *  SECTION: STYLE
 * ------------------------------------------------------------- */
$this->start_controls_section(
    'section_style',
    [
        'label' => esc_html__( 'Style', 'themesflat-core' ),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

/* -----------------------------
 * ICON + TITLE WRAPPER
 * ----------------------------- */
$this->add_control(
    'wrap_heading',
    [
        'label' => esc_html__( 'Icon + Title Box', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::HEADING,
    ]
);

$this->add_responsive_control(
    'wrap_padding',
    [
        'label' => esc_html__( 'Padding', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .icon-title-wrap' =>
                'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'wrap_margin',
    [
        'label' => esc_html__( 'Margin', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .icon-title-wrap' =>
                'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'wrap_bg',
    [
        'label' => esc_html__( 'Background', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .icon-title-wrap' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'wrap_radius',
    [
        'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .icon-title-wrap' =>
                'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

/* -----------------------------
 * ICON
 * ----------------------------- */
$this->add_control(
    'icon_style_heading',
    [
        'label' => esc_html__( 'Icon', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_responsive_control(
    'icon_size',
    [
        'label' => esc_html__( 'Icon Size', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px' ],
        'range' => [
            'px' => [ 'min' => 0, 'max' => 200 ],
        ],
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .icon-title-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .tf-imagebox-item .icon-title-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'icon_color',
    [
        'label' => esc_html__( 'Icon Color', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .icon-title-wrap i' => 'color: {{VALUE}};',
            '{{WRAPPER}} .tf-imagebox-item .icon-title-wrap svg path' => 'fill: {{VALUE}};',
        ],
    ]
);

/* -----------------------------
 * TITLE
 * ----------------------------- */
$this->add_control(
    'title_style_heading',
    [
        'label' => esc_html__( 'Title', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'title_typography',
        'selector' => '{{WRAPPER}} .tf-imagebox-title',
    ]
);

$this->add_control(
    'title_color',
    [
        'label' => esc_html__( 'Title Color', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-title' => 'color: {{VALUE}};',
        ],
    ]
);


/* -----------------------------
 * DESCRIPTION
 * ----------------------------- */
$this->add_control(
    'desc_style_heading',
    [
        'label' => esc_html__( 'Description', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name'     => 'desc_typography',
        'selector' => '{{WRAPPER}} .tf-imagebox-item .desc',
    ]
);

$this->add_control(
    'desc_color',
    [
        'label' => esc_html__( 'Color', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .desc' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'desc_margin',
    [
        'label' => esc_html__( 'Margin', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .desc' =>
                'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'desc_padding',
    [
        'label' => esc_html__( 'Padding', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .desc' =>
                'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

/* -----------------------------
 * IMAGE
 * ----------------------------- */
$this->add_control(
    'image_style_heading',
    [
        'label' => esc_html__( 'Image', 'themesflat-core' ),
        'type'  => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_responsive_control(
    'image_width',
    [
        'label' => esc_html__( 'Width', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .image img' => 'width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'image_height',
    [
        'label' => esc_html__( 'Height', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'px', '%' ],
        'selectors' => [
            '{{WRAPPER}} .tf-imagebox-item .image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
        ],
    ]
);

$this->end_controls_section();


	}


	/* -------------------------------------------------------------
	*  RENDER HTML
	* ------------------------------------------------------------- */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$col = !empty($settings['columns']) ? $settings['columns'] : 3;

		?>
<div class="tf-imagebox tf-col-<?php echo esc_attr($col); ?>">

    <?php foreach ($settings['items'] as $item): ?>
    <div class="tf-imagebox-item">

        <!-- ICON + TITLE WRAPPER -->
        <div class="icon-title-wrap">
            <?php
						// Icon
						\Elementor\Icons_Manager::render_icon(
							$item['icon'],
							[ 'aria-hidden' => 'true' ]
						);
						?>
            <?php

						$title_tag = !empty($item['title_tag']) ? $item['title_tag'] : 'h3';

echo sprintf(
    '<%1$s class="tf-imagebox-title">%2$s</%1$s>',
    esc_attr($title_tag),
    esc_html($item['title'])
);
?>

        </div>

        <!-- DESCRIPTION -->
        <p class="desc">
            <?php echo esc_html($item['description']); ?>
        </p>

        <!-- IMAGE -->
        <?php if (!empty($item['image']['url'])) : ?>
        <div class="image">
            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
        </div>
        <?php endif; ?>

    </div>
    <?php endforeach; ?>

</div>
<?php
	}
}