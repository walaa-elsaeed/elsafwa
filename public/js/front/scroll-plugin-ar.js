$(function ()
    {
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        if( isMobile.any() )
        {
        }
        else
        {
            //Track MiniBar Scrollable

            $("body").niceScroll(
                {
                    horizrailenabled:false,
                    cursorcolor: "#0080c4",
                    cursorborder: "1px solid #0080c4",
                    zindex:5555,
                    railalign: 'left'

                }
            );

            $('.coms').niceScroll(
                {
                    cursorcolor: "#0080c4",
                    cursorborder: "1px solid #0080c4",
                    railalign: 'left'

                }
            );

            $('.scrollable').niceScroll(
                {
                    cursorcolor: "#0080c4",
                    cursorborder: "1px solid #0080c4",
                    railalign: 'left'
                }
            );

            $('.point ,.cyber,.match,.guide').click(
                function () {
                    $('.scrollable').getNiceScroll().remove();
                    $('.scrollable').niceScroll(
                        {
                            cursorcolor: "#0080c4",
                            cursorborder: "1px solid #0080c4",
                            railalign: 'left'
                        }
                    );
                }
            );

            $('.footer .tab-content').niceScroll(
                {
                    horizrailenabled:false,
                    cursorcolor: "#0080c4",
                    cursorborder: "1px solid #0080c4",
                    railalign: 'left'
                }
            );
            $('.regestration textarea').niceScroll(
                {
                    cursorcolor: "#0080c4",
                    cursorborder: "1px solid #0080c4",
                    railalign: 'left'
                }
            )

            if (window.innerWidth < 1255)
            {
                $('.top-10 .imgs').niceScroll(
                    {
                        cursorcolor: "#0080c4",
                        cursorborder: "1px solid #0080c4",
                        horizrailenabled:true
                    }
                );
            }
        }
    }
);
