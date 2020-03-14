<?php 

global $themewing_options;

?>

<div id="top-bar" class="top-bar">
    <div class="container">
        <div class="row">
            <?php if (isset($themewing_options['topbar_share']) && isset($themewing_options['topbar_share'] )) { ?>
                <div class="col-sm-6 col-xs-12">
                    <span class="top-social-title"><?php _e('Stay Connected:','bizspeak');?></span>
                    <?php get_template_part( 'includes/social-buttons' ); ?> 
                </div>
            <?php }?> 
            <?php if ( has_nav_menu( 'topmenu' ) ) : ?>
                <div class="col-sm-6 col-xs-12">
                <?php
                    // topmenu Nav
                    wp_nav_menu( array(
                        'theme_location' => 'topmenu',
                        'depth'          => 1,
                        'menu_class' => 'top-menu unstyled',
                        'fallback_cb' => '',
                    ) );
                ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



