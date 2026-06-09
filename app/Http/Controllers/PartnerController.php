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
                'cert_pages' => 'Trang 1; 28; 22',
            ],
            [
                'name' => 'Công ty TNHH CIDU Việt Nam',
                'short_name' => 'CIDU Việt Nam',
                'address' => 'Thôn Đỗ Xá, Xã Yên Thường, Huyện Gia Lâm, TP. Hà Nội',
                'mst' => '0108946064',
                'category' => 'Gia cầm',
                'products' => ['Gà ta', 'Gà công nghiệp', 'Lườn gà', 'Tỏi đùi gà', 'Cánh gà', 'Chim bồ câu', 'Ngan'],
                'cert_pages' => 'Trang 5; 38',
            ],
            [
                'name' => 'Công ty TNHH Thực phẩm Minh Ngọc',
                'short_name' => 'Minh Ngọc',
                'address' => 'Tầng 3, Số 31 Lê Văn Thịnh, Phường Suối Hoa, TP. Bắc Ninh, Tỉnh Bắc Ninh',
                'mst' => '2301294276',
                'category' => 'Thịt lợn & Bò',
                'products' => ['Xương (ống/cục/hom)', 'Sườn', 'Nạc (vai/thăn/mông)', 'Sấn', 'Ba rọi', 'Móng giò', 'Mỡ', 'Tim lợn', 'Bò vai', 'Bò mông', 'Bò thăn', 'Bò bắp', 'Bò dẻ sườn'],
                'cert_pages' => 'Trang 9; 10',
            ],
            [
                'name' => 'Hộ kinh doanh Phương Lan',
                'short_name' => 'Phương Lan',
                'address' => 'Thôn An Ninh, Xã Văn Môn, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '2301390029',
                'category' => 'Thịt lợn',
                'products' => ['Xương (ống/cục/hom)', 'Sườn', 'Nạc (vai/thăn/mông)', 'Sấn', 'Ba rọi', 'Móng giò', 'Mỡ', 'Tim lợn'],
                'cert_pages' => null,
            ],
            [
                'name' => 'Hộ kinh doanh Mẫn Xuân Thế',
                'short_name' => 'Mẫn Xuân Thế',
                'address' => 'Khu phố Trác Bút, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '027070002360',
                'category' => 'Rau củ & Gia vị',
                'products' => ['Bắp cải', 'Bí xanh', 'Bí đỏ', 'Cà chua', 'Cà rốt', 'Khoai tây', 'Súp lơ', 'Rau muống', 'Rau cải', 'Gia vị các loại', 'Hoa quả tươi'],
                'cert_pages' => 'Trang 25; 17',
            ],
            [
                'name' => 'Hộ kinh doanh Nguyễn Mỹ Linh 3',
                'short_name' => 'Nguyễn Mỹ Linh 3',
                'address' => 'Phố Chờ, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '017191001120',
                'category' => 'Thực phẩm chế biến',
                'products' => ['Giò lụa', 'Chả lụa'],
                'cert_pages' => 'Trang 44',
            ],
            [
                'name' => 'Hộ kinh doanh Mến Bưởi',
                'short_name' => 'Mến Bưởi',
                'address' => 'Thôn Nghiêm Xá, Thị trấn Chờ, Huyện Yên Phong, Tỉnh Bắc Ninh',
                'mst' => '2300678329',
                'category' => 'Lương thực',
                'products' => ['Gạo BC', 'Gạo nếp cái hoa vàng'],
                'cert_pages' => 'Trang 45; 40',
            ],
            [
                'name' => 'Hộ kinh doanh Ngô Thị Hương',
                'short_name' => 'Ngô Thị Hương',
                'address' => null,
                'mst' => '027187013418',
                'category' => 'Khác',
                'products' => [],
                'cert_pages' => null,
            ],
        ];

        return view('partners.index', compact('partners'));
    }
}
