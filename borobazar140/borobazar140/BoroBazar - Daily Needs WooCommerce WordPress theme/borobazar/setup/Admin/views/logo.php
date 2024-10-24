 <!-- LOGO -->
 <div class="borobazar-getting-started-logo-wrapper">
     <div class="borobazar-logo">
        <img src="<?php echo esc_url(get_theme_file_uri('/assets/admin/images/main-logo.svg')); ?>" alt="<?php echo esc_attr($theme->Name); ?>">
        <sup class="text-black">
         <?php
         echo esc_html__('v.', 'borobazar');
         echo apply_filters('borobazar_version_getting_started', BOROBAZAR_VERSION);
         ?>
         </sup>
    </div>
</div>