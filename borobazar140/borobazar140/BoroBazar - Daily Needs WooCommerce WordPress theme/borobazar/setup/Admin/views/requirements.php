<?php
$permalinkActive = get_option('permalink_structure');
$configCompleted = true;
$statusValues = array_column($requirements, 'status');
?>

<div class="turbo-theme-plugins-status-table">

    <div class="grid grid-cols-1 2xl:grid-cols-2 gap-x-10 gap-y-8 mb-8 2xl:mb-12">
        <!-- permalink card  -->
        <div>
            <h3 class="text-base lg:text-lg font-semibold py-3 px-4 rounded-tl-md rounded-tr-md text-black bg-[#f3f4f6]"><?php echo esc_html__('Permalink', 'borobazar'); ?></h3>
            <div class="border border-t-0 border-[#f3f4f6] flex items-start sm:items-center gap-2 p-4 justify-between">
                <span class="inline-block mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M19.902 4.098a3.75 3.75 0 00-5.304 0l-4.5 4.5a3.75 3.75 0 001.035 6.037.75.75 0 01-.646 1.353 5.25 5.25 0 01-1.449-8.45l4.5-4.5a5.25 5.25 0 117.424 7.424l-1.757 1.757a.75.75 0 11-1.06-1.06l1.757-1.757a3.75 3.75 0 000-5.304zm-7.389 4.267a.75.75 0 011-.353 5.25 5.25 0 011.449 8.45l-4.5 4.5a5.25 5.25 0 11-7.424-7.424l1.757-1.757a.75.75 0 111.06 1.06l-1.757 1.757a3.75 3.75 0 105.304 5.304l4.5-4.5a3.75 3.75 0 00-1.035-6.037.75.75 0 01-.354-1z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="me-auto">
                    <h4 class="text-base text-black font-medium mb-1"><?php echo esc_html__('Permalink Setup', 'borobazar'); ?></h4>
                    <p class="text-sm text-black font-normal mb-0"><?php echo esc_html__('Make your site url seo friendly', 'borobazar'); ?></p>
                </div>

                <div class="flex flex-col justify-start items-center">
                    <div class="permalink-status status-column col-span-2 text-center">
                        <?php if (!$permalinkActive) : ?>
                            <span title="Need fixes" class="inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FECF49" class="w-6 h-6 xl:w-8 xl:h-8 drop-shadow-sm">
                                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        <?php else : ?>
                            <span title="All set" class="inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#02BC7D" class="w-6 h-6 xl:w-8 xl:h-8 drop-shadow-sm">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if (!$permalinkActive) : ?>
                        <button class="rsw-set-permalink text-black underline inline-block p-0 bg-transparent text-sm" <?php echo esc_attr($permalinkActive ? "disabled" : ""); ?>>
                            <?php echo esc_html($permalinkActive ? "" : "Active"); ?>
                            <?php $this->loader(); ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- configs card  -->
        <div>
            <h3 class="text-base lg:text-lg font-semibold py-3 px-4 rounded-tl-md rounded-tr-md text-black bg-[#f3f4f6]"><?php echo esc_html__('Configs', 'borobazar'); ?></h3>
            <div class="border border-t-0 border-[#f3f4f6] flex items-start sm:items-center gap-2 p-4 justify-between">
                <span class="inline-block mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M5.507 4.048A3 3 0 017.785 3h8.43a3 3 0 012.278 1.048l1.722 2.008A4.533 4.533 0 0019.5 6h-15c-.243 0-.482.02-.715.056l1.722-2.008z" />
                        <path fill-rule="evenodd" d="M1.5 10.5a3 3 0 013-3h15a3 3 0 110 6h-15a3 3 0 01-3-3zm15 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm2.25.75a.75.75 0 100-1.5.75.75 0 000 1.5zM4.5 15a3 3 0 100 6h15a3 3 0 100-6h-15zm11.25 3.75a.75.75 0 100-1.5.75.75 0 000 1.5zM19.5 18a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="me-auto">
                    <h4 class="text-base text-black font-medium mb-1"><?php echo esc_html__('Server Configuration', 'borobazar'); ?></h4>
                    <p class="text-sm text-black font-normal mb-0"><?php echo esc_html__('Check your server configuration and take step', 'borobazar'); ?></p>
                </div>

                <div class="plugin-status-table-column status-column col-span-2 text-center">
                    <?php if (in_array(false, $statusValues, true)) : ?>
                        <span title="Need fixes" class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FECF49" class="w-6 h-6 xl:w-8 xl:h-8 drop-shadow-sm">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    <?php else : ?>
                        <span title="All set" class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#02BC7D" class="w-6 h-6 xl:w-8 xl:h-8 drop-shadow-sm">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>


    <!-- table with requirements title start  -->
    <h2 class="text-base lg:text-lg text-black font-semibold mb-4"><?php esc_html_e('Configs Requirements', 'borobazar'); ?></h2>

    <div class="plugin-status-table-head grid grid-cols-12 text-sm text-black capitalize font-semibold border border-[#f3f4f6] rounded-tl-md rounded-tr-md bg-[#f3f4f6]">
        <div class="plugin-status-table-column name-column col-span-4 py-4 px-4"><?php echo esc_html__('Config name', 'borobazar'); ?> </div>
        <div class="plugin-status-table-column status-column col-span-3 py-4 px-4"><?php echo esc_html__('Required status', 'borobazar'); ?> </div>
        <div class="plugin-status-table-column status-column col-span-3 py-4 px-4"><?php echo esc_html__('Current status', 'borobazar'); ?> </div>
        <div class="plugin-status-table-column status-column col-span-2 py-4 invisible"> . </div>
    </div>

    <div class="plugin-status-table-body border border-[#f3f4f6]">

        <?php foreach ($requirements as $requirement) : ?>
            <div class="plugin-status-table-row grid grid-cols-12 text-sm xl:text-base text-black font-normal border-t first:border-none border-[#f3f4f6]">
                <div class="plugin-status-table-column name-column col-span-4 py-4 px-4"> <?php echo esc_attr($requirement['title']); ?> </div>
                <div class="plugin-status-table-column status-column col-span-3 py-4 px-4"><?php echo esc_attr($requirement['required']); ?> </div>
                <div class="plugin-status-table-column status-column col-span-3 py-4 px-4">
                    <span class="requirement-success"><?php echo esc_attr($requirement['current']); ?></span>
                </div>
                <div class="plugin-status-table-column status-column col-span-2 py-4 text-center">
                    <?php if (!$requirement['status']) : ?>
                        <span title="Need fixes" class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FECF49" class="w-5 h-5 xl:w-6 xl:h-6 drop-shadow-sm">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    <?php else : ?>
                        <span title="All set" class="inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#02BC7D" class="w-5 h-5 xl:w-6 xl:h-6 drop-shadow-sm">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>