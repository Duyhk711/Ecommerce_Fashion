<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Poly Fashion - Thời trang hiện đại', // Tiêu đề mặc định cho toàn bộ website
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Poly Fashion - Cửa hàng thời trang trực tuyến với mẫu mã đa dạng, chất lượng cao, giá cả phải chăng. Mua sắm ngay hôm nay!', 
            'separator'    => ' - ',
            'keywords'     => ['thời trang', 'quần áo', 'Poly Fashion', 'mua sắm', 'đầm váy', 'áo thun'],
            'canonical'    => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
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
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Poly Fashion - Thời trang hiện đại',// set false to total remove
            'description' => 'Khám phá bộ sưu tập thời trang hot nhất tại Poly Fashion. Chất lượng đảm bảo, giao hàng nhanh chóng!',
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'Poly Fashion',
            'images'      => [ asset('client/images/title.png')],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Poly Fashion - Thời trang hiện đại',
            'description' => 'Cửa hàng thời trang trực tuyến Poly Fashion - Nơi mua sắm đáng tin cậy cho bạn và gia đình.',
            'url'         => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'website',
            'images'      => [ asset('client/images/title.png')],
        ],
    ],
];
