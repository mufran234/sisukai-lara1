<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-600">SisuKai</a>
        <div class="space-x-4">
            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
            <a href="{{ url('/certifications') }}" class="text-gray-700 hover:text-indigo-600">Certifications</a>
            <a href="{{ url('/results') }}" class="text-gray-700 hover:text-indigo-600">Results</a>
            <a href="{{ url('/profile') }}" class="text-gray-700 hover:text-indigo-600">Profile</a>
        </div>
    </div>
</nav>
