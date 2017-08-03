<?php
/**
 * Plugin Name: Genially Embed
 * Plugin URI: http://doitgenially.com/wordpress-genially-embed-plugin
 * Description: WordPress Genially Embed plugin adding your Genially iframes to your website.
 * Version: 2.4
 * Author: Genially
 * Author URI: http://genial.ly/
 * License URI: GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
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
 

class genially_embed{
	// required variables of Genially plugin
	
	private $plugin_url;
	
	private $plugin_path;
	
	private $version;
	
	public $options;
	
	
	function __construct(){
		$this->plugin_url  = trailingslashit( plugins_url('', __FILE__ ) );
		$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
		$this->version     = 1.0;
		$this->call_base_filters();
		$this->create_admin_menu();
		$this->front_end();
		
	}
	
	private function create_admin_menu(){
		require_once($this->plugin_path.'admin/admin_menu.php');
		$admin_menu = new genially_admin_menu(array('plugin_url' => $this->plugin_url,'plugin_path' => $this->plugin_path));
	}

	public function front_end(){
				
		require_once($this->plugin_path.'frontend/front_end.php');	
		$genially_embed_frontend = new genially_embed_front_end(array('menu_name' => 'Genially','plugin_url' => $this->plugin_url,'plugin_path' => $this->plugin_path));
	}
	
	public function registr_requeried_scripts(){	
		wp_register_style('front_end_style_genially_embed',$this->plugin_url.'admin/styles/front_end_style.css');
	}
	public function enqueue_requeried_scripts(){	
		wp_enqueue_style('front_end_style_genially_embed',$this->plugin_url.'admin/styles/front_end_style.css');
	}
	public function call_base_filters(){
		load_plugin_textdomain('genially-embed', false, dirname(plugin_basename(__FILE__)) . '/languages');
		add_action( 'init',  array($this,'registr_requeried_scripts') );
		add_action( 'admin_head',  array($this,'enqueue_requeried_scripts') );
	}
  	
	private function include_file(){
		
	}
}
$genially_embed = new genially_embed();

?>