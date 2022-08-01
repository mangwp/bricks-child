<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Element_Flickity_Slider extends \Bricks\Element
{
  /** 
   * How to create custom elements in Bricks
   * 
   * https://academy.bricksbuilder.io/article/create-your-own-elements
   */
  public $category     = 'custom';
  public $name         = 'Flickity';
  public $icon         = 'fas fa-anchor'; // FontAwesome 5 icon in builder (https://fontawesome.com/icons)
  public $css_selector = '.flickity_slider'; // Default CSS selector for all controls with 'css' properties
   public $scripts      = ['mybricksflickitySlider']; // Enqueue registered scripts by their handle

  public function get_label()
  {
    return esc_html__('Flickity Slider', 'bricks');
  }
  public function set_control_groups()
  {
  }
  public function set_controls()
  {
    $this->controls['items'] = [
      'tab' => 'content',
      'label' => esc_html__('Image gallery', 'bricks'),
      'type' => 'image-gallery',
    ];
		$this->controls['options'] = [
      'tab' => 'content',
			'label'       => esc_html__( 'Custom options', 'bricks' ),
			'type'        => 'code',
			'description' => esc_html__( 'Provide your own options in JSON format', 'bricks' ) . ' (<a href="https://flickity.metafizzy.co/options.html" target="_blank" rel="noopener">' . esc_html__( 'learn more', 'bricks' ) . '</a>).',
		];
  }
  public function enqueue_scripts()
  {
    wp_enqueue_style('css-flickity');
    wp_enqueue_script('js-flickity');
    wp_enqueue_style('css-flickityfs');
    wp_enqueue_script('js-flickityfs');
  }
  /** 
   * Render element HTML on frontend
   * 
   * If no 'render_builder' function is defined then this code is used to render element HTML in builder, too.
   */
  public function get_normalized_image_settings($settings)
  {
    $items = isset($settings['items']) ? $settings['items'] : [];
    $size = !empty($items['size']) ? $items['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
    // Dynamic Data
    if (!empty($items['useDynamicData']['name'])) {
      $items['images'] = [];
      $images = $this->render_dynamic_data_tag($items['useDynamicData']['name'], 'image');
      if (is_array($images)) {
        foreach ($images as $image_id) {
          $items['images'][] = [
            'id'   => $image_id,
            'full' => wp_get_attachment_image_url($image_id, 'full'),
            'url'  => wp_get_attachment_image_url($image_id, $size)
          ];
        }
      }
    }
    // Either empty OR old data structure used before 1.0 (images were saved as one array directly on $items)
    if (!isset($items['images'])) {
      $images = !empty($items) ? $items : [];
      unset($items);
      $items['images'] = $images;
    }
    // Get 'size' from first image if not set (previous to 1.4-RC)
    $first_image_size = !empty($items['images'][0]['size']) ? $items['images'][0]['size'] : false;
    $size             = empty($items['size']) && $first_image_size ? $first_image_size : $size;
    // Calculate new image URL if size is not the same as from the Media Library
    if ($first_image_size && $first_image_size !== $size) {
      foreach ($items['images'] as $key => $image) {
        $items['images'][$key]['size'] = $size;
        $items['images'][$key]['url']  = wp_get_attachment_image_url($image['id'], $size);
      }
    }
    $settings['items'] = $items;
    $settings['items']['size'] = $size;
    return $settings;
  }

  public function render()
  {
    $settings           = $this->get_normalized_image_settings($this->settings);
    $images             = !empty($settings['items']['images']) ? $settings['items']['images'] : false;
    $size               = !empty($settings['items']['size']) ? $settings['items']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
    // Return placeholder
    if (!$images) {
      if (isset($settings['items']['useDynamicData']['name'])) {
        if (BRICKS_DB_TEMPLATE_SLUG !== get_post_type($this->post_id)) {
          return $this->render_element_placeholder(
            [
              'title' => sprintf(
                esc_html__('Dynamic data %1$s (%2$s) is empty', 'bricks'),
                $settings['items']['useDynamicData']['label'],
                $settings['items']['useDynamicData']['group']
              ),
            ]
          );
        }
      } else {
        return $this->render_element_placeholder(
          [
            'title' => esc_html__('No image selected.', 'bricks'),
          ]
        );
      }
    }
    $options = trim( stripslashes( $settings['options'] ) );
    $this->set_attribute( '_root', 'data-flickity',  $options ) ;
    echo "<div {$this->render_attributes('_root')}>";
    foreach ($images as $index => $item) {
      $image_url = wp_get_attachment_image_url($item['id'], $size, false, $image_atts);
      echo '<div class="carousel-cell">';
      echo '<img src="' . $image_url . '">';
      echo '</div>';
    }
    echo '</div>';
    
  }
}
