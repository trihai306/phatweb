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
    {{-- Hero --}}
    <section class="relative h-64 md:h-80 overflow-hidden">
        @if(isset($service->image) && $service->image)
            <img src="{{ asset('storage/' . $service->image) }}"
                 alt="{{ $service->title }}"
                 class="w-full h-full object-cover"
                 loading="eager">
        @else
            <div class="w-full h-full bg-gradient-to-r from-secondary to-primary"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-dark/70 via-dark/40 to-transparent"></div>
        <div class="absolute inset-0 flex items-center">
            <div class="container-main">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-3">{{ $service->title ?? 'Dịch vụ' }}</h1>
                @if(isset($service->description) && $service->description)
                    <p class="text-white/90 text-base max-w-xl">{{ $service->description }}</p>
                @endif
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- Sidebar --}}
                <div class="lg:w-64 xl:w-72 flex-shrink-0">
                    <x-sidebar
                        title="Dịch vụ"
                        :items="$services"
                        :currentSlug="$service->slug ?? ''"
                    />

                    {{-- Contact CTA --}}
                    <div class="mt-6 bg-white rounded-xl shadow-sm p-5">
                        <h3 class="font-bold text-dark mb-2">Tư vấn dịch vụ</h3>
                        <p class="text-gray-500 text-sm mb-4">Liên hệ ngay để được tư vấn miễn phí về dịch vụ phù hợp.</p>
                        <a href="{{ route('contact.inquiry') }}" class="btn-primary w-full text-sm justify-center">
                            Hỏi trực tuyến
                        </a>
                    </div>
                </div>

                {{-- Service Detail Content --}}
                <article class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm p-8">
                        {{-- Main Image --}}
                        @if(isset($service->image) && $service->image)
                            <div class="mb-8 rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $service->image) }}"
                                     alt="{{ $service->title }}"
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
                            {!! $service->content ?? '<p>Nội dung dịch vụ đang được cập nhật...</p>' !!}
                        </div>
                    </div>

                    {{-- Related Services --}}
                    @if(isset($services) && $services->count() > 1)
                        <div class="mt-10">
                            <h3 class="text-xl font-bold text-dark mb-5">Dịch vụ khác</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                @foreach($services->where('slug', '!=', $service->slug ?? '')->take(4) as $related)
                                    <a href="{{ route('services.show', $related->slug) }}"
                                       class="card flex items-center gap-4 p-4 group">
                                        @if($related->image)
                                            <img src="{{ asset('storage/' . $related->image) }}"
                                                 alt="{{ $related->title }}"
                                                 class="w-20 h-16 object-cover rounded-lg flex-shrink-0"
                                                 loading="lazy">
                                        @else
                                            <div class="w-20 h-16 bg-accent rounded-lg flex-shrink-0 flex items-center justify-center text-2xl">🍽️</div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-dark group-hover:text-primary transition-colors text-sm">{{ $related->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $related->description ?? '' }}</p>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400 ml-auto flex-shrink-0 group-hover:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Back link --}}
                    <div class="mt-6">
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
