<?php

namespace Spotlight\Security;

function hello() {
    echo "hello";
}

function verify_admin() {
    if (!isset($_SESSION['email'])) {
        header('Location: /kanri/login');
    };
    if ($_SESSION['role_id'] != '1') {
        echo "Who the hell are you, punk?";
        echo $_SESSION['email'];
        echo $_SESSION['role_name'];
        echo $_SESSION['role_id'];
        exit;
    };
};
