<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "THE GAME", // set false to total remove
            'description'  => 'The GAME is the first online platform that serves all the gaming industry elements. A website where gamers can find all what they need to gear-up their gaming experience, build their community, and get rewarded', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [
                                'thegame.com','thegamecom','thegame','thegames','thegamers','game','games','gamers',
                                'gaming','gaming event','game event','game competition','game tournament','gaming tournament',
                                'gaming competition','gaming website','gaming laptop','joystick','gaming association for multimedia entertainment',
                                'gamers community','Gaming community','Gaming market','electronic games','multimedia games','gaming association',
                                'multimedia entertainment','electronic entertainment','gaming in egypt','games in egypt',
                                'game egypt','playstation','playstation4','VR egypt','xbox','xbox egypt','PS','PS 4','wii',
                                'wii egypt','cyber','cybers','cybercafe','playstationcafe','buy sell games','request games',
                                'gaming market in egypt','games market in egypt','cybers in egypt','gaming spots','best game spot',
                                'best gaming spot','best cyber','games news in egypt','gaming news in egypt','trade games','nintendo switch',
                                'nintendo Wii','nintendo','gaming tournament','fifa tournament','fanta tournament','fifa',
                                'ea sports','call of duty','activision ','blizzard','war craft','dota','league of legends ',
                                'Worldcup playstation','worldcup tournament','cocacola worldcup','copa cocacola','ecopa cocacola',
                                'جيمز ','العالب اكترونية','بلاي ستيشن ','اكس بوكس ','فيفا','برو ','بيس','دراع ','لعبة','جيمر','جيمرز ',
                                'اخبار الجيمز ','بطولة بلاي ستيشن ','ايفينت جيمز','مجال الجيمز ','العاب الكترونية في مصر',
                                'بطولة كاس العالم ','مسابقة كاس العالم فيفا','فيفا 2018','بطولة بلاي ستيشن مصر','مسابقة بلاي ستيشن مصر',
                                'بطولة سايبرات','بلاي ستيشن كافيه ','أماكن لعب بلاي ستيشن ','أماكن لعب كمبيوتر','سوق الجيمز ',
                                'سوق الألعاب في مصر ','اخبار الجيمز','اخبار الألعاب ','اخبار الألعاب الالكترونية مصر',
                                'تصنيف العاب البلاي ستيشن ','العاب الكمبيوتر '

            ],
            'canonical'    => null, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'THE GAME', // set false to total remove
            'description' => 'The GAME is the first online platform that serves all the gaming industry elements. A website where gamers can find all what they need to gear-up their gaming experience, build their community, and get rewarded ', // set false to total remove
            'url'         => 'http://thegame.com.co', // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'THE GAME',
            'images'      => ['http://thegame.com.co/img/logo.png','http://thegame.com.co/img/2d-final.png','http://thegame.com.co/img/home/animated-2.jpg','http://thegame.com.co/img/home/animated-1.jpg','http://thegame.com.co/img/home/animated-3.jpg',
                                ''
            ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'THE GAME',
            'site'        => '@accountTheGame3laTwitter',
        ],
    ],
];