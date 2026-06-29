@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('about.index') }}" class="hover:text-primary transition-colors">Về chúng tôi</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-primary font-medium">{{ $page->title ?? 'Kinh doanh bền vững' }}</span>
    </li>
@endsection

@section('content')

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-secondary via-secondary/90 to-dark py-20 md:py-28">

    {{-- SVG grid overlay --}}
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]">
        <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>

    {{-- Glowing orbs --}}
    <div class="pointer-events-none absolute -left-24 -top-24 h-96 w-96 rounded-full bg-primary/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-primary-light/10 blur-3xl"></div>

    <div class="container-main relative z-10 text-center text-white">
        {{-- Pill tag --}}
        <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-primary-light backdrop-blur-sm">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h.5A2.5 2.5 0 0020 5.5v-1.565M15 3.5V5M9 3.5V5"/>
            </svg>
            Phát triển bền vững
        </div>

        <h1 class="mx-auto max-w-3xl text-3xl font-bold leading-tight md:text-5xl">
            {{ $page->title ?? 'Kinh doanh bền vững' }}
        </h1>

        @if (!empty($page->excerpt))
            <p class="mx-auto mt-5 max-w-2xl text-base text-white/75 md:text-lg">
                {{ $page->excerpt }}
            </p>
        @else
            <p class="mx-auto mt-5 max-w-2xl text-base text-white/75 md:text-lg">
                Phát triển hôm nay vì những giá trị lâu dài — cam kết của Đạt Phát với khách hàng, đối tác, con người và cộng đồng.
            </p>
        @endif
    </div>
</section>

