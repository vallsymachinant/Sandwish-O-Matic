<?php
/*
Plugin Name: Sanwdish-O-Matic
Description: Maquette Sanwdish-O-Matic 
Author: Valls y Machinant David
Author URI: http://www.valls.be
Description: Gérez votre site de Sandwisherie facilement, proposez à vos clients de commander en ligne ! Suivez leurs achats en ligne ! Fidélisez les !
Version: 0.2
License: ALL RIGHT RESERVED Valls y Machinant David
*/
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__));
	$url_style = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/som_style.css';
/*
	echo dirname(__FILE__) .'somclass/administration.php';
	echo'<br>';
	echo dirname(__FILE__) .'somclass/users.php';
	*/
	include_once dirname(__FILE__) .'/somclass/administration.php';
	include_once dirname(__FILE__) .'/somclass/users.php';
	
	function som_uninstall(){
		try{
			$somclass_users = new somclass_users();
		} catch (Exception $e) {
			var_dump($e);
		}
		$somclass_users->som_deleteUserTypes();
	}
	
	
	//Create new instance of class
    $somobject_adminPanel = new somclass_administration();

	//Actions and Filters

	//Administration Actions
	add_action('admin_menu', array(&$somobject_adminPanel,'Configuremenu'));
	add_action('admin_head', array(&$somobject_adminPanel,'som_css_javascript'));
	

	$somclass_users = new somclass_users();
	/*When plugin is activated :*/
	register_activation_hook(__FILE__, array(&$somclass_users,'som_createUserTypes') );
	/*When plugin is desactivated :*/
	register_deactivation_hook(__FILE__, 'som_uninstall' );
?>