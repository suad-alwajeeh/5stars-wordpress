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

class EBC_Tooltip extends Widget_Base { 

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
        return 'ebc-tooltip';
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
        return __( 'Tooltip', 'ebc-by-motahar' );
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
        return 'fa fa-question-circle';
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
            'ebc_tooptip_section',
            [
              'label' => 'Settings',
            ]
        );
      
        $this->add_control (
            'tooltip_position',
            [
                'label' => __( 'Tooltip Position on Hover', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                'top'  => __( 'Top', 'ebc-by-motahar' ),
                'right' => __( 'Right', 'ebc-by-motahar' ),
                'bottom' => __( 'Bottom', 'ebc-by-motahar' ),
                'left' => __( 'Left', 'ebc-by-motahar' )
                ],
            ]
        );

        $this->add_control(
            'tooltip_content',
            [
              'label' => __( 'Tooltip Content', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => 'This is an example content'
            ]
          );


        $this->add_control (
            'tooltip_button_type',
            [
                'label' => __( 'Tooltip Button Type', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'light',
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
            'tooltip_button_content',
            [
              'label' => __( 'Button Content', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => 'Tooltip Button'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_styles',
            [
              'label' => __( 'Tooltip Style', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
          );
      
          $this->add_control(
            'background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-tooltip' => 'background-color: {{VALUE}};',
              ],
            ]
          );

          $this->add_control(
            'text-color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-tooltip' => 'color: {{VALUE}};',
              ],
            ]
          );
      
          $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn-border',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-tooltip',
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

          $this->add_control(
            'tooltip_button_alingment',
            [
              'label' => __( 'Button Alignment', 'ebc-by-motahar' ),
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tooltip_typgh',
                'selector' => '{{WRAPPER}} .ebc-tooltip',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );
      
          $this->end_controls_section();
    

    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() { 
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'tooltip_wrapper', 'class', 'ebc-tooltip-container' );

        $this->add_render_attribute( 'tooltip_style', 'class', 'ebc-widget-container ebc-tooltip btn btn-' . $settings['tooltip_button_type'] );

        $this->add_render_attribute( 'tooltip_style', 'data-container', 'body' );
        
        ?>

        <div <?php echo $this->get_render_attribute_string( 'tooltip_wrapper' ); ?> style="display: flex; justify-content: <?php echo $settings['tooltip_button_alingment']; ?>;">
            <button type="button" <?php echo $this->get_render_attribute_string( 'tooltip_style' ); ?> data-toggle="tooltip" data-placement="<?php echo $settings['tooltip_position']; ?>" title="<?php echo $settings['tooltip_content']; ?>">
                <?php echo $settings['tooltip_button_content']; ?>
            </button>
        </div>
        
        
        <?php 

    }



}