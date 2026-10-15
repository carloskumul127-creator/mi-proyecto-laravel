@props(['src', 'name', 'disabled' => false])

<div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center">
    <img data-avatar-preview src="{{ $src }}" alt="Foto de perfil de {{ $name }}" class="h-20 w-20 rounded-full border-2 border-surface-container-low object-cover">
    <div>
        <label for="profile-avatar" @class(['inline-flex min-h-10 items-center justify-center rounded-md border border-outline-variant bg-surface-container-lowest px-4 py-2 text-label-md text-on-surface transition focus-within:ring-2 focus-within:ring-primary', 'cursor-pointer hover:bg-surface-container-low' => ! $disabled, 'cursor-not-allowed opacity-60' => $disabled])>
            Cambiar foto
        </label>
        <input id="profile-avatar" name="avatar" type="file" accept="image/*" class="sr-only" data-avatar-input aria-describedby="profile-avatar-help" @disabled($disabled)>
        <p id="profile-avatar-help" class="mt-2 text-body-sm text-on-surface-variant">PNG o JPG, máximo 5 MB.</p>
        @error('avatar')
            <p class="mt-1 text-label-sm text-error">{{ $message }}</p>
        @enderror
    </div>
</div>