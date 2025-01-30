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
                                        <img alt="" loading="lazy" width="800" height="800" decoding="async" data-nimg="1" class="aspect-square rotate-3 rounded-2xl bg-zinc-100 object-cover dark:bg-zinc-800" sizes="(min-width: 1024px) 32rem, 20rem" srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=3840&amp;q=75 3840w" src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fportrait.79754e9e.jpg&amp;w=3840&amp;q=75" style="color: transparent;">
                                    </div>
                                </div>
                                <div class="lg:order-first lg:row-span-2">
                                    <h1 class="text-4xl font-tx-uc-black tracking-tight uppercase text-zinc-800 sm:text-5xl dark:text-zinc-100">I'm Spencer Sharp. I live in New York City, where I design the future.</h1>
                                    <div class="mt-6 space-y-7 text-base text-zinc-600 dark:text-zinc-400">
                                        <p class="font-tx">I've loved making things for as long as I can remember, and wrote my first program when I was 6 years old, just two weeks after my mom brought home the brand new Macintosh LC 550 that I taught myself to type on.</p>
                                        <p class="font-tx">The only thing I loved more than computers as a kid was space. When I was 8, I climbed the 40-foot oak tree at the back of our yard while wearing my older sister's motorcycle helmet, counted down from three, and jumped — hoping the tree was tall enough that with just a bit of momentum I'd be able to get to orbit.</p>
                                        <p class="font-tx">I spent the next few summers indoors working on a rocket design, while I recovered from the multiple surgeries it took to fix my badly broken legs. It took nine iterations, but when I was 15 I sent my dad's Blackberry into orbit and was able to transmit a photo back down to our family computer from space.</p>
                                        <p class="font-tx">Today, I'm the founder of Planetaria, where we're working on civilian space suits and manned shuttle kits you can assemble at home so that the next generation of kids really <em>can</em> make it to orbit — from the comfort of their own backyards.</p>
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
