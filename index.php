<?php
/*
Theme Name: Online English Class
Author: Your Name
Description: A basic WordPress theme for an online Zoom English class.
Version: 1.0
*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        nav {
            background-color: #333;
            padding: 10px;
        }

        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>

<header>
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
</header>

<nav>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'fallback_cb'    => false,
    ));
    ?>
</nav>

<div class="container">
    <?php if (is_front_page()) : ?>

        <h1>Welcome to Online English Classes</h1>
        <p>Improve your English skills with our expert-led Zoom classes.</p>

        <h2>Featured Classes</h2>
        <ul>
            <?php
            $args = array('post_type' => 'class', 'posts_per_page' => 3);
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
            ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>

    <?php elseif (is_page()) : ?>

        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>

    <?php elseif (is_singular('class')) : ?>

        <h2><?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>
        <a href="<?php echo get_post_meta(get_the_ID(), 'zoom_link', true); ?>">Join Zoom Class</a>

    <?php else : ?>

        <h2>Page Not Found</h2>
        <p>Sorry, the page you're looking for doesn't exist.</p>

    <?php endif; ?>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Online English Classes. All rights reserved.</p>
</footer>

<?php

function online_classes_setup() {
    // Add support for title tag
    add_theme_support('title-tag');

    // Register main menu
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
    ));
}
add_action('after_setup_theme', 'online_classes_setup');

// Register custom post type for Classes
function create_post_type_classes() {
    register_post_type('class',
        array(
            'labels' => array(
                'name' => __('Classes'),
                'singular_name' => __('Class')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'create_post_type_classes');

wp_footer(); ?>

</body>
</html>
