<?php

namespace EBC\Widgets;

use Elementor\Core\Schemes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Base;



if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * blog
 *
 * @since 1.0.0
 */

class EBC_BlogTextOverley extends Widget_Base
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
    return 'ebc-blogtextoverley';
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
    return __('Blog Text Overlay', 'ebc-by-motahar');
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
    return 'fab fa-blogger';
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
        'label' => 'Settings',
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

    $this->add_control (
        'blog_column_count',
        [
            'label' => __( 'Columns', 'ebc-by-motahar' ),
            'type' => \Elementor\Controls_Manager::SELECT, 
            'default' => 'two',
            'options' => [
                'two'  => __( 'Two', 'ebc-by-motahar' ),
                'three' => __( 'Three', 'ebc-by-motahar' ),
                'four' => __( 'Four', 'ebc-by-motahar' ),
            ],
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
        'default' => 4,
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

    $this->add_control(
        'see_all_post_btn',
        [
            'label' => esc_attr__('Show See All Button ?', 'ebc-by-motahar'),
            'type'  => Controls_Manager::SWITCHER,
            'label_on' => esc_attr__('Show', 'ebc-by-motahar'),
            'label_off' => esc_attr__('Hide', 'ebc-by-motahar'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]
	);

    $this->add_control(
      'blog_post_read_all_button',
      [
        'label' => esc_attr__('See All Button', 'ebc-by-motahar'),
        'type'  => Controls_Manager::TEXT,
        'condition' => [
			'see_all_post_btn' => 'yes'
		],
        'default' => esc_attr__('See All', 'ebc-by-motahar')
      ]
    );

    $this->add_control(
      'blog_post_read_all_button_url',
      [
        'label' => esc_attr__('See All Link', 'ebc-by-motahar'),
        'type'  => Controls_Manager::URL,
        'condition' => [
			'see_all_post_btn' => 'yes'
		],
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
      'section_title',
      [
        'label' => __('Image', 'ebc-by-motahar'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'image-border-radius',
      [
        'label' => __('Border Radius', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10' => 'border-radius: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10 img' => 'border-radius: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10 .ebc-post-content' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'blog-image-border',
        'label' => __('Border', 'ebc-by-motahar'),
        'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10',
        'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10 img',
      ]
    );

    $this->add_group_control(
          \Elementor\Group_Control_Box_Shadow::get_type(),
          [
            'name' => 'image_box_shadow',
            'label' => __( 'Box Shadow', 'ebc-by-motahar' ),
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10',
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure.ebc-modern-hover-10 img',
          ]
	);
	
	$this->end_controls_section();

    $this->start_controls_section(
      'blog_posts_each_post',
      [
        'label' => __('Overlay Container', 'ebc-by-motahar'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'background',
      [
        'label' => __('Overlay Background Color', 'ebc-by-motahar'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'transtion-time',
      [
        'label' => esc_attr__('Transition Time', 'ebc-by-motahar'),
        'type' => Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 10,
        'step' => 1,
        'default' => 1.4
      ]
    );

    $this->add_control (
        'transtion-type',
        [
            'label' => __( 'Transition Type', 'ebc-by-motahar' ),
            'type' => \Elementor\Controls_Manager::SELECT, 
            'default' => 'cubic-bezier(0.18, 0.89, 0.32, 1.28)',
            'options' => [
                'ease'  => __( 'Ease', 'ebc-by-motahar' ),
                'ease-in' => __( 'Ease-in', 'ebc-by-motahar' ),
                'ease-out' => __( 'Ease-out', 'ebc-by-motahar' ),
                'ease-in-out' => __( 'Ease-in-out', 'ebc-by-motahar' ),
                'linear' => __( 'Linear', 'ebc-by-motahar' ),
                'cubic-bezier(0.45, 0.05, 0.55, 0.95)' => __( 'In Out · Sine', 'ebc-by-motahar' ),
                'cubic-bezier(0.46, 0.03, 0.52, 0.96)' => __( 'In Out · Quadratic', 'ebc-by-motahar' ),
                'cubic-bezier(0.65, 0.05, 0.36, 1)' => __( 'In Out · Cubic', 'ebc-by-motahar' ),
                'cubic-bezier(0.4, 0, 0.2, 1)' => __( 'Fast Out, Slow In', 'ebc-by-motahar' ),
                'cubic-bezier(0.68, -0.55, 0.27, 1.55)' => __( 'In Out · Back', 'ebc-by-motahar' ),
                'cubic-bezier(0.4, 0, 1, 1)' => __( 'Fast Out, Linear In', 'ebc-by-motahar' ),
                'cubic-bezier(0.47, 0, 0.75, 0.72)' => __( 'In · Sine', 'ebc-by-motahar' ),
                'cubic-bezier(0.55, 0.09, 0.68, 0.53)' => __( 'In · Quadratic', 'ebc-by-motahar' ),
                'cubic-bezier(0.55, 0.06, 0.68, 0.19)' => __( 'In · Cubic', 'ebc-by-motahar' ),
                'cubic-bezier(0.6, -0.28, 0.74, 0.05)' => __( 'In · Back', 'ebc-by-motahar' ),
                'cubic-bezier(0.39, 0.58, 0.57, 1)' => __( 'Out · Sine', 'ebc-by-motahar' ),
                'cubic-bezier(0.25, 0.46, 0.45, 0.94)' => __( 'Out · Quadratic', 'ebc-by-motahar' ),
                'cubic-bezier(0.22, 0.61, 0.36, 1)' => __( 'Out · Cubic', 'ebc-by-motahar' ),
                'cubic-bezier(0, 0, 0.2, 1)' => __( 'Linear Out, Slow In', 'ebc-by-motahar' ),
                'cubic-bezier(0.18, 0.89, 0.32, 1.28)' => __( 'Out · Back', 'ebc-by-motahar' ),
                
            ],
        ]
    );

    $this->add_control(
      'border_color',
      [
        'label' => __('Border Color', 'ebc-by-motahar'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'border-color: {{VALUE}};',
        ],
      ]
    ); 

    $this->add_control(
      'border_left-width',
      [
        'label' => __('Left Border Width', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'border-left-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'border_right-width',
      [
        'label' => __('Right Border Width', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'border-right-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'border_top-width',
      [
        'label' => __('Top Border Width', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'border-top-width: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'border_bottom-width',
      [
        'label' => __('Bottom Border Width', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
        ],
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
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'padding: {{SIZE}}{{UNIT}};',
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
			'label' => __('Space Bottom', 'ebc-by-motahar'),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 200,
					],
				],
			'selectors' => [
					'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
		]
	);

    $this->add_control(
		'blog-title-space-bottom',
		[
			'label' => __('Space Bottom', 'ebc-by-motahar'),
			'type' => Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 100,
					],
				],
			'selectors' => [
					'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-blog-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
		]
	);

	$this->add_control(
      	'blog-title-text-color',
		[
			'label' => __('Text Color', 'ebc-by-motahar'),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
					'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-blog-title a' => 'text-decoration: none;',
					'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-blog-title a h1' => 'color: {{VALUE}};',
				],
      	]
	);
	
	$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'blog-title-typogph',
				'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-blog-title a h1',
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
      	'blog-content-text-color',
		[
			'label' => __('Text Color', 'ebc-by-motahar'),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-post-excerpt p' => 'color: {{VALUE}};',
			],
      	]
	);

	$this->add_control(
      	'blog-readmore-text-color',
		[
			'label' => __('Read More Color', 'ebc-by-motahar'),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-post-excerpt .ebc-link-readmore' => 'color: {{VALUE}};',
			],
      	]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'blog-content-typogph',
				'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content .ebc-post-excerpt p',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
			]
	);

    $this->end_controls_section();
    
    $this->start_controls_section(
      'blog_posts_see_all_style',
      [
        'label' => __('See All Button', 'ebc-by-motahar'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'blog_posts_see_all_text_color',
      [
        'label' => __('Text Color', 'ebc-by-motahar'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button a' => 'color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'blog_posts_see_all_btn_bg',
      [
        'label' => __('Background Color', 'ebc-by-motahar'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button' => 'background-color: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'blog_posts_see_all_btn-border-radius',
      [
        'label' => __('Border Radius', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'blog_posts_see_all_btn-border',
        'label' => __('Border Type', 'ebc-by-motahar'),
        'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button',
      ]
    );

    $this->add_group_control(
          \Elementor\Group_Control_Box_Shadow::get_type(),
          [
            'name' => 'blog_posts_see_all_box_shadow',
            'label' => __( 'Box Shadow', 'ebc-by-motahar' ),
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button',
          ]
	);


    $this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'blog_posts_see_all_btn_style-typogph',
				'selector' => '{{WRAPPER}} .ebc-blog-wrapper .ebc-blog-foot button a',
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

    $this->add_render_attribute('wrapper', 'class', 'ebc-blog-wrapper ebc-blogtextoverley');

?>

    <div <?php echo $this->get_render_attribute_string('wrapper'); ?> style="text-align: <?php echo $settings['blog_content_alingment']; ?>">
      <?php 
        if($settings['blog_column_count'] === 'three') {
            include (EBC_DIR . 'template-parts/blogtextoverley/three-column.php');  
        } else if($settings['blog_column_count'] === 'four') { 
            include (EBC_DIR . 'template-parts/blogtextoverley/four-column.php');
        } else {
            include (EBC_DIR . 'template-parts/blogtextoverley/two-column.php'); 
        }
       
       ?>
    </div>

<?php }
}
