<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <!--mine-->
            <!-- Bootstrap CSS CDN -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
            <!-- Font Awesome JS -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">
	

	<!-- ******************* The Navbar Area ******************* -->
	<div id="sidebar-nav" class="collapsed nav-color">                        
	<i id="sidebar-transition" class="fa fa-caret-square-right fa-3x side-nav-collapse"></i>
	
	<div id="sidebar-header">


                <!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						the_custom_logo();
                    } ?><!-- end custom logo -->



					<!-- start sidebar top widget area -->

					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebarheadertop') ) ?>
                    
					<!-- end sidebar top widget area -->

        </div>




        <nav class="sidebar-menu">

				<!-- The WordPress Menu goes here -->
				<?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),

					)
				); ?>


		</nav><!-- .site-navigation -->


		


				<!--start sidebarheaderbottom -->

				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('sidebarheaderbottom') ) ?>

				<!--end sidebarheaderbottom widget area -->

				
	</div><!-- #wrapper-navbar end -->

	<!-- jQuery CDN - Slim version (=without AJAX) -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <!-- Popper.JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
                <!-- Bootstrap JS -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
                <script>
                $(document).ready(function () {
					//let internalText = $('#main-menu > li > a').text();
					$('#main-menu > li > a > span').addClass('d-none');

					$('#sidebar-transition').click( function () {
                        $('#sidebar-nav').toggleClass('collapsed');
                        $('#sidebar-transition').toggleClass('fa-caret-square-left').toggleClass('fa-caret-square-right');
						$('#main-menu > li > a > span').toggleClass('d-none');
                    });

                    });
                </script>