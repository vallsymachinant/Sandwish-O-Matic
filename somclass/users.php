<?php
class somclass_users{
	//Ajoute le type "Client" aux types d'utilisateurs dans la base de donnée !
	public function som_createUserTypes(){
		$result = add_role('client', 'Client', array(
			'read' => true, // True allows that capability
			'edit_posts' => true,
			'delete_posts' => false, // Use false to explicitly deny
		));
		if (null !== $result) {
			echo 'Yay!  New role created!';
		} else {
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
			//echo 'Oh... the basic_contributor role already exists.';
		}
	}
	//Enleve le type "Client" aux types d'utilisateurs de la base de donnée !
	public function som_deleteUserTypes(){
		remove_role('client');
		remove_role('som_admin');
	}
}
