<?php

namespace EBC\Widgets;

use Elementor\Core\Schemes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;



if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * tooltip
 *
 * @since 1.0.0
 */

class EBC_Toast extends Widget_Base { 

    /**
     * Get widget name.
     *
     * Retrieve tooltip widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-toast';
    }

    /**
     * Get widget title.
     *
     * Retrieve tooltip widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Toast', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tooltip widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fas fa-bread-slice';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the tooltip widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */

    public function get_categories() {
        return [ 'ebc_category' ];
    }


    /**
     * Register tooltip widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {

        $this->start_controls_section (
            'ebc_spinner_section',
            [
              'label' => 'Settings',
            ]
        );
        
        $this->add_control (
            'spinner_autohide',
            [
                'label' => __( 'Auto Hide?', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true'  => __( 'Yes', 'ebc-by-motahar' ),
                    'false' => __( 'No', 'ebc-by-motahar' )
                ],
            ]
        );

        $this->add_control(
            'hide_delay',
            [
                'label' => __( 'Delay Auto Hide', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 60000,
                'step' => 100,
                'default' => 5000,
            ]
        );

        $this->add_control(
            'toast_title',
            [
                'label' => __( 'Title', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Example Toast'
            ]
        );

        $this->add_control(
            'toast_subtitle',
            [
                'label' => __( 'Small Hint Text', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Comming soon'
            ]
        );

        $this->add_control(
            'toast_content',
            [
                'label' => __( 'Toast Message', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Hello, world! This is a toast message.'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'toast_style',
            [
              'label' => __( 'Toast Style', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toast_width',
            [
              'label' => __( 'Toast Width', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 20,
                  'max' => 100,
                ],
              ],
              'default' => [
					'unit' => '%',
					'size' => 40,
				],
              'selectors' => [
                '{{WRAPPER}} .ebc-toast' => 'width: {{SIZE}}% !important;',
                '{{WRAPPER}} .toast' => 'max-width: 100%;',
              ],
            ]
        );

        $this->add_control(
            'toast_padding',
            [
              'label' => __( 'Padding', 'ebc-by-motahar' ),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => [ 'px', '%', 'em' ],
              'selectors' => [
                '{{WRAPPER}} .ebc-toast' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
              ],
              'default' => [
                    'top' => '10',
                    'right' => '20',
                    'bottom' => '10',
                    'left' => '20',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
            'label' => __( 'Background Color', 'ebc-by-motahar' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ebc-toast, {{WRAPPER}} .ebc-toast .toast-header' => 'background-color: {{VALUE}};',
            ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toast-border',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-toast',
            ]
        );


        $this->add_control(
            'toast_border_radius',
            [
              'label' => __( 'Border Radius', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 500,
                ],
              ],
              'default' => [
					'unit' => 'px',
					'size' => 100,
				],
              'selectors' => [
                '{{WRAPPER}} .ebc-toast' => 'border-radius: {{SIZE}}{{UNIT}};',
              ],
            ]
        );

        $this->add_group_control(
          \Elementor\Group_Control_Box_Shadow::get_type(),
          [
            'name' => 'box_shadow',
            'label' => __( 'Box Shadow', 'ebc-by-motahar' ),
            'selector' => '{{WRAPPER}} .ebc-toast',
          ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'toast_header',
            [
              'label' => __( 'Header Content', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_text_color',
            [
                'label' => __( 'Header Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .ebc-toast .toast-header, {{WRAPPER}} .ebc-toast .toast-header .text-muted' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'header_text_typgh',
              'selector' => '{{WRAPPER}} .ebc-toast .toast-header, {{WRAPPER}} .ebc-toast .toast-header .text-muted',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
          );

        $this->end_controls_section();

        $this->start_controls_section(
            'toast_content_style_section',
            [
              'label' => __( 'Content', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_text_color',
            [
                'label' => __( 'Content Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .ebc-toast' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'content_text_typgh',
              'selector' => '{{WRAPPER}} .ebc-toast',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
          );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'ebc-toast toast');

        ?>


        <div <?php echo $this->get_render_attribute_string('wrapper'); ?> data-delay="<?php echo $settings['hide_delay']; ?>" data-autohide="<?php echo $settings['spinner_autohide']; ?>" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto"><?php echo $settings['toast_title']; ?></strong>
                <small class="text-muted"> <?php echo $settings['toast_subtitle']; ?> </small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?php echo $settings['toast_content']; ?>
            </div>
        </div>

        <?php
    }


}