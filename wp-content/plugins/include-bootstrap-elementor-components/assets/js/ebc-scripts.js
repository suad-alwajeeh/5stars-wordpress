// EBC custom js
(function ($) {
    "use strict";

    //Elementor JS Hooks
    $(window).on('elementor/frontend/init', function () {

        /**
         * Initialize tooltip
         *
         * @since 1.1.2
         */
        var EbcTooltip = function ($scope, $) {
            var Tooltip = $scope.find('.ebc-tooltip-container').each(function (i) {
                $('[data-toggle="tooltip"]').tooltip();
            });
        };

        /**
         * Initialize Toast
         *
         * @since 1.1.2
         */
        var EbcToast = function ($scope, $) {
            var Toast = $scope.find('.ebc-toast').each(function (i) {
                $('.toast').toast('show');
            });
        };

        elementorFrontend.hooks.addAction('frontend/element_ready/global', EbcTooltip);
        elementorFrontend.hooks.addAction('frontend/element_ready/global', EbcToast);

        /**
         * Initialize slider
         *
         * @since 1.0.0
        */

        var ebcSlick = elementorModules.frontend.handlers.Base.extend({
            onInit: function () {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.$container = this.$element.find('.ebc-slick-slider');
                this.run();
            },

            isCarousel: function () {
                return this.$element.hasClass('elementor-widget-ebc-carousel');
            },

            isblogCarousel: function () {
                return this.$element.hasClass('elementor-widget-ebc-blogcarousel');
            },

            getDefaultSettings: function () {
                return {
                    arrows: true,
                    dots: false,
                    checkVisible: true,
                    slidesToShow: (this.isCarousel() || this.isblogCarousel()) ? 3 : 1,
                    infinite: true,
                    rows: 0,
                    prevArrow: '<button type="button" class="ebc-slick-btn ebc-slick-prev"><</button>',
                    nextArrow: '<button type="button" class="ebc-slick-btn ebc-slick-next">></button>',
                }
            },

            onElementChange: function () {
                this.$container.slick('unslick');
                this.run();
            },

            getReadySettings: function () {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('animation_speed'),
                    centerMode: !!this.getElementSettings('center'),
                };

                switch (this.getElementSettings('navigation')) {
                    case 'arrow':
                        settings.arrows = true;
                        break;
                    case 'dots':
                        settings.dots = true;
                        break;
                    case 'both':
                        settings.arrows = true;
                        settings.dots = true;
                        break;
                }

                if (this.isCarousel() || this.isblogCarousel()) {
                    settings.slidesToShow = this.getElementSettings('ebc_carousels_to_show');
                    settings.responsive = [
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ];
                }

                return $.extend({}, this.getDefaultSettings(), settings);
            },

            run: function () {
                this.$container.slick(this.getReadySettings());
            }

        });

        var ebcSliderNavPhoto = elementorModules.frontend.handlers.Base.extend({
            onInit: function () {
                elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
                this.$mainSlideContainer = this.$element.find('.slider-products');
                this.$mainNavContainer = this.$element.find('.slider-nav');
                this.runsliderNavPhoto();
            },

            getReadyNavMainSlideSettings: function () {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('animation_speed'),
                    centerMode: !!this.getElementSettings('center'),
                    slidesToScroll: 1
                };
            },
            runsliderNavPhoto: function () {

                var numSlick = 0;
                this.$mainSlideContainer.each(function () {
                    numSlick++;
                    $(this).addClass('slider-' + numSlick).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        fade: true,
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 5000,
                        asNavFor: '.slider-nav.slider-' + numSlick
                    });
                });

                numSlick = 0;
                this.$mainNavContainer.each(function () {
                    numSlick++;
                    $(this).addClass('slider-' + numSlick).slick({
                        vertical: true,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        asNavFor: '.slider-products.slider-' + numSlick,
                        arrow: false,
                        focusOnSelect: true,
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 5000,
                        responsive: [
                            {
                                breakpoint: 800,
                                settings: {
                                    slidesToShow: 3,
                                }
                            }
                        ]
                    });

                });

            }

        });



        var ebcHandlersClassMap = {
            'ebc-slider.default': ebcSlick,
            'ebc-carousel.default': ebcSlick,
            'ebc-blogslider.default': ebcSlick,
            'ebc-blogcarousel.default': ebcSlick,
            'ebc-sliderNavPhoto.default': ebcSliderNavPhoto

        };

        $.each(ebcHandlersClassMap, function (widgetName, handlerClass) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope) {
                elementorFrontend.elementsHandler.addHandler(handlerClass, { $element: $scope });
            });
        });


    });




}(jQuery));