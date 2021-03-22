<?php

namespace EBC\Widgets;

use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * pagination
 *
 * @since 1.0.0
 */

class EBC_Pagination extends Widget_Base { 

    /**
     * Get widget name.
     *
     * Retrieve pagination widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-pagination';
    }

    /**
     * Get widget title.
     *
     * Retrieve pagination widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Pagination', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve pagination widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fas fa-blind';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the pagination widget belongs to.
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
     * Register pagination widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {

        $this->start_controls_section(
            '_ebc_section_pagination',
            [
                'label' => __( 'paginations', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ebc_paginate_label',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Number', 'ebc-by-motahar' ),
                'placeholder' => __( 'Type title here', 'ebc-by-motahar' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'ebc_paginate_url',
            [
                'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ebc-by-motahar' ),
				'show_external' => false,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
            ]
        );

        $repeater->add_control(
            'ebc_paginate_active',
            [
                'label' => __( 'Is Current Page?', 'ebc-by-motahar' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'True', 'ebc-by-motahar' ),
				'label_off' => __( 'False', 'ebc-by-motahar' ),
				'return_value' => 'active',
				'default' => '',
            ]
        );


        $this->add_control(
            'ebc_paginates',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
					[
						'ebc_paginate_label' => __( '1', 'ebc-by-motahar' ),
                        'ebc_paginate_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_paginate_active' => __( '', 'ebc-by-motahar' ),
					],
					[
						'ebc_paginate_label' => __( '2', 'ebc-by-motahar' ),
                        'ebc_paginate_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_paginate_active' => __( '', 'ebc-by-motahar' ),
                    ],
                    [
						'ebc_paginate_label' => __( '3', 'ebc-by-motahar' ),
                        'ebc_paginate_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_paginate_active' => __( '', 'ebc-by-motahar' ),
                    ],
                    [
						'ebc_paginate_label' => __( '4', 'ebc-by-motahar' ),
                        'ebc_paginate_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_paginate_active' => __( '', 'ebc-by-motahar' ),
                    ],
                    [
						'ebc_paginate_label' => __( '5', 'ebc-by-motahar' ),
                        'ebc_paginate_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_paginate_active' => __( '', 'ebc-by-motahar' ),
					],
				],
				'title_field' => '{{{ ebc_paginate_label }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_type',
            [
              'label' => __( 'Styling', 'ebc-by-motahar' ),
              'tab' => Controls_Manager::TAB_STYLE,
            ]
          );
      
        $this->add_control(
            'background',
            [
                'label' => __( 'Background Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .pagination .page-item a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Label Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .pagination li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'current_page_bg_color',
            [
                'label' => __( 'Active Background Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .page-item.disabled .page-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'current_page_text_color',
            [
                'label' => __( 'Active Text Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .page-item.disabled .page-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .page-item .page-link' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'ebc_pagination_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .page-item:first-child .page-link' => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-bottom-left-radius: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .page-item:last-child .page-link' => 'border-top-right-radius: {{SIZE}}{{UNIT}};border-bottom-right-radius: {{SIZE}}{{UNIT}}',
				]
				
			]
        );

        $this->add_control(
			'ebc_pagination_padding_x',
			[
				'label' => __( 'Padding Left+Right', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
                    'unit' => 'px',
                    'size' => 15,
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .page-item .page-link' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}', 
				]
				
			]
        );

        $this->add_control(
			'ebc_pagination_padding_y',
			[
				'label' => __( 'Padding Top+Bottom', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
                    'unit' => 'px',
                    'size' => 10,
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
                    '{{WRAPPER}} .page-item .page-link' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}', 
				]
				
			]
        );
        
        $this->add_control(
            'pagination_alingment',
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
              'default' => 'center',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'pagination_content',
              'selector' => '{{WRAPPER}} .pagination',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );
      

       $this->end_controls_section();


    }



    /**
     * Render pagination widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() { 
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'ebc-pagination' );

        if ( $settings['ebc_paginates'] ) {
        ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <nav aria-label="Page navigation example">
                <ul class="pagination " style="justify-content: <?php echo $settings['pagination_alingment']; ?>">
                <?php foreach (  $settings['ebc_paginates'] as $page ) { 
                        $target = $page['ebc_paginate_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $page['ebc_paginate_url']['nofollow'] ? ' rel="nofollow"' : '';
                        if ( 'active' === $page['ebc_paginate_active'] ) {
                    ?>
                        <li class="ebc-widget-container page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><?php echo $page['ebc_paginate_label'] ?></a>
                        </li>
                        <?php } else { ?>
                            <li class="ebc-widget-container page-item">
                                <a class="page-link" href="<?php echo $page['ebc_paginate_url']['url']; ?>" <?php echo $target; echo $nofollow ?>><?php echo $page['ebc_paginate_label'] ?></a>
                            </li>
                    <?php } 
                    }
                ?>
                </ul>
            </nav>
        </div>

        <?php }
    
    }




 }