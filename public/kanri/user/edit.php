<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

$user = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit'])) {
        try {
            $query = $db->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id');
            $query->execute([
                "first_name" => $_POST['first_name'],
                "last_name" => $_POST['last_name'],
                "id" => $_POST['id']
            ]);
            $stmt = $db->prepare('SELECT * FROM users where id = ?');
            $stmt->execute([$_POST['id']]);
            $user = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        };
    } elseif (isset($_POST['delete'])) {
        try {
            $query = $db->prepare('DELETE FROM users WHERE id = ?');
            $query->execute([$_POST['id']]);
            $address = $_SERVER['DOCUMENT_ROOT'];
            header("Location: /kanri/user/list");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        };

    };
};

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    try {
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        echo  "Error: " . $e->getMessage();
    }
}

page_head('Update a User');
?>

<h1 class="text-3xl uppercase font-mono-thin">Edit a User</h1>

<form method="post" id="edit-user-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start font-mono-regular">
    <input type="hidden" name="id" value="<?= $user['id'] ?>" />
    <label>
        <p>First Name</p>
        <input type="text" name="first_name" value="<?= $user['first_name']?>" class="border border-black" />
    </label>

    <label>
        <p>Last Name</p>
        <input type="text" name="last_name" value="<?= $user['last_name']?>" class="border border-black" />
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
