@props(['name' => 'Learner'])

<div class="flex items-center space-x-3">
    <div class="w-10 h-10 bg-indigo-200 rounded-full flex items-center justify-center font-bold text-indigo-800">
        {{ strtoupper(substr($name,0,1)) }}
    </div>
    <span class="font-medium text-gray-700">{{ $name }}</span>
</div>
