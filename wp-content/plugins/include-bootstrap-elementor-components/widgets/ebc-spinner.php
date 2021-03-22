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

class EBC_Spinner extends Widget_Base { 

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
        return 'ebc-spinner';
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
        return __( 'Spinner', 'ebc-by-motahar' );
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
        return 'fas fa-circle-notch';
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
            'spinner_type',
            [
                'label' => __( 'Spinner Type', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grow',
                'options' => [
                    'border'  => __( 'Border', 'ebc-by-motahar' ),
                    'grow' => __( 'Grow', 'ebc-by-motahar' ),
                    
                ],
            ]
        );

        $this->add_control (
            'spinner_button_type',
            [
                'label' => __( 'Spinner Color Type', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'danger',
                'options' => [
                    'primary'  => __( 'Primary', 'ebc-by-motahar' ),
                    'secondary' => __( 'Secondary', 'ebc-by-motahar' ),
                    'success' => __( 'Success', 'ebc-by-motahar' ),
                    'danger' => __( 'Danger', 'ebc-by-motahar' ),
                    'warning' => __( 'Warning', 'ebc-by-motahar' ),
                    'info' => __( 'Info', 'ebc-by-motahar' ),
                    'light' => __( 'Light', 'ebc-by-motahar' ),
                    'dark' => __( 'Dark', 'ebc-by-motahar' ),
                ],
            ]
        );

        $this->add_control(
            'spinner_text',
            [
              'label' => __( 'Spinner Text', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => ''
            ]
        );

        $this->add_control(
            'spinner_alingment',
            [
              'label' => __( 'Alignment', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::CHOOSE,
              'options' => [
                'flex-start' => [
                  'title' => __( 'Left', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-left',
                ],
                'center' => [
                  'title' => __( 'Center', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-center',
                ],
                'flex-end' => [
                  'title' => __( 'Right', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-right',
                ],
              ],
              'default' => 'flex-start',
              'toggle' => true,
                      
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_spinne_style_section',
            [
                'label' => __( 'Style', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'spinner-bg-color',
            [
              'label' => __( 'Backgroung Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-wrapper' => 'background-color: {{VALUE}} !important;',
              ],
            ]
        );

        $this->add_control(
            'spinner-spine-color',
            [
              'label' => __( 'Spinner Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-wrapper' => 'color: {{VALUE}} !important;',
              ],
            ]
        );

        $this->add_control(
            'padding',
            [
              'label' => __( 'Padding', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'default' => [
					'unit' => 'px',
					'size' => 10,
				],
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-wrapper' => 'padding: {{SIZE}}{{UNIT}} !important;',
              ],
            ]
        );

        $this->add_control(
            'size',
            [
              'label' => __( 'Spinner Size', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'default' => [
					'unit' => 'px',
					'size' => 40,
				],
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner' => 'padding: {{SIZE}}{{UNIT}} !important;',
              ],
            ]
        );

        $this->add_control(
            'border-radius',
            [
              'label' => __( 'Border Radius', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'default' => [
					'unit' => 'px',
					'size' => 70,
				],
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-wrapper' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
              ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-widget-container',
            ]
          );

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_spinne_text_section',
            [
                'label' => __( 'Text', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'spinner-text-color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-text' => 'color: {{VALUE}} !important;',
              ],
            ]
        );

        $this->add_control(
            'padding-left',
            [
              'label' => __( 'Padding Left', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-spinner-text' => 'padding-left: {{SIZE}}{{UNIT}} !important;',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'spinner_content',
              'selector' => '{{WRAPPER}} .ebc-spinner-text',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('spinner_wrapper', 'class', 'ebc-spinner-wrapper ebc-widget-container btn btn-'. $settings['spinner_button_type']);
        $this->add_render_attribute('spinner_wrapper', 'type', 'button');

        $this->add_render_attribute('ebc_spinner', 'class', 'ebc-spinner spinner-'. $settings['spinner_type'] .' spinner-'. $settings['spinner_type'] .'-sm');
        $this->add_render_attribute('ebc_spinner', 'role', 'status');
        $this->add_render_attribute('ebc_spinner', 'aria-hidden', 'true');

        ?>
        
            <div style="display: flex; justify-content: <?php echo $settings['spinner_alingment']; ?>;">
                <button style="display: flex;" <?php echo $this->get_render_attribute_string('spinner_wrapper'); ?> disabled>
                    <span <?php echo $this->get_render_attribute_string('ebc_spinner'); ?> ></span>
                    <span class="ebc-spinner-text">
                        <?php echo $settings['spinner_text']; ?>
                    </span>
                </button>            
            </div>
        
            

        <?php
    }


}