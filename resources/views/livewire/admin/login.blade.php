<div class="flex min-h-screen items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <img src="{{ asset('nce-logo.png') }}" alt="NCE" class="mx-auto h-14 w-14 rounded-2xl bg-white object-contain p-2 shadow-lg">
            <h1 class="mt-5 text-2xl font-semibold text-white">Admin sign in</h1>
            <p class="mt-1 text-sm text-slate-400">Manage NCE membership requests.</p>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-2xl ring-1 ring-black/5 sm:p-8">
            <form wire:submit.prevent="login" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <input
                        id="email"
                        type="email"
                        wire:model="email"
                        autocomplete="email"
                        autofocus
                        required
                        class="mt-1.5 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm transition-colors placeholder:text-gray-400 focus:border-[#147cb5] focus:bg-white focus:ring-2 focus:ring-[#147cb5]/20"
                        placeholder="admin@nce.test"
                    >
                    @error('email') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <input
                        id="password"
                        type="password"
                        wire:model="password"
                        autocomplete="current-password"
                        required
                        class="mt-1.5 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm transition-colors placeholder:text-gray-400 focus:border-[#147cb5] focus:bg-white focus:ring-2 focus:ring-[#147cb5]/20"
                        placeholder="••••••••"
                    >
                    @error('password') <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2.5 text-sm text-gray-600">
                    <input type="checkbox" wire:model="remember" class="size-4 rounded border-gray-300 text-[#147cb5] focus:ring-[#147cb5]">
                    Keep me signed in
                </label>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="login"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-[#147cb5] px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-[#0f5a8a] disabled:cursor-not-allowed disabled:opacity-60"
                >
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login">Signing in...</span>
                </button>
            </form>

            @if (app()->isLocal())
                <p class="mt-5 rounded-lg bg-slate-50 px-3 py-2 text-center text-xs text-slate-500">
                    Local demo credentials are pre-filled: <span class="font-medium text-slate-700">admin@nce.test</span> / <span class="font-medium text-slate-700">password</span>
                </p>
            @endif
        </div>

        <p class="mt-6 text-center text-sm">
            <a href="{{ route('join') }}" class="text-slate-400 transition-colors hover:text-white">&larr; Back to public site</a>
        </p>
    </div>
</div>
