<header id="masthead" class="site-header" role="banner">
    <nav class="navbar navbar-custom" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> rel="home"><?php bloginfo( 'name' ); ?></a>
        </div>
        <?php pure_header_menu(); ?>
    </nav><!-- .navbar -->
</header><!-- .site-header -->