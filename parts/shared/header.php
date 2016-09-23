<header>
	<div class="container">
		<div class="six columns">
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<a id="menu-toggle"><i class="fa fa-bars fa-lg"></i> Menu</a>
		</div>
		<div class="six columns">
		    <?php wp_nav_menu (array('menu' => 'Primary Nav','container_class' => 'nav-collapse','menu_class' => 'menu')); ?>
		</div>
	</div>
</header>
