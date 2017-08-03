<?php 
/**
 * This file is free software: you can redistribute it and/or modify
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
 
class genially_embed_front_end{
	private $menu_name;
	private $params;

	function __construct($params){
		add_shortcode( 'wpgenially', array($this,'shortcode') );			
	}
	
	public function shortcode( $atts, $content ) {	
		
		if(!$content){
		 return '<span style="color:red; font-size:16px">Set Genially URL</span>';	
		}
		
		$content = preg_replace('/\s+/', '', $content);
		$link_genially = $content;

		$findme   = 'www.genial.ly/View/Index/'; // http://www.genial.ly/View/Index/555eec4e1561e80450977b8d
		$pos = strpos(strtolower($content), strtolower($findme));



		if ($pos) {
		    $link_genially = substr($content, $pos+strlen($findme)); 
		} 
		
		

		$xml = file_get_contents('https://www.genial.ly/api/Genially/GetSize?idGenially='.$link_genially);
		$array = json_decode($xml);
		$width = str_replace ( "px" , '' , $array->width);
		$height = str_replace ( "px" , '' , $array->height);

		$ratio = ($height/$width)*100;
		
		$code='<div style="width: 100%;"><div style="position: relative; padding-bottom: '.$ratio.'%; padding-top: 0; height: 0;"><iframe width="'.$width.'" height="'.$height.'" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="http://www.genial.ly/View/Index/'.$link_genially.'" type="text/html" allowscriptaccess="always" frameborder="0" allowfullscreen="true" scrolling="no" allownetworking="all" ></iframe></div></div>';
		
		return $code;
	}
}




?>