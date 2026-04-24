@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('careers.index') }}" class="hover:text-primary transition-colors">Tuyển dụng</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">{{ $career->title ?? 'Chi tiết vị trí' }}</span>
    </li>
@endsection

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container-main">
            <div class="max-w-4xl mx-auto">

                {{-- Job Header Card --}}
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-6">
                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <h1 class="text-2xl md:text-3xl font-bold text-dark">{{ $career->title ?? 'Vị trí tuyển dụng' }}</h1>
                                @if(isset($career->is_urgent) && $career->is_urgent)
                                    <span class="text-xs bg-red-100 text-red-600 font-bold px-3 py-1 rounded-full">Gấp</span>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                @if(isset($career->department) && $career->department)
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span>{{ $career->department }}</span>
                                    </div>
                                @endif
                                @if(isset($career->location) && $career->location)
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $career->location }}</span>
                                    </div>
                                @endif
                                @if(isset($career->salary_range) && $career->salary_range)
                                    <div class="flex items-center gap-1.5 text-primary font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $career->salary_range }}</span>
                                    </div>
                                @endif
                                @if(isset($career->deadline) && $career->deadline)
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Hạn nộp hồ sơ: <strong>{{ \Carbon\Carbon::parse($career->deadline)->format('d/m/Y') }}</strong></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Job Details --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Description --}}
                        @if(isset($career->description) && $career->description)
                            <section class="bg-white rounded-2xl shadow-sm p-7">
                                <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-primary rounded-full"></span>
                                    Mô tả công việc
                                </h2>
                                <div class="prose prose-sm max-w-none prose-p:text-gray-600 prose-p:leading-relaxed prose-li:text-gray-600">
                                    {!! $career->description !!}
                                </div>
                            </section>
                        @endif

                        {{-- Requirements --}}
                        @if(isset($career->requirements) && $career->requirements)
                            <section class="bg-white rounded-2xl shadow-sm p-7">
                                <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-secondary rounded-full"></span>
                                    Yêu cầu
                                </h2>
                                <div class="prose prose-sm max-w-none prose-p:text-gray-600 prose-p:leading-relaxed prose-li:text-gray-600">
                                    {!! $career->requirements !!}
                                </div>
                            </section>
                        @endif

                        {{-- Benefits --}}
                        @if(isset($career->benefits) && $career->benefits)
                            <section class="bg-white rounded-2xl shadow-sm p-7">
                                <h2 class="text-lg font-bold text-dark mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-primary rounded-full"></span>
                                    Quyền lợi
                                </h2>
                                <div class="prose prose-sm max-w-none prose-p:text-gray-600 prose-p:leading-relaxed prose-li:text-gray-600">
                                    {!! $career->benefits !!}
                                </div>
                            </section>
                        @endif
                    </div>

                    {{-- Apply Sidebar --}}
                    <div class="space-y-5">
                        {{-- Apply CTA --}}
                        <div class="bg-primary rounded-2xl p-7 text-white text-center sticky top-28">
                            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg mb-2">Ứng tuyển ngay</h3>
                            <p class="text-white/80 text-sm mb-5">
                                Gửi hồ sơ của bạn để PhatFood xem xét và liên hệ sớm nhất.
                            </p>
                            <a href="{{ route('contact.inquiry') }}?subject={{ urlencode('Ứng tuyển: ' . ($career->title ?? '')) }}"
                               class="block w-full py-3 bg-white text-primary font-bold rounded-xl hover:bg-accent transition-colors text-sm">
                                Gửi hồ sơ ứng tuyển
                            </a>
                        </div>

                        {{-- Job Summary --}}
                        <div class="bg-white rounded-2xl shadow-sm p-6">
                            <h3 class="font-bold text-dark mb-4">Thông tin chi tiết</h3>
                            <ul class="space-y-3">
                                @if(isset($career->employment_type) && $career->employment_type)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Loại hợp đồng</span>
                                        <span class="font-medium text-dark">{{ $career->employment_type }}</span>
                                    </li>
                                @endif
                                @if(isset($career->experience) && $career->experience)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Kinh nghiệm</span>
                                        <span class="font-medium text-dark">{{ $career->experience }}</span>
                                    </li>
                                @endif
                                @if(isset($career->education) && $career->education)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Học vấn</span>
                                        <span class="font-medium text-dark">{{ $career->education }}</span>
                                    </li>
                                @endif
                                @if(isset($career->quantity) && $career->quantity)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Số lượng</span>
                                        <span class="font-medium text-dark">{{ $career->quantity }} người</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Back link --}}
                <div class="mt-8">
                    <a href="{{ route('careers.index') }}"
                       class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary transition-colors font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Quay lại danh sách tuyển dụng
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
