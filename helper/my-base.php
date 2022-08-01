<?php
namespace Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
abstract class My_Bricks_Element {
	 /* Get flixkity controls
	 * Elements: Carousel, Slider, Team Members.
	 *
	 * @since 1.0
	 */
	public static function get_flickity_controls() {
		$controls['height'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Height', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'height',
					'selector' => '.swiper-slide',
				],
			],
			'placeholder' => 300,
		];

		$controls['gutter'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Spacing', 'bricks' ) . ' (px)',
			'type'        => 'number',
			'placeholder' => 0,
		];

		$controls['imageRatio'] = [
			'tab'       => 'content',
			'group'     => 'settings',
			'label'     => esc_html__( 'Image ratio', 'bricks' ),
			'type'      => 'select',
			'options'   => Setup::$control_options['imageRatio'],
			'default'   => 'ratio-square',
			'clearable' => false,
			'inline'    => true,
		];

		$controls['initialSlide'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Initial slide', 'bricks' ),
			'type'        => 'number',
			'min'         => 0,
			'max'         => 10,
			'placeholder' => 0,
		];

		$controls['slidesToShow'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Items to show', 'bricks' ),
			'type'        => 'number',
			'min'         => 1,
			'max'         => 10,
			'placeholder' => 1,
			'breakpoints' => true, // NOTE: Undocumented (allows to set non-CSS settings per breakpoint: Carousel, Slider, etc.)
		];

		$controls['slidesToScroll'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Items to scroll', 'bricks' ),
			'type'        => 'number',
			'min'         => 1,
			'max'         => 10,
			'placeholder' => 1,
			'breakpoints' => true,
		];

		$controls['effect'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Effect', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'slide'     => esc_html__( 'Slide', 'bricks' ),
				'fade'      => esc_html__( 'Fade', 'bricks' ),
				'cube'      => esc_html__( 'Cube', 'bricks' ),
				'coverflow' => esc_html__( 'Coverflow', 'bricks' ),
				'flip'      => esc_html__( 'Flip', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Slide', 'bricks' ),
			'info'        => __( '"Fade", "Cube", and "Flip" require "Items To Show" set to 1.', 'bricks' ),
		];

		$controls['infinite'] = [
			'tab'     => 'content',
			'group'   => 'settings',
			'label'   => esc_html__( 'Loop', 'bricks' ),
			'type'    => 'checkbox',
			'default' => true,
			'inline'  => true,
		];

		$controls['centerMode'] = [
			'tab'   => 'style',
			'group' => 'settings',
			'label' => esc_html__( 'Center mode', 'bricks' ),
			'type'  => 'checkbox',
		];

		$controls['disableLazyLoad'] = [
			'tab'   => 'style',
			'group' => 'settings',
			'label' => esc_html__( 'Disable lazy load', 'bricks' ),
			'type'  => 'checkbox',
		];

		$controls['adaptiveHeight'] = [
			'tab'    => 'content',
			'group'  => 'settings',
			'label'  => esc_html__( 'Adaptive height', 'bricks' ),
			'type'   => 'checkbox',
			'inline' => true,
		];

		$controls['autoplay'] = [
			'tab'   => 'content',
			'group' => 'settings',
			'label' => esc_html__( 'Autoplay', 'bricks' ),
			'type'  => 'checkbox',
		];

		$controls['pauseOnHover'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Pause on hover', 'bricks' ),
			'type'     => 'checkbox',
			'required' => [ 'autoplay', '!=', '' ],
			'inline'   => true,
		];

		$controls['stopOnLastSlide'] = [
			'tab'      => 'content',
			'group'    => 'settings',
			'label'    => esc_html__( 'Stop on last slide', 'bricks' ),
			'type'     => 'checkbox',
			'info'     => esc_html__( 'No effect with loop enabled', 'bricks' ),
			'required' => [ 'autoplay', '!=', '' ],
			'inline'   => true,
		];

		$controls['autoplaySpeed'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Autoplay speed in ms', 'bricks' ),
			'type'        => 'number',
			'required'    => [ 'autoplay', '!=', '' ],
			'placeholder' => 3000,
		];

		$controls['speed'] = [
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Animation speed in ms', 'bricks' ),
			'type'        => 'number',
			'min'         => 1,
			'placeholder' => 300,
		];

		$controls['responsive'] = [
			'deprecated'  => true, // @since 1.3.5 use: generate_swiper_breakpoint_data_options
			'tab'         => 'content',
			'group'       => 'settings',
			'label'       => esc_html__( 'Responsive breakpoints', 'bricks' ),
			'placeholder' => esc_html__( 'Breakpoint', 'bricks' ),
			'type'        => 'repeater',
			'fields'      => [
				'title'          => [
					'label'  => esc_html__( 'Title', 'bricks' ),
					'type'   => 'text',
					'inline' => true,
				],
				'breakpoint'     => [
					'label' => esc_html__( 'Breakpoint in px', 'bricks' ) . ' <a href="https://swiperjs.com/swiper-api#parameters" target="_blank" rel="noopener">(>=)</a>',
					'type'  => 'number',
				],
				'slidesToShow'   => [
					'label' => esc_html__( 'Items to show', 'bricks' ),
					'type'  => 'number',
					'min'   => 1,
					'max'   => 10,
				],
				'slidesToScroll' => [
					'label' => esc_html__( 'Items to scroll', 'bricks' ),
					'type'  => 'number',
					'min'   => 1,
					'max'   => 10,
				],
			]
		];

		// Arrows

		$controls['arrows'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Show arrows', 'bricks' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'rerender' => true,
			'default'  => true,
		];

		$controls['arrowHeight'] = [
			'tab'         => 'content',
			'group'       => 'arrows',
			'label'       => esc_html__( 'Height', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'height',
					'selector' => '.swiper-button',
				],
			],
			'placeholder' => 50,
			'required'    => [ 'arrows', '!=', '' ],
		];

		$controls['arrowWidth'] = [
			'tab'         => 'content',
			'group'       => 'arrows',
			'label'       => esc_html__( 'Width', 'bricks' ),
			'type'        => 'number',
			'units'       => true,
			'css'         => [
				[
					'property' => 'width',
					'selector' => '.swiper-button',
				],
			],
			'placeholder' => 50,
			'required'    => [ 'arrows', '!=', '' ],
		];

		$controls['arrowBackground'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Background', 'bricks' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.swiper-button',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['arrowBorder'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Border', 'bricks' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.swiper-button',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['arrowTypography'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Typography', 'bricks' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'font',
					'selector' => '.swiper-button',
				],
			],
			'exclude'  => [
				'font-family',
				'font-weight',
				'font-style',
				'text-align',
				'letter-spacing',
				'line-height',
				'text-transform',
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['prevArrowSeparator'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Prev arrow', 'bricks' ),
			'type'     => 'separator',
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['prevArrow'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Prev arrow', 'bricks' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'ionicons',
				'icon'    => 'ion-ios-arrow-back',
			],
			'css'      => [
				[
					'selector' => '.bricks-swiper-button-prev .icon-svg',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
			'rerender' => true,
		];

		$controls['prevArrowTop'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Top', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'top',
					'selector' => '.bricks-swiper-button-prev',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['prevArrowRight'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Right', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'right',
					'selector' => '.bricks-swiper-button-prev',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['prevArrowBottom'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Bottom', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bricks-swiper-button-prev',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['prevArrowLeft'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Left', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.bricks-swiper-button-prev',
				],
			],
			'default'  => '50px',
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['nextArrowSeparator'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Next arrow', 'bricks' ),
			'type'     => 'separator',
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['nextArrow'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Next arrow', 'bricks' ),
			'type'     => 'icon',
			'default'  => [
				'library' => 'ionicons',
				'icon'    => 'ion-ios-arrow-forward',
			],
			'css'      => [
				[
					'selector' => '.bricks-swiper-button-next .icon-svg',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
			'rerender' => true,
		];

		$controls['nextArrowTop'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Top', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'top',
					'selector' => '.bricks-swiper-button-next',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['nextArrowRight'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Right', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'right',
					'selector' => '.bricks-swiper-button-next',
				],
			],
			'default'  => '50px',
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['nextArrowBottom'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Bottom', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bricks-swiper-button-next',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		$controls['nextArrowLeft'] = [
			'tab'      => 'content',
			'group'    => 'arrows',
			'label'    => esc_html__( 'Left', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.bricks-swiper-button-next',
				],
			],
			'required' => [ 'arrows', '!=', '' ],
		];

		// Dots

		$controls['dots'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Show dots', 'bricks' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'rerender' => true,
		];

		$controls['dotsDynamic'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Dynamic dots', 'bricks' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsVertical'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Vertical', 'bricks' ),
			'type'     => 'checkbox',
			'inline'   => true,
			'css'      => [
				[
					'property' => 'flex-direction',
					'selector' => '.swiper-pagination-bullets',
					'value'    => 'column',
				],
			],
			'rerender' => true,
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsHeight'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Height', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'units'    => [
				'px' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'css'      => [
				[
					'property' => 'height',
					'selector' => '.swiper-pagination-bullet',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsWidth'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Width', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'units'    => [
				'px' => [
					'min' => 1,
					'max' => 100,
				],
			],
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.swiper-pagination-bullet',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsTop'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Top', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'top',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsRight'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Right', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'right',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
				],
				[
					'property' => 'left',
					'value'    => 'auto',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
				],
				[
					'property' => 'transform',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
					'value'    => 'translateX(0)',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsBottom'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Bottom', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsLeft'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Left', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
				],
				[
					'property' => 'transform',
					'selector' => '.bricks-swiper-container + .swiper-pagination-bullets',
					'value'    => 'translateX(0)',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsBorder'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Border', 'bricks' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.swiper-pagination-bullet',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsSpacing'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Spacing', 'bricks' ),
			'type'     => 'dimensions',
			'css'      => [
				[
					'property' => 'margin',
					'selector' => '.swiper-pagination-bullet',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsColor'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Color', 'bricks' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.swiper-pagination-bullet',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-bullet',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		$controls['dotsActiveColor'] = [
			'tab'      => 'content',
			'group'    => 'dots',
			'label'    => esc_html__( 'Active color', 'bricks' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'background-color',
					'selector' => '.swiper-pagination-bullet-active',
				],
				[
					'property' => 'color',
					'selector' => '.swiper-pagination-bullet-active',
				],
			],
			'required' => [ 'dots', '!=', '' ],
		];

		return $controls;
	}

	/**
	 * Render swiper nav: Navigation (arrows) & pagination (dots)
	 *
	 * Elements: Carousel, Slider, Team Members.
	 *
	 * @param array $options SwiperJS options.
	 *
	 * @since 1.4
	 */
	public function render_swiper_nav( $options = false ) {
		$options = $options ? $options : $this->settings;

		$output = '';

		// Dots (pagination)
		if ( isset( $options['dots'] ) ) {
			$output .= '<div class="swiper-pagination"></div>';
		}

		// ARROWS (navigation)
		if ( isset( $options['arrows'] ) ) {
			// Prev arrow
			$prev_arrow = false;

			// Check: Element & theme style settings
			if ( ! empty( $options['prevArrow'] ) ) {
				$prev_arrow = self::render_icon( $options['prevArrow'] );
			} elseif ( ! empty( Theme_Styles::$active_settings[ $this->name ]['prevArrow'] ) ) {
				$prev_arrow = self::render_icon( Theme_Styles::$active_settings[ $this->name ]['prevArrow'] );
			}

			if ( $prev_arrow ) {
				$output .= '<div class="swiper-button bricks-swiper-button-prev">' . $prev_arrow . '</div>';
			}

			// Next arrow
			$next_arrow = false;

			// Check: Element & theme style settings
			if ( ! empty( $options['nextArrow'] ) ) {
				$next_arrow = self::render_icon( $options['nextArrow'] );
			} elseif ( ! empty( Theme_Styles::$active_settings[ $this->name ]['nextArrow'] ) ) {
				$next_arrow = self::render_icon( Theme_Styles::$active_settings[ $this->name ]['nextArrow'] );
			}

			if ( $next_arrow ) {
				$output .= '<div class="swiper-button bricks-swiper-button-next">' . $next_arrow . '</div>';
			}
		}

		return $output;
	}

}


