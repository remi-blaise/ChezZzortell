<?php  //HEAD
include ("included/head.php");
?>

<script src="included/lightbox/js/jquery-1.11.0.min.js"></script>
<script src="included/lightbox/js/lightbox.min.js"></script>
<link href="included/lightbox/css/lightbox.css" rel="stylesheet" />

<?php //GESTION DES SECTIONS
//Définition des sections
	$sectionArray = scandir( './photos', 1);
	array_pop ($sectionArray);
	array_pop ($sectionArray);
	unset ( $sectionArray [ in_array ( 'club', $sectionArray ) ] );
	unset ( $sectionArray [ in_array ( 'week_end', $sectionArray ) ] );
	unset ( $sectionArray [ in_array ( 'finales', $sectionArray ) ] );
	
	$nav_sections = array (
								// 'week_end' => 'Week-end',
								'FINALES' => 'Les finales',
								// 'N1G' =>	'N1 Garçons', 
								// 'N1F' =>	'N1 Filles', 
								'N2G' =>	'N2 Garçons', 
								'N2F' =>	'N2 Filles', 
								// 'EQUIP_G' =>	'Équipes G', 
								'EQUIP_F' =>	'Équipes F'
							);
//Gestion du paramètre section
	if (isset ($_GET['section']) && array_key_exists ($_GET['section'], $nav_sections) ) {
		$GETsection = $_GET['section'];
	} else {
		$GETsection = false;
	}
?>

<?php //GESTION DES PAGES
$GETpage = false;
if ( $GETsection ) {
	//Récupération des nav_pages
		$pages_srcArray = scandir( './photos/' . $GETsection, 1);
		array_pop ($pages_srcArray);
		array_pop ($pages_srcArray);
		$pages_srcLength = count($pages_srcArray);
		$nav_pages = array ();
		foreach ($pages_srcArray as $page) {
			$nav_pages [ strtoupper($page) ] = ucfirst( strtolower( str_replace('_', ' ', $page) ) );
		}
	//Gestion du paramètre page
		if (isset ($_GET['page']) && array_key_exists ($_GET['page'], $nav_pages) ) {
			$GETpage = strtolower ( $_GET['page'] );
		} else {
			$GETpage = false;
		}
}
?>

<?php //Récupération des chemins des photos
	if ( $GETpage ) {
		$dossier = $GETsection . '/' . $GETpage;
	} else {
		$dossier = 'club';
	}
	if ( $GETpage === 'week_end' ) {
		$dossier = 'week_end';
	}
	if ( $GETpage === 'finales' ) {
		$dossier = 'finales';
	}
	$photos_srcArray = scandir('photos/' . $dossier, 1);
	array_pop ($photos_srcArray);
	array_pop ($photos_srcArray);
	$photos_srcLength = count($photos_srcArray);
?>
		<div id="bodier" >
			<?php
			if ( $GETsection ) {
				echo '<h1 class="blue" >Les photos : ' . $nav_sections[$GETsection] . '</h1>';
			} else {
				echo '<h1 class="blue" >Les photos</h1>';
			}
			?>
