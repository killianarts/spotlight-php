<?php


use Spotlight\Security;
use Spotlight\Data;

require $_SERVER['DOCUMENT_ROOT']."/../kanri-start.php";
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
        $address = '/kanri/post';
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
<section class="ml-72">
    <div class="py-20 px-10 bg-blue-50 rounded-xs shadow shadow-xl shadow-cyan-600/70">
    <h1 class="text-3xl text-(--main-color) uppercase font-berkeley-uc-black
                   before:bg-clip-text before:bg-conic before:from-blue-600 before:via-emerald-300 before:to-blue-700
                   before:text-transparent before:content-['#\'']""><?= lispify("Edit a Post"); ?></h1>
    <form method="post" id="edit-post-form" action="<? echo htmlentities($_SERVER['REQUEST_URI']); ?>" class="grid gap-2 justify-start">
        <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>" />
        <?= shiso_input(name: "title", type: "text", value: $post['title']); ?>
        <?= shiso_input(name: "preview", type: "text", value: $post['preview']); ?>
        <?= shiso_input(name: "body", type: "textarea", value: $post['body']); ?>
        <?= blue_button("Submit", name:"edit")?>
        <?= red_button("Delete", name:"delete")?>

    </form>
    </div>
</section>
<?
page_foot();
