<?php //COMPTEUR
$fichier = fopen ('compteurs/compteur_tetris.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0); 
fwrite ($fichier, $compteur);
fclose ($fichier);
?>

<?php //BEST_SCORE
$fichier = fopen ('best_score/best_score.txt', 'r+');
$best_score = fgets ($fichier);
$best_score = preg_split ('#//#', $best_score);
fclose ($fichier);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Tetris ! Par Zzortell.</title>
		<link rel="icon" href="images/favicon.ico" />
		<link rel="stylesheet" href="style.css" />
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body id="body" >
		<div id="infos_tests" ></div>
		<h1 class="tetris" >Tetris !</h1>
		<section id="fenetre" >
			<canvas id="matrice" height="551" width="251" > <!-- 25*22=550 et 25*10=250-->
				<p>
				Désolé, votre navigateur ne supporte pas Canvas. 
				Ce jeu a entièrement été fait grâce à la balise Canvas.
				En plus de ce site, votre navigateur peut ne pas supporter de nombreux sites 
				qui possèdent des fonctionnalités récentes ou avancées.
				Les navigateurs périmés sont des menaces de sécurité, brident la créativité des développeurs
				et entravent le développement d'Internet à cause de leur fonctionnalités limitées et de leur nombreux bugs. 
				Nous vous conseillons donc fortement de mettre votre navigateur à jour : <br/>
				<a href="http://www.browser-update.org/fr/update-browser.html" > Mettre à jour son navigateur. </a>
				</p>
			</canvas>
			<aside>
				<header>
					<canvas id="hublot" height="100" width="175" ></canvas>
					<div class="separateur" ></div>
					<p>Score : <span id="score" ></span></p>
					<p>Niveau : <span id="lvl" ></span></p>
					<div class="bande" ><span id="last_score" ></span></div>
					<div class="bande" ><span id="bande" ></span></div>
				</header>
				<footer>
					<!--<h1>Statistiques</h1>-->					
					<p>Tetriminos : <span id="pieces" ></span></p>
					<p>Lignes : <span id="lignes" ></span></p>
					<p>Temps : <span id="temps" ></span></p>
				</footer>
			</aside>
			<input id="start" type="button" value="Jouer !" />
			<p id="pause" >
				<br/>Pause <br/>
				- Controles <br/>
				- Regles simples <br/>
				- Regles detaillees <br/>
			</p>
			<p id="ended" >
				<br/>Game Over
			</p>
		</section>
		<p id="pseudoInTitle" class="best_score" title="Par <?php echo $best_score[1]; ?>">
			Best score ever : <span id="best_score" ><?php echo $best_score[0]; ?></span> 
			
		</p>
	
	<script src="tetris.js" ></script>
	</body>
</html>