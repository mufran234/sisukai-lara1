@props(['class' => ''])

<div {{ $attributes->merge(['class' => "bg-white rounded-2xl shadow-md p-6 {$class}"]) }}>
    {{ $slot }}
</div>