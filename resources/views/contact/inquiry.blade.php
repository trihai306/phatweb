@extends('layouts.app')

@section('breadcrumb')
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('contact.index') }}" class="hover:text-primary transition-colors">Liên hệ</a>
    </li>
    <li class="flex items-center space-x-2">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-primary font-medium">Hỏi trực tuyến</span>
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
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Hỏi trực tuyến</h1>
            <p class="text-white/80 text-base max-w-xl mx-auto">
                Chúng tôi sẽ nỗ lực hết sức để có những giải đáp nhanh chóng và hài lòng nhất trong vòng 24 giờ.
            </p>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container-main max-w-3xl">

            {{-- Alpine Form Component --}}
            <div x-data="{
                    submitted: false,
                    loading: false,
                    errors: {},
                    form: {
                        name: '{{ old('name', '') }}',
                        email: '{{ old('email', '') }}',
                        phone: '{{ old('phone', '') }}',
                        company: '{{ old('company', '') }}',
                        subject: '{{ old('subject', request('subject', '')) }}',
                        message: '{{ old('message', '') }}'
                    }
                 }">

                {{-- Success State --}}
                @if(session('success'))
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         class="bg-green-50 border border-green-200 rounded-2xl p-10 text-center mb-8">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-green-800 mb-3">Gửi thành công!</h2>
                        <p class="text-green-700 text-base mb-2">{{ session('success') }}</p>
                        <p class="text-green-600 text-sm">Chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc.</p>
                        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('home') }}" class="btn-primary text-sm">
                                Về trang chủ
                            </a>
                            <button @click="show = false" class="btn-outline text-sm">
                                Gửi câu hỏi khác
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10">
                    <div class="flex items-start gap-4 mb-8">
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-dark">Gửi câu hỏi của bạn</h2>
                            <p class="text-gray-500 text-sm mt-1">Điền đầy đủ thông tin bên dưới, chúng tôi sẽ liên hệ lại sớm nhất.</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Row 1: Name + Phone --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Họ và tên <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       required
                                       value="{{ old('name') }}"
                                       x-model="form.name"
                                       placeholder="Nguyễn Văn A"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('name') border-red-400 bg-red-50 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Số điện thoại
                                </label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       x-model="form.phone"
                                       placeholder="0901 234 567"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                            </div>
                        </div>

                        {{-- Row 2: Email + Company --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       required
                                       value="{{ old('email') }}"
                                       x-model="form.email"
                                       placeholder="email@company.com"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors @error('email') border-red-400 bg-red-50 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Công ty / Tổ chức
                                </label>
                                <input type="text"
                                       id="company"
                                       name="company"
                                       value="{{ old('company') }}"
                                       x-model="form.company"
                                       placeholder="Tên công ty của bạn"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors">
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                Chủ đề <span class="text-red-500">*</span>
                            </label>
                            <select id="subject"
                                    name="subject"
                                    required
                                    x-model="form.subject"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors bg-white @error('subject') border-red-400 bg-red-50 @enderror">
                                <option value="">-- Chọn chủ đề --</option>
                                <option value="dich-vu" {{ old('subject', request('subject')) === 'dich-vu' ? 'selected' : '' }}>Tư vấn dịch vụ</option>
                                <option value="bao-gia" {{ old('subject') === 'bao-gia' ? 'selected' : '' }}>Yêu cầu báo giá</option>
                                <option value="tuyen-dung" {{ str_contains(request('subject', ''), 'Ứng tuyển') ? 'selected' : '' }}>Tuyển dụng</option>
                                <option value="hop-tac" {{ old('subject') === 'hop-tac' ? 'selected' : '' }}>Hợp tác kinh doanh</option>
                                <option value="khieu-nai" {{ old('subject') === 'khieu-nai' ? 'selected' : '' }}>Khiếu nại / Phản hồi</option>
                                <option value="khac" {{ old('subject') === 'khac' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nội dung câu hỏi <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      required
                                      rows="6"
                                      x-model="form.message"
                                      placeholder="Nhập nội dung câu hỏi hoặc yêu cầu của bạn..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors resize-none @error('message') border-red-400 bg-red-50 @enderror"></textarea>
                            <div class="flex justify-between items-center mt-1.5">
                                @error('message')
                                    <p class="text-red-500 text-xs flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @else
                                    <span></span>
                                @enderror
                                <span class="text-xs text-gray-400" x-text="form.message.length + '/1000 ký tự'"></span>
                            </div>
                        </div>

                        {{-- Privacy note --}}
                        <div class="bg-accent rounded-xl p-4 text-sm text-gray-600 flex items-start gap-3">
                            <svg class="w-5 h-5 text-secondary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p>Thông tin của bạn được bảo mật hoàn toàn và chỉ dùng để liên lạc hỗ trợ. Chúng tôi cam kết không chia sẻ với bên thứ ba.</p>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                :disabled="loading"
                                @click="loading = true"
                                class="btn-primary w-full justify-center text-base py-4 disabled:opacity-70 disabled:cursor-not-allowed">
                            <svg x-show="loading"
                                 x-cloak
                                 class="animate-spin w-5 h-5 mr-2"
                                 fill="none"
                                 viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            <span x-text="loading ? 'Đang gửi câu hỏi...' : 'Gửi câu hỏi'">Gửi câu hỏi</span>
                        </button>
                    </form>
                </div>

                {{-- Contact Quick Links --}}
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="tel:{{ $companyInfo['phone'] ?? '02223699930' }}"
                       class="bg-white rounded-2xl shadow-sm p-5 flex items-center gap-3 hover:shadow-md transition-shadow group">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Gọi điện</p>
                            <p class="text-sm font-semibold text-dark group-hover:text-primary transition-colors">{{ $companyInfo['phone'] ?? '0222-369-9930' }}</p>
                        </div>
                    </a>

                    <a href="mailto:{{ $companyInfo['email'] ?? 'info@phatfood.vn' }}"
                       class="bg-white rounded-2xl shadow-sm p-5 flex items-center gap-3 hover:shadow-md transition-shadow group">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Email</p>
                            <p class="text-sm font-semibold text-dark group-hover:text-primary transition-colors truncate">{{ $companyInfo['email'] ?? 'info@phatfood.vn' }}</p>
                        </div>
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="bg-white rounded-2xl shadow-sm p-5 flex items-center gap-3 hover:shadow-md transition-shadow group">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Địa chỉ</p>
                            <p class="text-sm font-semibold text-dark group-hover:text-primary transition-colors">Xem bản đồ</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
