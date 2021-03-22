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
 * 
 */

class EBC_Jumbotron extends Widget_Base { 

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
        return 'ebc-jumbotron';
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
        return __( 'Jumbotron', 'ebc-by-motahar' );
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
        return 'fa fa-fire';
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

    protected function _register_controls() { 

        $this->start_controls_section(
            'ebc_jumbotron_section',
            [
              'label' => 'Settings',
            ]
        );

        $this->add_control(
            'jumbotron_title',
            [
              'label' => 'Title',
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => 'Hello, world!'
            ]
        );

        $this->add_control(
            'jumbotron_lead',
            [
              'label' => 'Lead',
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.'
            ]
        );

        $this->add_control(
            'jumbotron_content',
            [
              'label' => 'Content',
              'type' => \Elementor\Controls_Manager::WYSIWYG,
              'default' => 'This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.'
            ]
        );

        $this->add_control(
            'jumbotron_button',
            [
              'label' => 'Content',
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => 'Learn More'
            ]
        );

        $this->add_control(
            'jumbotron_url',
            [
                'label' => 'Url',
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

        $this->add_control(
            'jumbotron_button_type',
            [
              'label' => 'Button Type',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_jumbotron_style_section',
            [
                'label' => __( 'Jumbotron Style', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'jumbotron_background_color',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'default' => '#fff',
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron' => 'background-color: {{VALUE}};',
              ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border-control',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-jumbotron',
            ]
        );

        $this->add_control(
            'jumbotron_border_radius',
            [
              'label' => __( 'Border Radius', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                '%' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-widget-container' => 'border-radius: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .ebc-jumbotron' => 'border-radius: {{SIZE}}{{UNIT}};',
              ],
            ]
        );

        $this->add_control(
            'jumbtron_padding_y',
            [
              'label' => __( 'Padding Y', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                '%' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .jumbotron' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
              ],
            ]
        );

        $this->add_control(
            'jumbtron_padding_x',
            [
              'label' => __( 'Padding X', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                '%' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .jumbotron' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
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

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_title_style_section',
            [
                'label' => __( 'Title', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_text_color',
            [
              'label' => __( 'Title Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-title' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_text_typo',
                'selector' => '{{WRAPPER}} .ebc-jumbotron-title',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_lead_style_section',
            [
                'label' => __( 'Lead', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'lead_text_color',
            [
              'label' => __( 'Lead Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-lead' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'lead_text_typo',
                'selector' => '{{WRAPPER}} .ebc-jumbotron-lead',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'ebc_content_style_section',
            [
                'label' => __( 'Content', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_text_color',
            [
              'label' => __( 'Content Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-content' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_text_typo',
                'selector' => '{{WRAPPER}} .ebc-jumbotron-content',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'ebc_button_style_section',
            [
                'label' => __( 'Button', 'ebc-by-motahar' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_space_top',
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
                '{{WRAPPER}} .ebc-jumb-btn' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
              ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
              'label' => __( 'Text Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-button' => 'color: {{VALUE}};',
              ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
              'label' => __( 'Background Color', 'ebc-by-motahar' ),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-button' => 'background-color: {{VALUE}};',
              ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'jumb-btn-border',
                'label' => __('Border', 'ebc-by-motahar'),
                'selector' => '{{WRAPPER}} .ebc-jumbotron-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
              'label' => __( 'Border Radius', 'ebc-by-motahar' ),
              'type' => Controls_Manager::SLIDER,
              'range' => [
                '%' => [
                  'min' => 0,
                  'max' => 100,
                ],
              ],
              'selectors' => [
                '{{WRAPPER}} .ebc-jumbotron-button' => 'border-radius: {{SIZE}}{{UNIT}};',
              ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typo',
                'selector' => '{{WRAPPER}} .ebc-jumbotron-content p',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();



    }

    protected function render() { 
        $settings = $this->get_settings_for_display();
        $target = $settings['jumbotron_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['jumbotron_url']['nofollow'] ? ' rel="nofollow"' : '';
        
        $this->add_render_attribute( 'jumbotron_style', 'class', 'ebc-jumbotron jumbotron' );

        $this->add_render_attribute( 'jumbotron_title_style', 'class', 'ebc-jumbotron-title display-4' );

        $this->add_render_attribute( 'jumbotron_lead_style', 'class', 'ebc-jumbotron-lead lead' );

        $this->add_render_attribute( 'jumbotron_content_style', 'class', 'ebc-jumbotron-content' );

        $this->add_render_attribute( 'jumbotron_button_style', 'class', 'ebc-jumbotron-button btn-lg btn btn-'. $settings['jumbotron_button_type'] );
        
        ?>
        <div class="ebc-widget-container">
            <div <?php echo $this->get_render_attribute_string( 'jumbotron_style' ); ?>> 
                <h1 <?php echo $this->get_render_attribute_string( 'jumbotron_title_style' ); ?>><?php echo $settings['jumbotron_title']; ?></h1>
                <p <?php echo $this->get_render_attribute_string( 'jumbotron_lead_style' ); ?>><?php echo $settings['jumbotron_lead']; ?></p>
                <hr class="my-4">
                <span <?php echo $this->get_render_attribute_string( 'jumbotron_content_style' ); ?>>
                    <?php echo $settings['jumbotron_content']; ?>
                </span>
                <p class="lead ebc-jumb-btn mt-3">
                    <a <?php echo $this->get_render_attribute_string( 'jumbotron_button_style' ); ?> href="<?php echo $settings['jumbotron_url']['url']; ?>" <?php echo $target; ?> role="button">
                        <?php echo $settings['jumbotron_button']; ?>
                    </a>
                </p>
            </div>
        </div>

    <?php

    }

    protected function _content_template() { ?>
        <#
            view.addRenderAttribute( {
                jumbotron_style: { class: 'ebc-jumbotron jumbotron' },
                jumbotron_title: { class: 'ebc-jumbotron-title display-4' },
                jumbotron_lead: { class: 'ebc-jumbotron-lead lead' },
                jumbotron_content: { class: 'ebc-jumbotron-content' },
                jumbotron_button: { class: 'ebc-jumbotron-button' },
              } );
      
            view.addInlineEditingAttributes( 'jumbotron_title', 'none' );
            view.addInlineEditingAttributes( 'jumbotron_lead', 'none' );
            view.addInlineEditingAttributes( 'jumbotron_content', 'none' );

            var target = settings.jumbotron_url.is_external ? ' target="_blank"' : '';
		    var nofollow = settings.jumbotron_url.nofollow ? ' rel="nofollow"' : '';
        #>
            <div class="ebc-widget-container">
              <div {{{ view.getRenderAttributeString( 'jumbotron_style' ) }}}> 
                <h1 {{{ view.getRenderAttributeString( 'jumbotron_title' ) }}}>{{{ settings.jumbotron_title }}}</h1>
                <p {{{ view.getRenderAttributeString( 'jumbotron_lead' ) }}}>{{{ settings.jumbotron_lead }}}</p>
                <hr class="my-4">
                <span {{{ view.getRenderAttributeString( 'jumbotron_content' ) }}}>
                    {{{ settings.jumbotron_content }}}
                </span>
                
                <p class="lead mt-3">
                    <a class="ebc-jumbotron-button btn-lg btn btn-{{ settings.jumbotron_button_type }}" href="{{ settings.jumbotron_url.url }}" {{ target }}{{ nofollow }} role="button">
                        {{{ settings.jumbotron_button }}}
                    </a>
                </p>
            </div>
        </div>
        <?php
    }


}