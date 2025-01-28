<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();

$accounts = $db->query('SELECT * FROM account')->fetchAll();

page_head('View Accounts');
?>

<h1 class="text-3xl uppercase font-mono-thin">View Accounts</h1>
<a href="/kanri/account/create">
    <button class="bg-blue-500 px-5 py-1 uppercase font-tx text-blue-50">
        Create a account
    </button>
</a>
<div class="grid font-mono-regular">
    <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 bg-blue-100">
        <span>ID</span>
        <span>created_at</span>
        <span>updated_at</span>
        <span>Email</span>
    </div>
    <?
    foreach ($accounts as $account) {
        $get_data = array(
            'account_id' => $account['account_id']
        );
        $q = http_build_query($get_data);
    ?>
        <div class="grid [grid-template-columns:5ch_1fr_1fr_1fr_1fr] gap-x-2 odd:bg-neutral-200">
            <span><?= htmlentities($account['account_id']) ?></span>
            <span><?= htmlentities($account['created_at']) ?></span>
            <span><?= htmlentities($account['updated_at']) ?></span>
            <a class="underline text-blue-700 visited:text-blue-500" href="/kanri/account/edit?<? echo $q; ?>">
                <span><?= htmlentities($account['email']) ?></span>
            </a>
        </div>

    <?
    }
    ?>
</div>

<?
page_foot();
