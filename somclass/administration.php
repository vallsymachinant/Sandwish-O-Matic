<?php
class somclass_administration {

	public $url;
	
	public function __construct() {
		//$this->url = get_option('siteurl') . '/wp-content/plugins/';
		$this->url = '/../';
	}
	
	public  function som_adminPanel(){
		//echo(dirname(__FILE__). '/../views/som_adminPanel.php');
		include(dirname(__FILE__). '/../views/som_adminPanel.php');
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
	//Sous menu : Options générales
	public function som_adminPanelBasicOptions(){
		include(dirname(__FILE__). '/../views/som_adminPanelBasicOptions.php');
	}
	//Sous menu : Gestion des produits
	public function som_adminPanelProductOptions(){
		include(dirname(__FILE__). '/../views/som_adminPanelProductOptions.php');
	}
	//Sous menu : Gestion des commandes
	public function som_adminPanelOrderManagement(){
		include(dirname(__FILE__). '/../views/som_adminPanelOrderManagement.php');
	}
	//Sous menu : Gestion des clients
	public function som_adminPanelCustomerManagement(){
		include(dirname(__FILE__). '/../views/som_adminPanelCustomerManagement.php');
	}
	//Sous menu : Suivi des clients
	public function som_adminPanelCustomerTracking(){
		include(dirname(__FILE__). '/../views/som_adminPanelCustomerTracking.php');
	}
	//Insère le CSS du paneau d'administration
	public function som_css_javascript() {
		$url = $this->url . 'som_style.css';
		echo '<link href="'.$url.'" rel="stylesheet" type="text/css" />';
	}
}
