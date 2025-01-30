<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

$stmt = $db->prepare('SELECT * FROM post WHERE post_id = ?');
$stmt->execute([$_GET['post_id']]);
$post = $stmt->fetch();

page_head($post['title']); ?>
<div class="flex w-full">
    <div class="fixed inset-0 flex justify-center sm:px-8">
        <div class="flex w-full max-w-7xl lg:px-8">
            <div class="w-full bg-white ring-1 ring-stone-100 dark:bg-stone-900 dark:ring-stone-300/20"></div>
        </div>
    </div>
    <div class="relative flex w-full flex-col">
        <?= header_navigation(); ?>
        <main class="flex-auto">
            <div class="sm:px-8 mt-16 lg:mt-32">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="xl:relative">
                                <div class="mx-auto max-w-2xl">
                                    <article>
                                        <header class="flex flex-col">
                                            <h1 class="mt-6 text-4xl font-tx-uc-black uppercase tracking-tight text-stone-800 sm:text-5xl dark:text-stone-100"><?= $post['title'] ?></h1>
                                            <time datetime="<?= $post['created_at'] ?>" class="order-first flex items-center text-base text-stone-400 dark:text-stone-500">
                                                <span class="h-4 w-0.5 rounded-full bg-stone-200 dark:bg-stone-500"></span>
                                                <span class="ml-3"><?= $post['created_at'] ?></span>
                                            </time>
                                        </header>
                                        <div class="mt-8 prose dark:prose-invert font-tx">
                                            <?= $post['body'] ?>
                                        </div>
                                    </article>
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
