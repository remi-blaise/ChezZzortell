<?php //COMPTEUR
$fichier = fopen ('compteurs/vues_resultats.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0); 
fwrite ($fichier, $compteur);
fclose ($fichier);
?>

<link rel="stylesheet" type="text/css" href="included/resultats_tableaux.css" />

<?php //Implémentation de la bibliothèque PHP Simple HTML DOM Parser
include_once('included/simple_html_dom.php');
?>

<?php //Inclusion du head
include ("included/head.php");
?>

<?php //Définition des nav sections
	$nav_sections = array (
								'N1G' =>	'N1 Garçons', 
								'N1F' =>	'N1 Filles', 
								'N2G' =>	'N2 Garçons', 
								'N2F' =>	'N2 Filles', 
								'EQUIP' =>	'Équipes', 
								/*'EQUIP_G' =>	'Équipes G', 
								'EQUIP_F' =>	'Équipes F'*/
							);
?>

<?php //GESTION DU PARAMETRE GETsection
	if (isset ($_GET['section']) && array_key_exists ($_GET['section'], $nav_sections) ) {
		$GETsection = $_GET['section'];
	} else {
		$GETsection = false;
	}
?>
<?php //Définition des nav pages
	if ( !(stripos($GETsection, 'EQUIP') === 0) ) {
		$nav_pages = array (
								'ARBITRES' =>	'Arbitres', 
								'TIREURS' =>	'Tireurs', 
								'POULES' =>	'Poules', 
								'CLASSEMENT_POULES' =>	'Classement après poules', 
								'CLASSEMENT_TABLEAU' =>	'Classement pour tableau', 
								'TABLEAU0A' =>	'Tableau principal 128', 
								'TABLEAU0B' =>	'Tableau principal 8', 
								'CLASSEMENT' =>	'Classement général', 
								'PISTES' =>	'Pistes'
							);
	} else {
		/*$nav_pages = array (
								'ARBITRES' =>	'Arbitres', 
								'TIREURS' =>	'Tireurs', 
								'EQUIPES' =>	'Équipes', 
								'CLASSEMENT_TABLEAU' =>	'Classement pour tableau', 
								'TABLEAU0A' =>	'Tableau principal 32', 
								'TABLEAU0B' =>	'Tableau principal 8', 
								'TABLEAU1' =>	'Matchs de 5e à 8e place', 
								'TABLEAU2' =>	'Tableau N3', 
								'TABLEAU3' =>	'Battus du Tableau 32', 
								'CLASSEMENT' =>	'Classement général', 
								'PISTES' =>	'Pistes'
							);*/
		$nav_pages = array (
								'TABLEAU_H' 	=>	'Tableau init. Hommes', 
								'TABLEAU_N1H' 	=>	'Tableau N1 Hommes', 
								'TABLEAU_N2H' 	=>	'Tableau N2 Hommes', 
								'CLASSEMENT_GH'	=>	'Classement Hommes',
								
								'TABLEAU_D' 	=>	'Tableau initial Dames', 
								'TABLEAU_N1D' 	=>	'Tableau N1 Dames', 
								'TABLEAU_N2D' 	=>	'Tableau N2 Dames', 
								'CLASSEMENT_N1D'	=>	'Classement N1 Dames',
								'CLASSEMENT_N2D'	=>	'Classement N2 Dames'
							);
	}
?>
<?php //GESTION DU PARAMETRE GETpage
	if (isset ($_GET['page']) && array_key_exists ($_GET['page'], $nav_pages) ) {
		$GETpage = strtolower ( $_GET['page'] );
	} else {
		$GETpage = false;
	}
?>
		<div id="bodier" >
<?php //AFFICHAGE DE LA PAGE PAR DEFAUT
	if ( !$GETsection ) {
?>
			<h1 class="green" >Les résultats en ligne</h1>
			<div id="right_container" >
				<section id="main_section" >
					<nav id="first_nav" >
						<div id="column1" class="column" >
							<?php //Création du menu des sections
							foreach ($nav_sections as $section => $title) {
								if ( strpos($section, 'EQUIP') !== 0 ) {
									echo '<a class="green" href="resultats.php?section=' . $section . '"><span class="too_long" >' . $title . '</span></a>';
								}
							}
							?>
						</div>
						<div id="column2" class="column" >
							<?php //Création du menu des sections
							foreach ($nav_sections as $section => $title) {
								if ( stripos($section, 'EQUIP') === 0 ) {
									echo '<a class="green" href="resultats.php?section=' . $section . '"><span class="too_long" >' . $title . '</span></a>';
								}
							}
							?>
						</div>
					</nav>
				</section>
				
				<div id="bodier_illustration_container" >
					<img id="bodier_sabre_green" src="images/bodier_sabre_green.png" alt="Sabre" />
					<img id="bodier_swordsmen_black" src="images/bodier_swordsmen_black.png" alt="Sabreurs" />
				</div>
			</div>
			
			<div id="left_container" >
				<nav id="nav_main" >
					<a class="green" href="resultats.php" title="Résultats de Lames disponibles en temps réél" ><span>Résultats</span></a>
					<a class="index_white" href="index.php" title="Retour à l'accueil" ><span>Accueil</span></a>
				</nav>
				
				<a href="http://www.escrimedelaboucle.fr/" title="Escrime de la Boucle - Le site du club de Chatou !"  target="_blank" ><img id="escrime_boucle" src="images/escrime_boucle.png" alt="Escrime de la boucle" /></a>
			</div>
<?php //AFFICHAGE DE LA FORMULE INDIV
	} else if ( $GETsection !== 'EQUIP' ) {
?>
			<div id="reload_a" >
				<a href="" title="Recharger la page" ><img id="reload" src="images/reload.png" alt="Actualiser" /></a>
			</div>
			<nav id="nav_left" >
					<?php //Création de la moitié gauche du menu des pages
					$i = 0;
					$c = (count ($nav_pages)+1)/2;
					foreach ($nav_pages as $page => $title) {
						$i++;
						if ( $i <= $c ) {
							if ( strpos ($page, 'CLASSEMENT') === 0 ||  strpos ($page, 'TABLEAU') === 0 ) {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
							} else {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span>' . $title . '</span></a>';
							}
						}
					}
					?>
			</nav>
			<section id="section_center" >
				<h1 class="green" id="h1_resultats" >
					<?php echo $nav_sections [$GETsection]; ?>
					<br/>Résultats en ligne
				</h1>
				<?php
				if ( file_exists('lames/' . $GETsection . '/formule.html') ) {
					//Récupération de la formule
					$lames = file_get_html ('lames/' . $GETsection . '/formule.html');
					$div = $lames->find('div[id=main-container]');
					$div[0]->id = 'formule_container';
					echo $div[0]->outertext;
				} else {
					?>
					<p>
						Les résultats de cette compétition ne sont pas encore en ligne.
					</p>
					<?php
				}
				?>
			</section>
			<nav id="nav_right" >
					<?php //Création de la moitié droite du menu des pages
					$i = 0;
					$c = (count ($nav_pages)+1)/2;
					foreach ($nav_pages as $page => $title) {
						$i++;
						if ( $i > $c ) {
							if ( strpos ($page, 'CLASSEMENT') === 0 ||  strpos ($page, 'TABLEAU') === 0 ) {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
							} else {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span>' . $title . '</span></a>';
							}
						}
					}
					?>
					<a class="back_white" href="resultats.php" title="Retour aux résultats" ><span>Résultats</span></a>
			</nav>
			
			<div id="bodier_illustration_container" >
				<img id="bodier_sabre_green" src="images/bodier_sabre_green.png" alt="Sabre" />
			</div>
<?php //AFFICHAGE DE LA FORMULE EQUIP
	} else {
?>
			<div id="reload_a" >
				<a href="" title="Recharger la page" ><img id="reload" src="images/reload.png" alt="Actualiser" /></a>
			</div>
			<nav id="nav_left" style="vertical-align: middle;" >
					<?php //Création de la moitié gauche du menu des pages
					$i = 0;
					$c = (count ($nav_pages)+1)/2;
					foreach ($nav_pages as $page => $title) {
						$i++;
						if ( $i <= $c ) {
							echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
						}
					}
					?>
			</nav>
			<section id="section_center" style="min-height: 0; vertical-align: middle;" >
				<h1 class="green" id="h1_resultats" >
					<?php echo $nav_sections [$GETsection]; ?>
					<br/>Résultats en ligne
				</h1>
			</section>
			<nav id="nav_right" style="vertical-align: middle;" >
					<?php //Création de la moitié droite du menu des pages
					$i = 0;
					$c = (count ($nav_pages)+1)/2;
					foreach ($nav_pages as $page => $title) {
						$i++;
						if ( $i > $c ) {
							if ( strpos ($page, 'CLASSEMENT') === 0 ||  strpos ($page, 'TABLEAU') === 0 ) {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
							} else {
								echo '<a class="green" href="resultats.php?section=' . $GETsection . '&page=' . $page . '"><span>' . $title . '</span></a>';
							}
						}
					}
					?>
					<a class="back_white" href="resultats.php" title="Retour aux résultats" ><span>Résultats</span></a>
			</nav>
			
			<div id="bodier_illustration_container" >
				<img id="bodier_sabre_green" src="images/bodier_sabre_green.png" alt="Sabre" />
			</div>
			<?php if ( !$GETpage ) {
			
			} else {
				if ( file_exists('lames/EQUIP/' . $GETpage . '.html') ) {
					echo '<iframe src="' . 'lames/EQUIP/' . $GETpage . '.html' . '" width="696" height="1000" >Désolé, votre navigateur ne vous permet pas de voir les résultats ...</iframe>';
				} else { ?>
					<p>
						Cette page n'est pas encore en ligne.
					</p>
			<?php } 
			} ?>
<?php //AFFICHAGE DU TABLEAU LAMES
	}
	if ( $GETpage && $GETsection !== 'EQUIP' ) {
?>
			<section id="section_page" >
				<?php
				if ( file_exists('lames/' . $GETsection . '/' . $GETpage . '.html') ) {
					//Récupération de la page
					$lames = file_get_html ('lames/' . $GETsection . '/' . $GETpage . '.html');
					$div_page_container = $lames->find('div[id=main-container]')[0];
					$div_page_container->id = 'page_container';
					
					//Autres traitements ...
					if ( strpos ($GETpage, 'pistes') === 0 ) {
						if ( strpos ($div_page_container, 'Kolejność / wyniki / protokoły') !== false ) {
							$returned = str_replace ('Kolejność / wyniki / protokoły', '', $div_page_container);
							$div_page_container = str_get_html ( $returned );
						}
					}
					elseif ( strpos ($GETpage, 'tableau') === 0 ) {
						$div_page_container->class = 'tableau';
						if ( $div_page_container->find('div.FOOTER', 0) ) {
							$returned = str_replace ( $div_page_container->find('div.FOOTER', 0), '', $div_page_container );
							$div_page_container = str_get_html ( $returned );
						}
						if ( $div_page_container->find('a[onclick]', 0) ) {
							$returned = str_replace ( $div_page_container->find('a[onclick]'), '', $div_page_container );
							$div_page_container = str_get_html ( $returned );
						}
						if ( $div_page_container->find('br', 0) ) {
							$returned = str_replace ( $div_page_container->find('br'), '', $div_page_container );
							$div_page_container = str_get_html ( $returned );
						}
					}
					
					//Affichage de la page
					echo $div_page_container->outertext;
				} else {
					echo 'Cette page n\'est pas encore disponible.<br/>';
				}
				?>
			</section>
<?php //FIN
	}
?>
		</div>

<?php //Inclusion du foot
include ("included/foot.php");
?>