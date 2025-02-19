<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

$posts = $db->query('SELECT * FROM post');

page_head("Home"); ?>
<div class="flex w-full">
    <div class="fixed inset-0 flex justify-center sm:px-8">
        <div class="flex w-full max-w-7xl lg:px-8">
            <div class="w-full bg-white ring-1 ring-stone-100 dark:bg-stone-900 dark:ring-stone-300/20"></div>
        </div>
    </div>
    <div class="relative flex w-full flex-col">
        <?= $logo_visible = false; header_navigation($logo_visible); ?>
        <div class="flex-none" style="height: var(--content-offset);"></div>
        <main class="flex-auto">
            <div class="sm:px-8 mt-9">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="max-w-2xl">
                                <h1 class="font-tx-uc-black uppercase text-4xl tracking-tight text-stone-800 sm:text-5xl dark:text-stone-100">
                                    Hypermedia Master
                                </h1>
                                <p class="font-tx mt-6 text-stone-600 dark:text-stone-400">
                                    I'm Micah Killian, a Hypermedia Master based in Saga, Japan.
                                    If you need someone to conjure some hypertext on a Common Lisp, Python, or PHP backend, and juggle fragments of hypertext via HTMX or _hyperscript, I'm your guy.
                                </p>
                                <div class="mt-6 flex gap-6">
                                    <a class="group -m-1 p-1" aria-label="Follow on X" href="https://x.com/killian_arts">
                                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-stone-500 transition group-hover:fill-stone-600 dark:fill-stone-400 dark:group-hover:fill-stone-300">
                                            <path d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.6438L11.4257 12.9742V12.9738Z"></path>
                                        </svg>
                                    </a>
                                    <a class="group -m-1 p-1" aria-label="Follow on GitHub" href="https://github.com/killianarts">
                                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-stone-500 transition group-hover:fill-stone-600 dark:fill-stone-400 dark:group-hover:fill-stone-300">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.475 2 2 6.588 2 12.253c0 4.537 2.862 8.369 6.838 9.727.5.09.687-.218.687-.487 0-.243-.013-1.05-.013-1.91C7 20.059 6.35 18.957 6.15 18.38c-.113-.295-.6-1.205-1.025-1.448-.35-.192-.85-.667-.013-.68.788-.012 1.35.744 1.538 1.051.9 1.551 2.338 1.116 2.912.846.088-.666.35-1.115.638-1.371-2.225-.256-4.55-1.14-4.55-5.062 0-1.115.387-2.038 1.025-2.756-.1-.256-.45-1.307.1-2.717 0 0 .837-.269 2.75 1.051.8-.23 1.65-.346 2.5-.346.85 0 1.7.115 2.5.346 1.912-1.333 2.75-1.05 2.75-1.05.55 1.409.2 2.46.1 2.716.637.718 1.025 1.628 1.025 2.756 0 3.934-2.337 4.806-4.562 5.062.362.32.675.936.675 1.897 0 1.371-.013 2.473-.013 2.82 0 .268.188.589.688.486a10.039 10.039 0 0 0 4.932-3.74A10.447 10.447 0 0 0 22 12.253C22 6.588 17.525 2 12 2Z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:px-8 mt-24 md:mt-28">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="mx-auto grid max-w-xl grid-cols-1 gap-y-20 lg:max-w-none lg:grid-cols-2">
                                <div class="flex flex-col gap-16">
                                    <? foreach($posts as $post) {
                                        $get_data = array(
                                            'post_id' => $post['post_id']
                                        );
                                        $q = http_build_query($get_data);
                                    ?>
                                        <article class="group relative flex flex-col items-start">
                                            <h2 class="font-tx-uc-medium tracking-widest text-xl uppercase tracking-tight text-stone-800 dark:text-stone-100">
                                                <div class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-stone-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl dark:bg-stone-800/50"></div>
                                                <a href="/article?<?= $q ?>">
                                                    <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
                                                    <span class="relative z-10"><?= $post['title'] ?></span>
                                                </a>
                                            </h2>
                                            <time class="font-tx-uc-thin relative z-10 order-first mb-3 flex items-center text-sm text-stone-400 dark:text-stone-500 pl-3.5" datetime="<?= $post['created_at'] ?>">
                                                <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                                                    <span class="h-4 w-0.5 rounded-full bg-stone-200 dark:bg-stone-500"></span>
                                                </span>
                                                <?= $post['created_at'] ?>
                                            </time>
                                            <p class="font-tx relative z-10 mt-2 text-sm text-stone-600 dark:text-stone-400"><?= $post['preview'] ?></p>
                                            <div aria-hidden="true" class="font-tx relative z-10 mt-4 flex items-center text-sm font-medium text-amber-500 underline decoration-double underline-offset-2">
                                                Read article
                                                <svg viewBox="0 0 16 16" fill="none" aria-hidden="true" class="ml-1 h-4 w-4 stroke-current">
                                                    <path d="M6.75 5.75 9.25 8l-2.5 2.25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </div>
                                        </article>
                                    <? } ?>
                                </div>
                                <div class="space-y-10 lg:pl-16 xl:pl-24">
                                    <div class="rounded-2xl border border-stone-100 p-6 dark:border-stone-700/40">
                                        <h2 class="font-tx-uc-medium tracking-widest uppercase flex text-xl text-stone-900 dark:text-stone-100">
                                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="h-6 w-6 flex-none">
                                                <path d="M2.75 9.75a3 3 0 0 1 3-3h12.5a3 3 0 0 1 3 3v8.5a3 3 0 0 1-3 3H5.75a3 3 0 0 1-3-3v-8.5Z" class="fill-stone-100 stroke-stone-400 dark:fill-stone-100/10 dark:stroke-stone-500"></path>
                                                <path d="M3 14.25h6.249c.484 0 .952-.002 1.316.319l.777.682a.996.996 0 0 0 1.316 0l.777-.682c.364-.32.832-.319 1.316-.319H21M8.75 6.5V4.75a2 2 0 0 1 2-2h2.5a2 2 0 0 1 2 2V6.5" class="stroke-stone-400 dark:stroke-stone-500"></path>
                                            </svg>
                                            <span class="ml-3">Work</span>
                                        </h2>
                                        <ol class="mt-6 space-y-4">
                                            <li class="flex gap-4">
                                                <div class="relative mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-full ring-1 shadow-md shadow-stone-800/5 ring-stone-900/5 dark:border dark:border-stone-700/50 dark:bg-stone-800 dark:ring-0">
                                                    <img alt="" loading="lazy" width="32" height="32" decoding="async" data-nimg="1" class="h-7 w-7" src="<?= './assets/social-media-logo.png' ?>" style="color: transparent;">
                                                </div>
                                                <dl class="flex flex-auto flex-wrap gap-x-2">
                                                    <dt class="sr-only">Company</dt>
                                                    <dd class="font-tx w-full flex-none text-sm text-stone-900 dark:text-stone-100">KILLIAN.arts</dd>
                                                    <dt class="sr-only">Role</dt>
                                                    <dd class="font-tx text-xs text-stone-500 dark:text-stone-400">Hypermedia Master</dd>
                                                    <dt class="sr-only">Date</dt>
                                                    <dd class="font-tx uppercase text-xs ml-auto text-stone-400 dark:text-stone-500" aria-label="2020 until Present">
                                                        <time datetime="2020">2020</time>
                                                        <span aria-hidden="true">—</span>
                                                        <time datetime="2025">Present</time>
                                                    </dd>
                                                </dl>
                                            </li>
                                        </ol>
                                        <a class="font-tx uppercase inline-flex items-center gap-2 justify-center rounded-md py-2 px-3 text-sm outline-offset-2 transition active:transition-none bg-stone-50 font-medium text-stone-900 hover:bg-stone-100 active:bg-stone-100 active:text-stone-900/60 dark:bg-stone-800/50 dark:text-stone-300 dark:hover:bg-stone-800 dark:hover:text-stone-50 dark:active:bg-stone-800/50 dark:active:text-stone-50/70 group mt-6 w-full"
                                            href="#">
                                            Download CV
                                            <svg viewBox="0 0 16 16" fill="none" aria-hidden="true" class="h-4 w-4 stroke-stone-400 transition group-active:stroke-stone-600 dark:group-hover:stroke-stone-50 dark:group-active:stroke-stone-50">
                                                <path d="M4.75 8.75 8 12.25m0 0 3.25-3.5M8 12.25v-8.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?= footer() ?>
    </div>
</div>
<?  page_foot();
