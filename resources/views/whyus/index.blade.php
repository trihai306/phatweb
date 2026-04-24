@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Tại sao là chúng tôi</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="why-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#why-grid)"/>
            </svg>
        </div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>

        <div class="container-main relative">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                Thế mạnh của chúng tôi
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Tại sao là <span class="text-primary">PhatFood?</span>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl leading-relaxed">
                Những giá trị cốt lõi và thế mạnh đặc biệt giúp PhatFood trở thành lựa chọn hàng đầu của các doanh nghiệp.
            </p>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- Sidebar --}}
                <div class="lg:w-64 xl:w-72 flex-shrink-0">
                    <x-sidebar
                        title="Thế mạnh"
                        :items="$strengths"
                        currentSlug=""
                    />
                </div>

                {{-- Main Content --}}
                <div class="flex-1 min-w-0">

                    {{-- Section intro --}}
                    <div class="mb-10">
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Lý do chọn chúng tôi</p>
                        <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">Thế mạnh của PhatFood</h2>
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-12 h-1 bg-primary rounded-full"></div>
                            <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                        </div>
                        <p class="text-gray-600 leading-relaxed max-w-2xl">
                            Với hơn 10 năm kinh nghiệm trong ngành dịch vụ suất ăn công nghiệp, PhatFood cam kết mang đến
                            những giá trị vượt trội và sự hài lòng tối đa cho từng khách hàng.
                        </p>
                    </div>

                    {{-- ── Strength Cards ── --}}
                    @php
                        $svgIcons = [
                            'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                            'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
                            'M13 10V3L4 14h7v7l9-11h-7z',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        @forelse($strengths as $index => $strength)
                            <a href="{{ route('whyus.show', $strength->slug) }}"
                               class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-400 p-7 overflow-hidden border border-gray-100 hover:border-primary/20"
                               x-data="{ visible: false }"
                               x-intersect.once="visible = true"
                               x-show="visible"
                               x-transition:enter="transition ease-out duration-500"
                               x-transition:enter-start="opacity-0 translate-y-6"
                               x-transition:enter-end="opacity-100 translate-y-0">

                                {{-- Large background number --}}
                                <div class="absolute -bottom-4 -right-2 text-[7rem] font-black leading-none select-none
                                            text-gray-50 group-hover:text-primary/5 transition-colors duration-300">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                {{-- Foreground number badge --}}
                                <div class="text-5xl font-black text-primary/20 mb-4 leading-none group-hover:text-primary/40 transition-colors">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                {{-- Image or icon --}}
                                @if($strength->image && file_exists(storage_path('app/public/' . $strength->image)))
                                    <div class="w-16 h-16 rounded-xl overflow-hidden mb-4 shadow-md">
                                        <img src="{{ asset('storage/' . $strength->image) }}"
                                             alt="{{ $strength->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="w-16 h-16 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $svgIcons[$index % 4] }}"/>
                                        </svg>
                                    </div>
                                @endif

                                <h3 class="text-lg font-bold text-dark mb-3 group-hover:text-primary transition-colors leading-snug">
                                    {{ $strength->title }}
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-5">
                                    {{ Str::limit($strength->description, 130) }}
                                </p>

                                <div class="flex items-center gap-2 text-primary text-sm font-bold group-hover:gap-3 transition-all duration-200">
                                    Tìm hiểu thêm
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-2 bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-dark mb-2">Nội dung đang được cập nhật</h3>
                                <p class="text-gray-400 text-sm">Vui lòng quay lại sau.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- ── Statistics Section ── --}}
                    @if(isset($statistics) && count($statistics) > 0)
                        <div class="relative bg-gradient-to-br from-secondary to-dark rounded-2xl p-8 md:p-12 overflow-hidden">
                            {{-- Decorative circle --}}
                            <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/10 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-10 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>

                            <div class="relative">
                                <p class="text-primary text-xs font-bold uppercase tracking-widest mb-2">Thống kê</p>
                                <h3 class="text-xl md:text-2xl font-extrabold text-white mb-10">PhatFood trong những con số</h3>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                                    @foreach($statistics as $stat)
                                        <div class="text-center group">
                                            {{-- Optional icon --}}
                                            @if(isset($stat->icon) && $stat->icon)
                                                <div class="text-4xl mb-3">{!! $stat->icon !!}</div>
                                            @endif
                                            <div class="text-4xl md:text-5xl font-black text-primary mb-1 tabular-nums">
                                                {{ $stat->value ?? '' }}
                                            </div>
                                            @if(isset($stat->unit) && $stat->unit)
                                                <div class="text-white/50 text-xs font-semibold uppercase tracking-wide mb-1">{{ $stat->unit }}</div>
                                            @endif
                                            <div class="text-white/80 text-sm font-semibold">{{ $stat->label ?? '' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
