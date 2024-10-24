<div class="redq-setup-steps-wrapper hidden md:self-start md:grid md:grid-cols-1 md:gap-20 md:col-span-4 xl:col-span-3 3xl:col-span-2 md:row-span-full">
    <?php $i = 1; foreach (self::$steps as $step_key => $step): ?>
        <div class="redq-setup-basic-item flex items-start gap-4 <?php echo $this->html_class($step_key); ?>">
            <div class="redq-setup-basic-status-icon w-8 h-8 overflow-hidden">
                <?php echo $this->load_icons($step_key); ?>
            </div>
            <div class="redq-setup-basic-infos">
                <p class="step-count text-xs text-[#929292] font-medium mb-1 uppercase"><?php echo sprintf( __( 'Step %1$d', 'borobazar'), $i ); ?></p>
                <a href="<?php echo esc_url( add_query_arg( [ 'step' => esc_attr( $step_key )], self::wizard_url() ) ); ?>" class="text-base lg:text-lg text-black font-medium mb-2 capitalize block hover:text-black hover:underline focus:shadow-none"><?php echo esc_html($step['label']); ?></a>
                <p class="step-status text-sm text-[#727272] font-medium capitalize"><?php echo $this->sub_text($step_key); ?></p>
            </div>
        </div>
    <?php $i++; endforeach; ?>
</div>