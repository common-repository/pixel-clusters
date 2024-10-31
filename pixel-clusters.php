<?php
/** 
 *
 * @since             1.0.0
 * @package           Pixel_Cluster
 *
 * @wordpress-plugin
 * Plugin Name:       Pixel Clusters
 * Plugin URI:        https://mireunion.com/
 * Description:       A small plugin for create clusters of posts.
 * Version:           1.0.6
 * Author:            Mex Avila
 * Author URI:        https://datakun.com/
 * License:           GPL-3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       pixel-cluster
 * Domain Path:       /languages
 * Network:			  true
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

define( 'CLUSTER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CLUSTER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function pixel_cluster( $atts ) 
{
	global $post;
	
	$html = '<aside class="cluster">';
	
	$a = shortcode_atts( array(
		'type'		=> 1,
		'tag_id' 	=> 1,
		'numero' 	=> 4,
		'modo'		=> 1,
	), $atts );
	
	
	$args = array(
		'posts_per_page'   	=> $a['numero'],		
		'orderby'          	=> 'date',
		'order'            	=> 'DESC',
		'post_type'        	=> 'post',
		'post_status'      	=> 'publish',	
		'post__not_in'		=> array($post->ID)	
	);
	
	if($a['type'] == 1)
	{
		$args['cat'] = $a['tag_id'];
	}
	else
	{
		$args['tag_id'] = $a['tag_id'];
	}
	
	$posts = get_posts($args);	
	
	foreach($posts as $data)
	{	
		switch($a['modo'])
		{
			case 1: 
			
				$html .= '<article class="category">
					<div class="images">';
						if ( has_post_thumbnail($data->ID) ) :
							$html .= '<a href="'. get_the_permalink($data->ID) .'" title="'. get_the_title($data->ID) .'">
								'. get_the_post_thumbnail($data->ID, 'thumbnail') .'
							</a>';
						endif;
						$html .= '&nbsp;
					</div>
					<div class="articles">            
						<div class="h2"><a href="'. get_the_permalink($data->ID) .'">'. get_the_title($data->ID) .'</a></div>                  
						'. get_the_excerpt($data->ID) .'        
					</div>
				</article>';
			
				break;
				
			case 2:	
			
				$html .= '<article class="column3">
					<a href="'. get_the_permalink($data->ID) .'" title="'. get_the_title($data->ID) .'"><div class="images" style="background-image: url('. get_the_post_thumbnail_url($data->ID, 'medium') .');">&nbsp;</div></a>
					<div class="articles">            
						<div class="h2"><a href="'. get_the_permalink($data->ID) .'">'. get_the_title($data->ID) .'</a></div>        
					</div>
				</article>';
			
				break;
			
			case 3: 
			
				$html .= '<li><a href="'. get_the_permalink($data->ID) .'">'. get_the_title($data->ID) .'</a></li>';
			
				break;
		}
	}
    wp_reset_postdata();
	
	$html .= '</aside>';

	return $html;
}
add_shortcode( 'cluster', 'pixel_cluster' );


function pixel_cluster_admin()
{
 	add_menu_page( 'Clusters', 'Clusters', 'manage_options', 'clusters', 'safetya_cluster_page' );
}
add_action( 'admin_menu', 'pixel_cluster_admin' );

function pixel_cluster_admin_enqueue($hook) 
{       
	if($hook != 'toplevel_page_clusters') {
			return;
	}
	
	wp_enqueue_script( 'pixel-clusters-js', CLUSTER_PLUGIN_URL . 'js/cluster.js', array ( 'jquery' ), 1.0, true);
}
add_action( 'admin_enqueue_scripts', 'pixel_cluster_admin_enqueue' );

function pixel_cluster_init() 
{
	if ( ! is_admin() ) 
	{
		wp_enqueue_style( 'pixel-clusters', CLUSTER_PLUGIN_URL .'css/pixel-clusters.css' );
	}
	else
	{
		wp_enqueue_script( 'pixel-clusters-js', CLUSTER_PLUGIN_URL . 'js/cluster.js', array ( 'jquery' ), 1.0, true);
	}
}
add_action('wp_enqueue_scripts', 'pixel_cluster_init');

function safetya_cluster_page()
{
	require_once( CLUSTER_PLUGIN_PATH . 'content/pixel-html.php' );
}
