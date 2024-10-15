<div>
    @if ($allOption)
    <label for="{{ $name }}" class="mb-1 flex items-center">
        <input id="{{ $name }}" type="radio" name="{{ $name }}" value="" @checked(!request($name))/>
        <span class="ml-2">All</span>
    </label>
    @endif

    @foreach ($optionsWithLabels as $label => $option)
        <label for="{{ $option }}" class="mb-1 flex items-center">
            <input id="{{ $option }}" type="radio" name="{{ $name }}" value="{{ $option }}" @checked($option === ($value ?? request($name)))/>
            <span class="ml-2">{{ $label }}</span>
        </label>
    @endforeach

    @error($name)
        <x-error-message>
            {{ $message }}
        </x-error-message>
    @enderror
</div>