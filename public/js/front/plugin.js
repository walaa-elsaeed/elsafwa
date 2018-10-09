
//Rating Function
(function ( $ ) {

    $.fn.rating = function( method, options ) {
        method = method || 'create';
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            limit: 5,
            value: '0',
            glyph: "glyphicon-heart",
            coloroff: "#c0baba",
            coloron: "#f8d641",
            size: "1.5em",
            cursor: "pointer",
            onClick: function () {},
            endofarray: "idontmatter"
        }, options );
        var style = "";
        style = style + "font-size:" + settings.size + "; ";
        style = style + "color:" + settings.coloroff + "; ";
        style = style + "cursor:" + settings.cursor + "; ";



        if (method == 'create')
        {
            //this.html('');	//junk whatever was there

            //initialize the data-rating property
            this.each(function(){
                attr = $(this).attr('data-rating');
                if (attr === undefined || attr === false) { $(this).attr('data-rating',settings.value); }
            })

            //bolt in the glyphs
            for (var i = 0; i < settings.limit; i++)
            {
                this.append('<span data-value="' + (i+1) + '" class="ratingicon glyphicon ' + settings.glyph + '" style="' + style + '" aria-hidden="true"></span>');
            }

            //paint
            this.each(function() { paint($(this)); });

        }
        if (method == 'set')
        {
            this.attr('data-rating',options);
            this.each(function() { paint($(this)); });
        }
        if (method == 'get')
        {
            return this.attr('data-rating');
        }
        //register the click events
        this.find("span.ratingicon").click(function() {
            rating = $(this).attr('data-value')
            $(this).parent().attr('data-rating',rating);
            paint($(this).parent());
            settings.onClick.call( $(this).parent() );
        })
        function paint(div)
        {
            rating = parseInt(div.attr('data-rating'));
            div.find("input").val(rating);	//if there is an input in the div lets set it's value
            div.find("span.ratingicon").each(function(){	//now paint the stars

                var rating = parseInt($(this).parent().attr('data-rating'));
                var value = parseInt($(this).attr('data-value'));
                if (value > rating) { $(this).css('color',settings.coloroff); }
                else { $(this).css('color',settings.coloron); }
            })
        }

    };

}( jQuery ));



