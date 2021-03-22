<?php

namespace EBC\Widgets;

use Elementor\Core\Schemes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;



if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Alert
 *
 * @since 1.0.0
 */

class EBC_Alert extends Widget_Base { 

    /**
     * Get widget name.
     *
     * Retrieve alert widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-alert';
    }

    /**
     * Get widget title.
     *
     * Retrieve alert widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Alert', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve alert widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fa fa-exclamation-triangle';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the alert widget belongs to.
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
     * Register alert widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {

        $this->start_controls_section(
            'ebc_alert_section',
            [
              'label' => 'Settings',
            ]
          );
      
          $this->add_control (
            'alert_type',
            [
              'label' => __( 'Alert Type', 'ebc-by-motahar' ),
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
            'alert_content',
            [
              'label' => __( 'Alert Content', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => 'This is an example primary type alert'
            ]
          );

          $this->add_control(
            'ebc_show_dismiss',
            [
              'label' => __( 'Dismiss Button', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SELECT,
              'default' => 'show',
              'options' => [
                'show' => __( 'Show', 'ebc-by-motahar' ),
                'hide' => __( 'Hide', 'ebc-by-motahar' ),
              ],
            ]
          );

          $this->add_control(
            'ebc_show_alert_icon',
            [
              'label' => __( 'Alert Icon', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SELECT,
              'default' => 'show',
              'options' => [
                'show' => __( 'Show', 'ebc-by-motahar' ),
                'hide' => __( 'Hide', 'ebc-by-motahar' ),
              ],
            ]
          );

          $this->end_controls_section();

          $this->start_controls_section(
            'section_type',
            [
              'label' => __( 'Alert', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
          );
      
          $this->add_control(
            'background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-alert' => 'background-color: {{VALUE}};',
              ],
            ]
          );
      
          $this->add_control(
            'border_color',
            [
              'label' => __( 'Border Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-alert' => 'border-color: {{VALUE}};',
              ],
            ]
          );
      
          $this->add_control(
            'border_left-width',
            [
              'label' => __( 'Left Border Width', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-alert' => 'border-left-width: {{SIZE}}{{UNIT}};',
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
            'section_title',
            [
              'label' => __( 'Content', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
          );
      
          $this->add_control(
            'content_color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-alert-content' => 'color: {{VALUE}};',
              ],
            ]
          );
      
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'alert_content',
              'selector' => '{{WRAPPER}} .ebc-alert-content',
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

        if ( ! empty( $settings['alert_type'] ) ) {
          $this->add_render_attribute( 'wrapper', 'class', 'ebc-alert alert alert-' . $settings['alert_type'] );
        }

        $this->add_render_attribute( 'wrapper', 'role', 'alert' );

        $this->add_render_attribute( 'alert_content', 'class', 'ebc-alert-content' );
        $this->add_inline_editing_attributes( 'alert_content', 'none' );
        ?>
        <div class="ebc-widget-container">
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <?php if ( 'show' === $settings['ebc_show_dismiss'] ) : ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php endif; ?>
                <?php if ( 'show' === $settings['ebc_show_alert_icon'] ) : ?>
                <span <?php echo $this->get_render_attribute_string( 'alert_content' ); ?>>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
                <?php endif; ?>
                <span <?php echo $this->get_render_attribute_string( 'alert_content' ); ?>> <?php echo $settings['alert_content']?> </span>
            </div>
        </div>
        

    <?php }

    protected function _content_template() {
      ?>
      <# if ( settings.alert_content ) {
        view.addRenderAttribute( {
          alert_content: { class: 'ebc-alert-content' }
        } );

        view.addInlineEditingAttributes( 'alert_content', 'none' );
        #>
        <div class="ebc-widget-container">
            <div class="ebc-alert alert alert-{{ settings.alert_type }}" role="alert">
            <# if ( 'show' === settings.ebc_show_dismiss ) { #>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            <# } #>
            <# if ( 'show' === settings.ebc_show_alert_icon ) { #>
                <span {{{ view.getRenderAttributeString( 'alert_content' ) }}}>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
            <# } #>
            <span {{{ view.getRenderAttributeString( 'alert_content' ) }}}>{{{ settings.alert_content }}}</span>
            </div>
        </div>
      <# } #>
      <?php
    }




 }