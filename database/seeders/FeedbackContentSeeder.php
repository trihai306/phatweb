<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Statistic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Idempotent content updates from client feedback (26.6).
 *
 * Safe to run on production: uses updateOrCreate / targeted updates only,
 * never truncates tables, so existing data (e.g. contacts) is preserved.
 *
 *   php artisan db:seed --class=FeedbackContentSeeder --force
 */
class FeedbackContentSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 've-chung-toi'],
            [
                'title' => 'Về chúng tôi',
                'section' => 'aboutus',
                'excerpt' => 'Kiến tạo giá trị từ những điều thiết yếu nhất.',
                'content' => self::aboutContent(),
                'sort_order' => 0,
                'meta_title' => 'Về chúng tôi - DAT PHAT NUTRITION',
                'is_active' => true,
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'kinh-doanh-ben-vung'],
            [
                'title' => 'Kinh doanh bền vững',
                'section' => 'aboutus',
                'excerpt' => 'Phát triển hôm nay vì những giá trị lâu dài.',
                'content' => self::sustainabilityContent(),
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // The Page model auto-generates slug from title (Spatie HasSlug). Because the
        // title "Tầm nhìn & Sứ mệnh" would regenerate the slug to "tam-nhin-su-menh" on
        // update, we match by either slug and force the canonical slug back afterwards
        // so routing (/ve-chung-toi/tam-nhin) stays stable and the seeder is idempotent.
        $tamNhin = Page::where('section', 'aboutus')
            ->whereIn('slug', ['tam-nhin', 'tam-nhin-su-menh'])
            ->first() ?? new Page();
        $tamNhin->fill([
            'title' => 'Tầm nhìn & Sứ mệnh',
            'section' => 'aboutus',
            'excerpt' => 'Kiến tạo giá trị từ những điều thiết yếu nhất.',
            'content' => self::visionContent(),
            'sort_order' => 2,
            'is_active' => true,
        ]);
        $tamNhin->slug = 'tam-nhin';
        $tamNhin->save();
        DB::table('pages')->where('id', $tamNhin->id)->update(['slug' => 'tam-nhin']);

        // Feedback mục 5: "Lịch sử công ty: BỎ"
        Page::where('slug', 'lich-su')->where('section', 'aboutus')->delete();

        // Feedback: số năm kinh nghiệm 8+ -> 7+ (thành lập 2019)
        Statistic::where('label', 'Năm kinh nghiệm')->update(['value' => '7+']);
    }

    public static function aboutContent(): string
    {
        return <<<'HTML'
<h2>Kiến tạo giá trị từ những điều thiết yếu nhất</h2>
<p>Mỗi ngày, hàng triệu bữa ăn được chuẩn bị trên khắp Việt Nam. Đằng sau mỗi bữa ăn chất lượng là một chuỗi cung ứng vận hành chính xác, một nguồn nguyên liệu được kiểm soát nghiêm ngặt và những con người luôn đặt trách nhiệm lên hàng đầu.</p>
<p>Công ty TNHH Thực phẩm Đạt Phát được thành lập từ niềm tin rằng thực phẩm không chỉ là nhu cầu thiết yếu, mà còn là nền tảng của sức khỏe, sự phát triển và chất lượng cuộc sống. Vì vậy, chúng tôi lựa chọn bắt đầu từ điều quan trọng nhất: xây dựng một hệ thống cung ứng thực phẩm minh bạch, an toàn và bền vững, nơi mỗi sản phẩm đều được tạo nên bằng sự tận tâm và trách nhiệm.</p>
<p>Trên hành trình phát triển, Đạt Phát không chỉ hướng đến việc cung cấp thực phẩm, mà còn mong muốn trở thành đối tác đáng tin cậy của các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn trên cả nước, góp phần tạo nên những bữa ăn đạt chuẩn về chất lượng, dinh dưỡng và an toàn.</p>
<h3>Hành trình bắt đầu từ niềm tin</h3>
<p>Ngay từ những ngày đầu hoạt động, Đạt Phát xác định rằng giá trị của một doanh nghiệp thực phẩm không được đo bằng số lượng sản phẩm bán ra, mà được khẳng định bằng sự an tâm của khách hàng sau mỗi lần hợp tác.</p>
<p>Từ nền tảng cung ứng thực phẩm và vận hành suất ăn, chúng tôi từng bước mở rộng năng lực, đầu tư vào hệ thống quản lý chất lượng, phát triển mạng lưới đối tác, hoàn thiện quy trình kiểm soát và xây dựng đội ngũ chuyên môn nhằm đáp ứng những yêu cầu ngày càng cao của thị trường.</p>
<p>Mỗi bước phát triển đều được xây dựng trên ba nguyên tắc cốt lõi:</p>
<ul>
<li>Lấy chất lượng làm nền tảng.</li>
<li>Lấy uy tín làm cam kết.</li>
<li>Lấy sự phát triển bền vững làm định hướng lâu dài.</li>
</ul>
<p>Chúng tôi tin rằng, chỉ khi giữ vững những giá trị đó, doanh nghiệp mới có thể tạo dựng niềm tin và phát triển bền vững cùng khách hàng.</p>
<h3>Hệ sinh thái cung ứng thực phẩm toàn diện</h3>
<p>Đạt Phát không đơn thuần là đơn vị cung cấp thực phẩm. Chúng tôi đang từng bước xây dựng một hệ sinh thái cung ứng toàn diện nhằm tối ưu hóa mọi mắt xích trong chuỗi giá trị thực phẩm.</p>
<p>Hệ sinh thái của Đạt Phát bao gồm:</p>
<ul>
<li>Cung ứng nguyên liệu thực phẩm tươi sống và thực phẩm chế biến.</li>
<li>Kiểm soát chất lượng và truy xuất nguồn gốc.</li>
<li>Sơ chế, bảo quản và vận chuyển theo quy trình tiêu chuẩn.</li>
<li>Cung cấp giải pháp vận hành bếp ăn và suất ăn chuyên nghiệp.</li>
<li>Tư vấn trang thiết bị và tối ưu quy trình vận hành.</li>
</ul>
<p>Việc phát triển đồng bộ các dịch vụ giúp chúng tôi chủ động hơn trong kiểm soát chất lượng, tối ưu chi phí và đảm bảo tính ổn định của nguồn cung, đồng thời mang đến cho khách hàng một giải pháp toàn diện thay vì chỉ cung cấp sản phẩm đơn lẻ.</p>
<h3>Điều chúng tôi theo đuổi</h3>
<p>Trong ngành thực phẩm, chất lượng không chỉ là tiêu chuẩn mà còn là trách nhiệm. Chính vì vậy, Đạt Phát luôn đầu tư vào việc lựa chọn nguồn nguyên liệu uy tín, xây dựng quy trình kiểm soát nghiêm ngặt, nâng cao năng lực vận hành và liên tục cải tiến để đáp ứng những yêu cầu ngày càng cao của khách hàng.</p>
<p>Mỗi sản phẩm trước khi được đưa vào chuỗi cung ứng đều trải qua quá trình kiểm tra về nguồn gốc, chất lượng và an toàn. Chúng tôi hiểu rằng, phía sau mỗi đơn hàng là sự tin tưởng của khách hàng và là trách nhiệm đối với sức khỏe của hàng nghìn người sử dụng.</p>
<p>Đó là lý do Đạt Phát không chạy theo số lượng, mà luôn ưu tiên giá trị bền vững trong từng sản phẩm và từng mối quan hệ hợp tác.</p>
<h3>Đồng hành cùng sự phát triển của cộng đồng</h3>
<p>Chúng tôi tin rằng, một doanh nghiệp phát triển bền vững là doanh nghiệp biết tạo ra giá trị vượt lên trên lợi nhuận.</p>
<p>Thông qua việc cung cấp nguồn thực phẩm an toàn, ổn định và được kiểm soát chặt chẽ, Đạt Phát góp phần nâng cao chất lượng bữa ăn, bảo vệ sức khỏe người tiêu dùng và xây dựng niềm tin trong chuỗi cung ứng thực phẩm.</p>
<p>Bên cạnh đó, chúng tôi không ngừng mở rộng hợp tác với các nhà sản xuất, vùng nguyên liệu và đối tác trên khắp cả nước nhằm thúc đẩy phát triển kinh tế địa phương, nâng cao giá trị nông sản Việt và hướng tới một hệ sinh thái thực phẩm phát triển hài hòa, minh bạch và bền vững.</p>
<p>Chúng tôi tin rằng, mỗi bữa ăn chất lượng hôm nay chính là nền tảng cho một cộng đồng khỏe mạnh và một tương lai tốt đẹp hơn.</p>
<h3>Hướng đến tương lai</h3>
<p>Trong chặng đường phía trước, Đạt Phát sẽ tiếp tục đầu tư mạnh mẽ vào công nghệ, hệ thống quản lý, logistics và phát triển nguồn nhân lực để hoàn thiện năng lực cung ứng trên phạm vi toàn quốc.</p>
<p>Chúng tôi không chỉ hướng tới mục tiêu trở thành doanh nghiệp cung ứng thực phẩm uy tín, mà còn mong muốn xây dựng một thương hiệu được khách hàng tin tưởng lựa chọn khi tìm kiếm những giải pháp thực phẩm an toàn, chuyên nghiệp và bền vững.</p>
<p>Đối với Đạt Phát, mỗi mối quan hệ hợp tác không đơn thuần là một giao dịch, mà là sự đồng hành lâu dài dựa trên niềm tin, trách nhiệm và những giá trị cùng được tạo dựng theo thời gian.</p>
HTML;
    }

    public static function sustainabilityContent(): string
    {
        return <<<'HTML'
<h2>Phát triển hôm nay vì những giá trị lâu dài</h2>
<p>Thực phẩm là một trong những lĩnh vực có tác động trực tiếp đến sức khỏe con người và chất lượng cuộc sống. Vì vậy, tại Đạt Phát, chúng tôi tin rằng sự phát triển của doanh nghiệp phải luôn song hành cùng trách nhiệm đối với khách hàng, đối tác, cộng đồng và môi trường.</p>
<p>Đối với chúng tôi, kinh doanh bền vững không chỉ là mục tiêu, mà là phương thức phát triển. Đó là cách chúng tôi xây dựng chuỗi cung ứng minh bạch, lựa chọn nguồn nguyên liệu có trách nhiệm, không ngừng nâng cao chất lượng dịch vụ và tạo dựng những mối quan hệ hợp tác dựa trên sự tin cậy, lâu dài.</p>
<p>Mỗi quyết định hôm nay đều hướng đến một mục tiêu lớn hơn: góp phần xây dựng một hệ sinh thái thực phẩm an toàn, chuyên nghiệp và bền vững cho tương lai.</p>
<h3>Bốn trụ cột phát triển bền vững</h3>
<h3>01. An toàn thực phẩm – Nền tảng của niềm tin</h3>
<p>Chúng tôi tin rằng chất lượng không được tạo nên ở khâu cuối cùng, mà bắt đầu từ từng mắt xích trong chuỗi cung ứng.</p>
<p>Đạt Phát ưu tiên lựa chọn nguồn nguyên liệu có xuất xứ rõ ràng, được kiểm soát theo các tiêu chuẩn phù hợp; đồng thời duy trì quy trình tiếp nhận, bảo quản và phân phối chặt chẽ nhằm đảm bảo chất lượng sản phẩm trong suốt quá trình vận hành.</p>
<p>Với chúng tôi, mỗi sản phẩm được giao đến khách hàng không chỉ là một mặt hàng thực phẩm, mà còn là sự cam kết về chất lượng, an toàn và trách nhiệm.</p>
<p><strong>Cam kết của chúng tôi</strong></p>
<ul>
<li>Lựa chọn nguồn nguyên liệu có nguồn gốc rõ ràng.</li>
<li>Kiểm soát chất lượng trong từng công đoạn.</li>
<li>Duy trì quy trình bảo quản và vận chuyển phù hợp với từng nhóm sản phẩm.</li>
<li>Không ngừng nâng cao tiêu chuẩn chất lượng theo yêu cầu của thị trường.</li>
</ul>
<h3>02. Đồng hành cùng đối tác – Phát triển bằng sự tin cậy</h3>
<p>Một chuỗi cung ứng bền vững chỉ có thể được hình thành khi mọi thành viên cùng chia sẻ giá trị và trách nhiệm.</p>
<p>Đạt Phát xây dựng mối quan hệ hợp tác lâu dài với nhà cung cấp, khách hàng và các đối tác trên tinh thần minh bạch, tôn trọng và cùng phát triển. Chúng tôi đề cao sự ổn định trong hợp tác, sự rõ ràng trong cam kết và tinh thần đồng hành để cùng tạo ra giá trị bền vững.</p>
<p>Chúng tôi không chỉ tìm kiếm đối tác, mà mong muốn xây dựng những mối quan hệ có thể cùng nhau phát triển qua nhiều năm.</p>
<p><strong>Cam kết của chúng tôi</strong></p>
<ul>
<li>Hợp tác minh bạch và công bằng.</li>
<li>Xây dựng chuỗi cung ứng ổn định.</li>
<li>Chia sẻ lợi ích trên nền tảng phát triển lâu dài.</li>
<li>Không ngừng nâng cao hiệu quả phối hợp trong toàn bộ chuỗi giá trị.</li>
</ul>
<h3>03. Con người – Động lực của sự phát triển</h3>
<p>Chúng tôi tin rằng sự phát triển của doanh nghiệp luôn bắt đầu từ sự phát triển của con người.</p>
<p>Đạt Phát chú trọng xây dựng môi trường làm việc chuyên nghiệp, an toàn và đề cao tinh thần trách nhiệm. Chúng tôi khuyến khích mỗi thành viên không ngừng học hỏi, nâng cao chuyên môn và chủ động đổi mới để đáp ứng những yêu cầu ngày càng cao của khách hàng.</p>
<p>Khi mỗi cá nhân cùng phát triển, doanh nghiệp sẽ có nền tảng vững chắc để tạo ra những giá trị tốt hơn cho xã hội.</p>
<p><strong>Cam kết của chúng tôi</strong></p>
<ul>
<li>Xây dựng môi trường làm việc tích cực và chuyên nghiệp.</li>
<li>Đầu tư vào đào tạo và phát triển năng lực.</li>
<li>Khuyến khích tinh thần đổi mới và cải tiến liên tục.</li>
<li>Đề cao văn hóa trách nhiệm và hợp tác.</li>
</ul>
<h3>04. Trách nhiệm với cộng đồng – Chung tay vì một tương lai bền vững</h3>
<p>Đạt Phát tin rằng giá trị của doanh nghiệp không chỉ nằm ở kết quả kinh doanh, mà còn ở những đóng góp tích cực cho cộng đồng.</p>
<p>Thông qua việc cung cấp nguồn thực phẩm an toàn và ổn định, chúng tôi góp phần nâng cao chất lượng bữa ăn, bảo vệ sức khỏe người tiêu dùng và xây dựng niềm tin trong chuỗi cung ứng thực phẩm.</p>
<p>Song song với đó, chúng tôi từng bước tối ưu quy trình vận hành nhằm hạn chế thất thoát, sử dụng hiệu quả nguồn lực và hướng đến các giải pháp thân thiện với môi trường. Chúng tôi cũng ưu tiên hợp tác với những đối tác có cùng định hướng phát triển có trách nhiệm, cùng nhau tạo nên giá trị lâu dài cho xã hội.</p>
<p><strong>Cam kết của chúng tôi</strong></p>
<ul>
<li>Góp phần nâng cao chất lượng bữa ăn cho cộng đồng.</li>
<li>Từng bước giảm lãng phí trong chuỗi cung ứng và vận hành.</li>
<li>Khuyến khích sử dụng hiệu quả tài nguyên và tối ưu quy trình.</li>
<li>Đồng hành cùng các đối tác trong việc xây dựng hệ sinh thái thực phẩm phát triển bền vững.</li>
</ul>
<h3>Cam kết của Đạt Phát</h3>
<p>Kinh doanh bền vững là hành trình được xây dựng từ những cam kết được thực hiện mỗi ngày.</p>
<p>Đối với Đạt Phát, đó là sự kiên định với chất lượng, sự minh bạch trong hợp tác, sự tận tâm trong phục vụ và tinh thần không ngừng đổi mới. Chúng tôi tin rằng chỉ khi tạo ra giá trị bền vững cho khách hàng, đối tác, người lao động và cộng đồng, doanh nghiệp mới có thể phát triển bền vững trong dài hạn.</p>
<p>Đạt Phát không chỉ cung ứng thực phẩm, mà còn kiến tạo niềm tin thông qua chất lượng, trách nhiệm và sự đồng hành lâu dài.</p>
HTML;
    }

    public static function visionContent(): string
    {
        return <<<'HTML'
<h2>Kiến tạo giá trị từ những điều thiết yếu nhất</h2>
<p>Thực phẩm không chỉ đáp ứng nhu cầu hằng ngày, mà còn là nền tảng của sức khỏe, sự phát triển và chất lượng cuộc sống. Đằng sau mỗi bữa ăn an toàn là một chuỗi giá trị được xây dựng bằng sự tận tâm, tính minh bạch và trách nhiệm trong từng công đoạn.</p>
<p>Đó cũng chính là triết lý mà Đạt Phát kiên định theo đuổi ngay từ những ngày đầu thành lập.</p>
<p>Chúng tôi tin rằng giá trị của một doanh nghiệp không chỉ được tạo nên bởi những sản phẩm cung cấp, mà còn bởi niềm tin được vun đắp qua chất lượng ổn định, sự đồng hành lâu dài và những đóng góp tích cực cho cộng đồng.</p>
<p>Với tinh thần đó, Đạt Phát không ngừng hoàn thiện hệ sinh thái cung ứng thực phẩm, nâng cao năng lực vận hành và xây dựng những giải pháp toàn diện nhằm mang đến sự an tâm trong từng bữa ăn và tạo dựng giá trị bền vững cho khách hàng, đối tác và xã hội.</p>
<blockquote>"Mỗi bữa ăn an toàn đều bắt đầu từ một chuỗi giá trị có trách nhiệm."</blockquote>
<h3>Lý do tồn tại</h3>
<p>Chúng tôi không chỉ cung cấp thực phẩm. Chúng tôi tồn tại để góp phần tạo nên những bữa ăn chất lượng, nơi mỗi nguyên liệu đều được lựa chọn cẩn trọng, mỗi quy trình đều được kiểm soát nghiêm ngặt và mỗi sản phẩm đều mang theo trách nhiệm đối với sức khỏe con người.</p>
<p>Đối với Đạt Phát, mỗi bữa ăn được phục vụ không đơn thuần là một sản phẩm được cung ứng, mà là sự kết nối giữa người sản xuất, doanh nghiệp và người sử dụng cuối cùng thông qua niềm tin, sự minh bạch và chất lượng được duy trì mỗi ngày.</p>
<p>Chúng tôi tin rằng khi doanh nghiệp đặt trách nhiệm lên trước lợi nhuận, những giá trị bền vững sẽ được tạo dựng cho khách hàng, đối tác và cộng đồng.</p>
<h3>Sứ mệnh</h3>
<p><strong>Kiến tạo những bữa ăn an toàn bằng giải pháp thực phẩm toàn diện.</strong></p>
<p>Đạt Phát mang trong mình sứ mệnh cung cấp những giải pháp thực phẩm an toàn, ổn định và chất lượng cao, đồng hành cùng các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn trong việc xây dựng những bữa ăn đạt chuẩn về chất lượng và dinh dưỡng.</p>
<p>Thông qua năng lực vận hành chuyên nghiệp, chuỗi cung ứng được kiểm soát chặt chẽ và sự minh bạch trong nguồn gốc sản phẩm, chúng tôi không ngừng nâng cao tiêu chuẩn dịch vụ, tối ưu hiệu quả vận hành và tạo dựng niềm tin bằng những giá trị được kiểm chứng trong thực tế.</p>
<p>Mỗi sản phẩm được cung cấp không chỉ đáp ứng yêu cầu về chất lượng, mà còn thể hiện cam kết của Đạt Phát đối với sức khỏe cộng đồng và sự phát triển bền vững của ngành thực phẩm Việt Nam.</p>
<blockquote>"Mang đến sự an tâm trong từng sản phẩm – Kiến tạo giá trị trong từng bữa ăn."</blockquote>
<h3>Tầm nhìn</h3>
<p><strong>Trở thành thương hiệu kiến tạo hệ sinh thái thực phẩm đáng tin cậy.</strong></p>
<p>Đạt Phát hướng tới trở thành doanh nghiệp hàng đầu trong lĩnh vực cung ứng thực phẩm và giải pháp vận hành bếp ăn chuyên nghiệp tại Việt Nam, tiên phong xây dựng hệ sinh thái thực phẩm an toàn, hiện đại và phát triển bền vững.</p>
<p>Chúng tôi không ngừng đầu tư vào con người, công nghệ, quản trị và chuỗi cung ứng nhằm nâng cao năng lực vận hành, mở rộng quy mô và tạo ra những chuẩn mực mới về chất lượng, dịch vụ và sự minh bạch trong ngành thực phẩm.</p>
<p>Bằng tinh thần đổi mới và khát vọng phát triển dài hạn, Đạt Phát mong muốn trở thành đối tác chiến lược được các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn tin tưởng lựa chọn; cùng kiến tạo những bữa ăn chất lượng, góp phần nâng cao sức khỏe cộng đồng và phát triển ngành thực phẩm Việt Nam theo hướng chuyên nghiệp, hiện đại và bền vững.</p>
<blockquote>"Trở thành thương hiệu được lựa chọn bằng sự tin tưởng, không chỉ bằng sản phẩm."</blockquote>
<h3>Giá trị cốt lõi</h3>
<ul>
<li><strong>Chất lượng:</strong> Chúng tôi xem chất lượng là nền tảng của mọi hoạt động, từ lựa chọn nguồn nguyên liệu đến từng quy trình cung ứng và dịch vụ.</li>
<li><strong>Trách nhiệm:</strong> Mỗi quyết định đều được đưa ra với tinh thần trách nhiệm đối với khách hàng, đối tác, người lao động và cộng đồng.</li>
<li><strong>Minh bạch:</strong> Cam kết rõ ràng về nguồn gốc, quy trình và chất lượng, xây dựng niềm tin bằng sự trung thực và nhất quán.</li>
<li><strong>Đồng hành:</strong> Xây dựng mối quan hệ hợp tác lâu dài trên nền tảng tôn trọng, chia sẻ giá trị và cùng phát triển.</li>
<li><strong>Đổi mới:</strong> Không ngừng cải tiến công nghệ, quy trình và năng lực vận hành để đáp ứng những yêu cầu ngày càng cao của thị trường.</li>
</ul>
HTML;
    }
}
