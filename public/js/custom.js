/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 3.0
Designed and Development by: ScriptsBundle
*/
/*
====================================
[ CSS TABLE CONTENT ]
------------------------------------
    1.0 -  Page Preloader
	2.0 -  Counter FunFacts
    3.0 -  List Grid Style Switcher
	4.0 -  Sticky Ads
	5.0 -  Accordion Panels
    6.0 -  Accordion Style 2
	7.0 -  Jquery CheckBoxes
	8.0 -  Jquery Select Dropdowns
    9.0 -  Profile Image Upload
    10.0 - Masonry Grid System
	11.0 - Featured Carousel 1
    12.0 - Featured Carousel 2
	12.0 - Featured Carousel 3
	13.0 - Category Carousel
	14.0 - Background Image Rotator Carousel
	15.0 - Single Ad Slider Carousel
	16.0 - Single Page SLider With Thumb
	17.0 - Price Range Slider
	18.0 - Template MegaMenu
	19.0 - Back To Top
	20.0 - Tooltip
	21.0 - Quick Overview Modal
-------------------------------------
[ END JQUERY TABLE CONTENT ]
=====================================
*/
(function($) {
    "use strict";

    var $queryUrl = "";
    var $loaded = false;

    /* ======= Preloader ======= */
    setTimeout(function() {
        $('body').addClass('loaded');
    }, 1000);

    /* ======= Counter FunFacts ======= */
    var timer = $('.timer');
    if (timer.length) {
        timer.appear(function() {
            timer.countTo();
        });
    }

    /* ======= List Grid Style Switcher ======= */
    $('#list').on("click", function(event) {
        event.preventDefault();
        $(this).addClass('active');
        $('#grid').removeClass('active');
        $('#products .item').addClass('list-group-items');
    });
    $('#grid').on("click", function(event) {
        event.preventDefault();
        $(this).addClass('active');
        $('#list').removeClass('active');
        $('#products .item').removeClass('list-group-items');
        $('#products .item').addClass('grid-group-item');
    });

    /* ======= Sticky Ads ======= */
    $('.leftbar-stick, .rightbar-stick').theiaStickySidebar({
        additionalMarginTop: 80
    });

    /* ======= Accordion Panels ======= */
    $('.accordion-title a').on('click', function(event) {
        event.preventDefault();
        if ($(this).parents('li').hasClass('open')) {
            $(this).parents('li').removeClass('open').find('.accordion-content').slideUp(400);
        } else {
            $(this).parents('.accordion').find('.accordion-content').not($(this).parents('li').find('.accordion-content')).slideUp(400);
            $(this).parents('.accordion').find('> li').not($(this).parents('li')).removeClass('open');
            $(this).parents('li').addClass('open').find('.accordion-content').slideDown(400);
        }
    });

    /* ======= Accordion Style 2 ======= */
    $('#accordion').on('shown.bs.collapse', function() {
        var offset = $('.panel.panel-default > .panel-collapse.in').offset();
        if (offset) {
            $('html,body').animate({
                scrollTop: $('.panel-title a').offset().top - 20
            }, 500);
        }
    });

    /* ======= Jquery CheckBoxes ======= */
    $('.skin-minimal .list li input').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
    });

    /* ======= Jquery Select Dropdowns ======= */
    $("select").select2({
        placeholder: {
            id: '-1'
        },
        allowClear: true,
        width: '100%'
    });

    /* ======= Profile Image Upload ======= */
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });
    $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        if (input.length) {
            input.val(log);
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });

    /* ======= Masonry Grid System ======= */
    $('.posts-masonry').imagesLoaded(function() {
        $('.posts-masonry').isotope({
            layoutMode: 'masonry',
            transitionDuration: '0.3s'
        });
    });

    var masonryUpdate = function() {
        setTimeout(function() {
            $('.posts-masonry').isotope({
                layoutMode: 'masonry',
                transitionDuration: '0.3s'
            });
        }, 0);
    }

    /* ======= Featured Carousel 1 ======= */
    $('.featured-slider').owlCarousel({
        loop: true,
        dots: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true,
                loop: true
            }
        }
    });

    /* ======= Featured Carousel 2 ======= */
    $('.featured-slider-1').owlCarousel({
        loop: true,
        dots: false,
        margin: -10,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 2,
                nav: true,
                loop: true
            }
        }
    });

    /* ======= Featured  Carousel 3 ======= */
    $('.featured-slider-3').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        mouseDrag: true,
        touchDrag: true,
        autoplayTimeout: 3000,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 1,
                nav: true,
                loop: true
            }
        }
    });

    /* ======= Category Carousel ======= */
    $('.category-slider').owlCarousel({
        loop: true,
        dots: false,
        margin: 0,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: true
            }
        }
    });

    /* ======= Background Image Rotator Carousel ======= */
    $('.background-rotator-slider').owlCarousel({
        loop: true,
        dots: false,
        margin: 0,
        autoplay: true,
        mouseDrag: true,
        touchDrag: true,
        autoplayTimeout: 5000,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });
	
	/* ======= Single Ad Slider Carousel  ======= */
    $('.single-details').owlCarousel({
        loop: true,
        dots: false,
        margin: 0,
        autoplay: false,
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            }
        }
    });

    /*==========  Single Page SLider With Thumb ==========*/
    $('#carousels').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 110,
        itemMargin: 50,
        asNavFor: '.single-page-slider'
    });
    $('.single-page-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: true,
        sync: "#carousel"
    });
	
	 /*==========  Price Range Slider  ==========*/
    $('#price-slider').noUiSlider({
        connect: true,
        behaviour: 'tap',
        margin: 5000,
        start: [20000, 100000],
        step: 2000,
        range: {
            'min': 0,
            'max': 150000
        }
    });
		$('#price-slider').Link('lower').to($('#price-min'), null, wNumb({
			decimals: 0
		}));
		$('#price-slider').Link('upper').to($('#price-max'), null, wNumb({
			decimals: 0
		}));
		
		
    /* ======= Template MegaMenu  ======= */
    $('#menu-1').megaMenu({
        // DESKTOP MODE SETTINGS
        logo_align: 'left', // align the logo left or right. options (left) or (right)
        links_align: 'left', // align the links left or right. options (left) or (right)
        socialBar_align: 'left', // align the socialBar left or right. options (left) or (right)
        searchBar_align: 'right', // align the search bar left or right. options (left) or (right)
        trigger: 'hover', // show drop down using click or hover. options (hover) or (click)
        effect: 'expand-top', // drop down effects. options (fade), (scale), (expand-top), (expand-bottom), (expand-left), (expand-right)
        effect_speed: 400, // drop down show speed in milliseconds
        sibling: true, // hide the others showing drop downs if this option true. this option works on if the trigger option is "click". options (true) or (false)
        outside_click_close: true, // hide the showing drop downs when user click outside the menu. this option works if the trigger option is "click". options (true) or (false)
        top_fixed: false, // fixed the menu top of the screen. options (true) or (false)
        sticky_header: true, // menu fixed on top when scroll down down. options (true) or (false)
        sticky_header_height: 200, // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
        menu_position: 'horizontal', // change the menu position. options (horizontal), (vertical-left) or (vertical-right)
        full_width: false, // make menu full width. options (true) or (false)
        // MOBILE MODE SETTINGS
        mobile_settings: {
            collapse: true, // collapse the menu on click. options (true) or (false)
            sibling: true, // hide the others showing drop downs when click on current drop down. options (true) or (false)
            scrollBar: true, // enable the scroll bar. options (true) or (false)
            scrollBar_height: 400, // scroll bar height in px value. this option works if the scrollBar option true.
            top_fixed: false, // fixed menu top of the screen. options (true) or (false)
            sticky_header: false, // menu fixed on top when scroll down down. options (true) or (false)
            sticky_header_height: 200 // sticky header height top of the screen. activate sticky header when meet the height. option change the height in px value.
        }
    });

   

    /*==========  Back To Top  ==========*/
    	var offset = 300,
        offset_opacity = 1200,
        //duration of the top scrolling animation (in ms)
        scroll_top_duration = 700,
        //grab the "back to top" link
        $back_to_top = $('.cd-top');
		//hide or show the "back to top" link
		$(window).scroll(function() {
			($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible'): $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if ($(this).scrollTop() > offset_opacity) {
				$back_to_top.addClass('cd-fade-out');
			}
		});
    	//smooth scroll to top
		$back_to_top.on('click', function(event) {
	
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0,
			}, scroll_top_duration);
		});

    /*==========  Tooltip  ==========*/
    $('[data-toggle="tooltip"]').tooltip();

    /*==========  Quick Overview Modal  ==========*/
    $(".quick-view-modal").css("display", "block");
	
	
	/* ========== Forms =============== */

    $(".contact-form").submit(function(e) {

        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        form.prev('.alert').remove();
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data)
            {
               var data = JSON.parse(data);

               if (data.status == 'success') {
                     $( '\
                        <div role="alert" class="alert alert-success alert-dismissible">\
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>\
                            <strong>'+get_phrase('success')+'!</strong> - '+data.message+'\
                        </div>\
                    ' ).insertBefore( ".contact-form" );
               }else{
                   $( '\
                        <div role="alert" class="alert alert-danger alert-dismissible">\
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>\
                            <strong>'+get_phrase('error')+'!</strong> - '+data.message+' \
                        </div>\
                    ' ).insertBefore( ".contact-form" );
               }
            },
            error: function(data)
            {
               $( '\
                        <div role="alert" class="alert alert-danger alert-dismissible">\
                            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>\
                            <strong>'+get_phrase('error')+'!</strong> - '+get_phrase('internal_server_error')+'!\
                        </div>\
                    ' ).insertBefore( ".contact-form" );
            }
        });

        form[0].reset();

    });
    
    var loadnews = {
        category : function() {
            return $('.newslist-content').attr('category');
        },
        date : function(argument) {
            return new Date().getTime();
        },
        pagination : function(pageNum) { 
            if (pageNum == undefined) {
                pageNum = 0;
            }
            $.ajax({
                url: base_url+'post/loadnews/'+pageNum,
                cache: false,
                type: 'post',
                dataType: 'html',
                data: {category_id: loadnews.category()},
                success: function(responseData){
                    responseData = JSON.parse(responseData);
                    $('.newslist-content, .newslist-pagination').empty();
                    $('.newslist-content').html(responseData.result);
                    $('.newslist-pagination').html(responseData.pagination);
                    $('.cd-top').trigger( "click" );
                }
            });
        }
    };

    if( $('.newslist-content').length )
    {
        loadnews.pagination(0);

    }

    $('.newslist-pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageNum = $(this).attr('data-ci-pagination-page');
        loadnews.pagination(pageNum);
    });

    var search = {
        list : function(type) {
            if (type == 'list' || type == 'grid') {
                sessionStorage.setItem("list", type);
                var list = type;
            }else{
                if (sessionStorage["list"]) {
                    var list = sessionStorage.getItem("list");
                }else{
                    var list = 'list';
                }
            }

            return list;
        },
        sort : function(type) {
            if (type == 'default' || type == 'cheap' || type == 'expensive' || type == 'new' || type == 'old' || type == 'name_az'  || type == 'name_za') {
                sessionStorage.setItem("sort", type);
                var sort = type;
            }else{
                if (sessionStorage["sort"]) {
                    var sort = sessionStorage.getItem("sort");
                }else{
                    var sort = 'default';
                }
            }

            return sort;
        },
        pagination : function (name, set) {
            if (set != undefined) {
              $("[name='"+name+"']").val(set);
            }
            if (name=='limit') {
                return $("[name='limit']").val();
            }
            if (name=='from') {
                return $("[name='from']").val();
            }
        },
        query : function(name) {
            var uri = {};
            uri['list'] = search.list();
            uri['sort'] = search.sort();
            uri['limit'] = search.pagination('limit');
            uri['from'] = search.pagination('from');
            $('.ad-search-form input, .ad-search-form textarea, .ad-search-form select').each(function(){
                var el = $(this);
                if (el.val() != '') {
                    uri[el.attr('name')] = el.val();
                }
            });
            
            if (name != undefined) {
                if( uri[name] === undefined ) {
                    return '';
                }else{
                    return uri[name];
                }
            }else{
                return uri;
            }
        },
        filters : function () {
            var filter_vars = {}, filter, filter_id;
            var regex = /filter\[.*?\]=([^&#]*)/g; 
            var filters = decodeURI(window.location.href).match(regex);
            if (filters != null) {
                for(var i = 0; i < filters.length; i++)
                {
                    filter = filters[i].split('=');
                    filter_id = filter[0].replace('filter[', '').replace(']', '');
                    filter_vars[filter_id] = {value:filter[1], key:filter_id, source:filters[i]};
                }
            }else{
                filter_vars = null;
            }
            

            return filter_vars;
        },
        params : function() {
            var vars = {}, hash, url;
            url = decodeURI(window.location.href);
            var hashes = url.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                //vars.push(hash[0]);
                if (hash != base_url+'ads') {
                    vars[hash[0]] = hash[1];
                }else{
                    vars = null;
                }
            }
            
            if (vars == null) {
                vars = search.query();
            }else{
                if( vars['limit'] != undefined ) {
                search.pagination('limit', vars['limit']);
            }
            if( vars['from'] != undefined ) {
                search.pagination('from', vars['from']);
            }
            }
            return vars;
        },
        param : function(name) {
            if (name != undefined)  {
                var vars = this.params()
                return vars[name];
            }else{
                return this.params();
            }
        },
        get: function(url, data, callback) {
            $.ajax({
                url: url,
                cache: false,
                type: 'post',
                dataType: 'html',
                data: data,
                beforeSend: function() {
                    $('.waitme').waitMe({
                        effect : 'ios',
                        text : get_phrase('loading'),
                        bg : 'rgba(255,255,255,0.7)',
                        color : '#000'
                    });
                },
                success: function(responseData){
                    callback(responseData);
                },
                complete: function() {
                    $('.waitme').waitMe('hide');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                }
            });
        },
        featuredReload : function(load) {
            if(typeof $(".featured-slider").data('owlCarousel') != 'undefined') {
                $(".featured-slider").data('owlCarousel').destroy();
            }
            $('.featured-slider').owlCarousel({
                loop: true,
                dots: false,
                margin: -10,
                autoplay: true,
                mouseDrag: true,
                touchDrag: true,
                autoplayTimeout: 3000,
                responsiveClass: true, 
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 2,
                        nav: true
                    },
                    1000: {
                        items: 3,
                        nav: true,
                        loop: true
                    }
                }
            });

            $('.slide-carousel').carousel({
                interval: 1500,
                pause: 'hover',
                ride: 'carousel'
            })
        },
        title : function() {
            if (search.query('category') != '') {
                var category = ' - '+$(".category option[value='"+search.query('category')+"']").text();
            }else{
                var category = '';
            }

            if (search.query('query') != '') {
                var q = ' - '+get_phrase('search_alt')+' '+$("[name='query']").val();
            }else{
                var q = '';
            }

            document.title = base_host+category+q;
            return base_host+category+q;
        },
        onload : function(param, load, filters) {
            if (filters !== undefined) {
                search.get(base_url+'post/get_filter/'+param['category'], param, function(data) {
                    $('.filter-content').html(data);
                }); 
            }
            search.get(base_url+'post/getads/', param, function(data) {
                if (data != 'empty') {
                    data = JSON.parse(data);
                    if (data.default != 'empty') {
                
                        $('.ads-content').html(data.default);
                        masonryUpdate();
                    }
                    if (data.featured != 'empty') {
                         $('.featured-content').html(data.featured);
                        search.featuredReload(load);  
                    }else{
                        $('.featured-content').empty();  
                    }
                }else{
                    $('.featured-content').empty();  
                }
                
                
                setTimeout(function(){
                    $('.filterAdType li').removeClass('active');
                    $("[list='"+search.list()+"']").parent().addClass('active');
                    switch(load) {
                        case 'after':
                        
                        break;
                        default:
                            $(".ads-sort").val(search.sort());
                            $('.ads-sort').select2().trigger('change');
                        break;
                    }
                }, 500);
            });
            $.ajax({
                url: base_url+'post/postpagination/'+param['from'],
                cache: false,
                type: 'post',
                dataType: 'html',
                data: param,
                success: function(responseData){
                    $('.postlist-pagination').empty();
                    $('.postlist-pagination').html(responseData);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                }
            });
            if (param['list'] == 'grid') {
                $(".posts-masonry").addClass('row');
            }else{
                $(".posts-masonry").removeClass('row');
            }

            $('.cd-top').trigger( "click" );
        }
    };
    
    if ($(".main-content-ads").length > 0 && $loaded==false) {
        $loaded==true;
        console.log(search.params())
        search.onload(search.params(), 'beforeload', 'filters');
        window.history.pushState({"pageTitle":search.title()},"", "/ads?"+$.param( search.query() ));
    }
    

    $(document).on('change', '.ad-search-form input, .ad-search-form textarea, .ad-search-form select', function() {
        search.onload(search.query(), 'after', 'filters');
        window.history.pushState({"pageTitle":search.title()},"", "/ads?"+$.param( search.query() ));
    });

    $('[list]').on('click', function(e){
        e.preventDefault(); 
        var type = $(this).attr('list');
        search.list(type);
        search.onload(search.query());
        window.history.pushState({"pageTitle":search.title()},"", "/ads?"+$.param( search.query() ));

    });

    $('.ads-sort').on('change', function(e){
        var type = $(this).val();
        search.sort(type);
        search.onload(search.query(), 'after');
        window.history.pushState({"pageTitle":search.title()},"", "/ads?"+$.param( search.query() ));
    });

    $('.postlist-pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageNum = $(this).attr('data-ci-pagination-page');
        if (pageNum == undefined) {
            pageNum = 0;
        }
        search.pagination('from', pageNum);
        search.onload(search.query(), 'after');
        window.history.pushState({"pageTitle":search.title()},"", "/ads?"+$.param( search.query() ));
    });


    var postad = {
        filters : function(categry_id) {
            $.ajax({
                url: base_url+'post/get_filter/'+categry_id,
                cache: false,
                type: 'post',
                dataType: 'html',
                beforeSend: function() {
                    $('.waitme').waitMe({
                        effect : 'ios',
                        text : get_phrase('loading'),
                        bg : 'rgba(255,255,255,0.7)',
                        color : '#000'
                    });
                },
                success: function(responseData){
                    console.log(responseData)
                    $('.filter-content').html(responseData);
                },
                complete: function() {
                    $('.waitme').waitMe('hide');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    console.log(thrownError);
                }
            });
        }
    };

    $(document).on('change', '.post-ad-categories', function() {
        postad.filters($(this).val());
    });


    window.onpopstate = function(event) {
        location.assign(document.location);
    };

})(jQuery);