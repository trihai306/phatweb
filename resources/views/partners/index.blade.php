@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Đối tác</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative overflow-hidden bg-dark">
        <img src="{{ asset('images/anhweb/khu-tiep-nhan-thuc-pham.jpg') }}"
             alt="Đối tác DAT PHAT"
             class="absolute inset-0 w-full h-full object-cover opacity-40"
             loading="eager">
        <div class="absolute inset-0 bg-gradient-to-r from-dark/90 to-dark/60"></div>

        <div class="relative container-main py-16 md:py-24">
            <div class="max-w-2xl">
                <p class="text-primary-light text-xs font-bold uppercase tracking-widest mb-3">DAT PHAT NUTRITION</p>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 leading-tight">
                    Đối tác <span class="text-primary-light">liên kết</span>
                </h1>
                <p class="text-white/70 text-base leading-relaxed">
                    Danh sách các nhà cung cấp uy tín, đảm bảo nguồn nguyên liệu chất lượng và an toàn vệ sinh thực phẩm cho mọi bữa ăn.
                </p>
            </div>
        </div>
    </section>

    {{-- ===== PARTNER LISTING ===== --}}
    <section class="py-14 md:py-20 bg-gray-50">
        <div class="container-main">

            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-primary text-xs font-bold uppercase tracking-widest mb-2">Mục lục nhà cung cấp</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    {{ count($partners) }} Đối tác liên kết
                </h2>
                <p class="mt-3 text-gray-500 leading-relaxed">
                    Chúng tôi hợp tác với các nhà cung cấp được chứng nhận đầy đủ giấy tờ, đảm bảo truy xuất nguồn gốc rõ ràng.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach($partners as $index => $partner)
                    <div x-data x-intersect.once="$el.classList.add('animate-fade-up')"
                         class="opacity-0 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden"
                         style="animation-delay: {{ $index * 80 }}ms">

                        {{-- Card Header --}}
                        <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
                            <div class="flex items-start justify-between">
                                <div>
                                    <span class="inline-block px-2.5 py-0.5 bg-white/20 text-white text-[11px] font-semibold uppercase tracking-wider rounded-full mb-2">
                                        {{ $partner['category'] }}
                                    </span>
                                    <h3 class="text-lg font-bold text-white leading-snug">{{ $partner['name'] }}</h3>
                                </div>
                                <span class="flex-shrink-0 w-10 h-10 bg-white/15 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="px-6 py-5 space-y-4">

                            {{-- Address --}}
                            @if($partner['address'])
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $partner['address'] }}</p>
                                </div>
                            @endif

                            {{-- MST --}}
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium text-gray-800">MST:</span> {{ $partner['mst'] }}
                                </p>
                            </div>

                            {{-- Products --}}
                            @if(count($partner['products']) > 0)
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Sản phẩm cung cấp</p>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($partner['products'] as $product)
                                            <span class="inline-block px-2.5 py-1 bg-accent text-primary text-xs font-medium rounded-lg">
                                                {{ $product }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Cert Pages --}}
                            @if($partner['cert_pages'])
                                <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                                    <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800">Giấy chứng nhận:</span> {{ $partner['cert_pages'] }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ===== CTA BANNER ===== --}}
    <section class="bg-gradient-to-r from-primary to-primary-dark py-14">
        <div class="container-main text-center">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3">Liên hệ hợp tác cùng DAT PHAT</h2>
            <p class="text-white/70 max-w-xl mx-auto mb-6">
                Chúng tôi luôn tìm kiếm các đối tác uy tín để mở rộng mạng lưới cung cấp nguyên liệu chất lượng cao.
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white text-primary font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                Liên hệ ngay
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>

@endsection
