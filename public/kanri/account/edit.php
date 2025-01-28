<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";


Security\verify_admin();

$account = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit'])) {
        $query = $db->prepare('UPDATE account SET email = :email, password = :password WHERE account_id = :account_id');
        $query->execute([
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "account_id" => $_POST['account_id']
        ]);
        $stmt = $db->prepare('SELECT * FROM account where account_id = ?');
        $stmt->execute([$_POST['account_id']]);
        $account = $stmt->fetch();
    } elseif (isset($_POST['delete'])) {
        $query = $db->prepare('DELETE FROM account WHERE account_id = ?');
        $query->execute([$_POST['account_id']]);
        $address = '/kanri/user/list';
        header("Location: $address", true, 303);
        exit;
    };
};

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $stmt = $db->prepare('SELECT * FROM account WHERE account_id = ?');
    $stmt->execute([$_GET['account_id']]);
    $account = $stmt->fetch();
}

page_head('Edit an Account');
?>

<h1 class="text-3xl uppercase font-mono-thin">Edit an Account</h1>

<form method="post" id="edit-account-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start font-mono-regular">
    <input type="hidden" name="account_id" value="<?= $account['account_id'] ?>" />
    <label>
        <p>Email</p>
        <input type="text" name="email" value="<?= $account['email'] ?>" class="border border-black" required />
    </label>

    <label>
        <p>Password</p>
        <input type="password" name="password" value="<?= $account['password'] ?>" class="border border-black" required />
    </label>
    <button name="edit" type="submit" class="bg-blue-500 text-blue-50">
        Submit
    </button>
    <button name="delete" type="submit" class="bg-rose-500 text-rose-50">
        Delete
    </button>
</form>

<?
page_foot();
