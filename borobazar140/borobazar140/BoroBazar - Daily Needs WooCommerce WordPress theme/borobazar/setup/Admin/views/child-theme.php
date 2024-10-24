<?php
$slug = apply_filters('rsw/child_theme_slug', '');
$theme = $this->get_theme_info();
$child_theme = $this->is_child_theme_active();
$class = $child_theme ? 'disabled' : '';
?>
<div class="redq-setup-wizard-child-theme h-full flex flex-col justify-center items-center">
    <h2 class="text-lg sm:text-xl lg:text-2xl text-black font-semibold mb-6 text-center md:text-start"><?php esc_html_e('Activate Borobazar Child Theme', 'borobazar'); ?></h2>
    <p class="mb-5 text-sm"> <?php echo esc_html__('You can skip this step if you\'ve already installed or made changes to the child theme', 'borobazar'); ?> </p>
    <button <?php echo esc_attr($class); ?> class="rsw-child-theme-activate px-4 flex items-center justify-center active:scale-95 transition-transform duration-200 rounded-md bg-[#02b290] max-w-[400px] h-14 w-full text-base text-white font-medium focus:text-white disabled:opacity-20 disabled:cursor-not-allowed disabled:active:scale-100" <? echo esc_attr(($slug == $theme->get('Name')) ? 'disabled="="disabled"' : ''); ?>>
        <?php esc_html_e('Install Child Theme', 'borobazar'); ?>
        <?php $this->loader(); ?>
    </button>
    <span class="text-[#36B779] mt-2 text-sm font-normal block">
        <?php
        if ($child_theme) {
            esc_html_e('Child Theme already installed & activated.', 'borobazar');
        }
        ?>
    </span>
</div>