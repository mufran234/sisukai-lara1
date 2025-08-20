@props(['minutes' => 60])

<div x-data="{ time: {{ $minutes * 60 }} }" 
     x-init="setInterval(() => { if(time>0) time-- }, 1000)"
     class="bg-red-100 text-red-700 px-4 py-2 rounded-lg text-center font-semibold">
    <span x-text="Math.floor(time/60) + ':' + String(time%60).padStart(2,'0')"></span>
</div>
