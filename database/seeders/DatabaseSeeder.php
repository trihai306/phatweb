<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Service;
use App\Models\FoodMenu;
use App\Models\Strength;
use App\Models\Statistic;
use App\Models\Certificate;
use App\Models\Career;
use App\Models\HistoryMilestone;
use App\Models\CompanyInfo;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@phatfood.vn',
            'password' => bcrypt('password'),
        ]);

        $companyInfos = [
            ['key' => 'company_name', 'value' => 'DAT PHAT Việt Nam', 'group' => 'general'],
            ['key' => 'ceo', 'value' => 'PARK HAN SOON', 'group' => 'general'],
            ['key' => 'founded', 'value' => '26.12.2014', 'group' => 'general'],
            ['key' => 'revenue', 'value' => '2,000 tỷ đồng (Năm 2020)', 'group' => 'general'],
            ['key' => 'address', 'value' => 'Số 21, Đường 8, KCN Thương mại và Dịch vụ VSIP Bắc Ninh II, Xã Tam Giang, Huyện Yên Phong, Tỉnh Bắc Ninh, Việt Nam', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '0222-369-9930', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@phatfood.vn', 'group' => 'contact'],
        ];
        foreach ($companyInfos as $i => $info) {
            CompanyInfo::create(array_merge($info, ['sort_order' => $i]));
        }

        $settings = [
            ['key' => 'site_name', 'value' => 'DAT PHAT Việt Nam', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam', 'group' => 'seo'],
            ['key' => 'site_keywords', 'value' => 'suất ăn công nghiệp, dịch vụ ăn uống, DAT PHAT', 'group' => 'seo'],
        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        Slider::create(['title' => 'Điều cơ bản của ẩm thực xuất phát từ sự tươi ngon và an toàn', 'subtitle' => 'DAT PHAT - Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam', 'image' => 'sliders/slide1.jpg', 'sort_order' => 0]);
        Slider::create(['title' => 'Chất lượng là ưu tiên hàng đầu', 'subtitle' => 'Chúng tôi cam kết mang đến những bữa ăn ngon, sạch và an toàn', 'image' => 'sliders/slide2.jpg', 'sort_order' => 1]);

        Service::create(['title' => 'Miền Bắc', 'description' => 'Với tổng số 61 nhà ăn, chúng tôi đang cung cấp dịch vụ ăn uống với quy mô 250 nghìn suất ăn mỗi ngày.', 'content' => '<p>Dịch vụ ăn uống miền Bắc với các bếp ăn đại diện tại công ty điện tử Samsung, Elentec, Hyosung.</p>', 'image' => 'services/north.jpg', 'sort_order' => 0]);
        Service::create(['title' => 'Miền Nam', 'description' => 'Chúng tôi cũng đã xây dựng góc ẩm thực phù hợp với đặc trưng văn hóa ẩm thực Nam Bộ.', 'content' => '<p>Dịch vụ ăn uống miền Nam phù hợp văn hóa ẩm thực Nam Bộ.</p>', 'image' => 'services/south.jpg', 'sort_order' => 1]);
        Service::create(['title' => 'Miền Trung', 'description' => 'Chúng tôi sẽ liên tục nghiên cứu và phát triển để cung cấp dịch vụ ăn uống tốt nhất.', 'content' => '<p>Dịch vụ ăn uống miền Trung chuyên biệt theo vùng miền.</p>', 'image' => 'services/central.jpg', 'sort_order' => 2]);

        FoodMenu::create(['title' => 'Thực đơn ngày', 'description' => 'Hãy cùng đến với những thực đơn thơm ngon và lành mạnh', 'image' => 'menus/daily.jpg', 'category' => 'daily', 'sort_order' => 0]);
        FoodMenu::create(['title' => 'Thực đơn đặc biệt', 'description' => 'Thực đơn đặc biệt theo mùa và sự kiện', 'image' => 'menus/special.jpg', 'category' => 'special', 'sort_order' => 1]);

        Strength::create(['title' => 'Thực phẩm tươi ngon', 'description' => 'Đổi mới hệ thống ăn uống với nguyên liệu thực phẩm tươi ngon gần gũi với thiên nhiên', 'content' => '<p>Chúng tôi cam kết sử dụng nguyên liệu tươi ngon nhất.</p>', 'image' => 'strengths/fresh.jpg', 'icon' => '🥬', 'sort_order' => 0]);
        Strength::create(['title' => 'Thực phẩm an toàn', 'description' => 'Sự an tâm có thể thấy được bằng mắt, nguyên liệu xuất xứ rõ ràng, hệ thống lành mạnh', 'content' => '<p>An toàn vệ sinh thực phẩm là ưu tiên hàng đầu.</p>', 'image' => 'strengths/safe.jpg', 'icon' => '🛡️', 'sort_order' => 1]);
        Strength::create(['title' => 'Hương vị thơm ngon', 'description' => 'Công thức nấu ăn vượt trội mang tính khoa học', 'content' => '<p>Công thức nấu ăn được nghiên cứu khoa học.</p>', 'image' => 'strengths/tasty.jpg', 'icon' => '👨‍🍳', 'sort_order' => 2]);
        Strength::create(['title' => 'Dịch vụ khách hàng', 'description' => 'Nắm bắt được tâm lý khách hàng, tạo niềm vui trong từng bữa ăn', 'content' => '<p>Dịch vụ khách hàng tận tâm và chuyên nghiệp.</p>', 'image' => 'strengths/service.jpg', 'icon' => '💝', 'sort_order' => 3]);

        Statistic::create(['label' => 'Nhân viên', 'value' => '3,500', 'unit' => 'người', 'icon' => '👥', 'sort_order' => 0]);
        Statistic::create(['label' => 'Suất ăn mỗi ngày', 'value' => '250,000', 'unit' => 'suất ăn/ngày', 'icon' => '🍽️', 'sort_order' => 1]);
        Statistic::create(['label' => 'Nhà ăn', 'value' => '61', 'unit' => 'nhà ăn', 'icon' => '🏢', 'sort_order' => 2]);
        Statistic::create(['label' => 'Công thức món ăn', 'value' => '20,000', 'unit' => 'công thức', 'icon' => '📋', 'sort_order' => 3]);
        Statistic::create(['label' => 'Doanh thu', 'value' => '2,000', 'unit' => 'tỷ đồng', 'icon' => '📊', 'sort_order' => 4]);

        Page::create(['title' => 'Về chúng tôi', 'slug' => 've-chung-toi', 'section' => 'aboutus', 'excerpt' => 'DAT PHAT Việt Nam hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.', 'content' => '<p>DAT PHAT Việt Nam hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.</p>', 'sort_order' => 0, 'meta_title' => 'Về chúng tôi - DAT PHAT Việt Nam']);
        Page::create(['title' => 'Kinh doanh bền vững', 'slug' => 'kinh-doanh-ben-vung', 'section' => 'aboutus', 'content' => '<p>DAT PHAT cam kết phát triển kinh doanh bền vững, bảo vệ môi trường.</p>', 'sort_order' => 1]);
        Page::create(['title' => 'Tầm nhìn', 'slug' => 'tam-nhin', 'section' => 'aboutus', 'content' => '<p>Trở thành công ty cung cấp dịch vụ suất ăn công nghiệp số 1 tại Việt Nam.</p>', 'sort_order' => 2]);
        Page::create(['title' => 'Lịch sử', 'slug' => 'lich-su', 'section' => 'aboutus', 'content' => '<p>Lịch sử phát triển của DAT PHAT Việt Nam.</p>', 'sort_order' => 3]);
        Page::create(['title' => 'Chứng nhận', 'slug' => 'chung-nhan', 'section' => 'aboutus', 'content' => '<p>Các chứng nhận chất lượng và an toàn thực phẩm.</p>', 'sort_order' => 4]);

        HistoryMilestone::create(['year' => '2014', 'title' => 'Thành lập công ty', 'description' => 'DAT PHAT Việt Nam chính thức được thành lập vào ngày 26/12/2014', 'sort_order' => 0]);
        HistoryMilestone::create(['year' => '2016', 'title' => 'Mở rộng miền Bắc', 'description' => 'Mở rộng dịch vụ suất ăn tại các KCN khu vực miền Bắc', 'sort_order' => 1]);
        HistoryMilestone::create(['year' => '2018', 'title' => 'Phát triển miền Nam', 'description' => 'Mở rộng dịch vụ vào thị trường miền Nam Việt Nam', 'sort_order' => 2]);
        HistoryMilestone::create(['year' => '2020', 'title' => 'Doanh thu 2,000 tỷ đồng', 'description' => 'Đạt mốc doanh thu 2,000 tỷ đồng với 3,500 nhân viên', 'sort_order' => 3]);
        HistoryMilestone::create(['year' => '2022', 'title' => 'Đạt 61 nhà ăn', 'description' => 'Vận hành 61 nhà ăn trên toàn quốc, phục vụ 250,000 suất ăn/ngày', 'sort_order' => 4]);

        Certificate::create(['title' => 'ISO 22000:2018', 'description' => 'Hệ thống quản lý an toàn thực phẩm', 'year' => '2019', 'sort_order' => 0]);
        Certificate::create(['title' => 'HACCP', 'description' => 'Phân tích mối nguy và điểm kiểm soát tới hạn', 'year' => '2018', 'sort_order' => 1]);
        Certificate::create(['title' => 'ISO 9001:2015', 'description' => 'Hệ thống quản lý chất lượng', 'year' => '2020', 'sort_order' => 2]);

        Career::create(['title' => 'Nhân viên bếp', 'department' => 'Sản xuất', 'location' => 'Bắc Ninh', 'description' => '<p>Tuyển nhân viên bếp cho các nhà ăn tại KCN Bắc Ninh.</p>', 'requirements' => '<p>Có kinh nghiệm nấu ăn ít nhất 1 năm.</p>', 'benefits' => '<p>Lương cạnh tranh, bảo hiểm đầy đủ.</p>', 'salary_range' => '8-12 triệu', 'deadline' => now()->addMonths(2)]);
        Career::create(['title' => 'Quản lý nhà ăn', 'department' => 'Quản lý', 'location' => 'Hà Nội', 'description' => '<p>Quản lý vận hành nhà ăn công nghiệp.</p>', 'requirements' => '<p>Kinh nghiệm quản lý F&B ít nhất 3 năm.</p>', 'benefits' => '<p>Lương thưởng hấp dẫn, cơ hội thăng tiến.</p>', 'salary_range' => '15-25 triệu', 'deadline' => now()->addMonths(3)]);

        $this->call(ConfigSeeder::class);
    }
}
