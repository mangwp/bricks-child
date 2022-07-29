<?php function pop_up()
{
?>
  <div id="quick-view-modal" class="quick-view-product-modal">
    <div class="modal-content">
      <span class="close"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M14 0C6.2 0 0 6.2 0 14C0 21.8 6.2 28 14 28C21.8 28 28 21.8 28 14C28 6.2 21.8 0 14 0ZM19.4 21L14 15.6L8.6 21L7 19.4L12.4 14L7 8.6L8.6 7L14 12.4L19.4 7L21 8.6L15.6 14L21 19.4L19.4 21Z" fill="#B4B4B4" />
        </svg>
      </span>
      <div class="content-full">
        <!-- Leave empty to be able to populate later with ajax -->
      </div>
    </div>

  </div>
  <script>
    jQuery(document).ready(function($) {
      var modal = document.getElementById('quick-view-modal');
      var span = document.getElementsByClassName("close")[0];

      span.onclick = function() {
        modal.style.display = "none";
      }
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      // Let's do the magic
      // make sure to change #myBtn to read more button selector
      jQuery(document).on("click", ".quick-view", function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();
        // get url
        var url = $(this).attr('href');
        var container = $('#quick-view-modal').find('.content-full');
        var data = {
          action: 'show_product',
          url: url,

        };
        $.post('<?php echo esc_url(home_url()); ?>/wp-admin/admin-ajax.php', data, function(response) {
          // display the response
          console.log(response);
          $(container).empty();
          $(container).html(response);
          modal.style.display = "block";
        });
      });
    });
  </script>
<?php
}
add_action('wp_footer', 'pop_up');

add_action('wp_ajax_show_product', 'show_product_callback_wp');
add_action('wp_ajax_nopriv_show_product', 'show_product_callback_wp');
function show_product_callback_wp()
{
  $url = $_POST['url'];
  $product_id = url_to_postid( $url );

  // product content
  $product = wc_get_product($product_id);
  $short_desc = $product->get_short_description();
  $title = $product->get_name();
  $price = $product->get_price_html();
  $categories = $product->get_categories();


  // product content
  $product = wc_get_product($product_id);
   $output = "";
   $output .= '<div class="content-left">';
   $output .= get_the_post_thumbnail( $product_id, 'medium');
   $output .= '</div>';
   $output .= '<div class="content-right">';
   $output .= '<h3 class="title">'.$title.'</h3>';
   $output .= '<span class="price">'.$price.'</span>';
   $output .= '<span class="categories">'.$categories.'</span>';
   $output .= '<p class="short_desc">'.$short_desc.'</p>';
   $output .= '</div>';
   echo $output;
  exit();
};