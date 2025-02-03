<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../kanri-start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

$table_name = table_name(__FILE__);

Security\verify_admin();

$sql = <<<SQL
    SELECT a.account_id, a.created_at, a.updated_at, a.email, r.role_name AS role_name
    FROM account a
    LEFT JOIN role r ON a.account_id = r.role_id
SQL;
$data_table = $db->query($sql);


page_head("$table_name table");
?>
<main class="ml-64 text-blue-50">
    <h1 class="text-3xl uppercase font-berkeley-uc-black">
        <span class="text-blue-500/30"><?= breadcrumbs() ?></span><?= $table_name . " table"; ?>
    </h1>
    <button id="make-account-button"
            class="my-5 px-3 py-1 bg-blue-50 text-(--main-color) rounded-xs font-berkeley-uc-black uppercase
                border-l border-t border-l-red-700/30 border-t-red-700/30
                border-r border-b border-r-emerald-700/30 border-b-emerald-700/30
                hover:bg-white hover:shadow hover:shadow-cyan-600/50 hover:ring-cyan-700
                before:bg-conic before:from-blue-600 before:via-emerald-300 before:to-blue-700 before:bg-clip-text
                before:text-transparent before:content-['#\'']"
            _="on click set emailInput to #email-label toggle .hidden on me then toggle .hidden on #make-account-form
                js(me, emailInput) emailInput.focus() end"><?= lispify('Make Account')?></button>
    <div id="make-account-form"
         _="on click from body
             measure me
             set is_in_me to result.top    <= event.clientY              and
             event.clientY <= result.top + result.height and
             result.left   <= event.clientX              and
             event.clientX <= result.left + result.width
             if is_in_me == false and I do not match .hidden toggle .hidden on me toggle .hidden on #make-account-button end end"
         class="bg-blue-50 rounded-xs hidden relative shadow-md shadow-cyan-600/70 px-3 my-5
             border-l border-t border-l-red-700/30 border-t-red-700/30
             border-r border-b border-r-emerald-700/30 border-b-emerald-700/30
             ">
        <button class="p-1 absolute top-1 right-1" _="on mousedown toggle .hidden on #make-account-form toggle .hidden on #make-account-button">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-(--main-color) size-4">
                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
            </svg>
        </button>

        <fieldset class="flex rounded-xs">
            <legend class="pt-1 text-(--main-color) rounded-xs font-berkeley-uc-black uppercase
                           before:bg-conic before:from-blue-600 before:via-emerald-300 before:to-blue-700 before:bg-clip-text
                           before:text-transparent before:content-['#\'']"><?= lispify('Make Account')?></legend>
            <form method="" id="" action="" class="p-3 space-y-3">
                <div class="grid sm:grid-cols-2 gap-3 group">
                    <?= shiso_input(name: "email", type: "email") ?>
                    <?= shiso_input(name: "password", type: "password") ?>
                    <?= shiso_input(name: "confirm", type: "password") ?>
                    <?= shiso_input(name: "role name", type: "select") ?>
                </div>
                <?= blue_button("Submit") ?>
            </form>
        </fieldset>
    </div>
    <?= divtable($data_table, $table_name, ['account_id', 'created_at', 'updated_at', 'email', 'role_name']); ?>
</main>

<?
page_foot();
