<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

$siteLogo = get_theme_mod('custom_logo');
$authCoverImage = '';
if (function_exists('borobazar_global_option_data')) {
    $authCoverImage = borobazar_global_option_data('borobazar_auth_cover_image', '');
}

$authWrapper = 'with-cover-image';
if ($authCoverImage === '') {
    $authWrapper = 'without-cover-image';
}

?>

<div class="borobazar-auth-wrapper <?php echo esc_attr($authWrapper); ?> m-auto flex sm:bg-white sm:shadow-sm sm:border sm:border-main sm:rounded-md">
    <?php if (isset($authCoverImage) && $authCoverImage !== '') { ?>
        <div class="borobazar-auth-media hidden lg:block max-w-md xl:max-w-xl 2xl:max-w-2xl w-full relative bg-base">
            <img class="w-full h-full absolute left-0 bottom-0 object-cover" width="700" height="617" src="<?php echo esc_url($authCoverImage); ?>" alt="<?php echo esc_attr__('Auth', 'borobazar'); ?>">
        </div>
        <!-- End of auth media -->
    <?php } ?>

    <div class="borobazar-auth-form self-center flex-1 px-2 sm:p-16">
        <div class="borobazar-auth-header text-center mb-9">
            <div class="site-branding">
                <?php
                if (!empty($siteLogo)) {
                    the_custom_logo();
                } else { ?>
                    <div class="site-text-logo flex flex-col">
                        <h2 class="site-title text-xl m-0">
                            <a class="no-underline" href="<?php echo esc_url(home_url('/')); ?>" rel="<?php echo esc_attr__('home', 'borobazar'); ?>">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h2>
                    </div>
                <?php } ?>
            </div>

            <h2 class="mt-4 mb-3"><?php esc_html_e('Lost your password?', 'borobazar'); ?></h2>
            <p class="m-0"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Please enter your username or email address. You will receive a link to create a new password via email.', 'borobazar')); ?></p><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                        ?>
        </div>
        <!-- End of auth header -->

        <?php do_action('woocommerce_before_lost_password_form'); ?>
        <form method="post" class="woocommerce-ResetPassword lost_reset_password">

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="user_login"><?php esc_html_e('Username or email', 'borobazar'); ?></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
            </p>

            <div class="clear"></div>

            <?php do_action('woocommerce_lostpassword_form'); ?>

            <p class="woocommerce-form-row form-row">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit" class="woocommerce-Button button w-full justify-center" value="<?php esc_attr_e('Reset password', 'borobazar'); ?>"><?php esc_html_e('Reset password', 'borobazar'); ?></button>
            </p>

            <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

        </form>
        <!-- End of lost password form -->

        <?php do_action('woocommerce_after_lost_password_form'); ?>
    </div>
    <!-- End of auth form -->
</div>
<!-- End of auth wrapper -->