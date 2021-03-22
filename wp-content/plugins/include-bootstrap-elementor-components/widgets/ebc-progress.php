<?php

namespace EBC\Widgets;

use Elementor\Repeater;
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

class EBC_Progress extends Widget_Base { 

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
        return 'ebc-progress';
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
        return __( 'Progress', 'ebc-by-motahar' );
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
        return 'fas fa-battery-three-quarters';
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
            'ebc_progress_section',
            [
              'label' => 'Settings',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'progress_title',
            [
                'label' => __( 'Title', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Example'
            ]
        );

        $repeater->add_control (
            'ebc_progress_stripped',
            [
                'label' => __( 'Is Stripped?', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'progress-bar-striped',
                'options' => [
                    ''  => __( 'Plain', 'ebc-by-motahar' ),
                    'progress-bar-striped' => __( 'Stripped', 'ebc-by-motahar' )
                ],
            ]
        );

        $repeater->add_control (
            'ebc_progress_animated',
            [
                'label' => __( 'Is Animated?', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'progress-bar-animated',
                'options' => [
                    'progress-bar-animated'  => __( 'Animated', 'ebc-by-motahar' ),
                    '' => __( 'Not Animated', 'ebc-by-motahar' )
                ],
            ]
        );

        $repeater->add_control(
            'progress_percentage',
            [
                'label' => __( 'Progress Percentage', 'ebc-by-motahar' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
            ]
        );

        $repeater->add_control(
            'progress_percentage_hide',
            [
                'label' => __( 'Hide Percentage?', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ebc-by-motahar' ),
                'label_off' => __( 'No', 'ebc-by-motahar' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
			'skills',
			[
				'label' => __( 'Repeater List', 'ebc-by-motahar' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'progress_title' => __( 'Title #1', 'ebc-by-motahar' ),
						'progress_percentage' => __( '70', 'ebc-by-motahar' ),
					],
				],
				'title_field' => '{{{ progress_title }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'progress_style',
            [
              'label' => __( 'Progress Style', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'progress_height',
            [
              'label' => __( 'Height', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                'px' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-progress' => 'height: {{SIZE}}{{UNIT}};',
              ],
            ]
          );

        $this->add_control(
            'progress_background',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-progress .progress-bar' => 'background-color: {{VALUE}} !important;',
              ],
            ]
        );

        $this->add_control(
            'progress_text_color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-progress .progress-bar .ebc-progress-content' => 'color: {{VALUE}} !important;',
              ],
            ]
        );

        $this->add_control(
            'progress_content_padding_left',
            [
              'label' => __( 'content Padding Left', 'ebc-by-motahar' ),
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
                '{{WRAPPER}} .ebc-progress .progress-bar .ebc-progress-content' => 'padding-left: {{SIZE}}{{UNIT}};',
              ],
            ]
          );

        $this->add_control(
            'progress_border_radius',
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
                '{{WRAPPER}} .ebc-progress' => 'border-radius: {{SIZE}}{{UNIT}};',
              ],
            ]
          );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'progress_content',
              'selector' => '{{WRAPPER}} .ebc-progress',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();

    }


    protected function render() {
        $settings = $this->get_settings_for_display();

        
        if ( $settings['skills'] ) {
            foreach ( $settings['skills'] as $index => $skill ) {

                $name_key = $this->get_repeater_setting_key( 'progress_title', 'bars', $index );

                $this->add_render_attribute( $name_key, 'class', 'ebc-progress progress my-4');

                $this->add_render_attribute('progress_bar', 'class', 'progress-bar '. $skill['ebc_progress_stripped'] . ' ' . $skill['ebc_progress_animated']);

                $this->add_render_attribute('progress_bar', 'aria-valuenow', ' '. $skill['progress_percentage'] );

        ?>

            <div <?php echo $this->get_render_attribute_string( $name_key ); ?>>
                <div <?php echo $this->get_render_attribute_string('progress_bar'); ?>  role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $skill['progress_percentage']; ?>%">
                    
                    <div class="ebc-progress-content" style="display: flex; justify-content: space-between;">
                        <div> <?php echo $skill['progress_title']; ?> </div>
                        <?php if($skill['progress_percentage_hide'] === 'yes'){ ?>
                            <div><?php echo $skill['progress_percentage']; ?>%</div>
                        <?php } ?>
                    </div>
                    
                </div>
            </div> 

        <?php
            }

        }


    }



}