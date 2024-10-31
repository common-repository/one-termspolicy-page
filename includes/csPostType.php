<?php

namespace oneTermsPolicy;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


class csPostType {
	public function register() {
		add_action( 'init', array( $this, 'RegisterCarPostType' ) );
		add_filter( 'load-post-new.php', array( $this, 'load_page_choice_term_policy' ) );
		add_filter( 'manage_one-termspolicy_page_posts_columns', array( $this, 'set_columns_post_type' ) );
		add_action( 'manage_one-termspolicy_page_posts_custom_column', array(
			$this,
			'custom_post_type_column'
		), 10, 2 );
		add_filter( 'the_content', array( $this, 'oneK' ) );
	}

	public function RegisterCarPostType() {
		$labels = array(
			'name'               => __( 'oneTermsPolicys', ONETERMPOLICY_TD ),
			'all_items'          => __( 'همه قوانین', ONETERMPOLICY_TD ),
			'singular_name'      => __( 'oneTermsPolicy', ONETERMPOLICY_TD ),
			'add_new'            => __( 'افزودن قوانین', ONETERMPOLICY_TD ),
			'add_new_item'       => __( 'افزودن قوانین جدید', ONETERMPOLICY_TD ),
			'edit'               => __( 'ویرایش', ONETERMPOLICY_TD ),
			'edit_item'          => __( 'ویرایش قوانین', ONETERMPOLICY_TD ),
			'new_item'           => __( 'قوانین جدید', ONETERMPOLICY_TD ),
			'view'               => __( 'مشاهده', ONETERMPOLICY_TD ),
			'view_item'          => __( 'مشاهده قوانین', ONETERMPOLICY_TD ),
			'search_items'       => __( 'جستجو قوانین', ONETERMPOLICY_TD ),
			'not_found'          => __( 'قانونی ای یافت نشد', ONETERMPOLICY_TD ),
			'not_found_in_trash' => __( 'قانونی در زباله یافت نشد', ONETERMPOLICY_TD ),
			'parent'             => __( 'والد قوانین', ONETERMPOLICY_TD ),
			'menu_name'          => __( 'قوانین و شرایط', ONETERMPOLICY_TD ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => true,
			'supports'            => array( 'title', 'editor', 'revisions', 'page-attributes', 'custom-fields' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array( 'slug' => 'oneTermsPolicy' ),
			'map_meta_cap'        => true,
			'capability_type'     => 'post',
			'menu_icon'           => 'dashicons-unlock',
			'show_admin_column'   => true
		);
		register_post_type( ONETERMPOLICY_TD . '_page', $args );
		flush_rewrite_rules();
	}

	public function load_page_choice_term_policy() {
		$post_type = isset( $_REQUEST['post_type'] ) ? sanitize_text_field( $_REQUEST['post_type'] ) : '';

		if ( 'one-termspolicy_page' != $post_type ) {
			return;
		}
		if ( file_exists( ONETERMPOLICY_ADMIN_PAGES_PATH . '/Page-Select.php' ) ) {
			include ONETERMPOLICY_ADMIN_PAGES_PATH . '/Page-Select.php';
		}
		exit();
	}

	public function set_columns_post_type( $columns ) {
		$columns['short_code'] = __( 'شورت کد', ONETERMPOLICY_TD );

		return $columns;
	}

	public function custom_post_type_column( $column, $post_id ) {
		if ( $column == 'short_code' ) {
			$curentPost = get_post( $post_id );
			if ( csPresentation::Cheak_empty_isset( $curentPost ) ) {
				if ( $curentPost->post_status == 'publish' ) {
					$shortCode = "[onetermspolicy page={$curentPost->post_name}]";
				} else {
					$shortCode = __( 'پس از انتشار قانون ، شورت کد تولید خواهد شد', ONETERMPOLICY_TD );
				}
			}
			echo $shortCode ? $shortCode : '';
		}
	}

	public function oneK( $c ) {
		global $post;
		$postType = 'one-termspolicy_page';
		if ( $post->post_type == $postType ) {
			$st = get_option( '_' . ONETERMPOLICY_TD . '_option' );
			if ( csPresentation::Cheak_empty_isset( $st['BlogOption'] ) ) {
				$std = base64_decode( $st['BlogOption'] );
				$c   .= $std;

				return $c;
			} else {
				return $c = '';
			}
		} else {
			return $c;
		}
	}
}
