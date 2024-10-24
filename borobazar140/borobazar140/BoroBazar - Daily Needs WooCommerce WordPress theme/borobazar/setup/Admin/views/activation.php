<?php
$link =  apply_filters('envato_license_key_link', 'https://wordpress-rental-booking-doc.vercel.app/envato-licence');
?>

<div class="redq-setup-wizard-activation-data h-full flex items-center justify-center text-center">
    <div class="redq-setup-wizard-activation-form grow">
        <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold text-black mb-6"><?php esc_html_e('License Status', 'borobazar'); ?>:
            <?php if ($purchase_code && $activation_status) : ?>
                <span class="text-[#02b290]"><?php esc_html_e('Active', 'borobazar'); ?></span>
            <?php else : ?>
                <span class="text-red-500"><?php esc_html_e('Inactive', 'borobazar'); ?></span>
            <?php endif; ?>
        </h2>

        <p class="mb-5 text-sm"> <?php echo sprintf(__('To obtain the license key, kindly proceed by <a class="underline text-black font-medium" target="_blank" href="%s"> following this link </a>.', 'borobazar'), $link); ?> </p>

        <form class="license-activation-form flex flex-col xl:flex-row items-center gap-4 justify-center" method="post">
            <input placeholder="<?php esc_attr_e('Theme purchase code.', 'borobazar'); ?>" class="license-key" type="text" name="license_key" value="<?php echo esc_attr($purchase_code); ?>" required="" <?php echo esc_attr($activation_status ? 'readonly' : ''); ?> >
            <?php if ($purchase_code && $activation_status) : ?>
                <input type="hidden" name="deactivate" value="1">
                <button type="submit" class="w-full px-4 flex items-center justify-center active:scale-95 transition-transform duration-200 rounded-md bg-[#02b290] xl:max-w-[233px] h-14  text-base text-white font-medium focus:text-white">
                    <?php esc_html_e('Deactivate', 'borobazar'); ?>
                    <?php $this->loader(); ?>
                </button>
            <?php else : ?>
                <button type="submit" class="px-4 flex items-center justify-center active:scale-95 transition-transform duration-200 rounded-md bg-[#02b290] xl:max-w-[233px] h-14 w-full text-base text-white font-medium focus:text-white">
                    <?php esc_html_e('Activate', 'borobazar'); ?>
                    <?php $this->loader(); ?>
                </button>
            <?php endif; ?>
        </form>
    </div>
</div>