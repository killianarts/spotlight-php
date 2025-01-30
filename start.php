<?php

session_start();

function page_head(string $title='Set a title for this page') { ?>
    <!DOCTYPE html>
    <html class="light" lang=en>
        <head>
            <title><?= strtoupper($title) ?> | KILLIAN.arts (SPOTLIGHT-PHP DEMO)</title>
            <meta charset="utf-8">
            <meta name=viewport content="width=device-width, initial-scale=1">
            <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
            <script src="https://unpkg.com/hyperscript.org@0.9.13"></script>
            <style type="text/tailwindcss">
             @custom-variant dark (&:where(.dark, .dark *));
             @theme {
                 --font-mono-thin: "Berkeley Mono Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-mono-regular: "Berkeley Mono UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-mono-medium: "Berkeley Mono Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-mono-black: "Berkeley Mono ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-uc-thin: "Berkeley Mono Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-uc: "Berkeley Mono UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-uc-medium: "Berkeley Mono Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-uc-black: "Berkeley Mono ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-black: "Berkeley Mono ExtraBold", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-thin: "Berkeley Mono Thin", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx: "Berkeley Mono", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-tx-medium: "Berkeley Mono Medium", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             }
            </style>
        </head>
        <body class="flex h-full bg-stone-50 dark:bg-black">
<? };

function page_foot() { ?>
        </body></html>
<? };

