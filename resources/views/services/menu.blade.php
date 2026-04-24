@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">Dịch vụ</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Thực đơn</span>
    </li>
@endsection

@section('content')
    {{-- Hero --}}
    <section class="relative bg-gradient-to-r from-secondary to-secondary/80 py-16 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="container-main relative text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">Thực đơn</h1>
            <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto">
                Khám phá thực đơn phong phú, đa dạng được chế biến từ nguyên liệu tươi ngon và an toàn của DAT PHAT
            </p>
        </div>
    </section>

    {{-- Filter tabs --}}
    <section class="bg-white border-b sticky top-20 z-30" x-data="{ activeTab: 'all' }">
        <div class="container-main">
            <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-none">
                <button @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-primary text-white' : 'text-gray-600 hover:text-primary hover:bg-primary/5'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap flex-shrink-0">
                    Tất cả
                </button>
                @if(isset($menuCategories))
                    @foreach($menuCategories as $cat)
                        <button @click="activeTab = '{{ $cat->slug ?? $loop->index }}'"
                                :class="activeTab === '{{ $cat->slug ?? $loop->index }}' ? 'bg-primary text-white' : 'text-gray-600 hover:text-primary hover:bg-primary/5'"
                                class="px-5 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap flex-shrink-0">
                            {{ $cat->name ?? $cat->title }}
                        </button>
                    @endforeach
                @else
                    @foreach(['Bữa sáng', 'Bữa trưa', 'Bữa tối', 'Tiệc', 'Đặc biệt'] as $tab)
                        <button @click="activeTab = '{{ Str::slug($tab) }}'"
                                :class="activeTab === '{{ Str::slug($tab) }}' ? 'bg-primary text-white' : 'text-gray-600 hover:text-primary hover:bg-primary/5'"
                                class="px-5 py-2 rounded-full text-sm font-medium transition-all whitespace-nowrap flex-shrink-0">
                            {{ $tab }}
                        </button>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- Menu Grid --}}
    <section class="py-12 bg-gray-50">
        <div class="container-main">
            @forelse($menus as $menu)
                @if($loop->first)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-5">
                @endif

                <article class="card group cursor-pointer"
                         x-data="{ open: false }">
                    <div class="relative overflow-hidden" @click="open = true">
                        @if(isset($menu->image) && $menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}"
                                 alt="{{ $menu->title }}"
                                 class="w-full aspect-square object-cover group-hover:scale-110 transition-transform duration-500"
                                 loading="lazy">
                        @else
                            <div class="w-full aspect-square bg-accent flex items-center justify-center text-4xl">🍱</div>
                        @endif
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors"></div>
                        <div class="absolute inset-0 flex items-end p-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-xs text-white font-medium bg-primary px-2 py-1 rounded-full">Xem chi tiết</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-xs font-semibold text-dark line-clamp-2 leading-tight">{{ $menu->title }}</h3>
                        @if(isset($menu->category) && $menu->category)
                            <span class="text-xs text-primary mt-1 block">{{ $menu->category }}</span>
                        @endif
                    </div>

                    {{-- Detail modal --}}
                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4"
                         @click.self="open = false"
                         @keydown.escape.window="open = false">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-sm w-full overflow-hidden">
                            @if(isset($menu->image) && $menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}"
                                     alt="{{ $menu->title }}"
                                     class="w-full h-48 object-cover"
                                     loading="lazy">
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-dark text-lg mb-2">{{ $menu->title }}</h3>
                                @if(isset($menu->description) && $menu->description)
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $menu->description }}</p>
                                @endif
                                @if(isset($menu->ingredients) && $menu->ingredients)
                                    <p class="text-xs text-gray-400 mt-3"><strong>Nguyên liệu:</strong> {{ $menu->ingredients }}</p>
                                @endif
                                <button @click="open = false"
                                        class="mt-4 w-full py-2.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium text-gray-700 transition-colors">
                                    Đóng
                                </button>
                            </div>
                        </div>
                    </div>
                </article>

                @if($loop->last)
                    </div>
                @endif
            @empty
                <div class="bg-white rounded-2xl shadow-sm p-16 text-center">
                    <div class="text-6xl mb-4">🍽️</div>
                    <p class="text-gray-400 text-base">Thực đơn đang được cập nhật...</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if(isset($menus) && method_exists($menus, 'links'))
                <div class="mt-10">
                    {{ $menus->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
