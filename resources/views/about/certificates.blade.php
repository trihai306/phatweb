@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('about.index') }}" class="hover:text-primary transition-colors">Về chúng tôi</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Chứng nhận &amp; Giải thưởng</span>
    </li>
@endsection

@section('content')
    {{-- Page Hero --}}
    <section class="relative bg-gradient-to-r from-secondary to-secondary/80 py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="container-main relative">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Chứng nhận &amp; Giải thưởng</h1>
            <p class="text-white/80 text-base max-w-2xl">
                Những chứng nhận về chất lượng và an toàn thực phẩm mà PhatFood đã đạt được
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- Sidebar --}}
                <div class="lg:w-64 xl:w-72 flex-shrink-0">
                    <x-sidebar
                        title="Về chúng tôi"
                        :items="$sidebarPages"
                        currentSlug="chung-nhan"
                    />
                </div>

                {{-- Certificates Grid --}}
                <article class="flex-1 min-w-0">
                    @forelse($certificates as $certificate)
                        @if($loop->first)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @endif

                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group"
                             x-data="{ lightbox: false }">
                            {{-- Certificate Image --}}
                            <div class="relative aspect-[3/4] bg-gray-50 overflow-hidden cursor-pointer"
                                 @click="lightbox = true">
                                @if(isset($certificate->image) && $certificate->image)
                                    <img src="{{ asset('storage/' . $certificate->image) }}"
                                         alt="{{ $certificate->title }}"
                                         class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500"
                                         loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-accent">
                                        <svg class="w-20 h-20 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                    </div>
                                @endif
                                {{-- Zoom overlay --}}
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Certificate Info --}}
                            <div class="p-5">
                                <h3 class="font-bold text-dark text-sm leading-tight mb-1">{{ $certificate->title }}</h3>
                                @if(isset($certificate->issuer) && $certificate->issuer)
                                    <p class="text-xs text-gray-500">{{ $certificate->issuer }}</p>
                                @endif
                                @if(isset($certificate->year) && $certificate->year)
                                    <span class="inline-block mt-2 text-xs text-primary font-semibold bg-primary/10 px-2 py-0.5 rounded-full">{{ $certificate->year }}</span>
                                @endif
                            </div>

                            {{-- Lightbox --}}
                            @if(isset($certificate->image) && $certificate->image)
                                <div x-show="lightbox" x-cloak
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4"
                                     @click.self="lightbox = false"
                                     @keydown.escape.window="lightbox = false">
                                    <div class="relative max-w-2xl w-full">
                                        <img src="{{ asset('storage/' . $certificate->image) }}"
                                             alt="{{ $certificate->title }}"
                                             class="w-full h-auto rounded-xl shadow-2xl max-h-[90vh] object-contain">
                                        <button @click="lightbox = false"
                                                class="absolute -top-4 -right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-gray-100 transition-colors">
                                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            <p class="text-gray-400 text-sm">Thông tin chứng nhận đang được cập nhật...</p>
                        </div>
                    @endforelse
                </article>
            </div>
        </div>
    </section>
@endsection
