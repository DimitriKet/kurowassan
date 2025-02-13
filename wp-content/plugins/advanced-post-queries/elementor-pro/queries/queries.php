<?php
namespace AdvancedPostQueries\Module\Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Module;
use ElementorPro\Modules\QueryControl\Module as Module_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


if ( ! class_exists( 'AQ\Module\Elementor\Queries' ) ) {

class Queries{

    public function advanced_query_args( $query_vars, $widget ){
		$settings = $widget->get_settings();
		
		if( empty( $settings[ 'advanced_query_options' ] ) ){
			return $query_vars;
		}
		
		
		$meta_query = array();
		
		if( isset( $query_vars[ 'meta_query' ] ) ) $meta_query = $query_vars[ 'meta_query' ];
		$advanced_options = $settings[ 'advanced_query_options' ];
		$post_id = get_the_ID();
		
		global $current_user;
		
		if( $advanced_options ){
			
			if( in_array( 'dynamic_user', $advanced_options ) ){
				
				if( $settings[ 'dynamic_user_options' ] == 'author_is_current_user' ){
					if( $current_user->ID > 0 ){
						$query_vars[ 'author' ] = $current_user->ID;
					}else{
						$query_vars[ 'post__in' ] = [ 0 ];
					}
				}			
				if( $settings[ 'dynamic_user_options' ] == 'author_is_current_author' ){
					$author = get_queried_object_id();
					
					if( is_single() ){
						$author = get_the_author_meta( 'ID' );
					}
					$query_vars[ 'author' ] = $author;
				}
				$compare = '';
				if( $settings[ 'dynamic_user_options' ] == 'user_id_is_current_user' ){
					$compare = '==';
				}				
				if( $settings[ 'dynamic_user_options' ] == 'user_id_contains_current_user' ){
					$compare = 'IN';
				}
				
				if( $compare ){
					$user_field_value = '';
					if( $settings[ 'user_field_key' ] == 'ID' ){
						$user_field_value = $current_user->ID;
					}
					if( $settings[ 'user_field_key' ] == 'email' ){
						$user_field_value = $current_user->user_email;
					}
					if( $settings[ 'user_field_key' ] == 'login' ){
						$user_field_value = $current_user->user_login;
					}

					$meta_query[] = [
						'key' => $settings[ 'user_field_name' ],
						'compare' => $compare,
						'value' => $user_field_value,
					];	
				}

			}
			
			if( in_array( 'dynamic_related', $advanced_options ) ){
					
				if( $settings[ 'dynamic_related_options' ] == 'related_posts' ){
					$posts = get_post_meta( $post_id, $settings[ 'related_posts' ], true );
					if( $posts ){
						$posts = (is_array($posts)) ? $posts : [$posts];
						$query_vars[ 'post__in' ] = $posts;
					}else{
						$query_vars[ 'post__in' ] = array( 0 );
					}
				}				
				
				if( $settings[ 'dynamic_related_options' ] == 'related_terms' ){
					$terms = get_post_meta( $post_id, $settings[ 'related_terms' ], true );
					$query_vars[ 'tax_query' ][] = [
						'taxonomy' => $settings[ 'related_tax' ],
						'field' => 'id',
						'terms' => $terms,
					];
				}
				if( $settings[ 'dynamic_related_options' ] == 'same_terms' ){
					$terms = get_the_terms( $post_id, $settings[ 'related_tax' ] );
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						$terms = wp_list_pluck( $terms, 'term_id' );
						$query_vars[ 'tax_query' ][] = [
							'taxonomy' => $settings[ 'related_tax' ],
							'field' => 'id',
							'terms' => $terms,
						];
					}
				}
					
				if( $settings[ 'dynamic_related_options' ] == 'postid_parent' ){
					$meta_query[] = [
						'relation' => 'OR',
						[
							'key' => $settings['postid_parent'],
							'value' => $post_id,
							'compare' => '=',
						],
						[
							'key' => $settings['postid_parent'],
							'value' => sprintf('s:[0-9]+:"%d";', $post_id),
							'compare' => 'REGEXP',
						],
					];
				}

			}			

			if( in_array( 'dynamic_date', $advanced_options ) ){
				
				$today = date('Ymd');
				$query_type = 'DATE';
				if( $settings[ 'query_time' ] ){
					$today = date('Y-m-d H:i:s');
					$query_type = 'DATETIME';
				}
				$include_today = '';
				if( $settings[ 'include_today' ] == 'true' ) $include_today = '=';
				
				$expired_meta_query = [
					'key' => $settings[ 'expired_field_name' ],
					'compare' => '>' . $include_today,
					'value' => $today,
					'type' => $query_type,
				];
				$start_meta_query = [
					'key' => $settings[ 'start_field_name' ],
					'compare' => '<' . $include_today,
					'value' => $today,
					'type' => $query_type,
				];
				
				if( in_array( 'posts_pre_expired', $settings[ 'dynamic_date_options' ] ) ){
					$meta_query[] = $start_meta_query;
				}
				if( in_array( 'posts_expired', $settings[ 'dynamic_date_options' ] ) ){
					$meta_query[] = $expired_meta_query;
				}
			}
			
			if( in_array( 'dynamic_orderby', $advanced_options ) ){
				if( $settings[ 'advanced_orderby_options' ] == 'dynamic_orderby' ){
					$query_vars[ 'meta_key' ] = $settings[ 'dynamic_orderby_options' ]; 
					$query_vars[ 'orderby' ] = 'meta_value'; 
				}
				if( $settings[ 'advanced_orderby_options' ] == 'last_modified' ){
					$query_vars[ 'orderby' ] = 'modified'; 
				}				
				if( $settings[ 'advanced_orderby_options' ] == 'comment_count' ){
					$query_vars[ 'orderby' ] = 'comment_count'; 
				}
			}
			
			if( in_array( 'custom_field', $advanced_options ) ){
				$field_names = explode( ',', $settings[ 'custom_field_name' ] );
				if( $settings[ 'custom_field_options' ] == 'name_is_post_id' ){
					foreach( $field_names as $field_name ){
						$meta_query[ 'custom_field_value' ][] = [
							'key' => $field_name,
							'compare' => '==',
							'value' => $post_id,
						];
					}
				}				
				if( $settings[ 'custom_field_options' ] == 'name_is_post_title' ){
					foreach( $field_names as $field_name ){
						$meta_query[ 'custom_field_value' ][] = [
							'key' => $field_name,
							'compare' => '==',
							'value' => get_the_title(),
						];
					}
				}

				if( $settings[ 'custom_field_options' ] == 'name_is_value' ){
					$custom_field_values = explode( ',', $settings[ 'custom_field_value' ] );

					foreach( $field_names as $field_name ){
						foreach( $custom_field_values as $field_value ){
							$meta_query[ 'custom_field_value' ][] = [
								'key' => $field_name,
								'compare' => '==',
								'value' => $field_value,
							];
						}
					}
				}
								
				if( $settings[ 'custom_field_options' ] == 'name_is_post_cf' ){
					if( $settings[ 'cp_custom_fields' ] ){
						$custom_field_cp = explode( ',', $settings[ 'cp_custom_fields' ] );

						foreach( $field_names as $field_name ){
							foreach( $custom_field_cp as $field_value ){
								$custom_value = get_post_meta( $post_id, $field_value, true );
								$meta_query[ 'custom_field_value' ][] = [
									'key' => $field_name,
									'compare' => '==',
									'value' => $custom_value,
								];
							}
						}
					}
				}
				if( isset( $meta_query[ 'custom_field_value' ] ) ){
					$meta_query[ 'custom_field_value' ]['relation'] = 'OR';
				}
			}

			$query_vars[ 'meta_query' ] = $meta_query;
			
		}

		return $query_vars;
	}

    public function __construct() {
        add_filter( 'elementor/query/query_args', [ $this, 'advanced_query_args' ], 10, 2 );

    }
}

new Queries();
}