<div class="relative">
    @if ('textarea' !== $type)
        @if ($formRef)
            <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-1"
                @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
        <input x-ref="input-{{ $name }}" id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}"
        @class(['w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2', 
        'pr-8' => $formRef,
        'ring-slate-300' => !$errors->has($name),
        'ring-red-500' => $errors->has($name)])
        {{ $attributes }}>
    @else
        <textarea id="{{ $name }}" name="{{ $name }}" rows="4"
            @class([
                'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2', 
                'pr-8' => $formRef,
                'ring-slate-300' => !$errors->has($name),
                'ring-red-500' => $errors->has($name)
            ])
        >{{ old($name, $value) }}</textarea>
    @endif
    @error($name)
        <x-error-message>
            {{ $message }}
        </x-error-message>
    @enderror
</div>