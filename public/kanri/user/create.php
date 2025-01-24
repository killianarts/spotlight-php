<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Data.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $query = $db->prepare('INSERT INTO users (first_name, last_name) VALUES (:first_name, :last_name)');
    $query->execute([
        "first_name" => $_POST['first_name'],
        "last_name" => $_POST['last_name']
    ]);
    $address = "/kanri/user/list";
    header("Location: " . $address);
    exit;
};

page_head('Create a User');
?>

<h1 class="text-3xl font-mono-thin uppercase">Create a User</h1>

<form method="post" id="create-user-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start">
    <label class="font-mono-regular">
        <p>First Name</p>
        <input type="text" name="first_name" class="border border-black" />
    </label>

    <label class="font-mono-regular">
        <p>Last Name</p>
        <input type="text" name="last_name" class="border border-black" />
    </label>
    <button name="submit" type="submit" class="bg-orange-500 font-mono-regular text-orange-50">
        Submit
    </button>
</form>

<?
page_foot();
