@props(['type' => 'button'])

<button type="{{ $type }}"
        {{ $attributes->merge(['class' => 'px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition']) }}>
    {{ $slot }}
</button>
