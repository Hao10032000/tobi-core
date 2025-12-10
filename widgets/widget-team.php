<?php
class TFTeam_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'tf-team';
    }
    
    public function get_title() {
        return esc_html__( 'TF Team', 'themesflat-core' );
    }

    public function get_icon() {
		return 'eicon-person';
    }
    
    public function get_categories() {
        return [ 'themesflat_addons' ];
    }

	protected function register_controls() {

	    // ==== TEAM SETTINGS ====
		$this->start_controls_section(
			'section_setting',
	        [ 'label' => esc_html__( 'Settings', 'themesflat-core' ) ]
	    );

		$this->add_control(
			'image_thumb',
			[
				'label'   => esc_html__( 'Avatar', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . "assets/img/placeholder.jpg",
				],
			]
		);

		$this->add_control(
			'name',
			[
				'label'       => esc_html__( 'Name', 'themesflat-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'Renaud Boissac',
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Name HTML Tag', 'themesflat-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
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

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'themesflat-core' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default'     => [
					'url' => '#',
					'is_external' => false,
				],
			]
		);

	    $this->end_controls_section();

		/*--------------------------------------------------------------
		# AVATAR STYLE
		--------------------------------------------------------------*/
		$this->start_controls_section(
			'section_avatar_style',
			[
				'label' => esc_html__( 'Avatar', 'themesflat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'avatar_width',
			[
				'label' => esc_html__( 'Width', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-team .features-avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_height',
			[
				'label' => esc_html__( 'Height', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tf-team .features-avatar' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_margin',
			[
				'label' => esc_html__( 'Margin', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-team .features-avatar' =>
					'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_padding',
			[
				'label' => esc_html__( 'Padding', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-team .features-avatar' =>
					'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		/*--------------------------------------------------------------
		# NAME STYLE
		--------------------------------------------------------------*/
		$this->start_controls_section(
			'section_name_style',
			[
				'label' => esc_html__( 'Name', 'themesflat-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typo',
				'selector' => '{{WRAPPER}} .tf-team .team-name',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Color', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-team .team-name' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-team .team-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'themesflat-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tf-team .team-name:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tf-team .team-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'name_margin',
			[
				'label'     => esc_html__( 'Margin', 'themesflat-core' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-team .team-name' =>
					'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'name_padding',
			[
				'label'     => esc_html__( 'Padding', 'themesflat-core' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tf-team .team-name' =>
					'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	// ==== RENDER ====
	protected function render() {
		$s = $this->get_settings_for_display();

		$tag = $s['title_tag'];

		$link_open = '';
		$link_close = '';

		if ( ! empty( $s['link']['url'] ) ) {
			$this->add_render_attribute( 'team_link', 'href', $s['link']['url'] );
			if ( $s['link']['is_external'] ) {
				$this->add_render_attribute( 'team_link', 'target', '_blank' );
			}
			$link_open  = '<a '.$this->get_render_attribute_string('team_link').'>';
			$link_close = '</a>';
		}
		?>
		
		<div class="tf-team">

			<div class="features-avatar">
				<?php
				echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $s, 'full', 'image_thumb' );
				?>
			</div>

			<div class="content">

				<?php if ( ! empty( $s['name'] ) ) : ?>
					<<?php echo $tag; ?> class="team-name">
						<?php echo $link_open . esc_html( $s['name'] ) . $link_close; ?>
					</<?php echo $tag; ?>>
				<?php endif; ?>

			</div>

		</div>

		<?php
	}
}
