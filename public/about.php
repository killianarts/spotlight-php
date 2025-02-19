<?php

require $_SERVER['DOCUMENT_ROOT']."/../start.php";
require $_SERVER['DOCUMENT_ROOT']."/../lib/data.php";

$posts = $db->query('SELECT * FROM post');

page_head("About"); ?>
<div class="flex w-full">
    <div class="fixed inset-0 flex justify-center sm:px-8">
        <div class="flex w-full max-w-7xl lg:px-8">
            <div class="w-full bg-white ring-1 ring-stone-100 dark:bg-stone-900 dark:ring-stone-300/20"></div>
        </div>
    </div>
    <div class="relative flex w-full flex-col">
        <?= header_navigation(); ?>
        <div class="flex-none" style="height: var(--content-offset);"></div>
        <main class="flex-auto">
            <div class="sm:px-8 mt-16 sm:mt-32">
                <div class="mx-auto w-full max-w-7xl lg:px-8">
                    <div class="relative px-4 sm:px-8 lg:px-12">
                        <div class="mx-auto max-w-2xl lg:max-w-5xl">
                            <div class="grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:grid-rows-[auto_1fr] lg:gap-y-12">
                                <div class="lg:pl-20">
                                    <div class="max-w-xs px-2.5 lg:max-w-none">
                                        <img alt="" loading="lazy" width="800" height="800" decoding="async" data-nimg="1" class="object-cover" sizes="(min-width: 1024px) 32rem, 20rem" src="/assets/social-media-headshot.png" style="color: transparent;">
                                    </div>
                                </div>
                                <div class="lg:order-first lg:row-span-2">
                                    <h1 class="text-4xl font-tx-uc-black tracking-tight uppercase text-zinc-800 sm:text-5xl dark:text-zinc-100">I'm Micah Killian. I'm a software developer living in Japan.</h1>
                                    <div class="mt-6 space-y-7 text-base text-zinc-600 dark:text-zinc-400">
                                        <p class="font-tx">
                                            This is a demo site I made in less than a month using vanilla PHP. Before making this site, I only had a couple of weeks experience with PHP writing a small Laravel demo.
                                        </p>
                                        <p class="font-tx">
                                            This site has the following features:
                                            <ul class="list-disc list-inside font-tx">
                                                <li>Blogging</li>
                                                <li>Admin interface w/auth</li>
                                            </ul>
                                        </p>
                                        <p class="font-tx">The blogging functionality was completed in less than two weeks, but I budgeted some time to work on a nice dashboard for the backend. I used the <a class="font-black underline text-blue-600 hover:text-blue-500" href="https://spotlight.tailwindui.com/">Spotlight template from TailwindUI</a> for this and the other pages on the frontend. The backend dashboard is custom designed and styled with Tailwind.</p>
                                        <p class="font-tx">My main work has been in Python using Django, but I found the experience of learning PHP and implementing a primitive personal framework surprisingly fun and easy.</p>
                                    </div>
                                </div>
                                <div class="lg:pl-20">
                                    <ul role="list">
                                        <li class="flex">
                                            <a class="group flex text-sm font-medium text-zinc-800 transition hover:text-teal-500 dark:text-zinc-200 dark:hover:text-teal-500" href="#">
                                                <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                                                    <path d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.6438L11.4257 12.9742V12.9738Z"></path>
                                                </svg>
                                                <span class="ml-4">Follow on X</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?= footer() ?>
    </div>
</div>
<?  page_foot();
