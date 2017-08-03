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

class genially_admin_menu{
	
	private $menu_name;	
	
	
	public  $content_default_params;
	
	public  $featured_plugins;
	
	function __construct($param){
		$this->menu_name='Genially Embed';
		
		//add_button
		add_filter('media_buttons_context', array($this,"editor_buttonn"));
		
		//added button window
		add_action('wp_ajax_genially_embed_window_manager',array($this,'window_for_inserting_contentt'));
	}
	
    /// function for add new button
	function editor_buttonn($context)
	{
		$img = plugins_url( '/images/icon-genially.png' , __FILE__ );
        $title = __("Add Genially", "genially-embed");
		$context .= '<a class="button thickbox" title="'.__("Insert Genially in posts/pages", "genially-embed").'" href="'.admin_url("admin-ajax.php").'?action=genially_embed_window_manager&width=640&height=450"><span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom; width:18px; height:18px; margin-right:5px;"></span>'.__("Add your Genially", "genially-embed").'</a>';  
		return $context;
	}

	public function window_for_inserting_contentt(){
		
        $initial_values= array( 
			"genially_embed_width"  				=> "1600",
			"genially_embed_height"  				=> "900"
		);
	   foreach($initial_values as $key => $value){
		
			$$key=$value;
	   }
	?>
		
        <style>
            @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
            #TB_window{
                font-family: Montserrat,Helvetica,Arial,sans-serif;
			}
            .tb-close-icon:hover{
                color: #fff;
                opacity: 0.5;
            }
            .slider_parametrs{
				padding-left:5px;
				width:180px;
				float:left;
				margin-top:2px;
			}
			#TB_ajaxContent{
				 width:initial !important;
				 height:initial !important;
                 font-weight: normal;
			 }
			 #genially_embed_initial_volume_span{
				 padding-left:12px;
			}
            #TB_title {
                background: #bc2360;
                border-bottom: none;
                height: 53px;
                color: #fff;
                font-size: 18px;
                font-weight: normal;
            }
            #TB_ajaxWindowTitle {
                float: left;
                font-weight: normal;
                line-height: 29px;
                overflow: hidden;
                padding: 12px 29px 0 15px;
            }
            .tb-close-icon {
                color: #fff;
                top: 12px;
                right: 12px;
            }
            #genially-embed-header{
                margin: 30px 0;
            }
            .genially_settings_table{
                border:none !important;
            }
            input[type=text]{
                width: 20%;
                color: #999;
            }
            #TB_window{
                height: 400px !important;
            }
            .genially-button-table{
                    border-top: solid 1px #DCDCDC;
                clear: both;
                width: 100%;
                margin-top: 30px;
                padding: 15px;
            }
            .button-genially{
                background: #bc2360 !important;
                color: #fff !important;
                font-weight: normal;
                border: none !important;
                box-shadow: none !important;
                padding: 7px 20px !important;
                height: auto !important;
                transition: all 0.3s;
            }
            .button-genially-grey{
                background: #ccc !important;
                color: #333 !important;
                font-weight: normal;
                border: none !important;
                box-shadow: none !important;
                padding: 7px 20px !important;
                height: auto !important;
                transition: all 0.3s;
            }
            .button-genially:hover, .button-genially-grey:hover{
                background: #666 !important;
                  color: #fff !important ;
            }
        </style>

        <div id="genially-embed-header">
            <img src="<?php echo plugins_url( '/images/logo.gif' , __FILE__ ); ?>" height="60" alt="Logo">
        </div>
        
        <table class="wp-list-table genially_settings_table" style="width: 100%; min-width:320px !important;table-layout: fixed;">
            
            <tbody>
                
            	<tr>
                    <td> <label>Genially URL or ID</label></td>
                    <td width="80%">     
                    	<input type="text" name="genially_embed_video" id="genially_embed_video" placeholder="" style="width:100%;">
                    </td>
                </tr>
                            
            </tbody>
            
		</table>
        <table class="genially-button-table"> 
            <tbody>
                <tr>
                    <th width="50%"><button type="button" onClick="insert_genially_embed()" id="save_button_genially" class="save_button_genially button button-genially"><span class="save_button_genially_span"><?php echo __("Insert Genially", "genially-embed"); ?></span></button></th>
                    <th  width="50%"><button type="button" class="save_button_genially button button-genially-grey" style="float:right" onClick="tb_remove()"><?php echo __("Close", "genially-embed"); ?></button></th>
                </tr>
            </tbody>
        </table>
	<br /><span class="error_massage"></span>
     <style>
		
   </style>
    <script type="text/javascript">
			
        function insert_genially_embed() {
			if(jQuery('#genially_embed_video').val()){
				var generete_atributes='';
				
                tagtext = '[wpgenially]'+jQuery('#genially_embed_video').val()+'[/wpgenially]';
                window.send_to_editor(tagtext);
              	tb_remove()
            }
			else{
				alert(__("Enter url please", "genially-embed"));
			}
        }

    </script>
    <?php
	die();
	}
	
	
}