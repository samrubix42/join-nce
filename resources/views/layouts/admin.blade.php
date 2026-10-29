<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Admin' }} &middot; {{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="h-full text-gray-900 antialiased">
        <div x-data="{ sidebarOpen: false }" class="min-h-full">
            <div
                x-show="sidebarOpen"
                x-cloak
                x-transition.opacity
                @click="sidebarOpen = false"
                class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden"
            ></div>

            <aside
                x-cloak
                class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col bg-slate-900 transition-transform duration-200 ease-in-out lg:translate-x-0"
                :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            >
                <div class="flex h-16 items-center gap-3 border-b border-white/10 px-5">
                    <a href="{{ route('admin.joinings.index') }}" class="flex items-center gap-3">
                        <img src="{{ asset('nce-logo.png') }}" alt="NCE" class="h-9 w-9 rounded-lg bg-white object-contain p-1">
                        <span>
                            <span class="block text-sm font-semibold text-white">NCE Admin</span>
                            <span class="block text-xs text-slate-400">Membership desk</span>
                        </span>
                    </a>
                </div>

                <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
                    <p class="px-3 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">Management</p>

                    <a
                        href="{{ route('admin.joinings.index') }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.joinings.*') ? 'bg-white/10 text-white' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}"
                    >
                        <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Join entries
                    </a>

                    <a
                        href="{{ route('join') }}"
                        target="_blank"
                        rel="noopener"
                        class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition-colors hover:bg-white/5 hover:text-white"
                    >
                        <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        View public site
                    </a>
                </nav>

                <div class="border-t border-white/10 p-4">
                    <div class="flex items-center gap-3">
                        <span class="flex size-9 shrink-0 items-center justify-center rounded-full bg-white/10 text-sm font-semibold text-white">
                            {{ str(auth()->user()->name)->substr(0, 1)->upper() }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="lg:pl-64">
                <header class="sticky top-0 z-30 border-b border-gray-200 bg-white/90 backdrop-blur">
                    <div class="flex h-16 items-center gap-4 px-4 sm:px-6 lg:px-8">
                        <button
                            type="button"
                            @click="sidebarOpen = true"
                            class="-ml-1 rounded-lg p-2 text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900 lg:hidden"
                            aria-label="Open sidebar"
                        >
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>

                        <div class="min-w-0 flex-1">
                            <h1 class="truncate text-base font-semibold text-gray-900">{{ $title ?? 'Admin' }}</h1>
                            <p class="truncate text-xs text-gray-500">Manage NCE membership requests</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="hidden text-right sm:block">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>

                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
                                >
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    <span class="hidden sm:inline">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <main class="px-4 py-6 sm:px-6 lg:px-8">
                    @if (session('status'))
                        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                            <svg class="size-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