{{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
<section class="py-16 md:py-20 bg-gray-50">
    <div class="container-main">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- ── SIDEBAR ── --}}
            @php
                $sidebarItems = $sidebarPages->map(function ($p) {
                    $p->url = route('about.show', $p->slug);
                    return $p;
                });
            @endphp
            <div class="lg:w-64 xl:w-72 flex-shrink-0">
                <x-sidebar title="Về chúng tôi" :items="$sidebarItems" :currentSlug="$page->slug ?? ''" />
            </div>

            {{-- ── ARTICLE ── --}}
            <article class="flex-1 min-w-0 space-y-8 lg:space-y-10">

                {{-- ── INTRO CARD ── --}}
                <div class="rounded-2xl bg-white shadow-sm overflow-hidden"
                     x-data x-intersect.once="$el.classList.add('animate-fade-up')">

                    {{-- Accent top bar --}}
                    <div class="h-1.5 bg-gradient-to-r from-primary via-primary/70 to-secondary"></div>

                    <div class="p-7 md:p-9">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="flex-1">
                                <h2 class="section-title text-dark mb-5">
                                    Phát triển hôm nay vì những giá trị lâu dài
                                </h2>
                                <div class="space-y-4 text-gray-600 leading-relaxed">
                                    <p>Thực phẩm là một trong những lĩnh vực có tác động trực tiếp đến sức khỏe con người và chất lượng cuộc sống. Vì vậy, tại Đạt Phát, chúng tôi tin rằng sự phát triển của doanh nghiệp phải luôn song hành cùng trách nhiệm đối với khách hàng, đối tác, cộng đồng và môi trường.</p>
                                    <p>Đối với chúng tôi, kinh doanh bền vững không chỉ là mục tiêu, mà là phương thức phát triển. Đó là cách chúng tôi xây dựng chuỗi cung ứng minh bạch, lựa chọn nguồn nguyên liệu có trách nhiệm, không ngừng nâng cao chất lượng dịch vụ và tạo dựng những mối quan hệ hợp tác dựa trên sự tin cậy, lâu dài.</p>
                                    <p>Mỗi quyết định hôm nay đều hướng đến một mục tiêu lớn hơn: góp phần xây dựng một hệ sinh thái thực phẩm an toàn, chuyên nghiệp và bền vững cho tương lai.</p>
                                </div>
                            </div>
                            <div class="w-full md:w-56 xl:w-64 flex-shrink-0 rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('images/anhweb/nong-trai-rau.jpg') }}"
                                     alt="Nông trại rau sạch Đạt Phát"
                                     class="w-full h-48 md:h-full object-cover"
                                     loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── PILLARS HEADER ── --}}
                <div class="text-center pt-4"
                     x-data x-intersect.once="$el.classList.add('animate-fade-up')">
                    <span class="inline-block rounded-full bg-accent px-4 py-1 text-xs font-semibold uppercase tracking-widest text-primary mb-3">Định hướng cốt lõi</span>
                    <h2 class="section-title text-dark">Bốn trụ cột phát triển bền vững</h2>
                    <p class="section-subtitle mx-auto">Mỗi trụ cột là một cam kết — cùng nhau tạo nên nền tảng vững chắc cho sự phát triển lâu dài của Đạt Phát.</p>
                </div>

                {{-- ── THE 4 PILLARS ── --}}
                @php
                $pillars = [
                    [
                        'num'   => '01',
                        'title' => 'An toàn thực phẩm',
                        'sub'   => 'Nền tảng của niềm tin',
                        'desc'  => [
                            'Chúng tôi tin rằng chất lượng không được tạo nên ở khâu cuối cùng, mà bắt đầu từ từng mắt xích trong chuỗi cung ứng.',
                            'Đạt Phát ưu tiên lựa chọn nguồn nguyên liệu có xuất xứ rõ ràng, được kiểm soát theo các tiêu chuẩn phù hợp; đồng thời duy trì quy trình tiếp nhận, bảo quản và phân phối chặt chẽ nhằm đảm bảo chất lượng sản phẩm trong suốt quá trình vận hành.',
                            'Với chúng tôi, mỗi sản phẩm được giao đến khách hàng không chỉ là một mặt hàng thực phẩm, mà còn là sự cam kết về chất lượng, an toàn và trách nhiệm.',
                        ],
                        'commitments' => [
                            'Lựa chọn nguồn nguyên liệu có nguồn gốc rõ ràng.',
                            'Kiểm soát chất lượng trong từng công đoạn.',
                            'Duy trì quy trình bảo quản và vận chuyển phù hợp với từng nhóm sản phẩm.',
                            'Không ngừng nâng cao tiêu chuẩn chất lượng theo yêu cầu của thị trường.',
                        ],
                        'image' => 'kiem-tra-nguyen-lieu.jpg',
                        'alt'   => 'Kiểm tra nguyên liệu đầu vào',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                    ],
                    [
                        'num'   => '02',
                        'title' => 'Đồng hành cùng đối tác',
                        'sub'   => 'Phát triển bằng sự tin cậy',
                        'desc'  => [
                            'Một chuỗi cung ứng bền vững chỉ có thể được hình thành khi mọi thành viên cùng chia sẻ giá trị và trách nhiệm.',
                            'Đạt Phát xây dựng mối quan hệ hợp tác lâu dài với nhà cung cấp, khách hàng và các đối tác trên tinh thần minh bạch, tôn trọng và cùng phát triển. Chúng tôi đề cao sự ổn định trong hợp tác, sự rõ ràng trong cam kết và tinh thần đồng hành để cùng tạo ra giá trị bền vững.',
                            'Chúng tôi không chỉ tìm kiếm đối tác, mà mong muốn xây dựng những mối quan hệ có thể cùng nhau phát triển qua nhiều năm.',
                        ],
                        'commitments' => [
                            'Hợp tác minh bạch và công bằng.',
                            'Xây dựng chuỗi cung ứng ổn định.',
                            'Chia sẻ lợi ích trên nền tảng phát triển lâu dài.',
                            'Không ngừng nâng cao hiệu quả phối hợp trong toàn bộ chuỗi giá trị.',
                        ],
                        'image' => 'nong-trai-rau-2.jpg',
                        'alt'   => 'Hợp tác cùng đối tác nông trại',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                    ],
                    [
                        'num'   => '03',
                        'title' => 'Con người',
                        'sub'   => 'Động lực của sự phát triển',
                        'desc'  => [
                            'Chúng tôi tin rằng sự phát triển của doanh nghiệp luôn bắt đầu từ sự phát triển của con người.',
                            'Đạt Phát chú trọng xây dựng môi trường làm việc chuyên nghiệp, an toàn và đề cao tinh thần trách nhiệm. Chúng tôi khuyến khích mỗi thành viên không ngừng học hỏi, nâng cao chuyên môn và chủ động đổi mới để đáp ứng những yêu cầu ngày càng cao của khách hàng.',
                            'Khi mỗi cá nhân cùng phát triển, doanh nghiệp sẽ có nền tảng vững chắc để tạo ra những giá trị tốt hơn cho xã hội.',
                        ],
                        'commitments' => [
                            'Xây dựng môi trường làm việc tích cực và chuyên nghiệp.',
                            'Đầu tư vào đào tạo và phát triển năng lực.',
                            'Khuyến khích tinh thần đổi mới và cải tiến liên tục.',
                            'Đề cao văn hóa trách nhiệm và hợp tác.',
                        ],
                        'image' => 'cong-nhan-an-trua.jpg',
                        'alt'   => 'Đội ngũ nhân viên Đạt Phát',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>',
                    ],
                    [
                        'num'   => '04',
                        'title' => 'Trách nhiệm với cộng đồng',
                        'sub'   => 'Chung tay vì một tương lai bền vững',
                        'desc'  => [
                            'Đạt Phát tin rằng giá trị của doanh nghiệp không chỉ nằm ở kết quả kinh doanh, mà còn ở những đóng góp tích cực cho cộng đồng.',
                            'Thông qua việc cung cấp nguồn thực phẩm an toàn và ổn định, chúng tôi góp phần nâng cao chất lượng bữa ăn, bảo vệ sức khỏe người tiêu dùng và xây dựng niềm tin trong chuỗi cung ứng thực phẩm.',
                            'Song song với đó, chúng tôi từng bước tối ưu quy trình vận hành nhằm hạn chế thất thoát, sử dụng hiệu quả nguồn lực và hướng đến các giải pháp thân thiện với môi trường. Chúng tôi cũng ưu tiên hợp tác với những đối tác có cùng định hướng phát triển có trách nhiệm, cùng nhau tạo nên giá trị lâu dài cho xã hội.',
                        ],
                        'commitments' => [
                            'Góp phần nâng cao chất lượng bữa ăn cho cộng đồng.',
                            'Từng bước giảm lãng phí trong chuỗi cung ứng và vận hành.',
                            'Khuyến khích sử dụng hiệu quả tài nguyên và tối ưu quy trình.',
                            'Đồng hành cùng các đối tác trong việc xây dựng hệ sinh thái thực phẩm phát triển bền vững.',
                        ],
                        'image' => 'bua-an-dinh-duong.jpg',
                        'alt'   => 'Bữa ăn dinh dưỡng cho cộng đồng',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    ],
                ];
                @endphp

                <div class="space-y-8">
                    @foreach ($pillars as $index => $pillar)
                    <div class="group relative rounded-2xl bg-white shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5"
                         x-data x-intersect.once="$el.classList.add('animate-fade-up')">

                        {{-- Number watermark --}}
                        <span class="pointer-events-none absolute right-4 top-2 text-7xl font-black text-gray-100 select-none leading-none group-hover:text-primary/10 transition-colors duration-300">
                            {{ $pillar['num'] }}
                        </span>

                        {{-- Accent left border --}}
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-primary via-primary-light to-primary/40 rounded-l-2xl"></div>

                        <div class="flex flex-col md:flex-row gap-0 pl-6">

                            {{-- Text content --}}
                            <div class="flex-1 p-6 md:p-8">
                                {{-- Pillar header --}}
                                <div class="flex items-start gap-4 mb-5">
                                    <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-accent flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            {!! $pillar['icon'] !!}
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold uppercase tracking-widest text-primary-light mb-0.5">Trụ cột {{ $pillar['num'] }}</div>
                                        <h3 class="text-lg md:text-xl font-bold text-dark leading-tight">
                                            {{ $pillar['title'] }}
                                            <span class="block text-sm font-medium text-gray-500 mt-0.5">{{ $pillar['sub'] }}</span>
                                        </h3>
                                    </div>
                                </div>

                                {{-- Description paragraphs --}}
                                <div class="space-y-3 text-gray-600 leading-relaxed text-sm md:text-base mb-6">
                                    @foreach ($pillar['desc'] as $para)
                                        <p>{{ $para }}</p>
                                    @endforeach
                                </div>

                                {{-- Commitments checklist --}}
                                <div class="rounded-xl bg-accent/60 border border-primary/10 p-4 md:p-5">
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-wider text-primary">Cam kết của chúng tôi</span>
                                    </div>
                                    <ul class="space-y-2">
                                        @foreach ($pillar['commitments'] as $commitment)
                                        <li class="flex items-start gap-2.5 text-sm text-gray-700">
                                            <svg class="w-4 h-4 text-primary-light flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>{{ $commitment }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            {{-- Image panel --}}
                            <div class="md:w-52 xl:w-60 flex-shrink-0">
                                <img src="{{ asset('images/anhweb/' . $pillar['image']) }}"
                                     alt="{{ $pillar['alt'] }}"
                                     class="w-full h-52 md:h-full object-cover"
                                     loading="lazy">
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- ── FINAL COMMITMENT PANEL ── --}}
                <div class="rounded-2xl gradient-secondary text-white overflow-hidden shadow-lg"
                     x-data x-intersect.once="$el.classList.add('animate-fade-up')">

                    <div class="relative p-8 md:p-10">
                        {{-- Decorative orb --}}
                        <div class="pointer-events-none absolute right-0 top-0 h-64 w-64 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/2 blur-2xl"></div>

                        {{-- Quote icon --}}
                        <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/15">
                            <svg class="h-6 w-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl md:text-2xl font-bold text-white mb-6">
                            Cam kết của Đạt Phát
                        </h3>

                        <div class="space-y-4 text-white/80 leading-relaxed relative z-10">
                            <p class="text-base md:text-lg font-medium text-white/90 italic border-l-4 border-primary-light pl-4">
                                "Kinh doanh bền vững là hành trình được xây dựng từ những cam kết được thực hiện mỗi ngày."
                            </p>
                            <p>Đối với Đạt Phát, đó là sự kiên định với chất lượng, sự minh bạch trong hợp tác, sự tận tâm trong phục vụ và tinh thần không ngừng đổi mới. Chúng tôi tin rằng chỉ khi tạo ra giá trị bền vững cho khách hàng, đối tác, người lao động và cộng đồng, doanh nghiệp mới có thể phát triển bền vững trong dài hạn.</p>
                            <p class="text-white font-semibold text-base md:text-lg pt-2">
                                Đạt Phát không chỉ cung ứng thực phẩm, mà còn kiến tạo niềm tin thông qua chất lượng, trách nhiệm và sự đồng hành lâu dài.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ── CTA BAND ── --}}
                <div class="rounded-2xl bg-white border border-primary/20 p-7 md:p-8 flex flex-col sm:flex-row items-center justify-between gap-5 shadow-sm"
                     x-data x-intersect.once="$el.classList.add('animate-fade-up')">
                    <div>
                        <h4 class="text-lg font-bold text-dark mb-1">Cùng xây dựng tương lai bền vững</h4>
                        <p class="text-sm text-gray-500">Liên hệ với Đạt Phát để khám phá các giải pháp thực phẩm phù hợp với doanh nghiệp của bạn.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-3 flex-shrink-0">
                        <a href="{{ route('contact.index') }}" class="btn-primary whitespace-nowrap">
                            Liên hệ ngay
                        </a>
                        <a href="{{ route('about.index') }}" class="btn-outline whitespace-nowrap">
                            Về chúng tôi
                        </a>
                    </div>
                </div>

            </article>
        </div>
    </div>
</section>

@endsection
