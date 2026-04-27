@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════════════════════════
    HERO SLIDER — Full-screen crossfade with gradient overlay
═══════════════════════════════════════════════════════════ --}}
<section
    x-data="slider"
    class="relative overflow-hidden bg-dark"
    @mouseenter="stopAutoplay"
    @mouseleave="startAutoplay"
    style="height: 100vh; min-height: 600px; max-height: 900px;"
>
    {{-- Slides container --}}
    <div x-ref="slides" class="absolute inset-0">
        @forelse($sliders as $index => $slider)
            <div
                x-show="currentSlide === {{ $index }}"
                x-transition:enter="transition-opacity ease-in-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in-out duration-700"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0"
            >
                @php
                    $imagePath = $slider->image;
                    $imageExists = $imagePath && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath);
                @endphp

                @if($imageExists)
                    {{-- Ken Burns zoom effect via CSS animation --}}
                    <div class="absolute inset-0 overflow-hidden">
                        <img
                            src="{{ asset('storage/' . $imagePath) }}"
                            alt="{{ $slider->title }}"
                            class="w-full h-full object-cover"
                            style="transform-origin: center; animation: heroZoom 8s ease-in-out infinite alternate;"
                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                        >
                    </div>
                @else
                    {{-- Beautiful gradient fallback when image missing --}}
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, #0a2e15 0%, #12472A 30%, #19592F 60%, #19592F 100%);">
                        {{-- Decorative pattern overlay --}}
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
                    </div>
                @endif

                {{-- Multi-layer gradient overlay for text readability --}}
                <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.45) 50%, rgba(0,0,0,0.1) 100%);"></div>
                <div class="absolute inset-0" style="background: linear-gradient(0deg, rgba(0,0,0,0.4) 0%, transparent 50%);"></div>

                {{-- Slide content --}}
                <div class="absolute inset-0 flex items-center">
                    <div class="container-main w-full">
                        <div class="max-w-3xl text-white" style="padding-top: 80px;">
                            {{-- Eyebrow label --}}
                            <div class="flex items-center gap-3 mb-6" style="opacity: 0; animation: slideUpFade 0.8s ease forwards 0.2s;">
                                <div style="width: 40px; height: 2px; background: #19592F;"></div>
                                <span class="text-sm font-semibold tracking-widest uppercase" style="color: #7FBF3F;">DAT PHAT Việt Nam</span>
                            </div>

                            <h1 class="font-bold leading-tight mb-6"
                                style="font-size: clamp(2rem, 5vw, 4rem); opacity: 0; animation: slideUpFade 0.8s ease forwards 0.4s; text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                                {{ $slider->title }}
                            </h1>

                            @if($slider->subtitle)
                                <p class="mb-10 leading-relaxed"
                                   style="font-size: clamp(1rem, 2vw, 1.25rem); opacity: 0; animation: slideUpFade 0.8s ease forwards 0.6s; color: rgba(255,255,255,0.88);">
                                    {{ $slider->subtitle }}
                                </p>
                            @endif

                            <div class="flex flex-wrap gap-4" style="opacity: 0; animation: slideUpFade 0.8s ease forwards 0.8s;">
                                @if($slider->link)
                                    <a href="{{ $slider->link }}"
                                       class="btn-primary"
                                       style="font-size: 1rem; padding: 0.875rem 2rem; border-radius: 0.5rem; box-shadow: 0 4px 20px rgba(25,89,47,0.4);">
                                        Tìm hiểu thêm
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('services.index') }}"
                                   class="btn-outline"
                                   style="font-size: 1rem; padding: 0.875rem 2rem; border-radius: 0.5rem; border-color: rgba(255,255,255,0.6); color: white; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px);">
                                    Dịch vụ của chúng tôi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Fallback slide when no sliders exist --}}
            <div class="absolute inset-0">
                <div class="absolute inset-0" style="background: linear-gradient(135deg, #0a2e15 0%, #12472A 30%, #19592F 60%, #12472A 100%);">
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
                </div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container-main">
                        <div class="max-w-3xl text-white" style="padding-top: 80px;">
                            <div class="flex items-center gap-3 mb-6">
                                <div style="width: 40px; height: 2px; background: #19592F;"></div>
                                <span class="text-sm font-semibold tracking-widest uppercase" style="color: #7FBF3F;">DAT PHAT Việt Nam</span>
                            </div>
                            <h1 class="font-bold leading-tight mb-6" style="font-size: clamp(2rem, 5vw, 4rem); text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                                Điều cơ bản của ẩm thực xuất phát từ sự tươi ngon và an toàn.
                            </h1>
                            <p class="mb-10" style="font-size: 1.2rem; color: rgba(255,255,255,0.88);">
                                DAT PHAT — Dịch vụ suất ăn công nghiệp hàng đầu Việt Nam
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('services.index') }}" class="btn-primary" style="font-size: 1rem; padding: 0.875rem 2rem; box-shadow: 0 4px 20px rgba(25,89,47,0.4);">
                                    Dịch vụ của chúng tôi
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <a href="{{ route('contact.index') }}"
                                   style="display:inline-flex; align-items:center; font-size:1rem; padding: 0.875rem 2rem; border-radius:0.5rem; border: 2px solid rgba(255,255,255,0.5); color:white; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); transition: all 0.3s; font-weight:600;">
                                    Liên hệ ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Slide navigation dots & arrows --}}
    @if($sliders->count() > 1)
        {{-- Arrow buttons --}}
        <button @click="prev"
                class="absolute left-6 top-1/2 -translate-y-1/2 z-10 flex items-center justify-center text-white transition-all duration-300"
                style="width:52px; height:52px; border-radius:50%; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25);"
                aria-label="Trước">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button @click="next"
                class="absolute right-6 top-1/2 -translate-y-1/2 z-10 flex items-center justify-center text-white transition-all duration-300"
                style="width:52px; height:52px; border-radius:50%; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.25);"
                aria-label="Tiếp">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-10 left-0 right-0 z-10">
            <div class="container-main flex items-center justify-center gap-3">
                @foreach($sliders as $i => $s)
                    <button
                        @click="goTo({{ $i }})"
                        :style="currentSlide === {{ $i }} ? 'width:36px; background:#19592F;' : 'width:10px; background:rgba(255,255,255,0.45);'"
                        style="height:10px; border-radius:999px; border:none; cursor:pointer; transition: all 0.3s ease;"
                        aria-label="Slide {{ $i + 1 }}"
                    ></button>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Bottom wave separator --}}
    <div class="absolute bottom-0 left-0 right-0 z-10 pointer-events-none">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block; width:100%;">
            <path d="M0 60L48 50C96 40 192 20 288 15C384 10 480 20 576 28C672 36 768 42 864 38C960 34 1056 18 1152 12C1248 6 1344 10 1392 12L1440 14V60H0Z" fill="white"/>
        </svg>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
    SERVICES SECTION — Asymmetric grid, image zoom on hover