<?php //AFFICHAGE DE LA PAGE DES PHOTOS 
	if ( !$GETsection || ($GETsection && $GETpage) ) {
?>
			<div id="right_container" >
				<section id="main_section" class="photos" >
				
					<div id="arrow_top_container" class="arrow_vertical_container" >
						<button id="button_top" type="button" style="display: none;" >
							<img class="arrow_vertical" id="arrow_top" src="images/arrow_top_blue.png" alt="Précédents" title="Précédents" />
						</button>
					</div>
					<div id="photos_container" >
						<div id="column1" class="column" >
							<?php
							foreach ( $photos_srcArray as $id => $photo_src ) {
								if ( $id < $photos_srcLength/2 ) {
									$display = '';
									if ( $id > 2 ) {
										$display = 'display: none;';
									}
									echo '
										<div class="photo_container" style="' . $display . '" >
											<a href="photos/' . $dossier . '/' . $photo_src . '" class="_img" data-lightbox="photos" >
												<img class="photo" src="photos/' . $dossier . '/' . $photo_src . '" alt="photo' . $id . '" />
											</a>
										</div>
									';
								}
							}
							?>
						</div>
						<div id="column2" class="column" >
							<div class="heigth20px" ></div>
							<?php
							foreach ( $photos_srcArray as $id => $photo_src ) {
								if ( $id >= $photos_srcLength/2 ) {
									$display = '';
									if ( $id >= $photos_srcLength/2+3 ) {
										$display = 'display: none;';
									} else {
										$display = 'display: block;';
									}
									echo '
										<div class="photo_container" style="' . $display . '" >
											<a href="photos/' . $dossier . '/' . $photo_src . '" data-lightbox="photos" >
												<img class="photo" src="photos/' . $dossier . '/' . $photo_src . '" alt="photo' . $id . '" />
											</a>
										</div>
									';
								}
							}
							?>
						</div>
					</div>
					<div id="arrow_bottom_container" class="arrow_vertical_container" >
						<button id="button_bottom" type="button" <?php if ( $photos_srcLength <= 6 ) { echo 'style=" display: none;" '; } ?>>
							<img class="arrow_vertical" id="arrow_bottom" src="images/arrow_bottom_blue.png" alt="Suivants" title="Suivants" />
						</button>
					</div>
				</section>
			</div>
<?php //AFFICHAGE DE LA SECTION
	} elseif ( !$GETpage ) {
?>
			<div id="right_container" >
				<section id="main_section" class="photos" style="margin-left: 55px;" >
					<nav id="first_nav" >
						<div id="column1" class="column" >
							<?php //Création du menu des sections
							$i = 0;
							foreach ($nav_pages as $page => $title) {
								if ( $i <= ($pages_srcLength-1)/2 ) {
									echo '<a class="blue" href="photos.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
								}
								$i++;
							}
							?>
						</div>
						<div id="column2" class="column" >
							<?php //Création du menu des sections
							$i = 0;
							foreach ($nav_pages as $page => $title) {
								if ( $i > ($pages_srcLength-1)/2 ) {
									echo '<a class="blue" href="photos.php?section=' . $GETsection . '&page=' . $page . '"><span class="too_long" >' . $title . '</span></a>';
								}
								$i++;
							}
							?>
						</div>
					</nav>
				</section>
			</div>
<?php //FIN
	}
?>
			<div id="left_container" >
				<nav id="nav_main" >
					<?php //AFFICHAGE DU MENU
					if ( !$GETsection || !$GETpage ) {
						echo '<a class="blue" href="photos.php" ><span>Le club</span></a>';
						foreach ( $nav_sections as $section => $title ) {
							echo '<a class="blue" href="photos.php?section=' . $section . '" ><span>' . $title . '</span></a>';
						}
						echo '<a class="youtube" href="youtube.php" title="Vers notre chaîne >>>" target="_blank" ><span>Youtube</span></a>';
					} else {
						echo '<a class="blue" href="photos.php?section=' . $GETsection . '&page=' . strtoupper ($GETpage) . '" ><span>' . $nav_pages [ strtoupper ($GETpage) ] . '</span></a>';
						echo '<a class="back_white" href="photos.php?section=' . $GETsection . '" ><span>' . $nav_sections [ $GETsection ] . '</span></a>';
					}
					?>
					<a class="index_white" href="index.php" title="Retour à l'accueil" ><span>Accueil</span></a>
				</nav>
				<p class="encart" >
					Les photos de la compet' seront disponibles dans les jours suivants celle-ci.
				</p>
				<?php if ( !$GETsection || ($GETsection && $GETpage) ) { ?>
				<div id="arrow_max_container" >
					<div class="button_max_container" >
						<button id="button_max_top" type="button" style=" display: none;" >
							<img class="arrow_max" id="max_top" src="images/max_top.png" alt="Au début" title="Au début" />
						</button>
					</div>
					<div class="button_max_container" >
						<button id="button_max_bottom" type="button" <?php if ( $photos_srcLength <= 6 ) { echo 'style=" display: none;" '; } ?>>
							<img class="arrow_max" id="max_bottom" src="images/max_bottom.png" alt="À la fin" title="À la fin" />
						</button>
					</div>
				</div>
				<?php } ?>
				<a href="http://www.escrimedelaboucle.fr/" title="Escrime de la Boucle - Le site du club de Chatou !"  target="_blank" ><img id="escrime_boucle" src="images/escrime_boucle.png" alt="Escrime de la boucle" /></a>
			</div>
		</div>
		
<script src="included/photos_dynamic.js"></script>

<?php //FOOT
include ("included/foot.php");
?>