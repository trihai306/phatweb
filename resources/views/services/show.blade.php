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
        <span class="text-primary font-medium">{{ $service->title ?? 'Chi tiết dịch vụ' }}</span>
    </li>
@endsection

@section('content')
    {{-- Build sidebar items with proper route URLs --}}
    @php
        $sidebarServices = $services->map(function ($s) {
            $s->url = route('services.show', $s->slug);
            return $s;
        });
    @endphp

    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-8 xl:gap-10">

                {{-- ===== LEFT SIDEBAR ===== --}}
                <aside class="lg:w-64 xl:w-72 flex-shrink-0">
                    {{-- Service list --}}
                    <x-sidebar
                        title="Dịch vụ"
                        :items="$sidebarServices"
                        :currentSlug="$service->slug ?? ''"
                    />

                    {{-- Consultation CTA card --}}
                    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-5"
                         x-data x-intersect="$el.classList.add('animate-fade-up')">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-8 h-8 rounded-lg bg-accent flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </span>
                            <h3 class="font-bold text-dark text-sm">Tư vấn dịch vụ</h3>
                        </div>
                        <p class="text-gray-500 text-sm mb-4 leading-relaxed">
                            Liên hệ ngay để được tư vấn miễn phí về dịch vụ phù hợp với nhu cầu của bạn.
                        </p>
                        <a href="{{ route('contact.inquiry') }}"
                           class="btn-primary w-full text-sm py-2.5 px-4 rounded-lg justify-center">
                            Hỏi trực tuyến
                        </a>
                    </div>
                </aside>

                {{-- ===== RIGHT CONTENT AREA ===== --}}
                <article class="flex-1 min-w-0">

                    {{-- Service heading --}}
                    <div class="mb-6"
                         x-data x-intersect="$el.classList.add('animate-fade-up')">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-dark leading-tight mb-4">
                            {{ $service->title ?? 'Chi tiết dịch vụ' }}
                        </h1>
                        @if(isset($service->description) && $service->description)
                            <p class="text-gray-600 text-base md:text-lg leading-relaxed max-w-2xl">
                                {{ $service->description }}
                            </p>
                        @endif
                        {{-- Decorative divider --}}
                        <div class="mt-5 flex items-center gap-3">
                            <span class="h-1 w-12 rounded-full bg-primary inline-block"></span>
                            <span class="h-1 w-4 rounded-full bg-primary/30 inline-block"></span>
                        </div>
                    </div>

                    {{-- Main image --}}
                    @if(isset($service->image) && $service->image)
                        <div class="mb-8 rounded-2xl overflow-hidden shadow-sm border border-gray-100"
                             x-data x-intersect="$el.classList.add('animate-fade-in')">
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-full h-64 md:h-80 object-cover"
                                 loading="lazy">
                        </div>
                    @endif

                    {{-- Rich content --}}
                    @if(isset($service->content) && $service->content)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8 prose-content"
                             x-data x-intersect="$el.classList.add('animate-fade-up')">
                            {!! $service->content !!}
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
                            <p class="text-gray-500 italic">Nội dung dịch vụ đang được cập nhật...</p>
                        </div>
                    @endif

                    {{-- CTA Banner --}}
                    <div class="rounded-2xl overflow-hidden mb-10"
                         x-data x-intersect="$el.classList.add('animate-fade-up')">
                        <div class="bg-accent border border-primary/15 px-6 md:px-10 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                <p class="text-dark font-bold text-lg md:text-xl leading-snug mb-1">
                                    Được phục vụ quý khách là niềm vinh hạnh của chúng tôi.
                                </p>
                                <p class="text-gray-600 text-sm md:text-base">
                                    Xin hãy liên hệ trực tiếp.
                                </p>
                            </div>
                            <a href="{{ route('contact.inquiry') }}"
                               class="btn-primary flex-shrink-0 whitespace-nowrap">
                                Liên hệ
                            </a>
                        </div>
                    </div>

                    {{-- Related services --}}
                    @if(isset($services) && $services->count() > 1)
                        <div x-data x-intersect="$el.classList.add('animate-fade-up')">
                            <h3 class="text-xl font-bold text-dark mb-5">Dịch vụ khác</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach($services->where('slug', '!=', $service->slug ?? '')->take(3) as $related)
                                    <a href="{{ route('services.show', $related->slug) }}"
                                       class="card group flex flex-col">
                                        @if($related->image)
                                            <div class="overflow-hidden h-36 flex-shrink-0">
                                                <img src="{{ asset('storage/' . $related->image) }}"
                                                     alt="{{ $related->title }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                                     loading="lazy">
                                            </div>
                                        @else
                                            <div class="h-36 bg-accent flex-shrink-0 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M3 7h18M3 12h18M3 17h18"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="p-4 flex flex-col flex-1">
                                            <h4 class="font-semibold text-dark group-hover:text-primary transition-colors text-sm leading-snug mb-1">
                                                {{ $related->title }}
                                            </h4>
                                            @if($related->description)
                                                <p class="text-xs text-gray-500 line-clamp-2 flex-1">{{ $related->description }}</p>
                                            @endif
                                            <span class="mt-3 inline-flex items-center gap-1 text-xs text-primary font-medium">
                                                Xem thêm
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Back link --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('services.index') }}"
                           class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary transition-colors font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Quay lại Dịch vụ
                        </a>
                    </div>

                </article>
            </div>
        </div>
    </section>
@endsection
