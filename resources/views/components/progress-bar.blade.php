@props(['value' => 0])

<div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
    <div class="bg-indigo-600 h-3 rounded-full transition-all duration-300"
         style="width: {{ $value }}%">
    </div>
</div>