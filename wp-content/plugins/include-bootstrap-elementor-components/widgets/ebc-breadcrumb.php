<?php

namespace EBC\Widgets;

use Elementor\Repeater;
use Elementor\Core\Schemes;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * breadcrumb
 *
 * @since 1.0.0
 */

class EBC_Breadcrumb extends Widget_Base { 

    /**
     * Get widget name.
     *
     * Retrieve breadcrumb widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'ebc-breadcrumb';
    }

    /**
     * Get widget title.
     *
     * Retrieve breadcrumb widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Breadcrumb', 'ebc-by-motahar' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve breadcrumb widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fa fa-pagelines';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the breadcrumb widget belongs to.
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
     * Register breadcrumb widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {

        $this->start_controls_section(
            '_ebc_section_breadcrumb',
            [
                'label' => __( 'Breadcrumbs', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'ebc_crumb_label',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Label', 'ebc-by-motahar' ),
                'placeholder' => __( 'Type title here', 'ebc-by-motahar' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'ebc_crumb_url',
            [
                'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ebc-by-motahar' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
            ]
        );

        $repeater->add_control(
            'ebc_crumb_active',
            [
                'label' => __( 'Is Current Page?', 'ebc-by-motahar' ),
				'type' =>   Controls_Manager::SWITCHER,
				'label_on' => __( 'True', 'ebc-by-motahar' ),
				'label_off' => __( 'False', 'ebc-by-motahar' ),
				'return_value' => 'active',
				'default' => '',
            ]
        );


        $this->add_control(
            'ebc_crumbs',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
					[
						'ebc_crumb_label' => __( 'Home', 'ebc-by-motahar' ),
                        'ebc_crumb_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_crumb_active' => __( '', 'ebc-by-motahar' ),
					],
					[
						'ebc_crumb_label' => __( 'About', 'ebc-by-motahar' ),
                        'ebc_crumb_url' => __( '#', 'ebc-by-motahar' ),
                        'ebc_crumb_active' => __( '', 'ebc-by-motahar' ),
					],
				],
				'title_field' => '{{{ ebc_crumb_label }}}',
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
                '{{WRAPPER}} .breadcrumb' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Label Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .breadcrumb li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => __( 'Seperator Color', 'ebc-by-motahar' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                '{{WRAPPER}} .breadcrumb .breadcrumb-item+.breadcrumb-item::before' => 'color: {{VALUE}};',
                '{{WRAPPER}} .breadcrumb .breadcrumb-item.active' => 'color: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
              'name' => 'breadcrumb_content',
              'selector' => '{{WRAPPER}} .breadcrumb',
              'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );
      

       $this->end_controls_section();


    }



    /**
     * Render breadcrumb widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() { 
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'wrapper', 'class', 'ebc-widget-container ebc-breadcrumb' );

        if ( $settings['ebc_crumbs'] ) {
        ?>

        <div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php foreach (  $settings['ebc_crumbs'] as $crumb ) { 
                        $target = $crumb['ebc_crumb_url']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $crumb['ebc_crumb_url']['nofollow'] ? ' rel="nofollow"' : '';
                        if ( 'active' === $crumb['ebc_crumb_active'] ) {
                        ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $crumb['ebc_crumb_label'] ?></li>
                        <?php } else { ?>
                            <li class="breadcrumb-item"><a href="<?php echo $crumb['ebc_crumb_url']['url']; ?>" <?php echo $target; echo $nofollow ?>><?php echo $crumb['ebc_crumb_label'] ?></a></li>
                    <?php } 
                    }
                ?>
                </ol>
            </nav>
        </div>

        <?php }
    
    }




 }