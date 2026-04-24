<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root {
            --color-primary: {{ App\Models\Setting::get('primary_color', '#19592F') }};
            --color-primary-dark: {{ App\Models\Setting::get('primary_dark_color', '#12472A') }};
            --color-primary-light: {{ App\Models\Setting::get('primary_light_color', '#7FBF3F') }};
            --color-accent: {{ App\Models\Setting::get('accent_color', '#F0F7E6') }};
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-white">
    @include('layouts.partials.header')

    <main class="flex-1">
        @hasSection('breadcrumb')
            <div class="bg-gray-50 border-b">
                <div class="container-main py-3">
                    <nav aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-gray-500">
                            <li><a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a></li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @stack('scripts')
</body>
</html>
