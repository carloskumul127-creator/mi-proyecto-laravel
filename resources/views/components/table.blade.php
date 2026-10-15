@props(['headers'])

<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full min-w-[920px] text-left']) }}>
        <thead class="bg-surface-container-low text-label-sm text-on-surface-variant">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="whitespace-nowrap px-4 py-3 font-medium first:pl-5 last:pr-5">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant text-body-sm">
            {{ $slot }}
        </tbody>
    </table>
</div>