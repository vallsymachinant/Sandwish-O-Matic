<div class="wrap">
<h2>Bienvenue dans Sandwish-O-Matic</h2>
<h3>NOTE : Contiendra la liste des clients</h3>
<?php
	/*Requêtes Base de donnée*/
	global $wpdb;
	$som_customers = $wpdb->get_results(
		"
		SELECT ID, user_nicename
		FROM $wpdb->wp_users
		WHERE ID='1'
		"
	);
	/*Récupère la liste des utilisateurs ayant le role Client*/
	$som_users = get_users('role=client');
?>
<table class="widefat">
<thead>
	<tr>
		<th>
		Gestion des clients
		</th>
	</tr>
</thead>
<tbody>
	<tr>

		<th>
			Nom et Prénom
		</th>	
		<th>
			Adressse E-Mail
		</th>
	</tr>
		<?php
			//echo '<td>'.wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC&number=3').'</td>';
			/*Met en page les résultats de la requete SQL se trouvant dans le fichier som.php*/
			foreach ($som_users as $som_user){
				echo '<tr>';
				echo '<td>'.$som_user->display_name.'</td>';
				echo '<td>'.$som_user->user_email.'</td>';
				echo '</tr>';
			}
		?>
</tbody>
</table>

