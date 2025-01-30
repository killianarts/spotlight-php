<?php

session_start();

function page_head($title = "Write a title for this page") { ?>
    <!DOCTYPE html>
    <html class="light" lang=en>
        <head>
            <title><?= strtoupper($title) ?> | SHISO</title>
            <meta charset="utf-8">
            <meta name=viewport content="width=device-width, initial-scale=1">
            <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
            <script src="https://unpkg.com/htmx.org@2.0.4/dist/htmx.js" integrity="sha384-oeUn82QNXPuVkGCkcrInrS1twIxKhkZiFfr2TdiuObZ3n3yIeMiqcRzkIcguaof1" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/hyperscript.org@0.9.13"></script>
            <style type="text/tailwindcss">
             @custom-variant dark (&:where(.dark, .dark *));
             @theme {
                 --font-berkeley-uc-thin: "Berkeley Mono Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc: "Berkeley Mono UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc-medium: "Berkeley Mono Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc-black: "Berkeley Mono ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-black: "Berkeley Mono ExtraBold", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-thin: "Berkeley Mono Thin", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley: "Berkeley Mono", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-medium: "Berkeley Mono Medium", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
             }
            </style>
        </head>
        <body class="font-berkeley bg-stone-50 dark:bg-black">
<? };

function page_foot() { ?>
        </body>
    </html>
<? };
