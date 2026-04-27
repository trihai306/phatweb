@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Liên hệ</span>
    </li>
@endsection

@section('content')

    {{-- ===== HERO BANNER ===== --}}
    <section class="relative bg-gradient-to-br from-secondary via-secondary/90 to-dark py-24 md:py-28 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.07]">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="contact-grid" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#contact-grid)"/>
            </svg>
        </div>
        <div class="absolute -top-20 -right-16 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>

        <div class="container-main relative text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest">
                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
                Hỗ trợ 24/7
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-5 leading-tight">
                Liên lạc với <span class="text-primary-light">chúng tôi</span>
            </h1>
            <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
                Chúng tôi luôn sẵn sàng hỗ trợ bạn. Hãy liên hệ ngay để được tư vấn miễn phí và giải đáp mọi thắc mắc.
            </p>
        </div>
    </section>

    {{-- ===== CONTACT CONTENT ===== --}}
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="container-main">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

                {{-- ── Left: Contact Info Cards ── --}}
                <div class="lg:col-span-2 space-y-4">
                    <div class="mb-6">
                        <p class="text-xs font-bold text-primary uppercase tracking-widest mb-2">Thông tin</p>
                        <h2 class="text-2xl font-bold text-dark">Liên hệ với chúng tôi</h2>
                        <div class="flex items-center gap-2 mt-3">
                            <div class="w-10 h-1 bg-primary rounded-full"></div>
                            <div class="w-3 h-1 bg-primary/30 rounded-full"></div>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 hover:border-primary/20 p-6 flex gap-4 transition-all duration-200">
                        <div class="w-12 h-12 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1.5">Địa chỉ</p>
                            <p class="text-sm text-dark font-semibold leading-relaxed">
                                {{ $companyInfo['address'] ?? 'Số 21, Đường 8, KCN VSIP Bắc Ninh II, Phường Phù Chẩn, Thị xã Từ Sơn, Bắc Ninh' }}
                            </p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 hover:border-primary/20 p-6 flex gap-4 transition-all duration-200">
                        <div class="w-12 h-12 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1.5">Điện thoại</p>
                            <a href="tel:{{ preg_replace('/\D/', '', $companyInfo['phone'] ?? '02223699930') }}"
                               class="text-sm text-dark font-bold hover:text-primary transition-colors">
                                {{ $companyInfo['phone'] ?? '0222-369-9930' }}
                            </a>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 hover:border-primary/20 p-6 flex gap-4 transition-all duration-200">
                        <div class="w-12 h-12 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1.5">Email</p>
                            <a href="mailto:{{ $companyInfo['email'] ?? 'info@phatfood.vn' }}"
                               class="text-sm text-dark font-bold hover:text-primary transition-colors break-all">
                                {{ $companyInfo['email'] ?? 'info@phatfood.vn' }}
                            </a>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 hover:border-primary/20 p-6 flex gap-4 transition-all duration-200">
                        <div class="w-12 h-12 bg-primary/10 group-hover:bg-primary/20 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1.5">Giờ làm việc</p>
                            <p class="text-sm text-dark font-bold">{{ App\Models\CompanyInfo::getValue('business_hours_weekday', 'Thứ 2 - Thứ 6: 8:00 - 17:30') }}</p>
                            <p class="text-sm text-gray-500 mt-0.5">{{ App\Models\CompanyInfo::getValue('business_hours_saturday', 'Thứ 7: 8:00 - 12:00') }}</p>
                        </div>
                    </div>

                    {{-- CTA inquiry --}}
                    <a href="{{ route('contact.inquiry') }}"
                       class="flex items-center justify-center gap-2 bg-secondary text-white font-bold px-6 py-4 rounded-2xl hover:bg-secondary/90 transition-colors shadow-lg shadow-secondary/20 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Hỏi trực tuyến ngay
                    </a>
                </div>

                {{-- ── Right: Map + Quick Form ── --}}
                <div class="lg:col-span-3 space-y-6">

                    {{-- Google Maps --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="relative h-72">
                            @if(isset($companyInfo['map_embed']) && $companyInfo['map_embed'])
                                {!! $companyInfo['map_embed'] !!}
                            @else
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3722.3658944993484!2d106.04!3d21.12!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjHCsDA3JzEyLjAiTiAxMDbCsDAyJzI0LjAiRQ!5e0!3m2!1svi!2svn!4v1000000000000!5m2!1svi!2svn"
                                    class="w-full h-full border-0"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Bản đồ DAT PHAT">
                                </iframe>
                            @endif
                        </div>
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
                            <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-600 font-medium leading-snug">
                                {{ $companyInfo['address'] ?? 'Số 21, Đường 8, KCN VSIP Bắc Ninh II, Bắc Ninh' }}
                            </p>
                        </div>
                    </div>

                    {{-- Quick Contact Form --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
                         x-data="{
                             submitted: false,
                             loading: false,
                             form: { name: '', email: '', phone: '', message: '' },
                             async submit(e) {
                                 this.loading = true;
                                 e.target.submit();
                             }
                         }">

                        {{-- Form header bar --}}
                        <div class="h-1.5 bg-gradient-to-r from-primary via-primary/70 to-secondary"></div>
                        <div class="p-7 md:p-8">
                            <div class="flex items-center gap-3 mb-7">
                                <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-dark leading-none">Gửi liên hệ nhanh</h2>
                                    <p class="text-gray-400 text-xs mt-0.5">Phản hồi trong vòng 24 giờ</p>
                                </div>
                            </div>

                            {{-- Success message --}}
                            @if(session('success'))
                                <div class="bg-green-50 border border-green-200 rounded-xl p-5 text-center mb-6"
                                     x-data="{ show: false }"
                                     x-init="setTimeout(() => show = true, 100)"
                                     x-show="show"
                                     x-transition:enter="transition ease-out duration-400"
                                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                     x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-green-800 mb-1">Đã gửi thành công!</h3>
                                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}"
                                  method="POST"
                                  class="space-y-5"
                                  @submit="submit($event)">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    {{-- Name --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="name">
                                            Họ và tên <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="name" name="name" required
                                               x-model="form.name"
                                               value="{{ old('name') }}"
                                               placeholder="Nguyễn Văn A"
                                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm
                                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                                      placeholder-gray-300 transition-colors bg-gray-50 focus:bg-white">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="phone">
                                            Số điện thoại
                                        </label>
                                        <input type="tel" id="phone" name="phone"
                                               x-model="form.phone"
                                               value="{{ old('phone') }}"
                                               placeholder="0901 234 567"
                                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm
                                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                                      placeholder-gray-300 transition-colors bg-gray-50 focus:bg-white">
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="email">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required
                                           x-model="form.email"
                                           value="{{ old('email') }}"
                                           placeholder="email@example.com"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm
                                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                                  placeholder-gray-300 transition-colors bg-gray-50 focus:bg-white">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Message --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="message">
                                        Nội dung <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="message" name="message" required rows="4"
                                              x-model="form.message"
                                              placeholder="Nhập nội dung cần liên hệ, yêu cầu báo giá..."
                                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm
                                                     focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                                     placeholder-gray-300 transition-colors bg-gray-50 focus:bg-white resize-none">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Submit --}}
                                <button type="submit"
                                        :disabled="loading"
                                        class="w-full flex items-center justify-center gap-2 bg-primary text-white font-bold py-3.5 px-6 rounded-xl
                                               hover:bg-primary/90 transition-colors shadow-md shadow-primary/25
                                               disabled:opacity-60 disabled:cursor-not-allowed">
                                    <svg x-show="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                    </svg>
                                    <svg x-show="!loading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <span x-text="loading ? 'Đang gửi...' : 'Gửi liên hệ'"></span>
                                </button>

                                <p class="text-center text-xs text-gray-400 mt-2">
                                    Bằng cách gửi form, bạn đồng ý với
                                    <a href="#" class="text-primary hover:underline">chính sách bảo mật</a> của chúng tôi.
                                </p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
