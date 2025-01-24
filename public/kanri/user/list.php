<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Data.php";

$users = $db->query('SELECT * FROM users')->fetchAll();

page_head('View Users');
?>

<h1 class="text-3xl uppercase font-mono-thin">View Users</h1>
<a href="/kanri/user/create">
    <button class="bg-blue-500 px-5 py-1 uppercase font-mono-regular text-blue-50">
        Create a User
    </button>
</a>
<div class="grid font-mono-regular">
    <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 bg-blue-100">
        <span>ID</span>
        <span>created_at</span>
        <span>updated_at</span>
        <span>First Name</span>
        <span>Last Name</span>
    </div>
    <?
    foreach ($users as $user) {
        $get_data = array(
            'id' => $user['id']
        );
        $q = http_build_query($get_data);
    ?>
        <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 odd:bg-neutral-200">
            <span><?= htmlentities($user['id']) ?></span>
            <span><?= htmlentities($user['created_at']) ?></span>
            <span><?= htmlentities($user['updated_at']) ?></span>
            <a class="underline text-blue-700 visited:text-blue-500" href="/kanri/user/edit?<? echo $q; ?>">
                <span><?= htmlentities($user['first_name']) ?></span>
            </a>
            <span><?= htmlentities($user['last_name']) ?></span>
        </div>

    <?
    }
    ?>
</div>

<?
page_foot();
