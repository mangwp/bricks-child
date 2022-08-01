<?php

/**
 * Register/enqueue custom scripts and styles
 */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('jquery');
  wp_register_style('css-flickity', get_stylesheet_directory_uri() . '/assets/css/flickity.min.css', false, '1.0', 'all');
  wp_register_style('css-flickityfs', get_stylesheet_directory_uri() . '/assets/css/flickityfs.min.css', false, '1.0', 'all');
  wp_register_script('js-flickity', get_stylesheet_directory_uri() . '/assets/js/flickity.min.js', false, '1.0', 'all');
  wp_register_script('js-flickityfs', get_stylesheet_directory_uri() . '/assets/js/flickityfs.min.js', false, '1.0', 'all');
  wp_register_script('js-custom', get_stylesheet_directory_uri() . '/assets/js/custom.js',array ('jquery'),                  
  false, false);
  wp_register_script('modernizer', get_stylesheet_directory_uri() . '/assets/js/modernizer.js', false, '1.0', 'all');
  wp_register_script('debouncedresize', get_stylesheet_directory_uri() . '/assets/js/debouncedresize.js', false, '1.0', 'all');
  wp_register_script('images-loaded', get_stylesheet_directory_uri() . '/assets/js/images-loaded.js', false, '1.0', 'all');
  wp_register_script('js-grid-expanded', get_stylesheet_directory_uri() . '/assets/js/grid-expanded.js', false, '1.0', 'all');
  wp_register_style('css-grid-expanded', get_stylesheet_directory_uri() . '/assets/css/grid-expanded.css', false, '1.0', 'all');
  wp_enqueue_script('my-bricks', get_stylesheet_directory_uri() . '/assets/js/my-bricks.js', false, '1.0', 'all');
  // Enqueue your files on the canvas & frontend, not the builder panel. Otherwise custom CSS might affect builder)
  if (!bricks_is_builder_main()) {
    wp_enqueue_style('bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime(get_stylesheet_directory() . '/style.css'));
  }
  if (function_exists('bricks_is_builder_iframe') && bricks_is_builder_iframe()) {
    wp_enqueue_style('css-grid-expanded');
    wp_enqueue_script('debouncedresize');
    wp_enqueue_script('images-loaded');
    wp_enqueue_script('js-grid-expanded');
    wp_enqueue_style('css-flickity');
    wp_enqueue_style('css-flickityfs');
    wp_enqueue_script('js-flickity');
    wp_enqueue_script('js-flickityfs');  
  }
});

/**
 * Register custom elements
 */
add_action('init', function () {
  $element_files = [
    __DIR__ . '/elements/title.php',
    __DIR__ . '/elements/grid-expanded.php',
    __DIR__ . '/elements/flickity-slider.php',
  ];

  foreach ($element_files as $file) {
    \Bricks\Elements::register_element($file);
  }
}, 11);

/**
 * Add text strings to builder
 */
add_filter('bricks/builder/i18n', function ($i18n) {
  // For element category 'custom'
  $i18n['custom'] = esc_html__('Custom', 'bricks');

  return $i18n;
});
require_once __DIR__ . '/helper/my-base.php';
require_once __DIR__ . '/inc/quick_view.php';