<?php

session_start();

$BASE_DIR = dirname(__FILE__);
$public_dir = $BASE_DIR . "/public";
$kanri_dir = $public_dir . "/kanri";

function full_path_to_dir($partial_path) {
    global $public_dir;
    return $public_dir . $partial_path;
};

function request_path() {
    return full_path_to_dir($_SERVER['REQUEST_URI']);
}

function kanri_path($path) {
    global $kanri_dir;
    return $kanri_dir . "/" . $path . "/";
};

function is_request_uri($path) {
    return request_path() == $path;
};

function asset($path) {
    $assets_dir = "/assets";
    return $assets_dir . $path;
}

function breadcrumbs() {
    return str_replace("/", "->", $_SERVER['REQUEST_URI']);
};


function table_name($path) {
    return basename(dirname($path));
}

function lispify($str) {
    return str_replace([" ", "_"], "-", $str);
}

function blue_button($text, $name="submit", $type="submit") { ?>
    <button name="<?= $name ?>" type="<?= $type ?>"
            class="font-berkeley-black text-blue-50 uppercase px-3 py-1
                  bg-(--main-color) rounded-xs
                  inset-ring inset-ring-blue-600/30
                  border-l border-t border-l-red-700/30 border-t-red-700/30
                  border-r border-b border-r-emerald-700/30 border-b-emerald-700/30
                  hover:bg-blue-700 hover:shadow
                  hover:shadow-cyan-600/50">
        <?= lispify($text); ?>
    </button>
<? };

function red_button($text, $name="submit", $type="submit") { ?>
    <button name="<?= $name ?>" type="<?= $type ?>"
            class="font-berkeley-black text-rose-50 uppercase px-3 py-1
                  bg-(--danger-color) rounded-xs
                  inset-ring inset-ring-rose-600/30
                  border-l border-t border-l-red-700/30 border-t-red-700/30
                  border-r border-b border-r-emerald-700/30 border-b-emerald-700/30
                  hover:bg-rose-500 hover:shadow
                  hover:shadow-orange-600/50">
        <?= lispify($text); ?>
    </button>
<? };
// TODO Figure out arguments like id and hyperscript
function white_button($text) { ?>
    <button id="make-post-button"
            class="my-5 px-3 py-1 bg-blue-50 text-(--main-color) rounded-xs font-berkeley-uc-black uppercase
                border-l border-t border-l-red-700/30 border-t-red-700/30
                border-r border-b border-r-emerald-700/30 border-b-emerald-700/30
                hover:bg-white hover:shadow hover:shadow-cyan-600/50 hover:ring-cyan-700
                before:bg-conic before:from-blue-600 before:via-emerald-300 before:to-blue-700 before:bg-clip-text
                before:text-transparent before:content-['#\'']"
            _="on click set emailInput to #email-label toggle .hidden on me then toggle .hidden on #make-post-form
                js(me, emailInput) emailInput.focus() end"><?= lispify($text)?></button>
<? };

function table_header($column_names_array) { ?>
    <div-tr class="table-row font-berkeley-uc-black uppercase">
        <? foreach ($column_names_array as $col_name) { ?>
            <div-th class="table-cell before:content-[':'] before:text-blue-50 after:text-blue-900/50 px-1"><?= lispify($col_name) ?></div-th>
        <? }; ?>
    </div-tr>
<? };

