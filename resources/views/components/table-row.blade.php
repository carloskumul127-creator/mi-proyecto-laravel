@props(['manifest'])

<tr class="transition hover:bg-surface-container-low/60">
    <td class="px-4 py-3.5 pl-5">
        <a href="#{{ $manifest['folio'] }}" class="text-label-md text-primary-container hover:underline">{{ $manifest['folio'] }}</a>
        <span class="mt-1 block whitespace-nowrap text-body-sm text-on-surface-variant">{{ $manifest['empresa'] }}</span>
    </td>
    <td class="px-4 py-3.5">
        <span class="block whitespace-nowrap text-label-md text-on-surface">{{ $manifest['residuo'] }}</span>
        <span class="mt-1 block text-body-sm text-on-surface-variant">{{ $manifest['clasificacion'] }}</span>
    </td>
    <td class="px-4 py-3.5 text-on-surface-variant">{{ $manifest['generador'] }}</td>
    <td class="px-4 py-3.5 text-on-surface-variant">{{ $manifest['destino'] }}</td>
    <td class="px-4 py-3.5">
        <x-status-badge :status="$manifest['estado']" :tone="$manifest['tone']" />
    </td>
    <td class="whitespace-nowrap px-4 py-3.5 text-on-surface-variant">{{ $manifest['actualizado'] }}</td>
    <td class="px-4 py-3.5 pr-5">
        <button type="button" class="rounded-md p-1.5 text-on-surface-variant hover:bg-surface-container" aria-label="Más opciones para {{ $manifest['folio'] }}">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
        </button>
    </td>
</tr>