<header x-data="{ ...mobileMenu(), scrolled: false }"
        @scroll.window="scrolled = window.scrollY > 20"
        :class="scrolled ? 'bg-white/95 backdrop-blur-lg shadow-lg' : 'bg-white'"
        class="sticky top-0 z-50 transition-all duration-300">
    <div class="container-main">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex-shrink-0 group">
                <img src="{{ asset('images/logo-sm.png') }}" alt="{{ App\Models\CompanyInfo::getValue('brand_name', 'DAT PHAT') }}" class="h-12 w-auto">
            </a>

            <nav class="hidden lg:flex items-center gap-1">
                @php
                    $navItems = [
                        ['route' => 'about.index', 'label' => 'Về chúng tôi', 'match' => 've-chung-toi*'],
                        ['route' => 'services.index', 'label' => 'Dịch vụ', 'match' => 'dich-vu*'],
                        ['route' => 'whyus.index', 'label' => 'Tại sao là chúng tôi', 'match' => 'tai-sao-chung-toi*'],
                        ['route' => 'careers.index', 'label' => 'Tuyển dụng', 'match' => 'tuyen-dung*'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                              {{ request()->is($item['match'])
                                 ? 'text-primary bg-primary/5'
                                 : 'text-gray-600 hover:text-primary hover:bg-gray-50' }}">
                        {{ $item['label'] }}
                        @if(request()->is($item['match']))
                            <span class="absolute bottom-0 left-4 right-4 h-0.5 bg-primary rounded-full"></span>
                        @endif
                    </a>
                @endforeach
                <a href="{{ route('contact.index') }}" class="ml-4 btn-primary text-sm !py-2.5 !px-5">
                    Liên lạc
                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </nav>

            <button @click="toggle" class="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-xl text-gray-600 hover:bg-gray-100 transition-colors" aria-label="Menu">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden border-t border-gray-100 bg-white/95 backdrop-blur-lg">
        <nav class="container-main py-3 space-y-1">
            @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}" @click="close"
                   class="flex items-center justify-between px-4 py-3 rounded-xl font-medium transition-all
                          {{ request()->is($item['match']) ? 'bg-primary/5 text-primary' : 'text-gray-600 hover:bg-gray-50 hover:text-primary' }}">
                    {{ $item['label'] }}
                    <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @endforeach
            <a href="{{ route('contact.index') }}" @click="close" class="block mt-3 btn-primary text-center text-sm">Liên lạc với chúng tôi</a>
        </nav>
    </div>
</header>
