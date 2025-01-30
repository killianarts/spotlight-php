<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

$posts = $db->query('SELECT * FROM post');

page_head("Articles"); ?>
<div class="flex w-full">
    <div class="fixed inset-0 flex justify-center sm:px-8">
        <div class="flex w-full max-w-7xl lg:px-8">
            <div class="w-full bg-white ring-1 ring-stone-100 dark:bg-stone-900 dark:ring-stone-300/20"></div>
        </div>
    </div>
    <div class="relative flex w-full flex-col">
        <?= header_navigation(); ?>
        <div class="flex-none" style="height: var(--content-offset);"></div>
        <main class="flex-auto">
            <div class="sm:px-8 mt-16 sm:mt-32">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <header class="max-w-2xl">
                                <h1 class="text-4xl font-tx-uc-black uppercase tracking-tight text-stone-800 sm:text-5xl dark:text-stone-100">I write about programming exclusively.</h1>
                                <p class="mt-6 font-tx text-stone-600 dark:text-stone-400">My writing is focused mostly on web development using Common Lisp, PHP, Python, HTMX, and _hyperscript. I often write about how to build high-quality, high-performance websites and applications with as little code as possible.</p>
                            </header>
                            <div class="mt-16 sm:mt-20">
                                <div class="md:border-l md:border-stone-100 md:pl-6 md:dark:border-stone-700/40">
                                    <div class="flex max-w-3xl flex-col space-y-16">
                                        <? foreach ($posts as $post) {
                                            $get_data = array(
                                                'post_id' => $post['post_id']
                                            );
                                            $q = http_build_query($get_data); ?>
                                            <article class="md:grid md:grid-cols-4 md:items-baseline">
                                                <div class="md:col-span-3 group relative flex flex-col items-start">
                                                    <h2 class="text-base font-semibold tracking-tight text-stone-800 dark:text-stone-100">
                                                        <div class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-stone-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl dark:bg-stone-800/50"></div>
                                                        <a href="/article?<?= $q ?>">
                                                            <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
                                                            <span class="font-tx-uc relative z-10"><?= $post['title'] ?></span>
                                                        </a>
                                                    </h2>
                                                    <time class="md:hidden relative font-tx-uc-thin z-10 order-first mb-3 flex items-center text-sm text-stone-400 dark:text-stone-500 pl-3.5" datetime="<?= $post['created_at'] ?>">
                                                        <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                                                            <span class="h-4 w-0.5 rounded-full bg-stone-200 dark:bg-stone-500"></span>
                                                        </span>
                                                        <?= $post['created_at'] ?>
                                                    </time>
                                                    <p class="relative z-10 mt-2 font-tx text-sm text-stone-600 dark:text-stone-400"><?= $post['preview'] ?></p>
                                                    <div aria-hidden="true" class="relative z-10 mt-4 flex items-center text-sm font-tx underline decoration-double underline-offset-2 text-amber-500">
                                                        Read article
                                                        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true" class="ml-1 h-4 w-4 stroke-current">
                                                            <path d="M6.75 5.75 9.25 8l-2.5 2.25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <time class="mt-1 hidden md:block relative font-tx-uc-thin z-10 order-first mb-3 flex items-center text-sm text-stone-400 dark:text-stone-500" datetime="<?= $post['created_at']?>">
                                                    <?= $post['created_at'] ?>
                                                </time>
                                            </article>
                                        <? }; ?>
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
