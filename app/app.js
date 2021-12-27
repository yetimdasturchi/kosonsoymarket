$( document ).ready(function() {
    var $app = $app || {};
    var $scroll_page = 1;
    var $loadmore = true;
    var shouldPull = true;
    var fsp_history = null;
    var fsp_scroll = 0;
    const $root = $('#root');
    const $api_key = "sizningtokeningiz";
    const $api_server = "http://kosonsoymarket.uz/api/"+$api_key+"/";
    const $sitename = "http://kosonsoymarket.uz";
    //openDatabase("speckyboy","1.0","Моя первая БД",5 * 1024 * 1024);
    let Router = {

        routes: {
            "/": "index",
            "/main": "main",
            "/bookmarks": "bookmarks",
            "/aboutapp": "aboutapp",
            "/settings": "settings",
            "/postad": "postad",
            "/news": "news",
            "/news_view/:id": "news_view",
            "/intro/:action": "intro",
            "/ad/:action/:id": "ad",
            "/aboutus": "aboutus",
        },


        init: function() {
       
            this._routes = [];
            for( let route in this.routes ) {
   
                let method = this.routes[route];
           
                this._routes.push({
               
                    pattern: new RegExp('^' + route.replace(/:\w+/g,'(\\w+)') + '$'),
               
                    callback: this[method]
                });

            }

        },
   
   
   
        dispatch: function(path) {
       
            var i = this._routes.length;
       
            while( i-- ) {
           
                var args = path.match(this._routes[i].pattern);
           
                if( args ) {
               
                    this._routes[i].callback.apply(this,args.slice(1));
                    sessionStorage.setItem('cur_route', args);
                    $(window).scrollTop(0);
                }
            }
        },


        index: function() {
            Router.dispatch($app.home());
        },

        main: function() {
            var data = $app.load.page('main');
            if ($app.content(data)) {
                $scroll_page = 1;
                $loadmore = true;
                shouldPull = true;
                if (localStorage['list_item']) {
                    var list_item = localStorage.getItem('list_item');
                    if (list_item=='grid') {
                        $('.specialads-header, .specialads-temp, .simpleads-temp-grid').show();
                    }else{
                        $('.specialads-header, .specialads-temp, .simpleads-temp-list').show();
                    }
                }else{
                    $('.specialads-header, .specialads-temp, .simpleads-temp-list').show();
                }

                var swiper = new Swiper('.specialads-temp', {
                    slidesPerView: 'auto',
                    spaceBetween: 0,
                    loop: true,
                    autoplay: {
                        delay: 250000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                    },
                });
                var swiper = new Swiper('.small-slide', {
                    slidesPerView: 'auto',
                    spaceBetween: 0,
                });

                var swiper = new Swiper('.news-slide', {
                    slidesPerView: 5,
                    spaceBetween: 0,
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    breakpoints: {
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 0,
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 0,
                        },
                        640: {
                            slidesPerView: 2,
                            spaceBetween: 0,
                        },
                        320: {
                            slidesPerView: 2,
                            spaceBetween: 0,
                        }
                    }
                });
                var html5Slider = document.getElementById('rangeslider');
                noUiSlider.create(html5Slider, {
                    start: [0, 10000000],
                    connect: true,
                    step: 1000,

                    range: {
                        'min': 0,
                        'max': 10000000
                    }
                });

                var inputNumber = document.getElementById('input-number');
                var select = document.getElementById('input-select');

                html5Slider.noUiSlider.on('update', function(values, handle) {
                    var value = values[handle];
                    if (handle) {
                        inputNumber.value = Math.round(value).toFixed(0);
                    } else {
                        select.value = Math.round(value).toFixed(0);
                    }
                });
                select.addEventListener('change', function() {
                    html5Slider.noUiSlider.set([this.value, null]);
                });
                inputNumber.addEventListener('change', function() {
                    html5Slider.noUiSlider.set([null, this.value]);
                });

                var categories = $app.api.categories('list');
                var categories_html = '<option value="null">'+$app.lang.str('all_items')+'</option>';
                if (categories) {
                    $.each(categories, function(i, c) {
                        if ($app.controls.arraySize(c.subcategories) > 0) {
                            if (c.subcategories) {
                                categories_html += '<optgroup label="'+c.name[$app.lang.default()]+'">';
                                categories_html += '<option value="'+c.category_id+'">-'+c.name[$app.lang.default()]+'</option>';
                                $.each(c.subcategories, function(is, s) {
                                    categories_html += '<option value="'+s.category_id+'">-'+s.name[$app.lang.default()]+'</option>';
                                });
                                categories_html += '</optgroup>';
                            }else{
                                categories_html += '<option value="'+c.category_id+'">'+c.name[$app.lang.default()]+'</option>';
                            }
                        }else{
                            categories_html += '<option value="'+c.category_id+'">'+c.name[$app.lang.default()]+'</option>';
                        }
                    });
                    $('.chosen.categories').html(categories_html);
                }

                $(".chosen").chosen({no_results_text: $app.lang.str('filter_no_results_text'), placeholder_text_multiple: $app.lang.str('filter_select'), placeholder_text: $app.lang.str('filter_select')});

                $('.background').each(function () {
                    var imagewrap = $(this);
                    var imagecurrent = $(this).find('img').attr('src');
                    imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                    $(this).find('img').remove();
                });

                setTimeout(function(){
                    var sprecial_posts = $app.posts.sprecial();
                    if (sprecial_posts) {
                        $('.specialads-data-items').html(sprecial_posts);
                        $('.specialads-header, .specialads-data').show();
                        $('.specialads-temp').hide();
                        var swiper = new Swiper('.specialads-data', {
                            slidesPerView: 'auto',
                            spaceBetween: 0,
                            loop: true,
                            autoplay: {
                                delay: 250000,
                                disableOnInteraction: false,
                            },
                            pagination: {
                                el: '.swiper-pagination',
                            },
                        });
                    }else{
                        $('.specialads-header, .specialads-temp').hide();
                    }
                    var simple_posts = $app.posts.simple();
                    if (simple_posts) {
                        $('.simpleads-data').html(simple_posts);
                        $('.simpleads-data').show();
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $('.error-content').hide();
                        $scroll_page = 1;
                        $loadmore = true;
                    }else{
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $app.sound('error');
                        $('.error-content').show();
                    }
                }, 1500);
            }
            $app.refresh();
        },

        bookmarks: function() {
            var data = $app.load.page('bookmarks');
            if ($app.content(data)) {
                $scroll_page = 1;
                $loadmore = true;
                shouldPull = true;
                if (localStorage['list_item']) {
                    var list_item = localStorage.getItem('list_item');
                    if (list_item=='grid') {
                        $('.simpleads-temp-grid').show();
                    }else{
                        $('.simpleads-temp-list').show();
                    }
                }else{
                    $('.simpleads-temp-list').show();
                }

                $('.background').each(function () {
                    var imagewrap = $(this);
                    var imagecurrent = $(this).find('img').attr('src');
                    imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                    $(this).find('img').remove();
                });
                if (localStorage['bookmark']) {
                    var bookmarks = localStorage.getItem('bookmark');
                    if ($app.controls.arraySize(JSON.parse(bookmarks)) > 0) {
                        setTimeout(function(){
                            var simple_posts = $app.posts.bookmarks();
                            if (simple_posts) {
                                $('.simpleads-data').html(simple_posts);
                                $('.simpleads-data').show();
                                $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                                $('.error-content').hide();
                                $scroll_page = 1;
                                $loadmore = true;
                            }else{
                                $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                                $('.error-content').show();
                            }
                        }, 1500);
                    }else{
                      $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $('.error-content').show();  
                    }
                    
                }else{
                    $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                    $('.error-content').show();
                }
            }
            $app.refresh();
        },

        news: function() {
            var data = $app.load.page('news');
            if ($app.content(data)) {
                $scroll_page = 1;
                $loadmore = true;
                shouldPull = true;
                if (localStorage['list_item']) {
                    var list_item = localStorage.getItem('list_item');
                    if (list_item=='grid') {
                        $('.simpleads-temp-grid').show();
                    }else{
                        $('.simpleads-temp-list').show();
                    }
                }else{
                    $('.simpleads-temp-list').show();
                }

                $('.background').each(function () {
                    var imagewrap = $(this);
                    var imagecurrent = $(this).find('img').attr('src');
                    imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                    $(this).find('img').remove();
                });
                setTimeout(function(){
                    $('#categories_modal select').html($app.news.categories());
                    var news = $app.news.list();
                    if (news) {
                        $('.simpleads-data').html(news);
                        $('.simpleads-data').show();
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $('.error-content').hide();
                        $scroll_page = 1;
                        $loadmore = true;
                    }else{
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $('.error-content').show();
                    }
                }, 1500);
            }
            $app.refresh();
        },

        intro: function(action) {
            if (action=='language') {
                var data = $app.load.page('intro/language', false);
                if ($app.content(data)) {
                    $tmp = $app.tmpl.parse('{% for (var i in languages_list) { %}<div class="col-auto text-center form-group float-label active"><a class="btn btn-lg btn-default btn-rounded shadow pointer" data-set-language="{%=i%}" href="/intro/main"><span class="px-3">{%=languages_list[i]%}</span><i class="material-icons">arrow_forward</i></a></div>{% } %}', languages_list);
                    $("[data-tmpl='language-list']").html($tmp);
                    $app.refresh();
                }
            }else if (action=='fields') {
                var data = $app.load.page('intro/fields', false);
                $app.content(data)
            }else if (action=='main') {
                var data = $app.load.page('intro/main', false);
                if ($app.content(data)) {
                    var swiper = new Swiper('.introduction', {
                        pagination: {
                            el: '.swiper-pagination',
                        },
                    });
                }
            }
        },
        ad: function(action,id) {
            if (action == undefined) {
                return false;
            }
            switch (action) {

                case 'view':
                    if (id ==undefined) {
                        return false;
                    }else{
                        var template = $app.load.page('single/view_ad', true);
                        fsp_history = 'main';
                        fsp_scroll = $(window).scrollTop();
                        if (template) {
                            var post = $app.api.posts({action: 'item', id: id, language: $app.lang.default()});
                            if (post) {
                                template = template.replace(/_id_/gi, post.post_id);
                                template = template.replace(/_date_/gi, post.created_at);
                                template = template.replace(/_title_/gi, post.title);
                                template = template.replace(/_category_/gi, post.category);
                                template = template.replace(/_address_/gi, post.address);
                                template = template.replace(/_visits_/gi, post.visits);
                                template = template.replace(/_onwer_/gi, post.contact_name);
                                template = template.replace(/_phone_/gi, post.phone);
                                template = template.replace(/_content_/gi, post.content);
                                template = template.replace(/_uniquekey_/gi, post.uniquekey);
                                var bookmark = $app.bookmark.in(post.post_id);
                                if (bookmark) {
                                    template = template.replace(/_bookmark_/gi, 'favorite');
                                }else{
                                    template = template.replace(/_bookmark_/gi, 'favorite_outline');
                                }
                                if (post.price == '' || post.price == 0) {
                                    template = template.replace(/_price_/gi, '');
                                }else{
                                    if (post.price_options.currency=='usd') {
                                        var currency = '$';
                                    }else if (post.price_options.currency=='sum') {
                                        var currency = 's';
                                    }else{
                                        var currency = '';
                                    }
                                    if (post.price_options.covenant=='1') {
                                        var covenant = '('+$app.lang.str('covenant')+')';
                                    }else{
                                        var covenant = '';
                                    }
                                    template = template.replace(/_price_/gi, '<i class="icon-tag text-warning md-18 vm"></i><span class="text-dark vm ml-2">'+post.price+''+currency+'</span> <span class="vm">'+covenant+'</span>');
                                }
                                var images = '';
                                $.each(post.image, function(i, f) {
                                    images += '<div class="swiper-slide"><img src="'+$app.api.image(f)+'" alt=""></div>';
                                });
                                template = template.replace(/_image_/gi, images);
                                var filters = '';
                                $.each(post.filter, function(i, a) {
                                    filters += '<div class="row col-12">\
                                                    <div class="col-5 mb-3">\
                                                        <p class="text-muted small">\
                                                            '+a.name+':\
                                                        </p>\
                                                    </div>\
                                                    <div class="col-7 mb-3 text-right">\
                                                        <p class="text-muted small">'+a.value+'</p>\
                                                    </div>\
                                                </div>';
                                });
                                template = template.replace(/_filter_/gi, filters);
                                $('html').css({ "overflow": "hidden"});
                                $( "body" ).append( template );
                                shouldPull = false;
                                $loadmore = false;
                                var swiper = new Swiper('.product-details ', {
                                    slidesPerView: 1,
                                    spaceBetween: 0,
                                    pagination: {
                                        el: '.swiper-pagination'
                                    }
                                });
                            }else{
                                sessionStorage.setItem('cur_route', '/'+fsp_history);
                                location.hash = '#'+fsp_history;
                                shouldPull = true;
                                $loadmore = true;
                                $(window).scrollTop(fsp_scroll);
                                $('html').css({ "overflow": ""});
                            }
                        }
                        return;
                    }
                break;

                default:
                    return false;
                break;
            }
        },
        news_view: function(id) {
            if (id ==undefined) {
                return false;
            }else{
                var template = $app.load.page('single/view_news', true);
                fsp_history = 'news';
                fsp_scroll = $(window).scrollTop();
                if (template) {
                    var news = $app.api.news({action: 'item', id: id, language: $app.lang.default()});
                    if (news) {
                        template = template.replace(/_id_/gi, news.id);
                        template = template.replace(/_date_/gi, news.date);
                        template = template.replace(/_title_/gi, news.title);
                        template = template.replace(/_category_/gi, news.category);
                        template = template.replace(/_content_/gi, news.content);
                        template = template.replace(/_uniquekey_/gi, news.slug);
                        template = template.replace(/_image_/gi, '<div class="swiper-slide"><img src="'+$app.api.image(news.image)+'" alt=""></div>');
                        $('html').css({ "overflow": "hidden"});
                        $( "body" ).append( template );
                        shouldPull = false;
                        $loadmore = false;
                    }else{
                        sessionStorage.setItem('cur_route', '/'+fsp_history);
                        location.hash = '#'+fsp_history;
                        shouldPull = true;
                        $loadmore = true;
                        $(window).scrollTop(fsp_scroll);
                        $('html').css({ "overflow": ""});
                    }
                }
                return;
            }
        },
        aboutus: function() {
            var data = $app.load.page('aboutus');
            if ($app.content(data)) {
                $('.about-content, error-content').hide();
                $('.loader-content').show();
                setTimeout(function(){
                    var aboutus = $app.api.pages('about');
                    if (aboutus) {
                        $('.about-site-title').html($app.lang.str('about_project'));
                        $('.about-site-text').html(aboutus.site.text);
                        $('.about-site-image').attr('src', $app.api.image(aboutus.site.image));

                        $('.about-advertisement-title').html($app.lang.str('adversitement'));
                        $('.about-advertisement-text').html(aboutus.advertisement.text);
                        $('.about-advertisement-image').attr('src', $app.api.image(aboutus.advertisement.image));

                        $('.about-stats-allads').html(aboutus.stats.allads+'+');
                        $('.about-stats-activeads').html(aboutus.stats.activeads+'+');
                        $('.about-stats-allusers').html(aboutus.stats.allusers+'+');
                        $('.about-stats-dailyusers').html(aboutus.stats.dailyusers+'+');

                        var pricing = '';
                        $.each(aboutus.pricing, function(i, pr) {
                            if (pr.featured == 'featured') {
                                var featured = "bg-default";
                            }else{
                                var featured = "bg-warning";
                            }
                            var content = '';
                            $.each(pr.content, function(i, pc) {
                                content += '<li>'+pc+'</li>';
                            });
                            pricing += '<div class="col-12 col-md-6 col-lg-4 about-pricing"><div class="card mb-4 shadow-sm border-0">\
                                            <div class="card-header text-white '+featured+'">\
                                                <h4 class="my-0 font-weight-normal">'+pr.name+'</h4>\
                                            </div>\
                                            <div class="card-body">\
                                                <h1 class="card-title pricing-card-title"><small class="text-muted">'+pr.price+'</small></h1>\
                                                <ul class="list-unstyled mt-3 mb-4">\
                                                    '+content+'\
                                                </ul>\
                                            </div>\
                                        </div></div>';
                        });
                        $('.about-pricing').html(pricing);
                        
                        var partners = '';
                        $.each(aboutus.partners, function(i, pt) {
                            partners += '<div class="swiper-slide"><div class="card shadow border-0 bg-white text-white" partner-url="'+pt.url+'" partner-name="'+pt.name+'">\
                                            <figure class="background aboutus-figure">\
                                                <img src="'+$app.api.image(pt.image)+'" alt="">\
                                            </figure>\
                                            <div class="card-body" style="visibility: hidden;">\
                                                <h5 class="small">'+pt.image+'</h5>\
                                                <p class="text-mute small">By Anand Mangal</p>\
                                            </div>\
                                        </div></div>';
                        });
                        $('.about-partners').html(partners);
                        var swiper = new Swiper('.news-slide', {
                            slidesPerView: 5,
                            spaceBetween: 0,
                            loop: true,
                            pagination: {
                                el: '.swiper-pagination',
                            },
                            breakpoints: {
                                1024: {
                                    slidesPerView: 4,
                                    spaceBetween: 0,
                                },
                                768: {
                                    slidesPerView: 3,
                                    spaceBetween: 0,
                                },
                                640: {
                                    slidesPerView: 2,
                                    spaceBetween: 0,
                                },
                                320: {
                                    slidesPerView: 2,
                                    spaceBetween: 0,
                                }
                            }
                        });

                        $('#contactinfo_modal .number').html('<i class="icon-phone"></i> '+aboutus.contact.number);
                        $('#contactinfo_modal .email').html('<i class="icon-envelope"></i> '+aboutus.contact.email);
                        $('#contactinfo_modal .telegram').html('<i class="icon-paper-plane"></i> '+aboutus.contact.telegram);
                        $('#contactinfo_modal .address').html('<i class="icon-location-pin"></i> '+aboutus.contact.address);

                        if (localStorage['user_info']) {
                           var user_info = localStorage.getItem('user_info');
                           user_info = JSON.parse(user_info);
                           $("#contact_modal [name='contact_phone']").val(user_info.phonenumber);
                           $("#contact_modal [name='contact_name']").val(user_info.fullname);
                           $("#contact_modal [name='contact_phone'], #contact_modal [name='contact_name']").parent().addClass('active');
                        }

                        $('.background').each(function () {
                            var imagewrap = $(this);
                            var imagecurrent = $(this).find('img').attr('src');
                            imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                            $(this).find('img').remove();
                        });

                        $('.loader-content, .error-content').hide();
                        $('.about-content').show();
                        $app.refresh();
                        $scroll_page = 1;
                        $loadmore = true;
                    }else{
                        $('.loader-content, .about-content').hide();
                        $('.error-content').show();
                    }
                }, 1500);
            }
        },
        aboutapp: function() {
            $('#about_app').modal('show');
        },
        settings: function() {
            var data = $app.load.page('settings');
            if ($app.content(data)) {
                $tmp = $app.tmpl.parse('{% for (var i in languages_list) { %}<div class="col-auto text-center form-group"><button class="btn btn-lg btn-secondary btn-rounded shadow pointer" settings="language" settings-val="{%=i%}"><span class="px-3">{%=languages_list[i]%}</span><i class="material-icons">arrow_forward</i></button></div>{% } %}', languages_list);
                $("[data-tmpl='language-list']").html($tmp);
                if ($app.config.get('nightmode')=='enabled') {
                    $('#nightmode_switch').prop('checked', true);
                }else{
                    $('#nightmode_switch').prop('checked', false);
                }
                if ($app.config.get('notification')=='disabled') {
                    $('#notification_switch').prop('checked', false);
                }else{
                    $('#notification_switch').prop('checked', true);
                }
                if ($app.config.get('vibration')=='disabled') {
                    $('#vibro_switch').prop('checked', false);
                }else{
                    $('#vibro_switch').prop('checked', true);
                }
                if ($app.config.get('audio')=='disabled') {
                    $('#audio_switch').prop('checked', false);
                }else{
                    $('#audio_switch').prop('checked', true);
                }
                if ($app.config.get('trafic')=='enabled') {
                    $('#trafic_switch').prop('checked', true);
                }else{
                    $('#trafic_switch').prop('checked', false);
                }
                if ($app.config.get('list_item')=='grid') {
                    $("[settings='list_item']").removeClass('text-warning').removeClass('text-secondary');
                    $("[settings='list_item']").addClass('text-secondary');
                    $("[settings-val='grid']").addClass('text-warning');
                }else{
                    $("[settings='list_item']").removeClass('text-warning').removeClass('text-secondary');
                    $("[settings='list_item']").addClass('text-secondary');
                    $("[settings-val='list']").addClass('text-warning');
                }
                if (localStorage['user_info']) {
                    var user_info = localStorage.getItem('user_info');
                    user_info = JSON.parse(user_info);
                    $('#user_info_modal #fullname').val(user_info.fullname);
                    $('#user_info_modal #address').val(user_info.address);
                    $('#user_info_modal #phonenumber').val(user_info.phonenumber);
                    $('#user_info_modal #emailortelegram').val(user_info.emailortelegram);
                }
                $app.refresh();
            }
        },
        postad: function() {
            var data = $app.load.page('postad');
            if ($app.content(data)) {
                var rules = $app.api.pages('rules');
                $.each(rules, function(i, r) {
                    $('#reglament .modal-body ul').append('<li class="mt-1">'+r+'</li>');
                });
                var pricing = $app.api.pages('pricing');
                $.each(pricing, function(i, p) {
                    $("#postad [name='service_type']").append('<option value="'+p.id+'">'+p.name+' ('+p.price+')</option>');
                });
                $('.dropify').dropify({
                    messages: {
                        default: $app.lang.str('dropify_default'),
                        replace: $app.lang.str('dropify_replace'),
                        remove:  $app.lang.str('dropify_remove'),
                        error:   $app.lang.str('dropify_error')
                    }
                });

                var categories = $app.api.categories('list');
                var categories_html = '<option value="null">'+$app.lang.str('all_items')+'</option>';
                if (categories) {
                    $.each(categories, function(i, c) {
                        if ($app.controls.arraySize(c.subcategories) > 0) {
                            if (c.subcategories) {
                                categories_html += '<optgroup label="'+c.name[$app.lang.default()]+'">';
                                categories_html += '<option value="'+c.category_id+'">-'+c.name[$app.lang.default()]+'</option>';
                                $.each(c.subcategories, function(is, s) {
                                    categories_html += '<option value="'+s.category_id+'">-'+s.name[$app.lang.default()]+'</option>';
                                });
                                categories_html += '</optgroup>';
                            }else{
                                categories_html += '<option value="'+c.category_id+'">'+c.name[$app.lang.default()]+'</option>';
                            }
                        }else{
                            categories_html += '<option value="'+c.category_id+'">'+c.name[$app.lang.default()]+'</option>';
                        }
                    });
                    $("#postad [name='category']").html(categories_html);
                }
                if (localStorage['user_info']) {
                    var user_info = localStorage.getItem('user_info');
                    user_info = JSON.parse(user_info);
                    $("#postad [name='onwer_name']").val(user_info.fullname);
                    $("#postad [name='onwer_address']").val(user_info.address);
                    $("#postad [name='onwer_phone']").val(user_info.phonenumber);
                    $("#postad [name='onwer_email']").val(user_info.emailortelegram);
                }
            }
        },

    }
    function Language(lang) {
        var __construct = function() {
            if (languages[lang] == 'undefined')
            {
                lang = "uzbek_lt";
            }
            return;
        }()

        this.getStr = function(str, defaultStr) {
            var retStr = languages[lang][str];
            if (typeof retStr != 'undefined')
            {
                return retStr;
            } else {
                return str.replace(/_/g, " ");
            }
        }
    }

    $app = {
        routes: function() {
            Router.init();
       
            let handler = event =>  {
                if (event.currentTarget.href !== '') {
                    let url = new URL(event.currentTarget.href);
                    Router.dispatch(url.pathname);
                }
                event.preventDefault();
            }

            let anchors = document.querySelectorAll('a');
       
            for( let anchor of anchors ) anchor.onclick = handler;
        },
        start: function() {
            $app.online();
            $app.lang.parse();
            $app.routes();
            if(window.location.hash) {
                var hash = window.location.hash.replace(/#/g, "/");
                if (hash == '/single/view_ad') {
                    Router.dispatch('/');
                }else if (hash == '/single/view_news') {
                    Router.dispatch('/news');
                }else{
                    Router.dispatch(hash);
                }
                
            } else {
                Router.dispatch('/');
            }
        },
        refresh: function() {
            $app.lang.parse();
            $app.routes();
            if ($app.config.get('nightmode') == 'enabled') {
                $('.wrapper .header img').attr('src', 'vendor/img/menu-white.png'); 
            }else{
                $('.wrapper .header img').attr('src', 'vendor/img/menu.png'); 
            }
        },
        online: function() {
            if (navigator.onLine) {
                //$app.api.settings('update_list');
            }
        },
        home: function() {
            if ($app.config.get('introduction') == false) {
                return '/intro/language';
            }else{
                return '/main';
            }
        },
        content: function(data) {
            $root.html(data);
            $app.refresh();
            return true;
        },
        vibrate: function(data) {
            if ($app.config.get('vibration')=='disabled') {
                return false;
            }
            if (typeof data == 'undefined') {
                data = [100];
            }
            if("vibrate" in navigator)  return navigator.vibrate(data);
            if("oVibrate" in navigator)  return navigator.oVibrate(data);
            if("mozVibrate" in navigator)  return navigator.mozVibrate(data);
            if("webkitVibrate" in navigator)  return navigator.webkitVibrate(data);
        },
        sound: function(data) {
            if ($app.config.get('audio')=='disabled') {
                return false;
            }
            if (typeof data !== 'undefined') {
                var audio = new Audio('vendor/sound/'+data+'.mp3');
                audio.play();
            }
        }
    };

    $app.lang = {
        default: function(lang) {
            if (typeof lang == 'undefined'){
                if ($app.config.get('language')) {
                    return  $app.config.get('language');
                }else{
                    return 'uzbek_lt';
                }
            }else{
                $app.config.set('language', lang);
                return lang;
            }
        },
        str: function(str) {
            item = languages[$app.lang.default()][str];
            if (typeof item == 'undefined'){
                return str.replace(/_/g, " ");
            }else{
                return item;
            }
        },
        parse: function(str) {
            if (typeof $root == 'undefined') {
                var $root = 'html'
            }
            $( $root+" [lang]" ).each(function( index ) {
                
                var key = $( this ).attr( 'lang' );
                var str = $app.lang.str( key );
                var elem = $( this );
                
                if ( this.nodeName === 'INPUT' ) {
                
                    if ( this.nodeType === 1 && this.hasAttribute('placeholder') ) {
                
                        this.setAttribute("placeholder", str);
                
                    }
                
                    if ( this.nodeType === 1 && this.hasAttribute('title') ) {
                
                        this.setAttribute("title", str);
                
                    }
                
                }else{
                
                    $( this ).html( str );
                
                }

                $app.routes();

            });
        },
    };

    $app.controls = {
        arraySize: function(obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        },
        notify: function function_name(data) {
            if ($app.config.get('notification')=='disabled') {
                return false;
            }
            //$app.controls.notify({status:"primary",icon:"fullscreen",head:"",text:""});
            var status = 'primary';
            var icon = 'icon';
            var heading = 'Viewing in Phone?';
            var text = 'Double tap to enter into fullscreen mode for each page.';
            var template = '<div class="notification bg-white shadow {%=o.position%} border-{%=o.status%}">\
                                <div class="row">\
                                    <div class="col-auto align-self-center pr-0">\
                                        <i class="icon-{%=o.icon%} text-{%=o.status%} md-36"></i>\
                                    </div>\
                                    <div class="col">\
                                        <h6>{%=o.head%}</h6>\
                                        <p class="mb-0 text-secondary">{%=o.text%}</p>\
                                    </div>\
                                    <div class="col-auto align-self-center pl-0">\
                                        <button class="btn btn-link closenotification"><i class="material-icons text-secondary text-mute md-18 ">close</i></button>\
                                    </div>\
                                </div>\
                            </div>';
            var result = tmpl(template, data);
            $( "body" ).append( result );
            $app.vibrate([200,100,300,100]);
            $app.sound('notify');
            setTimeout(function() {
                $('.notification').addClass('active');
                setTimeout(function() {
                    $('.notification').remove();
                }, 5000);
            }, 10);
            return result;
        },
        filter_options: function (data, key, attr) {
            if (data == undefined && key == undefined){
                return "";
            }else{
                var temp_array = new Array();
                var set = data.split(/(\r\n|\n|\r)/);
                for (var i in set) {
                    if (set[i].length > 2) {
                        var row = set[i].split("|");
                        temp_array[row[0]] = row[1];
                    }
                    
                }
                var result = temp_array[key];
                if (result==undefined) {
                    return "";
                }else{
                    if (attr == true) {
                        return key+'="'+result+'"';
                    }else{
                        return result;
                    }
                }
                return set;
            }
        },
        isOnScreen: function(elem) {
            if( elem.length == 0 ) {
                return;
            }
            var $window = $(window);
            var viewport_top = $window.scrollTop();
            var viewport_height = $window.height();
            var viewport_bottom = viewport_top + viewport_height;
            var $elem = $(elem);
            var top = $elem.offset().top;
            var height = $elem.height();
            var bottom = top + height;

            return (top >= viewport_top && top < viewport_bottom) ||
                    (bottom > viewport_top && bottom <= viewport_bottom) ||
                    (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }
    $app.config = {
        set: function( key , value ) {
            if ( key.length > 0 && value.length > 0 ) {
                localStorage.setItem(key, value);
                return value;
            }else{
                
                return false;
            
            }
        },
        remove: function( key ) {
            if ( key ) {
                
                localStorage.removeItem( key );
                
                return true;
            
            }else{
                
                return false;
            
            }
        },
        get: function( key ) {
            if ( key ) {
                if (localStorage[key]) {
                    return localStorage.getItem(key);
                }else{
                    return false;
                }
            }else{
            
                return false;
            
            }
        },
    }

    $app.load = {
        page: function( name, push ) {
            if (typeof push == 'undefined'){
                var push = true;
            }
            if (typeof name == 'undefined') {
                
                return false;
            
            }else{
                var res='';
                $.ajax({
                    type : 'GET',
                    url : 'templates/'+name+'.page',
                    dataType : 'html',
                    cache : false,
                    async: false,
                    success : function(data) {
                        if (push) {
                            history.pushState({}, null, '#'+name);
                        }
                        res = data;
                    },
                    error : function () {
                        res = false;
                    }
                });
                return res;
            
            }
        }
    }
    $app.posts = {
        sprecial: function() {
            var query = $app.posts.query();
            query['position'] = 'featured';
            query['limit'] = '12';
            query['sort'] = 'rand';
            var posts = $app.api.posts(query);
            if (posts) {
                var posts_featured = $app.load.page('single/featuredb', false);
                var posts_premium = $app.load.page('single/premiumb', false);
                var posts_default = $app.load.page('single/defaultb', false);
                var posts_html = '';

                $.each( posts, function( k, p ) {
                    if (p.position == 'main') {
                        var posts_premium_temp = posts_premium;
                    }else if (p.position == 'featured') {
                        var posts_premium_temp = posts_featured;
                    }else{
                        var posts_premium_temp = posts_default;
                    }
                    if (p.price == '' || p.price == 0) {
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '&nbsp;');
                    }else{
                        if (p.price_options.currency=='usd') {
                            var currency = '$';
                        }else if (p.price_options.currency=='sum') {
                            var currency = 's';
                        }else{
                            var currency = '';
                        }
                        if (p.price_options.covenant=='1') {
                            var covenant = '('+$app.lang.str('covenant')+')';
                        }else{
                            var covenant = '';
                        }
                        var price = p.price.split(',');
                        if (p.price==0) {
                            price = '';
                        }else if(price.length == 2){
                            price = price[0]+'<sup>.'+price[1]+currency+'</sup>';
                        }else if(price.length == 3){
                            price = price[0]+'<sup>.'+price[1]+' '+price[2]+currency+'</sup>';
                        }
                        else if(price.length == 4){
                            price = price[0]+','+price[1]+'<sup>.'+price[2]+' '+price[3]+currency+'</sup>';
                        }
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '<i class="icon-tag icons grid-price"></i> '+price);
                    }
                    var bookmark = $app.bookmark.in(p.post_id);
                    if (bookmark) {
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite');
                    }else{
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite_outline');
                    }
                    posts_premium_temp = posts_premium_temp.replace(/_id_/gi, p.post_id);
                    posts_premium_temp = posts_premium_temp.replace(/_image_/gi, $app.api.image(p.image));
                    posts_premium_temp = posts_premium_temp.replace(/_date_/gi, p.created_at);
                    posts_premium_temp = posts_premium_temp.replace(/_title_/gi, p.title);
                    posts_premium_temp = posts_premium_temp.replace(/_category_/gi, p.category);
                    posts_premium_temp = posts_html += posts_premium_temp;
                });

               return posts_html;
            }else{
                return false;
            }
        },
        simple: function() {
            var query = $app.posts.query();
            query['from'] = $scroll_page;
            var posts = $app.api.posts(query);
            if (posts) {
                var posts_featured_grid = $app.load.page('single/featuredb', false);
                var posts_premium_grid = $app.load.page('single/premiumb', false);
                var posts_default_grid = $app.load.page('single/defaultb', false);

                var posts_featured_list = $app.load.page('single/featuredl', false);
                var posts_premium_list = $app.load.page('single/premiuml', false);
                var posts_default_list = $app.load.page('single/defaultl', false);
                var posts_html = '';

                $.each( posts, function( k, p ) {
                    if (localStorage['list_item']) {
                        var list_item = localStorage.getItem('list_item');
                        if (list_item=='grid') {
                            if (p.position == 'main') {
                                var posts_premium_temp = posts_premium_grid;
                            }else if (p.position == 'featured') {
                                var posts_premium_temp = posts_featured_grid;
                            }else{
                                var posts_premium_temp = posts_default_grid;
                            }
                        }else{
                            if (p.position == 'main') {
                                var posts_premium_temp = posts_premium_list;
                            }else if (p.position == 'featured') {
                                var posts_premium_temp = posts_featured_list;
                            }else{
                                var posts_premium_temp = posts_default_list;
                            }
                        }
                    }else{
                        if (p.position == 'main') {
                            var posts_premium_temp = posts_premium_list;
                        }else if (p.position == 'featured') {
                            var posts_premium_temp = posts_featured_list;
                        }else{
                            var posts_premium_temp = posts_default_list;
                        }
                    }

                    if (p.price == '' || p.price == 0) {
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '&nbsp;');
                    }else{
                        if (p.price_options.currency=='usd') {
                            var currency = '$';
                        }else if (p.price_options.currency=='sum') {
                            var currency = 's';
                        }else{
                            var currency = '';
                        }
                        if (p.price_options.covenant=='1') {
                            var covenant = '('+$app.lang.str('covenant')+')';
                        }else{
                            var covenant = '';
                        }
                        var price = p.price.split(',');
                        if (p.price==0) {
                            price = '';
                        }else if(price.length == 2){
                            price = price[0]+'<sup>.'+price[1]+currency+'</sup>';
                        }else if(price.length == 3){
                            price = price[0]+'<sup>.'+price[1]+' '+price[2]+currency+'</sup>';
                        }
                        else if(price.length == 4){
                            price = price[0]+','+price[1]+'<sup>.'+price[2]+' '+price[3]+currency+'</sup>';
                        }
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '<i class="icon-tag icons grid-price"></i> '+price);
                    }
                    var bookmark = $app.bookmark.in(p.post_id);
                    if (bookmark) {
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite');
                    }else{
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite_outline');
                    }
                    posts_premium_temp = posts_premium_temp.replace(/_id_/gi, p.post_id);
                    posts_premium_temp = posts_premium_temp.replace(/_image_/gi, $app.api.image(p.image));
                    posts_premium_temp = posts_premium_temp.replace(/_date_/gi, p.created_at);
                    posts_premium_temp = posts_premium_temp.replace(/_title_/gi, p.title);
                    posts_premium_temp = posts_premium_temp.replace(/_category_/gi, p.category);
                    posts_premium_temp = posts_premium_temp.replace(/_address_/gi, p.address);
                    posts_premium_temp = posts_html += posts_premium_temp;
                });

               return posts_html;
            }else{
                return false;
            }
        },
        bookmarks: function() {
            var query = {};
            query['language'] = $app.lang.default();
            query['action'] = 'bookmarks';
            if (localStorage['bookmark']) {
                var bookmarks = localStorage.getItem('bookmark');
                query['bookmarks'] = JSON.parse(bookmarks);
            }else{
                query['bookmarks'] = {};
            }
            var posts = $app.api.posts(query);
            if (posts) {
                var posts_featured_grid = $app.load.page('single/featuredb', false);
                var posts_premium_grid = $app.load.page('single/premiumb', false);
                var posts_default_grid = $app.load.page('single/defaultb', false);

                var posts_featured_list = $app.load.page('single/featuredl', false);
                var posts_premium_list = $app.load.page('single/premiuml', false);
                var posts_default_list = $app.load.page('single/defaultl', false);
                var posts_html = '';
                $.each( Object.assign([], posts).reverse(), function( k, p ) {
                    if (localStorage['list_item']) {
                        var list_item = localStorage.getItem('list_item');
                        if (list_item=='grid') {
                            if (p.position == 'main') {
                                var posts_premium_temp = posts_premium_grid;
                            }else if (p.position == 'featured') {
                                var posts_premium_temp = posts_featured_grid;
                            }else{
                                var posts_premium_temp = posts_default_grid;
                            }
                        }else{
                            if (p.position == 'main') {
                                var posts_premium_temp = posts_premium_list;
                            }else if (p.position == 'featured') {
                                var posts_premium_temp = posts_featured_list;
                            }else{
                                var posts_premium_temp = posts_default_list;
                            }
                        }
                    }else{
                        if (p.position == 'main') {
                            var posts_premium_temp = posts_premium_list;
                        }else if (p.position == 'featured') {
                            var posts_premium_temp = posts_featured_list;
                        }else{
                            var posts_premium_temp = posts_default_list;
                        }
                    }

                    if (p.price == '' || p.price == 0) {
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '&nbsp;');
                    }else{
                        if (p.price_options.currency=='usd') {
                            var currency = '$';
                        }else if (p.price_options.currency=='sum') {
                            var currency = 's';
                        }else{
                            var currency = '';
                        }
                        if (p.price_options.covenant=='1') {
                            var covenant = '('+$app.lang.str('covenant')+')';
                        }else{
                            var covenant = '';
                        }
                        var price = p.price.split(',');
                        if (p.price==0) {
                            price = '';
                        }else if(price.length == 2){
                            price = price[0]+'<sup>.'+price[1]+currency+'</sup>';
                        }else if(price.length == 3){
                            price = price[0]+'<sup>.'+price[1]+' '+price[2]+currency+'</sup>';
                        }
                        else if(price.length == 4){
                            price = price[0]+','+price[1]+'<sup>.'+price[2]+' '+price[3]+currency+'</sup>';
                        }
                        posts_premium_temp = posts_premium_temp.replace(/_price_/gi, '<i class="icon-tag icons grid-price"></i> '+price);
                    }
                    var bookmark = $app.bookmark.in(p.post_id);
                    if (bookmark) {
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite');
                    }else{
                        posts_premium_temp = posts_premium_temp.replace(/_bookmark_/gi, 'favorite_outline');
                    }
                    posts_premium_temp = posts_premium_temp.replace(/_id_/gi, p.post_id);
                    posts_premium_temp = posts_premium_temp.replace(/_image_/gi, $app.api.image(p.image));
                    posts_premium_temp = posts_premium_temp.replace(/_date_/gi, p.created_at);
                    posts_premium_temp = posts_premium_temp.replace(/_title_/gi, p.title);
                    posts_premium_temp = posts_premium_temp.replace(/_category_/gi, p.category);
                    posts_premium_temp = posts_premium_temp.replace(/_address_/gi, p.address);
                    posts_premium_temp = posts_html += posts_premium_temp;
                });

               return posts_html;
            }else{
                return false;
            }
        },
        query: function() {
            var query = {};
            query['language'] = $app.lang.default();
            query['action'] = 'list';
            var search = $(".header input[type='search']").val();
            if (search != '') {
                query['query'] = search;
            }
            var category = $(".filter .categories").val();
            if (category != '' && category != '0' && category != 'null') {
                query['category'] = category;
            }
            var min = $(".filter .min").val();
            if (min != '' && min != '0' && min != 'null') {
                query['min'] = min;
            }
            var max = $(".filter .max").val();
            if (max != '' && max != '0' && max != 'null' &&  max != '10000000') {
                query['max'] = max;
            }
            var filter = $( ".filter [name^='filter']" );
            filter.each(function() {
                if ($(this).val() != '' && $(this).val() != 'null') {
                    query[$(this).attr('name')] = $(this).val();
                }
            });
            return query;
        },
        loadMore: function(page) {
            $('.loader-indicator').show();
            var simple_posts = $app.posts.simple();
            if (simple_posts) {
                if (localStorage['list_item']) {
                    var list_item = localStorage.getItem('list_item');
                    if (list_item=='grid') {
                        $('.simpleads-temp-grid').show();
                    }else{
                        $('.simpleads-temp-list').show();
                    }
                }else{
                    $('.simpleads-temp-list').show();
                }
                setTimeout(function(){
                    $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                    $('.simpleads-data .post-item:last').after(simple_posts);
                    $('.loader-indicator').hide();
                    $('.error-content').hide();
                    $loadmore = true;
                }, 1500);

            }else{
                $loadmore = false;
                $app.vibrate([200,100,300,100]);
                $app.sound('end');
                $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                setTimeout(function(){
                    $('.loader-indicator').hide();
                    $('.error-content').hide();
                }, 1500);

                var cont = $("body");
                var el = $('.simpleads-data .post-item:last');
                var h = cont.height() / 2;
                var elementTop = el.position().top;
                var pos = cont.scrollTop() + elementTop - h;
                cont.animate({scrollTop: pos}, 1000);
            }
        }, 
        filter: function () {
            $scroll_page = 1;
            $loadmore = true;
            if (localStorage['list_item']) {
                var list_item = localStorage.getItem('list_item');
                if (list_item=='grid') {
                    $('.specialads-header, .specialads-temp, .simpleads-temp-grid').show();
                }else{
                    $('.specialads-header, .specialads-temp, .simpleads-temp-list').show();
                }
            }else{
                $('.specialads-header, .specialads-temp, .simpleads-temp-list').show();
            }
            $('.specialads-data-items, .simpleads-data').html('');
            $('.specialads-header, .specialads-data, .simpleads-data').hide();
            $('.specialads-temp, .specialads-temp, .specialads-header').show();
            var swiper = new Swiper('.specialads-temp', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                loop: true,
                autoplay: {
                    delay: 250000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
            });
            var swiper = new Swiper('.small-slide', {
                slidesPerView: 'auto',
                spaceBetween: 0,
            });
            $('.background').each(function () {
                var imagewrap = $(this);
                var imagecurrent = $(this).find('img').attr('src');
                imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                $(this).find('img').remove();
            });

            setTimeout(function(){
                var sprecial_posts = $app.posts.sprecial();
                if (sprecial_posts) {
                    $('.specialads-data-items').html(sprecial_posts);
                    $('.specialads-header, .specialads-data').show();
                    $('.specialads-temp').hide();
                    $('.error-content').hide();
                    var swiper = new Swiper('.specialads-data', {
                        slidesPerView: 'auto',
                        spaceBetween: 0,
                        loop: true,
                        autoplay: {
                            delay: 250000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                        },
                    });
                }else{
                    $('.specialads-header, .specialads-temp').hide();
                }
                var simple_posts = $app.posts.simple();
                if (simple_posts) {
                    $('.simpleads-data').html(simple_posts);
                    $('.simpleads-data').show();
                    $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                    $scroll_page = 1;
                    $loadmore = true;
                }else{
                    if ($('.simpleads-data .post-item').length == 0) {
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $app.sound('error');
                        $('.error-content').show();
                    }else{
                        $('.error-content').hide();
                    }
                }
            }, 1500);
            $app.refresh();
                    
        },
    }
    $app.news = {
        categories: function() {
            var query = {};
            query['action'] = 'categories';
            query['language'] = $app.lang.default();
            var categories = $app.api.news(query);
            if (categories) {
                var html = '<option value="0">'+$app.lang.str('filter_select')+'</option>';
                $.each( categories, function( k, c ) {
                    html += '<option value="'+c.id+'">'+c.name+'</option>';
                });

               return html;
            }else{
                return false;
            }
        },
        list: function() {
            var query = $app.news.query();
            query['from'] = $scroll_page;
            var news = $app.api.news(query);
            if (news) {
                var grid = $app.load.page('single/newsb', false);
                var list = $app.load.page('single/newsl', false);
                
                var news_html = '';

                $.each( news, function( k, n ) {
                    if (localStorage['list_item']) {
                        var list_item = localStorage.getItem('list_item');
                        if (list_item=='grid') {
                            var news_temp = grid;
                        }else{
                            var news_temp = list;
                        }
                    }else{
                        var news_temp = list;
                    }

                    news_temp = news_temp.replace(/_id_/gi, n.id);
                    news_temp = news_temp.replace(/_image_/gi, $app.api.image(n.image));
                    news_temp = news_temp.replace(/_date_/gi, n.date);
                    news_temp = news_temp.replace(/_title_/gi, n.title);
                    news_temp = news_temp.replace(/_category_/gi, n.category);
                    news_html += news_temp;
                });

               return news_html;
            }else{
                return false;
            }
        },
        query: function() {
            var query = {};
            query['language'] = $app.lang.default();
            query['action'] = 'list';
            var category = $("#categories_modal select").val();
            if (category != '' && category != '0' && category != 'null') {
                query['category'] = category;
            }
            return query;
        },
        filter: function () {
            $scroll_page = 1;
            $loadmore = true;
            if (localStorage['list_item']) {
                var list_item = localStorage.getItem('list_item');
                if (list_item=='grid') {
                    $('.simpleads-temp-grid').show();
                }else{
                    $('.simpleads-temp-list').show();
                }
            }else{
                $('.simpleads-temp-list').show();
            }
            $('.simpleads-data').html('');
            $('.simpleads-data').hide();

            $('.background').each(function () {
                var imagewrap = $(this);
                var imagecurrent = $(this).find('img').attr('src');
                imagewrap.css('background-image', 'url("' + imagecurrent + '")');
                $(this).find('img').remove();
            });

            setTimeout(function(){
                var news = $app.news.list();
                if (news) {
                    $('.simpleads-data').html(news);
                    $('.simpleads-data').show();
                    $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                    $scroll_page = 1;
                    $loadmore = true;
                }else{
                    if ($('.simpleads-data .post-item').length == 0) {
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $app.sound('error');
                        $('.error-content').show();
                    }else{
                        $('.error-content').hide();
                    }
                }
            }, 1500);
            $app.refresh();
                    
        },
        loadMore: function(page) {
            $('.loader-indicator').show();
            var news = $app.news.list();
            if (news) {
                if (localStorage['list_item']) {
                    var list_item = localStorage.getItem('list_item');
                    if (list_item=='grid') {
                        $('.simpleads-temp-grid').show();
                    }else{
                        $('.simpleads-temp-list').show();
                    }
                }else{
                    $('.simpleads-temp-list').show();
                }
                setTimeout(function(){
                    $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                    $('.simpleads-data .post-item:last').after(news);
                    $('.loader-indicator').hide();
                    $('.error-content').hide();
                    $loadmore = true;
                }, 1500);

            }else{
                $loadmore = false;
                $app.vibrate([200,100,300,100]);
                $app.sound('end');
                $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                setTimeout(function(){
                    $('.loader-indicator').hide();
                    $('.error-content').hide();
                }, 1500);
                var cont = $("body");
                var el = $('.simpleads-data .post-item:last');
                var h = cont.height() / 2;
                var elementTop = el.position().top;
                var pos = cont.scrollTop() + elementTop - h;
                cont.animate({scrollTop: pos}, 1000);
            }
        }, 
    }
    $app.bookmark = {
        in: function (i) {
            if ( localStorage["bookmark"] ) {
                var bookmark = JSON.parse( localStorage["bookmark"] );
                if (bookmark.indexOf(i) == -1) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        },
        add: function (i) {
            if ( localStorage["bookmark"] ) {
                var bookmark = JSON.parse( localStorage["bookmark"] );
                bookmark.push(i);
                localStorage["bookmark"] = JSON.stringify(bookmark);
            } else {
                var bookmark = [];
                bookmark.push(i);
                localStorage["bookmark"] = JSON.stringify(bookmark);
            }
            $app.sound('add');
            $app.controls.notify({status:"success",icon:"check",position:"top",head:"",text:$app.lang.str('bookmark_added')});
            return true;
        },
        remove: function(i) {
            var bookmark = JSON.parse( localStorage["bookmark"] );
            bookmark = bookmark.filter(function(x){ return x != i });
            localStorage["bookmark"] = JSON.stringify(bookmark);
            $app.sound('remove');
            $app.controls.notify({status:"danger",icon:"check",position:"top",head:"",text:$app.lang.str('bookmark_removed')});
            return true;
        }

    }
    $app.api = {
        settings: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'update_list':
                    var responce = $app.api.get('settings', {action: "list"});

                    if (responce !== false) {
                        $app.config.set('api_settings', JSON.stringify(responce));
                    }

                    return responce;
                break;

                case 'list':
                    if (localStorage['api_settings']) {
                        return JSON.parse($app.config.get('api_settings'));
                    }else{
                        var responce = $app.api.get('settings', {action: "list"});
                        if (responce !== false) {
                            $app.config.set('api_settings', JSON.stringify(responce));
                        }
                        return responce;
                    }
                break;

                case 'item':
                    if (localStorage['api_settings']) {
                        var responce = JSON.parse($app.config.get('api_settings'));
                        var item = responce[key];
                        if (typeof item == 'undefined'){
                            return false;
                        }else{
                            return item;
                        }
                    }else{
                        var responce = $app.api.get('settings', {action: "item", key: key});
                        if (!responce){
                            return false;
                        }else{
                            return item;
                        }
                    }
                break;

                default:
                    return false
                break;
            }
        },
        pages: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    var responce = $app.api.get('pages', {action: "list"});
                    return responce;
                break;

                case 'about':
                    var responce = $app.api.get('pages', {action: "about", language: $app.lang.default()});
                    return responce;
                break;

                case 'rules':
                    var responce = $app.api.get('pages', {action: "rules", language: $app.lang.default()});
                    return responce;
                break;

                case 'pricing':
                    var responce = $app.api.get('pages', {action: "pricing", language: $app.lang.default()});
                    return responce;
                break;

                case 'item':
                    var responce = $app.api.get('pages', {action: "list"});
                    var item = responce[key];
                    if (typeof item == 'undefined'){
                        return false;
                    }else{
                        return item;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        language: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    var responce = $app.api.get('language', {action: "list"});
                    return responce;
                break;

                case 'item':
                    var responce = $app.api.get('language', {action: "item", key: key, language: $app.lang.default()});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                case 'name':
                    var responce = $app.api.get('language', {action: "name", key: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        pricing: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    var responce = $app.api.get('pricing', {action: "list"});
                    return responce;
                break;

                case 'item':
                    var responce = $app.api.get('pricing', {action: "item", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        partners: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    var responce = $app.api.get('partners', {action: "list"});
                    return responce;
                break;

                case 'item':
                    var responce = $app.api.get('partners', {action: "item", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        filters: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    if (sessionStorage['filters']) {
                        return JSON.parse(sessionStorage.getItem('filters'));
                    }else{
                        var responce = $app.api.get('filters', {action: "list"});
                        if (responce !== false) {
                            sessionStorage.setItem('filters', JSON.stringify(responce));
                        }
                        return responce;
                    }
                break;

                case 'item':
                    var responce = $app.api.get('filters', {action: "item", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                case 'cat':
                    var responce = $app.api.get('filters', {action: "cat", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        categories: function( action, key ) {
            if (typeof action == 'undefined'){
                var action = 'default';
            }
            if (typeof key == 'undefined'){
                var key = 'default';
            }
            switch (action) {

                case 'list':
                    if (sessionStorage['categories']) {
                        return JSON.parse(sessionStorage.getItem('categories'));
                    }else{
                        var responce = $app.api.get('categories', {action: "list"});
                        if (responce !== false) {
                            sessionStorage.setItem('categories', JSON.stringify(responce));
                        }
                        return responce;
                    }
                break;

                case 'item':
                    var responce = $app.api.get('categories', {action: "item", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                case 'parent':
                    var responce = $app.api.get('categories', {action: "parent", id: key});
                    if (!responce){
                        return false;
                    }else{
                        return responce;
                    }
                break;

                default:
                    return false
                break;
            }
        },
        posts: function (data) {
            if (typeof data == 'undefined'){
                var data = {action:'list'};
            }
            var responce = $app.api.get('posts', data);
            return responce;
        },
        news: function (data) {
            if (typeof data == 'undefined'){
                var data = {action:'list'};
            }
            var responce = $app.api.get('news', data);
            return responce;
        },
        contact: function (data) {
            if (typeof data == 'undefined'){
                return false;
            }else{
                var responce = $app.api.get('contact', data);
                return responce;
            }
        },
        image: function (data) {
            if (typeof data == 'undefined'){
                data = 'noimage.png';
            }
            if ($app.config.get('trafic')=='enabled') {
                var quality = 20; 
            }else{
                var quality = 80;
            }
            var imagr_url = $api_server+'image?quality='+quality+'&file='+data;
            return imagr_url;
        },
        get: function (method, data) {
            var res='';
            $.ajax({
                type : 'GET',
                url : $api_server+method+'?'+$.param(data),
                dataType : 'html',
                cache : false,
                async: false,
                success : function(responce) {
                    responce = JSON.parse(responce);
                    if (responce.status == 'error') {
                        res = false;
                    }else{
                        res = responce.data;
                    }
                },
                error : function () {
                    res = false;
                    $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('connectionerror')});
                }
            });
            return res;
        }
    }
    $app.tmpl = {
        parse: function(str, data) {
            return tmpl(str, data);
        }
    }

    $app.start();
    window.addEventListener("popstate", function(e) {
        if ($('.fsp-wrapper').length) {
            $('.fsp-wrapper').addClass('fadeOutLeft animated faster').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $(this).removeClass('fadeOutLeft animated faster');
                $('.fsp-wrapper').remove();
                $('html').css({ "overflow": ""});
                shouldPull = true;
                $loadmore = true;
                sessionStorage.setItem('cur_route', '/'+fsp_history);
                location.hash = '#'+fsp_history;
                $(window).scrollTop(fsp_scroll);
                
            });
        }else{
            Router.dispatch(location.pathname);
        }
    });

    $(document).on('click', '[data-set-language]', function(e) {
        var lang = $(this).data('set-language');
        $app.lang.default(lang);
        $app.lang.parse();
    });

    $(document).on('click', '.closenotification', function(e) {
        $(this).closest('.notification').remove();
    });

    $(document).on('submit', '.profile-info', function(e) {
        e.preventDefault();
        var $this = $(this);
        var values = $this.serializeArray();
        var profileData = {};
        $.each( values, function( k, v ) {
            if (v.value !== "" && v.value !== 'null') {
                profileData[v.name] = v.value;
            }
        });
        var fullname = $(".profile-info [name='fullname']").val();
        var address = $(".profile-info [name='address']").val();
        var phonenumber = $(".profile-info [name='phonenumber']").val();
        var emailortelegram = $(".profile-info [name='emailortelegram']").val();
        if (fullname == "" || address == "" || phonenumber == "") {
            $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('fieldsempty')});
        }else{
            $app.config.set('user_info', JSON.stringify({fullname: fullname,address: address,phonenumber: phonenumber,emailortelegram: emailortelegram}));
            $app.config.set('introduction', 'yes');
            Router.dispatch('/main');
        }
    });

    $(document).on('submit', '#contact_form', function(e) {
        e.preventDefault();
        var $this = $(this);
        var values = $this.serializeArray();
        var error = 0;
        var name = $("#contact_modal [name='contact_name']").val();
        var email = $("#contact_modal [name='contact_phone']").val();
        var subject = $("#contact_modal [name='contact_subject']").val();
        var message = $("#contact_modal [name='contact_message']").val();
        if (name == "" || email == "" || subject == "" || message == "") {
            $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('fieldsempty')});
        }else{
            var contactData = {name: name, email: email, subject: subject, message: message};
            var response = $app.api.contact(contactData);
            if (response) {
                $app.sound('add');
                $app.controls.notify({status:"success",icon:"check",position:"top",head:"",text:$app.lang.str('message_send_successfull')});
                $("#contact_modal [name='contact_subject'], #contact_modal [name='contact_message']").val('').blur();
                $('#contact_modal').modal('hide');
            }else{
                $app.sound('error');
                $app.controls.notify({status:"danger",icon:"check",position:"top",head:"",text:$app.lang.str('message_send_error')});
            }
        }
    });

    $(document).on('submit', '#postad', function(e) {
        e.preventDefault();
        var $this = $(this);
        var res='';
        formData = new FormData($this.get(0));
        $.ajax({
            type: "POST",
            url: $api_server+'postad',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data)
            {
               data = JSON.parse(data);
               if (data.status == 'success') {
                    $app.sound('add');
                    $app.controls.notify({status:"success",icon:"check",position:"top",head:"",text:$app.lang.str('post_added')});
                    $this[0].reset();
                    var drEvent = $('.dropify').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
               }else if (data.status == 'error'){
                    $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('fieldsempty')});
               }else{
                    $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('connectionerror')});
               }
            },
            error: function(data)
            {
                $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('connectionerror')});
            }
        });
    });

    $(document).on('change', '.chosen.categories', function(e) {
        var $this = $(this);
        var filters = $app.api.filters('list');
        var filters_html = '';
        $('.filters-container .filters-container-data').empty();
        if (filters) {
            if ($app.controls.arraySize(filters[$this.val()]) > 0) {
                $.each(filters[$this.val()], function(i, f) {
                    if (f.type=='select') {
                        filters_html += '<div class="form-group float-label active"><select class="form-control chosen" name="filter['+f.filter_id+']">';
                                                filters_html += '<option value="null">'+$app.lang.str('filter_select')+'</option>';
                                                $.each(f.content[$app.lang.default()], function(i, fc) {    
                                                    filters_html += '<option value="'+fc.value+'">'+fc.label+'</option>';
                                                });
                        filters_html += '</select><label class="form-control-label">'+f.filter_name[$app.lang.default()]+'</label></div>';
                    }
                    if (f.type=='input') {
                        filters_html += '<div class="form-group float-label active">';
                        filters_html += '<input '+$app.controls.filter_options(f.options, 'type', true)+' '+$app.controls.filter_options(f.options, 'value', true)+' '+$app.controls.filter_options(f.options, 'min', true)+' '+$app.controls.filter_options(f.options, 'max', true)+' '+$app.controls.filter_options(f.options, 'id', true)+' '+$app.controls.filter_options(f.options, 'required', true)+' '+$app.controls.filter_options(f.options, 'readonly', true)+' '+$app.controls.filter_options(f.options, 'maxlength', true)+' '+$app.controls.filter_options(f.options, 'minlength', true)+' name="filter['+f.filter_id+']" class="form-control '+$app.controls.filter_options(f.options, 'class', true)+'">';
                        filters_html += '<label class="form-control-label">'+f.filter_name[$app.lang.default()]+'</label></div>';
                    }
                });
                $('.filters-container .filters-container-data').html(filters_html);
                $(".filters-container .filters-container-data .chosen").chosen({no_results_text: $app.lang.str('filter_no_results_text'), placeholder_text_multiple: $app.lang.str('filter_select'), placeholder_text: $app.lang.str('filter_select')});
            }
        }
    });

    $(document).on('change', "#postad [name='category']", function(e) {
        var $this = $(this);
        var filters = $app.api.filters('list');
        var filters_html = '';
        $('#postad .filters-data').empty();
        if (filters) {
            if ($app.controls.arraySize(filters[$this.val()]) > 0) {
                $.each(filters[$this.val()], function(i, f) {
                    if (f.type=='select') {
                        filters_html += '<div class="col-12 col-md-6 col-lg-4"><div class="form-group float-label active"><select class="form-control" name="filter['+f.filter_id+']">';
                                                filters_html += '<option value="null">'+$app.lang.str('filter_select')+'</option>';
                                                $.each(f.content[$app.lang.default()], function(i, fc) {    
                                                    filters_html += '<option value="'+fc.value+'">'+fc.label+'</option>';
                                                });
                        filters_html += '</select><label class="form-control-label">'+f.filter_name[$app.lang.default()]+'</label></div></div>';
                    }
                    if (f.type=='input') {
                        filters_html += '<div class="col-12 col-md-6 col-lg-4"><div class="form-group float-label active">';
                        filters_html += '<input '+$app.controls.filter_options(f.options, 'type', true)+' '+$app.controls.filter_options(f.options, 'value', true)+' '+$app.controls.filter_options(f.options, 'min', true)+' '+$app.controls.filter_options(f.options, 'max', true)+' '+$app.controls.filter_options(f.options, 'id', true)+' '+$app.controls.filter_options(f.options, 'required', true)+' '+$app.controls.filter_options(f.options, 'readonly', true)+' '+$app.controls.filter_options(f.options, 'maxlength', true)+' '+$app.controls.filter_options(f.options, 'minlength', true)+' name="filter['+f.filter_id+']" class="form-control '+$app.controls.filter_options(f.options, 'class', true)+'">';
                        filters_html += '<label class="form-control-label">'+f.filter_name[$app.lang.default()]+'</label></div></div>';
                    }
                });
                $('#postad .filters-data').html(filters_html);
            }
        }
    });

    $(document).on('click', '[bookmark]', function(e) {
        var id = $(this).attr('bookmark');
        var bookmark = $app.bookmark.in(id);
        if (bookmark) {
            $app.bookmark.remove(id);
            $("[bookmark='"+id+"']").find('i').html('favorite_outline');
            var cur_route
            if (sessionStorage['cur_route']) {
                let cur_route = sessionStorage.getItem('cur_route');
                if (cur_route=='/bookmarks') {
                    $("[item='"+id+"']").remove();
                    if ($('.simpleads-data .post-item').length == 0) {
                        $('.simpleads-temp-list, .simpleads-temp-grid').hide();
                        $('.error-content').show();
                    }
                }
            } 
        }else{
            $app.bookmark.add(id);
            $("[bookmark='"+id+"']").find('i').html('favorite');
        }
    });

    $(document).on('click', '.delete-bookmarks', function(e) {
        localStorage.removeItem('bookmark');
        $('.simpleads-data').html();
        $('.simpleads-data, .simpleads-temp-list, .simpleads-temp-grid').hide();
        $('.error-content').show();
        $('#clear_modal').modal('hide');
        $app.sound('remove');
        $app.controls.notify({status:"success",icon:"check",position:"top",head:"",text:$app.lang.str('bookmarks_removed')});
    });

    $(document).on('click', '[view-post]', function(e) {
        var id = $(this).attr('view-post');
        Router.dispatch('/ad/view/'+id);
    });

    $(document).on('click', '[view-news]', function(e) {
        var id = $(this).attr('view-news');
        Router.dispatch('/news_view/'+id);
    });

    $(document).on('click', '[back]', function(e) {
        var back = $(this).attr('back');
        $(back).addClass('fadeOutLeft animated faster').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('fadeOutLeft animated faster');
            $(back).remove();
            $('html').css({ "overflow": ""});
            shouldPull = true;
            $loadmore = true;
            sessionStorage.setItem('cur_route', '/'+fsp_history);
            history.pushState(null, null, '#'+fsp_history);
        });
        $(window).scrollTop(fsp_scroll);
    });

    $(document).on('click', '.filter .filter-button', function(e) {
        if ($('body').hasClass('filtermenu-open') == true) {
            $('body').removeClass('filtermenu-open');
            $('.header .filter-btn').find('i').html('filter_list');
        } else {
            $('body').addClass('filtermenu-open');
            $('.filter-btn').find('i').html('close');
        }
        if (sessionStorage['cur_route']) {
            let cur_route = sessionStorage.getItem('cur_route');
            if (cur_route=='/main') {
                $app.posts.filter();
            }
        } 
    });

    $(document).on('click', '#categories_modal .set', function(e) {
        if (sessionStorage['cur_route']) {
            let cur_route = sessionStorage.getItem('cur_route');
            if (cur_route=='/news') {
                $app.news.filter();
            }
        } 
        $('#categories_modal').modal('hide');
    });

    $(document).on('click', '.share-item', function(e) {
        var share_id = $(this).attr('share-id');
        var share_type = $(this).attr('share-type');
        var share_title = $(this).attr('share-title');
        var share_unique = $(this).attr('share-unique');
        if (share_type == 'ads') {
            var title = share_title;
            var url = $sitename+'/ads/view/'+share_id+'/'+share_unique;
        }else if (share_type == 'news') {
            var title = share_title;
            var url = $sitename+'/p/news/view/'+share_id+'-'+share_unique;
        }else{
            var title = $app.lang.str('apptitle');
            var url = $sitename;
        }
        if (navigator.share) { 
            navigator.share({
                title: title,
                url: url
            }).then(() => {
                return;
            })
            .catch(console.error);
        } else {
            var facebook = "http://www.facebook.com/sharer.php?u="+encodeURIComponent(url);
            var twitter = "https://twitter.com/intent/tweet?url="+encodeURIComponent(url)+"&text="+encodeURIComponent(title)+"&via=&hashtags=";
            var telegram = "https://t.me/share/url?url="+encodeURIComponent(url)+"&text="+encodeURIComponent(title)+"&to=";
            var whatsapp = "https://wa.me/whatsappphonenumber/?text="+encodeURIComponent(url);
            $('#share .facebook').attr('url', facebook);
            $('#share .twitter').attr('url', twitter);
            $('#share .telegram').attr('url', telegram);
            $('#share .whatsapp').attr('url', whatsapp);
            $('#share .copy-url input').val(url);
            $('#share').modal('show');
        }
    });
    $(document).on('click', '#share .copy, #share .copy-url input', function(e) {
        var element = $('#share .copy-url input');
        element.select();
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(element.val()).select();
        document.execCommand("copy");
        $temp.remove();
        element.select();
        element.blur();
        $app.sound('add');
        $app.vibrate();
    });

    $(document).on('click', '#share [url]', function(e) {
        var url = $(this).attr('url');
        Website2APK.openExternal(url);
        $app.sound('add');
        $app.vibrate();
    });

    $(document).on('keyup', ".header input[type='search']", function(e) {
        if ($(this).is(":focus") && e.keyCode === 13) {
            $(this).blur(); 
            if (sessionStorage['cur_route']) {
                let cur_route = sessionStorage.getItem('cur_route');
                if (cur_route=='/main') {
                    $app.posts.filter();
                }
            }     
        }
    });
    $(document).on('change', ".header input[type='search']", function(e) {
        if ($(this).val() == "") {
            $(this).blur(); 
            $app.posts.filter();
        }
    });

    $(document).on('click', "[settings]", function(e) {
        var key = $(this).attr('settings');
        var val = $(this).attr('settings-val');
        if (key == 'list_item') {
            $app.config.set('list_item', val);
            $("[settings='list_item']").removeClass('text-warning').removeClass('text-secondary');
            $("[settings='list_item']").addClass('text-secondary');
            $("[settings-val='"+val+"']").addClass('text-warning');
        }
        if (key == 'notification') {
            if ($(this).is(':checked')) {
                $app.config.set('notification', 'enabled');
            }else{
                $app.config.set('notification', 'disabled');
            }
        }
        if (key == 'vibration') {
            if ($(this).is(':checked')) {
                $app.config.set('vibration', 'enabled');
            }else{
                $app.config.set('vibration', 'disabled');
            }
        }
        if (key == 'audio') {
            if ($(this).is(':checked')) {
                $app.config.set('audio', 'enabled');
            }else{
                $app.config.set('audio', 'disabled');
            }
        }
        if (key == 'nightmode') {
            if ($(this).is(':checked')) {
                $app.config.set('nightmode', 'enabled');
                $('head').append('<link href="vendor/css/darkmode.css" rel="stylesheet" />');
                $('.wrapper .header img').attr('src', 'vendor/img/menu-white.png'); 
            }else{
                $app.config.set('nightmode', 'disabled');
                $('link[href="vendor/css/darkmode.css"]').remove();
                $('.wrapper .header img').attr('src', 'vendor/img/menu.png'); 
            }
        }
        if (key == 'trafic') {
            if ($(this).is(':checked')) {
                $app.config.set('trafic', 'enabled');
            }else{
                $app.config.set('trafic', 'disabled');
            }
        }
        if (key == 'language') {
            $app.lang.default(val);
            $app.lang.parse();
            $('#language_modal').modal('hide');
        }
    });

    $(document).on('submit', '#user_info_modal form', function(e) {
        e.preventDefault();
        var $this = $(this);
        var values = $this.serializeArray();
        var error = 0;
        var fullname = $("#user_info_modal [name='fullname']").val();
        var address = $("#user_info_modal [name='address']").val();
        var phonenumber = $("#user_info_modal [name='phonenumber']").val();
        var emailortelegram = $("#user_info_modal [name='emailortelegram']").val();
        if (fullname == "" || address == "" || phonenumber == "") {
            $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('fieldsempty')});
        }else{
            $app.config.set('user_info', JSON.stringify({fullname: fullname,address: address,phonenumber: phonenumber,emailortelegram: emailortelegram}));
            $('#user_info_modal').modal('hide');
        }
    });
