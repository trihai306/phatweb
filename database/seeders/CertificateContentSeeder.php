<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

/**
 * Seeds the company's own food-safety certificate (scanned image committed
 * at public/images/certificates/) onto the certificates page.
 *
 * Safe to run on production (updateOrCreate keyed by image path):
 *
 *   php artisan db:seed --class=CertificateContentSeeder --force
 */
class CertificateContentSeeder extends Seeder
{
    public function run(): void
    {
        // Remove the old text-only placeholders that have no scanned image.
        Certificate::whereNull('image')
            ->whereIn('title', ['ISO 22000:2018', 'HACCP', 'ISO 9001:2015'])
            ->delete();

        // Remove per-page partner-document entries from an earlier revision
        // of this seeder (cert-01.jpg ... cert-47.jpg).
        Certificate::where('image', 'like', 'images/certificates/cert-%')->delete();

        Certificate::updateOrCreate(
            ['image' => 'images/certificates/giay-chung-nhan-attp-dat-phat.jpg'],
            [
                'title' => 'Giấy chứng nhận cơ sở đủ điều kiện An toàn thực phẩm',
                'description' => 'Ban Quản lý An toàn thực phẩm tỉnh Bắc Ninh cấp cho Công ty TNHH Thực phẩm Đạt Phát, hiệu lực đến 17/06/2028.',
                'year' => '2025',
                'sort_order' => 0,
                'is_active' => true,
            ]
        );
    }
}