function divtable($stmt, $sql_table_name, $table_columns) {
    $start_time = hrtime(true);
    $row_count = $stmt->rowCount();
    $end_time = hrtime(true);
    $elapsed = ($end_time - $start_time) / 1E9;
?>
    <div>
        <div class="grid bg-blue-950 px-6 py-1 rounded-xs">
            <p class="text-blue-900 uppercase font-berkeley-uc-black">(mapcar #'format-account-row account-array) => <? if ($row_count != 1) { echo $row_count . " rows returned."; } else { echo $row_count . " row returned."; }; ?> Evaluation took: <?= $elapsed ?> seconds</p>
            <div-table class="table">
                <div-thead class="table-header-group">
                    <?= table_header($table_columns) ?>
                </div-thead>

                <div class="hidden text-center">
                    <button class="before:content-['('] after:content-[')']
                                   font-berkeley-black uppercase text-lg
                                   hover:bg-green-800 cursor-pointer"><?=str_replace(" ", "-", "Create Account")?></button>
                </div>
                <?
                foreach ($stmt as $result) {
                    $get_data = array(
                        "$sql_table_name" . "_id" => $result["$sql_table_name" . "_id"]
                    );
                    $q = http_build_query($get_data); ?>
                    <a class="table-row rounded-lg px-2 py-1
                              font-berkeley-uc underline text-blue-50
                              hover:bg-blue-50 hover:text-(--main-color)"
                       href="/kanri/<?= $sql_table_name; ?>/edit?<? echo $q; ?>">
                        <? foreach($table_columns as $col) { ?>
                            <div-td class="table-cell font-berkeley-uc px-2 py-1"><?= htmlentities($result[$col]) ?></div-td>
                        <? }; ?>
                    </a>
                <? }; ?>
            </div-table>
            <p class="text-blue-900 text-right uppercase font-berkeley-uc-black invisible">---</p>
        </div>
    </div>
<? };

function sidebar_start() {
    global $kanri_dir; ?>
    <div class="flex">
        <div class="relative isolate flex min-h-svh w-full bg-blue-900 max-lg:flex-col
                    dark:bg-blue-900 dark:lg:bg-blue-900">
            <div class="fixed bg-blue-900 inset-y-0 left-0 w-64 max-lg:hidden">
                <nav class="font-berkeley-black uppercase text-blue-200 flex h-full min-h-0 flex-col">
                    <div class="flex flex-col border-b border-blue-50/5 p-4 dark:border-white/5 [&amp;>[data-slot=section]+[data-slot=section]]:mt-2.5">
                        <span class="relative">
                            <button type="button" aria-haspopup="menu" aria-expanded="false" class="flex w-full">
                                <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                <span data-slot="avatar" class="flex items-center gap-5">
                                    <div>
                                        <svg class="h-8 fill-blue-50" viewBox="0 0 193 331" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M142.399 330.999H48.599C42.2865 331.015 36.0331 329.784 30.1969 327.379C24.3607 324.973 19.0565 321.44 14.5882 316.981C10.12 312.522 6.57547 307.225 4.15779 301.394C1.7401 295.563 0.496771 289.312 0.499027 282.999V102.999C0.503882 96.6887 1.75207 90.441 4.17227 84.613C6.59246 78.785 10.1372 73.4911 14.6041 69.0335C19.0709 64.576 24.3723 61.0422 30.2053 58.6341C36.0382 56.2261 42.2885 54.9909 48.599 54.9992H142.399C148.712 54.9838 154.965 56.2141 160.801 58.6196C166.637 61.0252 171.942 64.5587 176.41 69.0176C180.878 73.4766 184.423 78.7734 186.84 84.6046C189.258 90.4357 190.501 96.6867 190.499 102.999V282.999C190.494 289.31 189.246 295.557 186.826 301.385C184.406 307.213 180.861 312.507 176.394 316.965C171.927 321.422 166.626 324.956 160.793 327.364C154.96 329.772 148.71 331.007 142.399 330.999ZM67.439 244.783C68.934 244.783 69.791 246.773 69.791 250.243V263.514C69.7513 266.188 70.0941 268.854 70.809 271.431C71.445 273.5 72.298 274.686 73.15 274.686C75.081 274.686 76.594 269.778 76.594 263.513V256.542C76.5201 254.721 76.8539 252.905 77.571 251.229C77.7652 250.698 78.1097 250.234 78.5627 249.895C79.0156 249.555 79.5573 249.355 80.122 249.318C81.384 249.318 82.454 250.194 83.587 251.118C84.773 252.089 85.999 253.094 87.514 253.094C88.303 253.094 88.774 252.56 88.774 251.666C88.774 248.432 85.674 245.422 82.684 242.51C79.694 239.598 76.594 236.588 76.594 233.354C76.594 229.929 79.537 225.339 82.382 220.901C84.982 216.852 87.43 213.028 87.43 210.422C87.3669 209.936 87.1777 209.475 86.8813 209.084C86.5848 208.694 86.1914 208.388 85.74 208.196C84.5024 207.54 83.1187 207.208 81.718 207.23C80.2557 207.253 78.8231 206.816 77.623 205.98C77.1244 205.66 76.7099 205.225 76.4141 204.711C76.1183 204.198 75.9499 203.621 75.923 203.029C75.923 200.667 74.416 198.745 72.563 198.745C70.71 198.745 69.203 200.667 69.203 203.029C69.1761 203.621 69.0078 204.198 68.712 204.711C68.4162 205.225 68.0016 205.66 67.503 205.98C66.3029 206.816 64.8703 207.253 63.408 207.23C61.9584 207.201 60.5246 207.537 59.239 208.207C58.7744 208.403 58.3706 208.719 58.0695 209.124C57.7685 209.528 57.5812 210.006 57.527 210.507C57.527 211.396 58.698 212.224 60.827 212.838C63.4258 213.508 66.1027 213.825 68.786 213.783H69.122C70.8244 213.693 72.5106 214.153 73.931 215.096C74.4586 215.488 74.8847 216 75.1733 216.59C75.462 217.18 75.6049 217.831 75.59 218.488C75.5082 220.137 74.9217 221.72 73.91 223.024L63.999 236.971C60.432 242.071 57.531 248.51 57.531 251.335C57.531 252.296 57.837 252.847 58.372 252.847C59.884 252.847 61.421 250.797 62.908 248.815C64.395 246.833 65.927 244.783 67.439 244.783ZM105.575 200.263C104.093 200.249 102.623 200.531 101.251 201.091C99.879 201.652 98.6326 202.481 97.5846 203.529C96.5366 204.577 95.708 205.823 95.1473 207.195C94.5866 208.567 94.305 210.037 94.319 211.519V255.787C94.319 261.887 93.242 267.042 91.967 267.042C90.648 267.042 89.615 268.518 89.615 270.403C89.615 272.256 94.664 273.763 100.87 273.763H122.206C128.413 273.763 133.462 272.256 133.462 270.403C133.462 268.55 132.52 267.042 131.362 267.042C130.795 267.042 130.262 265.871 129.871 263.742C129.437 261.112 129.234 258.449 129.262 255.784V211.519C129.269 210.039 128.983 208.572 128.42 207.203C127.857 205.834 127.028 204.59 125.982 203.543C124.935 202.497 123.691 201.668 122.322 201.105C120.953 200.542 119.486 200.256 118.006 200.263H105.575ZM68.363 112.751C65.917 112.751 65.175 115.072 64.463 117.316C64.1737 118.402 63.7405 119.445 63.175 120.416C62.9135 120.853 62.5414 121.213 62.0963 121.46C61.6512 121.706 61.1489 121.832 60.64 121.822C59.8159 121.823 59.0257 122.151 58.4429 122.733C57.86 123.316 57.5321 124.106 57.531 124.93C57.5155 125.738 57.7913 126.524 58.308 127.145C58.5426 127.424 58.8351 127.648 59.1652 127.802C59.4952 127.956 59.8548 128.036 60.219 128.037C61.119 128.037 61.731 130.265 61.731 133.581C61.7063 135.436 61.5661 137.288 61.311 139.125L59.543 151.559C59.3766 152.53 59.2923 153.513 59.291 154.498C59.2029 157.23 59.7082 159.948 60.772 162.465C61.5627 164.082 62.5908 165.571 63.822 166.884C65.403 168.711 66.768 170.284 66.768 173.315C66.768 176.824 64.974 179.496 63.391 181.853C62.104 183.77 60.891 185.581 60.891 187.51C60.891 188.28 61.24 188.686 61.899 188.686C64.612 188.686 66.521 186.496 68.543 184.178C70.787 181.604 73.108 178.942 76.767 178.942C78.5048 179.021 80.1693 179.665 81.508 180.776C82.5385 181.654 83.8179 182.188 85.167 182.302C85.36 182.325 85.5555 182.303 85.7389 182.239C85.9224 182.175 86.089 182.071 86.2264 181.934C86.3637 181.796 86.4682 181.63 86.5321 181.446C86.5959 181.263 86.6174 181.067 86.595 180.874C86.595 178.034 85.066 176.455 83.588 174.929C82.288 173.582 81.051 172.31 81.051 170.29C81.1016 168.806 81.599 167.371 82.478 166.174C84.42 163.469 85.999 156.199 85.999 149.963V133.079C86.053 130.254 85.2474 127.479 83.689 125.121C83.099 124.156 82.2812 123.35 81.3073 122.775C80.3333 122.2 79.2331 121.872 78.103 121.821C75.308 121.821 72.803 120.993 71.565 119.66C71.3069 119.406 71.105 119.101 70.9723 118.764C70.8397 118.428 70.7793 118.067 70.795 117.705L70.879 116.361C70.9184 115.837 70.8527 115.311 70.6857 114.813C70.5188 114.315 70.2541 113.855 69.907 113.461C69.7121 113.243 69.4745 113.068 69.2089 112.946C68.9432 112.823 68.6553 112.757 68.363 112.751ZM103.811 154.999C102.333 154.999 100.869 155.291 99.5028 155.857C98.1369 156.423 96.896 157.252 95.8507 158.298C94.8055 159.343 93.9764 160.585 93.411 161.951C92.8455 163.317 92.5546 164.781 92.555 166.259V176.507C92.5587 179.491 93.7458 182.352 95.856 184.462C97.9661 186.572 100.827 187.759 103.811 187.762H119.855C121.335 187.769 122.802 187.483 124.171 186.92C125.54 186.357 126.783 185.528 127.83 184.482C128.876 183.435 129.705 182.192 130.268 180.823C130.831 179.454 131.117 177.987 131.11 176.507V166.259C131.118 164.779 130.832 163.311 130.27 161.942C129.707 160.573 128.878 159.328 127.832 158.281C126.785 157.234 125.541 156.405 124.172 155.842C122.803 155.278 121.336 154.992 119.855 154.999H103.811ZM105.411 112.748C103.502 112.748 100.149 117.458 97.936 123.248L95.411 129.799C93.271 135.399 91.463 141.705 91.463 143.575C91.463 144.436 92.623 145.253 94.729 145.875C97.3354 146.565 100.024 146.894 102.72 146.852H121.199C123.577 146.914 125.885 146.048 127.635 144.437C128.435 143.645 129.066 142.699 129.49 141.655C129.914 140.612 130.123 139.494 130.102 138.368C130.109 137.544 129.996 136.724 129.766 135.933L129.43 134.757C127.879 129.331 125.33 123.837 123.466 123.837C122.256 123.837 121.534 125.344 121.534 127.869C121.566 128.831 121.693 129.788 121.912 130.725C122.131 131.662 122.258 132.619 122.29 133.581C122.27 134.53 122.021 135.46 121.564 136.292C121.107 137.124 120.455 137.833 119.665 138.359C117.661 139.695 115.29 140.375 112.882 140.302H109.942C107.794 140.39 105.692 139.667 104.052 138.276C103.35 137.625 102.794 136.833 102.419 135.952C102.044 135.071 101.86 134.12 101.878 133.163C101.905 132.012 102.132 130.875 102.55 129.802L105.07 123.25C106.098 120.795 106.695 118.181 106.834 115.523C106.835 113.787 106.299 112.751 105.407 112.751L105.411 112.748ZM111.796 267.04C105.913 267.04 101.127 263.423 101.127 258.976C101.134 257.902 101.424 256.849 101.967 255.922C102.549 254.928 103.328 254.063 104.256 253.38C106.447 251.793 109.091 250.958 111.796 250.997C114.489 250.954 117.122 251.791 119.296 253.38C120.215 254.064 120.984 254.929 121.556 255.922C122.092 256.851 122.377 257.904 122.383 258.976C122.35 260.101 122.053 261.203 121.517 262.193C120.981 263.183 120.22 264.034 119.296 264.676C117.119 266.261 114.484 267.092 111.791 267.043L111.796 267.04ZM111.796 244.612C105.913 244.612 101.127 241.07 101.127 236.712C101.127 232.354 105.913 228.812 111.796 228.812C114.479 228.761 117.107 229.571 119.296 231.122C120.24 231.717 121.018 232.541 121.558 233.517C122.097 234.494 122.38 235.592 122.38 236.708C122.38 237.823 122.097 238.921 121.558 239.898C121.018 240.875 120.24 241.699 119.296 242.293C117.107 243.85 114.477 244.664 111.791 244.615L111.796 244.612ZM111.796 222.352C109.103 222.398 106.465 221.593 104.256 220.052C103.332 219.45 102.566 218.636 102.021 217.677C101.477 216.718 101.17 215.642 101.127 214.54C101.127 210.186 105.913 206.64 111.796 206.64C114.479 206.589 117.107 207.399 119.296 208.95C120.216 209.57 120.976 210.4 121.512 211.371C122.049 212.342 122.348 213.427 122.383 214.536C122.375 218.85 117.627 222.355 111.791 222.355L111.796 222.352ZM113.223 181.292H110.536C107.611 181.319 104.778 180.269 102.577 178.341C101.545 177.48 100.715 176.402 100.145 175.185C99.5756 173.968 99.2803 172.64 99.2803 171.296C99.2803 169.952 99.5756 168.624 100.145 167.406C100.715 166.189 101.545 165.111 102.577 164.25C104.778 162.322 107.611 161.272 110.536 161.299H113.223C116.148 161.272 118.981 162.322 121.182 164.25C122.214 165.111 123.044 166.189 123.614 167.406C124.183 168.624 124.479 169.952 124.479 171.296C124.479 172.64 124.183 173.968 123.614 175.185C123.044 176.402 122.214 177.48 121.182 178.341C118.981 180.272 116.147 181.325 113.219 181.299L113.223 181.292ZM72.983 164.999C70.32 164.999 68.369 163.519 67.183 160.599C66.2889 158.076 65.8619 155.411 65.923 152.734C65.9195 151.496 66.0037 150.26 66.175 149.034L67.602 139.121C67.9573 136.362 68.8752 133.705 70.299 131.315C71.599 129.233 73.131 128.039 74.499 128.039C75.924 128.039 77.27 129.21 78.289 131.339C79.387 133.846 79.9268 136.563 79.871 139.299V147.699C79.9344 151.163 79.6246 154.624 78.947 158.021C77.863 162.65 75.856 164.999 72.983 164.999Z" />
                                            <path d="M38.499 36.5C38.499 27.9396 31.5594 21 22.999 21C14.4386 21 7.49902 27.9396 7.49902 36.5V46.5C7.49902 55.0604 14.4386 62 22.999 62C31.5594 62 38.499 55.0604 38.499 46.5V36.5Z" />
                                            <path d="M74.499 28.5C74.499 19.3873 67.1117 12 57.999 12C48.8863 12 41.499 19.3873 41.499 28.5V38.5C41.499 47.6127 48.8863 55 57.999 55C67.1117 55 74.499 47.6127 74.499 38.5V28.5Z" />
                                            <path d="M110.499 28.5C110.499 19.3873 103.112 12 93.999 12C84.8863 12 77.499 19.3873 77.499 28.5V38.5C77.499 47.6127 84.8863 55 93.999 55C103.112 55 110.499 47.6127 110.499 38.5V28.5Z" />
                                            <path d="M146.499 23.5C146.499 14.3873 139.112 7 129.999 7C120.886 7 113.499 14.3873 113.499 23.5V38.5C113.499 47.6127 120.886 55 129.999 55C139.112 55 146.499 47.6127 146.499 38.5V23.5Z" />
                                            <path d="M172.499 0H169.499C158.453 0 149.499 8.9543 149.499 20V42C149.499 53.0457 158.453 62 169.499 62H172.499C183.545 62 192.499 53.0457 192.499 42V20C192.499 8.9543 183.545 0 172.499 0Z" />
                                        </svg>
                                    </div>
                                    <span class="uppercase font-berkeley-uc-black text-3xl text-blue-50">Shiso</span>
                            </button>
                                </span>
                    </div>
                    <div class="flex flex-1 flex-col overflow-y-auto p-4 [&amp;>[data-slot=section]+[data-slot=section]]:mt-8">
                        <div data-slot="section" class="flex flex-col gap-0.5">
                            <span class="relative">
                                <? if (is_request_uri(full_path_to_dir('/kanri/'))) { ?> <span class="absolute inset-y-2 -left-4 w-0.5 rounded-full bg-blue-50 dark:bg-white" style="opacity: 1;"></span> <? }; ?>
                                <a class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left
                                          sm:py-2 sm:text-sm hover:bg-blue-900 <? if (is_request_uri(full_path_to_dir('/kanri/'))) { ?> text-blue-50 <? }; ?>"
                                   href="/kanri">
                                    <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                    <svg class="hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="truncate">Home</span>
                                </a>
                            </span>
                            <? $navigation_item = function() use ($kanri_dir) {
                                if ($handle = opendir($kanri_dir)) {
                                    while (false !== ($entry = readdir($handle))) {
                                        $previous_cwd = getcwd();
                                        chdir($kanri_dir);
                                        if (is_dir($entry) && $entry != "." && $entry != "..") { ?>
                                <span class="relative">
                                    <? if (is_request_uri(kanri_path($entry))) { ?> <span class="absolute inset-y-2 -left-4 w-0.5 rounded-full bg-blue-50 dark:bg-white" style="opacity: 1;"></span> <? }; ?>
                                    <a class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left
                                              sm:py-2 sm:text-sm hover:bg-blue-900 <? if (is_request_uri(kanri_path($entry))) { ?> text-blue-50 <? }; ?>"
                                       type="button"  href="/kanri/<?= $entry ?>">
                                        <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                        <svg class="hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="truncate"><?= $entry ?></span>
                                    </a>
                                </span>
                            <? };
                            chdir($previous_cwd);
                            };};};
                            $navigation_item(); ?>
                        </div>

                        <div aria-hidden="true" class="mt-8 flex-1"></div>
                        <div data-slot="section" class="flex flex-col gap-0.5">
                            <span class="relative">
                                <a class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left text-base/6  text-blue-50 sm:py-2 sm:text-sm/5 *:data-[slot=icon]:size-6 *:data-[slot=icon]:shrink-0 *:data-[slot=icon]:fill-blue-500 sm:*:data-[slot=icon]:size-5 *:last:data-[slot=icon]:ml-auto *:last:data-[slot=icon]:size-5 sm:*:last:data-[slot=icon]:size-4 *:data-[slot=avatar]:-m-0.5 *:data-[slot=avatar]:size-7 *:data-[slot=avatar]:[--ring-opacity:10%] sm:*:data-[slot=avatar]:size-6 data-hover:bg-blue-50/5 data-hover:*:data-[slot=icon]:fill-blue-50 data-active:bg-blue-50/5 data-active:*:data-[slot=icon]:fill-blue-50 data-current:*:data-[slot=icon]:fill-blue-50 dark:text-white dark:*:data-[slot=icon]:fill-blue-400 dark:data-hover:bg-white/5 dark:data-hover:*:data-[slot=icon]:fill-white dark:data-active:bg-white/5 dark:data-active:*:data-[slot=icon]:fill-white dark:data-current:*:data-[slot=icon]:fill-white" type="button"  href="#">
                                    <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="truncate">Support</span>
                                </a>
                            </span>
                            <span class="relative">
                                <a class="flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left text-base/6  text-blue-50 sm:py-2 sm:text-sm/5 *:data-[slot=icon]:size-6 *:data-[slot=icon]:shrink-0 *:data-[slot=icon]:fill-blue-500 sm:*:data-[slot=icon]:size-5 *:last:data-[slot=icon]:ml-auto *:last:data-[slot=icon]:size-5 sm:*:last:data-[slot=icon]:size-4 *:data-[slot=avatar]:-m-0.5 *:data-[slot=avatar]:size-7 *:data-[slot=avatar]:[--ring-opacity:10%] sm:*:data-[slot=avatar]:size-6 data-hover:bg-blue-50/5 data-hover:*:data-[slot=icon]:fill-blue-50 data-active:bg-blue-50/5 data-active:*:data-[slot=icon]:fill-blue-50 data-current:*:data-[slot=icon]:fill-blue-50 dark:text-white dark:*:data-[slot=icon]:fill-blue-400 dark:data-hover:bg-white/5 dark:data-hover:*:data-[slot=icon]:fill-white dark:data-active:bg-white/5 dark:data-active:*:data-[slot=icon]:fill-white dark:data-current:*:data-[slot=icon]:fill-white" type="button"  href="#">
                                    <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path d="M15.98 1.804a1 1 0 0 0-1.96 0l-.24 1.192a1 1 0 0 1-.784.785l-1.192.238a1 1 0 0 0 0 1.962l1.192.238a1 1 0 0 1 .785.785l.238 1.192a1 1 0 0 0 1.962 0l.238-1.192a1 1 0 0 1 .785-.785l1.192-.238a1 1 0 0 0 0-1.962l-1.192-.238a1 1 0 0 1-.785-.785l-.238-1.192ZM6.949 5.684a1 1 0 0 0-1.898 0l-.683 2.051a1 1 0 0 1-.633.633l-2.051.683a1 1 0 0 0 0 1.898l2.051.684a1 1 0 0 1 .633.632l.683 2.051a1 1 0 0 0 1.898 0l.683-2.051a1 1 0 0 1 .633-.633l2.051-.683a1 1 0 0 0 0-1.898l-2.051-.683a1 1 0 0 1-.633-.633L6.95 5.684ZM13.949 13.684a1 1 0 0 0-1.898 0l-.184.551a1 1 0 0 1-.632.633l-.551.183a1 1 0 0 0 0 1.898l.551.183a1 1 0 0 1 .633.633l.183.551a1 1 0 0 0 1.898 0l.184-.551a1 1 0 0 1 .632-.633l.551-.183a1 1 0 0 0 0-1.898l-.551-.184a1 1 0 0 1-.633-.632l-.183-.551Z"></path>
                                    </svg>
                                    <span class="truncate">Changelog</span>
                                </a>
                            </span>
                        </div>
                        <div class="max-lg:hidden flex flex-col border-t border-blue-50/5 p-4 dark:border-white/5 [&amp;>[data-slot=section]+[data-slot=section]]:mt-2.5">
                            <span class="relative">
                                <button id="headlessui-menu-button-:R7pja:" type="button" aria-haspopup="menu" aria-expanded="false"  class="cursor-default flex w-full items-center gap-3 rounded-lg px-2 py-2.5 text-left text-base/6  text-blue-50 sm:py-2 sm:text-sm/5 *:data-[slot=icon]:size-6 *:data-[slot=icon]:shrink-0 *:data-[slot=icon]:fill-blue-500 sm:*:data-[slot=icon]:size-5 *:last:data-[slot=icon]:ml-auto *:last:data-[slot=icon]:size-5 sm:*:last:data-[slot=icon]:size-4 *:data-[slot=avatar]:-m-0.5 *:data-[slot=avatar]:size-7 *:data-[slot=avatar]:[--ring-opacity:10%] sm:*:data-[slot=avatar]:size-6 data-hover:bg-blue-50/5 data-hover:*:data-[slot=icon]:fill-blue-50 data-active:bg-blue-50/5 data-active:*:data-[slot=icon]:fill-blue-50 data-current:*:data-[slot=icon]:fill-blue-50 dark:text-white dark:*:data-[slot=icon]:fill-blue-400 dark:data-hover:bg-white/5 dark:data-hover:*:data-[slot=icon]:fill-white dark:data-active:bg-white/5 dark:data-active:*:data-[slot=icon]:fill-white dark:data-current:*:data-[slot=icon]:fill-white">
                                    <span class="absolute top-1/2 left-1/2 size-[max(100%,2.75rem)] -translate-x-1/2 -translate-y-1/2 [@media(pointer:fine)]:hidden" aria-hidden="true"></span>
                                    <span class="flex min-w-0 items-center gap-3">
                                        <span data-slot="avatar" class="size-10 inline-grid shrink-0 align-middle [--avatar-radius:20%] [--ring-opacity:20%] *:col-start-1 *:row-start-1 outline -outline-offset-1 outline-black/(--ring-opacity) dark:outline-white/(--ring-opacity) rounded-(--avatar-radius) *:rounded-(--avatar-radius)">
                                            <img class="size-full" src="<?= asset("/social-media-headshot.png") ?>" alt="">
                                        </span>
                                        <span class="min-w-0">
                                            <!-- <span class="block truncate text-sm/5  text-blue-50 dark:text-white">Erica</span> -->
                                            <span class="block truncate text-xs/5 font-normal text-blue-500 dark:text-blue-400"><?= $_SESSION['email']; ?></span></span></span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                                <path fill-rule="evenodd" d="M11.78 9.78a.75.75 0 0 1-1.06 0L8 7.06 5.28 9.78a.75.75 0 0 1-1.06-1.06l3.25-3.25a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd"></path>
                                            </svg>
                                </button>
                            </span>
                        </div>
                </nav>
                    </div>
<? };

function sidebar_end() { ?>
            </div>
        </div>
<? };

function page_head($title = "Write a title for this page", $show_sidebar = true) { ?>
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
             /* @source "/assets/js/web-components.js"; */
             /* @custom-variant dark (&:where(.dark, .dark *)); */
             @theme {
                 --font-berkeley-uc-thin: "Berkeley Mono Thin UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc: "Berkeley Mono UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc-medium: "Berkeley Mono Medium UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-uc-black: "Berkeley Mono ExtraBold UltraCondensed", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-black: "Berkeley Mono ExtraBold", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-thin: "Berkeley Mono Thin", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley: "Berkeley Mono", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --font-berkeley-medium: "Berkeley Mono Medium", ui-monospace, 'Cascadia Code', 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
                 --drop-shadow-px: 2px 2px 0px var(--color-blue-100);
                 --main-color: var(--color-blue-900);
                 --danger-color: var(--color-rose-900);
             }
            </style>
        </head>
        <body class="font-berkeley">
            <? if ($show_sidebar) {
                sidebar_start();
            };
            };

            function page_foot($show_sidebar = true) {
                if ($show_sidebar) { sidebar_start(); }; ?>
        </body>
    </html>
<? };

function form_field_id($field_name) {
    return "id_".$field_name;
};

function shiso_input($name, $type, $id = null, $value = null, $override = null) { ?>
    <div class="has-focus:ring has-focus:ring-emerald-800 rounded-xs">
        <div class="<?= $override; ?> has-focus:bg-(--main-color) inset-ring-transparent pt-1 inset-ring-3 has-focus:inset-ring-(--main-color) rounded-xs has-focus:shadow-md has-focus:shadow-cyan-600/50">
            <label>
                <fieldset class="group border-3 border-(--main-color) rounded-xs has-focus:border-transparent">
                    <legend class="ml-[1ch] px-[1ch] text-(--main-color) group-has-focus:text-blue-50 font-berkeley-black uppercase">
                        :<?= $legend ?? $name ?>
                    </legend>
                    <? if ($type != "select") { ?>
                        <input id="<?= $id ?? form_field_id($name); ?>"
                               name="<?= $name ?>"
                               type="<?= $type ?>" value="<? if ($value) { echo htmlspecialchars($value); }; ?>"
                               class="text-sm text-blue-950 focus:text-blue-50 pl-[2ch] pb-[1ch] w-full focus:outline-none" />
                    <? } else { ?>
                        <select id="<?= $id ?? form_field_id($name) ?>" name="<?= $name ?>"
                                class="">
                            <option value="">
                                Test
                            </option>
                        </select>
                    <? }; ?>
                </fieldset>
            </label>
        </div>
    </div>
<? };

function shiso_fieldset($legend) { ?>
    <fieldset>
        <legend>
            <?= $legend ?>
        </legend>
    </fieldset>
<?  };
