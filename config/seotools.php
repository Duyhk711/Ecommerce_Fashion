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
            'titleBefore'  => false, // Đặt title mặc định trước tiêu đề trang
            'description'  => 'Poly Fashion - Cửa hàng thời trang trực tuyến với mẫu mã đa dạng, chất lượng cao, giá cả phải chăng. Mua sắm ngay hôm nay!', 
            'separator'    => ' - ',
            'keywords'     => ['thời trang', 'quần áo', 'Poly Fashion', 'mua sắm', 'đầm váy', 'áo thun'],
            'canonical'    => env('APP_URL'), // Sử dụng APP_URL từ .env thay vì Url::full()
            'robots'       => 'index,follow', // Mặc định cho SEO
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
            'title'       => 'Poly Fashion - Thời trang hiện đại', // Đặt tiêu đề Open Graph mặc định
            'description' => 'Khám phá bộ sưu tập thời trang hot nhất tại Poly Fashion. Chất lượng đảm bảo, giao hàng nhanh chóng!',
            'url'         => env('APP_URL'), // Thay vì sử dụng Url::current(), dùng URL tĩnh
            'type'        => 'website',
            'site_name'   => 'Poly Fashion',
            'images'      => [env('APP_URL') . '/client/images/title.png'], // URL tĩnh thay vì asset()
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            // 'card'        => 'summary',
            // 'site'        => '@PolyFashion', // Thêm handle Twitter nếu có
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Poly Fashion - Thời trang hiện đại',
            'description' => 'Cửa hàng thời trang trực tuyến Poly Fashion - Nơi mua sắm đáng tin cậy cho bạn và gia đình.',
            'url'         => env('APP_URL'), // Dùng URL tĩnh
            'type'        => 'website',
            'images'      => [env('APP_URL') . '/client/images/title.png'], // Thay asset() bằng URL tĩnh
        ],
    ],
];
