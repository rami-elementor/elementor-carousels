<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CSS_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'css-carousel';
	}

	public function get_title(): string {
		return esc_html__( 'CSS Carousel', 'elementor-carousels' );
	}

	public function get_icon(): string {
		return 'eicon-nested-carousel';
	}

	public function get_categories(): array {
		return [ 'elementor-carousels' ];
	}

	public function get_keywords(): array {
		return [ 'carousel', 'slider', 'gallery' ];
	}

	public function get_custom_help_url(): string {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function has_widget_inner_wrapper(): bool {
		return false;
	}

	protected function is_dynamic_content(): bool {
		return false;
	}

	public function get_style_depends(): array {
		return [ 'css-carousel' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Carousel', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'anchor_name',
			[
				'label' => esc_html__( 'Anchor name', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '--carousel', 'elementor-carousels' ),
				'dynamic' => [
					'active' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--carousel-name: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'carousel',
			[
				'label' => esc_html__( 'Carousel slides', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'scroll_buttons',
			[
				'label' => esc_html__( 'Scroll buttons', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor-carousels' ),
				'label_off' => esc_html__( 'Hide', 'elementor-carousels' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'previous_button_label',
			[
				'label' => esc_html__( 'Previous button label', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Previous', 'elementor-carousels' ),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)' => 'content: "{{VALUE}}";',
				],
			]
		);

		$this->add_control(
			'next_button_label',
			[
				'label' => esc_html__( 'Next button label', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Next', 'elementor-carousels' ),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)' => 'content: "{{VALUE}}";',
				],
			]
		);

		$this->add_control(
			'scroll_markers',
			[
				'label' => esc_html__( 'Scroll markers', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementor-carousels' ),
				'label_off' => esc_html__( 'Hide', 'elementor-carousels' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'focusable_slides',
			[
				'label' => esc_html__( 'Focusable slides', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_carousel_slides_section',
			[
				'label' => esc_html__( 'Carousel slides', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_width',
			[
				'label' => esc_html__( 'Slide width', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'size' => 200,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--slide-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_gap',
			[
				'label' => esc_html__( 'Slides gap', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--slides-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel img' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_scroll_buttons_section',
			[
				'label' => esc_html__( 'Scroll buttons', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_start_position_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Previous button position', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_position_inline',
			[
				'label' => esc_html__( 'Horizontal', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--scroll-button-start-position-inline: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_position_block',
			[
				'label' => esc_html__( 'Vertical', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'start',
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--scroll-button-start-position-block: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_end_position_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Next button position', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_position_inline',
			[
				'label' => esc_html__( 'Horizontal', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-middle',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--scroll-button-end-position-inline: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_position_block',
			[
				'label' => esc_html__( 'Vertical', 'elementor-carousels' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'elementor-carousels' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'end',
				'selectors' => [
					'{{WRAPPER}} .carousel' => '--scroll-button-end-position-block: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_start_style_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Previous button style', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_start_color',
			[
				'label' => esc_html__( 'Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)' => 'color: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_button_start_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)',
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_start_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-start)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_end_style_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Next button style', 'elementor-carousels' ),
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_control(
			'scroll_button_end_color',
			[
				'label' => esc_html__( 'Color', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)' => 'color: {{VALUE}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'scroll_button_end_border',
				'selector' => '{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)',
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'scroll_button_end_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .carousel.scroll-buttons::scroll-button(inline-end)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'scroll_buttons' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_scroll_markers_section',
			[
				'label' => esc_html__( 'Scroll markers', 'elementor-carousels' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroll_markers' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'carousel' );

		if ( $settings['scroll_buttons'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'scroll-buttons' );
		}

		if ( $settings['scroll_markers'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'scroll-markers' );
		}

		if ( $settings['focusable_slides'] ) {
			$this->add_render_attribute( 'slides', 'tabindex', '0' );
		}
		?>
		<ul <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
		<?php foreach ( $settings['carousel'] as $index => $image ) { ?>
			<li <?php $this->print_render_attribute_string( 'slides' ); ?>>
				<img src="<?php echo esc_url( $image['url'] ); ?>" width="300" height="600">
			</li>
		<?php } ?>
		</ul>
		<?php
	}

	protected function content_template(): void {
		?>
		<#
		view.addRenderAttribute( 'wrapper', 'class', 'carousel' );

		if ( settings.scroll_buttons ) {
			view.addRenderAttribute( 'wrapper', 'class', 'scroll-buttons' );
		}

		if ( settings.scroll_markers ) {
			view.addRenderAttribute( 'wrapper', 'class', 'scroll-markers' );
		}

		if ( settings.focusable_slides ) {
			view.addRenderAttribute( 'slides', 'tabindex', '0' );
		}
		#>
		<ul {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
		<# _.each( settings.carousel, function( image, index ) { #>
			<li {{{ view.getRenderAttributeString( 'slides' ) }}}>
				<img src="{{ image.url }}" width="300" height="600">
			</li>
		<# } ); #>
		</ul>
		<?php
	}

}
