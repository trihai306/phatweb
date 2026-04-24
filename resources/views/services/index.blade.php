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
        {{-- Background --}}
        @php $firstService = $services->first(); @endphp
        @if($firstService && $firstService->image && file_exists(storage_path('app/public/' . $firstService->image)))
            <img src="{{ asset('storage/' . $firstService->image) }}"
                 alt="Dịch vụ DAT PHAT"
                 class="absolute inset-0 w-full h-full object-cover"
                 loading="eager">
        @else
            <div class="absolute inset-0 bg-dark"></div>
        @endif

        {{-- Clean dark overlay --}}
        <div class="absolute inset-0 bg-dark/80"></div>

        <div class="relative container-main py-16 md:py-24">
            <div class="max-w-2xl">
                <p class="text-primary-light text-xs font-bold uppercase tracking-widest mb-3">DAT PHAT Vietnam</p>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 leading-tight">
                    Dịch vụ <span class="text-primary-light">của chúng tôi</span>
                </h1>
                <p class="text-white/70 text-base leading-relaxed">
                    Suất ăn công nghiệp chuyên nghiệp, an toàn và đa dạng — phục vụ hàng nghìn khách hàng mỗi ngày trên toàn quốc.
                </p>
            </div>
        </div>
    </section>

    {{-- ===== MAIN CONTENT ===== --}}
    <section class="py-14 md:py-20 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- ── Left Sidebar ── --}}
                <div class="lg:w-72 xl:w-80 flex-shrink-0">
                    <x-sidebar
                        title="Dịch vụ"
                        :items="$services"
                        currentSlug=""
                    />

                    {{-- "Xem thực đơn" CTA card --}}
                    <div class="mt-6 bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-6 text-white shadow-lg shadow-primary/20">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-base mb-2">Xem thực đơn</h3>
                        <p class="text-white/75 text-xs leading-relaxed mb-4">Khám phá các thực đơn phong phú, đa dạng vùng miền của DAT PHAT.</p>
                        <a href="{{ route('services.menu') }}"
                           class="inline-flex items-center gap-2 text-sm font-bold bg-white text-primary px-4 py-2.5 rounded-xl hover:bg-accent transition-colors w-full justify-center">
                            Xem thực đơn
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- ── Right Content ── --}}
                <div class="flex-1 min-w-0">

                    {{-- Section heading --}}
                    <div class="mb-8"
                         x-data="{ visible: false }"
                         x-intersect.once="visible = true"
                         x-show="visible"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Các dịch vụ</p>
                        <h2 class="text-2xl md:text-3xl font-bold text-dark mb-3">Dịch vụ của chúng tôi</h2>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-1 bg-primary rounded-full"></div>
                            <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                        </div>
                        <p class="text-gray-600 leading-relaxed mt-4 max-w-2xl text-sm">
                            DAT PHAT cung cấp dịch vụ suất ăn công nghiệp toàn diện với thực đơn đặc trưng của từng vùng miền
                            Bắc – Trung – Nam, đảm bảo an toàn vệ sinh thực phẩm và dinh dưỡng hợp lý cho người lao động.
                        </p>
                    </div>

                    {{-- ── Service Cards Grid (2 columns) ── --}}
                    @php
                        $gradients = [
                            'from-emerald-700 to-emerald-900',
                            'from-teal-600 to-teal-900',
                            'from-green-700 to-green-900',
                            'from-lime-600 to-lime-900',
                            'from-cyan-600 to-cyan-900',
                            'from-blue-600 to-blue-900',
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($services as $index => $service)
                            <article class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-400 bg-white border border-gray-100 hover:border-primary/20"
                                     x-data="{ visible: false }"
                                     x-intersect.once="visible = true">

                                {{-- Card inner with scroll reveal --}}
                                <a href="{{ route('services.show', $service->slug) }}"
                                   class="block"
                                   x-show="visible"
                                   x-transition:enter="transition ease-out duration-500"
                                   x-transition:enter-start="opacity-0 translate-y-6"
                                   x-transition:enter-end="opacity-100 translate-y-0"
                                   style="transition-delay: {{ ($index % 2) * 80 }}ms">

                                    {{-- Image / Gradient placeholder --}}
                                    <div class="relative overflow-hidden h-52">
                                        @if($service->image && file_exists(storage_path('app/public/' . $service->image)))
                                            <img src="{{ asset('storage/' . $service->image) }}"
                                                 alt="{{ $service->title }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                 loading="lazy">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br {{ $gradients[$index % count($gradients)] }} flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                                                <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </div>
                                        @endif

                                        {{-- Title overlay at bottom --}}
                                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-dark/80 via-dark/40 to-transparent pt-10 pb-4 px-5">
                                            <h3 class="text-white font-bold text-base leading-snug drop-shadow-sm group-hover:text-primary-light transition-colors">
                                                {{ $service->title }}
                                            </h3>
                                        </div>
                                    </div>

                                    {{-- Card body --}}
                                    <div class="p-5">
                                        <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">
                                            {{ $service->description ?? 'Dịch vụ suất ăn chuyên nghiệp với thực đơn đặc trưng vùng miền, đảm bảo an toàn vệ sinh thực phẩm.' }}
                                        </p>
                                        <div class="mt-4 flex items-center gap-2 text-primary text-sm font-semibold group-hover:gap-3 transition-all">
                                            Tìm hiểu thêm
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @empty
                            <div class="col-span-2 bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-dark mb-2">Dịch vụ đang được cập nhật</h3>
                                <p class="text-gray-400 text-sm">Vui lòng quay lại sau.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- ── CTA Banner (Tristar-style) ── --}}
                    <div class="mt-12 rounded-2xl overflow-hidden"
                         x-data="{ visible: false }"
                         x-intersect.once="visible = true"
                         x-show="visible"
                         x-transition:enter="transition ease-out duration-600"
                         x-transition:enter-start="opacity-0 translate-y-6"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="relative bg-accent border border-primary/15 rounded-2xl px-8 py-10 md:px-12 md:py-12 overflow-hidden">

                            {{-- Decorative background circles --}}
                            <div class="absolute -top-10 -right-10 w-48 h-48 bg-primary/8 rounded-full pointer-events-none"></div>
                            <div class="absolute -bottom-8 -left-8 w-36 h-36 bg-primary/6 rounded-full pointer-events-none"></div>

                            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                                <div class="flex-1">
                                    {{-- Green accent bar --}}
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-8 h-1 bg-primary rounded-full"></div>
                                        <div class="w-4 h-1 bg-primary/40 rounded-full"></div>
                                    </div>
                                    <h3 class="text-xl md:text-2xl font-extrabold text-dark leading-snug mb-2">
                                        Được phục vụ quý khách là niềm vinh hạnh của chúng tôi.
                                    </h3>
                                    <p class="text-gray-600 text-base">
                                        Xin hãy liên hệ trực tiếp.
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('contact.index') }}"
                                       class="btn-primary gap-2 text-base px-8 py-3.5 shadow-lg shadow-primary/25 hover:shadow-primary/40">
                                        Liên hệ
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Menu Section ── --}}
                    @if(isset($menus) && $menus->count() > 0)
                        <div class="mt-14"
                             x-data="{ visible: false }"
                             x-intersect.once="visible = true"
                             x-show="visible"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0">
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
                                            <div class="w-full h-36 bg-gradient-to-br from-accent to-gray-100 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </div>
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

                </div>{{-- end right content --}}
            </div>{{-- end flex row --}}
        </div>{{-- end container --}}
    </section>

@endsection
