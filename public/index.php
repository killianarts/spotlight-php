<?php

include "../start.php";

function body($name): void
{
    echo '<h1 class="text-3xl">'
        . strtoupper("Hello {$name}")
        . '</h1>';
}

page_head("Hello there");
body('Micah');
page_foot();
