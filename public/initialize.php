<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";
use Spotlight\Data;

$superuser = Data\initialize_database($db);
