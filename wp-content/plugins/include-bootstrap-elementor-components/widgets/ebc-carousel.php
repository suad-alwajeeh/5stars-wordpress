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
 * carousel
 *
 * @since 1.0.0
 */

class EBC_Carousel extends Widget_Base { 
    

    /**
     * Get widget name.
     *
     * Retrieve carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-carousel';
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
        return __( 'Carousel', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fas fa-band-aid';
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
            '_ebc_section_carousel',
            [
                'label' => __( 'Carousels', 'ebc-by-motahar' ),
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

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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

        $this->add_control(
            'ebc_carousels_to_show',
            [
                'label' => __( 'Slides To Show', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '2' => __( '2 Slides', 'ebc-by-motahar' ),
                    '3' => __( '3 Slides', 'ebc-by-motahar' ),
                    '4' => __( '4 Slides', 'ebc-by-motahar' ),
                    '5' => __( '5 Slides', 'ebc-by-motahar' ),
                    '6' => __( '6 Slides', 'ebc-by-motahar' ),
                ],
                'default' => '4',
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
            'carousel_item_margin',
            [
                'label' => __( 'Margin', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-slick-item' => 'margin: {{SIZE}}{{UNIT}};',
                ],
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

    }



    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'ebc-slick-slider ebc-carousel' );

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        ?>

        <div class="ebc-slider ">
            <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
                <?php foreach ( $settings['slides'] as $slide ) :
                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                    if ( ! $image ) {
                        $image = $slide['image']['url'];
                    } ?>
                    <div class="ebc-slick-item ">
                        <?php if($image) : ?>
                            <img src="<?php echo esc_url( $image ); ?>" />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        
        <?php 
    }


}