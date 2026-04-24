@props(['title' => '', 'items' => [], 'currentSlug' => ''])

<aside class="w-full" x-data="{ open: false }">
    {{-- Mobile toggle --}}
    <button
        @click="open = !open"
        class="lg:hidden w-full flex items-center justify-between bg-secondary text-white px-5 py-4 rounded-xl font-semibold text-sm mb-1 focus:outline-none focus:ring-2 focus:ring-primary/50"
        :aria-expanded="open"
    >
        <span class="flex items-center gap-2">
            <svg class="w-4 h-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
            {{ $title ?: 'Danh mục' }}
        </span>
        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Sidebar panel --}}
    <div class="hidden lg:block" :class="{ 'block': open, 'hidden': !open && !$el.closest('.lg\\:block') }"
         x-show="open || window.innerWidth >= 1024"
         x-cloak>
    </div>

    <div class="lg:block" :class="open ? 'block' : 'hidden lg:block'">
        {{-- Header --}}
        @if($title)
            <div class="bg-gradient-to-r from-secondary to-secondary/80 px-5 py-4 rounded-t-xl flex items-center gap-3">
                <div class="w-1.5 h-6 bg-primary rounded-full flex-shrink-0"></div>
                <h2 class="text-sm font-bold text-white uppercase tracking-wider">{{ $title }}</h2>
            </div>
        @endif

        {{-- Nav items --}}
        <nav class="{{ $title ? 'rounded-b-xl' : 'rounded-xl' }} bg-white shadow-md border border-gray-100 overflow-hidden">
            @forelse($items as $index => $item)
                @php
                    $slug      = $item->slug ?? '';
                    $isActive  = $currentSlug && $slug === $currentSlug;
                    $url       = $item->url ?? (isset($item->slug) ? $item->slug : '#');
                    $label     = $item->title ?? $item->name ?? '';
                @endphp
                <a href="{{ $url }}"
                   class="group relative flex items-center justify-between gap-3 px-5 py-3.5 text-sm border-b border-gray-100 last:border-b-0 transition-all duration-200
                          {{ $isActive
                              ? 'bg-primary/8 text-primary font-semibold'
                              : 'text-gray-600 font-medium hover:text-primary hover:bg-gray-50/80' }}">

                    {{-- Active / hover left border --}}
                    <span class="absolute inset-y-0 left-0 w-1 rounded-r-full transition-all duration-200
                                 {{ $isActive ? 'bg-primary' : 'bg-transparent group-hover:bg-primary/40' }}"></span>

                    <span class="pl-1 leading-snug">{{ $label }}</span>

                    <svg class="w-3.5 h-3.5 flex-shrink-0 transition-transform duration-200 group-hover:translate-x-0.5
                                {{ $isActive ? 'text-primary' : 'text-gray-300 group-hover:text-primary/60' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @empty
                <div class="px-5 py-4 text-sm text-gray-400 italic">Chưa có mục nào.</div>
            @endforelse
        </nav>
    </div>
</aside>
