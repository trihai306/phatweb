@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Tuyển dụng</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="careers-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#careers-grid)"/>
            </svg>
        </div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 left-20 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>

        <div class="container-main relative text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                Cơ hội nghề nghiệp
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Gia nhập <span class="text-primary">DAT PHAT</span>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                Cùng DAT PHAT mang đến những bữa ăn ngon, sạch và an toàn cho mọi người.
            </p>
        </div>
    </section>

    {{-- ===== WHY JOIN US PERKS ===== --}}
    <section class="bg-primary py-12">
        <div class="container-main">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach([
                    ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Lương hấp dẫn', 'sub' => 'Cạnh tranh thị trường'],
                    ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'label' => 'Bảo hiểm đầy đủ', 'sub' => 'BHXH, BHYT, BHTN'],
                    ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'label' => 'Đào tạo chuyên sâu', 'sub' => 'Phát triển kỹ năng'],
                    ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'label' => 'Cơ hội thăng tiến', 'sub' => 'Lộ trình rõ ràng'],
                ] as $perk)
                    <div class="group text-center">
                        <div class="w-14 h-14 bg-white/15 group-hover:bg-white/25 rounded-2xl mx-auto mb-3 flex items-center justify-center transition-colors duration-200">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $perk['icon'] }}"/>
                            </svg>
                        </div>
                        <p class="text-white text-sm font-bold">{{ $perk['label'] }}</p>
                        <p class="text-white/60 text-xs mt-0.5">{{ $perk['sub'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== JOB LISTINGS ===== --}}
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container-main">

            {{-- Section header --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Cơ hội việc làm</p>
                    <h2 class="text-2xl md:text-3xl font-bold text-dark">Vị trí đang tuyển dụng</h2>
                    <div class="flex items-center gap-3 mt-3">
                        <div class="w-10 h-1 bg-primary rounded-full"></div>
                        <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                    </div>
                </div>
                @if(isset($careers) && method_exists($careers, 'total') && $careers->total() > 0)
                    <div class="flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $careers->total() }} vị trí đang mở
                    </div>
                @endif
            </div>

            {{-- Job Cards --}}
            <div class="space-y-5">
                @forelse($careers as $career)
                    <article class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 hover:border-primary/20"
                             x-data="{ visible: false }"
                             x-intersect.once="visible = true"
                             x-show="visible"
                             x-transition:enter="transition ease-out duration-400"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0">

                        {{-- Top accent line on hover --}}
                        <div class="h-1 bg-gradient-to-r from-primary to-primary/60 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>

                        <div class="p-6 flex flex-col sm:flex-row sm:items-center gap-5">

                            {{-- Job Icon --}}
                            <div class="w-14 h-14 bg-primary/10 group-hover:bg-primary/20 rounded-2xl flex items-center justify-center flex-shrink-0 transition-colors duration-200">
                                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>

                            {{-- Job Info --}}
                            <div class="flex-1 min-w-0">
                                {{-- Title row --}}
                                <div class="flex flex-wrap items-center gap-2 mb-2.5">
                                    <h3 class="text-lg font-bold text-dark group-hover:text-primary transition-colors">
                                        {{ $career->title }}
                                    </h3>
                                    @if(isset($career->is_urgent) && $career->is_urgent)
                                        <span class="inline-flex items-center gap-1 text-xs bg-red-100 text-red-600 font-bold px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                                            Gấp
                                        </span>
                                    @endif
                                    @if(isset($career->department) && $career->department)
                                        <span class="inline-flex items-center gap-1 text-xs bg-secondary/10 text-secondary font-semibold px-2.5 py-1 rounded-full">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            {{ $career->department }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Meta chips --}}
                                <div class="flex flex-wrap items-center gap-3 text-sm">
                                    @if(isset($career->location) && $career->location)
                                        <span class="flex items-center gap-1.5 text-gray-500">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $career->location }}
                                        </span>
                                    @endif
                                    @if(isset($career->salary_range) && $career->salary_range)
                                        <span class="flex items-center gap-1.5 font-bold text-primary bg-primary/8 px-3 py-1 rounded-full text-xs">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $career->salary_range }}
                                        </span>
                                    @endif
                                    @if(isset($career->deadline) && $career->deadline)
                                        <span class="flex items-center gap-1.5 text-gray-500">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            Hạn: {{ \Carbon\Carbon::parse($career->deadline)->format('d/m/Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- CTA --}}
                            <a href="{{ route('careers.show', $career->slug ?? $career->id) }}"
                               class="flex-shrink-0 inline-flex items-center gap-2 bg-primary text-white text-sm font-bold px-5 py-3 rounded-xl hover:bg-primary/90 transition-colors shadow-md shadow-primary/20 whitespace-nowrap group/btn">
                                Xem chi tiết
                                <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    {{-- ── Beautiful empty state ── --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                        <div class="relative w-28 h-28 mx-auto mb-6">
                            <div class="absolute inset-0 bg-primary/10 rounded-full animate-ping opacity-30"></div>
                            <div class="relative w-28 h-28 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full flex items-center justify-center">
                                <svg class="w-14 h-14 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Hiện chưa có vị trí tuyển dụng</h3>
                        <p class="text-gray-500 text-sm max-w-sm mx-auto mb-8 leading-relaxed">
                            Hãy để lại thông tin để chúng tôi liên hệ ngay khi có vị trí phù hợp với bạn.
                        </p>
                        <a href="{{ route('contact.inquiry') }}"
                           class="inline-flex items-center gap-2 bg-primary text-white font-bold px-8 py-3.5 rounded-xl hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Gửi hồ sơ ứng tuyển
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if(isset($careers) && method_exists($careers, 'links') && $careers->hasPages())
                <div class="mt-10">
                    {{ $careers->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- ===== BOTTOM CTA ===== --}}
    <section class="py-16 md:py-20 bg-gradient-to-br from-accent to-white">
        <div class="container-main text-center">
            <div class="max-w-xl mx-auto">
                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-dark mb-4">Không tìm thấy vị trí phù hợp?</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-8">
                    Gửi CV của bạn cho chúng tôi ngay hôm nay. Chúng tôi sẽ xem xét kỹ lưỡng và liên hệ
                    khi có vị trí phù hợp với năng lực của bạn.
                </p>
                <a href="{{ route('contact.inquiry') }}"
                   class="inline-flex items-center gap-2 bg-primary text-white font-bold px-8 py-4 rounded-xl hover:bg-primary/90 transition-colors shadow-lg shadow-primary/25 text-base">
                    Gửi CV ngay
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection
