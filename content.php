<?php

/**
 * Content template
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
    <?php

        $url = get_permalink();

        if ( is_single() ) {
            the_title('<h1>', '</h1>');
        } else {
            the_title("<h2><a href='$url'>", '</a></h2>');
        }

        the_post_thumbnail();
        the_content('Continue reading &hellip;');
        wp_link_pages();
        get_template_part('meta');

    ?>
</div>
