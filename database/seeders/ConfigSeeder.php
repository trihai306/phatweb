<?php

namespace Database\Seeders;

use App\Models\CompanyInfo;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        // CompanyInfo defaults
        $companyInfos = [
            ['key' => 'company_name',            'value' => 'Công ty TNHH Dịch vụ Thực phẩm PhatFood',                                                                                                       'group' => 'general'],
            ['key' => 'brand_name',              'value' => 'PhatFood',                                                                                                                                       'group' => 'general'],
            ['key' => 'ceo_name',                'value' => 'Nguyễn Văn Phát',                                                                                                                                'group' => 'general'],
            ['key' => 'founding_year',           'value' => '2013',                                                                                                                                           'group' => 'general'],
            ['key' => 'tagline',                 'value' => 'Hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.',                                                      'group' => 'general'],
            ['key' => 'address',                 'value' => 'Số 21, Đường 8, KCN VSIP Bắc Ninh II, Phường Phù Chẩn, Thị xã Từ Sơn, Bắc Ninh',                                                              'group' => 'contact'],
            ['key' => 'phone',                   'value' => '0222-369-9930',                                                                                                                                  'group' => 'contact'],
            ['key' => 'email',                   'value' => 'info@phatfood.vn',                                                                                                                               'group' => 'contact'],
            ['key' => 'website',                 'value' => 'www.phatfood.vn',                                                                                                                                'group' => 'contact'],
            ['key' => 'business_hours_weekday',  'value' => 'Thứ 2 - Thứ 6: 8:00 - 17:30',                                                                                                                   'group' => 'contact'],
            ['key' => 'business_hours_saturday', 'value' => 'Thứ 7: 8:00 - 12:00',                                                                                                                           'group' => 'contact'],
            ['key' => 'map_embed',               'value' => '',                                                                                                                                               'group' => 'contact'],
            ['key' => 'facebook_url',            'value' => '#',                                                                                                                                              'group' => 'social'],
            ['key' => 'linkedin_url',            'value' => '#',                                                                                                                                              'group' => 'social'],
            ['key' => 'youtube_url',             'value' => '#',                                                                                                                                              'group' => 'social'],
        ];

        foreach ($companyInfos as $info) {
            CompanyInfo::updateOrCreate(
                ['key' => $info['key']],
                ['value' => $info['value'], 'group' => $info['group']]
            );
        }

        // Setting defaults
        $settings = [
            ['key' => 'seo_title',          'value' => 'PhatFood - Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam',                                                                                     'group' => 'seo'],
            ['key' => 'seo_description',    'value' => 'PhatFood cung cấp dịch vụ suất ăn công nghiệp chất lượng cao, an toàn vệ sinh thực phẩm với thực đơn phù hợp đặc trưng từng vùng miền.',      'group' => 'seo'],
            ['key' => 'seo_keywords',       'value' => 'suất ăn công nghiệp, dịch vụ ăn uống, PhatFood, suất ăn doanh nghiệp',                                                                        'group' => 'seo'],
            ['key' => 'seo_og_image',       'value' => '',                                                                                                                                              'group' => 'seo'],
            ['key' => 'primary_color',      'value' => '#19592F',                                                                                                                                       'group' => 'appearance'],
            ['key' => 'primary_dark_color', 'value' => '#12472A',                                                                                                                                       'group' => 'appearance'],
            ['key' => 'primary_light_color','value' => '#7FBF3F',                                                                                                                                       'group' => 'appearance'],
            ['key' => 'accent_color',       'value' => '#F0F7E6',                                                                                                                                       'group' => 'appearance'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
