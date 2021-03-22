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

class EBC_BlogFrameAnimate extends Widget_Base
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
    return 'ebc-blogframeanimate';
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
    return __('Blog Frame Animate', 'ebc-by-motahar');
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
    return 'fa fa-newspaper-o';
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
          '{{WRAPPER}} .ebc-blog-wrapper figure' => 'border-radius: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .ebc-blog-wrapper figure img' => 'border-radius: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .ebc-blog-wrapper figure .ebc-post-content' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'blog-image-border',
        'label' => __('Border', 'ebc-by-motahar'),
        'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure',
        'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure img',
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
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure',
            'selector' => '{{WRAPPER}} .ebc-blog-wrapper figure img',
          ]
	);
	
	$this->end_controls_section();

    $this->start_controls_section(
      'blog_posts_each_post',
      [
        'label' => __('Frame Container', 'ebc-by-motahar'),
        'tab' => Controls_Manager::TAB_STYLE,
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
        'default' => 0.4
      ]
    );

    $this->add_control(
      'border_color',
      [
        'label' => __('Border Color', 'ebc-by-motahar'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper figcaption::before' => 'border-color: {{VALUE}};',
          '{{WRAPPER}} .ebc-blog-wrapper figcaption::after' => 'border-color: {{VALUE}};',
        ],
      ]
    ); 

    $this->add_control(
      'border-width',
      [
        'label' => __('Border Width', 'ebc-by-motahar'),
        'type' => Controls_Manager::SLIDER,
        'range' => [
          'px' => [
            'min' => 0,
            'max' => 100,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper figcaption::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
          '{{WRAPPER}} .ebc-blog-wrapper figcaption::after' => 'border-left-width: {{SIZE}}{{UNIT}}; border-right-width: {{SIZE}}{{UNIT}};',
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
            'max' => 200,
          ],
        ],
        'selectors' => [
          '{{WRAPPER}} .ebc-blog-wrapper .ebc-post-content' => 'top: {{SIZE}}{{UNIT}};',
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

    $this->add_render_attribute('wrapper', 'class', 'ebc-blog-wrapper ebc-blogframeanimate');

?>

    <div <?php echo $this->get_render_attribute_string('wrapper'); ?> style="text-align: <?php echo $settings['blog_content_alingment']; ?>">
      <?php 
        if($settings['blog_column_count'] === 'three') {
            include (EBC_DIR . 'template-parts/blogframeanimate/three-column.php');  
        } else if($settings['blog_column_count'] === 'four') { 
            include (EBC_DIR . 'template-parts/blogframeanimate/four-column.php');
        } else {
            include (EBC_DIR . 'template-parts/blogframeanimate/two-column.php'); 
        }
       
       ?>
    </div>

<?php }
}
