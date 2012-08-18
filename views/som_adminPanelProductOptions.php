 <!--Fonctions à rajouter dans le som.php-->
 <?php 
	function som_addFootNav(){
		echo'<tr>';
		echo '<th>Vous devez créer un nouveau type de produit, Cliquez ici.</th>';
		echo '<th><a href="'.$_SERVER["HTTP_REFERER"].'">Retourner à la page précédente</a></th>';
		echo'</tr>';
	}
	function som_addHeaderTable($title){
		echo'<thead>
			<tr>
			<th COLSPAN=2>
			'.$title.'
			</th>
			<th>
			</th>	
			<th>
			</th>		
			</tr>
		</thead>';
	}
	function som_addProductMenu(){
		if (isset($_GET["productType"]) && $_GET["productType"] == 'Autres'){
			som_addFootNav();
			}
		else if (isset($_GET["productType"]) && $_GET["productType"] == 'Boissons'){
			if (isset($_GET["productType2"]) && $_GET["productType2"] == 'BoissonFroide'){	
				som_addHeaderTable('Selectionnez une boisson');
				echo'<tr class="som_adminButtons">';
				echo'<td>Eau plate</td>';
				echo'<td>Eau pétillante</td>';
				echo'<td>Coca-cola</td>';
				echo'</tr>';	
				echo'<tr class="som_adminButtons">';
				echo'<td>Fanta</td>';
				echo'<td>Sprite</td>';
				echo'<td>Vin</td>';
				echo'</tr>';
				som_addHeaderTable('Informations concernant ce produit');
				echo'<td>
					Prix : <INPUT type=text name="prenom">
					<SELECT name="fonction">
					<OPTION VALUE="Sur place">Sur place</OPTION>
					<OPTION VALUE="A emporter">A emporter</OPTION>
					</SELECT>
				</td>';
				som_addFootNav();
				}
			else if (isset($_GET["productType2"]) && $_GET["productType2"] == 'BoissonChaude'){	
				som_addHeaderTable('Selectionnez une boisson');
				echo'<tr class="som_adminButtons">';
				echo'<td>Café</td>';
				echo'<td>Thé</td>';
				echo'<td>Soupe</td>';
				echo'</tr>';	
				echo'<tr class="som_adminButtons">';
				echo'<td>Chocolat chaud</td>';
				echo'<td>Vin chaud</td>';
				echo'</tr>';
				som_addHeaderTable('Informations concernant ce produit');
				echo'<td>
					Prix : <INPUT type=text name="prenom">
					<SELECT name="fonction">
					<OPTION VALUE="Sur place">Sur place</OPTION>
					<OPTION VALUE="A emporter">A emporter</OPTION>
					</SELECT>
				</td>';
				som_addFootNav();
				}
			else{
				echo'<tr class="som_adminButtons">';
				echo '<td><a href="'.$_SERVER["REQUEST_URI"].'&productType2=BoissonFroide">Boisson Froide</a></td>';		
				echo '<td><a href="'.$_SERVER["REQUEST_URI"].'&productType2=BoissonChaude">Boisson Chaude</a></td>';		
				echo'</tr>';
				som_addFootNav();
			}
		}	
		else if (isset($_GET["productType"]) && $_GET["productType"] == 'Sandwish'){
			som_addHeaderTable('Selectionnez un type de Sandwish');
			echo'<tr class="som_adminButtons">';
			echo'<td>Sandwish Chaud</td>';
			echo'<td>Sandwish Froid</td>';
			echo'</tr>';
			som_addHeaderTable('Selectionnez une taille de Sandwish');
			echo'<tr class="som_adminButtons">';
			echo'<td>1/4 de Baguette</td>';
			echo'<td>1/2 Baguette</td>';
			echo'<td>1 Baguette</td>';
			echo'</tr>';
			echo'<tr class="som_adminButtons">';
			echo'<td>1 Pistolet</td>';
			echo'<td>1 Ciabata</td>';
			echo'</tr>';
			som_addHeaderTable('Selectionnez les ingrédients');
			echo'<tr class="som_adminButtons">';
			echo'<td>Viandes</td>';
			echo'<td>Fromages</td>';
			echo'<td>Crudités</td>';
			som_addFootNav();
			}
		/*Affiche si aucun paramètre dans l'url*/
		else{
		$productTypes = array('Autres','Boissons','Sandwish');
			echo'<tr class="som_adminButtons">';
			foreach ($productTypes as $productType){
			echo '<td><a href="'.$_SERVER["REQUEST_URI"].'&productType='.$productType.'">'.$productType.'</a></td>';		
			}
			echo'</tr>';
		}
	}	
 ?>
  
<div class="wrap">
<h2>Bienvenue dans Sandwish-O-Matic</h2>
<h3>Apprenez à configurer votre site.<h3>
<table class="widefat">
		<?php som_addHeaderTable('Mes produits existants');?>
<tbody>
	<tr>
		<th COLSPAN=2>
			NOTE : Contiendra la liste des produits crées par le commerçant
		</th>
		<th>
		</th>	
		<th>
		</th>
	</tr>
</tbody>
		<?php som_addHeaderTable('Selectionnez un type de produit');?>
<tbody>
	<tr>
		<th COLSPAN=2>
		<p>NOTE : Choix du type de produit en fonction des types de produits existants</p>
		</th>
		<td></td>
		<td></td>
	</tr>
		<?php som_addProductMenu();?>
</tbody>
</table>

