<?php  //HEAD
include ("included/head.php");
?>

<script src="included/lightbox/js/jquery-1.11.0.min.js"></script>
<script src="included/lightbox/js/lightbox.min.js"></script>
<link href="included/lightbox/css/lightbox.css" rel="stylesheet" />

<?php //Définition des pages et titres du menu
	$nav_resultats = array (
								'ACCES' =>	'Accès', 
								'HORAIRES' =>	'Horaires', 
								'RESTAURATION' =>	'Restauration', 
								'HEBERGEMENT' =>	'Hébergement', 
								'NAVETTES' =>	'Navettes'
							);
?>

<?php //Détermination de la page
	if (isset ($_GET['page']) && array_key_exists ($_GET['page'], $nav_resultats) ) {
		$page = $_GET['page'];
	} else {
		$page = 'ACCES';
	}
?>
		<div id="bodier" >
			<h1 class="red" >Informations pratiques</h1>
			<div id="right_container" >
				<section id="main_section" 
				<?php 
					if ($page === 'HORAIRES') { 
						echo 'style="padding-bottom: 80px;"';
					}
					if ($page === 'ACCES' || $page === 'RESTAURATION' || $page === 'HEBERGEMENT' || $page === 'NAVETTES') {
						echo 'style="padding-bottom: 60px;"';
					}
				?>>
<?php //Contenu principal
	switch ($page) {
		case 'ACCES':
?>
					<h1>Accès</h1>
					<p>
						La compétition se déroulera au <strong>Centre Sportif Roger CORBIN</strong>
				<br/>	<strong>80, rue Auguste Renoir 78400 CHATOU</strong>
				<br/>	
				<br/>	Accès A86 Sortie Chatou 
				<br/>	RER A Direction St Germain en Laye (ou Vésinet Le Pecq) Arrêt Chatou-Croissy
				<br/>	(Attention tous les trains ne s'y arrêtent pas, veillez à l'affichage sur les quais)
					</p>
<?php
		break;
		case 'HORAIRES':
?>
					<h1>Horaires</h1>
					<p>
						<em>Samedi 17 Mai</em>
				<br/>	
				<br/>	Individuels N2 garçons : <br/>Appel 8h - Scratch 8h30 - Début des assauts 9h
				<br/>	Individuels N2 filles : <br/>Appel 8h30 - Scratch 9h - Début des assauts 9h30
				<br/>	Individuels N1 garçons : <br/>Appel 9h - Scratch 9h30 - Début des assauts 10h
				<br/>	Individuels N1 filles : <br/>Appel 9h30 - Scratch 10h - Début des assauts 10h30
					</p>
					<p>
				<br/>	<em>Dimanche 18 Mai</em>
				<br/>	
				<br/>	Équipes garçons : <br/>Appel 8h - Scratch 8h30 - Début des assauts 9h
				<br/>	Équipes filles : <br/>Appel 8h30 - Scratch 9h - Début des assauts 9h30
					</p>
<?php
		break;
		case 'RESTAURATION':
?>
					<h1>Restauration</h1>
					<p>
						Une restauration chaude (barbecue) et froide sera proposée les 2 jours de compétition :
				<br/>
				<br/>	<a href="resto/0.png" class="_img" data-lightbox="resto" >
							<img class="resto" src="resto/0.png" alt="Carte Intérieur Faim" />
						</a>
						<a href="resto/1.png" class="_img" data-lightbox="resto" >
							<img class="resto" src="resto/1.png" alt="Carte Intérieur Soif" />
						</a>
						<a href="resto/2.png" class="_img" data-lightbox="resto" >
							<img class="resto" src="resto/2.png" alt="Carte Extérieur Faim" />
						</a>
					</p>
<?php
		break;
		case 'HEBERGEMENT':
?>
					<h1>Hébergement</h1>
					<p>
						<em>Hôtel Cerise 2 rue Marconi 78400 CHATOU</em>
				<br/>	Téléphone : 01 34 80 85 00
				<br/>	Mail : <a href="mailto:cerise.chatou@exhore.fr">cerise.chatou@exhore.fr</a>
				<br/>	Tarifs championnats de France : 59 € (jusqu’au 5 mai)
				<br/>	
				<br/>	<em>Ibis Budget Rueil Malmaison</em>
				<br/>	147 Bd National 92500 Rueil-Malmaison
				<br/>	Téléphone : 08 92 68 12 78
				<br/>	Mail : <a href="mailto:67h3589-re@accor.com">67h3589-re@accor.com</a>
				<br/>	Tarifs championnats de France : 59 € (jusqu’au 5 mai)
					</p>
<?php
		break;
		case 'NAVETTES':
?>
					<h1>Navettes</h1>
					<p>
						Des navettes sont à votre disposition à partir et vers les hôtels référencés et la gare RER de Chatou-Croissy.
				<br/>	Disponibilités : vendredi soir / samedi matin / samedi soir / dimanche matin / dimanche soir
				<br/>	Merci de nous transmettre par mail vos besoins (jours, heures, trajets, nombre de personnes) au plus tard le 9 Mai.

<?php
		break;
	}
?>
					
				</section>
				
				<div>
					<img id="sabre_right_container" src="images/bodier_sabre_black.png" alt="Sabre" />
				</div>
			</div>
<?php //Contenu principal
	switch ($page) {
		case 'ACCES':
?>
			<iframe width="530" height="270" frameborder="0" style="border:0; float:right"
				src="https://www.google.com/maps/embed/v1/directions?origin=Coll%C3%A8ge%20Auguste%20Renoir%2C%20Rue%20Auguste%20Renoir%2C%20Chatou%2C%20France&destination=RER%20Chatou-Croissy&key=AIzaSyDX8J1o-rbtFZTXz_x8oud7MIW4anhm-xI">
			</iframe>
<?php
		break;
	}
?>
			<div id="left_container" >
				<nav id="nav_main" >
					<?php //Création du menu
					foreach ($nav_resultats as $page => $title) {
						if ( $page === 'RESTAURATION' || $page === 'HEBERGEMENT' ) {
							echo '<a class="red" href="infos.php?page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
						} else {
							echo '<a class="red" href="infos.php?page=' . $page . '"><span>' . $title . '</span></a>';
						}
					}
					?>
					<a class="index_white" href="index.php" title="Retour à l'accueil" ><span>Accueil</span></a>
				</nav>
				
				<a href="http://www.escrimedelaboucle.fr/" title="Escrime de la Boucle - Le site du club de Chatou !"  target="_blank" ><img id="escrime_boucle" src="images/escrime_boucle.png" alt="Escrime de la boucle" /></a>
			</div>
		</div>
<?php //FOOT
include ("included/foot.php");
?>