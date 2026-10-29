@props(['status'])

@php
    $status = $status instanceof \App\Enums\JoiningStatus
        ? $status
        : \App\Enums\JoiningStatus::tryFrom((string) $status);
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset '.($status?->badgeClasses() ?? 'bg-gray-50 text-gray-600 ring-gray-500/20')]) }}>
    <span class="size-1.5 rounded-full {{ $status?->dotClasses() ?? 'bg-gray-400' }}"></span>
    {{ $status?->label() ?? 'Unknown' }}
</span>
