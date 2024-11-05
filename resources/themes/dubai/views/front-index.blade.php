<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    {{-- Try to load 'head' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.head', 'ext.head'])

    {{-- Additional theme-specific CSS --}}
    @yield('addon-css')
</head>

<body class="lazyload pr-0">
    <?php $current_page = ''; ?>
    
    {{-- Try to load 'header-sports-vertical' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.header-sports-vertical', 'ext.header-sports-vertical'])

    {{-- Main content of the page --}}
    @yield('content')

    {{-- Try to load 'script' and 'footer' from the active theme; fallback to default --}}
    @includeFirst(['theme::ext.script', 'ext.script'])
    @includeFirst(['theme::ext.footer', 'ext.footer'])

    {{-- Additional custom JavaScript --}}
    @yield('custom-js')
</body>
</html>
