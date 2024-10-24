<?php
$steps = array_keys(self::$steps);
if (self::$step == end($steps)) {
    return;
}

$purchase_code     = get_option('rsw_purchase_code', '');
$activation_status = get_option('rsw_activation_status', false);
$required_steps    = get_option('rsw_required_steps', []);

$quick_links = $this->get_quick_links();
?>
<div class="redq-setup-wizard-navigation mt-10 md:mt-0 md:pl-5 md:col-span-8 xl:col-span-9 3xl:col-span-10 flex flex-col xl:flex-row xl:justify-between gap-10 justify-center items-center xl:self-end xl:gap-5 md:row-start-2 md:row-end-3">

    <div class="flex items-center gap-14">
        <?php foreach ($quick_links as $link) : ?>
            <a href="<?php echo esc_url($link['link']); ?>" target="_blank" class="inline-block hover:underline text-sm md:text-base text-black font-medium hover:text-black">
                <?php echo esc_attr($link['title']); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="flex items-center gap-4">
        <?php if (self::$step != reset($steps)) : ?>
            <a class="prev text-sm md:text-base font-medium text-black bg-[#F1F1F1] rounded-md px-4 py-2.5 md:px-7 md:py-4 inline-flex items-center hover:text-black gap-3 focus:outline-none border-none focus:text-black active:scale-95 transition-transform duration-200 hover:shadow-md focus:shadow-none" href="<?php echo esc_url($this->prev_step_link()); ?>">
                <span class="dashicons dashicons-arrow-left-alt"></span>
                <?php esc_html_e('Back', 'borobazar'); ?>
            </a>
        <?php endif; ?>
        <a href="<?php echo esc_url($this->next_step_link()); ?>" class="next text-sm md:text-base font-medium text-white bg-[#02b290] rounded-md px-4 py-2.5 md:px-7 md:py-4 inline-flex items-center hover:text-white gap-3 focus:outline-none border-none focus:text-white active:scale-95 transition-transform duration-200 hover:shadow-md focus:shadow-none <?php echo (in_array(self::$step, $required_steps) && (!$purchase_code && !$activation_status)) ? 'disabled' : ''; ?>">
            <?php esc_html_e('Next', 'borobazar'); ?>
            <span class="dashicons dashicons-arrow-right-alt"></span>
        </a>
    </div>
</div>