═══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="container-main">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

            {{-- Left sticky column --}}
            <div class="lg:col-span-4 lg:sticky lg:top-28"
                 style="transition: all 0.7s ease;">
                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-4">
                    <div style="width:32px; height:3px; background:#19592F; border-radius:2px;"></div>
                    <span class="text-sm font-semibold tracking-widest uppercase" style="color:#19592F;">Giải pháp</span>
                </div>
                <h2 class="section-title" style="font-size: clamp(1.75rem, 3vw, 2.75rem); line-height: 1.15;">
                    Dịch vụ<br>
                    <span style="color:#19592F;">của chúng tôi</span>
                </h2>
                <div style="width:48px; height:4px; background: linear-gradient(90deg, #19592F, #7FBF3F); border-radius:2px; margin: 1.25rem 0 1.5rem;"></div>
                <p class="leading-relaxed mb-8" style="color:#555; font-size:1.0625rem; line-height:1.75;">
                    Từ suất ăn trường học đến suất ăn công nghiệp, chúng tôi mang đến giải pháp ẩm thực toàn diện với thực đơn dinh dưỡng, nguyên liệu tươi sạch và quy trình ATTP nghiêm ngặt.
                </p>
                <a href="{{ route('services.index') }}" class="btn-primary" style="display:inline-flex; gap:0.5rem; align-items:center;">
                    Xem tất cả dịch vụ
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

                {{-- Decorative element --}}
                <div class="mt-16 hidden lg:block" style="width:180px; height:180px; border-radius:50%; background: linear-gradient(135deg, rgba(25,89,47,0.08), rgba(25,89,47,0.08)); position:relative;">
                    <div style="position:absolute; top:20px; left:20px; right:20px; bottom:20px; border-radius:50%; border: 2px dashed rgba(25,89,47,0.2);"></div>
                    <span style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
                        <svg class="w-12 h-12" style="color:#19592F;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.379a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12"/></svg>
                    </span>
                </div>
            </div>

            {{-- Right: Service cards 2-column grid --}}
            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($services as $index => $service)
                    @php
                        $svcImageExists = $service->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($service->image);
                        $gradients = [
                            'linear-gradient(135deg, #19592F, #7FBF3F)',
                            'linear-gradient(135deg, #19592F, #7FBF3F)',
                            'linear-gradient(135deg, #12472A, #19592F)',
                            'linear-gradient(135deg, #12472A, #19592F)',
                        ];
                        $grad = $gradients[$index % 4];
                        $serviceSvgs = [
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>',
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.379a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12"/></svg>',
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z"/></svg>',
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>',
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0H21M3.375 14.25h-.375a3 3 0 013-3h.75m0 0h10.5m-10.5 0V6.375a3 3 0 013-3h7.5a3 3 0 013 3v4.875m0 0h.375a3 3 0 013 3V18"/></svg>',
                            '<svg class="w-16 h-16 text-white/90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>',
                        ];
                    @endphp
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="group block"
                       style="border-radius: 1rem; overflow: hidden; background: white; box-shadow: 0 2px 12px rgba(0,0,0,0.07); transition: transform 0.35s ease, box-shadow 0.35s ease;"
                       x-data="{}"
                       @mouseenter="$el.style.transform='translateY(-6px)'; $el.style.boxShadow='0 16px 40px rgba(0,0,0,0.14)'"
                       @mouseleave="$el.style.transform=''; $el.style.boxShadow='0 2px 12px rgba(0,0,0,0.07)'"
                    >
                        {{-- Image area --}}
                        <div class="relative overflow-hidden" style="height: 220px;">
                            @if($svcImageExists)
                                <img src="{{ asset('storage/' . $service->image) }}"
                                     alt="{{ $service->title }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center" style="background: {{ $grad }};">
                                    {!! $serviceSvgs[$index % count($serviceSvgs)] !!}
                                </div>
                            @endif
                            {{-- Gradient overlay on image --}}
                            <div class="absolute inset-0" style="background: linear-gradient(180deg, transparent 40%, rgba(0,0,0,0.65) 100%);"></div>
                            {{-- Title badge on image --}}
                            <div class="absolute bottom-0 left-0 right-0 px-5 pb-4">
                                <span class="inline-block text-white font-bold" style="font-size: 1.0625rem; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
                                    {{ $service->title }}
                                </span>
                            </div>
                            {{-- Small tag top-right --}}
                            <div class="absolute top-4 right-4">
                                <span class="text-white text-xs font-semibold px-3 py-1" style="background: rgba(25,89,47,0.9); border-radius:999px; backdrop-filter:blur(4px);">
                                    Dịch vụ
                                </span>
                            </div>
                        </div>

                        {{-- Card body --}}
                        <div class="p-5">
                            <p class="leading-relaxed text-sm line-clamp-2 mb-4" style="color: #666;">
                                {{ $service->description }}
                            </p>
                            <div class="flex items-center font-semibold text-sm transition-all duration-300 group-hover:gap-3" style="color: #19592F; gap: 0.375rem;">
                                Xem chi tiết
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
    WHY US / STRENGTHS — Cream background, lift cards
