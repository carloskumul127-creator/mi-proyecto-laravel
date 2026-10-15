@props([
    'name',
    'label',
    'description',
    'checked' => false,
    'disabled' => false,
])

<label for="{{ $name }}" @class([
    'flex items-center justify-between gap-4 py-4',
    'cursor-pointer' => ! $disabled,
    'opacity-60' => $disabled,
])>
    <span>
        <span class="block text-label-md text-on-surface">{{ $label }}</span>
        <span class="mt-1 block text-body-sm text-on-surface-variant">{{ $description }}</span>
    </span>
    <span class="relative flex shrink-0 items-center">
        <input type="hidden" name="{{ $name }}" value="0" @disabled($disabled)>
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="checkbox"
            value="1"
            @checked($checked)
            @disabled($disabled)
            class="peer sr-only"
        >
        <span class="relative h-6 w-11 rounded-full bg-outline-variant transition peer-checked:bg-primary-container peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-primary after:absolute after:left-0.5 after:top-0.5 after:h-5 after:w-5 after:rounded-full after:bg-surface-container-lowest after:shadow-sm after:transition peer-checked:after:translate-x-5" aria-hidden="true"></span>
    </span>
</label>