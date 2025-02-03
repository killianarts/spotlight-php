<?php
require $_SERVER['DOCUMENT_ROOT']."/../kanri-start.php";

session_destroy();
header('Location: /kanri/login');
