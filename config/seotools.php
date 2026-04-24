<?php

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        'defaults' => [
            'title'        => 'PhatFood - Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam',
            'titleBefore'  => false,
            'description'  => 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền Việt Nam.',
            'separator'    => ' | ',
            'keywords'     => ['suất ăn công nghiệp', 'dịch vụ ăn uống', 'PhatFood', 'suất ăn doanh nghiệp', 'suất ăn nhà máy', 'catering Việt Nam'],
            'canonical'    => 'current',
            'robots'       => 'index, follow',
        ],
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
        'defaults' => [
            'title'       => 'PhatFood - Dịch vụ suất ăn công nghiệp',
            'description' => 'Cung cấp dịch vụ suất ăn công nghiệp chất lượng cao trên toàn quốc Việt Nam.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'PhatFood Việt Nam',
            'images'      => [],
        ],
    ],
    'twitter' => [
        'defaults' => [
            'card' => 'summary_large_image',
            'site' => '@phatfood',
        ],
    ],
    'json-ld' => [
        'defaults' => [
            'title'       => 'PhatFood - Dịch vụ suất ăn công nghiệp',
            'description' => 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm.',
            'url'         => 'current',
            'type'        => 'Organization',
            'images'      => [],
        ],
    ],
];
