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
        <img src="{{ asset('images/anhweb/kiem-tra-nguyen-lieu.jpg') }}"
             alt="Đối tác DAT PHAT"
             class="absolute inset-0 w-full h-full object-cover opacity-30"
             loading="eager">
        <div class="absolute inset-0 bg-gradient-to-br from-dark via-dark/85 to-primary-dark/60"></div>

        <div class="relative container-main py-20 md:py-28">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/20 backdrop-blur-sm border border-primary/30 rounded-full text-primary-light text-xs font-bold uppercase tracking-widest mb-5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
                    DAT PHAT NUTRITION
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 leading-tight">
                    Mạng lưới<br><span class="text-primary-light">đối tác liên kết</span>
                </h1>
                <p class="text-white/60 text-lg leading-relaxed max-w-lg">
                    Hệ thống nhà cung cấp uy tín, đảm bảo nguồn nguyên liệu chất lượng và an toàn vệ sinh thực phẩm.
                </p>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary/40 to-transparent"></div>
    </section>

    {{-- ===== STATS BAR ===== --}}
    <section class="bg-white border-b border-gray-100">
        <div class="container-main py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <div class="text-center" x-data x-intersect.once="$el.classList.add('animate-fade-up')">
                    <p class="text-3xl md:text-4xl font-extrabold text-primary">{{ count($partners) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Đối tác liên kết</p>
                </div>
                <div class="text-center" x-data x-intersect.once="$el.classList.add('animate-fade-up')" style="animation-delay:100ms">
                    <p class="text-3xl md:text-4xl font-extrabold text-primary">100%</p>
                    <p class="text-sm text-gray-500 mt-1">Có giấy chứng nhận</p>
                </div>
                <div class="text-center" x-data x-intersect.once="$el.classList.add('animate-fade-up')" style="animation-delay:200ms">
                    <p class="text-3xl md:text-4xl font-extrabold text-primary">6+</p>
                    <p class="text-sm text-gray-500 mt-1">Ngành hàng cung cấp</p>
                </div>
                <div class="text-center" x-data x-intersect.once="$el.classList.add('animate-fade-up')" style="animation-delay:300ms">
                    <p class="text-3xl md:text-4xl font-extrabold text-primary">50+</p>
                    <p class="text-sm text-gray-500 mt-1">Sản phẩm đa dạng</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PARTNER LISTING ===== --}}
    <section class="py-16 md:py-24 bg-gray-50/80">
        <div class="container-main">

            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-primary text-xs font-bold uppercase tracking-widest mb-3">Mục lục nhà cung cấp</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Danh sách đối tác
                </h2>
                <div class="flex items-center justify-center gap-1.5 mt-4">
                    <span class="w-8 h-1 bg-primary rounded-full"></span>
                    <span class="w-3 h-1 bg-primary/40 rounded-full"></span>
                </div>
                <p class="mt-5 text-gray-500 leading-relaxed">
                    Chúng tôi hợp tác với các nhà cung cấp được chứng nhận đầy đủ giấy tờ, đảm bảo truy xuất nguồn gốc rõ ràng.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                @foreach($partners as $index => $partner)
                    <div x-data="{ expanded: false }" x-intersect.once="$el.classList.add('animate-fade-up')"
                         class="opacity-0 group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100/80"
                         style="animation-delay: {{ $index * 100 }}ms">

                        {{-- Number badge --}}
                        <div class="absolute top-5 right-5 w-12 h-12 bg-gradient-to-br from-primary/10 to-primary/5 rounded-2xl flex items-center justify-center z-10">
                            <span class="text-primary font-extrabold text-lg">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        {{-- Card Content --}}
                        <div class="p-6 md:p-8">

                            {{-- Company Header --}}
                            <div class="pr-14 mb-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-primary/8 text-primary text-[11px] font-bold uppercase tracking-wider rounded-full mb-3">
                                    @switch($partner['category'])
                                        @case('Thực phẩm chế biến & Trứng')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                            @break
                                        @case('Gia cầm')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                            @break
                                        @case('Rau củ & Gia vị')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                                            @break
                                        @case('Lương thực')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                            @break
                                        @default
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    @endswitch
                                    {{ $partner['category'] }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 leading-snug group-hover:text-primary transition-colors duration-300">
                                    {{ $partner['name'] }}
                                </h3>
                            </div>

                            {{-- Info Grid --}}
                            <div class="space-y-3 mb-5">
                                @if($partner['address'])
                                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl">
                                        <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed pt-1">{{ $partner['address'] }}</p>
                                    </div>
                                @endif

                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                    <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold text-gray-800">MST:</span>
                                        <span class="font-mono tracking-wide">{{ $partner['mst'] }}</span>
                                    </p>
                                </div>

                                @if($partner['cert_pages'])
                                    @php preg_match_all('/\d+/', $partner['cert_pages'], $certMatch); $certPages = $certMatch[0]; @endphp
                                    <div class="flex items-start gap-3 p-3 bg-primary/5 rounded-xl border border-primary/10">
                                        <div class="w-8 h-8 bg-primary/15 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm text-primary font-semibold" style="margin-bottom:0.4rem;">Giấy chứng nhận an toàn thực phẩm</p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($certPages as $pg)
                                                    <a href="{{ asset('docs/giay-chung-nhan-doi-tac.pdf') }}#page={{ $pg }}"
                                                       target="_blank" rel="noopener"
                                                       title="Xem giấy chứng nhận — trang {{ $pg }}"
                                                       style="display:inline-flex; align-items:center; gap:0.3rem; padding:0.28rem 0.65rem; background:#ffffff; border:1px solid rgba(25,89,47,0.35); color:#19592F; font-size:0.78rem; font-weight:600; border-radius:0.55rem; text-decoration:none; transition:all 0.2s ease;"
                                                       onmouseover="this.style.background='#19592F'; this.style.color='#ffffff'; this.style.borderColor='#19592F';"
                                                       onmouseout="this.style.background='#ffffff'; this.style.color='#19592F'; this.style.borderColor='rgba(25,89,47,0.35)';">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:0.9rem; height:0.9rem;">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 3v6h6"/>
                                                        </svg>
                                                        Trang {{ $pg }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- Products --}}
                            @if(count($partner['products']) > 0)
                                <div class="pt-5 border-t border-gray-100">
                                    <div class="flex items-center justify-between mb-3">
                                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Sản phẩm cung cấp</p>
                                        <span class="text-xs text-gray-400 font-medium">{{ count($partner['products']) }} sản phẩm</span>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($partner['products'] as $pIndex => $product)
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-white border border-gray-200 text-gray-700 text-xs font-medium rounded-full shadow-sm hover:border-primary/40 hover:text-primary transition-colors duration-200">
                                                <span class="w-1.5 h-1.5 bg-primary/60 rounded-full"></span>
                                                {{ $product }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>

                        {{-- Bottom accent line --}}
                        <div class="h-1 bg-gradient-to-r from-primary via-primary-light to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ===== CTA BANNER ===== --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-dark via-primary to-primary-dark"></div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/3 translate-y-1/3"></div>
        </div>

        <div class="relative container-main py-16 md:py-20">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-2">Liên hệ hợp tác cùng DAT PHAT</h2>
                    <p class="text-white/60 max-w-lg">
                        Chúng tôi luôn tìm kiếm các đối tác uy tín để mở rộng mạng lưới cung cấp nguyên liệu chất lượng cao.
                    </p>
                </div>
                <a href="{{ route('contact.index') }}" class="flex-shrink-0 inline-flex items-center gap-2.5 bg-white text-primary font-bold px-8 py-4 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-0.5 transition-all duration-300 group">
                    Liên hệ ngay
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

@endsection
