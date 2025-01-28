<?php
require $_SERVER['DOCUMENT_ROOT']."/../start.php";

session_destroy();
header('Location: /kanri/login');
