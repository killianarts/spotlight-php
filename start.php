<?php

// require "vendor/autoload.php";

function page_head(string $title='Set a title for this page'): void
{
    global $is_htmx;
    echo '<!DOCTYPE html><html lang=en>'
       . "<head><title>$title</title>";
    if (!$is_htmx) {
        echo '<meta name=viewport content="width=device-width, initial-scale=1">'
           . '<script src="https://unpkg.com/@tailwindcss/browser@4"></script>';
    };
?>

<style type="text/tailwindcss">
 @theme {
     --font-mono-thin: "TX-02 Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
     --font-mono-regular: "TX-02 UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
     --font-mono-medium: "TX-02 Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
     --font-mono-black: "TX-02 ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
 }
</style>

<?
echo '</head><body>';
}
function page_foot(): void
{
    echo '</body></html>';
}
