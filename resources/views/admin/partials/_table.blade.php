@props(['headers' => [], 'rows' => []])

<div class="bg-white rounded-2xl shadow overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead class="bg-gray-50 text-left">
      <tr>
        @foreach($headers as $h)
          <th class="px-4 py-3 font-semibold text-gray-700">{{ $h }}</th>
        @endforeach
        <th class="px-4 py-3"></th>
      </tr>
    </thead>
    <tbody class="divide-y">
      {{ $slot }}
    </tbody>
  </table>
</div>