$(function () {

    //////////////////////////////////////////////Home/////////////////////////////////////////////////
    $('#datetimepicker').datetimepicker(
        { format: 'DD/MM/YYYY'}
    );
    //toggle fixed nav

    $(window).scroll(function () {

        //toggle fixed nav
        if( $(window).width() > 991 ){

            if ($(this).scrollTop() > 190) {

                $('.pm-nav-container').addClass('fixed');

            } else {

                $('.pm-nav-container').removeClass('fixed');

            }

        }

    });

    /* ==========================================================================
	   MeanMenu (mobile menu)
	   ========================================================================== */
    $('#pm-main-navigation').meanmenu({
        /*meanMenuContainer: '#pm-mobile-menu-container',*/
        meanScreenWidth : 	"991",
        meanRevealPositionDistance: "0",
        meanShowChildren: true,
        meanExpandableChildren: true,
        meanExpand: "+",
        meanMenuCloseSize: "18px"
    });

    //Calling Rating Function
    $("#stars-default").rating();
    $("#stars-default-no").rating();



    $('#workhourfrom,#workhourto').timepicker();
    //Trigger Hover Animate
    $('.animated').on(
        {
            mouseenter:function () {
                if( $(window).width() > 992 )
                {
                    $(this).find('.hovers').css('padding-top','20%');
                    $(this).find('.img-icon').fadeToggle();
                    /*$(this).find('.added').fadeIn(1000);*/


                    $(this).find('.added,.disc').delay(500).queue(function () {
                        $(this).css("opacity", "1");
                        $(this).dequeue();
                    });
                }

                else if ( $(window).width() > 767 )
                {
                    $(this).find('.hovers').css('padding-top','7%');
                    $(this).find('.img-icon').fadeToggle();
                    /*$(this).find('.added').fadeIn(1000);*/


                    $(this).find('.added,.disc').delay(500).queue(function () {
                        $(this).css("opacity", "1");
                        $(this).dequeue();
                    });
                }
                else
                {
                    $(this).find('.hovers').css('padding-top','3%');
                    $(this).find('.img-icon').fadeToggle();
                    /*$(this).find('.added').fadeIn(1000);*/


                    $(this).find('.added,.disc').delay(500).queue(function () {
                        $(this).css("opacity", "1");
                        $(this).dequeue();
                    });
                }



            },
            mouseleave:function () {
                $(this).find('.hovers').css('padding-top','0');
                $(this).find('.img-icon').fadeToggle();
                $(this).find('.added,.disc').css("opacity", "0");
                /* $(this).find('.hovers').css('marginTop','0').delay(400).css('marginBottom','0');*/

            }
        }
    );
    //Trigger Home Slider

    /*if($('#pm-slider').length > 0){
        var x=$('.window-size header').height() + 50;
        var y=$('.marque-area').height() + 25;
        var z=$('.pm-slider ul li').height($(window).height() - (x+y));
        //Trigger Home Slider

        $('#pm-slider').PMSlider({
            speed : 700,
            easing : 'ease',
            loop : true,
            controlNav : true, //false = no bullets / true = bullets
            controlNavThumbs : true,
            animation : 'slide',
            fullScreen : false,
            slideshow : true,
            slideshowSpeed : 7000,
            pauseOnHover : true,
            arrows : true,
            fixedHeight : true,
            fixedHeightValue : z,
            touch : true,
            progressBar : false
        });

    }*/

    $('.bxslider').bxSlider(
        {
            pager:true,
            auto:true,
            pause:3000,
            controls:false
        }
    );


    var closeSelectTimeout;

    function hideMaterialList(parent){
        parent.css({
            'overflow': 'hidden'
        }).removeClass('isOpen');
        clearTimeout(closeSelectTimeout);
        closeSelectTimeout = setTimeout(function(){
            parent.parent().css({
                'z-index': 0
            });
        }, 200);
    }
    $(document.body).on('mousedown', '.materialBtn, .select li', function(event){
        if(parseFloat($(this).css('opacity')) > 0 && $(document).width() >= 1008){
            var maxWidthHeight = Math.max($(this).width(), $(this).height());
            if($(this).find("b.drop").length == 0 || $(this).find("b.drop").css('opacity') != 1) {
                // .drop opacity is 1 when it's hidden...css animations
                drop = $('<b class="drop" style="width:'+ maxWidthHeight +'px;height:'+ maxWidthHeight +'px;"></b>').prependTo(this);
            }
            else{
                $(this).find("b.drop").each(function(){
                    if($(this).css('opacity') == 1){
                        drop = $(this).removeClass("animate");
                        return;
                    }
                })
            }
            x = event.pageX - drop.width()/2 - $(this).offset().left;
            y = event.pageY - drop.height()/2 - $(this).offset().top;
            drop.css({
                top: y,
                left: x
            }).addClass("animate");
        }
    });
    $(document.body).on('dragstart', '.materialBtn, .select li', function(e){
        e.preventDefault();
    });

    var selectTimeout;
    $(document.body).on('click', '.select li', function() {
        var parent = $(this).parent();
        parent.children('li').removeAttr('data-selected');
        $(this).attr('data-selected', 'true');
        /*console.log($(this).attr('value'));*/
        parent.children('input').attr('value',$(this).attr('value'));
        // if(parent.children('#government')){
        //     console.log("gwa aho ");
        //     getCities();
        // }
        /*console.log('input'+parent.children('input').attr('name')+'has '+parent.children('input').attr('value'));*/
        clearTimeout(selectTimeout);
        if(parent.hasClass('isOpen')){


            ////Ajax Calling For Zone & City Drops In Add Cyber
            if(parent.children("input").attr("name") == "government" || parent.children("input").attr("name") == "zone"
            || parent.children("input").attr("name") == "ope"  || parent.children("input").attr("name") == "cat"
                || parent.children("input").attr("name") == "city_fil" || parent.children("input").attr("name") == "place"
                || parent.children("input").attr("name") == "status"
            )

            {

                if(parent.children("input").attr("name") == "government"){
                    getCities();
                }
                if((parent.attr("name") == "governmentSearch") || (parent.attr("name") == "citySearch")){
                    page = 0
                    getCybers(1);
                }

                if(parent.children("input").attr("name") == "city_fil"){
                    gettradesfront();
                }

                if(parent.children("input").attr("name") == "ope"){
                    getoperationTradefront();
                }
                if(parent.children("input").attr("name") == "cat"){
                    getCatTradefront();
                }
                if((parent.children("input").attr("name") == "place") || (parent.children("input").attr("name") == "status")){
                    ListTourn();
                }
            }



            if(parent.parent().hasClass('required')){
                if(parent.children('[data-selected]').attr('data-value')){
                    parent.parents('.materialSelect').removeClass('error empty');
                }
                else{
                    parent.parents('.materialSelect').addClass('error empty');
                }
            }
            hideMaterialList($('.select'));
        }
        else{
            /*console.log("else el tanya");*/
            var pos = Math.max(($('li[data-selected]', parent).index() - 2) * 48, 0);
            parent.addClass('isOpen');
            parent.parent().css('z-index', '999');
            if($(document).width() >= 1008){
                var i = 1;
                selectTimeout = setInterval(function(){
                    i++;
                    parent.scrollTo(pos, 50);
                    if(i == 2){
                        parent.css('overflow', 'auto');
                    }
                    if(i >= 4){
                        clearTimeout(selectTimeout);
                    }
                }, 100);
            }
            else{
                parent.css('overflow', 'auto').scrollTo(pos, 0);
            }
        }
    });

    $('.materialInput input').on('change input verify', function(){
        if($(this).attr('required') == 'true'){
            if($(this).val().trim().length){
                $(this).parent().removeClass('error empty');
            }
            else{
                $(this).parent().addClass('error empty');
                $(this).val('');
            }
        }
        else{
            if($(this).val().trim().length){
                $(this).parent().removeClass('empty');
            }
            else{
                $(this).parent().addClass('empty');
            }
        }
    });

    $(document.body).on('click', function(e) {
        var clicked;
        if($(e.target).hasClass('materialSelect')){
            clicked = $(e.target).find('.select').first();
        }
        else if($(e.target).hasClass('select')){
            clicked = $(e.target);
        }
        else if($(e.target).parent().hasClass('select')){
            clicked = $(e.target).parent();
        }

        if($(e.target).hasClass('materialSelect') || $(e.target).hasClass('select') || $(e.target).parent().hasClass('select')){
            hideMaterialList($('.select').not(clicked));
        }
        else{
            if($('.select').hasClass('isOpen')){
                hideMaterialList($('.select'));
            }
        }
    });
    hideMaterialList($('.select'));


    //Trigger Map Section Height
    $('.map').height($('.boxses').height()+32);
    $('.forget-pass span').click(function () {
        $('.password-form').show();
    });


    //Trigger Game Slider
    $('.game-slider').slick({
        slidesToShow: 5,
        infinite:true,
        cssEase: 'ease-in-out',
        useTransform: true,
        responsive: [
            {
                breakpoint: 992,
                settings:
                    {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        arrows:false,
                        dots:true

                    }
            },

            {
                breakpoint: 679,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows:false,
                    dots:true
                }
            },

            {
                breakpoint: 463,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows:false,
                    dots:true
                }
            }

        ]
    });

    //Trigger Trading Slider
    $('.trading-slider').slick({
        slidesToShow: 4,
        infinite:true,
        cssEase: 'ease-in-out',
        useTransform: true,
        dots: true,
        arrows:false,
        responsive: [
            {
                breakpoint: 992,
                settings:
                    {
                        slidesToShow: 3,
                        slidesToScroll: 3

                    }
            },

            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });

    //Cybers Slider
    $('.cybers-slider').slick({
        slidesToShow: 4,
        infinite:false,
        cssEase: 'ease-in-out',
        useTransform: true,
        dots: true,
        arrows:false,
        responsive: [
            {
                breakpoint: 992,
                settings:
                    {
                        slidesToShow: 3,
                        slidesToScroll: 3

                    }
            },

            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });

    //Trigger Events Slider
    $('.Events-slider').slick({
        slidesToShow: 2,
        infinite:true,
        cssEase: 'ease-in-out',
        useTransform: true,
        dots: true,
        arrows:false,
        responsive: [
            {
                breakpoint: 992,
                settings:
                    {
                        slidesToShow: 3,
                        slidesToScroll: 3

                    }
            },

            {
                breakpoint: 679,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },

            {
                breakpoint: 463,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });



    var tall=$('.area').height()-4;

    if (window.innerWidth > 992)
    {
        $('.top-games,.top-rate').height(tall);
    }

    //Trigger Footer Tabs
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })


    //trigger Game center details slider
    $('#galery-thumbs').lightSlider({
        gallery:true,
        item:1,
        thumbItem:5,
        thumbMargin:4,
        slideMargin:0,
        loop:true,
        pager:true,
        enableDrag: true,
        currentPagerPosition:'left',

        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#galery-thumbs .lslide'
            });
        }
    });
    //////////////////////////////////////////////Home/////////////////////////////////////////////////







    //////////////////////////////////////////////Tournament/////////////////////////////////////////////////
    $('.tournslider').bxSlider(
        {
            pager:true,
            auto:true,
            pause:3000,
            controls:false
        }
    );

    $('.ads-slider').bxSlider(
        {
            pager:false,
            auto:true,
            pause:3000
        }
    );

    var hei=parseInt($('.rank-elemet').height());
    var idvalue = parseInt($('.current').attr('id'));
    var scroll = ((hei + 5) * (idvalue - 1)) - 50;
    $(".scrollable").scrollTop(scroll);

    $('.cyber,.guide').click(function () {
        $('.point-system').hide();
        $('.match-system').hide();
    });

    $('.point').click(function () {
        $('.point-system').show();
        $('.match-system').hide();
    });

    $('.match').click(function () {
        $('.point-system').hide();
        $('.match-system').show();
    });

    //Partner Slider
    $('.sponser-slider').slick(
        {
            slidesToShow: 4,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows:false,
            responsive: [
                {
                    breakpoint: 1000,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 2
                    }
                }

            ]
        }
    );

    // Triger The Width Of Breadcrumb in many pages
    $('.ten-area').width($('.top-10').width() - $('.slashed').width());
    $(window).resize(function()
        {
            $('.ten-area').width($('.top-10').width() - $('.slashed').width());
        }
    );
    // Triger The Width Of Breadcrumb in many pages



    /*$('.cyber-submit').click(
        function () {
            var $fileUpload = $("#image");
            if (parseInt($fileUpload.get(0).files.length)>20){
                alert("You can only upload a maximum of 20 files");
            }
        }
    );*/

   /* $('.fileinput').change(function(){
        if(this.files.length>10)
            alert('to many files')
    });
    // Prevent submission if limit is exceeded.
    $('form').submit(function(){
        if(this.files.length>10)
            return false;
    });
*/
   /* $('#image').change(function(){
        if(this.files.length>5)
            alert('to many files')
    });


    $('.cyber_form').submit(function(){
        if(this.files.length>5)
            return false;
    });*/


});