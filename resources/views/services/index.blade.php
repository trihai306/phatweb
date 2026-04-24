@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Dịch vụ</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative overflow-hidden">
        {{-- Background: first service image or gradient --}}
        @php $firstService = $services->first(); @endphp
        @if($firstService && $firstService->image && file_exists(storage_path('app/public/' . $firstService->image)))
            <img src="{{ asset('storage/' . $firstService->image) }}"
                 alt="Dịch vụ PhatFood"
                 class="absolute inset-0 w-full h-full object-cover"
                 loading="eager">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-secondary via-secondary/90 to-dark"></div>
        @endif

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-dark/85 via-dark/60 to-transparent"></div>
        {{-- Grid pattern --}}
        <div class="absolute inset-0 opacity-[0.06]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="svc-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                </pattern></defs>
                <rect width="100%" height="100%" fill="url(#svc-grid)"/>
            </svg>
        </div>

        <div class="relative container-main py-24 md:py-32">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                PhatFood Vietnam
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight max-w-2xl">
                Dịch vụ <span class="text-primary">của chúng tôi</span>
            </h1>
            <p class="text-white/75 text-lg max-w-xl leading-relaxed">
                Suất ăn công nghiệp chuyên nghiệp, an toàn và đa dạng theo từng vùng miền — phục vụ hàng nghìn công nhân mỗi ngày.
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
                        title="Dịch vụ"
                        :items="$services"
                        currentSlug=""
                    />

                    {{-- Menu quick link --}}
                    <div class="mt-6 bg-gradient-to-br from-primary to-primary/80 rounded-2xl p-6 text-white shadow-lg shadow-primary/20">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-base mb-2">Xem thực đơn</h3>
                        <p class="text-white/75 text-xs leading-relaxed mb-4">Khám phá các thực đơn phong phú, đa dạng vùng miền của PhatFood.</p>
                        <a href="{{ route('services.menu') }}"
                           class="inline-flex items-center gap-2 text-sm font-bold bg-white text-primary px-4 py-2.5 rounded-xl hover:bg-accent transition-colors w-full justify-center">
                            Xem thực đơn
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="flex-1 min-w-0">

                    {{-- Section heading --}}
                    <div class="mb-10">
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Các dịch vụ</p>
                        <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">Dịch vụ của chúng tôi</h2>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-1 bg-primary rounded-full"></div>
                            <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                        </div>
                        <p class="text-gray-600 leading-relaxed mt-4 max-w-2xl">
                            PhatFood cung cấp dịch vụ suất ăn công nghiệp toàn diện với thực đơn đặc trưng của từng vùng miền
                            Bắc - Trung - Nam, đảm bảo an toàn vệ sinh thực phẩm và dinh dưỡng hợp lý cho người lao động.
                        </p>
                    </div>

                    {{-- ── Service Cards (alternating image left/right) ── --}}
                    @php
                        $gradients = [
                            'from-blue-600 to-blue-900',
                            'from-amber-600 to-amber-900',
                            'from-emerald-600 to-emerald-900',
                        ];
                        $regionEmojis = ['🍜','🌶️','🥗'];
                        $regionLabels = ['Miền Bắc','Miền Trung','Miền Nam'];
                    @endphp

                    <div class="space-y-8">
                        @forelse($services as $index => $service)
                            @php $isReverse = $index % 2 !== 0; @endphp
                            <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-400 overflow-hidden group"
                                     x-data="{ visible: false }"
                                     x-intersect.once="visible = true">
                                <div class="flex flex-col md:flex-row {{ $isReverse ? 'md:flex-row-reverse' : '' }}"
                                     x-show="visible"
                                     x-transition:enter="transition ease-out duration-500"
                                     x-transition:enter-start="opacity-0 translate-y-6"
                                     x-transition:enter-end="opacity-100 translate-y-0">

                                    {{-- Image / Gradient placeholder --}}
                                    <div class="md:w-5/12 relative overflow-hidden flex-shrink-0">
                                        @if($service->image && file_exists(storage_path('app/public/' . $service->image)))
                                            <img src="{{ asset('storage/' . $service->image) }}"
                                                 alt="{{ $service->title }}"
                                                 class="w-full h-60 md:h-full object-cover group-hover:scale-105 transition-transform duration-600"
                                                 loading="lazy">
                                            <div class="absolute inset-0 bg-gradient-to-t from-dark/40 to-transparent"></div>
                                        @else
                                            <div class="w-full h-60 md:h-full min-h-[14rem] bg-gradient-to-br {{ $gradients[$index % 3] }} flex flex-col items-center justify-center gap-3">
                                                <span class="text-6xl">{{ $regionEmojis[$index % 3] }}</span>
                                                <span class="text-white/80 font-semibold text-sm">{{ $service->title }}</span>
                                            </div>
                                        @endif

                                        {{-- Region badge --}}
                                        <div class="absolute {{ $isReverse ? 'right-4' : 'left-4' }} top-4">
                                            <span class="bg-primary text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg">
                                                {{ $regionLabels[$index % 3] }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="md:w-7/12 p-7 md:p-9 flex flex-col justify-center">
                                        <p class="text-xs font-bold text-primary/60 uppercase tracking-widest mb-2">
                                            Dịch vụ {{ sprintf('%02d', $index + 1) }}
                                        </p>
                                        <h3 class="text-xl md:text-2xl font-bold text-dark mb-3 group-hover:text-primary transition-colors">
                                            {{ $service->title }}
                                        </h3>
                                        <div class="w-10 h-0.5 bg-primary mb-4"></div>
                                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                                            {{ $service->description ?? 'Dịch vụ suất ăn công nghiệp chuyên nghiệp với thực đơn đặc trưng vùng miền, đảm bảo an toàn vệ sinh thực phẩm.' }}
                                        </p>

                                        <ul class="space-y-2.5 mb-7">
                                            @foreach([
                                                'Nguyên liệu tươi ngon, đảm bảo VSATTP',
                                                'Thực đơn đa dạng, phù hợp khẩu vị vùng miền',
                                                'Giao hàng đúng giờ, phục vụ chuyên nghiệp',
                                            ] as $feature)
                                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                                    <div class="w-5 h-5 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </div>
                                                    {{ $feature }}
                                                </li>
                                            @endforeach
                                        </ul>

                                        <a href="{{ route('services.show', $service->slug) }}"
                                           class="inline-flex items-center gap-2 self-start bg-primary text-white text-sm font-bold px-6 py-3 rounded-xl hover:bg-primary/90 transition-colors shadow-md shadow-primary/20 group/btn">
                                            Tìm hiểu thêm
                                            <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span class="text-3xl">🍱</span>
                                </div>
                                <h3 class="text-lg font-semibold text-dark mb-2">Dịch vụ đang được cập nhật</h3>
                                <p class="text-gray-400 text-sm">Vui lòng quay lại sau.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- ── Menu Section ── --}}
                    @if(isset($menus) && $menus->count() > 0)
                        <div class="mt-14">
                            <div class="flex items-center justify-between mb-7">
                                <div>
                                    <p class="text-xs font-bold text-primary uppercase tracking-widest mb-1">Thực đơn</p>
                                    <h2 class="text-2xl font-bold text-dark">Thực đơn nổi bật</h2>
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="w-10 h-1 bg-primary rounded-full"></div>
                                        <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                                    </div>
                                </div>
                                <a href="{{ route('services.menu') }}"
                                   class="inline-flex items-center gap-2 text-sm font-semibold border-2 border-primary text-primary px-4 py-2 rounded-xl hover:bg-primary hover:text-white transition-all duration-200">
                                    Xem tất cả
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                                @foreach($menus->take(6) as $menu)
                                    <a href="{{ route('services.menu') }}"
                                       class="group bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md hover:border-primary/20 transition-all duration-300">
                                        @if(isset($menu->image) && $menu->image && file_exists(storage_path('app/public/' . $menu->image)))
                                            <img src="{{ asset('storage/' . $menu->image) }}"
                                                 alt="{{ $menu->title }}"
                                                 class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-500"
                                                 loading="lazy">
                                        @else
                                            <div class="w-full h-36 bg-gradient-to-br from-accent to-gray-100 flex items-center justify-center text-4xl">🍱</div>
                                        @endif
                                        <div class="p-4">
                                            <h4 class="text-sm font-semibold text-dark group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                                {{ $menu->title }}
                                            </h4>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
