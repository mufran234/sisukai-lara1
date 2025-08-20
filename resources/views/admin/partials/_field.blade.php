@props(['label','name','type'=>'text','value'=>null,'hint'=>null])
<label class="block mb-4">
  <span class="text-sm font-medium">{{ $label }}</span>
  @if($type === 'textarea')
    <textarea name="{{ $name }}" class="mt-1 w-full border rounded-lg p-2">{{ old($name,$value) }}</textarea>
  @elseif($type === 'checkbox')
    <div class="mt-2">
      <input type="hidden" name="{{ $name }}" value="0">
      <input type="checkbox" name="{{ $name }}" value="1" @checked(old($name,$value))>
    </div>
  @else
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name,$value) }}" class="mt-1 w-full border rounded-lg p-2">
  @endif
  @error($name)<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
  @if($hint)<p class="text-xs text-gray-500 mt-1">{{ $hint }}</p>@endif
</label>
