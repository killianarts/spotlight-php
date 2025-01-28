<?php

session_start();

function page_head(string $title='Set a title for this page') { ?>
    <!DOCTYPE html><html lang=en>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <style type="text/tailwindcss">
         @theme {
             --font-mono-thin: "TX-02 Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-mono-regular: "TX-02 UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-mono-medium: "TX-02 Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-mono-black: "TX-02 ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-uc-thin: "TX-02 Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-uc: "TX-02 UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-uc-medium: "TX-02 Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-uc-black: "TX-02 ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-black: "TX-02 ExtraBold", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-thin: "TX-02 Thin", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx: "TX-02", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             --font-tx-medium: "TX-02 Medium", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
         }
        </style>
    </head>
    <body>
<? };

function page_foot() { ?>
    </body></html>
<? };