function header_navigation($logo_visible = true) { ?>
    <header class="pointer-events-none relative z-50 flex flex-none flex-col"
            style="height:var(--header-height);margin-bottom:var(--header-mb)">
        <? if (!$logo_visible) { ?>
            <div class="order-last mt-[calc(--spacing(16)-(--spacing(3)))]"></div>
            <div class="sm:px-8 top-0 order-last -mb-3 pt-3" style="position: var(--header-position);">
            <div class="mx-auto w-full max-w-7xl lg:px-8">
                <div class="relative px-4 sm:px-8 lg:px-12">
                    <div class="mx-auto max-w-2xl lg:max-w-5xl">
                        <div class="top-(--avatar-top,--spacing(3)) w-full" style="position: var(--header-inner-position);">
                            <div class="relative">
                                <div class="absolute top-3 left-0 origin-left transition-opacity h-10 w-10 rounded-full bg-white/90 p-0.5 ring-1 shadow-lg shadow-stone-800/5 ring-stone-900/5 backdrop-blur-sm dark:bg-stone-800/90 dark:ring-white/10" style="opacity: var(--avatar-border-opacity, 0); transform: var(--avatar-border-transform);"></div>
                                <a aria-label="Home" class="block h-16 w-16 origin-left pointer-events-auto" href="/" style="transform: var(--avatar-image-transform);">
                                    <img alt="" fetchpriority="high" width="512" height="512" decoding="async" data-nimg="1" class="rounded-full bg-stone-100 object-cover dark:bg-stone-800 h-16 w-16" sizes="4rem" srcset="<?= './assets/social-media-headshot.png'?>" src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Favatar.51a13c67.jpg&amp;w=3840&amp;q=75" style="color: transparent;"></a></div></div></div></div></div></div>
        <? }; ?>
        <div class="top-0 z-10 h-16 pt-6" style="position:var(--header-position)">
            <div class="sm:px-8 top-(--header-top,--spacing(6)) w-full" style="position:var(--header-inner-position)">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="relative flex gap-4">
                                <div class="flex flex-1">
                                    <? if ($logo_visible) { ?>
                                        <div class="h-10 w-10 rounded-full bg-white/90 p-0.5 ring-1 shadow-lg shadow-zinc-800/5 ring-zinc-900/5 backdrop-blur-sm dark:bg-zinc-800/90 dark:ring-white/10">
                                            <a aria-label="Home" class="pointer-events-auto" href="/">
                                                <img alt="" fetchpriority="high" width="512" height="512" decoding="async" data-nimg="1" class="rounded-full bg-zinc-100 object-cover dark:bg-zinc-800 h-9 w-9" sizes="2.25rem" src="./assets/social-media-headshot.png" style="color: transparent;">
                                            </a>
                                        </div>
                                    <? }; ?>
                                </div>
                                <div class="flex flex-1 justify-end md:justify-center">
                                    <div class="pointer-events-auto md:hidden">
                                        <button _="on click toggle .hidden on .transition-discrete wait a tick then toggle .opacity-0 on .transition-discrete then send scaleMe to #nav-container"
                                                class="group flex items-center rounded-full bg-white/90 px-4 py-2 text-sm font-medium text-stone-800 ring-1 shadow-lg shadow-stone-800/5 ring-stone-900/5 backdrop-blur-sm dark:bg-stone-800/90 dark:text-stone-200 dark:ring-white/10 dark:hover:ring-white/20"
                                                type="button" aria-expanded="false" data-headlessui-state="" id="headlessui-popover-button-:Rbmiqja:">Menu
                                            <svg viewBox="0 0 8 6" aria-hidden="true" class="ml-3 h-auto w-2 stroke-stone-500 group-hover:stroke-stone-700 dark:group-hover:stroke-stone-400">
                                                <path d="M1.75 1.75 4 4.25l2.25-2.5" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </button>
                                        <div _="on click
                                                toggle .opacity-0 on .transition-discrete wait a tick
                                                then toggle .hidden on .transition-discrete
                                                then send scaleMe to #nav-container"
                                             class="hidden fixed transition-discrete transition-all inset-0 z-50 bg-zinc-800/40 backdrop-blur-xs duration-150
                                                opacity-0 dark:bg-black/80"></div>
                                        <div id="nav-container"
                                             _="on scaleMe toggle .scale-95 on me"
                                             class="hidden fixed transition-discrete transition-all inset-x-4 top-8 z-50 origin-top rounded-3xl bg-white p-8 ring-1 ring-zinc-900/5 duration-150
                                                 opacity-0 scale-95 dark:bg-zinc-900 dark:ring-zinc-800">
                                            <div class="flex flex-row-reverse items-center justify-between">
                                                <button _="on click
                                                           toggle .opacity-0 on .transition-discrete wait a tick
                                                           then toggle .hidden on .transition-discrete
                                                           then send scaleMe to #nav-container" aria-label="Close menu" class="-m-1 p-1" type="button" data-headlessui-state="open active" data-open="" data-active="">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 text-zinc-500 dark:text-zinc-400">
                                                        <path d="m17.25 6.75-10.5 10.5M6.75 6.75l10.5 10.5" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <h2 class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Navigation</h2>
                                            </div>
                                            <nav class="mt-6">
                                                <ul class="-my-2 divide-y divide-zinc-100 text-base text-zinc-800 dark:divide-zinc-100/5 dark:text-zinc-300">
                                                    <li><a class="block py-2" data-headlessui-state="open active" data-open="" data-active="" href="/about">
                                                        About
                                                    </a></li>
                                                    <li><a class="block py-2" data-headlessui-state="open active" data-open="" data-active="" href="/articles">
                                                        Articles
                                                    </a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div></div>
                                    <nav class="pointer-events-auto hidden md:block">
                                        <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-stone-800 ring-1 shadow-lg shadow-stone-800/5 ring-stone-900/5 backdrop-blur-sm dark:bg-stone-800/90 dark:text-stone-200 dark:ring-white/10">
                                            <li><a class="font-tx-uc uppercase underline decoration-double underline-offset-2 relative block px-3 py-2 transition hover:text-amber-500 dark:hover:text-amber-400" href="/about">
                                                About
                                            </a></li>
                                            <li><a class="font-tx-uc uppercase underline decoration-double underline-offset-2 relative block px-3 py-2 transition hover:text-amber-500 dark:hover:text-amber-400" href="/articles">
                                                Articles
                                            </a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="flex justify-end md:flex-1"><div class="pointer-events-auto">
                                    <button _="on mousedown toggle .dark .light on <html/>"
                                            type="button" aria-label="Switch to dark theme"
                                            class="group rounded-full bg-white/90 px-3 py-2 ring-1 shadow-lg shadow-stone-800/5 ring-stone-900/5 backdrop-blur-sm transition dark:bg-stone-800/90 dark:ring-white/10 dark:hover:ring-white/20">
                                        <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-6 w-6 fill-stone-100 stroke-stone-500 transition group-hover:fill-stone-200 group-hover:stroke-stone-700 dark:hidden [@media(prefers-color-scheme:dark)]:fill-amber-50 [@media(prefers-color-scheme:dark)]:stroke-amber-500 [@media(prefers-color-scheme:dark)]:group-hover:fill-amber-50 [@media(prefers-color-scheme:dark)]:group-hover:stroke-amber-600">
                                            <path d="M8 12.25A4.25 4.25 0 0 1 12.25 8v0a4.25 4.25 0 0 1 4.25 4.25v0a4.25 4.25 0 0 1-4.25 4.25v0A4.25 4.25 0 0 1 8 12.25v0Z"></path>
                                            <path d="M12.25 3v1.5M21.5 12.25H20M18.791 18.791l-1.06-1.06M18.791 5.709l-1.06 1.06M12.25 20v1.5M4.5 12.25H3M6.77 6.77 5.709 5.709M6.77 17.73l-1.061 1.061" fill="none"></path>
                                        </svg>
                                        <svg viewBox="0 0 24 24" aria-hidden="true" class="hidden h-6 w-6 fill-stone-700 stroke-stone-500 transition dark:block [@media_not_(prefers-color-scheme:dark)]:fill-amber-400/10 [@media_not_(prefers-color-scheme:dark)]:stroke-amber-500 [@media(prefers-color-scheme:dark)]:group-hover:stroke-stone-400">
                                            <path d="M17.25 16.22a6.937 6.937 0 0 1-9.47-9.47 7.451 7.451 0 1 0 9.47 9.47ZM12.75 7C17 7 17 2.75 17 2.75S17 7 21.25 7C17 7 17 11.25 17 11.25S17 7 12.75 7Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<? }

function footer() { ?>
    <footer class="mt-32 flex-none">
        <div class="sm:px-8">
            <div class="mx-auto w-full max-w-7xl lg:px-8">
                <div class="border-t border-stone-100 pt-10 pb-16 dark:border-stone-700/40">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                                <div class="flex flex-wrap justify-center gap-x-6 gap-y-1 text-sm font-medium text-stone-800 dark:text-stone-200">
                                    <a class="font-tx-uc-thin uppercase underline underline-offset-2 decoration-double transition hover:text-amber-500 dark:hover:text-amber-400" href="/about">About</a>
                                    <a class="font-tx-uc-thin uppercase underline underline-offset-2 decoration-double transition hover:text-amber-500 dark:hover:text-amber-400" href="/articles">Articles</a>
                                </div>
                                <p class="font-tx-uc-thin uppercase text-sm text-stone-400 dark:text-stone-500">© <!-- -->2025<!-- --> Micah Killian. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<? };

function sluggify($url_string) {
    $alphanumeric_only = preg_replace('/[^a-zA-Z0-9\s]/', '', $url_string);
    $lowered = strtolower($alphanumeric_only);
    $spaces_to_dashes = str_replace(" ", "-", $lowered);
    return $spaces_to_dashes;
}
