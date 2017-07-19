<?php  //HEAD
include ("included/head.php");
?>

<script src="included/lightbox/js/jquery-1.11.0.min.js"></script>
<script src="included/lightbox/js/lightbox.min.js"></script>
<link href="included/lightbox/css/lightbox.css" rel="stylesheet" itemprop />

		<div id="bodier" >
			<h1 class="orange" >Les témoignages</h1>
			<div id="right_container" >
				<section id="main_section" style="padding-bottom: 80px;" >
					
					<div id="arrow_top_container" class="arrow_vertical_container" >
						<button id="button_top" type="button" style="" >
							<img class="arrow_vertical" id="arrow_top" src="images/arrow_top_orange.png" alt="Précédent" />
						</button>
					</div>
					<?php
						$temoignages = array (
							'
								<span>Stéphane Toquet</span>
								<br/>Entraineur à l\'Escrime de la Boucle
							',
							'
								<span>Bruno Gaby</span>
								<br/>Membre de la Commission Nationale d\'Arbitrage
							',
							'
								<span>Jérôme Chambourdon</span>
								<br/>Président de l\'Escrime de la Boucle
							',
							'
								<span>Philippe Boisse</span>
								<br/>Président de la Ligue d’Escrime Ile France Ouest
							',
							'
								<span>Ghislain Fournier</span>
								<br/>Maire de Chatou
								<br/>Vice-Président du Conseil général des Yvelines
							',
							'
								<span>David Lebeurier</span>
								<br/>Gérant de Sport 7
							',
							'
								<span>Manon Brunet</span>
								<br/>Cercle d\'Escrime Orléannais
								<br/>Vice Championne du monde par équipe junior 2014
							',
							'
								<span>Patrick Dubos</span>
								<br/>Responsable Commission Sabre de La Réunion
							',
							'
								<span>Nael Canali</span>
								<br/>Licencié au club de Meylan
								<br/>Champion de France junior 2014
								<br/>Champion de France par équipe 2013
							',
							'
								<span>René Roch</span>
								<br/>Président d\'Honneur de la Fédération internationale d\'Escrime
							',
							'
								<span>Alexandre Maldera</span>
								<br/>Président du Comité d\'Organisation 
								<br/>des Championnats de France à Chatou
							'
						);
					?>
					<?php
					foreach ( $temoignages as $id => $html ) {
						$display = '';
						if ( $id < count($temoignages)-3 ) {
							$display = 'display: none;';
						}
						echo '
					<span class="temoignages_container" style="' . $display . '" >
						<a href="temoignages/' . $id . '.png" class="temoignages" data-lightbox="temoignages" >
							<p id="t' . $id . '" >
								' . $html . '
							</p>
						</a>
						<img class="temoignages_sabre_orange" src="images/temoignages_sabre_orange.png" alt="Sabre" />
					</span>
					';
					}
					?>
					<div id="arrow_bottom_container" class="arrow_vertical_container" >
						<button id="button_bottom" type="button" style="display: none;" >
							<img class="arrow_vertical" id="arrow_bottom" src="images/arrow_bottom_orange.png" alt="Suivant" />
						</button>
					</div>
				
				</section>
				
				<img id="sabre_right_container" src="images/bodier_sabre_black.png" alt="Sabre" />
			</div>
			
			<div id="left_container" >
				<nav id="nav_main" >
					<a class="orange" href="temoignages.php" title="Tous les témoignages de la compét' ici !"><span class="too_long" >Témoignages</span></a>
					<a class="index_white" href="index.php" title="Retour à l'accueil" ><span>Accueil</span></a>
				</nav>
				
				<a href="http://www.escrimedelaboucle.fr/" title="Escrime de la Boucle - Le site du club de Chatou !"  target="_blank" ><img id="escrime_boucle" src="images/escrime_boucle.png" alt="Escrime de la boucle" /></a>
			</div>
		</div>

<script src="included/temoignages_dynamic.js"></script>

<?php //FOOT
include ("included/foot.php");
?>