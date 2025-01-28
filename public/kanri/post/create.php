<?php

use Spotlight\Security;
use Spotlight\Data;

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = <<<SQL
        INSERT INTO post (author_id, title, preview, body)
        VALUES (:author_id, :title, :preview, :body)
    SQL;
    $stmt = $db->prepare($query);
    $stmt->execute([
        'author_id' => $_SESSION['account_id'],
        'title' => $_POST['title'],
        'preview' => $_POST['preview'],
        'body' => $_POST['body']
    ]);
    $address = '/kanri/post/list';
    header("Location: $address", true, 303);
};

page_head('Create a Post'); ?>
<h1 class="text-3xl uppercase font-tx-uc-thin">Create a Post</h1>
<form method="post" id="create-post-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start">
    <label class="font-tx-uc">
        <p>Title</p>
        <input type="text" name="title" class="border font-tx border-black" />
    </label>
    <label class="font-tx-uc">
        <p>Preview</p>
        <input type="text" name="preview" class="border font-tx border-black" />
    </label>
    <label class="font-tx-uc">
        <p>Body</p>
        <textarea name="body" rows="10" cols="25" class="border font-tx"></textarea>
    </label>
    <button name="submit" type="submit" class="bg-blue-500 font-tx text-blue-50">
        Submit
    </button>
</form>
<? page_foot();
