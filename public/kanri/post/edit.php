<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";


Security\verify_admin();

$post = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['edit'])) {
        $query = <<<SQL
            UPDATE post
            SET title = :title,
                preview = :preview,
                body = :body
            WHERE post_id = :post_id
        SQL;
        $stmt = $db->prepare($query);
        $stmt->execute([
            "title" => $_POST['title'],
            "preview" => $_POST['preview'],
            "body" => $_POST['body'],
            "post_id" => $_POST['post_id']
        ]);
        $stmt = $db->prepare('SELECT * FROM post WHERE post_id = ?');
        $stmt->execute([$_POST['post_id']]);
        $post = $stmt->fetch();
    } elseif (isset($_POST['delete'])) {
        $stmt = $db->prepare('DELETE FROM post WHERE post_id = ?');
        $stmt->execute([$_POST['post_id']]);
        $address = '/kanri/post/list';
        header("Location: $address", true, 303);
        exit;
    };
};

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $stmt = $db->prepare('SELECT * FROM post WHERE post_id = ?');
    $stmt->execute([$_GET['post_id']]);
    $post = $stmt->fetch();
}

page_head('Edit a Post');
?>

<h1 class="text-3xl uppercase font-mono-thin">Edit a Post</h1>
<form method="post" id="edit-post-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start">
    <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>" />
    <label class="font-mono-regular">
        <p>Title</p>
        <input type="text" name="title" value="<?= $post['title'] ?>" class="border font-tx" />
    </label>
    <label class="font-mono-regular">
        <p>Preview</p>
        <input type="text" name="preview" value="<?= $post['preview'] ?>" class="border font-tx" />
    </label>
    <label class="font-mono-regular">
        <p>Body</p>
        <textarea name="body" rows="10" cols="25" class="border font-tx"><?= $post['body'] ?></textarea>
    </label>
    <button name="edit" type="submit" class="bg-blue-500 font-tx text-blue-50">
        Submit
    </button>
    <button name="delete" type="submit" class="bg-rose-500 font-tx text-rose-50">
        Delete
    </button>
</form>

<?
page_foot();
