<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisuKai - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 text-center text-sm">
            © {{ date('Y') }} SisuKai. All rights reserved.
        </footer>
    </div>
</body>
</html>