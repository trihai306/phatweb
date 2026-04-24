<?php

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        'defaults' => [
            'title'        => 'DAT PHAT - Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam',
            'titleBefore'  => false,
            'description'  => 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền Việt Nam.',
            'separator'    => ' | ',
            'keywords'     => ['suất ăn công nghiệp', 'dịch vụ ăn uống', 'DAT PHAT', 'suất ăn doanh nghiệp', 'suất ăn nhà máy', 'catering Việt Nam'],
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
            'title'       => 'DAT PHAT - Dịch vụ suất ăn công nghiệp',
            'description' => 'Cung cấp dịch vụ suất ăn công nghiệp chất lượng cao trên toàn quốc Việt Nam.',
            'url'         => null,
            'type'        => 'website',
            'site_name'   => 'DAT PHAT Việt Nam',
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
            'title'       => 'DAT PHAT - Dịch vụ suất ăn công nghiệp',
            'description' => 'DAT PHAT cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm.',
            'url'         => 'current',
            'type'        => 'Organization',
            'images'      => [],
        ],
    ],
];
