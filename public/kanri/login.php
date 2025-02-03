<?php
use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../kanri-start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM account WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($email = $user['email'] && password_verify($password, $user['password'])) {
        $_SESSION['account_id'] = $user['account_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['role_id'] = $user['role_id'];
        header("Location: /kanri/post/list");
        exit;
    } else {
        $passwords_match = "The passwords didn't match.";
    };
};

page_head('Login', false); ?>
<main class="bg-(--main-color) min-h-screen grid place-items-center">
    <div class="py-20 px-10 bg-blue-50 rounded-xs shadow shadow-xl shadow-cyan-600/70">
        <h1 class="text-3xl text-(--main-color) uppercase font-berkeley-uc-black
                   before:bg-clip-text before:bg-conic before:from-blue-600 before:via-emerald-300 before:to-blue-700
                   before:text-transparent before:content-['#\'']""><?= lispify("Shiso Dashboard Login"); ?></h1>
        <form method="post" id="login-form"
              action="<?= htmlentities($_SERVER['REQUEST_URI']) ?>"
              class="space-y-2">
            <?= shiso_input(name: "email", type: "email") ?>
            <?= shiso_input(name: "password", type: "password") ?>
            <?= blue_button("Login") ?>
        </form>
    </div>
</main>

<? page_foot(false);
