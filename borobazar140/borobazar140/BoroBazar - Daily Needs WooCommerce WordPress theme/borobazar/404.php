<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package borobazar
 */

get_header();


$NotFoundCoverImage = '';
if (function_exists('borobazar_global_option_data')) {
    $NotFoundCoverImage = borobazar_global_option_data('borobazar_not_found_cover_image', '');
}

?>

<main id="primary" class="site-main relative grow flex flex-col justify-center items-center px-4 sm:px-5 py-12 md:py-14 xl:py-16 2xl:py-18 3xl:py-20 4xl:py-24">
    <?php if (isset($NotFoundCoverImage) && $NotFoundCoverImage !== '') { ?>
        <img class="on-load-fade-in hidden absolute inset-0 w-full h-full object-cover z-0" width="1920" height="800" src="<?php echo esc_url($NotFoundCoverImage); ?>" alt="<?php echo esc_attr__('404', 'borobazar'); ?>">
        <!-- end of bg image -->
    <?php } ?>

    <div class="error-404 not-found max-w-lg w-full mx-auto text-center z-1">
        <svg class="w-32 sm:w-36 xl:w-40 h-auto" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M40.1069 127.53C38.2582 131.168 34.4454 133.709 30.0548 133.709C25.6643 133.709 21.8514 131.168 20.0027 127.53H18.7896V128.801C18.7318 134.921 23.8156 140.061 29.9971 140.061C36.1785 140.061 41.2046 135.037 41.2046 128.858C41.2046 135.037 46.2306 140.061 52.412 140.061C58.5935 140.061 63.6196 135.037 63.6196 128.858C63.6196 135.037 68.6456 140.061 74.8271 140.061C81.0085 140.061 86.0346 135.037 86.0346 128.858C86.0346 135.037 91.0606 140.061 97.2421 140.061C103.424 140.061 108.45 135.037 108.45 128.858C108.45 135.037 113.476 140.061 119.657 140.061C125.896 140.061 130.922 134.979 130.865 128.801V127.53H129.651C127.803 131.168 123.99 133.709 119.599 133.709C115.209 133.709 111.396 131.168 109.547 127.53H107.179C105.33 131.168 101.517 133.709 97.1265 133.709C92.7359 133.709 88.9231 131.168 87.0744 127.53H84.7058C82.8572 131.168 79.0443 133.709 74.6537 133.709C70.2632 133.709 66.4503 131.168 64.6017 127.53H62.2331C60.3844 131.168 56.5715 133.709 52.181 133.709C47.7904 133.709 43.9775 131.168 42.1289 127.53H40.1069Z" fill="black" fill-opacity="0.15" />
            <path d="M74.9997 9.32959C105.849 9.32959 131.153 34.5635 131.153 65.4562V72.7896L143.169 84.858C146.982 88.6691 146.982 94.9631 143.111 98.7742C139.876 102.008 134.908 102.47 131.153 100.276V128.859C131.153 135.037 126.127 140.061 119.945 140.061C113.764 140.061 108.738 135.037 108.738 128.859C108.738 135.037 103.712 140.061 97.5302 140.061C91.3487 140.061 86.3227 135.037 86.3227 128.859C86.3227 135.037 81.2967 140.061 75.1152 140.061C68.9337 140.061 63.9077 135.037 63.9077 128.859C63.9077 135.037 58.8816 140.061 52.7002 140.061C46.5187 140.061 41.4927 135.037 41.4927 128.859C41.4927 135.037 36.4666 140.061 30.2852 140.061C24.1037 140.061 19.0777 135.037 19.0777 128.859V100.276C15.3226 102.47 10.3543 102.008 7.11916 98.7742C3.3063 94.9631 3.24853 88.6691 7.06139 84.858L19.0777 72.7896V65.4562C18.8466 34.6212 44.1501 9.32959 74.9997 9.32959Z" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M32.8277 86.6482L20.8114 98.7166C16.9986 102.528 10.7016 102.585 6.88869 98.7743C3.07583 94.9633 3.01806 88.6692 6.83092 84.8582L18.8472 72.7898" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M117.172 86.6482L129.188 98.7166C133.001 102.528 139.298 102.585 143.111 98.7743C146.924 94.9633 146.982 88.6692 143.169 84.8582L131.152 72.7898" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M48.541 81.5088H101.401" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M79.8535 85.4355H101.402V96.1758C101.402 102.066 96.5492 106.916 90.6566 106.916C84.764 106.916 79.9113 102.066 79.9113 96.1758V85.4355H79.8535Z" fill="black" fill-opacity="0.15" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M79.8535 81.5088H101.402V92.2491C101.402 98.1389 96.5492 102.989 90.6566 102.989C84.764 102.989 79.9113 98.1389 79.9113 92.2491V81.5088H79.8535Z" fill="white" />
            <path d="M79.8535 81.5088H101.402V92.2491C101.402 98.1389 96.5492 102.989 90.6566 102.989C84.764 102.989 79.9113 98.1389 79.9113 92.2491V81.5088H79.8535Z" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M90.5977 81.4512V94.9054" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M53.7977 45.2461C57.6683 45.2461 60.7879 48.3642 60.7879 52.2331C60.7879 56.1019 57.6683 59.22 53.7977 59.22C49.927 59.22 46.8074 56.1019 46.8074 52.2331C46.7496 48.3642 49.927 45.2461 53.7977 45.2461Z" fill="black" fill-opacity="0.15" />
            <path d="M58.9394 47.0938L48.6562 57.4298" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M58.9394 57.4298L48.6562 47.0938" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M92.4461 45.2461C96.3167 45.2461 99.4363 48.3642 99.4363 52.2331C99.4363 56.1019 96.3167 59.22 92.4461 59.22C88.5755 59.22 85.4559 56.1019 85.4559 52.2331C85.3981 48.3642 88.5755 45.2461 92.4461 45.2461Z" fill="black" fill-opacity="0.15" />
            <path d="M97.5878 47.0938L87.3047 57.4298" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M97.5878 57.4298L87.3047 47.0938" stroke="black" stroke-width="4" stroke-miterlimit="22.9256" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <h1 class="page-title text-7xl sm:text-8xl mt-6 mb-4"><?php esc_html_e('404', 'borobazar'); ?></h1>
        <p class="mt-0 mb-10 lg:text-base lg:leading-loose"><?php esc_html_e('We are sorry! This page is currently unavailable. We request you to try again later.', 'borobazar'); ?></p>
    </div>
    <!-- end of 404 content -->
</main>
<!-- #main -->

<?php
get_footer();
