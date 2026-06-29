@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('about.index') }}" class="hover:text-primary transition-colors">Về chúng tôi</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-primary font-medium">{{ $page->title ?? 'Về chúng tôi' }}</span>
    </li>
@endsection

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative overflow-hidden bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-32">

    {{-- SVG grid overlay --}}
    <div class="absolute inset-0 opacity-[0.07] pointer-events-none" aria-hidden="true">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="hero-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hero-grid)"/>
        </svg>
    </div>

    {{-- Glowing orbs --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
    <div class="absolute -bottom-32 right-10 w-80 h-80 bg-primary-light/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

    <div class="container-main relative z-10 text-center">
        {{-- Pill tag --}}
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/90 text-xs font-semibold uppercase tracking-widest px-4 py-2 rounded-full mb-6 backdrop-blur-sm">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-light opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-light"></span>
            </span>
            DAT PHAT NUTRITION
        </div>

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6 max-w-4xl mx-auto">
            {{ $page->title ?? 'Về Đạt Phát Nutrition' }}
        </h1>

        @if(!empty($page->excerpt))
        <p class="text-white/75 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">
            {{ $page->excerpt }}
        </p>
        @endif
    </div>
</section>

{{-- ===================== MAIN CONTENT ===================== --}}
<section class="py-16 md:py-20 bg-gray-50">
    <div class="container-main">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- ---- SIDEBAR ---- --}}
            @php
                $sidebarItems = $sidebarPages->map(function ($p) {
                    $p->url = route('about.show', $p->slug);
                    return $p;
                });
            @endphp
            <div class="lg:w-64 xl:w-72 flex-shrink-0">
                <x-sidebar title="Về chúng tôi" :items="$sidebarItems" :currentSlug="$page->slug ?? ''" />
            </div>

            {{-- ---- ARTICLE ---- --}}
            <article class="flex-1 min-w-0 space-y-10 lg:space-y-14">

                {{-- ===== SECTION 1: INTRO CARD ===== --}}
                <div
                    class="bg-white rounded-2xl shadow-sm overflow-hidden"
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                >
                    {{-- Top accent bar --}}
                    <div class="h-1.5 bg-gradient-to-r from-primary via-primary/70 to-secondary"></div>

                    <div class="p-6 md:p-8 lg:p-10">
                        {{-- Eyebrow --}}
                        <p class="text-xs font-bold uppercase tracking-widest text-primary-light mb-3">Câu chuyện của chúng tôi</p>

                        <h2 class="text-2xl md:text-3xl font-bold text-dark mb-6 leading-snug">
                            Kiến tạo giá trị từ những điều thiết yếu nhất
                        </h2>

                        {{-- Alternating: text + image --}}
                        <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-start">
                            <div class="flex-1 space-y-4 text-gray-600 leading-relaxed text-base">
                                <p>Mỗi ngày, hàng triệu bữa ăn được chuẩn bị trên khắp Việt Nam. Đằng sau mỗi bữa ăn chất lượng là một chuỗi cung ứng vận hành chính xác, một nguồn nguyên liệu được kiểm soát nghiêm ngặt và những con người luôn đặt trách nhiệm lên hàng đầu.</p>
                                <p>Công ty TNHH Thực phẩm Đạt Phát được thành lập từ niềm tin rằng thực phẩm không chỉ là nhu cầu thiết yếu, mà còn là nền tảng của sức khỏe, sự phát triển và chất lượng cuộc sống. Vì vậy, chúng tôi lựa chọn bắt đầu từ điều quan trọng nhất: xây dựng một hệ thống cung ứng thực phẩm minh bạch, an toàn và bền vững, nơi mỗi sản phẩm đều được tạo nên bằng sự tận tâm và trách nhiệm.</p>
                                <p>Trên hành trình phát triển, Đạt Phát không chỉ hướng đến việc cung cấp thực phẩm, mà còn mong muốn trở thành đối tác đáng tin cậy của các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn trên cả nước, góp phần tạo nên những bữa ăn đạt chuẩn về chất lượng, dinh dưỡng và an toàn.</p>
                            </div>
                            <div class="w-full md:w-72 flex-shrink-0">
                                <img
                                    src="{{ asset('images/anhweb/kiem-tra-nguyen-lieu.jpg') }}"
                                    alt="Kiểm tra nguyên liệu tại Đạt Phát"
                                    loading="lazy"
                                    class="w-full h-52 md:h-64 object-cover rounded-xl shadow-md"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SECTION 2: HÀNH TRÌNH + 3 PRINCIPLES ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="space-y-6"
                >
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-1 h-8 bg-primary rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-bold text-dark">Hành trình bắt đầu từ niềm tin</h2>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6 md:p-8 space-y-4 text-gray-600 leading-relaxed text-base">
                        <p>Ngay từ những ngày đầu hoạt động, Đạt Phát xác định rằng giá trị của một doanh nghiệp thực phẩm không được đo bằng số lượng sản phẩm bán ra, mà được khẳng định bằng sự an tâm của khách hàng sau mỗi lần hợp tác.</p>
                        <p>Từ nền tảng cung ứng thực phẩm và vận hành suất ăn, chúng tôi từng bước mở rộng năng lực, đầu tư vào hệ thống quản lý chất lượng, phát triển mạng lưới đối tác, hoàn thiện quy trình kiểm soát và xây dựng đội ngũ chuyên môn nhằm đáp ứng những yêu cầu ngày càng cao của thị trường.</p>
                        <p class="font-semibold text-dark">Mỗi bước phát triển đều được xây dựng trên ba nguyên tắc cốt lõi:</p>
                    </div>

                    {{-- 3 principle cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
                        {{-- Card 01 --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-primary-light tracking-widest">01</span>
                                <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-base mb-1">Lấy chất lượng làm nền tảng</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">Mỗi sản phẩm đều được kiểm soát nghiêm ngặt, đảm bảo tiêu chuẩn an toàn thực phẩm cao nhất.</p>
                            </div>
                        </div>

                        {{-- Card 02 --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-primary-light tracking-widest">02</span>
                                <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-base mb-1">Lấy uy tín làm cam kết</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">Xây dựng niềm tin qua từng giao dịch, minh bạch trong mọi mối quan hệ hợp tác.</p>
                            </div>
                        </div>

                        {{-- Card 03 --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold text-primary-light tracking-widest">03</span>
                                <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-base mb-1">Lấy sự phát triển bền vững làm định hướng lâu dài</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">Đầu tư dài hạn, mở rộng năng lực và phát triển cùng cộng đồng đối tác.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-accent border-l-4 border-primary rounded-r-xl px-5 py-4 text-gray-700 italic text-base leading-relaxed">
                        "Chúng tôi tin rằng, chỉ khi giữ vững những giá trị đó, doanh nghiệp mới có thể tạo dựng niềm tin và phát triển bền vững cùng khách hàng."
                    </div>
                </div>

                {{-- ===== SECTION 3: HỆ SINH THÁI ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="space-y-6"
                >
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-1 h-8 bg-primary-light rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-bold text-dark">Hệ sinh thái cung ứng thực phẩm toàn diện</h2>
                    </div>

                    {{-- Image + text alternating --}}
                    <div class="flex flex-col md:flex-row-reverse gap-6 md:gap-8 items-start bg-white rounded-2xl shadow-sm p-6 md:p-8">
                        <div class="w-full md:w-64 flex-shrink-0">
                            <img
                                src="{{ asset('images/anhweb/day-chuyen-san-xuat.jpg') }}"
                                alt="Dây chuyền sản xuất tại Đạt Phát"
                                loading="lazy"
                                class="w-full h-48 md:h-56 object-cover rounded-xl shadow-md"
                            >
                        </div>
                        <div class="flex-1 space-y-4 text-gray-600 leading-relaxed text-base">
                            <p>Đạt Phát không đơn thuần là đơn vị cung cấp thực phẩm. Chúng tôi đang từng bước xây dựng một hệ sinh thái cung ứng toàn diện nhằm tối ưu hóa mọi mắt xích trong chuỗi giá trị thực phẩm.</p>
                            <p class="font-semibold text-dark">Hệ sinh thái của Đạt Phát bao gồm:</p>
                        </div>
                    </div>

                    {{-- 5 ecosystem chips --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @php
                            $ecosystem = [
                                [
                                    'label' => 'Cung ứng nguyên liệu thực phẩm tươi sống và thực phẩm chế biến',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>',
                                ],
                                [
                                    'label' => 'Kiểm soát chất lượng và truy xuất nguồn gốc',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                                ],
                                [
                                    'label' => 'Sơ chế, bảo quản và vận chuyển theo quy trình tiêu chuẩn',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>',
                                ],
                                [
                                    'label' => 'Cung cấp giải pháp vận hành bếp ăn và suất ăn chuyên nghiệp',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>',
                                ],
                                [
                                    'label' => 'Tư vấn trang thiết bị và tối ưu quy trình vận hành',
                                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                                ],
                            ];
                        @endphp

                        @foreach($ecosystem as $item)
                        <div class="flex items-start gap-4 bg-white rounded-xl border border-gray-100 shadow-sm p-4 hover:border-primary/30 hover:shadow-md transition-all duration-200">
                            <div class="w-9 h-9 rounded-lg bg-accent flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                            </div>
                            <p class="text-sm text-gray-700 leading-relaxed font-medium">{{ $item['label'] }}</p>
                        </div>
                        @endforeach
                    </div>

                    <p class="text-gray-600 leading-relaxed text-base bg-white rounded-xl shadow-sm p-5 border-l-4 border-primary-light">
                        Việc phát triển đồng bộ các dịch vụ giúp chúng tôi chủ động hơn trong kiểm soát chất lượng, tối ưu chi phí và đảm bảo tính ổn định của nguồn cung, đồng thời mang đến cho khách hàng một giải pháp toàn diện thay vì chỉ cung cấp sản phẩm đơn lẻ.
                    </p>
                </div>

                {{-- ===== SECTION 4: ĐIỀU CHÚNG TÔI THEO ĐUỔI ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="rounded-2xl overflow-hidden shadow-sm"
                >
                    <div class="h-1.5 bg-gradient-to-r from-primary-light via-primary to-secondary"></div>
                    <div class="bg-white p-6 md:p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold text-dark">Điều chúng tôi theo đuổi</h2>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-start">
                            <div class="flex-1 space-y-4 text-gray-600 leading-relaxed text-base">
                                <p>Trong ngành thực phẩm, chất lượng không chỉ là tiêu chuẩn mà còn là trách nhiệm. Chính vì vậy, Đạt Phát luôn đầu tư vào việc lựa chọn nguồn nguyên liệu uy tín, xây dựng quy trình kiểm soát nghiêm ngặt, nâng cao năng lực vận hành và liên tục cải tiến để đáp ứng những yêu cầu ngày càng cao của khách hàng.</p>
                                <p>Mỗi sản phẩm trước khi được đưa vào chuỗi cung ứng đều trải qua quá trình kiểm tra về nguồn gốc, chất lượng và an toàn. Chúng tôi hiểu rằng, phía sau mỗi đơn hàng là sự tin tưởng của khách hàng và là trách nhiệm đối với sức khỏe của hàng nghìn người sử dụng.</p>
                                <p>Đó là lý do Đạt Phát không chạy theo số lượng, mà luôn ưu tiên giá trị bền vững trong từng sản phẩm và từng mối quan hệ hợp tác.</p>
                            </div>
                            <div class="w-full lg:w-60 flex-shrink-0">
                                <img
                                    src="{{ asset('images/anhweb/giam-sat-che-bien.jpg') }}"
                                    alt="Giám sát chế biến thực phẩm tại Đạt Phát"
                                    loading="lazy"
                                    class="w-full h-44 lg:h-52 object-cover rounded-xl shadow-md"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== SECTION 5: ĐỒNG HÀNH CÙNG CỘNG ĐỒNG ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="space-y-6"
                >
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-1 h-8 bg-primary rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-bold text-dark">Đồng hành cùng sự phát triển của cộng đồng</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-3 text-gray-600 leading-relaxed text-sm md:text-base border border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center mb-3">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-dark">Chúng tôi tin rằng, một doanh nghiệp phát triển bền vững là doanh nghiệp biết tạo ra giá trị vượt lên trên lợi nhuận.</p>
                            <p>Thông qua việc cung cấp nguồn thực phẩm an toàn, ổn định và được kiểm soát chặt chẽ, Đạt Phát góp phần nâng cao chất lượng bữa ăn, bảo vệ sức khỏe người tiêu dùng và xây dựng niềm tin trong chuỗi cung ứng thực phẩm.</p>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-3 text-gray-600 leading-relaxed text-sm md:text-base border border-gray-100">
                            <div class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center mb-3">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p>Bên cạnh đó, chúng tôi không ngừng mở rộng hợp tác với các nhà sản xuất, vùng nguyên liệu và đối tác trên khắp cả nước nhằm thúc đẩy phát triển kinh tế địa phương, nâng cao giá trị nông sản Việt và hướng tới một hệ sinh thái thực phẩm phát triển hài hòa, minh bạch và bền vững.</p>
                        </div>
                    </div>

                    {{-- Pull quote with image --}}
                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-primary-dark shadow-md">
                        <div class="absolute inset-0 opacity-10 pointer-events-none" aria-hidden="true">
                            <img
                                src="{{ asset('images/anhweb/nong-trai-rau.jpg') }}"
                                alt=""
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <div class="relative z-10 px-6 py-8 md:px-10 text-center">
                            <svg class="w-10 h-10 text-white/30 mx-auto mb-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                            <p class="text-white text-base md:text-lg font-medium leading-relaxed max-w-2xl mx-auto italic">
                                Chúng tôi tin rằng, mỗi bữa ăn chất lượng hôm nay chính là nền tảng cho một cộng đồng khỏe mạnh và một tương lai tốt đẹp hơn.
                            </p>
                            <div class="mt-4 w-16 h-0.5 bg-primary-light mx-auto"></div>
                            <p class="mt-3 text-white/60 text-sm font-semibold tracking-widest uppercase">Đạt Phát Nutrition</p>
                        </div>
                    </div>
                </div>

                {{-- ===== SECTION 6: HƯỚNG ĐẾN TƯƠNG LAI ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="space-y-6"
                >
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-1 h-8 bg-primary-light rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-bold text-dark">Hướng đến tương lai</h2>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-start bg-white rounded-2xl shadow-sm p-6 md:p-8 border border-gray-100">
                        <div class="w-full md:w-64 flex-shrink-0">
                            <img
                                src="{{ asset('images/anhweb/nha-may-che-bien.jpg') }}"
                                alt="Nhà máy chế biến thực phẩm Đạt Phát"
                                loading="lazy"
                                class="w-full h-48 md:h-56 object-cover rounded-xl shadow-md"
                            >
                        </div>
                        <div class="flex-1 space-y-4 text-gray-600 leading-relaxed text-base">
                            <p>Trong chặng đường phía trước, Đạt Phát sẽ tiếp tục đầu tư mạnh mẽ vào công nghệ, hệ thống quản lý, logistics và phát triển nguồn nhân lực để hoàn thiện năng lực cung ứng trên phạm vi toàn quốc.</p>
                            <p>Chúng tôi không chỉ hướng tới mục tiêu trở thành doanh nghiệp cung ứng thực phẩm uy tín, mà còn mong muốn xây dựng một thương hiệu được khách hàng tin tưởng lựa chọn khi tìm kiếm những giải pháp thực phẩm an toàn, chuyên nghiệp và bền vững.</p>

                            <div class="bg-accent rounded-xl px-5 py-4 border-l-4 border-primary text-gray-700 italic text-sm leading-relaxed">
                                "Đối với Đạt Phát, mỗi mối quan hệ hợp tác không đơn thuần là một giao dịch, mà là sự đồng hành lâu dài dựa trên niềm tin, trách nhiệm và những giá trị cùng được tạo dựng theo thời gian."
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== CTA BAND ===== --}}
                <div
                    x-data="{ visible: false }"
                    x-intersect="visible = true"
                    :class="visible ? 'animate-fade-up' : 'opacity-0'"
                    class="relative overflow-hidden rounded-2xl shadow-lg"
                >
                    <div class="absolute inset-0 bg-gradient-to-br from-secondary to-dark"></div>
                    <div class="absolute inset-0 opacity-[0.06] pointer-events-none" aria-hidden="true">
                        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="cta-grid" width="32" height="32" patternUnits="userSpaceOnUse">
                                    <path d="M 32 0 L 0 0 0 32" fill="none" stroke="white" stroke-width="1"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#cta-grid)"/>
                        </svg>
                    </div>
                    <div class="absolute -top-16 -right-16 w-56 h-56 bg-primary/20 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

                    <div class="relative z-10 px-6 py-10 md:px-12 md:py-12 text-center">
                        <p class="text-primary-light text-xs font-bold uppercase tracking-widest mb-3">Hãy cùng chúng tôi</p>
                        <h3 class="text-2xl md:text-3xl font-bold text-white mb-3 leading-snug">
                            Bắt đầu hành trình hợp tác hôm nay
                        </h3>
                        <p class="text-white/70 text-base mb-7 max-w-xl mx-auto">
                            Liên hệ với Đạt Phát để được tư vấn giải pháp cung ứng thực phẩm an toàn, chuyên nghiệp và bền vững cho doanh nghiệp của bạn.
                        </p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                            <a
                                href="{{ route('contact.index') }}"
                                class="inline-flex items-center gap-2 bg-white text-primary font-bold px-7 py-3 rounded-full hover:bg-primary-light hover:text-white transition-all duration-200 shadow-lg text-sm"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Liên hệ ngay
                            </a>
                            <a
                                href="{{ route('about.index') }}"
                                class="inline-flex items-center gap-2 border border-white/30 text-white/80 hover:text-white hover:border-white px-7 py-3 rounded-full transition-all duration-200 text-sm"
                            >
                                Tìm hiểu thêm
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </article>
        </div>
    </div>
</section>

@endsection
