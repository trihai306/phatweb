{{-- CTA Banner --}}
<section class="gradient-primary">
    <div class="container-main py-16 md:py-20">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="text-white text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-extrabold mb-2">Sẵn sàng hợp tác cùng DAT PHAT?</h2>
                <p class="text-white/80 text-lg">Liên hệ ngay để được tư vấn giải pháp suất ăn công nghiệp tốt nhất.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('contact.index') }}" class="btn-white whitespace-nowrap">
                    Liên hệ ngay
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="tel:{{ App\Models\CompanyInfo::getValue('phone', '0222-369-9930') }}" class="inline-flex items-center justify-center px-7 py-3.5 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-primary transition-all duration-300 whitespace-nowrap">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ App\Models\CompanyInfo::getValue('phone', '0222-369-9930') }}
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="bg-gray-950 text-gray-400">
    <div class="container-main pt-16 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <div>
                <a href="{{ route('home') }}" class="inline-block mb-5">
                    <img src="{{ asset('images/logo-footer.png') }}" alt="{{ App\Models\CompanyInfo::getValue('brand_name', 'DAT PHAT') }}" class="h-9 w-auto brightness-0 invert">
                </a>
                <p class="text-gray-500 leading-relaxed mb-6 text-sm">
                    {{ App\Models\CompanyInfo::getValue('tagline', 'Hướng tới khách hàng lối sống khỏe mạnh thông qua dịch vụ ăn uống an toàn và chất lượng.') }}
                </p>
                <div class="flex gap-3">
                    <a href="{{ App\Models\CompanyInfo::getValue('facebook_url', '#') }}" class="w-9 h-9 bg-gray-800/80 rounded-lg flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ App\Models\CompanyInfo::getValue('linkedin_url', '#') }}" class="w-9 h-9 bg-gray-800/80 rounded-lg flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300" aria-label="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="{{ App\Models\CompanyInfo::getValue('youtube_url', '#') }}" class="w-9 h-9 bg-gray-800/80 rounded-lg flex items-center justify-center hover:bg-primary hover:scale-110 transition-all duration-300" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-5 text-sm uppercase tracking-wider">Liên kết nhanh</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Về chúng tôi</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Dịch vụ</a></li>
                    <li><a href="{{ route('whyus.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Tại sao là chúng tôi</a></li>
                    <li><a href="{{ route('careers.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Tuyển dụng</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Liên lạc với chúng tôi</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-5 text-sm uppercase tracking-wider">Dịch vụ</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('services.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Suất ăn trường học</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Suất ăn công nghiệp</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Suất ăn dinh dưỡng</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Tiệc & sự kiện</a></li>
                    <li><a href="{{ route('services.menu') }}" class="text-sm hover:text-primary hover:pl-1 transition-all duration-200">Thực đơn</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-semibold mb-5 text-sm uppercase tracking-wider">Liên hệ</h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </span>
                        <span class="text-sm leading-relaxed">{{ App\Models\CompanyInfo::getValue('address', 'Số 21, Đường 8, KCN VSIP Bắc Ninh II') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        <a href="tel:{{ App\Models\CompanyInfo::getValue('phone', '0222-369-9930') }}" class="text-sm hover:text-primary transition-colors">{{ App\Models\CompanyInfo::getValue('phone', '0222-369-9930') }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </span>
                        <a href="mailto:{{ App\Models\CompanyInfo::getValue('email', 'info@phatfood.vn') }}" class="text-sm hover:text-primary transition-colors">{{ App\Models\CompanyInfo::getValue('email', 'info@phatfood.vn') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800/50 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} {{ App\Models\CompanyInfo::getValue('brand_name', 'DAT PHAT') }} Việt Nam. All rights reserved.</p>
            <div class="flex gap-6 text-sm text-gray-600">
                <a href="#" class="hover:text-primary transition-colors">Chính sách bảo mật</a>
                <a href="#" class="hover:text-primary transition-colors">Điều khoản sử dụng</a>
            </div>
        </div>
    </div>
</footer>

<button x-data="{ show: false }"
        @scroll.window="show = window.scrollY > 500"
        x-show="show" x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 w-12 h-12 gradient-primary text-white rounded-xl shadow-lg shadow-primary/30 hover:shadow-xl hover:shadow-primary/40 hover:scale-110 transition-all duration-300 flex items-center justify-center z-40"
        aria-label="Về đầu trang">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
</button>
