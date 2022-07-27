<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Element_Grid_Expanded extends \Bricks\Element
{
    /** 
     * How to create custom elements in Bricks
     * 
     * https://academy.bricksbuilder.io/article/create-your-own-elements
     */
    public $category     = 'custom';
    public $name         = 'grid-expanded';
    public $icon         = 'fas fa-anchor'; // FontAwesome 5 icon in builder (https://fontawesome.com/icons)
    public $css_selector = '.grid-expanded'; // Default CSS selector for all controls with 'css' properties
    // public $scripts      = []; // Enqueue registered scripts by their handle

    public function get_label()
    {
        return esc_html__('Grid Expanded', 'bricks');
    }
    public function enqueue_scripts() {
        wp_enqueue_style( 'css-grid-expanded' );
        wp_enqueue_script( 'modernizer' );
		wp_enqueue_script( 'debouncedresize' );
        wp_enqueue_script( 'images-loaded' );
        wp_enqueue_script( 'js-grid-expanded' );
    }
    public function set_control_groups()
    {
    }
    public function set_controls()
    {
        $this->controls['items'] = [
            'tab'         => 'content',
            'placeholder' => esc_html__('Item', 'bricks'),
            'type'        => 'repeater',
            'fields'      => [
                'image'       => [
                    'label' => esc_html__('Image', 'bricks'),
                    'type'  => 'image',
                ],
                'title'            => [
                    'label' => esc_html__('Title', 'bricks'),
                    'type'  => 'text',
                ],
                'content'          => [
                    'label' => esc_html__('Content', 'bricks'),
                    'type'  => 'textarea',
                ],
                'buttonText'       => [
                    'label' => esc_html__('Button text', 'bricks'),
                    'type'  => 'text',
                ],
                'link'       => [
                    'label' => esc_html__('link', 'bricks'),
                    'type'  => 'link',
                ],
            ],
        ];
    }

    /** 
     * Render element HTML on frontend
     * 
     * If no 'render_builder' function is defined then this code is used to render element HTML in builder, too.
     */
    public function render()
    {
        $settings = $this->settings;
        $items   = !empty($settings['items']) ? $settings['items'] : false;
        $root_classes[] = 'grid-expanded';
        $this->set_attribute('_root', 'class', $root_classes);
        echo "<div {$this->render_attributes('_root')}>";
        echo '<ul id="og-grid" class="og-grid">';
        if (count($items)) {
            foreach ($items as $index => $item) {
                $imagurl = wp_get_attachment_image_url(
                    $item['image']['id'],
                    $item['image']['size'],
                    false,
                    []
                );
                $output .= '<li>';
                if (isset($item['link'])) {
                    $this->set_link_attributes("a-$index", $item['link']);
                    $output .= '<a ' . $this->render_attributes("a-$index") . ' data-largesrc="' . $imagurl . '" data-title="' . $item['title'] . '" data-description="' . $item['content'] . '">';
                }
                if (isset($item['link'])) {
                    $output .= '<img src="' . $imagurl . '">';
                }
                if (isset($item['link'])) {
                    $output .= '</a>';
                }
                $output .= '</li>';
            }
            echo $output;
        } else {
            esc_html_e('No items defined.', 'bricks');
        }
        echo '</ul></div>';
    }
}
