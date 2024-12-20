<?php
	include '../CONTROLLER/livreurC.php';

	$message = "" ; 
	$livreurC=new livreurC();
	$livreurC->supprimerlivreur($_GET["id_livreur"]);
	header('Location:indexLivreur.php?message= Livreur Supprimée avec succés');
?>
