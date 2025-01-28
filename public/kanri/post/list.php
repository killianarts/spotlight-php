<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();

$sql = <<<SQL
    SELECT p.*, a.email AS author_email
    FROM post p
    LEFT JOIN account a ON p.author_id = a.account_id
SQL;
$posts = $db->query($sql)->fetchAll();

page_head('View Posts'); ?>

<h1 class="text-3xl uppercase font-tx-uc-thin">View Posts</h1>
<a href="/kanri/post/create">
    <button class="bg-blue-500 px-5 py-1 uppercase font-tx text-blue-50">
        Create a Post
    </button>
</a>
<div class="grid font-mono-regular max-w-7xl mx-auto">
    <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 bg-blue-100">
        <span>ID</span>
        <span>created_at</span>
        <span>updated_at</span>
        <span>Title</span>
        <span>Author</span>
    </div>
    <? foreach ($posts as $post) {
        $get_data = array(
            'post_id' => $post['post_id']
        );
        $q = http_build_query($get_data); ?>
        <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 odd:bg-neutral-200">
            <span><?= htmlentities($post['post_id']) ?></span>
            <span><?= htmlentities($post['created_at']) ?></span>
            <span><?= htmlentities($post['updated_at']) ?></span>
            <a class="underline text-blue-700 visited:text-blue-500"
               href="/kanri/post/edit?<? echo $q; ?>">
                <span><?= htmlentities($post['title']) ?></span>
            </a>
            <span><?= htmlentities($post['author_email']) ?></span>
        </div>
    <? } ?>
</div>

<?
page_foot();
