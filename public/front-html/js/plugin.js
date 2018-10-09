//Rating Function
(function ( $ ) {

    $.fn.rating = function( method, options ) {
        method = method || 'create';
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            limit: 5,
            value: '0',
            glyph: "glyphicon-star",
            coloroff: "#767171",
            coloron: "#f8d641",
            size: "1em",
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


$(function ()
    {
        ////////////////////////////////////HOME/////////////////////////////////////////


        $('.home_slider').bxSlider(
            {
                controls:false,
                auto:true,
                pause:3000
            }
        );



        $('.series_slider').slick(
            {
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
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
            }
        );

        $('.article_slider').slick(
            {
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
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
            }
        );



        //Calling Rating Function
        $("#stars-default").rating();



        $('.new_slider').bxSlider(
            {
                controls:false,
                auto:true,
                pause:3000
            }
        );



        ////////////////////////////////////HOME/////////////////////////////////////////

    }
);
