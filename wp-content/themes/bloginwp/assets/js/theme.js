/**
 * Main theme scripts
 * 
 * @package Bloginwp
 * @since 1.0.0
 * 
 */
jQuery(document).ready(function($) {
    const slideArrow = {
      nextArrow: `<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>`,
      prevArrow: `<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>`,
    };
    const slideArrowText = {
      nextArrow: `<button type="button" class="slick-next">Next</i></button>`,
      prevArrow: `<button type="button" class="slick-prev">Prev</button>`,
    };
    let isOpened = false;
    let $searchBox = $("#search-box");
    $("#search").on("click", function (e) {
      e.preventDefault();
      if (!isOpened) {
        $searchBox.slideDown();
        $searchBox.find( "input[name='s']" ).focus()
        isOpened = true;
        $(this).addClass("active");
      } else {
        $searchBox.slideUp();
        isOpened = false;
        $(this).removeClass("active");
      }
    });
    clickOutSideElm($(".search__icon-group"), function () {
      $searchBox.slideUp();
      isOpened = false;
      $("#search").removeClass("active");
    });

    function clickOutSideElm(elm, callback) {
      $(document).mouseup(function (e) {
        var container = $(elm);
        if (!container.is(e.target) && container.has(e.target).length === 0) {
          callback();
        }
      });
    }

    /**
     * Masonry Layout
     */
    let $masonry = $(".blog-masonry").masonry({
      itemSelector: ".post-card",
      horizontalOrder: true,
      gutter: 30,
    });
    $masonry.imagesLoaded().progress(function () {
      $masonry.masonry("layout");
    });

    // featured links carousel
    var featuredSection = $( "#bloginwp-featured-section" )
    if( featuredSection.length > 0 ) {
      var column, arrows = featuredSection.data( "arrows" )
      if( featuredSection.data( "column" ) == 'four' ) { column = 4 } else if( featuredSection.data( "column" ) == 'three' ) { column = 3 } else { column = 2 }
      var auto = featuredSection.data( "auto" )
      var featuredItems = featuredSection.find( ".categories-wrap" )
      featuredItems.slick(Object.assign({
          dots: false,
          arrows: arrows,
          autoplay: auto,
          slidesToShow: column,
          responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 2,
                },
              },
              {
                breakpoint: 768,
                settings: {
                  slidesToShow: 1,
                },
              },
            ],
        }, slideArrow));
    }

    // banner slider layout one
    $(".blog-ocean__slider.layout-one").each(function() {
      var _this = $(this),
      loop = ( _this.data( "loop" ) == 1 ),
      controls = ( _this.data( "controls" ) == 1 ),
      dots = ( _this.data( "dots" ) == 1 ),
      auto = ( _this.data( "auto" ) == 1 ),
      fade = ( _this.data( "fade" ) == 1 );
      speed = _this.data( "speed" );
      const bannerOneSlide = _this.slick(Object.assign({
        dots: dots,
        infinite: loop,
        fade: fade,
        speed: speed,
        arrows: controls,
        autoplay: auto
      }, slideArrowText));

      _this.on( "click", ".banner-next-post", function() {
        bannerOneSlide.slick('slickNext')
      })
    })

    // banner slider layout four
    $(".blog-ocean__slider.layout-four").each(function() {
      var _this = $(this);
      loop = ( _this.data( "loop" ) == 1 ),
      controls = ( _this.data( "controls" ) == 1 ),
      dots = ( _this.data( "dots" ) == 1 ),
      auto = ( _this.data( "auto" ) == 1 ),
      fade = ( _this.data( "fade" ) == 1 );
      speed = _this.data( "speed" );
      _this.slick(Object.assign({
        dots: dots,
        infinite: loop,
        fade: fade,
        speed: speed,
        arrows: controls,
        autoplay: auto,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: '200px',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '70px',
              slidesToShow: 1
            }
          },
          {
            breakpoint: 525,
            settings: {
              arrows: false,
              centerMode: true,
              centerPadding: '10px',
              slidesToShow: 1
            }
          }
        ]
      }, slideArrow));
    })

    // banner slider layout two
    $(".blog-flower__slide").each(function() {
      var _this = $(this),
      loop = ( _this.data( "loop" ) == 1 ),
      controls = ( _this.data( "controls" ) == 1 ),
      dots = ( _this.data( "dots" ) == 1 ),
      auto = ( _this.data( "auto" ) == 1 ),
      speed = _this.data( "speed" );
      _this.slick(
        Object.assign(
          {
            dots: dots,
            infinite: loop,
            speed: speed,
            arrows: controls,
            autoplay: auto,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 1,
                },
              },
            ],
          },
          slideArrow
        )
      );
    })

    $(".blog-food__slide").each(function() {
      var _this = $(this),
      loop = ( _this.data( "loop" ) == 1 ),
      controls = ( _this.data( "controls" ) == 1 ),
      dots = ( _this.data( "dots" ) == 1 ),
      auto = ( _this.data( "auto" ) == 1 ),
      speed = _this.data( "speed" );
      _this.slick(
        Object.assign(
          {
            dots: dots,
            infinite: loop,
            speed: speed,
            arrows: controls,
            autoplay: auto,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
              {
                breakpoint: 1200,
                settings: {
                  slidesToShow: 4,
                },
              },
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 2,
                },
              },
              {
                breakpoint: 695,
                settings: {
                  slidesToShow: 2,
                },
              },
              {
                breakpoint: 465,
                settings: {
                  slidesToShow: 1,
                },
              },
            ],
          },
          slideArrow
        )
      );
    });

    /**
     * Frontpage sections blocks "gallery post format" slider 
     * 
     * 
     */
     var galleryFormatWrapper;
     if($( "body.archive" ).length ) {
       galleryFormatWrapper = $( "body.archive" )
     } else if($( "body.blog" ).length ) {
       galleryFormatWrapper = $( "body.blog" )
     } else if($( "body.home.blog" ).length ) {
       galleryFormatWrapper = $( "body.home.blog" )
     } else {
       galleryFormatWrapper = false;
     }
     if(galleryFormatWrapper) {
        galleryFormatWrapper.each(function() {
        var sectionContainer  = $(this),
        sectionWrapper = sectionContainer.find( ".format-gallery .wp-block-gallery ul, .format-gallery .wp-block-gallery.has-nested-images" ), innerSectionContainer
        if(sectionWrapper.length) {
          sectionWrapper.each(function() {
            innerSectionContainer = $(this)
            innerSectionContainer.slick(Object.assign(
              slideArrow
            ))
          })
        }
      })
    }

    // post filter tab layout one
    $(".bloginwp-frontpage-section .tab-item").on("click", function (e) {
      e.preventDefault();
      $(this).addClass("active").siblings().removeClass("active");
      let getShownTab = $(this).data("for");
      let foundTab = $(this)
        .parents(".news-block__header")
        .siblings(".news-block__tab")
        .find(`[data-tab-name='${getShownTab}']`);
        foundTab.fadeIn(300).addClass("active").siblings().fadeOut(300).removeClass("active");
        // reinit slick slider after tab filter success
        var foundTabsectionWrapper = foundTab.find( ".format-gallery .wp-block-gallery" ), foundTabinnerSectionContainer
        if(foundTabsectionWrapper.length) {
          foundTabsectionWrapper.each(function() {
            foundTabinnerSectionContainer = $(this)
            foundTabinnerSectionContainer.find( "ul" ).slick('unslick').slick('reinit').slick(Object.assign(slideArrow));
          })
        }
    });

    /**
     * Back To Top script
     * 
     */
    if( $( "#bloginwp-scroll-to-top" ).length ) {
      var scrollContainer = $( "#bloginwp-scroll-to-top" );
      $(window).scroll(function() {
        if ( $(this).scrollTop() > 800 ) {
          scrollContainer.addClass('show');
        } else {
          scrollContainer.removeClass('show');
        }
      });
      scrollContainer.click(function( event ) {
        event.preventDefault();
        // Animate the scrolling motion.
        jQuery("html, body").animate({
          scrollTop:0
        },"slow");
      });
    }
    
    /**
     * Header Toggle Sidebar handler
     * 
     */
    var header_sidebar_trigger = $( ".header-sidebar-trigger" )
    if( header_sidebar_trigger.length ) {
        header_sidebar_trigger.on( "click", function() {
            $("#page").prepend( '<div class="header-sidebar-overlay"></div>');
            $("body").toggleClass( "header_toggle_sidebar_active" );
            $(this).next(".header-sidebar-content").animate({
              width: "toggle"
            });
        })

        // on close trigger
        $(document).on( "click", ".header-sidebar-content .header-sidebar-trigger-close, .header-sidebar-overlay", function() {
            $("body").toggleClass( "header_toggle_sidebar_active" );
            $("#page .header-sidebar-overlay").remove();
            $("body").find( ".header-sidebar-content" ).animate({
                width: "toggle"
            })
        })
    }

    /**
     * Sticky sidebar
     * 
     */
    if( bloginwpObject.stickySidebar ) {
      $( ".primary-section, .secondary-section" ).theiaStickySidebar({'minWidth':1024})
    }

    /**
     * Sticky header
     * 
     */
    if( bloginwpObject.stickyHeader ) {
      $('#content').waypoint(function(direction) {  
            $('header.theme-default').toggleClass('fixed_header');
        }, { offset: + 0 });
    }

    /**
     * stickey related posts
     * 
     */
    if( bloginwpObject.relative_post_popup ) {
      $('.single .post-footer').waypoint(function(direction) {  
            $('.single-related-posts-section-wrap.related_posts_popup').addClass('related_posts_popup_sidebar');
        }, { offset: + 50 });
    }

    $('.related_post_close').on('click',function(){
      $('.single .single-related-posts-section-wrap.related_posts_popup').removeClass('related_posts_popup_sidebar related_posts_popup');
    });


});
