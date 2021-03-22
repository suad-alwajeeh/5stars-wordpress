<?php

namespace EBC\Widgets;

use Elementor\Core\Schemes;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Base;



if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * blog
 *
 * @since 1.0.0
 */

class EBC_BlogSlider extends Widget_Base
{

  /**
   * Get widget name.
   *
   * Retrieve blog widget name.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget name.
   */

  public function get_name()
  {
    return 'ebc-blogslider';
  }

  /**
   * Get widget title.
   *
   * Retrieve blog widget title.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget title.
   */

  public function get_title()
  {
    return __('Blog Posts Slider', 'ebc-by-motahar');
  }

  /**
   * Get widget icon.
   *
   * Retrieve blog widget icon.
   *
   * @since 1.0.0
   * @access public
   *
   * @return string Widget icon.
   */

  public function get_icon()
  {
    return 'fas fa-sliders-h';
  }

  /**
   * Get widget categories.
   *
   * Retrieve the list of categories the blog widget belongs to.
   *
   * @since 1.0.0
   * @access public
   *
   * @return array Widget categories.
   */

  public function get_categories()
  {
    return ['ebc_category'];
  }


  /**
   * Register blog widget controls.
   *
   * Adds different input fields to allow the user to change and customize the widget settings.
   *
   * @since 1.0.0
   * @access protected
   */

  protected function _register_controls()
  {

    $this->start_controls_section(
      'ebc_blog_section',
      [
        'label' => 'Blog Settings',
      ]
    );

    $this->add_control(
        'post_type',
        [
            'label' => __('Post Type', 'ebc-by-motahar'),
            'type' => Controls_Manager::SELECT,
            'options' => ebc_get_all_post_types(),
            'default' => 'post',
        ]
    );

    $this->add_control(
        'orderby',
        [
            'label' => __('Order By', 'ebc-by-motahar'),
            'type' => Controls_Manager::SELECT,
            'options' => ebc_get_post_orderby_options(),
            'default' => 'date',

        ]
    );

    $this->add_control(
        'order',
        [
            'label' => __('Order', 'ebc-by-motahar'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'asc' => 'Ascending',
                'desc' => 'Descending',
            ],
            'default' => 'desc',

        ]
    );

    $this->add_control(
        'offset',
        [
            'label' => __('Offset( Exclude )', 'ebc-by-motahar'),
            'type' => Controls_Manager::NUMBER,
            'default' => '0',
        ]
    );

    $this->add_control(
        'exclude',
        [
            'label' => __('Exclude ( Title )', 'ebc-by-motahar'),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => ebc_get_all_types_post(),
            'default' => '',
        ]
    );

    $this->add_control( 
        'blog_posts_categories',
        [
            'label' => esc_attr__( 'Blog Categories', 'ebc-by-motahar' ),
            'label_block' => true,
            'type' => \Elementor\Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => ebc_get_blog_categories(),
            'default' => 'all',
        ]
    );

	$this->add_control(
      'blog_post_count',
      [
        'label' => esc_attr__('Posts per widget', 'ebc-by-motahar'),
        'type' => Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 15,
        'step' => 1,
        'default' => 6,
      ]
    );


    $this->add_control(
      'excerpt_length',
      [
        'label' => esc_attr__('Excerpt Length', 'ebc-by-motahar'),
        'type' => Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 999,
        'step' => 1,
        'default' => 160,
      ]
    );

    $this->add_control(
      'readmore_link',
      [
        'label' => esc_attr__('Show Read More Link ?', 'ebc-by-motahar'),
        'type'  => Controls_Manager::SWITCHER,
        'label_on' => esc_attr__('Show', 'ebc-by-motahar'),
        'label_off' => esc_attr__('Hide', 'ebc-by-motahar'),
        'return_value' => 'yes',
        'default' => 'yes',
      ]
	);
	
	$this->add_control(
      'excerpt_readmore',
      [
        'label' => esc_attr__('Read More Text', 'ebc-by-motahar'),
		'type'  => Controls_Manager::TEXT,
		'condition' => [
			'readmore_link' => 'yes'
		],
        'default' => 'Read More'
      ]
    );

    $this->end_controls_section();


    $this->start_controls_section(
            '_blogslider_slick_settings',
            [
                'label' => __( 'Slider Settings', 'ebc-by-motahar' ),
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
            'navigation',
            [
                'label' => __( 'Navigation', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'ebc-by-motahar' ),
                    'arrow' => __( 'Arrow', 'ebc-by-motahar' ),
                    'dots' => __( 'Dots', 'ebc-by-motahar' ),
                    'both' => __( 'Arrow & Dots', 'ebc-by-motahar' ),
                ],
                'default' => 'arrow',
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


  


  /**
   * Render blog widget output on the frontend.
   *
   * Written in PHP and used to generate the final HTML.
   *
   * @since 1.0.0
   * @access protected
   */

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    $this->add_render_attribute('wrapper', 'class', 'ebc-blog-wrapper');
    $this->add_render_attribute('ebc_slider_wrapper', 'class', 'ebc-slick-slider');

?>

    <div <?php echo $this->get_render_attribute_string('wrapper'); ?> style="text-align: <?php echo $settings['blog_content_alingment']; ?>">
      <?php include (EBC_DIR . 'template-parts/blog-slider.php'); ?>
    </div>

<?php }
}
