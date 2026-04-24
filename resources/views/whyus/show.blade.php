@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('whyus.index') }}" class="hover:text-primary transition-colors">Tại sao là chúng tôi</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">{{ $strength->title ?? 'Chi tiết' }}</span>
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
        <div class="container-main relative">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">{{ $strength->title ?? 'Thế mạnh' }}</h1>
            @if(isset($strength->description) && $strength->description)
                <p class="text-white/80 text-base max-w-2xl">{{ $strength->description }}</p>
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
                        title="Thế mạnh của chúng tôi"
                        :items="$strengths"
                        :currentSlug="$strength->slug ?? ''"
                    />
                </div>

                {{-- Strength Detail --}}
                <article class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        {{-- Hero image --}}
                        @if(isset($strength->image) && $strength->image)
                            <div class="mb-8 rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $strength->image) }}"
                                     alt="{{ $strength->title }}"
                                     class="w-full h-64 md:h-80 object-cover"
                                     loading="lazy">
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-dark prose-headings:font-bold
                                    prose-p:text-gray-600 prose-p:leading-relaxed
                                    prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-dark
                                    prose-ul:text-gray-600 prose-ol:text-gray-600
                                    prose-li:leading-relaxed
                                    prose-img:rounded-xl">
                            {!! $strength->content ?? '<p>Nội dung đang được cập nhật...</p>' !!}
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="mt-8 bg-accent rounded-2xl p-8 text-center">
                        <h3 class="text-xl font-bold text-dark mb-3">Bạn có muốn trải nghiệm dịch vụ của chúng tôi?</h3>
                        <p class="text-gray-600 text-sm mb-6">
                            Liên hệ với DAT PHAT ngay hôm nay để được tư vấn miễn phí về giải pháp phù hợp nhất cho doanh nghiệp của bạn.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('contact.inquiry') }}" class="btn-primary">
                                Hỏi trực tuyến ngay
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn-outline">
                                Xem thông tin liên hệ
                            </a>
                        </div>
                    </div>

                    {{-- Back link --}}
                    <div class="mt-6">
                        <a href="{{ route('whyus.index') }}"
                           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary transition-colors font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Quay lại Tại sao là chúng tôi
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
