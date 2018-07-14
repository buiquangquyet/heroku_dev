<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>
	<div class="shop-products">
		<div class="shop-produt-image">
			<a href="<?php the_permalink(); ?>">
				<?php //display product thumbnail
					if (has_post_thumbnail()) { 
						$params = array('width' => '500', 'height' => '500', 'crop' => false);
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'kaya-gallery' ); 
						echo "<img src='".bfi_thumb( "{$image_src[0]}", $params )."'  alt='".get_the_title()."' />";
					}
					else {
						echo '<img src="'.get_template_directory_uri().'/images/woo_product_image.jpg"  alt="" />';
					} 
				?>
			</a>
			<div class="product-cart-button">
			<?php
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'button' ),
				esc_html( $product->add_to_cart_text() )
				),
				$product );?>
			</div>
		</div>
		<div class="shop-product-details">
			<h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<span class="price"><?php echo $product->get_price_html(); ?></span>	
			<?php endif;  ?>
		</div>
	</div>
</li>