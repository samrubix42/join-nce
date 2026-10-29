<div>
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Membership requests</h2>
            <p class="mt-1 text-sm text-gray-500">{{ $total }} {{ Str::plural('entry', $total) }} in total</p>
        </div>
    </div>

    <div class="mt-5 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
        @foreach (\App\Enums\JoiningStatus::cases() as $case)
            <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <div class="flex items-center justify-between gap-2">
                    <p class="text-sm font-medium text-gray-500">{{ $case->label() }}</p>
                    <span class="size-2.5 rounded-full {{ $case->dotClasses() }}"></span>
                </div>
                <p class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">{{ $statusCounts[$case->value] ?? 0 }}</p>
            </div>
        @endforeach
    </div>

    @if ($feedback)
        <div class="mt-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ $feedback }}
        </div>
    @endif

    <div class="mt-5 rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
            <div class="relative flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search name, email, phone, business..."
                    class="block w-full rounded-lg border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm placeholder:text-gray-400 focus:border-[#147cb5] focus:bg-white focus:ring-2 focus:ring-[#147cb5]/20"
                >
            </div>

            <select
                wire:model.live="status"
                aria-label="Filter by status"
                class="rounded-lg border-gray-200 bg-gray-50 py-2.5 pl-3 pr-9 text-sm focus:border-[#147cb5] focus:bg-white focus:ring-2 focus:ring-[#147cb5]/20"
            >
                <option value="">All statuses</option>
                @foreach (\App\Enums\JoiningStatus::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                @endforeach
            </select>

            @if ($search !== '' || $status !== '')
                <button
                    type="button"
                    wire:click="clearFilters"
                    class="rounded-lg border border-gray-200 px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-50"
                >
                    Clear
                </button>
            @endif
        </div>
    </div>

    <div class="mt-5 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th scope="col" class="px-4 py-3 font-medium">Member</th>
                        <th scope="col" class="px-4 py-3 font-medium">Contact</th>
                        <th scope="col" class="px-4 py-3 font-medium">JNV / Batch</th>
                        <th scope="col" class="px-4 py-3 font-medium">Status</th>
                        <th scope="col" class="px-4 py-3 font-medium">Created</th>
                        <th scope="col" class="px-4 py-3 text-right font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($joinings as $joining)
                        <tr wire:key="joining-{{ $joining->id }}" class="transition-colors hover:bg-gray-50/70">
                            <td class="whitespace-nowrap px-4 py-3">
                                <p class="font-medium text-gray-900">{{ $joining->name ?: 'Unnamed member' }}</p>
                                <p class="text-xs text-gray-500">{{ $joining->business_name_city ?: 'Business not provided' }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-gray-900">{{ $joining->email ?: 'No email provided' }}</p>
                                <p class="text-xs text-gray-500">{{ $joining->personal_number }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="text-gray-900">{{ $joining->jnv_name }}</p>
                                <p class="text-xs text-gray-500">{{ $joining->batch ? 'Batch '.$joining->batch : 'Batch not provided' }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <select
                                    wire:change="updateStatus({{ $joining->id }}, $event.target.value)"
                                    aria-label="Update status for {{ $joining->name ?: 'this member' }}"
                                    class="rounded-lg border-gray-200 py-1.5 pl-2.5 pr-8 text-xs font-medium focus:border-[#147cb5] focus:ring-2 focus:ring-[#147cb5]/20"
                                >
                                    @foreach (\App\Enums\JoiningStatus::cases() as $case)
                                        <option value="{{ $case->value }}" @selected($joining->status === $case)>{{ $case->label() }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-gray-500">{{ $joining->created_at->format('d M Y') }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-right">
                                <a
                                    href="{{ route('admin.joinings.show', $joining) }}"
                                    class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-sm font-medium text-[#147cb5] transition-colors hover:bg-[#147cb5]/5"
                                >
                                    View
                                </a>
                                <button
                                    type="button"
                                    wire:click="delete({{ $joining->id }})"
                                    wire:confirm="Delete this entry permanently?"
                                    class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-sm font-medium text-rose-600 transition-colors hover:bg-rose-50"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-14 text-center">
                                <p class="text-sm font-medium text-gray-900">No join entries found</p>
                                <p class="mt-1 text-sm text-gray-500">Try changing the search or status filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($joinings->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $joinings->links() }}
            </div>
        @endif
    </div>
</div>
