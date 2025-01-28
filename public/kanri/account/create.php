<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $db->prepare('INSERT INTO account (email, password, role_id) VALUES (:email, :password, :role_id)');
    $stmt->execute([
        "email" => $_POST['email'],
        "password" => $hashed_password,
        "role_id" => $_POST['role_id']
    ]);
    $address = "/kanri/user/list";
    header("Location: $address", true, 303);
};

page_head('Create a User');
?>

<h1 class="text-3xl font-mono-thin uppercase">Create a User</h1>

<form method="post" id="create-user-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start">
    <label class="font-mono-regular">
        <p>Email</p>
        <input type="text" name="email" class="border border-black" />
    </label>

    <label class="font-mono-regular">
        <p>Password</p>
        <input type="password" name="password" class="border border-black" />
    </label>
    <label class="font-mono-regular">
        <p>Role Name</p>
        <select id="role-names" name="role_id">
            <option value="1">
                Admin
            </option>
        </select>
    </label>
    <button name="submit" type="submit" class="bg-blue-500 font-mono-regular text-blue-50">
        Submit
    </button>
</form>

<?
page_foot();
