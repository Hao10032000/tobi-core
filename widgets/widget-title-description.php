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

    /* -----------------------------------------
     * SECTION: CONTENT
     * ----------------------------------------- */
    $this->start_controls_section(
        'section_setting',
        [
            'label' => esc_html__('Content', 'themesflat-core'),
        ]
    );

    // Title
    $this->add_control(
        'heading',
        [
            'label' => esc_html__('Title', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('NOTRE MISSION', 'themesflat-core'),
            'label_block' => true,
        ]
    );

    // Title Tag
    $this->add_control(
        'title_tag',
        [
            'label' => esc_html__('Title HTML Tag', 'themesflat-core'),
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

    // Gộp icon + svg vào 1 control dạng CHỌN TYPE
    $this->add_control(
        'icon_type',
        [
            'label' => esc_html__('Icon Type', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'icon' => [
                    'title' => 'Icon',
                    'icon' => 'eicon-star',
                ],
                'svg' => [
                    'title' => 'SVG',
                    'icon' => 'eicon-code',
                ],
            ],
            'default' => 'icon',
            'toggle' => true,
        ]
    );

    // LIBRARY ICON
    $this->add_control(
        'title_icon',
        [
            'label' => esc_html__('Icon', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'icon_type' => 'icon'
            ]
        ]
    );

    // SVG UPLOAD
    $this->add_control(
        'title_svg',
        [
            'label' => esc_html__('Upload SVG', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'media_types' => ['svg'],
            'condition' => [
                'icon_type' => 'svg'
            ]
        ]
    );

    // Description
    $this->add_control(
        'description',
        [
            'label' => esc_html__('Description', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Accompagner vos recrutements, vos formations et vos pratiques managériales', 'themesflat-core'),
            'label_block' => true,
        ]
    );

    $this->end_controls_section();

    /* -----------------------------------------
     * SECTION: STYLE
     * ----------------------------------------- */
    $this->start_controls_section(
        'section_style',
        [
            'label' => esc_html__('Style', 'themesflat-core'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // TITLE STYLE
    $this->add_control(
        'title_style_heading',
        [
            'label' => esc_html__('Title', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::HEADING,
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'typography_title',
            'selector' => '{{WRAPPER}} .title-wrap .title-text',
        ]
    );

    $this->add_control(
        'title_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .title-wrap .title-text' => 'color: {{VALUE}}',
            ],
        ]
    );

    // ICON STYLE
    $this->add_control(
        'icon_style_heading',
        [
            'label' => esc_html__('Icon', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before'
        ]
    );

    $this->add_responsive_control(
        'icon_size',
        [
            'label' => esc_html__('Size', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 8, 'max' => 80]
            ],
            'selectors' => [
                '{{WRAPPER}} .title-wrap i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .title-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'icon_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .title-wrap i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .title-wrap svg path' => 'fill: {{VALUE}}',
            ],
        ]
    );

    // DESCRIPTION STYLE
    $this->add_control(
        'desc_style_heading',
        [
            'label' => esc_html__('Description', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before'
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'typography_desc',
            'selector' => '{{WRAPPER}} .title-list .description',
        ]
    );

    $this->add_control(
        'desc_color',
        [
            'label' => esc_html__('Color', 'themesflat-core'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .title-list .description' => 'color: {{VALUE}}',
            ],
        ]
    );
	$this->add_control(
    'desc_margin',
    [
        'label' => esc_html__( 'Margin', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .title-list .description' =>
                'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

    $this->end_controls_section();
}


protected function render($instance = []) {
    $settings = $this->get_settings_for_display();

    $tag  = $settings['title_tag'];
    $text = $settings['heading'];

    // ICON/SVG HTML
    $icon_html = '';

    if ($settings['icon_type'] === 'svg' && !empty($settings['title_svg']['url'])) {

        $response = wp_remote_get( $settings['title_svg']['url'] );
        if (!is_wp_error($response)) {
            $svg_content = wp_remote_retrieve_body($response);
            $icon_html = '<span class="icon-svg">'.$svg_content.'</span>';
        }

    } elseif ($settings['icon_type'] === 'icon' && !empty($settings['title_icon']['value'])) {

        ob_start();
        \Elementor\Icons_Manager::render_icon(
            $settings['title_icon'],
            [ 'aria-hidden' => 'true' ]
        );
        $icon_html = ob_get_clean();
    }
    ?>

    <div class="title-list">
        <div class="title-wrap">
            <?php echo $icon_html; ?>
            <<?php echo $tag; ?> class="title-text">
                <?php echo esc_html($text); ?>
            </<?php echo $tag; ?>>
        </div>

        <div class="description">
            <?php echo wp_kses_post($settings['description']); ?>
        </div>
    </div>

    <?php
}
}
