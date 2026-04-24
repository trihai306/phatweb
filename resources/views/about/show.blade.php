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
        <span class="text-primary font-medium">{{ $page->title ?? 'Chi tiết' }}</span>
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
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">{{ $page->title ?? 'Về chúng tôi' }}</h1>
            @if(isset($page->description) && $page->description)
                <p class="text-white/80 text-base max-w-2xl">{{ $page->description }}</p>
            @endif
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
                        :currentSlug="$page->slug ?? ''"
                    />
                </div>

                {{-- Page Content --}}
                <article class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        @if(isset($page->image) && $page->image)
                            <div class="mb-8 rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $page->image) }}"
                                     alt="{{ $page->title }}"
                                     class="w-full h-64 md:h-80 object-cover"
                                     loading="lazy">
                            </div>
                        @endif

                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-dark prose-headings:font-bold
                                    prose-p:text-gray-600 prose-p:leading-relaxed
                                    prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-dark prose-strong:font-semibold
                                    prose-ul:text-gray-600 prose-ol:text-gray-600
                                    prose-li:leading-relaxed
                                    prose-img:rounded-xl prose-img:shadow-sm">
                            {!! $page->content ?? '<p>Nội dung đang được cập nhật...</p>' !!}
                        </div>
                    </div>

                    {{-- Navigation between pages --}}
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('about.index') }}"
                           class="flex items-center gap-2 text-sm text-gray-500 hover:text-primary transition-colors font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Về chúng tôi
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn-primary text-sm">
                            Liên hệ ngay
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
