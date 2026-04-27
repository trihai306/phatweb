@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Về chúng tôi</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-32 overflow-hidden">
        {{-- Decorative grid --}}
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hero-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hero-grid)"/>
            </svg>
        </div>
        {{-- Glowing orb --}}
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-primary/10 rounded-full blur-2xl"></div>

        <div class="container-main relative">
            <div class="max-w-3xl">
                {{-- Tag --}}
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                    <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                    DAT PHAT Vietnam
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                    Về <span class="text-primary-light">chúng tôi</span>
                </h1>
                <p class="text-white/75 text-lg md:text-xl max-w-2xl leading-relaxed">
                    Tận tâm kiến tạo những bữa ăn an toàn, dinh dưỡng cho học sinh và người lao động.
                </p>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- Sidebar --}}
                <div class="lg:w-64 xl:w-72 flex-shrink-0">
                    <x-sidebar
                        title="Về chúng tôi"
                        :items="$sidebarPages"
                        currentSlug=""
                    />
                </div>

                {{-- Main Article --}}
                <article class="flex-1 min-w-0 space-y-8">

                    {{-- ── Company Intro ── --}}
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        {{-- Top accent bar --}}
                        <div class="h-1.5 bg-gradient-to-r from-primary via-primary/70 to-secondary"></div>
                        <div class="p-8">

                            {{-- CEO + Heading row --}}
                            <div class="flex flex-col sm:flex-row items-start gap-6 mb-8">
                                {{-- CEO placeholder --}}
                                <div class="flex-shrink-0 w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden bg-gradient-to-br from-secondary/20 to-primary/20 border-2 border-primary/20 flex items-center justify-center shadow-md">
                                    <svg class="w-12 h-12 text-secondary/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">Giám đốc điều hành</p>
                                    <h2 class="text-xl md:text-2xl font-bold text-dark">Nguyễn Văn Phát</h2>
                                    <p class="text-gray-500 text-sm mt-1">Thành lập DAT PHAT từ năm 2013</p>
                                </div>
                            </div>

                            <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">
                                Công ty TNHH Dịch vụ Thực phẩm <span class="text-primary">DAT PHAT</span>
                            </h2>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-1 bg-primary rounded-full"></div>
                                <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-base mb-8">
                                DAT PHAT là doanh nghiệp chuyên cung cấp dịch vụ suất ăn cho trường học và doanh nghiệp.
                                Với đội ngũ tận tâm và quy trình kiểm soát chất lượng nghiêm ngặt, chúng tôi mang đến
                                những bữa ăn an toàn, dinh dưỡng mỗi ngày.
                            </p>

                            {{-- Company Info Grid --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @if(isset($companyInfo) && is_array($companyInfo))
                                    @foreach($companyInfo as $key => $info)
                                        @if(is_array($info) && isset($info['label']))
                                            <div class="group flex items-start gap-4 p-5 bg-accent rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-sm transition-all duration-200">
                                                <div class="w-10 h-10 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">{{ $info['label'] }}</p>
                                                    <p class="text-sm font-bold text-dark">{{ $info['value'] }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach([
                                        ['icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'CEO', 'value' => 'Nguyễn Văn Phát'],
                                        ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Thành lập', 'value' => '2013'],
                                        ['icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'label' => 'Địa chỉ', 'value' => 'Bắc Ninh, Việt Nam'],
                                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Điện thoại', 'value' => '0222-369-9930'],
                                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email', 'value' => 'info@phatfood.vn'],
                                        ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9', 'label' => 'Website', 'value' => 'www.phatfood.vn'],
                                    ] as $info)
                                        <div class="group flex items-start gap-4 p-5 bg-accent rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-sm transition-all duration-200">
                                            <div class="w-10 h-10 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">{{ $info['label'] }}</p>
                                                <p class="text-sm font-bold text-dark">{{ $info['value'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ── Statistics ── --}}
                    @if(isset($statistics) && count($statistics) > 0)
                        <div class="relative bg-gradient-to-br from-secondary to-dark rounded-2xl p-8 md:p-10 overflow-hidden">
                            {{-- Decorative dots --}}
                            <div class="absolute top-0 right-0 w-64 h-64 opacity-5">
                                <svg viewBox="0 0 200 200" fill="white" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10" cy="10" r="3"/><circle cx="30" cy="10" r="3"/><circle cx="50" cy="10" r="3"/>
                                    <circle cx="10" cy="30" r="3"/><circle cx="30" cy="30" r="3"/><circle cx="50" cy="30" r="3"/>
                                    <circle cx="10" cy="50" r="3"/><circle cx="30" cy="50" r="3"/><circle cx="50" cy="50" r="3"/>
                                </svg>
                            </div>

                            <div class="relative">
                                <p class="text-primary text-xs font-bold uppercase tracking-widest mb-2">Con số ấn tượng</p>
                                <h3 class="text-xl md:text-2xl font-extrabold text-white mb-8">DAT PHAT trong những con số</h3>

                                <div class="grid grid-cols-2 md:grid-cols-{{ min(count($statistics), 4) }} gap-6">
                                    @php
                                        $statSvgs = [
                                            '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
                                            '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5"/></svg>',
                                            '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21"/></svg>',
                                            '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>',
                                            '<svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>',
                                        ];
                                    @endphp
                                    @foreach($statistics as $statIdx => $stat)
                                        <div class="text-center group" x-data="{ counted: false }" x-intersect="counted = true">
                                            <div class="flex justify-center mb-3">{!! $statSvgs[$statIdx % count($statSvgs)] !!}</div>
                                            <div class="text-4xl md:text-5xl font-black text-primary mb-1 tabular-nums">
                                                {{ $stat->value ?? '' }}
                                            </div>
                                            @if(isset($stat->unit) && $stat->unit)
                                                <div class="text-white/50 text-xs font-medium uppercase tracking-wide mb-1">{{ $stat->unit }}</div>
                                            @endif
                                            <div class="text-white/80 text-sm font-semibold">{{ $stat->label ?? '' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ── Mission & Vision ── --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Mission --}}
                        <div class="bg-white rounded-2xl shadow-sm p-7 border-t-4 border-primary hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-5">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-dark mb-3">Sứ mệnh</h3>
                            <div class="w-8 h-0.5 bg-primary mb-4"></div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Cung cấp những bữa ăn an toàn, ngon lành và đầy đủ dinh dưỡng, góp phần nâng cao chất lượng cuộc sống
                                cho người lao động Việt Nam.
                            </p>
                        </div>

                        {{-- Vision --}}
                        <div class="bg-white rounded-2xl shadow-sm p-7 border-t-4 border-secondary hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center mb-5">
                                <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-dark mb-3">Tầm nhìn</h3>
                            <div class="w-8 h-0.5 bg-secondary mb-4"></div>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Trở thành doanh nghiệp dẫn đầu trong lĩnh vực dịch vụ suất ăn công nghiệp tại Việt Nam,
                                mở rộng quy mô và nâng cao tiêu chuẩn phục vụ trên toàn quốc.
                            </p>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </section>

@endsection
