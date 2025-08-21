<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SisuKai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-900">
<nav class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
        //<a href="{{ route('landing') }}" class="font-black text-xl text-emerald-600">SisuKai//</a>
		<a href="{{ url('/') }}" class="font-black text-xl text-emerald-600">SisuKai</a>
        <div class="space-x-3">
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('faq') }}">FAQ</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="px-3 py-1 rounded bg-emerald-600 text-white">Dashboard</a>
                <form class="inline" method="POST" action="{{ route('logout') }}">@csrf<button class="px-3">Logout</button></form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-emerald-600 text-white">Sign up</a>
            @endauth
        </div>
    </div>
</nav>
<main class="min-h-[70vh]">
    @yield('content')
</main>
<footer class="bg-white border-t">
    <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-gray-600 flex justify-between">
        <span>© {{ date('Y') }} SisuKai</span>
        <div class="space-x-4">
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('faq') }}">FAQ</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
    </div>
</footer>
</body>
</html>
