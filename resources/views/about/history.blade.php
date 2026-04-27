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
        <span class="text-primary font-medium">Lịch sử phát triển</span>
    </li>
@endsection

@section('content')

    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-28 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="hist-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#hist-grid)"/>
            </svg>
        </div>
        <div class="absolute -top-16 -right-16 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>

        <div class="container-main relative">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                Hành trình phát triển
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Lịch sử <span class="text-primary-light">phát triển</span>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl leading-relaxed">
                Từng bước vững chắc trên hành trình mang đến những bữa ăn chất lượng.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container-main">
            <div class="flex flex-col lg:flex-row gap-10">

                <div class="lg:w-64 xl:w-72 flex-shrink-0">
                    <x-sidebar
                        title="Về chúng tôi"
                        :items="$sidebarPages"
                        currentSlug="lich-su"
                    />
                </div>

                <article class="flex-1 min-w-0">
                    <div class="mb-10">
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Các cột mốc</p>
                        <h2 class="text-2xl md:text-3xl font-bold text-dark">Những dấu ấn quan trọng</h2>
                        <div class="flex items-center gap-3 mt-3">
                            <div class="w-12 h-1 bg-primary rounded-full"></div>
                            <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute left-6 md:left-1/2 top-0 bottom-0 w-0.5
                                    bg-gradient-to-b from-primary via-primary/40 to-transparent
                                    md:-translate-x-px z-0"></div>

                        @forelse($milestones as $index => $milestone)
                            @php $isLeft = $index % 2 === 0; @endphp

                            <div class="relative flex items-start mb-12 md:mb-16 z-10"
                                 style="animation: fadeUp 0.6s ease-out {{ $index * 0.15 }}s both;">

                                {{-- Mobile: dot on left line --}}
                                <div class="md:hidden absolute left-6 -translate-x-1/2 top-2">
                                    <div class="w-3 h-3 rounded-full bg-primary ring-4 ring-primary/20"></div>
                                </div>

                                {{-- Mobile layout --}}
                                <div class="md:hidden pl-14 w-full">
                                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                        @if($milestone->image && file_exists(storage_path('app/public/' . $milestone->image)))
                                            <img src="{{ asset('storage/' . $milestone->image) }}" alt="{{ $milestone->title }}" class="w-full h-44 object-cover" loading="lazy">
                                        @endif
                                        <div class="p-5">
                                            <div class="inline-block bg-primary text-white text-xs font-black px-3 py-1.5 rounded-lg mb-3">
                                                {{ $milestone->year }}
                                            </div>
                                            <h3 class="text-base font-bold text-dark mb-2">{{ $milestone->title }}</h3>
                                            <p class="text-gray-500 text-sm leading-relaxed">{{ $milestone->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Desktop layout: alternating --}}
                                <div class="hidden md:flex items-start w-full {{ $isLeft ? 'flex-row' : 'flex-row-reverse' }}">
                                    <div class="w-5/12 {{ $isLeft ? 'pr-12 text-right' : 'pl-12' }}">
                                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100 group text-left">
                                            @if($milestone->image && file_exists(storage_path('app/public/' . $milestone->image)))
                                                <img src="{{ asset('storage/' . $milestone->image) }}" alt="{{ $milestone->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                            @endif
                                            <div class="p-6">
                                                <h3 class="text-lg font-bold text-dark mb-2 group-hover:text-primary transition-colors">{{ $milestone->title }}</h3>
                                                <p class="text-gray-500 text-sm leading-relaxed">{{ $milestone->description }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-2/12 flex flex-col items-center justify-start pt-2 z-10">
                                        <div class="w-14 h-14 rounded-full bg-white border-4 border-primary shadow-lg flex items-center justify-center ring-4 ring-primary/10">
                                            <span class="text-primary font-black text-xs">{{ $milestone->year }}</span>
                                        </div>
                                    </div>

                                    <div class="w-5/12"></div>
                                </div>
                            </div>

                        @empty
                            <div class="bg-white rounded-2xl shadow-sm p-16 text-center border border-gray-100">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-dark mb-2">Chưa có dữ liệu</h3>
                                <p class="text-gray-400 text-sm">Lịch sử đang được cập nhật...</p>
                            </div>
                        @endforelse
                    </div>
                </article>
            </div>
        </div>
    </section>

@endsection
