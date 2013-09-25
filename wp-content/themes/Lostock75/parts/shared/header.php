<div class="container">
    <header role="banner" class="clearfix">
	    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
	    <h2><?php bloginfo( 'description' ); ?></h2>
    </header>
    <nav role="navigation" class="clearfix">
        <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?>
    </nav>
