<?php

use Spotlight\Security;

require $_SERVER['DOCUMENT_ROOT']."/../kanri-start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/Security.php";

Security\verify_admin();

page_head('Dashboard'); ?>

<? page_foot();
