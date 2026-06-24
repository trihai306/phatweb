<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

class PartnerController extends Controller
{
    public function index()
    {
        $brandName = CompanyInfo::getValue('brand_name', 'DAT PHAT');
        SEOMeta::setTitle("Đối tác liên kết - {$brandName} NUTRITION");
        SEOMeta::setDescription('Danh sách các nhà cung cấp và đối tác liên kết của DAT PHAT NUTRITION — đảm bảo nguồn nguyên liệu chất lượng, an toàn vệ sinh thực phẩm.');
        OpenGraph::setTitle("Đối tác liên kết - {$brandName}");

        $partners = [
            [
                'name' => 'Công ty cổ phần Tập đoàn DABACO Việt Nam',
                'short_name' => 'DABACO',
                'address' => 'Thôn Nam Viên, Xã Lạc Vệ, Huyện Tiên Du, Tỉnh Bắc Ninh',
                'mst' => '2300345626',
                'category' => 'Thực phẩm chế biến & Trứng',
                'products' => ['Trứng gà', 'Xúc xích', 'Chả cá', 'Chả lụa'],
                'cert_docs' => [
                    ['file' => 'docs/certs/dabaco-attp.pdf', 'label' => 'Giấy chứng nhận ATTP'],
                    ['file' => 'docs/certs/dabaco-dkkd.pdf', 'label' => 'Giấy ĐKKD doanh nghiệp'],
                    ['file' => 'docs/certs/dabaco-vietgap.pdf', 'label' => 'Chứng nhận VietGAP'],
                ],
            ],
            [
                'name' => 'Công ty Cổ phần Kinh doanh Thực phẩm CIDU Việt Nam',
                'short_name' => 'CIDU Việt Nam',
                'address' => 'Thôn Đỗ Xá, Xã Yên Thường, Huyện Gia Lâm, TP. Hà Nội',
                'mst' => '0108946064',
                'category' => 'Gia cầm',
                'products' => ['Gà ta', 'Gà công nghiệp', 'Lườn gà', 'Tỏi đùi gà', 'Cánh gà', 'Chim bồ câu', 'Ngan'],
                'cert_docs' => [
                    ['file' => 'docs/certs/cidu-attp.pdf', 'label' => 'Giấy chứng nhận ATTP'],
                    ['file' => 'docs/certs/cidu-dkkd.pdf', 'label' => 'Giấy ĐKKD doanh nghiệp'],
                ],
            ],
            [
                'name' => 'Công ty TNHH Cung cấp Thực phẩm sạch Minh Ngọc',
                'short_name' => 'Minh Ngọc',
                'address' => 'Tầng 3, Số 31 Lê Văn Thịnh, Phường Suối Hoa, TP. Bắc Ninh, Tỉnh Bắc Ninh',
                'mst' => '2301294276',
                'category' => 'Thịt lợn & Bò',
                'products' => ['Xương (ống/cục/hom)', 'Sườn', 'Nạc (vai/thăn/mông)', 'Sấn', 'Ba rọi', 'Móng giò', 'Mỡ', 'Tim lợn', 'Bò vai', 'Bò mông', 'Bò thăn', 'Bò bắp', 'Bò dẻ sườn'],
                'cert_docs' => [
                    ['file' => 'docs/certs/minh-ngoc-attp.pdf', 'label' => 'Giấy chứng nhận ATTP'],
                    ['file' => 'docs/certs/minh-ngoc-dkkd.pdf', 'label' => 'Giấy ĐKKD doanh nghiệp'],
                ],
            ],
            [
                'name' => 'Hộ kinh doanh Phương Lan',
                'short_name' => 'Phương Lan',
                'address' => 'Thôn An Ninh, Xã Văn Môn, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '2301390029',
                'category' => 'Thịt lợn',
                'products' => ['Xương (ống/cục/hom)', 'Sườn', 'Nạc (vai/thăn/mông)', 'Sấn', 'Ba rọi', 'Móng giò', 'Mỡ', 'Tim lợn'],
                'cert_docs' => [],
            ],
            [
                'name' => 'Hộ kinh doanh Mẫn Xuân Thế',
                'short_name' => 'Mẫn Xuân Thế',
                'address' => 'Khu phố Trác Bút, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '027070002360',
                'category' => 'Rau củ & Gia vị',
                'products' => ['Bắp cải', 'Bí xanh', 'Bí đỏ', 'Cà chua', 'Cà rốt', 'Khoai tây', 'Súp lơ', 'Rau muống', 'Rau cải', 'Gia vị các loại', 'Hoa quả tươi'],
                'cert_docs' => [
                    ['file' => 'docs/certs/man-xuan-the-cam-ket.pdf', 'label' => 'Bản cam kết ATTP'],
                    ['file' => 'docs/certs/man-xuan-the-dkkd.pdf', 'label' => 'Giấy ĐKKD hộ kinh doanh'],
                ],
            ],
            [
                'name' => 'Hộ kinh doanh Nguyễn Mỹ Linh 3',
                'short_name' => 'Nguyễn Mỹ Linh 3',
                'address' => 'Phố Chờ, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '017191001120',
                'category' => 'Thực phẩm chế biến',
                'products' => ['Giò lụa', 'Chả lụa'],
                'cert_docs' => [
                    ['file' => 'docs/certs/nguyen-my-linh-3-dkkd.pdf', 'label' => 'Giấy ĐKKD hộ kinh doanh'],
                ],
            ],
            [
                'name' => 'Công ty TNHH Lương thực Thực phẩm Mến Bưởi',
                'short_name' => 'Mến Bưởi',
                'address' => 'Thôn Nghiêm Xá, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '2300678329',
                'category' => 'Lương thực',
                'products' => ['Gạo BC', 'Gạo nếp cái hoa vàng'],
                'cert_docs' => [
                    ['file' => 'docs/certs/men-buoi-attp.pdf', 'label' => 'Giấy chứng nhận ATTP'],
                    ['file' => 'docs/certs/men-buoi-dkkd.pdf', 'label' => 'Giấy ĐKKD doanh nghiệp'],
                ],
            ],
            [
                'name' => 'Hộ kinh doanh Ngô Thị Hương',
                'short_name' => 'Ngô Thị Hương',
                'address' => null,
                'mst' => '027187013418',
                'category' => 'Khác',
                'products' => [],
                'cert_docs' => [],
            ],
        ];

        return view('partners.index', compact('partners'));
    }
}
