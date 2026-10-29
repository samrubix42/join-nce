<div class="space-y-5">
    <div>
        <a href="{{ route('admin.joinings.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 transition-colors hover:text-gray-900">
            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            Back to join entries
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-4">
                <span class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#147cb5]/10 text-lg font-semibold text-[#147cb5]">
                    {{ str($joining->name ?: $joining->email)->substr(0, 1)->upper() }}
                </span>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $joining->name ?: 'Unnamed member' }}</h2>
                    <p class="mt-0.5 text-sm text-gray-500">{{ $joining->business_name_city ?: 'Business not provided' }} &middot; {{ $joining->business_category ?: 'Category not provided' }}</p>
                    <div class="mt-2.5 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                        <x-admin.status-badge :status="$joining->status" />
                        <span>Created {{ $joining->created_at->format('d M Y, h:i A') }}</span>
                    </div>
                </div>
            </div>

            @if ($joining->email)
                <div class="flex items-center gap-2 sm:shrink-0">
                    <a
                        href="mailto:{{ $joining->email }}"
                        class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
                    >
                        Email member
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if ($feedback)
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ $feedback }}
        </div>
    @endif

    <div class="grid gap-5 lg:grid-cols-3">
        <div class="space-y-5 lg:col-span-2">
            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h3 class="text-sm font-semibold text-gray-900">Contact details</h3>
                <dl class="mt-4 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Email</dt>
                        <dd class="mt-1 break-all text-sm text-gray-900">{{ $joining->email ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Mobile number</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->personal_number }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Alternate contact</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->official_contact_number ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">City</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->address_city ?: 'Not provided' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h3 class="text-sm font-semibold text-gray-900">Navodaya details</h3>
                <dl class="mt-4 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">JNV</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->jnv_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Batch</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->batch ?: 'Not provided' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h3 class="text-sm font-semibold text-gray-900">Business details</h3>
                <dl class="mt-4 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Business name &amp; city</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->business_name_city ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Category</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->business_category ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Website</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if ($joining->website)
                                <a href="{{ $joining->website }}" target="_blank" rel="noopener noreferrer" class="text-[#147cb5] hover:underline">{{ $joining->website }}</a>
                            @else
                                <span class="text-gray-400">Not provided</span>
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Products &amp; services</dt>
                        <dd class="mt-1 whitespace-pre-line text-sm leading-relaxed text-gray-900">{{ $joining->products_services ?: 'Not provided' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">
                <h3 class="text-sm font-semibold text-gray-900">Payment proof</h3>
                <dl class="mt-4 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">UPI transaction ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->upi_transaction_id ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-gray-500">Last updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $joining->updated_at->format('d M Y, h:i A') }}</dd>
                    </div>
                </dl>

                @if ($hasScreenshot)
                    <div class="mt-5">
                        <a
                            href="{{ route('admin.joinings.screenshot', $joining) }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
                        >
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            View payment screenshot
                        </a>

                        <div class="mt-4 overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                            <img src="{{ route('admin.joinings.screenshot', $joining) }}" alt="Payment screenshot" class="mx-auto max-h-96 w-auto object-contain">
                        </div>
                    </div>
                @else
                    <p class="mt-5 rounded-lg bg-gray-50 px-4 py-3 text-sm text-gray-500">No payment screenshot has been uploaded.</p>
                @endif
            </section>
        </div>

        <div class="space-y-5">
            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-gray-900">Update status</h3>
                <p class="mt-1 text-sm text-gray-500">Review the payment proof, then move this entry through the workflow.</p>

                <form wire:submit.prevent="updateStatus" class="mt-4 space-y-3">
                    <select
                        wire:model="status"
                        class="block w-full rounded-lg border-gray-200 bg-gray-50 py-2.5 pl-3 pr-9 text-sm focus:border-[#147cb5] focus:bg-white focus:ring-2 focus:ring-[#147cb5]/20"
                    >
                        @foreach (\App\Enums\JoiningStatus::cases() as $case)
                            <option value="{{ $case->value }}">{{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('status') <p class="text-sm text-rose-600">{{ $message }}</p> @enderror

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="updateStatus"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-[#147cb5] px-3 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-[#0f5a8a] disabled:cursor-not-allowed disabled:opacity-60"
                    >
                        Save status
                    </button>
                </form>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-gray-900">Community</h3>
                <dl class="mt-4 space-y-3">
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-sm text-gray-600">Willing to volunteer</dt>
                        <dd class="text-sm font-medium {{ $joining->willing_volunteer ? 'text-emerald-600' : 'text-gray-400' }}">{{ $joining->willing_volunteer ? 'Yes' : 'No' }}</dd>
                    </div>
                    <div class="flex items-center justify-between gap-3">
                        <dt class="text-sm text-gray-600">Willing to sponsor</dt>
                        <dd class="text-sm font-medium {{ $joining->willing_sponsor ? 'text-emerald-600' : 'text-gray-400' }}">{{ $joining->willing_sponsor ? 'Yes' : 'No' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-xl border border-rose-200 bg-rose-50/50 p-5">
                <h3 class="text-sm font-semibold text-rose-800">Danger zone</h3>
                <p class="mt-1 text-sm text-rose-700/80">Deleting this entry also removes the uploaded payment proof.</p>
                <button
                    type="button"
                    wire:click="delete"
                    wire:confirm="Delete this entry permanently? This cannot be undone."
                    class="mt-4 inline-flex w-full items-center justify-center rounded-lg border border-rose-300 bg-white px-3 py-2.5 text-sm font-semibold text-rose-700 transition-colors hover:bg-rose-100"
                >
                    Delete entry
                </button>
            </section>
        </div>
    </div>
</div>
