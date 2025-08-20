@props(['color' => 'indigo'])

<span {{ $attributes->merge(['class' => "px-2 py-1 text-xs rounded-full bg-{$color}-100 text-{$color}-700"]) }}>
    {{ $slot }}
</span>