/*
    window.onscroll = function() {
        var getScrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
        
        const body = document.body;
        const html = document.documentElement;
    
        var getDocumentHeight = Math.max(
            body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight
        );
        if (getScrollTop < getDocumentHeight - window.innerHeight) return;
        if ($loadmore) {
            if (sessionStorage['cur_route']) {
                let cur_route = sessionStorage.getItem('cur_route');
                if (cur_route=='/main') {
                    $scroll_page++;
                    $app.posts.loadMore($scroll_page);
                }
            }  
        }
    };
*/

    $(window).scroll(function() {
        if ($('.fsp-wrapper').length == 0) {
            if( $app.controls.isOnScreen( $('.simpleads-data .post-item:last') ) ) { 
                if ($loadmore) {
                    $loadmore = false;
                    if (sessionStorage['cur_route']) {
                    let cur_route = sessionStorage.getItem('cur_route');
                        if (cur_route=='/main') {
                            $scroll_page++;
                            $app.posts.loadMore($scroll_page);
                        }
                        if (cur_route=='/news') {
                            $scroll_page++;
                            $app.news.loadMore($scroll_page);
                        }
                    }  
                }
            }
        }
    });/*
    PullToRefresh.init({
        mainElement: 'body',
        instructionsPullToRefresh: $app.lang.str('instructionsPullToRefresh'),
        instructionsReleaseToRefresh: $app.lang.str('instructionsReleaseToRefresh'),
        instructionsRefreshing: $app.lang.str('instructionsRefreshing'),
        shouldPullToRefresh: function(){
          return shouldPull;
        },
        onRefresh: function (done) {
            setTimeout(function () {
                done();
                if (navigator.onLine) {
                    Router.dispatch(sessionStorage.getItem('cur_route'));
                    $app.vibrate();
                }else{
                    $app.sound('error');
                    $app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('connectionerror')});
                }
            }, 1500);
        }
    });*/
    window.addEventListener("offline", function(e) {$app.controls.notify({status:"danger",icon:"exclamation",position:"top",head:"",text:$app.lang.str('connectionerror')});$app.sound('error');$app.vibrate([200,100,300,100]);});
    window.addEventListener("online", function(e) {Router.dispatch(sessionStorage.getItem('cur_route'));});

   FastClick.attach(document.body);
});
