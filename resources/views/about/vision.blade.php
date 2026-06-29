@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('about.index') }}" class="hover:text-primary transition-colors">Về chúng tôi</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-primary font-medium">{{ $page->title ?? 'Tầm nhìn & Sứ mệnh' }}</span>
    </li>
@endsection

@section('content')

    {{-- ==================== HERO ==================== --}}
    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-20 md:py-28 overflow-hidden">
        {{-- SVG grid overlay --}}
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="vision-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#vision-grid)"/>
            </svg>
        </div>

        {{-- Glowing orbs --}}
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-72 h-72 bg-primary-light/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="container-main relative">
            {{-- Pill tag --}}
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary-light rounded-full animate-pulse"></span>
                TẦM NHÌN &amp; SỨ MỆNH
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 leading-tight max-w-3xl">
                {{ $page->title ?? 'Tầm nhìn' }}
                <span class="text-primary-light">&amp; Sứ mệnh</span>
            </h1>
            <p class="text-white/75 text-lg md:text-xl max-w-2xl leading-relaxed">
                {{ $page->excerpt ?? 'Kiến tạo những bữa ăn an toàn – xây dựng hệ sinh thái thực phẩm bền vững cho cộng đồng Việt Nam.' }}
            </p>
        </div>
    </section>

    {{-- ==================== MAIN CONTENT ==================== --}}
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
                <article class="flex-1 min-w-0 space-y-8 lg:space-y-10">

                    {{-- ===== 1. PHILOSOPHY INTRO CARD ===== --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        {{-- Top accent bar --}}
                        <div class="h-1.5 bg-gradient-to-r from-primary via-primary/70 to-secondary"></div>

                        <div class="p-7 md:p-10">
                            <p class="text-xs font-bold text-primary uppercase tracking-widest mb-3">Triết lý kinh doanh</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-dark mb-6 leading-tight">
                                Kiến tạo giá trị từ những điều thiết yếu nhất
                            </h2>

                            <div class="space-y-4 text-gray-600 leading-relaxed">
                                <p>Thực phẩm không chỉ đáp ứng nhu cầu hằng ngày, mà còn là nền tảng của sức khỏe, sự phát triển và chất lượng cuộc sống. Đằng sau mỗi bữa ăn an toàn là một chuỗi giá trị được xây dựng bằng sự tận tâm, tính minh bạch và trách nhiệm trong từng công đoạn.</p>
                                <p>Đó cũng chính là triết lý mà Đạt Phát kiên định theo đuổi ngay từ những ngày đầu thành lập.</p>
                                <p>Chúng tôi tin rằng giá trị của một doanh nghiệp không chỉ được tạo nên bởi những sản phẩm cung cấp, mà còn bởi niềm tin được vun đắp qua chất lượng ổn định, sự đồng hành lâu dài và những đóng góp tích cực cho cộng đồng.</p>
                                <p>Với tinh thần đó, Đạt Phát không ngừng hoàn thiện hệ sinh thái cung ứng thực phẩm, nâng cao năng lực vận hành và xây dựng những giải pháp toàn diện nhằm mang đến sự an tâm trong từng bữa ăn và tạo dựng giá trị bền vững cho khách hàng, đối tác và xã hội.</p>
                            </div>

                            {{-- Pull-quote --}}
                            <div class="mt-8 relative pl-8 border-l-4 border-primary">
                                <span class="absolute -top-4 -left-2 text-7xl text-primary/20 font-serif leading-none select-none" aria-hidden="true">"</span>
                                <blockquote class="text-lg md:text-xl font-semibold italic text-dark leading-relaxed">
                                    Mỗi bữa ăn an toàn đều bắt đầu từ một chuỗi giá trị có trách nhiệm.
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    {{-- ===== 2. LÝ DO TỒN TẠI ===== --}}
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            {{-- Image panel --}}
                            <div class="md:w-2/5 flex-shrink-0">
                                <img
                                    src="{{ asset('images/anhweb/hoc-sinh-an-trua.jpg') }}"
                                    alt="Học sinh thưởng thức bữa ăn dinh dưỡng"
                                    class="w-full h-56 md:h-full object-cover"
                                    loading="lazy"
                                >
                            </div>

                            {{-- Text panel --}}
                            <div class="flex-1 bg-white p-7 md:p-10 flex flex-col justify-center">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center flex-shrink-0">
                                        {{-- Heart / spark icon --}}
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-bold text-primary uppercase tracking-widest">Lý do tồn tại</p>
                                </div>

                                <h2 class="text-xl md:text-2xl font-bold text-dark mb-5 leading-snug">
                                    Chúng tôi tồn tại vì điều gì?
                                </h2>

                                <div class="space-y-4 text-gray-600 text-sm md:text-base leading-relaxed">
                                    <p>Chúng tôi không chỉ cung cấp thực phẩm. Chúng tôi tồn tại để góp phần tạo nên những bữa ăn chất lượng, nơi mỗi nguyên liệu đều được lựa chọn cẩn trọng, mỗi quy trình đều được kiểm soát nghiêm ngặt và mỗi sản phẩm đều mang theo trách nhiệm đối với sức khỏe con người.</p>
                                    <p>Đối với Đạt Phát, mỗi bữa ăn được phục vụ không đơn thuần là một sản phẩm được cung ứng, mà là sự kết nối giữa người sản xuất, doanh nghiệp và người sử dụng cuối cùng thông qua niềm tin, sự minh bạch và chất lượng được duy trì mỗi ngày.</p>
                                    <p>Chúng tôi tin rằng khi doanh nghiệp đặt trách nhiệm lên trước lợi nhuận, những giá trị bền vững sẽ được tạo dựng cho khách hàng, đối tác và cộng đồng.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== 3. SỨ MỆNH & TẦM NHÌN: Two contrasting panels ===== --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- MISSION — light panel --}}
                        <div class="bg-white rounded-2xl border border-primary/20 shadow-sm overflow-hidden flex flex-col">
                            {{-- Top image strip --}}
                            <div class="h-44 overflow-hidden">
                                <img
                                    src="{{ asset('images/anhweb/dia-com-dinh-duong-1.jpg') }}"
                                    alt="Đĩa cơm dinh dưỡng chuẩn chất lượng"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            </div>

                            <div class="p-7 flex flex-col flex-1">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-xl bg-accent flex items-center justify-center flex-shrink-0">
                                        {{-- Flag / target icon --}}
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-bold text-primary uppercase tracking-widest">Sứ mệnh</p>
                                </div>

                                <p class="text-lg font-bold text-dark mb-4 leading-snug">
                                    Kiến tạo những bữa ăn an toàn bằng giải pháp thực phẩm toàn diện.
                                </p>

                                <div class="space-y-3 text-gray-600 text-sm leading-relaxed flex-1">
                                    <p>Đạt Phát mang trong mình sứ mệnh cung cấp những giải pháp thực phẩm an toàn, ổn định và chất lượng cao, đồng hành cùng các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn trong việc xây dựng những bữa ăn đạt chuẩn về chất lượng và dinh dưỡng.</p>
                                    <p>Thông qua năng lực vận hành chuyên nghiệp, chuỗi cung ứng được kiểm soát chặt chẽ và sự minh bạch trong nguồn gốc sản phẩm, chúng tôi không ngừng nâng cao tiêu chuẩn dịch vụ, tối ưu hiệu quả vận hành và tạo dựng niềm tin bằng những giá trị được kiểm chứng trong thực tế.</p>
                                    <p>Mỗi sản phẩm được cung cấp không chỉ đáp ứng yêu cầu về chất lượng, mà còn thể hiện cam kết của Đạt Phát đối với sức khỏe cộng đồng và sự phát triển bền vững của ngành thực phẩm Việt Nam.</p>
                                </div>

                                {{-- Mission pull-quote --}}
                                <div class="mt-6 relative pl-5 border-l-4 border-primary/40 bg-accent/60 rounded-r-xl py-4 pr-4">
                                    <span class="absolute -top-3 -left-1.5 text-5xl text-primary/20 font-serif leading-none select-none" aria-hidden="true">"</span>
                                    <p class="text-sm font-semibold italic text-primary leading-relaxed">
                                        Mang đến sự an tâm trong từng sản phẩm – Kiến tạo giá trị trong từng bữa ăn.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- VISION — dark panel --}}
                        <div class="bg-gradient-to-br from-secondary to-dark rounded-2xl shadow-sm overflow-hidden flex flex-col">
                            {{-- Top image strip --}}
                            <div class="h-44 overflow-hidden relative">
                                <img
                                    src="{{ asset('images/anhweb/nong-trai-rau.jpg') }}"
                                    alt="Trang trại rau sạch – hướng tới hệ sinh thái thực phẩm bền vững"
                                    class="w-full h-full object-cover opacity-70 hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-secondary/60 to-transparent"></div>
                            </div>

                            <div class="p-7 flex flex-col flex-1">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center flex-shrink-0">
                                        {{-- Eye icon --}}
                                        <svg class="w-5 h-5 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs font-bold text-primary-light uppercase tracking-widest">Tầm nhìn</p>
                                </div>

                                <p class="text-lg font-bold text-white mb-4 leading-snug">
                                    Trở thành thương hiệu kiến tạo hệ sinh thái thực phẩm đáng tin cậy.
                                </p>

                                <div class="space-y-3 text-white/75 text-sm leading-relaxed flex-1">
                                    <p>Đạt Phát hướng tới trở thành doanh nghiệp hàng đầu trong lĩnh vực cung ứng thực phẩm và giải pháp vận hành bếp ăn chuyên nghiệp tại Việt Nam, tiên phong xây dựng hệ sinh thái thực phẩm an toàn, hiện đại và phát triển bền vững.</p>
                                    <p>Chúng tôi không ngừng đầu tư vào con người, công nghệ, quản trị và chuỗi cung ứng nhằm nâng cao năng lực vận hành, mở rộng quy mô và tạo ra những chuẩn mực mới về chất lượng, dịch vụ và sự minh bạch trong ngành thực phẩm.</p>
                                    <p>Bằng tinh thần đổi mới và khát vọng phát triển dài hạn, Đạt Phát mong muốn trở thành đối tác chiến lược được các tổ chức, doanh nghiệp và đơn vị vận hành bếp ăn tin tưởng lựa chọn; cùng kiến tạo những bữa ăn chất lượng, góp phần nâng cao sức khỏe cộng đồng và phát triển ngành thực phẩm Việt Nam theo hướng chuyên nghiệp, hiện đại và bền vững.</p>
                                </div>

                                {{-- Vision pull-quote --}}
                                <div class="mt-6 relative pl-5 border-l-4 border-primary-light/50 bg-white/5 rounded-r-xl py-4 pr-4">
                                    <span class="absolute -top-3 -left-1.5 text-5xl text-white/20 font-serif leading-none select-none" aria-hidden="true">"</span>
                                    <p class="text-sm font-semibold italic text-primary-light leading-relaxed">
                                        Trở thành thương hiệu được lựa chọn bằng sự tin tưởng, không chỉ bằng sản phẩm.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== 4. GIÁ TRỊ CỐT LÕI ===== --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        {{-- Section header --}}
                        <div class="px-7 md:px-10 pt-8 md:pt-10 pb-6 border-b border-gray-100">
                            <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Nền tảng hoạt động</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-dark">Giá trị cốt lõi</h2>
                            <div class="flex items-center gap-3 mt-3">
                                <div class="w-12 h-1 bg-primary rounded-full"></div>
                                <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                            </div>
                        </div>

                        <div class="p-7 md:p-10">
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                                {{-- Value 1: Chất lượng --}}
                                <div class="group rounded-2xl border border-gray-100 p-6 hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-gray-50/50 hover:bg-accent/30">
                                    <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                        {{-- Star / quality icon --}}
                                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-dark mb-2 group-hover:text-primary transition-colors duration-300">Chất lượng</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed">Chúng tôi xem chất lượng là nền tảng của mọi hoạt động, từ lựa chọn nguồn nguyên liệu đến từng quy trình cung ứng và dịch vụ.</p>
                                </div>

                                {{-- Value 2: Trách nhiệm --}}
                                <div class="group rounded-2xl border border-gray-100 p-6 hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-gray-50/50 hover:bg-accent/30">
                                    <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                        {{-- Shield icon --}}
                                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-dark mb-2 group-hover:text-primary transition-colors duration-300">Trách nhiệm</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed">Mỗi quyết định đều được đưa ra với tinh thần trách nhiệm đối với khách hàng, đối tác, người lao động và cộng đồng.</p>
                                </div>

                                {{-- Value 3: Minh bạch --}}
                                <div class="group rounded-2xl border border-gray-100 p-6 hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-gray-50/50 hover:bg-accent/30">
                                    <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                        {{-- Magnifying glass / search / clarity icon --}}
                                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-dark mb-2 group-hover:text-primary transition-colors duration-300">Minh bạch</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed">Cam kết rõ ràng về nguồn gốc, quy trình và chất lượng, xây dựng niềm tin bằng sự trung thực và nhất quán.</p>
                                </div>

                                {{-- Value 4: Đồng hành --}}
                                <div class="group rounded-2xl border border-gray-100 p-6 hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-gray-50/50 hover:bg-accent/30">
                                    <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                        {{-- Users / handshake-ish icon --}}
                                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-dark mb-2 group-hover:text-primary transition-colors duration-300">Đồng hành</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed">Xây dựng mối quan hệ hợp tác lâu dài trên nền tảng tôn trọng, chia sẻ giá trị và cùng phát triển.</p>
                                </div>

                                {{-- Value 5: Đổi mới --}}
                                <div class="group rounded-2xl border border-gray-100 p-6 hover:border-primary/30 hover:shadow-md transition-all duration-300 bg-gray-50/50 hover:bg-accent/30 sm:col-span-2 xl:col-span-1">
                                    <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                                        {{-- Lightning bolt / innovation icon --}}
                                        <svg class="w-6 h-6 text-primary group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-dark mb-2 group-hover:text-primary transition-colors duration-300">Đổi mới</h3>
                                    <p class="text-sm text-gray-500 leading-relaxed">Không ngừng cải tiến công nghệ, quy trình và năng lực vận hành để đáp ứng những yêu cầu ngày càng cao của thị trường.</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ===== 5. CTA BAND ===== --}}
                    <div class="relative rounded-2xl overflow-hidden">
                        {{-- Background image --}}
                        <img
                            src="{{ asset('images/anhweb/che-bien-thuc-pham.jpg') }}"
                            alt="Chế biến thực phẩm chuyên nghiệp tại Đạt Phát"
                            class="absolute inset-0 w-full h-full object-cover"
                            loading="lazy"
                        >
                        {{-- Dark overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-r from-secondary/95 via-secondary/85 to-dark/90"></div>

                        <div class="relative p-8 md:p-12 flex flex-col md:flex-row items-center gap-6 md:gap-8">
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-snug">
                                    Cùng Đạt Phát kiến tạo bữa ăn chất lượng
                                </h3>
                                <p class="text-white/70 text-sm leading-relaxed">
                                    Liên hệ với chúng tôi để nhận tư vấn giải pháp thực phẩm phù hợp nhất cho tổ chức của bạn.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-3 flex-shrink-0">
                                <a href="{{ route('contact.index') }}"
                                   class="btn-primary whitespace-nowrap">
                                    Liên hệ ngay
                                </a>
                                <a href="{{ route('about.index') }}"
                                   class="btn-white whitespace-nowrap">
                                    Về chúng tôi
                                </a>
                            </div>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>

@endsection
