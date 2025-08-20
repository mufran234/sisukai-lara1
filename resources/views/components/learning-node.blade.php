@props(['title' => '', 'completed' => false])

<div class="flex flex-col items-center">
    <div class="w-12 h-12 flex items-center justify-center rounded-full 
        {{ $completed ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
        {{ $completed ? '✓' : '?' }}
    </div>
    <span class="text-xs mt-2 text-center">{{ $title }}</span>
</div>
