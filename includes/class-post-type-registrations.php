<?php
/**
 * SSM Product Rentals
 *
 * @package   SSM_Product_Rentals
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Product_Rentals
 */
class SSM_Product_Rentals_Registrations {

	public $post_type = 'product-rental';

	public $taxonomies = array( 'rental-category' );

	public function init() {
		// Add the SSM Product Rentals and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Product_Rentals_Registrations::register_post_type()
	 * @uses SSM_Product_Rentals_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Products', 'ssm-product-rentals' ),
			'singular_name'      => __( 'Product', 'ssm-product-rentals' ),
			'add_new'            => __( 'Add Product', 'ssm-product-rentals' ),
			'add_new_item'       => __( 'Add Product', 'ssm-product-rentals' ),
			'edit_item'          => __( 'Edit Product', 'ssm-product-rentals' ),
			'new_item'           => __( 'New Product', 'ssm-product-rentals' ),
			'view_item'          => __( 'View Product', 'ssm-product-rentals' ),
			'search_items'       => __( 'Search Products', 'ssm-product-rentals' ),
			'not_found'          => __( 'No products found', 'ssm-product-rentals' ),
			'not_found_in_trash' => __( 'No products in the trash', 'ssm-product-rentals' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'genesis-layouts',
			'genesis-seo'
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'product', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-admin-page',
		);

		$args = apply_filters( 'ssm_product_rentals_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Rental Categories', 'ssm-product-rentals' ),
			'singular_name'              => __( 'Rental Category', 'ssm-product-rentals' ),
			'menu_name'                  => __( 'Rental Categories', 'ssm-product-rentals' ),
			'edit_item'                  => __( 'Edit Rental Category', 'ssm-product-rentals' ),
			'update_item'                => __( 'Update Rental Category', 'ssm-product-rentals' ),
			'add_new_item'               => __( 'Add New Rental Category', 'ssm-product-rentals' ),
			'new_item_name'              => __( 'New Rental Category Name', 'ssm-product-rentals' ),
			'parent_item'                => __( 'Parent Rental Category', 'ssm-product-rentals' ),
			'parent_item_colon'          => __( 'Parent Rental Category:', 'ssm-product-rentals' ),
			'all_items'                  => __( 'All Rental Categories', 'ssm-product-rentals' ),
			'search_items'               => __( 'Search Rental Categories', 'ssm-product-rentals' ),
			'popular_items'              => __( 'Popular Rental Categories', 'ssm-product-rentals' ),
			'separate_items_with_commas' => __( 'Separate rental categories with commas', 'ssm-product-rentals' ),
			'add_or_remove_items'        => __( 'Add or remove rental categories', 'ssm-product-rentals' ),
			'choose_from_most_used'      => __( 'Choose from the most used rental categories', 'ssm-product-rentals' ),
			'not_found'                  => __( 'No project categories found.', 'ssm-product-rentals' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'rental-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'ssm_product_rentals_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}