═══════════════════════════════════════════════════════════ --}}
<section class="py-24" style="background: #F5F0E1;">
    <div class="container-main">
        {{-- Section header --}}
        <div class="text-center mb-16"
             style="transition: all 0.7s ease;">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div style="width:32px; height:3px; background:#19592F; border-radius:2px;"></div>
                <span class="text-sm font-semibold tracking-widest uppercase" style="color:#19592F;">Cam kết</span>
                <div style="width:32px; height:3px; background:#19592F; border-radius:2px;"></div>
            </div>
            <h2 class="section-title" style="font-size: clamp(1.75rem, 3vw, 2.75rem);">
                Tại sao chọn <span style="color:#19592F;">DAT PHAT</span>?
            </h2>
            <p class="section-subtitle mx-auto mt-4" style="max-width: 560px; color:#666;">
                Chúng tôi cam kết mang đến những bữa ăn ngon, an toàn và đúng giờ với đội ngũ chuyên nghiệp nhiều năm kinh nghiệm.
            </p>
        </div>

        {{-- Strength cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($strengths as $index => $strength)
                <a href="{{ route('whyus.show', $strength->slug) }}"
                   class="block text-center group"
                   style="background: white; border-radius: 1.25rem; padding: 2.5rem 1.75rem; box-shadow: 0 2px 16px rgba(0,0,0,0.06); border: 2px solid transparent; transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;"
                   @mouseenter="$el.style.transform='translateY(-8px)'; $el.style.boxShadow='0 20px 48px rgba(25,89,47,0.15)'; $el.style.borderColor='rgba(25,89,47,0.3)'"
                   @mouseleave="$el.style.transform=''; $el.style.boxShadow='0 2px 16px rgba(0,0,0,0.06)'; $el.style.borderColor='transparent'"
                >
                    {{-- Icon circle --}}
                    <div class="mx-auto mb-6 flex items-center justify-center transition-transform duration-300 group-hover:scale-110"
                         style="width:88px; height:88px; border-radius:50%; background: linear-gradient(135deg, rgba(25,89,47,0.12), rgba(25,89,47,0.12));">
                        @php
                            $strengthSvgs = [
                                '<svg class="w-10 h-10" style="color:#19592F;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>',
                                '<svg class="w-10 h-10" style="color:#19592F;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>',
                                '<svg class="w-10 h-10" style="color:#19592F;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>',
                                '<svg class="w-10 h-10" style="color:#19592F;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>',
                            ];
                        @endphp
                        {!! $strengthSvgs[$index % 4] !!}
                    </div>
                    <h3 class="font-bold mb-3 transition-colors duration-300 group-hover:text-orange-600"
                        style="font-size: 1.125rem; color: #333;">
                        {{ $strength->title }}
                    </h3>
                    <p class="text-sm leading-relaxed" style="color: #777;">
                        {{ Str::limit($strength->description, 120) }}
                    </p>

                    {{-- Bottom accent line --}}
                    <div class="mx-auto mt-6 transition-all duration-300 group-hover:w-16"
                         style="width: 32px; height: 3px; background: linear-gradient(90deg, #19592F, #7FBF3F); border-radius:2px;">
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
    CORE VALUES — Compact, personal touch for small business
═══════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden py-20" style="background: #19592F;">
    <div class="absolute inset-0 pointer-events-none">
        <div style="position:absolute; top:-80px; right:-80px; width:360px; height:360px; border-radius:50%; background:rgba(255,255,255,0.04);"></div>
        <div style="position:absolute; bottom:-120px; left:-60px; width:480px; height:480px; border-radius:50%; background:rgba(255,255,255,0.03);"></div>
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 36px 36px;"></div>
    </div>

    <div class="container-main relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Left: Message --}}
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div style="width:32px; height:3px; background:#7FBF3F; border-radius:2px;"></div>
                    <span class="text-sm font-semibold tracking-widest uppercase" style="color:#7FBF3F;">Giá trị cốt lõi</span>
                </div>
                <h2 class="font-bold text-white mb-6" style="font-size: clamp(1.75rem, 3vw, 2.5rem); line-height:1.2;">
                    Nhỏ gọn — Tận tâm — <br>
                    <span style="color:#7FBF3F;">Chất lượng không thỏa hiệp</span>
                </h2>
                <p class="leading-relaxed mb-8" style="color:rgba(255,255,255,0.8); font-size:1.0625rem; line-height:1.8;">
                    Với đội ngũ tinh gọn và đầy nhiệt huyết, chúng tôi trực tiếp quản lý từng bữa ăn — từ khâu chọn nguyên liệu đến khi phục vụ. Không qua trung gian, không qua loa, mỗi suất ăn đều là cam kết trách nhiệm.
                </p>
                <div class="flex items-center gap-4">
                    <div style="width:56px; height:56px; border-radius:50%; background:rgba(127,191,63,0.2); display:flex; align-items:center; justify-content:center;">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                    </div>
                    <div>
                        <div class="font-bold text-white" style="font-size:1.125rem;">Chứng nhận ATTP</div>
                        <div style="color:rgba(255,255,255,0.65); font-size:0.875rem;">Đảm bảo vệ sinh an toàn thực phẩm theo chuẩn</div>
                    </div>
                </div>
            </div>

            {{-- Right: Value cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @php
                    $coreValues = [
                        ['icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>', 'title' => 'Tận tâm phục vụ', 'desc' => 'Đội ngũ nhỏ, chăm sóc từng khách hàng như gia đình'],
                        ['icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/></svg>', 'title' => 'Nguyên liệu tươi sạch', 'desc' => 'Lựa chọn kỹ lưỡng, nguồn gốc rõ ràng mỗi ngày'],
                        ['icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'title' => 'Đúng giờ, đúng cam kết', 'desc' => 'Giao suất ăn đúng lịch, không để khách hàng chờ đợi'],
                        ['icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>', 'title' => 'Giá cả hợp lý', 'desc' => 'Chi phí tối ưu nhờ quy trình tinh gọn, không trung gian'],
                    ];
                @endphp
                @foreach($coreValues as $index => $value)
                    <div class="group"
                         style="background:rgba(255,255,255,0.08); backdrop-filter:blur(8px); border-radius:1rem; padding:1.75rem; border:1px solid rgba(255,255,255,0.12); transition: all 0.35s ease;"
                         x-data="{}"
                         @mouseenter="$el.style.background='rgba(255,255,255,0.14)'; $el.style.transform='translateY(-4px)'"
                         @mouseleave="$el.style.background='rgba(255,255,255,0.08)'; $el.style.transform=''">
                        <div class="mb-4">{!! $value['icon'] !!}</div>
                        <h3 class="font-bold text-white mb-2" style="font-size:1.0625rem;">{{ $value['title'] }}</h3>
                        <p style="color:rgba(255,255,255,0.65); font-size:0.875rem; line-height:1.6;">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════════════════════
    CONTACT & INFO — Two-column, office card + CTA cards
═══════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="container-main">
        {{-- Section header --}}
        <div class="text-center mb-16"
             style="transition: all 0.7s ease;">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div style="width:32px; height:3px; background:#19592F; border-radius:2px;"></div>
                <span class="text-sm font-semibold tracking-widest uppercase" style="color:#19592F;">Kết nối</span>
                <div style="width:32px; height:3px; background:#19592F; border-radius:2px;"></div>
            </div>
            <h2 class="section-title" style="font-size: clamp(1.75rem, 3vw, 2.75rem);">
                Chúng tôi luôn sẵn sàng <span style="color:#19592F;">lắng nghe</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- Left: Office info card --}}
            <div
                 style="transition: all 0.7s ease; border-radius: 1.25rem; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.1);">

                {{-- Map/visual header --}}
                <div class="relative" style="height: 240px; background: linear-gradient(135deg, #0a2e15 0%, #12472A 40%, #19592F 70%, #7FBF3F 100%);">
                    {{-- Grid pattern --}}
                    <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 28px 28px;"></div>

                    {{-- Location pin icon --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
                        <div class="mb-4" style="width:56px; height:56px; border-radius:50%; background:rgba(25,89,47,0.9); display:flex; align-items:center; justify-content:center; box-shadow: 0 0 0 12px rgba(25,89,47,0.2);">
                            <svg class="w-7 h-7" fill="white" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl">Văn phòng DAT PHAT</h3>
                        <p class="mt-1 opacity-80 text-sm">Việt Nam</p>
                    </div>

                    {{-- Decorative circles --}}
                    <div style="position:absolute; top:-30px; right:-30px; width:140px; height:140px; border-radius:50%; background:rgba(255,255,255,0.05);"></div>
                    <div style="position:absolute; bottom:-40px; left:-20px; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,0.04);"></div>
                </div>

                {{-- Info body --}}
                <div class="p-8" style="background:white;">
                    <h4 class="font-bold mb-6" style="font-size:1.25rem; color:#333;">Thông tin liên hệ</h4>
                    <div class="space-y-4">
                        {{-- Address --}}
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 mt-0.5" style="width:40px; height:40px; border-radius:10px; background:rgba(25,89,47,0.1); display:flex; align-items:center; justify-content:center;">
                                <svg class="w-5 h-5" fill="none" stroke="#19592F" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wider mb-1" style="color:#999;">Địa chỉ</div>
                                <div style="color:#444; font-size:0.9375rem;">{{ $companyInfo['address'] ?? 'Số 21, Đường 8, KCN VSIP Bắc Ninh II' }}</div>
                            </div>
                        </div>
                        {{-- Phone --}}
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 mt-0.5" style="width:40px; height:40px; border-radius:10px; background:rgba(25,89,47,0.1); display:flex; align-items:center; justify-content:center;">
                                <svg class="w-5 h-5" fill="none" stroke="#19592F" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wider mb-1" style="color:#999;">Điện thoại</div>
                                <a href="tel:{{ $companyInfo['phone'] ?? '02223699930' }}" class="transition-colors"
                                   style="color:#19592F; font-size:0.9375rem; font-weight:600;">
                                    {{ $companyInfo['phone'] ?? '0222-369-9930' }}
                                </a>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 mt-0.5" style="width:40px; height:40px; border-radius:10px; background:rgba(25,89,47,0.1); display:flex; align-items:center; justify-content:center;">
                                <svg class="w-5 h-5" fill="none" stroke="#19592F" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs font-semibold uppercase tracking-wider mb-1" style="color:#999;">Email</div>
                                <a href="mailto:{{ $companyInfo['email'] ?? 'info@phatfood.vn' }}"
                                   class="transition-colors" style="color:#19592F; font-size:0.9375rem; font-weight:600;">
                                    {{ $companyInfo['email'] ?? 'info@phatfood.vn' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact.index') }}" class="btn-primary mt-8" style="width:100%; justify-content:center;">
                        Xem chi tiết văn phòng
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Right: CTA cards stacked --}}
            <div class="flex flex-col gap-6"
                 style="transition: all 0.7s ease 0.2s;">

                {{-- Tuyển dụng --}}
                <a href="{{ route('careers.index') }}"
                   class="group block flex-1"
                   x-data="{}"
                   style="border-radius: 1.25rem; overflow: hidden; border: 2px solid #f0ede8; transition: all 0.35s ease; background: white; box-shadow: 0 2px 12px rgba(0,0,0,0.06);"
                   @mouseenter="$el.style.borderColor='#19592F'; $el.style.boxShadow='0 12px 36px rgba(25,89,47,0.15)'; $el.style.transform='translateY(-4px)'"
                   @mouseleave="$el.style.borderColor='#f0ede8'; $el.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'; $el.style.transform=''">
                    <div class="p-8 flex items-start gap-6 h-full">
                        {{-- Icon --}}
                        <div class="flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                             style="width:72px; height:72px; border-radius:1rem; background:linear-gradient(135deg, rgba(25,89,47,0.12), rgba(25,89,47,0.06)); display:flex; align-items:center; justify-content:center;">
                            <svg class="w-9 h-9" fill="none" stroke="#19592F" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#19592F;">Cơ hội nghề nghiệp</div>
                            <h3 class="font-bold mb-2 transition-colors duration-300 group-hover:text-orange-600" style="font-size:1.375rem; color:#222;">
                                Tuyển dụng
                            </h3>
                            <p class="leading-relaxed" style="color:#666; font-size:0.9375rem;">
                                DAT PHAT Việt Nam mở ra cơ hội thực hiện những ước mơ đến với mọi người. Hãy cùng chúng tôi tạo nên những bữa ăn ý nghĩa.
                            </p>
                        </div>
                        <div class="flex-shrink-0 self-center transition-all duration-300 group-hover:translate-x-1" style="color:#19592F;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Hỏi trực tuyến --}}
                <a href="{{ route('contact.inquiry') }}"
                   class="group block flex-1"
                   x-data="{}"
                   style="border-radius: 1.25rem; overflow: hidden; border: 2px solid #f0ede8; transition: all 0.35s ease; background: white; box-shadow: 0 2px 12px rgba(0,0,0,0.06);"
                   @mouseenter="$el.style.borderColor='#19592F'; $el.style.boxShadow='0 12px 36px rgba(25,89,47,0.15)'; $el.style.transform='translateY(-4px)'"
                   @mouseleave="$el.style.borderColor='#f0ede8'; $el.style.boxShadow='0 2px 12px rgba(0,0,0,0.06)'; $el.style.transform=''">
                    <div class="p-8 flex items-start gap-6 h-full">
                        {{-- Icon --}}
                        <div class="flex-shrink-0 transition-transform duration-300 group-hover:scale-110"
                             style="width:72px; height:72px; border-radius:1rem; background:linear-gradient(135deg, rgba(25,89,47,0.12), rgba(25,89,47,0.06)); display:flex; align-items:center; justify-content:center;">
                            <svg class="w-9 h-9" fill="none" stroke="#19592F" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-semibold uppercase tracking-wider mb-2" style="color:#19592F;">Tư vấn miễn phí</div>
                            <h3 class="font-bold mb-2 transition-colors duration-300 group-hover:text-green-800" style="font-size:1.375rem; color:#222;">
                                Hỏi trực tuyến
                            </h3>
                            <p class="leading-relaxed" style="color:#666; font-size:0.9375rem;">
                                Chúng tôi sẽ nỗ lực hết sức để có những giải đáp nhanh chóng và hài lòng nhất cho mọi thắc mắc của bạn.
                            </p>
                        </div>
                        <div class="flex-shrink-0 self-center transition-all duration-300 group-hover:translate-x-1" style="color:#19592F;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Quick info banner --}}
                <div style="border-radius: 1.25rem; overflow:hidden; background: linear-gradient(135deg, #19592F, #7FBF3F); padding: 1.75rem 2rem; box-shadow: 0 4px 20px rgba(25,89,47,0.25);">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        </div>
                        <div class="text-white">
                            <div class="font-bold text-lg mb-0.5">Vệ sinh an toàn thực phẩm</div>
                            <div style="color:rgba(255,255,255,0.8); font-size:0.9rem;">Chứng nhận ISO & HACCP — Cam kết chất lượng tuyệt đối</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
    GLOBAL STYLES (scoped to this page via inline)
═══════════════════════════════════════════════════════════ --}}
@push('styles')
<style>
    /* Ken Burns zoom on hero images */
    @keyframes heroZoom {
        from { transform: scale(1.0); }
        to   { transform: scale(1.08); }
    }

    /* Slide-up + fade entrance for hero text */
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Line-clamp for service descriptions */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-overflow: hidden;
        overflow: hidden;
    }

    /* Hero slide display fix — x-show overrides the :style binding */
    [x-cloak] { display: none !important; }
</style>
@endpush

@endsection
