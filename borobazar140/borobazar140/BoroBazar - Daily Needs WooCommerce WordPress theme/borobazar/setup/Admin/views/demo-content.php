<?php
$import_ready = $this->get_required_plugins_for_demo_data();
//_log($import_ready);
$theme = wp_get_theme();
$btn_class = $import_ready ? 'active' : 'disabled';
?>

<div class="redq-setup-wizard-welcome">
    <h3 class="text-lg sm:text-xl lg:text-2xl text-black font-semibold mb-6"><?php esc_html_e('Demo Content', 'borobazar');?></h3>

    <?php if (!$import_ready): ?>
        <p class="install-required-plugins inline-flex gap-2 items-center p-4 border border-[#ee0000] border-l-8 rounded-md mb-6 text-sm font-normal text-black">
            <span class="inline-block text-[#ee0000]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                </svg>
            </span>
            <?php echo esc_html__('Please install the mandatory plugins before you start importing the demo data', 'borobazar'); ?>
        </p>
    <?php endif;?>

    <?php $demo_list = apply_filters('ocdi/import_files', array());
          if (!empty($demo_list)):
    ?>
        <div class="ocdi__gl  js-ocdi-gl">
            <div class="ocdi__gl-item-container js-ocdi-gl-item-container w-full sm:grid-cols-2 md:grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-8">
                <?php foreach ($demo_list as $index => $import_file): ?>
                    <?php
                        $img_src = isset($import_file['import_preview_image_url']) ? $import_file['import_preview_image_url'] : '';
                        if (empty($img_src)) {
                            $theme = wp_get_theme();
                            $img_src = $theme->get_screenshot();
                        }
                    ?>
                    <div class="ocdi__gl-item js-ocdi-gl-item" data-name="<?php echo esc_attr(strtolower($import_file['import_file_name'])); ?>">
                        <div class="ocdi__gl-item-image-container">
                            <?php if (!empty($img_src)): ?>
                                <img class="ocdi__gl-item-image" src="<?php echo esc_url($img_src) ?>">
                            <?php else: ?>
                                <div class="ocdi__gl-item-image  ocdi__gl-item-image--no-image"><?php esc_html_e('No preview image.', 'borobazar');?></div>
                            <?php endif;?>
                            <div class="loader-container absolute inset-0 bg-gray-300/50 hidden justify-center items-center">
                                <span class="inline-block w-8 h-8 border-4 rounded-full border-black border-r-black border-b-black border-t-black border-l-transparent animate-spin"></span>
                            </div>
                        </div>
                        <div class="ocdi__gl-item-footer relative<?php echo !empty($import_file['preview_url']) ? '  ocdi__gl-item-footer--with-preview' : ''; ?>">
                            <h4 class="ocdi__gl-item-title mt-2 text-center text-base text-black font-medium" title="<?php echo esc_attr($import_file['import_file_name']); ?>"><?php echo esc_html($import_file['import_file_name']); ?></h4>
                            <div class="ocdi__gl-item-buttons">
                                <?php if (!empty($import_file['preview_url'])): ?>
                                    <a class="ocdi__gl-item-button  button" href="<?php echo esc_url($import_file['preview_url']); ?>" target="_blank"><?php esc_html_e('Preview Demo', 'borobazar');?></a>
                                <?php endif;?>
                                <a class="ocdi__gl-item-button  button  bg-[#02b290] button-primary rsw-import-demo-content <?php echo esc_attr($btn_class); ?> " href="#" data-demo="<?php echo esc_attr($index); ?>"><?php esc_html_e('Import Demo', 'borobazar');?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    <?php else: ?>
        <p><?php echo wp_kses_post('Uae the following filter to list of demo data. <br/> \'ocdi/import_files\'', 'borobazar'); ?></p>
    <?php endif;?>
</div>