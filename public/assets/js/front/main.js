WebFont.load({
    google: {
        families: ['Montserrat:400,600,700:cyrillic', 'Roboto:400,700:cyrillic']
    }
});

// var player;

// function onYouTubeIframeAPIReady() {
//     player = new YT.Player('player', {
//         videoId: 'kIiax4TGC2c',
//         playerVars: {
//             'loop': 1,
//             'playlist': 'kIiax4TGC2c',
//             'iv_load_policy': 3,
//             'modestbranding': 1,
//             'autoplay': 1,
//             'controls': 0,
//             'showinfo': 0,
//             'wmode': 'opaque',
//             'branding': 0,
//             'autohide': 1,
//             'rel': 0,
//         },
//         events: {
//             'onReady': onBgReady,
//             'onStateChange': onPlayerStateChange
//         }
//     });
// }


// function onBgReady(event) {
//     event.target.setPlaybackQuality('hd720');
//     event.target.clearVideo();
//     event.target.playVideo();
//     event.target.mute()
// }

// function onPlayerStateChange(event) {
//     if (event.data == YT.PlayerState.BUFFERING) {
//         event.target.setPlaybackQuality('hd720');  // <-- WORKS!
//     }
// }
var wow = new WOW({
    boxClass: 'wow', // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset: 0, // distance to the element when triggering the animation (default is 0)
    mobile: true, // trigger animations on mobile devices (default is true)
    live: true, // act on asynchronously loaded content (default is true)
    callback: function(box) {
        // the callback is fired every time an animation is started
        // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null, // optional scroll container selector, otherwise use window,
    resetAnimation: true, // reset animation on end (default is true)
});
wow.init();

function onPlayerReady(event) {
    event.target.playVideo();
}



// var navbar =  $('.navigation');  // navigation block
// var wrapper = $('.delivery-social');        // may be: navbar.parent();

// $(window).scroll(function(){
//     var nsc = $(document).scrollTop();
//     var bp1 = wrapper.offset().top;
//     var bp2 = bp1 + wrapper.outerHeight()-$(window).height();

//     console.log(bp1 , nsc)

//     // if (nsc>bp1) {  navbar.css('position','fixed'); }
//     // else { navbar.css('position','absolute'); }
//     // if (nsc>bp2) { navbar.css('top', bp2-nsc); }
//     // else { navbar.css('top', '0'); }
// });



$(document).ready(function($) {

    $('.btn--big').on('click', function(event) {
        event.preventDefault();
        var id = $(this).attr('href'),
            top = $(id).offset().top - 150;
        $('body,html').animate({
            scrollTop: top
        }, 1500);
    });



    var isMobile = false;
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;

    if (isMobile == true) {
        $('[data-tabs="0"]').prependTo('[data-slide="carbud"]')
        $('[data-tabs="1"]').prependTo('[data-slide="carmarket"]')

        $('.link--menu').on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('active');
            $('header').toggleClass('active');
            $('.menu-mobile').toggleClass('open');
        });

        $('.lot-content__info .title--section').prependTo('.lot-content')


        $('[data-tab="1"]').appendTo('[data-mobile="1"]')
        $('[data-tab="2"]').appendTo('[data-mobile="2"]')
        $('[data-tab="3"]').appendTo('[data-mobile="3"]')

        $('[name=countryc]').on('change', function(event) {
            event.preventDefault();
            $('[name=countryc]').removeClass('active')
            $(this).addClass('active')
            $ck = $(this).attr('data-ck')
            $('[name=countrycheck]').val($(this).val())
            $thisParent = $(this).parent()
            $thisParent.siblings().find('[data-tab]').slideUp()
            $('[data-tab=' + $ck + ']').slideDown()

        });

    } else {

        $('[name=countryc]').on('change', function(event) {
            event.preventDefault();
            $('[name=countryc]').removeClass('active')
            $(this).addClass('active')
            $ck = $(this).attr('data-ck')
            $('[name=countrycheck]').val($(this).val())
            $('.contacts-tabs__content').animate({
                    'opacity': '0'
                },
                400,
                function() {
                    $('[data-tab]').removeClass('active')
                    $('[data-tab=' + $ck + ']').addClass('active')
                    $('.contacts-tabs__content').animate({
                        'opacity': '1'
                    }, 400)
                });

        });

        var $win = $(window);

        if ($('.delivery-abs').length) {


            var $marker = $('.delivery-abs');
            if ($win.scrollTop() + $win.height() - 50 >= $marker.offset().top) {
                $marker.find('.delivery-social').addClass('fixed').appendTo('body')

                if ($win.scrollTop() + $win.height() >= $('.section-footer').offset().top) {
                    $('.delivery-social').removeClass('fixed').appendTo('.section-partners')
                } else {
                    $('.delivery-social').addClass('fixed').appendTo('body')
                }

            } else {
                $('.delivery-social').removeClass('fixed').appendTo($marker)
            }
            $win.scroll(function() {
                if ($win.scrollTop() + $win.height() - 50 >= $marker.offset().top) {
                    $marker.find('.delivery-social').addClass('fixed').appendTo('body')

                    if ($win.scrollTop() + $win.height() >= $('.section-footer').offset().top) {
                        $('.delivery-social').removeClass('fixed').appendTo('.section-partners')
                    } else {
                        $('.delivery-social').addClass('fixed').appendTo('body')
                    }

                } else {
                    $('.delivery-social').removeClass('fixed').appendTo($marker)
                }
            });
        }
    }

    $('select').styler({
        selectSmartPositioning: false,
    });

    opnsFancy = {
        touch: false,
        baseClass: "modal",
        backFocus: false,
        beforeLoad: function(instance, slide) {

            if (isMobile == false) {} else {

            }

        },
        afterLoad: function(instance, current) {
            $selects = $(popup).find('select')

            if (popup == '#corporate') {
                $('select').styler({
                    onSelectClosed: function() {
                        $(this).removeClass('empty_field');
                        $(this).attr('data-val', '1')
                    }
                });
            }
            if ($link.hasClass('link--mored')) {
                $carId = $link.parents('.budget-slide').attr('data-car')
                $budId = $link.parents('.budget-slide').attr('data-price')

                $("[name=carpopup] option[data-car=" + $carId + "]").attr('selected', 'true')
                $("[name=budgetpopup] option[data-setprice=" + $budId + "]").attr('selected', 'true')
            }
            $selects.trigger('refresh');

        },
        afterClose: function(instance, slide) {
            $("[name=carpopup] option[data-car]").removeAttr('selected');
            $("[name=budgetpopup] option[data-setprice]").removeAttr('selected');
            if (isMobile == false) {} else {}
        },
        hideScrollbar: true,
        btnTpl: {
            smallBtn: '<button type="button" data-fancybox-close class="fancybox-button fancybox-close-small" title="{{CLOSE}}">' +
                '<svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<path fill="#2D2E3E" d="M11.619.38l1.414 1.415L1.501 13.327.087 11.913z"/>' +
                '<path fill="#2D2E3E" d="M0 2L1.414.586 13 12.172l-1.414 1.414z"/>' +
                '</svg>' +
                "</button>",

        },
    }
    $('body').on('click', '.fancybtn', function(event) {
        event.preventDefault()
        popup = $(this).data('popup')
        $link = $(this)
            // popup = '#login'
        $.fancybox.open({
            src: popup,
            type: 'inline',
            opts: opnsFancy,
        });
        return false
    });
    // 
    //  if ($('#authorize_flag').val() != "1") {
    //     $.fancybox.open({
    //      src: '#authorize_form',
    //      type: 'inline',
    //      opts: {
    //          touch: false,
    //          baseClass: "modalbg",
    //          hideScrollbar: true,
    //          smallBtn: false,
    //          clickOutside: false,
    //          clickSlide: false,
    //          buttons: [],
    //      }
    //  }); 
    // }

    var costSlider = $("input.rangecost").slider({
        ticks: [0, 1, 2, 3, 4],
        ticks_snap_bounds: 30,
        tooltip: 'hide',
        value: 0,
    });

    $('[name=budget]').on('change', function(event) {
        filter($(this).val())
    });

    $('[name=budgetpopup]').on('change', function(event) {

        $choose = $(this).find(':selected').attr('data-setprice')
        $('[name=carpopup]').parent().find('[data-price]').css('display', 'none')
        $('[name=carpopup]').parent().find('[data-price=' + $choose + ']').css('display', 'block')
    });

     var sliderWh = new Swiper('.what-items', {
        speed: 800,
        slidesPerView: 3,
        spaceBetween: 15,
        // loop: true,
        navigation: {
            nextEl: '.what--next',
            prevEl: '.what--prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                // spaceBetween: 15,
                slidesPerView: 1,
            },
        }
    });


    var sliderCan = new Swiper('.partners-slider', {
        speed: 800,
        slidesPerView: 5,
        spaceBetween: 35,
        loop: true,
        navigation: {
            nextEl: '.partners--next',
            prevEl: '.partners--prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 15,
                slidesPerView: 2,
            },
        }
    });



    var sliderLit = new Swiper('.lot-content__little', {
        speed: 800,
        slidesPerView: 3,
        spaceBetween: 10,
        slidesPerColumn: 2,
        slidesPerColumnFill: 'row',
        navigation: {
            nextEl: '.lotl--next',
            prevEl: '.lotl--prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 10,
                slidesPerView: 2,
                slidesPerColumn: 3,
            },
        },
        on: {
            click: function() {
                sliderBig.slideTo(this.clickedIndex, 800);
            },
        }
    });
    var sliderBig = new Swiper('.lot-content__big', {
        speed: 800,
        slidesPerView: 1,
        spaceBetween: 10,
        autoHeight: false,
        navigation: {
            nextEl: '.lot--next',
            prevEl: '.lot--prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 10,
            },
        }
    });

     var sliderLitCard = new Swiper('.lot-card-content__little', {
        speed: 800,
        slidesPerView: 3,
        loopedSlides: 4,
        slideToClickedSlide: true,
        spaceBetween: 10,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        loop: true,
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 10,
                slidesPerView: 3,
            },
        }
    });
    
   

    var sliderBigCard = new Swiper('.lot-card-content__big', {
        slidesPerView: 1,
        loopedSlides: 4,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: '.lotcard--next',
            prevEl: '.lotcard--prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 10,
            },
        },
    });
    if ($('.lot-card-content__big').length) {
    sliderBigCard.controller.control = sliderLitCard;
    sliderLitCard.controller.control = sliderBigCard;
    }
   

    
    


    var sliderAll = new Swiper('.market-sliders__tabs', {
        speed: 400,
        slidesPerView: 1,
        simulateTouch: false,
        // effect: 'fade',
        // fadeEffect: {
        // crossFade: true,
        // },
        spaceBetween: 30,
        breakpoints: {
            789: {

                slidesPerView: 1,
                slidesPerView: 1,
                slidesPerColumn: 2,
            },
        }
    });

    var sliderVideos = new Swiper('.videos-slider', {
        speed: 800,
        slidesPerView: 2,
        spaceBetween: 0,
        navigation: {
            nextEl: '.videos--next',
            prevEl: '.videos--prev',
        },
        pagination: {
            el: '.videos-pagination',
            type: 'bullets',
            // dynamicMainBullets: 2,
            clickable: true
        },
        breakpoints: {
            789: {
                slidesPerView: 1,
            },
        },
        on: {
            slideChange: function() {
                $('.videos-app').remove()
            }
        },

    });

    var sliderCard = new Swiper('.cardo-slider', {
        speed: 800,
        slidesPerView: 4,
        spaceBetween: 30,
        navigation: {
            nextEl: '.cardo--next',
            prevEl: '.cardo--prev',
        },
        pagination: {
            el: '.our-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            789: {
                slidesPerView: 1.3,
                slidesOffsetBefore: 50,
                slidesOffsetAfter: 50,
            },
        }
    });

    var sliderOur = new Swiper('.our-slider', {
        speed: 800,
        slidesPerView: 3,
        spaceBetween: 10,
        slidesPerColumn: 2,
        navigation: {
            nextEl: '.our--next',
            prevEl: '.our--prev',
        },
        pagination: {
            el: '.our-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            789: {
                slidesPerView: 1,
                slidesPerColumn: 1,
            },
        }
    });
    var sliderBudget = new Swiper('.budget-slider', {
        speed: 800,
        slidesPerView: 3,
        spaceBetween: 0,
        navigation: {
            nextEl: '.budget--next',
            prevEl: '.budget--prev',
        },
        pagination: {
            el: '.budget-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            789: {
                slidesPerView: 1,
            },
        }
    });

    function filter(cost) {
        $(sliderBudget.$wrapperEl).find($('.swiper-slide')).hide()
        $(sliderBudget.$wrapperEl).find($('.swiper-slide[data-price=' + cost + ']')).show()
        sliderBudget.update()
    }

    if (location.pathname == '/') {
        $nowVal = costSlider.slider('getValue')
        filter($nowVal)
    }


    costSlider.on("change", function(slideEvt) {

        filter(slideEvt.value.newValue)
    });


    var sliderCost = new Swiper('.team-slider', {
        speed: 800,
        slidesPerView: 3,
        spaceBetween: 160,
        // simulateTouch: false,
        centeredSlides: true,
        initialSlide: 1,
        autoHeight: true,
        // loop: true,
        navigation: {
            nextEl: '.team-next',
            prevEl: '.team-prev',
        },
        breakpoints: {
            789: {
                simulateTouch: true,
                spaceBetween: 0,
                slidesPerView: 1.7,
                initialSlide: 1,
                centeredSlides: true,
            },
        }
    });


    var playerSlide;
    $('.videos-slider').on('click', '.link--play', function(event) {
        event.preventDefault();
        $('.videos-app').remove()
        $videoId = $(this).attr('href')
        $html = $('<div class="videos-app"><div id="video"></div></div>');
        $iframe = $(this).parent().append($($html))
        playerSlide = new YT.Player('video', {
            videoId: $videoId,
            playerVars: {
                'autoplay': 1,
                'rel': 0,
            },
            events: {
                'onReady': onPlayerReady
            }
        });
    });



    $('.market-range__head').on('click', 'h2', function(event) {
        event.preventDefault();
        $('.market-range__head h2').removeClass('active')
        $(this).addClass('active')
        $tab = $(this).data('tabs')
        sliderAll.slideTo($tab, 800);
        // sliderOur.update()
        // sliderBudget.update()
    });

    var condition = true;
    $('.link--select').on('click', function(event) {
        event.preventDefault();
        $('.link--select').not(this).removeClass('active')
        $('.link--select').not(this).parent().find('.header-content__select-tab').hide(400)
        $(this).toggleClass('active')
            // $('.link--select').not(this).parents('.menu-mobile').find('.menu-list').removeClass('op')
        $(this).parent().find('.header-content__select-tab').toggle('show')
        if ($(this).hasClass('active')) {
            $('.menu-mobile').find('.menu-list').addClass('op');
        } else {
            $('.menu-mobile').find('.menu-list').removeClass('op');
        }

        // $('.link--select').not(this).parents('.menu-mobile').removeClass('op')
        // $(this).parents('.menu-mobile').toggleClass('op');




    });

    $(document).mouseup(function(e) {
        var container = $(".link--select");
        if (container.has(e.target).length === 0) {
            container.parent().find('.header-content__select-tab').hide(400)
            $('.link--select').removeClass('active')
        }
    });


    $('.form-search').on('keyup', function(event) {
        $input = $.trim($(this).find('input').val())
            // $('.form-search').not(this).addClass('noact');
        if ($input.length > 0) {
            $('.form-search').not(this).find('input, button').prop("disabled", true);
        } else {
            $('.form-search').not(this).find('input, button').prop("disabled", false);
        }
    });

    $("body").on("mouseover", ".video-hover__container", function() {
        $this = $(this).find('video')
        $($this)[0].play();
    });
    $("body").on("mouseleave", ".video-hover__container", function() {
        $this = $(this).find('video')
        $($this)[0].pause();
    })



    // Добавить это


    $('.faq-item__head').on('click', function(event) {
        event.preventDefault();
        $parentThis = $(this).parent()
        $contentThis = $parentThis.find('.faq-item__content')
        $parentThis.toggleClass('active').siblings().removeClass('active');
        $('.faq-item__head').not(this).parent().find('.faq-item__content').slideUp();
        $contentThis.find('p').addClass('animated slow fadeIn');
        $contentThis.slideToggle()
    });


    // Проверка полей
    var pattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
    var form = $('[data-form=sendnormal]'),
        btn = form.find('.btn--submit');

    form.find('.reqfield').addClass('empty_field');

    function checkInput(form) {
        form.find('.reqfield').each(function() {
            if ($(this).val() != '' || $(this).attr('data-val')) {
                $(this).removeClass('empty_field');
                if ($(this).hasClass('email')) {
                    mailfield = $(this)
                    if (pattern.test(mailfield.val())) {
                        mailfield.removeClass('empty_field');
                    } else {
                        mailfield.addClass('empty_field');
                    }
                }
            } else {
                $(this).addClass('empty_field');
            }
        });
        form.find('.reqcheck').each(function() {
            if (!$(this).is(':checked')) {
                $(this).addClass('empty_checkbox')
            } else {
                $(this).removeClass('empty_checkbox');
            }
        });
    }

    function lightEmpty(form) {
        form.find('.empty_field').addClass('error');
        form.find('.empty_field').trigger('focus')
            // form.find('.empty_field').siblings('p.error').fadeIn();
        form.find('.empty_checkbox').addClass('error');
        setTimeout(function() {
            form.find('.empty_field').removeClass('error');
            form.find('.empty_checkbox').removeClass('error');
            // form.find('.empty_field').siblings('p.error').fadeOut()
        }, 1000);
    }
    btn.click(function() {
        event.preventDefault()
        form = $(this).parents('form')
        checkInput(form);
        var sizeEmpty = form.find('.empty_field').length;
        if (sizeEmpty > 0) {
            if ($(this).hasClass('disabled')) {
                lightEmpty(form);
                return false
            } else {
                $(this).addClass('disabled')
                lightEmpty(form);
                return false
            }
        } else {
            $(this).removeClass('disabled');
            form.trigger('submit')
        }
    });
    // Обработчик формы
    form.submit(function(event) {
        var _form = $(this);
        var th = _form.serialize();
        var form_url = _form.attr('action');
        console.log(form_url)
        th = th + "&_token=" + $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: form_url,
            data: th,
            success: function(data) {
                $.fancybox.close()
                popup = "#thanks"
                $.fancybox.open({
                    src: popup,
                    type: 'inline',
                    opts: opnsFancy,
                });
                setTimeout(function() {
                    _form.trigger("reset");
                }, 3000);
                if (form_url == 'https://onexport.com/register' || form_url == 'https://onexport.com/login' ) {
                    window.location.href = document.location.origin;
                }
                setTimeout(function() {
                    $.fancybox.close();


                }, 15000)
            }
        });
        event.preventDefault();
    });

    $('[name=office]').on('change', function(event) {
        $blockChange = $(this).parents('.form-block').find('.events')
        $fieldChange = $blockChange.find('.field, .select')
        console.log($fieldChange)
        if ($(this).val() == 'Нет') {
            $blockChange.addClass('disfields')
            $fieldChange.removeClass('reqfield empty_field error')
        } else {
            $blockChange.removeClass('disfields')
            $fieldChange.addClass('reqfield')

        }
    });

    $('[name=site]').on('change', function(event) {

        $blockChange = $(this).parents('.form-block').find('.events')
        if ($(this).val() == 'Нет') {
            $blockChange.addClass('disfields')
        } else {
            $blockChange.removeClass('disfields')
        }
    });
    $('[name=colpeop]').on('change', function(event) {
        $(this).parent().attr('data-val', $(this).val());
        $(this).parent().removeClass('empty_field')
    })
    $('[name=dil]').on('change', function(event) {

        $blockChange = $(this).parents('.form-block').find('.events')
        if ($(this).val() == 'Нет') {
            $blockChange.addClass('disfields')
        } else {
            $blockChange.removeClass('disfields')
        }
    });

    $('.phone').mask('+38 (000) 000-00-00');


    var pass = $('.field--show');
    $('.show-password').click(function() {
        $(this).toggleClass('active');
      pass.attr('type', pass.attr('type') === 'password' ? 'text' : 'password');
    });

    $('[name=vehicle_type]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val();
        var text = $(this).parent().find('.ltext').text();
        $('.calcmodal-list__shipping span').html(text)

        $('#calcmodal input[name=shipping]').val($val)
                
    });
    $('[name=auction]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val()
        var text = $(this).parent().find('.jq-selectbox__select-text').text();
        $('.calcmodal-list__from .fr').text(text)

        $('#calcmodal input[name=auctions]').val($val)
                
    });
    $('[name=location]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val()
        var text = $(this).parent().find('.jq-selectbox__select-text').text();
        $('.calcmodal-list__from .tw').text(text)

        $('#calcmodal input[name=selected_location]').val($val)
                
    });
    $('[name=port1]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val()
        var text = $(this).parent().find('.jq-selectbox__select-text').text();
        $('.calcmodal-list__to span').text(text)

        $('#calcmodal input[name=exifport]').val($val)
                
    });
    $('[name=country]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val()
        var text = $(this).parent().find('.jq-selectbox__select-text').text();
        $('.calcmodal-list__shipto .fr').text(text)

        $('#calcmodal input[name=selected_country]').val($val)
                
    });
    $('[name=port2]').on('change', function(event) {
        event.preventDefault();
        $val = $(this).val()
        var text = $(this).parent().find('.jq-selectbox__select-text').text();
        $('.calcmodal-list__shipto .tw').text(text)

        $('#calcmodal input[name=portcity]').val($val)
                
    });


    // $('auctions')
    // $('selected_location')
    // $('exifport')
    // $('selected_country')
    // $('portcity')
    // $('shiping')

    // $allSelect = $('.costdel-calc__select').find('.selreq');
    // $('.selreq').on('change', function(){
        // $selVal = $(this).find('.jq-selectbox__select-text').text();
        // console.log($selVal)
        // if ($allSelect)
        // $(this).removeClass('class name')
    // })

    $('.btn--nextstep').on('click', function(event) {
        event.preventDefault();
        // $('[data-tab="step1"]').addClass('animated fadeOut');
        $('[data-tab="step1"]').fadeOut('400', function() {
            $('[data-tab="step2"]').fadeIn()
            $('.section-calcmap').slideDown('400');
        });
    });



});