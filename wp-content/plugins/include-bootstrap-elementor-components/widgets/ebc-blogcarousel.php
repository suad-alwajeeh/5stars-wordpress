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

class EBC_BlogCarousel extends Widget_Base
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
    return 'ebc-blogcarousel';
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
    return __('Blog Carousel', 'ebc-by-motahar');
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
    return 'fa fa-columns';
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
    /**
     * Query Controls!
     */


    $this->start_controls_section(
      'ebc_blog_section',
      [
        'label' => 'Blog Settings',
      ]
    );

    $this->add_control(
      'blog_post_heading',
      [
        'label' => esc_attr__('Heading', 'ebc-by-motahar'),
		'type'  => Controls_Manager::TEXT,
        'default' => esc_attr__('Recent Posts', 'ebc-by-motahar')
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
            'ebc_carousels_to_show',
            [
                'label' => __( 'Slides To Show', 'ebc-by-motahar' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __( '1 Slides', 'ebc-by-motahar' ),
                    '2' => __( '2 Slides', 'ebc-by-motahar' ),
                    '3' => __( '3 Slides', 'ebc-by-motahar' ),
                    '4' => __( '4 Slides', 'ebc-by-motahar' ),
                    '5' => __( '5 Slides', 'ebc-by-motahar' ),
                ],
                'default' => '3',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'blog_posts_heading',
                [
                    'label' => __('Heading', 'ebc-by-motahar'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
        );

        $this->add_control(
            'blog_posts_heading_text_color',
                [
                    'label' => __('Text Color', 'ebc-by-motahar'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                    '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-posts-heading' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
                [
                    'name' => 'blog_posts_heading_text_color-typogph',
                    'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-posts-heading',
                    'scheme' => Schemes\Typography::TYPOGRAPHY_1,
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

        $this->add_control(
            'blog_content_alingment',
            [
                'label' => __('Text Alignment', 'ebc-by-motahar'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                'left' => [
                    'title' => __('Left', 'ebc-by-motahar'),
                    'icon' => 'fa fa-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'ebc-by-motahar'),
                    'icon' => 'fa fa-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'ebc-by-motahar'),
                    'icon' => 'fa fa-align-right',
                ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .ebc-blog-article',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'ebc-by-motahar' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .ebc-blog-article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'padding-width',
            [
                'label' => __('Padding', 'ebc-by-motahar'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                ],
                'selectors' => [
                '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'margin-width',
            [
                'label' => __('Margin', 'ebc-by-motahar'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                ],
                'selectors' => [
                '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-margin' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
          \Elementor\Group_Control_Box_Shadow::get_type(),
          [
            'name' => 'image_box_shadow',
            'label' => __( 'Box Shadow', 'ebc-by-motahar' ),
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article',
          ]
	    );

        $this->end_controls_section();


        $this->start_controls_section(
            'blog_post_title_section',
            [
                'label' => __('Post Title', 'ebc-by-motahar'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );

        $this->add_control(
                'blog-title-space-top',
                [
                    'label' => __('Space Top', 'ebc-by-motahar'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            ],
                        ],
                    'selectors' => [
                            '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-blog-title h1' => 'padding-top: {{SIZE}}{{UNIT}};',
                        ],
                ]
            );

        $this->add_control(
                'blog-title-text-color',
                [
                    'label' => __('Text Color', 'ebc-by-motahar'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                            '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-blog-title a' => 'text-decoration: none;',
                            '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-blog-title a h1' => 'color: {{VALUE}};',
                        ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                    [
                        'name' => 'blog-title-typogph',
                        'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-blog-title a h1',
                        'scheme' => Schemes\Typography::TYPOGRAPHY_1,
                    ]
            );

            $this->end_controls_section();

            $this->start_controls_section(
            'blog_post_centent_section',
            [
                'label' => __('Post Excerpt', 'ebc-by-motahar'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
            );

            $this->add_control(
                'blog-excert-space-top',
                [
                    'label' => __('Space top', 'ebc-by-motahar'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            ],
                        ],
                    'selectors' => [
                            '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-post-excerpt' => 'padding-top: {{SIZE}}{{UNIT}};',
                        ],
                ]
            );

            $this->add_control(
                'blog-content-text-color',
                [
                    'label' => __('Text Color', 'ebc-by-motahar'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-post-excerpt p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'blog-readmore-text-color',
                [
                    'label' => __('Read More Color', 'ebc-by-motahar'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-post-excerpt .ebc-link-readmore' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                    [
                        'name' => 'blog-content-typogph',
                        'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-article .ebc-post-excerpt p',
                        'scheme' => Schemes\Typography::TYPOGRAPHY_1,
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

    $this->add_render_attribute('wrapper', 'class', 'ebc-blog-wrapper ebc-slider ebc-blogcarousel');
    $this->add_render_attribute('ebc_slider_wrapper', 'class', 'ebc-slick-slider');

?>

    <div <?php echo $this->get_render_attribute_string('wrapper'); ?> style="text-align: <?php echo $settings['blog_content_alingment']; ?>">
      <?php include (EBC_DIR . 'template-parts/blogcarousel/three-column.php'); ?>
    </div>

<?php }
}
