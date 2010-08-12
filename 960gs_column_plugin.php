<?php
/*  Plugin Name: 960gs Column System
    Plugin URI: http://aurelienolivier.fr/
    Description: Easily insert columns in posts and pages for working with 960gs
    Version: 0.1
    Author: Aurélien OLIVIER
    Author URI: http://aurelienolivier.fr/cv/
*/
/*  Copyright 2010  Aurélien OLIVIER  (email : olivier.aurelien@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
    TODO control shortcodes not closed
*/

function c960gs_func($atts, $content=null, $code=""){
    extract(shortcode_atts(array(
        'size' => '12',
        'prefix' => '0',
        'suffix' => '0',
        ), $atts));
    
    // Generate class names of the div
    $class="";
    if($size!="12"){
        $class.="grid_".$size;
    }
    if($prefix!="0"){
        $class.=" prefix_".$prefix;
    }
    if($suffix!="0"){
        $class.=" suffix_".$suffix;
    }
    
    // Generate the div tag
    if($class!=""){
        $div="<div class=\"".$class."\">";
    }
    else{
        $div="<div>";
    }
    return $div.do_shortcode($content)."</div>";
}
add_shortcode('960gs', 'c960gs_func');

function c960gs_clear($atts, $content=null, $code=""){
    extract(shortcode_atts(array(), $atts));
    return "<div class=\"clear\"></div>";
}
add_shortcode('960gs_clear', 'c960gs_clear');

function handleAdminMenu() {
    // You have to add one to the "post" writing/editing page, and one to the "page" writing/editing page
    add_meta_box('960gs_sc', 'Gestion des colonnes', 'insertForm', 'post', 'normal');
    add_meta_box('960gs_sc', 'Gestion des colonnes', 'insertForm', 'page', 'normal');
}

function insertForm() {
?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="c960gs_size"><?php _e('Taille de la colonne :')?></label></th>
                <td>
                    <select name="c960gs[size]" id="c960gs_size">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="c960gs_prefix"><?php _e('Espace après la colonne :')?></label></th>
                <td>
                    <select name="c960gs[prefix]" id="c960gs_prefix">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="c960gs_suffix"><?php _e('Espace avant la colonne :')?></label></th>
                <td>
                    <select name="c960gs[suffix]" id="c960gs_suffix">
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="button" onclick="return c960gs.sendToEditor(this.form);" value="<?php _e('Ajouter la colonne &raquo;'); ?>" />
                    <input type="button" onclick="return c960gs.sendClearerToEditor();" value="<?php _e('Ajouter un séparateur &raquo;'); ?>" />
                </td>
            </tr>
        </table>
<?php
}

function adminHead () {
    if ($GLOBALS['editing']) {
        wp_enqueue_script('c960gs', WP_PLUGIN_URL.'/960gs-column-plugin/js/960gs_column_plugin.js', array('jquery'), '1.0.0');
    }
}

add_action('admin_menu', 'handleAdminMenu');
add_filter('admin_print_scripts', 'adminHead');

?>