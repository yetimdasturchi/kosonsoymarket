(function($) {
  'use strict';
  $(function() {
    var body = $('body');
    var contentWrapper = $('.content-wrapper');
    var scroller = $('.container-scroller');
    var footer = $('.footer');
    var sidebar = $('.sidebar');

    //Add active class to nav-link based on url dynamically
    //Active class can be hard coded directly in html file also as required
    var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
    /*$('.nav li a', sidebar).each(function(){
        var $this = $(this);
        if(current === "") {
          //for root url
          if($this.attr('href').indexOf("manage") !== -1){
              $(this).parents('.nav-item').last().addClass('active');
              if ($(this).parents('.sub-menu').length) {
                $(this).closest('.collapse').addClass('show');
                $(this).addClass('active');
              }
          }
        }
        else {
          //for other url
          if($this.attr('href').indexOf(current) !== -1 && current !== 'manage'){
              $(this).parents('.nav-item').last().addClass('active');
              if ($(this).parents('.sub-menu').length) {
                $(this).closest('.collapse').addClass('show');
                $(this).addClass('active');
              }
          }
        }
    })
*/
    //Close other submenu in sidebar on opening any

    sidebar.on('show.bs.collapse','.collapse', function() {
      sidebar.find('.collapse.show').collapse('hide');
    });


    //Change sidebar and content-wrapper height
    applyStyles();
    function applyStyles() {
      //Applying perfect scrollbar
      if(!body.hasClass("rtl")) {
        const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper, ul.chats, .product-chart-wrapper');
        if(body.hasClass("sidebar-fixed")) {
          var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
        }
      }
    }

    $('.sidebar [data-toggle="collapse"]').on("click", function(event) {
      if(!((body.hasClass('sidebar-icon-only')||body.hasClass('horizontal-menu'))&&window.matchMedia('(min-width: 992px)').matches)) {
        //Updating content wrapper height to sidebar height on expanding a menu in sidebar
        var clickedItem = $(this);
        if(clickedItem.attr('aria-expanded') === 'false') {
          var scrollTop = scroller.scrollTop() - 20;
        }
        else {
          var scrollTop = scroller.scrollTop() - 100;
        }
        setTimeout(function(){
            if(contentWrapper.outerHeight()+ footer.outerHeight()!== sidebar.outerHeight()) {
              applyStyles();
              scroller.animate({ scrollTop: scrollTop }, 350);
            }
        }, 400);
      }
      else {
        //Disable click on sidebar menu item when sidebar icon only mode or horizontal menu mode is in use
        //to avoid ambiguity of mixed hover and click on menu item
        return false;
      }
    })
    $('[data-toggle="minimize"]').on("click", function () {
      if((body.hasClass('sidebar-toggle-display'))||(body.hasClass('sidebar-absolute'))) {
        body.toggleClass('sidebar-hidden');
        applyStyles();
      }
      else {
        body.toggleClass('sidebar-icon-only');
        applyStyles();
      }
    });

    //checkbox and radios
    $(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

    //fullscreen
    $("#fullscreen-button").on("click",function toggleFullScreen() {
      if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
          if (document.documentElement.requestFullScreen) {
              document.documentElement.requestFullScreen();
          } else if (document.documentElement.mozRequestFullScreen) {
              document.documentElement.mozRequestFullScreen();
          } else if (document.documentElement.webkitRequestFullScreen) {
              document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
          } else if (document.documentElement.msRequestFullscreen) {
              document.documentElement.msRequestFullscreen();
          }
      }
      else {
          if (document.cancelFullScreen) {
              document.cancelFullScreen();
          } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
          } else if (document.webkitCancelFullScreen) {
              document.webkitCancelFullScreen();
          } else if (document.msExitFullscreen) {
              document.msExitFullscreen();
          }
      }
    })
  });
  $(function() {
    /* Code for attribute data-custom-class for adding custom class to tooltip */ 
    if (typeof $.fn.tooltip.Constructor === 'undefined') {
      throw new Error('Bootstrap Tooltip must be included first!');
    }
    
    var Tooltip = $.fn.tooltip.Constructor;
    
    // add customClass option to Bootstrap Tooltip
    $.extend( Tooltip.Default, {
        customClass: ''
    });
    
    var _show = Tooltip.prototype.show;
    
    Tooltip.prototype.show = function () {
      
      // invoke parent method
      _show.apply(this,Array.prototype.slice.apply(arguments));
      
      if ( this.config.customClass ) {
        var tip = this.getTipElement();
        $(tip).addClass(this.config.customClass);
      }
      
    };
    $('[data-toggle="tooltip"]').tooltip();
      
  });
  $(function() {
    /* Code for attribute data-custom-class for adding custom class to tooltip */ 
    if (typeof $.fn.popover.Constructor === 'undefined') {
      throw new Error('Bootstrap Popover must be included first!');
    }
    
    var Popover = $.fn.popover.Constructor;
    
    // add customClass option to Bootstrap Tooltip
    $.extend( Popover.Default, {
        customClass: ''
    });
    
    var _show = Popover.prototype.show;
    
    Popover.prototype.show = function () {
      
      // invoke parent method
      _show.apply(this,Array.prototype.slice.apply(arguments));
      
      if ( this.config.customClass ) {
        var tip = this.getTipElement();
        $(tip).addClass(this.config.customClass);
      }
      
    };

    $('[data-toggle="popover"]').popover()
  });

  $.fn.andSelf = function() {
    return this.addBack.apply(this, arguments);
  }

  if($(".js-example-basic-single").length){
    $(".js-example-basic-single").select2({placeholder: "Tanlash"});
  }
  if($(".js-example-basic-multiple").length){
    $(".js-example-basic-multiple").select2({multiple:true, placeholder: "Tanlash"});
  }

  $(document).on('select2:open', '.js-example-basic-multiple, .js-example-basic-single', function(e){
    setTimeout(() => {
      if ($('.select2-search__field').is(':focus')) {
         $('.select2-search__field').blur();
      }
    }, 1);
  });

  if ($(".datepicker-popup").length) {
    $('.datepicker-popup').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy'
    });
  }

 if ($(".datetimepicker-popup").length) {
      $('.datetimepicker-popup').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
        timeOnly: true,     
        dateFormat: 'dd-mm-yyyy hh:mm:tt'
      });
    }

  if($('.my-carousel').length) {
    $('.my-carousel').owlCarousel({
      loop: true,
      margin: 10,
      items: 1,
      nav: false,
      autoplay: true,
      autoplayTimeout:5500,
      navText: ["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]
    });
  }

  if($('.rtl-carousel').length) {
    $('.rtl-carousel').owlCarousel({
      loop:false,
      margin:10,
      autoplay: true,
      autoplayTimeout:3000,
      responsive:{
          0:{
            items:1
          },
          600:{
            items:3
          },
          1000:{
            items:5
          }
      }
    });
  }

  var reloadadvanced = function() {
    $('[data-toggle="popover"]').popover();
    if($(".js-example-basic-single").length){
      $(".js-example-basic-single").select2({placeholder: "Tanlash"});
    }
    if($(".js-example-basic-single").length){
      $(".js-example-basic-single").select2({placeholder: "Tanlash"});
    }

    if($(".js-example-basic-multiple").length){
      $(".js-example-basic-multiple").select2({multiple:true, placeholder: "Tanlash"});
    }

    if ($(".datepicker-popup").length) {
      $('.datepicker-popup').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy'
      });
    }

    if ($(".datetimepicker-popup").length) {
      $('.datetimepicker-popup').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
        timeOnly: true,     
        dateFormat: 'dd-mm-yyyy hh:mm:tt'
      });
    }

    if($('.my-carousel').length) {
      $('.my-carousel').owlCarousel({
        loop: true,
        margin: 10,
        items: 1,
        nav: false,
        autoplay: true,
        autoplayTimeout:5500,
        navText: ["<i class='mdi mdi-chevron-left'></i>","<i class='mdi mdi-chevron-right'></i>"]
      });
    }
    if($('.rtl-carousel').length) {
      $('.rtl-carousel').owlCarousel({
        rtl:true,
        loop:true,
        margin:10,
        autoplay: true,
        autoplayTimeout:3000,
        responsive:{
            0:{
              items:1
            },
            600:{
              items:3
            },
            1000:{
              items:5
            }
        }
      });
    }

    if ($(".tags").length) {
      $('.tags').tagsInput({
        'width': '100%',
        'height': '75%',
        'interactive': true,
        'defaultText': 'Qo\'shish...',
        'removeWithBackspace': true,
        'minChars': 0,
        'maxChars': 20,
        'placeholderColor': '#666666'
      });
    }
  }
  var openin = { 
    new: function(url) {
      if (url !== '') {
        var win = window.open(url, '_blank');
        win.focus();
      }
    },
    current: function(url) {
      if (url !== '') {
        location.href=url;
      }
    }

  }

  $.fn.disableSelection = function() {
        return this
        .attr('unselectable', 'on')
        .css('user-select', 'none')
        .css('-moz-user-select', 'none')
        .css('-khtml-user-select', 'none')
        .css('-webkit-user-select', 'none')
        .on('selectstart', false);
    };
  
    $.fn.enableSelection = function() {
      return this
      .attr('unselectable', '')
      .css('user-select', '')
      .css('-moz-user-select', '')
      .css('-khtml-user-select', '')
      .css('-webkit-user-select', '')
      .off('selectstart', false)
      .off('contextmenu', false)
      .off('keydown', false)
      .off('mousedown', false);
    };

  if ($("[ajax-modal]").length) {
    $('[ajax-modal]').click(function(event) {
      event.preventDefault();
      if ($(this).attr('ajax-modal-tab') == 'new') {
        openin.new($(this).attr('ajax-modal'));
      }else if ($(this).attr('ajax-modal-tab') == 'this') {
        openin.current($(this).attr('ajax-modal'));
      }else{
        $.get($(this).attr('ajax-modal'), function(html) {
          if (html == "refresh") {
            location.reload();
          }
          if (html !== "error" || html !== "refresh") {
            $(html).appendTo('body').modal(/*{escapeClose: false, clickClose: false}*/);
            reloadadvanced();
          }
        });
      }
    });
  }
  
  if ($("[context-menu]").length) {
    $('[context-menu]').disableSelection();
    $.contextMenu({
      selector: "[context-menu]",
      zIndex: 10000,
      trigger: 'left',
      build: function($trigger) {
    
        $('[data-toggle="popover"]').popover('hide');
        $("[context-menu]").contextMenu("hide");
        var options = {
          callback: function(key, options) {
            var m = "clicked: " + key;
            window.console && console.log(m) || alert(m);
          },
          items: {}
        };

        var fromMenu = $trigger.attr('context-menu');
        if ($(fromMenu).length) {
          options.items = $.contextMenu.fromMenu($(fromMenu));
        }else{
          options = false;
        }
    
        return options;
    
      }
    });
  }

  $(document).on('click', '[confirm-swal]', function(e){
    e.preventDefault();
    var url = $(this).attr('confirm-swal');
    var redirect = $(this).attr('confirm-swal-redirect');
    if (url !== '') {
      console.log($(this).offset().top);
      swal({
        title: 'Harakatni tasdiqlang!',
        text: "Siz rostdan ham ushbu harakatni bajarmoqchimisiz?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ha',
        cancelButtonText: 'Yo\'q',
        //showLoaderOnConfirm: true,
        preConfirm: function() {
          return new Promise(function(resolve) {
            $.get(url, function(html) {
              console.log(html)
              if (html == "refresh") {
                if (redirect != undefined) {
                 openin.current(redirect);
                }else if(redirect == undefined){
                  location.reload();
                }else{
                  location.reload();
                }
              }else if (html == "error") {
                swal('', 'Harakatni bajarishda xatolik yuzberdi!', 'error');
              }else{
                swal(html);
              }
            });
          });
        },
        allowOutsideClick: false     
      }); 
    }
  });

  $(document).on('change', '.form-autosubmit', function(e) {
    e.preventDefault();

    var $this = $(this);
    var method = $this.attr('method');
    var action = $this.attr('action');
    var values = $this.serializeArray();
    var myArray = {};
    if (method.toLowerCase() == 'get') {
      $.each( values, function( k, v ) {
        if (v.value !== "" && v.value !== 'null') {
          myArray[v.name] = v.value;
        }
      });
      openin.current(action+'?'+$.param( myArray ));
    }else if (method.toLowerCase() == 'post') {
      $(this).submit();
    }
  });

  $(document).on('click', '.file-upload-browse', function(e) {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
  });
  
  $(document).on('change', '.file-upload-default', function(e) {
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  });

  $('.tags').tagsInput({
    'width': '100%',
    'height': '75%',
    'interactive': true,
    'defaultText': 'Qo\'shish...',
    'removeWithBackspace': true,
    'minChars': 0,
    'maxChars': 20,
    'placeholderColor': '#666666'
  });

  if ($(".quill-editor").length) {
    var ColorClass = Quill.import('attributors/class/color');
var SizeStyle = Quill.import('attributors/style/size');
Quill.register(ColorClass, true);
Quill.register(SizeStyle, true);
    var quill = new Quill('.quill-editor', {
      modules: {
        toolbar: [
            [{
              header: [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline'],
            [{
              align: ['', 'center', 'right', 'justify']
            }],
            ['link', 'image', 'code-block'],
            [{ list: 'ordered' }, { list: 'bullet' }]
          ]
      },
      placeholder: 'Matnni kiriting...',
      theme: 'snow' // or 'bubble'
    });
    quill.on('text-change', function() {
      $('.quil-fake-data').val(''); $('.quil-fake-data').val(quill.root.innerHTML);
    });
  }
  $(document).on('submit', '.test-form', function(e){
    e.preventDefault();
    var $this = $(this);
    var method = $this.attr('method');
    var action = $this.attr('action');
    var values = $this.serializeArray();
    console.log(values)

    $.ajax({
            type: method.toUpperCase(),
            url: action,
            data: $this.serialize(),
            success: function(data)
            {
               console.log(data)
            },
            error: function(data)
            {
               console.log(data)
            }
        });
  });

  var transliterate = { 
    chars: function(word) {
      if (word !== '') {
        var answer = "", a = {};

        a["Ё"]="YO";a["Й"]="I";a["Ц"]="TS";a["У"]="U";a["К"]="K";a["Е"]="E";a["Н"]="N";a["Г"]="G";a["Ш"]="SH";a["Щ"]="SCH";a["З"]="Z";a["Х"]="H";a["Ъ"]="'";
        a["ё"]="yo";a["й"]="i";a["ц"]="ts";a["у"]="u";a["к"]="k";a["е"]="e";a["н"]="n";a["г"]="g";a["ш"]="sh";a["щ"]="sch";a["з"]="z";a["х"]="h";a["ъ"]="'";
        a["Ф"]="F";a["Ы"]="I";a["В"]="V";a["А"]="a";a["П"]="P";a["Р"]="R";a["О"]="O";a["Л"]="L";a["Д"]="D";a["Ж"]="ZH";a["Э"]="E";
        a["ф"]="f";a["ы"]="i";a["в"]="v";a["а"]="a";a["п"]="p";a["р"]="r";a["о"]="o";a["л"]="l";a["д"]="d";a["ж"]="zh";a["э"]="e";
        a["Я"]="Ya";a["Ч"]="CH";a["С"]="S";a["М"]="M";a["И"]="I";a["Т"]="T";a["Ь"]="'";a["Б"]="B";a["Ю"]="YU";a["Ҳ"]="H";a["Ў"]="O";a["Ғ"]="G";
        a["я"]="ya";a["ч"]="ch";a["с"]="s";a["м"]="m";a["и"]="i";a["т"]="t";a["ь"]="'";a["б"]="b";a["ю"]="yu";a["ҳ"]="h";a["ў"]="o";a["ғ"]="g";

        for (var i in word){
          if (word.hasOwnProperty(i)) {
            if (a[word[i]] === undefined){
              answer += word[i];
            } else {
              answer += a[word[i]];
            }
          }
        }

        return answer;
      }else{
        return '';
      }
    },
    slug: function(text) {
      if (text !== '') {
        text = transliterate.chars(text);
        return text.toString().toLowerCase()
          .replace(/\s+/g, '-')      
          .replace(/\/+/g, '-')
          .replace(/\_+/g, '-')          
          .replace(/[^\w\-]+/g, '')      
          .replace(/\-\-+/g, '-')        
          .replace(/^-+/, '')       
          .replace(/-+$/, '');
      }else{
        return '';
      }
    }
  }
  $(document).on('change', '.slugify', function(e){
    var $this = $(this);
    var $val = $this.val();
    var $val = transliterate.slug($val);
    $this.val($val);
  });

  if ($("[role='iconpicker']").length) {
    $("[role='iconpicker']").on('change', function(e) {
      $($(this).data('input')).val(e.icon);
    });
    $("[role='iconpicker']").each(function(){
      $($(this).data('input')).val($(this).children('i').attr('class'));
    });
  }
  $(document).on('click', '.iconpicker', function(e){
    e.preventDefault();
    var $this = $(this);
    $this.next('button').trigger( "click" );
  });

  $(document).on('click', '.math-minus', function(e){
    e.preventDefault();
    var $this = $(this);
    var $input = $($this.data('input'));
    if ($input.val() > 0) {
      $input.val(Math.floor($input.val()-1));
    }else{
      $input.val(0);
    }
  });
  $(document).on('click', '.math-plus', function(e){
    e.preventDefault();
    var $this = $(this);
    var $input = $($this.data('input'));
    if ($input.val() >= 0) {
      $input.val(Math.floor($input.val())+1);
    }else{
      $input.val(0);
    }
  });




})(jQuery);