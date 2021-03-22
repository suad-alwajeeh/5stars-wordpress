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
 * 
 */

class EBC_Modal extends Widget_Base { 

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
        return 'ebc-modal';
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
        return __( 'Modal', 'ebc-by-motahar' );
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
        return 'fas fa-window-restore';
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

    protected function _register_controls() {

        $this->start_controls_section(
            'ebc_modal_section',
            [
              'label' => 'Settings',
            ]
          );

        $this->add_control(
            'modal_unique_id',
            [
                'label' => 'Modal Unique ID',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'example_modal_1'
            ]
        );

        $this->add_control(
            'modal_size',
            [
               'label' => __( 'Modal Size', 'ebc-by-motahar' ),
               'type' => Controls_Manager::SELECT,
               'default' => 'lg',
               'options' => [
                    'sm' => __( 'Small', 'ebc-by-motahar' ),
                    'lg' => __( 'Medium', 'ebc-by-motahar' ),
                    'xl' => __( 'Large', 'ebc-by-motahar' ),
                ],
            ]
          );

        $this->add_control(
            'modal_lauch_button',
            [
                'label' => 'Modal Launch Button',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Modal Launch Button'
            ]
        );

        $this->add_control(
            'modal_title',
            [
                'label' => 'Modal Title',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Example Modal',
                'separetor' => 'before'
            ]
        );

        $this->add_control(
            'modal_body',
            [
                'label' => 'Modal Body',
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.'
            ]
        );

        $this->add_control(
            'modal_close',
            [
                'label' => 'Close Button',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Close'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_modal_launch_button',
            [
              'label' => __( 'Call to Action Button', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'modal_launch_button_type',
            [
                'label' => __( 'Button Size', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'primary',
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
          'modal_launch_button_alingment',
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
            'default' => 'left',
            'toggle' => true,
                    
          ]
        );

        $this->add_control(
            'modal_launch_button_background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-launch-button' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'modal_launch_button_text_color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-launch-button' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'modal_launch_button_width',
            [
                'label' => __( 'Width', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                        'min' => 100,
                        'max' => 500,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-modal-launch-button' => 'width: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'modal_launch_button_height',
            [
                'label' => __( 'Height', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                        'min' => 50,
                        'max' => 200,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-modal-launch-button' => 'height: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'modal_launch_button_border_color',
            [
              'label' => __( 'Border Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-launch-button' => 'border-color: {{VALUE}};',
              ],
            ]
        );


        $this->add_control(
            'modal_launch_button_border_width',
            [
                'label' => __( 'Border Width', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                        'min' => 0,
                        'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-modal-launch-button' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'modal_launch_button_border_radius',
            [
                'label' => __( 'Border Radius', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                        'min' => 0,
                        'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-modal-launch-button' => 'border-radius: {{SIZE}}{{UNIT}};',
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
            'section_type',
            [
              'label' => __( 'Modal', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'position',
            [
                'label' => __( 'Position From Top', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                        'min' => 0,
                        'max' => 300,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .modal' => 'top: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'text-color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'border',
            [
              'label' => __( 'Border Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'border-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'border-width',
            [
              'label' => __( 'Border Width', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'border-width: {{SIZE}}{{UNIT}};',
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
                  'max' => 200,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                  'max' => 500,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-style' => 'padding: {{SIZE}}{{UNIT}};',
              ],
            ]
          );

          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'modal_typography',
              'selector' => '{{WRAPPER}} .ebc-modal-style',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
          );


        $this->end_controls_section();

        $this->start_controls_section(
            'modal-header',
            [
              'label' => __( 'Modal Header', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header-background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-header' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'header-text-background',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-header h5' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'header-border-bottom',
            [
              'label' => __( 'Border Bottom Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-header' => 'border-bottom-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'modal_header_typegraphy',
              'selector' => '{{WRAPPER}} .ebc-modal-header h5',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
          );

        $this->end_controls_section();

        $this->start_controls_section(
            'modal-footer',
            [
              'label' => __( 'Modal Footer', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'footer-background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'footer-text-background',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'footer-border-top',
            [
              'label' => __( 'Border Top Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer' => 'border-top-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
          'footer_button_align',
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
            'default' => 'center',
                    'toggle' => true,
                    
          ]
        );
        
        $this->add_control(
            'footer-button-background',
            [
              'label' => __( 'Button Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer button' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'footer-button-text',
            [
              'label' => __( 'Button Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer button' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'footer-button-border',
            [
              'label' => __( 'Button Border', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer button' => 'border-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'footer-button-border-radius',
            [
              'label' => __( 'Button Border Radius', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 200,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-modal-footer button' => 'border-radius: {{SIZE}}{{UNIT}};',
              ],
            ]
          );

          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'modal_footer_typography',
              'selector' => '{{WRAPPER}} .ebc-modal-footer button',
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

        
        $this->add_render_attribute( 'wrapper', 'class', 'ebc-modal modal fade' );

        $this->add_render_attribute( 'modal_style', 'class', 'ebc-modal-style modal-content' );

        $this->add_render_attribute( 'modal_header_style', 'class', 'ebc-modal-header modal-header' );

        $this->add_render_attribute( 'modal_footer_style', 'class', 'ebc-modal-footer modal-footer' );

        $this->add_render_attribute( 'modal_launch_button', 'class', 'ebc-modal-launch-button btn btn-'. $settings['modal_launch_button_type'] );
        
      ?>

        <!-- Button trigger modal -->
        
        <div class="modal_lauch_button_wrapper" style="display: flex; justify-content: <?php echo $settings['modal_launch_button_alingment']; ?>">
            <div class="ebc-widget-container">
                <button type="button" <?php echo $this->get_render_attribute_string( 'modal_launch_button' ); ?> data-toggle="modal" data-target="#<?php echo $settings['modal_unique_id']; ?>">
                    <?php  echo $settings['modal_lauch_button']; ?>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?> id="<?php echo $settings['modal_unique_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $settings['modal_unique_id']; ?>Title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-<?php echo $settings['modal_size']; ?>" role="document">
                <div <?php echo $this->get_render_attribute_string( 'modal_style' ); ?>>
                    <div <?php echo $this->get_render_attribute_string( 'modal_header_style' ); ?>>
                        <h5 class="modal-title" id="<?php echo $settings['modal_unique_id']; ?>Title"><?php  echo $settings['modal_title']; ?></h5>
                    </div>
                    <div class="modal-body">
                        <?php echo $settings['modal_body']; ?>
                    </div>
                    <div <?php echo $this->get_render_attribute_string( 'modal_footer_style' ); ?> style="justify-content: <?php echo $settings['footer_button_align']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $settings['modal_close']; ?></button>
                    </div>
                </div>
            </div>
        </div>

    <?php }



}
