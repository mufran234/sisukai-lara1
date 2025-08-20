@props(['rank' => 1, 'name' => 'User', 'score' => 0])

<div class="flex items-center justify-between bg-white shadow-sm p-3 rounded-xl">
    <span class="font-bold text-indigo-600">#{{ $rank }}</span>
    <span class="flex-1 ml-3">{{ $name }}</span>
    <span class="font-semibold text-gray-700">{{ $score }} pts</span>
</div>
