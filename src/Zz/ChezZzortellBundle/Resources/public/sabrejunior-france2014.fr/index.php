<?php //COMPTEUR
$fichier = fopen ('compteurs/vues_index.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0); 
fwrite ($fichier, $compteur);
fclose ($fichier);
?>

<?php //COMPTEUR
if (isset ($_GET['src']) && $_GET['src'] === 'qrcode') {
	$fichier = fopen ('compteurs/vues_index_via_qrcode.txt', 'r+');
	$compteur = fgets ($fichier);
	settype ($compteur, 'int');
	$compteur++;
	settype ($compteur, 'string');
	fseek ($fichier, 0); 
	fwrite ($fichier, $compteur);
	fclose ($fichier);
}
?>

<?php  //HEAD
include ("included/head.php");
?>
		<div id="bodier" >
			<h1>Accueil</h1>
			<div id="right_container" >
				<section id="main_section" style="padding-bottom: 80px;" >
					<p class="accueil" >
						<strong>Bienvenue sur le site officiel 
						<br/>des Championnats de France 
						<br/>de Sabre Juniors 2014 !</strong>
					</p>
					<br/>
					<p class="accueil" >
						Bonjour à tous ! Les Championnats se sont formidablement bien passés, et le site a été vu par plus de 25 000 visiteurs de toute la France ! 
						Bravo à tous les bénévoles pour l'organisation de cette compétition !
					</p>
					<br/>
					<p class="accueil" >
						Les derniers <a href="resultats.php" >résultats</a> sont désormais mis en ligne, et les photos le seront sous peu !
					</p>
					<br/>
					<a href="https://fr.surveymonkey.com/s/LXCN7Z5" target="_blank" >
						<img id="button_survey" src="images/button_survey.png" alt="Répondre au sondage" 
							style="float: left;" />
					</a>
					<p class="accueil" >
						Nous souhaiterions avoir votre avis sur différents points de l'organisation.
						Nous effectuons donc un sondage et vos réponses seraient appréciées.
						<br/>Merci d’avance !
						<br/>
						
					</p>
					<br/>
					<p class="accueil" >
						Ce site a été conçu et réalisé par <a href="http://www.f-berrube.fr/" target="_blank">François Berrubé</a> et <a href="http://zzortell.perso.sfr.fr/" target="_blank" >Rémi Blaise</a> !
					</p>
				</section>
				
				<div id="part2" >
					<p>
						Centre sportif Roger Corbin
						<br/>78400 Chatou
					</p>
					<img id="sabre_right_container" src="images/bodier_sabre_black.png" alt="Sabre" />
				</div>
				
				<div id="part3" >
					<div>
						<h1>Dernier témoignage :</h1>
						<a href="temoignages.php" class="no_decoration" >
							<p id="quote" >
								<span>Alexandre Maldera</span>
								<br/>Président du Comité d'Organisation 
								<br/>des Championnats de France à Chatou
							</p>
						</a>
					</div>
					<div>
						<h1>Téléchargez :</h1>
						<img id="downloads" src="images/downloads.png" alt="Downloads" usemap="#map" />
						<map id="map" name="map">
							<area shape="rect" coords="14, 3, 79, 104" href="docs/affiche.pdf" alt="Affiche" target="_blank" />
							<area shape="rect" coords="103, 4, 229, 98" href="docs/dossier_presse.pdf" alt="Dossier de presse" target="_blank" />
						</map>
					</div>
				</div>
			</div>
			
			<div id="left_container" >
				<nav id="nav_main" >
<?php include ("included/nav_first.php"); ?>
				</nav>
				<!--<p class="encart" >
					Les résultats seront mis en ligne en direct le jour de la compétition.
				</p>-->
				
				<a href="http://www.escrimedelaboucle.fr/" title="Escrime de la Boucle - Le site du club de Chatou !"  target="_blank" ><img id="escrime_boucle" src="images/escrime_boucle.png" alt="Escrime de la boucle" /></a>
			</div>
		</div>
<?php //FOOT
include ("included/foot.php");
?>