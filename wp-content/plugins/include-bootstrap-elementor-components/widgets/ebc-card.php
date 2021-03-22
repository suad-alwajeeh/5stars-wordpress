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

class EBC_Card extends Widget_Base { 

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
        return 'ebc-card';
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
        return __( 'Card', 'ebc-by-motahar' );
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
        return 'fa fa-id-badge';
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

        $this->start_controls_section (
            'ebc_card_section',
            [
              'label' => 'Settings',
            ]
        );

        $this->add_control(
            'image',
			[
				'label' => __( 'Choose Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
        );

        $this->add_control(
            'card_title',
            [
              'label' => __( 'Title', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => 'Card Title'
            ]
        );

        $this->add_control(
            'card_details',
            [
              'label' => __( 'Description', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => 'Some quick example text to build on the card title and make up the bulk of the card\'s content.'
            ]
        );

        $this->add_control(
            'card_button',
            [
              'label' => __( 'Button', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => 'Go Somewhere'
            ]
        );

        $this->add_control(
            'card_button_url',
            [
                'label' => __( 'Button Url', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'ebc-by-motahar' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_section_style',
            [
              'label' => __( 'Card Style', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
      
        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .ebc-widget-container' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .ebc-card-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'margin',
            [
                'label' => __( 'Margin', 'ebc-by-motahar' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => 
                    [
                        'top' => '10',
                        'right' => '250',
                        'bottom' => '10',
                        'left' => '250',
                        'isLinked' => false,
                        'unit' => 'px',
                    ],
				'selectors' => [
					'{{WRAPPER}} .ebc-card-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => __( 'Padding', 'ebc-by-motahar' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ebc-card-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card-border',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-card-wrapper',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
                ],
                'selectors' => [
                '{{WRAPPER}} .ebc-card-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_content_alingment',
            [
              'label' => __( 'Alignment', 'ebc-by-motahar' ),
              'type' => \Elementor\Controls_Manager::CHOOSE,
              'options' => [
                'left' => [
                  'title' => __( 'Left', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-left',
                ],
                'center' => [
                  'title' => __( 'Center', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-center',
                ],
                'right' => [
                  'title' => __( 'Right', 'ebc-by-motahar' ),
                  'icon' => 'fa fa-align-right',
                ],
              ],
              'default' => 'left',
              'toggle' => true,
                      
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
            'card_image_style',
            [
                'label' => __( 'Image', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'image_width',
            [
                'label' => __( 'Image Width', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-image' => 'width: {{SIZE}}%;',
                    ],
            ]
        );

        $this->add_control(
            'modal_image_alingment',
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
              'default' => 'left',
              'toggle' => true,
                      
            ]
        );

        $this->add_control(
            'image_border_width',
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
                    '{{WRAPPER}} .ebc-card-image' => 'border: {{SIZE}}{{UNIt}} solid;',
                    ],
            ]
        );

        $this->add_control(
            'image_border_color',
            [
                'label' => __( 'Border Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-image' => 'border-color: {{VALUE}};',
                    ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-image' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'image_space_top',
            [
                'label' => __( 'Space Top', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-image' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'image_space_bottom',
            [
                'label' => __( 'Space Bottom', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'label' => __('Box Shadow', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-card-image',
            ]
          );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_title_style',
            [
                'label' => __( 'Title', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_title_color',
            [
                'label' => __( 'Title Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-body h1' => 'color: {{VALUE}};',
                    ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typgh',
                'selector' => '{{WRAPPER}} .ebc-card-body h1',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_desc_style',
            [
                'label' => __( 'Description', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_desc_color',
            [
                'label' => __( 'Description Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-body p' => 'color: {{VALUE}};',
                    ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'card_desc_typgh',
                'selector' => '{{WRAPPER}} .ebc-card-body p',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'card_button_style',
            [
                'label' => __( 'Button', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control (
            'card_button_type',
            [
              'label' => __( 'Button Type', 'ebc-by-motahar' ),
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
            'card_button_bg_color',
            [
                'label' => __( 'Background Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .ebc-card-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_button_text_color',
            [
                'label' => __( 'Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .ebc-card-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_button_space_top',
            [
                'label' => __( 'Space Top', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_control(
            'card_button_space_bottom',
            [
                'label' => __( 'Space Bottom', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-card-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn-border',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-card-button',
            ]
        );

        $this->add_control(
            'card_button_border_radius',
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
                    '{{WRAPPER}} .ebc-card-button' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_shadow',
                'label' => __('Box Shadow', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-card-button',
            ]
          );

        $this->end_controls_section();

    }


    protected function render() { 
        $settings = $this->get_settings_for_display();
        $target = $settings['card_button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['card_button_url']['nofollow'] ? ' rel="nofollow"' : '';

        $this->add_render_attribute( 'card_wrapper', 'class', 'ebc-widget-container ebc-card-wrapper card' );

        $this->add_render_attribute( 'card_image', 'class', 'ebc-card-image card-img-top' ); 

        $this->add_render_attribute( 'card_body', 'class', 'ebc-card-body card-body' ); 

        $this->add_render_attribute( 'card_button', 'class', 'ebc-card-button btn btn-' . $settings['card_button_type'] ); 
        
    ?>
    
        <div <?php echo $this->get_render_attribute_string( 'card_wrapper' ); ?> style="text-align: <?php echo $settings['card_content_alingment']; ?>;">
            <img src="<?php echo $settings['image']['url']; ?>" <?php echo $this->get_render_attribute_string( 'card_image' ); ?> alt="image" style="display: flex; align-self: <?php echo $settings['modal_image_alingment']; ?>;">
            <div <?php echo $this->get_render_attribute_string( 'card_body' ); ?>>
                <h1 class="card-title"> <?php echo $settings['card_title']; ?> </h1>
                <p class="card-text"><?php echo $settings['card_details'] ?></p>
                <a <?php echo $this->get_render_attribute_string( 'card_button' ); ?> href="<?php echo $settings['card_button_url']['url']; ?>" <?php echo $target; ?> <?php echo $nofollow; ?> ><?php echo $settings['card_button']; ?></a>
            </div>
        </div>
    
    <?php 

    }



}