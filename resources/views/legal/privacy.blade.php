@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Chính sách bảo mật</span>
    </li>
@endsection

@section('content')
    <section class="relative bg-gradient-to-r from-secondary to-secondary/80 py-16 overflow-hidden">
        <div class="container-main relative">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Chính sách bảo mật</h1>
            <p class="text-white/80 text-base max-w-2xl">Cam kết của DAT PHAT về việc thu thập, sử dụng và bảo vệ thông tin của khách hàng.</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container-main max-w-4xl">
            <div class="bg-white rounded-2xl shadow-sm p-8 prose prose-lg max-w-none
                        prose-headings:text-dark prose-headings:font-bold
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-strong:text-dark prose-ul:text-gray-600 prose-li:leading-relaxed">
                <p>Công ty TNHH Thực phẩm Đạt Phát (sau đây gọi là “Đạt Phát”) tôn trọng và cam kết bảo vệ thông tin cá nhân của Quý khách hàng. Chính sách này giải thích cách chúng tôi thu thập, sử dụng và bảo vệ thông tin khi Quý khách truy cập và sử dụng website của chúng tôi.</p>

                <h2>1. Thông tin chúng tôi thu thập</h2>
                <ul>
                    <li>Thông tin liên hệ Quý khách chủ động cung cấp qua biểu mẫu: họ tên, số điện thoại, email và nội dung yêu cầu.</li>
                    <li>Thông tin kỹ thuật cơ bản phục vụ vận hành website (loại thiết bị, trình duyệt, trang đã xem).</li>
                </ul>

                <h2>2. Mục đích sử dụng thông tin</h2>
                <ul>
                    <li>Tiếp nhận và phản hồi yêu cầu tư vấn, báo giá của Quý khách.</li>
                    <li>Nâng cao chất lượng dịch vụ và trải nghiệm trên website.</li>
                    <li>Liên hệ khi cần thiết liên quan đến yêu cầu Quý khách đã gửi.</li>
                </ul>

                <h2>3. Bảo mật thông tin</h2>
                <p>Thông tin của Quý khách được lưu trữ và bảo vệ bằng các biện pháp kỹ thuật phù hợp. Chúng tôi không mua bán, trao đổi thông tin cá nhân của Quý khách cho bên thứ ba, trừ trường hợp có yêu cầu của cơ quan nhà nước có thẩm quyền theo quy định pháp luật.</p>

                <h2>4. Quyền của khách hàng</h2>
                <p>Quý khách có quyền yêu cầu kiểm tra, cập nhật hoặc xóa thông tin cá nhân của mình bằng cách liên hệ với chúng tôi qua thông tin bên dưới.</p>

                <h2>5. Liên hệ</h2>
                <p>Mọi thắc mắc về chính sách bảo mật, vui lòng liên hệ:</p>
                <ul>
                    <li><strong>Điện thoại:</strong> {{ \App\Models\CompanyInfo::getValue('phone', '0914026138 - 0389985150') }}</li>
                    <li><strong>Email:</strong> {{ \App\Models\CompanyInfo::getValue('email', 'datphatnutrition@gmail.com') }}</li>
                </ul>
            </div>

            <div class="mt-6">
                <a href="{{ route('contact.index') }}" class="btn-primary text-sm">
                    Liên hệ ngay
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
