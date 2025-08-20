@props(['value' => 0, 'size' => 60])

<svg width="{{ $size }}" height="{{ $size }}" class="transform -rotate-90">
    <circle cx="{{ $size/2 }}" cy="{{ $size/2 }}" r="{{ ($size-10)/2 }}"
        stroke="gray" stroke-width="6" fill="transparent"/>
    <circle cx="{{ $size/2 }}" cy="{{ $size/2 }}" r="{{ ($size-10)/2 }}"
        stroke="indigo" stroke-width="6" fill="transparent"
        stroke-dasharray="200"
        stroke-dashoffset="{{ 200 - (200 * $value / 100) }}"
        class="transition-all duration-500"/>
    <text x="50%" y="50%" text-anchor="middle" dy=".3em" class="text-sm fill-indigo-700">
        {{ $value }}%
    </text>
</svg>
