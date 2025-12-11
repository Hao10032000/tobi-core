<?php
class TFTextList_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tf-text-list';
    }

    public function get_title() {
        return esc_html__( 'TF Text List', 'themesflat-core' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ul';
    }

    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

    public function get_keywords() {
        return [ 'text', 'list', 'tf', 'themesflat' ];
    }

    protected function register_controls() {

        /*----------------------------------*
         * CONTENT
         *----------------------------------*/
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'themesflat-core' ),
            ]
        );

        // Layout
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical' => esc_html__( 'Vertical', 'themesflat-core' ),
                    'horizontal' => esc_html__( 'Horizontal', 'themesflat-core' ),
                ],
            ]
        );

        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text_item',
            [
                'label' => esc_html__( 'Text Item', 'themesflat-core' ),
                'type'  => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'List item text', 'themesflat-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_list',
            [
                'label' => esc_html__( 'Text List', 'themesflat-core' ),
                'type'  => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'text_item' => 'Item 1' ],
                    [ 'text_item' => 'Item 2' ],
                ],
                'title_field' => '{{{ text_item }}}',
            ]
        );

        // Space Between
$this->add_responsive_control(
    'space_between',
    [
        'label' => esc_html__( 'Space Between', 'themesflat-core' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [ 'min' => 0, 'max' => 100 ],
        ],
        'default' => [
            'size' => 10,
        ],
        'selectors' => [
            '{{WRAPPER}} .tf-text-list' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);



        $this->end_controls_section();

        /*----------------------------------*
         * STYLE
         *----------------------------------*/
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'themesflat-core' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .tf-text-list li',
            ]
        );

        // Text Color
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-text-list li' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'selector' => '{{WRAPPER}} .tf-text-list li',
            ]
        );

        // Padding
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tf-text-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tf-text-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tf-text-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Text Align
        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__( 'Text Align', 'themesflat-core' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
                    'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                    'right' => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tf-text-list li' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

       $layout_class = ($settings['layout'] === 'horizontal') ? 'horizontal' : 'vertical';

echo '<ul class="tf-text-list ' . esc_attr($layout_class) . '">';

        if ( ! empty( $settings['text_list'] ) ) {
            foreach ( $settings['text_list'] as $item ) {
                echo '<li>' . esc_html($item['text_item']) . '</li>';
            }
        }

        echo '</ul>';
    }
}
