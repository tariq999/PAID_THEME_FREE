<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

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


<div class="borobazar-auth-wrapper <?php echo esc_attr($authWrapper); ?> m-auto flex sm:bg-white sm:shadow-sm sm:border sm:border-main sm:rounded-md overflow-hidden">
    <?php if (isset($authCoverImage) && $authCoverImage !== '') { ?>
        <div class="borobazar-auth-media hidden lg:block max-w-md xl:max-w-xl 2xl:max-w-2xl w-full relative bg-base">
            <img class="w-full h-full absolute left-0 bottom-0 object-cover" width="700" height="617" src="<?php echo esc_url($authCoverImage); ?>" alt="<?php echo esc_attr__('Auth', 'borobazar'); ?>">
        </div>
        <!-- End of auth media -->
    <?php } ?>

    <div class="borobazar-auth-form self-center flex-1 px-2 sm:p-10 lg:p-12 xl:p-14 2xl:p-16">
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
            <!-- end of logo -->

            <h2 class="borobazar-login-el mt-4 mb-3"><?php esc_html_e('Welcome Back, Get Login', 'borobazar'); ?></h2>
            <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                <h2 class="borobazar-register-el mt-4 mb-3 hidden"><?php esc_html_e('Create Account for Free', 'borobazar'); ?></h2>
            <?php endif; ?>
            <!-- end of title -->

            <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                <p class="borobazar-register-el m-0 hidden"><?php esc_html_e('Join us anytime. Already have an account?', 'borobazar') ?> <button class="borobazar-handle-login-auth p-0 border-0 bg-transparent cursor-pointer font-medium text-brand hover:text-brand-hover-hover hover:underline focus:text-brand-hover-hover focus:underline"><?php esc_html_e('Sign in now', 'borobazar'); ?></button></p>
                <p class="borobazar-login-el m-0"><?php esc_html_e('Join us anytime. Don’t have an account?', 'borobazar') ?> <button class="borobazar-handle-register-auth p-0 border-0 bg-transparent cursor-pointer font-medium text-brand hover:text-brand-hover-hover hover:underline focus:text-brand-hover-hover focus:underline"><?php esc_html_e('Create account', 'borobazar'); ?></button></p>
            <?php endif; ?>
            <!-- end of description -->
        </div>
        <!-- End of auth header -->

        <?php do_action('woocommerce_before_customer_login_form'); ?>

        <form class="borobazar-login-el woocommerce-form woocommerce-form-login login" method="post">
            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="username"><?php esc_html_e('Username or email address', 'borobazar'); ?>&nbsp;<span class="required">*</span></label>
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                            ?>
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="password"><?php esc_html_e('Password', 'borobazar'); ?>&nbsp;<span class="required">*</span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>

            <p class="grid grid-cols-2 items-center">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'borobazar'); ?></span>
                </label>

                <a class="woocommerce-LostPassword lost_password justify-self-end no-underline font-medium text-brand hover:text-brand-hover-hover hover:underline focus:text-brand-hover-hover focus:underline" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'borobazar'); ?></a>
            </p>

            <p class="form-row">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Log in', 'borobazar'); ?>"><?php esc_html_e('Log in', 'borobazar'); ?></button>
            </p>

            <!-- Start fire auth login -->
            <?php
            if (shortcode_exists('firebase_otp_login')) {
            ?>
                <div class="text-center mb-4 flex items-center justify-center text-lightest">
                    <span class="w-9 h-[1px] bg-gray-300"></span>
                    <span class="mx-2"><?php esc_html_e('Or', 'borobazar'); ?></span>
                    <span class="w-9 h-[1px] bg-gray-300"></span>
                </div>
                <div class="borobazar-fire-auth-wrapper">
                    <?php echo do_shortcode('[firebase_otp_login]'); ?>
                </div>
            <?php
            }
            ?>
            <!-- End fire auth login -->

            <!-- Start nextend login -->
            <?php
            if (shortcode_exists('nextend_social_login')) {
            ?>
                <div class="borobazar-nextend-wrapper">
                    <!-- Start Social Login -->
                    <?php echo do_shortcode('[nextend_social_login]'); ?>
                    <!-- End Social Login -->
                </div>
            <?php
            }
            ?>
            <!-- End nextend login -->


            <?php do_action('woocommerce_login_form_end'); ?>

        </form>
        <!-- End of auth login form -->

        <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
            <form method="post" class="borobazar-register-el woocommerce-form woocommerce-form-register register hidden" <?php do_action('woocommerce_register_form_tag'); ?>>
                <?php do_action('woocommerce_register_form_start'); ?>

                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_username"><?php esc_html_e('Username', 'borobazar'); ?>&nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" /><?php // @codingStandardsIgnoreLine 
                                                                                                                                                                                                                                                                        ?>
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php esc_html_e('Email address', 'borobazar'); ?>&nbsp;<span class="required">*</span></label>
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
                    <?php // @codingStandardsIgnoreLine 
                    ?>
                </p>

                <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password"><?php esc_html_e('Password', 'borobazar'); ?>&nbsp;<span class="required">*</span></label>
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                    </p>

                <?php else : ?>

                    <p><?php esc_html_e('A password will be sent to your email address.', 'borobazar'); ?></p>

                <?php endif; ?>

                <?php do_action('woocommerce_register_form'); ?>

                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e('Register', 'borobazar'); ?>"><?php esc_html_e('Register', 'borobazar'); ?></button>
                </p>

                <!-- Start fire auth login -->
                <?php
                if (shortcode_exists('firebase_otp_login')) {
                ?>
                    <div class="text-center mb-4 flex items-center justify-center text-lightest">
                        <span class="w-9 h-[1px] bg-gray-300"></span>
                        <span class="mx-2"><?php esc_html_e('Or', 'borobazar'); ?></span>
                        <span class="w-9 h-[1px] bg-gray-300"></span>
                    </div>
                    <div class="borobazar-fire-auth-wrapper">
                        <!-- Start Firebase Login -->
                        <?php echo do_shortcode('[firebase_otp_login]'); ?>
                        <!-- Start Firebase Login -->
                    </div>
                <?php
                }
                ?>
                <!-- End fire auth login -->


                <!-- Start nextend login -->
                <?php
                if (shortcode_exists('nextend_social_login')) {
                ?>
                    <div class="borobazar-nextend-wrapper">
                        <!-- Start Social Login -->
                        <?php echo do_shortcode('[nextend_social_login]'); ?>
                        <!-- End Social Login -->
                    </div>
                <?php
                }
                ?>
                <!-- End nextend login -->


                <?php do_action('woocommerce_register_form_end'); ?>

            </form>
        <?php endif; ?>
        <!-- End of auth registration form -->

        <?php do_action('woocommerce_after_customer_login_form'); ?>
    </div>
    <!-- End of auth form -->
</div>
<!-- End of auth wrapper -->