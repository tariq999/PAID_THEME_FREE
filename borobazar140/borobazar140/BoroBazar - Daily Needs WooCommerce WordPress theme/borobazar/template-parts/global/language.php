<?php
$allowedHTML       = wp_kses_allowed_html('post');
$args              = borobazar_get_multi_lang_args();
$languages         = $args['languages'];
$activeLanguage    = $args['active_language'];
$inactiveLanguages = $args['inactive_languages'];
$displayAs         = $args['display_as'];

?>

<div class="flex-1 flex items-start justify-end">
    <div class="borobazar-language-switcher relative">
        <span class="borobazar-active-lang inline-flex items-center cursor-pointer transition-colors duration-200 hover:text-main">
            <?php if ($activeLanguage['display_as'] !== 'country_flag_url') : ?>
                <span class="text-selection-none">
                    <?php echo wp_kses($activeLanguage[$displayAs], $allowedHTML); ?>
                </span>
            <?php else : ?>
                <img class="text-selection-none" src="<?php echo esc_url($activeLanguage['country_flag_url']); ?>">
            <?php endif; ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 md:h-[15px] w-3.5 md:w-[15px] ml-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path class="transition-all duration-200" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </span>
        <?php if (!empty($inactiveLanguages)) { ?>
            <ul class="borobazar-language-switcher-list <?php echo esc_attr($activeLanguage['display_as']); ?> opacity-0 invisible list-none m-0 mb-1.5 md:mb-2 px-0 py-2.5 w-40 border border-lighter bg-white grid gap-0.5 rounded shadow-dropdown absolute right-0 bottom-full z-1 transition-opacity duration-200">
                <?php foreach ($inactiveLanguages as $key => $language) : ?>
                    <li class="block">
                        <a class="flex items-center gap-1.5 no-underline py-1 px-4 transition-colors duration-200 hover:bg-lighter focus:bg-lighter hover:text-main focus:text-main" href="<?php echo esc_url($language['url']); ?>">
                            <?php if ($language['display_as'] !== 'country_flag_url') : ?>
                                <?php echo wp_kses($language[$displayAs], $allowedHTML); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url($language['country_flag_url']); ?>">
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php } ?>
    </div>
</div>
<!-- end of language switcher -->