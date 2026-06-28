@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Điều khoản sử dụng</span>
    </li>
@endsection

@section('content')
    <section class="relative bg-gradient-to-r from-secondary to-secondary/80 py-16 overflow-hidden">
        <div class="container-main relative">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Điều khoản sử dụng</h1>
            <p class="text-white/80 text-base max-w-2xl">Các điều khoản áp dụng khi Quý khách truy cập và sử dụng website của DAT PHAT.</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container-main max-w-4xl">
            <div class="bg-white rounded-2xl shadow-sm p-8 prose prose-lg max-w-none
                        prose-headings:text-dark prose-headings:font-bold
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-strong:text-dark prose-ul:text-gray-600 prose-li:leading-relaxed">
                <p>Khi truy cập và sử dụng website của Công ty TNHH Thực phẩm Đạt Phát, Quý khách đồng ý tuân thủ các điều khoản dưới đây. Vui lòng đọc kỹ trước khi sử dụng.</p>

                <h2>1. Sử dụng website</h2>
                <p>Quý khách được phép sử dụng website cho mục đích tham khảo thông tin và liên hệ dịch vụ một cách hợp pháp. Quý khách không được sử dụng website vào các hành vi vi phạm pháp luật hoặc gây ảnh hưởng đến hoạt động của website.</p>

                <h2>2. Quyền sở hữu nội dung</h2>
                <p>Toàn bộ nội dung, hình ảnh, thương hiệu và tài liệu trên website thuộc quyền sở hữu của Đạt Phát. Mọi hành vi sao chép, sử dụng lại cho mục đích thương mại khi chưa có sự đồng ý bằng văn bản đều không được phép.</p>

                <h2>3. Thông tin và báo giá</h2>
                <p>Thông tin sản phẩm, dịch vụ trên website mang tính tham khảo. Báo giá và phạm vi dịch vụ chính thức sẽ được xác nhận trực tiếp giữa Đạt Phát và khách hàng theo từng nhu cầu cụ thể.</p>

                <h2>4. Giới hạn trách nhiệm</h2>
                <p>Đạt Phát nỗ lực bảo đảm thông tin trên website chính xác và cập nhật, nhưng không chịu trách nhiệm cho những thiệt hại phát sinh từ việc sử dụng thông tin ngoài phạm vi tư vấn trực tiếp.</p>

                <h2>5. Liên hệ</h2>
                <p>Mọi thắc mắc liên quan đến điều khoản sử dụng, vui lòng liên hệ:</p>
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
