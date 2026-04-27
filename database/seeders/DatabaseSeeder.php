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

        Slider::create(['title' => 'Điều cơ bản của ẩm thực xuất phát từ sự tươi ngon và an toàn', 'subtitle' => 'DAT PHAT - Dịch vụ suất ăn chất lượng, an toàn', 'image' => 'sliders/slide1.jpg', 'sort_order' => 0]);
        Slider::create(['title' => 'Chất lượng là ưu tiên hàng đầu', 'subtitle' => 'Chúng tôi cam kết mang đến những bữa ăn ngon, sạch và an toàn', 'image' => 'sliders/slide2.jpg', 'sort_order' => 1]);

        Service::create([
            'title' => 'Suất ăn trường học',
            'description' => 'Cung cấp bữa ăn dinh dưỡng, an toàn cho học sinh các cấp từ mầm non đến THPT, đảm bảo sự phát triển toàn diện cho trẻ.',
            'content' => '<h2>Giải pháp suất ăn trường học chuyên nghiệp</h2>
<p>DAT PHAT hiểu rằng bữa ăn tại trường không chỉ đơn thuần là cung cấp năng lượng mà còn ảnh hưởng trực tiếp đến sức khỏe, sự phát triển và khả năng học tập của các em học sinh.</p>
<h3>Đặc điểm dịch vụ</h3>
<ul>
<li><strong>Thực đơn cân bằng dinh dưỡng:</strong> Được xây dựng bởi chuyên gia dinh dưỡng, phù hợp với từng lứa tuổi từ mầm non đến THPT</li>
<li><strong>Nguyên liệu tươi sạch:</strong> 100% nguyên liệu có nguồn gốc xuất xứ rõ ràng, kiểm tra chất lượng hàng ngày</li>
<li><strong>Quy trình ATTP nghiêm ngặt:</strong> Tuân thủ tiêu chuẩn ISO 22000 & HACCP, kiểm soát từ khâu nhập liệu đến khi phục vụ</li>
<li><strong>Đa dạng thực đơn:</strong> Thay đổi theo tuần, tháng, mùa để các em không nhàm chán</li>
<li><strong>Phục vụ tận nơi:</strong> Giao suất ăn đúng giờ, đảm bảo nhiệt độ và chất lượng</li>
</ul>
<h3>Cam kết của chúng tôi</h3>
<p>Mỗi bữa ăn đều được giám sát chặt chẽ bởi đội ngũ quản lý chất lượng. Phụ huynh hoàn toàn yên tâm khi gửi gắm bữa ăn của con em mình cho DAT PHAT.</p>',
            'image' => 'services/school.jpg',
            'sort_order' => 0,
        ]);

        Service::create([
            'title' => 'Suất ăn công nghiệp',
            'description' => 'Cung cấp suất ăn chất lượng cho các nhà máy, khu công nghiệp với quy trình ATTP nghiêm ngặt và thực đơn đa dạng.',
            'content' => '<h2>Suất ăn công nghiệp quy mô lớn</h2>
<p>Với kinh nghiệm phục vụ tại nhiều khu công nghiệp lớn, DAT PHAT mang đến giải pháp suất ăn toàn diện cho doanh nghiệp với quy mô từ vài trăm đến hàng chục nghìn suất ăn mỗi ngày.</p>
<h3>Năng lực phục vụ</h3>
<ul>
<li><strong>Linh hoạt quy mô:</strong> Phục vụ từ vài trăm đến hàng nghìn suất ăn mỗi ngày theo nhu cầu</li>
<li><strong>Đối tác:</strong> Các nhà máy, xí nghiệp tại khu vực Bắc Ninh và lân cận</li>
<li><strong>Vùng phục vụ:</strong> Tập trung khu vực miền Bắc, đang mở rộng thêm</li>
<li><strong>Thực đơn vùng miền:</strong> Phù hợp với đặc trưng ẩm thực từng khu vực</li>
</ul>
<h3>Quy trình vận hành</h3>
<p>Hệ thống bếp ăn được trang bị hiện đại, vận hành theo quy trình khép kín từ khâu thu mua, chế biến, bảo quản đến phục vụ, đảm bảo tiêu chuẩn ATTP nghiêm ngặt nhất.</p>',
            'image' => 'services/industrial.jpg',
            'sort_order' => 1,
        ]);

        Service::create([
            'title' => 'Suất ăn dinh dưỡng',
            'description' => 'Thực đơn dinh dưỡng được thiết kế bởi chuyên gia, phù hợp với thể trạng và nhu cầu sức khỏe từng đối tượng.',
            'content' => '<h2>Suất ăn dinh dưỡng theo yêu cầu</h2>
<p>Hiểu được tính chất đặc biệt của suất ăn dinh dưỡng, DAT PHAT xây dựng thực đơn cân bằng dinh dưỡng, an toàn và phục hồi sức khỏe một cách nhanh chóng.</p>
<h3>Đối tượng phục vụ</h3>
<ul>
<li><strong>Bệnh nhân:</strong> Thực đơn phù hợp với từng bệnh lý (tiểu đường, huyết áp, tim mạch...)</li>
<li><strong>Người cao tuổi:</strong> Dễ tiêu hóa, giàu dinh dưỡng, phù hợp thể trạng</li>
<li><strong>Vận động viên:</strong> Giàu protein, năng lượng cao, hỗ trợ phục hồi cơ bắp</li>
<li><strong>Phụ nữ mang thai:</strong> Đảm bảo đầy đủ vi chất cho mẹ và bé</li>
</ul>
<h3>Quy trình xây dựng thực đơn</h3>
<p>Mỗi thực đơn đều được chuyên gia dinh dưỡng tư vấn và xây dựng, đảm bảo phù hợp với thể chất và thể trạng từng người, nhằm mang đến bữa ăn tốt nhất.</p>',
            'image' => 'services/nutrition.jpg',
            'sort_order' => 2,
        ]);

        Service::create([
            'title' => 'Tiệc & sự kiện',
            'description' => 'Dịch vụ tiệc buffet, hội nghị, sự kiện với thực đơn phong phú, trang trí chuyên nghiệp và phục vụ tận tâm.',
            'content' => '<h2>Dịch vụ tiệc & sự kiện chuyên nghiệp</h2>
<p>DAT PHAT cung cấp dịch vụ tiệc trọn gói cho các sự kiện doanh nghiệp, hội nghị, tiệc cưới và các dịp đặc biệt với chất lượng ẩm thực cao cấp.</p>
<h3>Các loại hình tiệc</h3>
<ul>
<li><strong>Tiệc buffet:</strong> Đa dạng món ăn, phù hợp sự kiện quy mô lớn</li>
<li><strong>Tiệc hội nghị:</strong> Set menu chuyên nghiệp, phục vụ nhanh gọn</li>
<li><strong>Tiệc kỷ niệm:</strong> Thực đơn đặc biệt cho các dịp lễ, kỷ niệm công ty</li>
<li><strong>Tea break:</strong> Bánh ngọt, trà, cà phê cho các buổi họp và hội thảo</li>
</ul>',
            'image' => 'services/event.jpg',
            'sort_order' => 3,
        ]);

        Service::create([
            'title' => 'Cung ứng thực phẩm sạch',
            'description' => 'Cung cấp nguồn thực phẩm tươi sạch, có truy xuất nguồn gốc rõ ràng cho nhà hàng, bếp ăn tập thể.',
            'content' => '<h2>Cung ứng thực phẩm sạch</h2>
<p>Với chuỗi cung ứng khép kín và hệ thống kiểm soát chất lượng nghiêm ngặt, DAT PHAT cung cấp nguồn thực phẩm tươi sạch, đảm bảo truy xuất nguồn gốc cho mọi đối tác.</p>
<h3>Sản phẩm cung ứng</h3>
<ul>
<li><strong>Rau củ quả:</strong> Thu mua từ các vùng trồng an toàn, kiểm tra dư lượng thuốc BVTV</li>
<li><strong>Thịt, cá, hải sản:</strong> Nguồn gốc rõ ràng, bảo quản lạnh đúng tiêu chuẩn</li>
<li><strong>Gia vị, nguyên liệu khô:</strong> Nhập từ các nhà cung cấp uy tín, có chứng nhận ATTP</li>
</ul>
<h3>Hệ thống truy xuất nguồn gốc</h3>
<p>Mỗi lô hàng đều có mã truy xuất, giúp đối tác và người tiêu dùng hoàn toàn yên tâm về chất lượng và an toàn thực phẩm.</p>',
            'image' => 'services/supply.jpg',
            'sort_order' => 4,
        ]);

        Service::create([
            'title' => 'Đa dạng hoá thực đơn',
            'description' => 'Liên tục nghiên cứu và đổi mới thực đơn với hàng trăm công thức món ăn, mang đến trải nghiệm ẩm thực phong phú.',
            'content' => '<h2>Đa dạng hoá thực đơn</h2>
<p>DAT PHAT liên tục nghiên cứu và phát triển thực đơn mới bởi đội ngũ đầu bếp tâm huyết, đảm bảo thực đơn luôn mới mẻ và hấp dẫn.</p>
<h3>Đặc điểm nổi bật</h3>
<ul>
<li><strong>Ẩm thực 3 miền:</strong> Đặc trưng Bắc – Trung – Nam, phù hợp khẩu vị từng vùng</li>
<li><strong>Món Á – Âu:</strong> Đa dạng phong cách ẩm thực quốc tế</li>
<li><strong>Món theo mùa:</strong> Tận dụng nguyên liệu theo mùa, tươi ngon nhất</li>
<li><strong>Món đặc biệt:</strong> Thực đơn cho các dịp lễ, Tết, sự kiện đặc biệt</li>
</ul>
<h3>Đội ngũ R&D</h3>
<p>Bộ phận nghiên cứu và phát triển liên tục sáng tạo công thức mới, khảo sát ý kiến thực khách để cải tiến thực đơn, mang đến sự hài lòng tối đa cho khách hàng.</p>',
            'image' => 'services/diverse.jpg',
            'sort_order' => 5,
        ]);

        FoodMenu::create(['title' => 'Thực đơn ngày', 'description' => 'Hãy cùng đến với những thực đơn thơm ngon và lành mạnh', 'image' => 'menus/daily.jpg', 'category' => 'daily', 'sort_order' => 0]);
        FoodMenu::create(['title' => 'Thực đơn đặc biệt', 'description' => 'Thực đơn đặc biệt theo mùa và sự kiện', 'image' => 'menus/special.jpg', 'category' => 'special', 'sort_order' => 1]);

        Strength::create(['title' => 'Thực phẩm tươi ngon', 'description' => 'Đổi mới hệ thống ăn uống với nguyên liệu thực phẩm tươi ngon gần gũi với thiên nhiên', 'content' => '<p>Chúng tôi cam kết sử dụng nguyên liệu tươi ngon nhất.</p>', 'image' => 'strengths/fresh.jpg', 'icon' => null, 'sort_order' => 0]);
        Strength::create(['title' => 'Thực phẩm an toàn', 'description' => 'Sự an tâm có thể thấy được bằng mắt, nguyên liệu xuất xứ rõ ràng, hệ thống lành mạnh', 'content' => '<p>An toàn vệ sinh thực phẩm là ưu tiên hàng đầu.</p>', 'image' => 'strengths/safe.jpg', 'icon' => null, 'sort_order' => 1]);
        Strength::create(['title' => 'Hương vị thơm ngon', 'description' => 'Công thức nấu ăn vượt trội mang tính khoa học', 'content' => '<p>Công thức nấu ăn được nghiên cứu khoa học.</p>', 'image' => 'strengths/tasty.jpg', 'icon' => null, 'sort_order' => 2]);
        Strength::create(['title' => 'Dịch vụ khách hàng', 'description' => 'Nắm bắt được tâm lý khách hàng, tạo niềm vui trong từng bữa ăn', 'content' => '<p>Dịch vụ khách hàng tận tâm và chuyên nghiệp.</p>', 'image' => 'strengths/service.jpg', 'icon' => null, 'sort_order' => 3]);

        Statistic::create(['label' => 'Năm kinh nghiệm', 'value' => '3+', 'unit' => 'năm', 'icon' => null, 'sort_order' => 0]);
        Statistic::create(['label' => 'Khách hàng tin tưởng', 'value' => '50+', 'unit' => 'trường & doanh nghiệp', 'icon' => null, 'sort_order' => 1]);
        Statistic::create(['label' => 'Chứng nhận ATTP', 'value' => '100%', 'unit' => 'đạt chuẩn', 'icon' => null, 'sort_order' => 2]);
        Statistic::create(['label' => 'Hài lòng khách hàng', 'value' => '98%', 'unit' => 'đánh giá tích cực', 'icon' => null, 'sort_order' => 3]);

        Page::create(['title' => 'Về chúng tôi', 'slug' => 've-chung-toi', 'section' => 'aboutus', 'excerpt' => 'DAT PHAT Việt Nam hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.', 'content' => '<p>DAT PHAT Việt Nam hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.</p>', 'sort_order' => 0, 'meta_title' => 'Về chúng tôi - DAT PHAT Việt Nam']);
        Page::create(['title' => 'Kinh doanh bền vững', 'slug' => 'kinh-doanh-ben-vung', 'section' => 'aboutus', 'content' => '<p>DAT PHAT cam kết phát triển kinh doanh bền vững, bảo vệ môi trường.</p>', 'sort_order' => 1]);
        Page::create(['title' => 'Tầm nhìn', 'slug' => 'tam-nhin', 'section' => 'aboutus', 'content' => '<p>Trở thành đơn vị cung cấp dịch vụ suất ăn uy tín, được khách hàng tin tưởng lựa chọn.</p>', 'sort_order' => 2]);
        Page::create(['title' => 'Lịch sử', 'slug' => 'lich-su', 'section' => 'aboutus', 'content' => '<p>Lịch sử phát triển của DAT PHAT Việt Nam.</p>', 'sort_order' => 3]);
        Page::create(['title' => 'Chứng nhận', 'slug' => 'chung-nhan', 'section' => 'aboutus', 'content' => '<p>Các chứng nhận chất lượng và an toàn thực phẩm.</p>', 'sort_order' => 4]);

        HistoryMilestone::create(['year' => '2022', 'title' => 'Thành lập công ty', 'description' => 'DAT PHAT chính thức được thành lập, bắt đầu cung cấp dịch vụ suất ăn tại Bắc Ninh', 'sort_order' => 0]);
        HistoryMilestone::create(['year' => '2023', 'title' => 'Mở rộng khách hàng', 'description' => 'Ký hợp đồng cung cấp suất ăn cho nhiều trường học trong khu vực', 'sort_order' => 1]);
        HistoryMilestone::create(['year' => '2024', 'title' => 'Đạt chứng nhận ATTP', 'description' => 'Hoàn thiện quy trình và đạt chứng nhận an toàn thực phẩm', 'sort_order' => 2]);
        HistoryMilestone::create(['year' => '2025', 'title' => 'Mở rộng dịch vụ', 'description' => 'Phát triển thêm mảng suất ăn công nghiệp và sự kiện', 'sort_order' => 3]);

        Certificate::create(['title' => 'ISO 22000:2018', 'description' => 'Hệ thống quản lý an toàn thực phẩm', 'year' => '2019', 'sort_order' => 0]);
        Certificate::create(['title' => 'HACCP', 'description' => 'Phân tích mối nguy và điểm kiểm soát tới hạn', 'year' => '2018', 'sort_order' => 1]);
        Certificate::create(['title' => 'ISO 9001:2015', 'description' => 'Hệ thống quản lý chất lượng', 'year' => '2020', 'sort_order' => 2]);

        Career::create(['title' => 'Nhân viên bếp', 'department' => 'Sản xuất', 'location' => 'Bắc Ninh', 'description' => '<p>Tuyển nhân viên bếp cho các nhà ăn tại KCN Bắc Ninh.</p>', 'requirements' => '<p>Có kinh nghiệm nấu ăn ít nhất 1 năm.</p>', 'benefits' => '<p>Lương cạnh tranh, bảo hiểm đầy đủ.</p>', 'salary_range' => '8-12 triệu', 'deadline' => now()->addMonths(2)]);
        Career::create(['title' => 'Quản lý nhà ăn', 'department' => 'Quản lý', 'location' => 'Hà Nội', 'description' => '<p>Quản lý vận hành nhà ăn công nghiệp.</p>', 'requirements' => '<p>Kinh nghiệm quản lý F&B ít nhất 3 năm.</p>', 'benefits' => '<p>Lương thưởng hấp dẫn, cơ hội thăng tiến.</p>', 'salary_range' => '15-25 triệu', 'deadline' => now()->addMonths(3)]);

        $this->call(ConfigSeeder::class);
    }
}
