<div class="redq-setup-wizard-plugins">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg sm:text-xl lg:text-2xl text-black font-semibold"><?php esc_html_e('Required Plugins', 'borobazar'); ?></h3>

        <?php
            $active_plugins   = apply_filters('active_plugins', get_option('active_plugins'));
            $required_plugins = array_column($plugins, 'base');
        ?>
        <button class="rsw-plugin-activate-all flex items-center justify-center px-4 sm:px-5 py-2 rounded-md bg-[#02b290] focus:border-none active:scale-95 transition-transform duration-200 text-white text-sm sm:text-base font-medium !opacity-100 disabled:cursor-not-allowed disabled:active:scale-100 <?php echo esc_attr((count(array_intersect($required_plugins, $active_plugins)) === count($required_plugins)) ? 'activated' : ''); ?>" <?php echo esc_attr((count(array_intersect($required_plugins, $active_plugins)) === count($required_plugins)) ? 'disabled' : ''); ?>>
            <?php if(count(array_intersect($required_plugins, $active_plugins)) === count($required_plugins)): ?>
                <?php esc_html_e('All Plugins Installed', 'borobazar'); ?>
            <?php else: ?>
                <?php esc_html_e('Install All Plugins', 'borobazar'); ?>
            <?php endif; ?>
            <?php $this->loader(); ?>
        </button>
    </div>

    <?php if (!empty($plugins)): ?>
        <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 3xl:grid-cols-4 gap-6">
            <?php foreach ($plugins as $plugin): ?>

                <li class="p-6 border border-[#F0F3F4] shadow-card-shadow text-center rounded-lg flex flex-col">
                    <figure class="max-w-[100px] w-full mx-auto grow flex items-center">
                        <img src="<?php echo esc_url(!empty($plugin['image_url']) ? $plugin['image_url'] : ''); ?>" alt="plugin logo" class="w-full h-auto" >
                    </figure>
                    <h4 class="text-base text-black font-medium my-6"><?php echo $plugin['name']; ?></h4>
                    <button class="rsw-plugin-activate flex items-center justify-center text-sm text-white py-2.5 active:scale-95 transition-transform duration-200 font-medium w-full bg-[#02b290] rounded-md focus:border-none disabled:opacity-40 disabled:cursor-not-allowed disabled:active:scale-100 <?php echo esc_attr(in_array($plugin['base'], apply_filters('active_plugins', get_option('active_plugins'))) ? 'activated' : ''); ?>" data-type="<?php echo esc_attr(!empty($plugin['source']) ? 'self' : 'wporg'); ?>" data-slug="<?php echo esc_attr(!empty($plugin['slug']) ? $plugin['slug'] : ''); ?>" data-base="<?php echo esc_attr(!empty($plugin['base']) ? $plugin['base'] : ''); ?>" data-url="<?php echo esc_attr(!empty($plugin['source']) ? $plugin['source'] : ''); ?>" <?php echo esc_attr(in_array($plugin['base'], apply_filters('active_plugins', get_option('active_plugins'))) ? 'disabled' : ''); ?>>
                        <?php echo esc_html_e(in_array($plugin['base'], apply_filters('active_plugins', get_option('active_plugins'))) ? 'Installed' : 'Install', 'borobazar'); ?>
                        <?php $this->loader(); ?>
                    </button>
                </li>

            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><?php esc_html_e('No Plugins found.', 'borobazar'); ?></p>
    <?php endif; ?>
</div>