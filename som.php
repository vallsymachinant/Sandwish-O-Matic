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
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/som_style.css';

	//Set Up Class
	if (!class_exists("somclass_administration")) {		

		class somclass_administration {

			public  function som_adminPanel(){
				include('views/som_adminPanel.php');
			}
			
			function Configuremenu() {
					$appName = 'Sandwish-O-Matic';
					$appID = 'somatic_plugin';
				if ( current_user_can('som_admin') ) {
					add_menu_page($appName, $appName, 'som_admin', $appID, array(&$this,'som_adminPanel'));
					add_submenu_page( $appID,'Options générales','Options générales','som_admin','somatic_plugin_basic_options', array(&$this,'som_adminPanelBasicOptions'));
					add_submenu_page( $appID,'Mes Produits','Mes Produits','som_admin','somatic_plugin_product_options', array(&$this,'som_adminPanelProductOptions'));
					add_submenu_page( $appID,'Gestion des commandes','Historique des commandes','som_admin','somatic_plugin_order_management', array(&$this,'som_adminPanelOrderManagement'));
					add_submenu_page( $appID,'Gestion des clients','Gestion des clients','som_admin','somatic_plugin_customer_management', array(&$this,'som_adminPanelCustomerManagement'));
					add_submenu_page( $appID,'Suivi client','Suivi client','som_admin','somatic_plugin_customer_tracking', array(&$this,'som_adminPanelCustomerTracking'));
				}
				else {
					// Ajouter le panneau d'administration SOM
					add_menu_page($appName, $appName, 'administrator', $appID, array(&$this,'som_adminPanel'));
					add_submenu_page( $appID,'Options générales','Options générales','administrator','somatic_plugin_basic_options', array(&$this,'som_adminPanelBasicOptions'));
					add_submenu_page( $appID,'Mes Produits','Mes Produits','administrator','somatic_plugin_product_options', array(&$this,'som_adminPanelProductOptions'));
					add_submenu_page( $appID,'Gestion des commandes','Historique des commandes','administrator','somatic_plugin_order_management', array(&$this,'som_adminPanelOrderManagement'));
					add_submenu_page( $appID,'Gestion des clients','Gestion des clients','administrator','somatic_plugin_customer_management', array(&$this,'som_adminPanelCustomerManagement'));
					add_submenu_page( $appID,'Suivi client','Suivi client','administrator','somatic_plugin_customer_tracking', array(&$this,'som_adminPanelCustomerTracking'));
				}
			}
			/*Sous menu : Options générales */
			public function som_adminPanelBasicOptions(){
				include('views/som_adminPanelBasicOptions.php');
			}
			/*Sous menu : Gestion des produits*/
			public function som_adminPanelProductOptions(){
				include('views/som_adminPanelProductOptions.php');
			}
			/*Sous menu : Gestion des commandes*/
			public function som_adminPanelOrderManagement(){
				include('views/som_adminPanelOrderManagement.php');
			}
			/*Sous menu : Gestion des clients*/
			public function som_adminPanelCustomerManagement(){
				include('views/som_adminPanelCustomerManagement.php');
			}
			/*Sous menu : Suivi des clients*/
			public function som_adminPanelCustomerTracking(){
				include('views/som_adminPanelCustomerTracking.php');
			}
			/*Insère le CSS du paneau d'administration*/
			public function som_css_javascript() {
				$url = '/som_style.css';
				echo '<link href="'.$url.'" rel="stylesheet" type="text/css" />';
			}
		}
    } 
	
	/*Classe Utilisateurs*/
	if (!class_exists("somclass_users")) {	
		class somclass_users{
			/*Ajoute le type "Client" aux types d'utilisateurs dans la base de donnée !*/
			public function som_createUserTypes(){
				$result = add_role('client', 'Client', array(
					'read' => true, // True allows that capability
					'edit_posts' => true,
					'delete_posts' => false, // Use false to explicitly deny
				));
				if (null !== $result) {
					echo 'Yay!  New role created!';
				} else {
					/* Provoque des erreurs -> L’extension a généré 96 caractères 
					d’affichage inattendu lors de l’activation. Si vous voyez un message 
					« headers already sent » (Les en-têtes ont déjà été envoyés), des problèmes
					avec les flux de syndication ou d’autres erreurs, essayez 
					de désactiver ou enlever cette extension.
					*/
					//echo 'Oh... the basic_contributor role already exists.';
				}
					$result = add_role('som_admin', 'Administrateur SOM', array(
					'read' => true, // True allows that capability
					'edit_posts' => true,
					'delete_posts' => false, // Use false to explicitly deny
				));
				if (null !== $result) {
					echo 'Yay!  New role created!';
				} else {
					/* Provoque des erreurs -> L’extension a généré 96 caractères 
					d’affichage inattendu lors de l’activation. Si vous voyez un message 
					« headers already sent » (Les en-têtes ont déjà été envoyés), des problèmes
					avec les flux de syndication ou d’autres erreurs, essayez 
					de désactiver ou enlever cette extension.
					*/
					//echo 'Oh... the basic_contributor role already exists.';
				}
			}
			/*Enleve le type "Client" aux types d'utilisateurs de la base de donnée !*/
			public function som_deleteUserTypes(){
				remove_role('client');
				remove_role('som_admin');
			}
		}
	}
	
	
	function som_uninstall(){}
	
	
	//Create new instance of class
    if (class_exists("somclass_administration")) {
		$somobject_adminPanel = new somclass_administration();
    }

	//Actions and Filters
	if(isset($somobject_adminPanel)){

		// Administration Actions
		add_action('admin_menu', array($somobject_adminPanel,'Configuremenu'));
		//add_action('admin_head', array($somobject_adminPanel,'som_css_javascript'));
	}





	
	/*When plugin is activated :*/
	register_activation_hook(__FILE__, array('somclass_users','som_createUserTypes') );
	/*When plugin is desactivated :*/
	register_deactivation_hook(__FILE__, 'som_uninstall' );
?>