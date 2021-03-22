<?php

namespace EBC\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Utils;



if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * slider
 *
 * @since 1.0.0
 */

class EBC_Slider extends Widget_Base { 
    

    /**
     * Get widget name.
     *
     * Retrieve slider widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-slider';
    }

    /**
     * Get widget title.
     *
     * Retrieve slider widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Slider', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve slider widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fa fa-picture-o';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the slider widget belongs to.
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
     * Register slider widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {

        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Slides', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'ebc-by-motahar' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title & Subtitle', 'ebc-by-motahar' ),
                'placeholder' => __( 'Type title here', 'ebc-by-motahar' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type subtitle here', 'ebc-by-motahar' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'ebc-by-motahar' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed', 'ebc-by-motahar' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 1500,
                'description' => __( 'Slide speed in milliseconds', 'ebc-by-motahar' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay?', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ebc-by-motahar' ),
                'label_off' => __( 'No', 'ebc-by-motahar' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'ebc-by-motahar' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 15000,
                'default' => 5000,
                'description' => __( 'Autoplay speed in milliseconds', 'ebc-by-motahar' ),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop?', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ebc-by-motahar' ),
                'label_off' => __( 'No', 'ebc-by-motahar' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'center',
            [
                'label' => __( 'Center Mode?', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ebc-by-motahar' ),
                'label_off' => __( 'No', 'ebc-by-motahar' ),
                'return_value' => 'yes',
                'description' => __( 'Best works with odd number of slides (Slides To Show) and loop (Infinite Loop)', 'ebc-by-motahar' ),
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_ebc_item',
            [
                'label' => __( 'Slider Item', 'ebc-by-motahar' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => __( 'Slider Height', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .ebc-slick-item',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'ebc-by-motahar' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_ebc_content',
            [
                'label' => __( 'Slide Content', 'ebc-by-motahar' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_alingment',
            [
              'label' => __( 'Text Align', 'ebc-by-motahar' ),
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

        $this->add_responsive_control(
            'content_position',
            [
                'label' => __( 'Content Position', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'ebc-by-motahar' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .ebc-slick-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        $this->add_control(
            '_ebc_slide_content_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'ebc-by-motahar' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .ebc-slick-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_ebc_slider_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'ebc-by-motahar' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .ebc-slick-subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

    }



    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'ebc-slick-slider' );

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        ?>

        <div class="ebc-slider">
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <?php foreach ( $settings['slides'] as $slide ) :
                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                    if ( ! $image ) {
                        $image = $slide['image']['url'];
                    } ?>
                    <div class="ebc-slick-item">
                        <?php if($image) : ?>
                            <img src="<?php echo esc_url( $image ); ?>" />
                        <?php endif; ?>
                        <?php if ( $slide['title'] || $slide['subtitle'] ) : ?>
                            <div class="ebc-slick-content" style="text-align: <?php echo $settings['content_alingment']; ?>;">
                                <?php if ( $slide['title'] ) : ?>
                                    <h2 class="ebc-slick-title"><?php echo $slide['title']; ?></h2>
                                <?php endif; ?>
                                <?php if ( $slide['subtitle'] ) : ?>
                                    <p class="ebc-slick-subtitle"><?php echo $slide['subtitle']; ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        
        <?php 
    }


}