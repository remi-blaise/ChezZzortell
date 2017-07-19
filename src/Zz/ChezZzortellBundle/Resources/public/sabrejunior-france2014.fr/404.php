<?php //COMPTEUR
$fichier = fopen ('compteurs/vues_toutes_les_pages.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0);
fwrite ($fichier, $compteur);
fclose ($fichier);

//COMPTEUR
$fichier = fopen ('compteurs/vues_404.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0);
fwrite ($fichier, $compteur);
fclose ($fichier);

//STATS
//include_once ('included/stats_head.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=700" />
        <title>Championnats de France de Sabre Juniors 2014 à Chatou - Site officiel</title>
		<link rel="icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="included/404/404.css" />
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if lte IE 7]>
        <link rel="stylesheet" href="inlineblock_ie.css" />
        <![endif]-->
    </head>
    <body>
		<a id="header_a_container" href="index.php" title="Retour à l'accueil" >
			<header id="header" >
				<img id="bandeau" src="included/404/bandeau.png" alt="Retour au site" />
			</header>
		</a>
		<div id="bodier" class="inlineblock" >
			<br/>
			<h1>
				<div>Erreur</div>
				<img id="404" src="included/404/404.png" alt="404" />
			</h1>
			<h2>
				Ressource non trouvée
			</h2>
			<p>
				Désolé, la page (ou ressource) que vous cherchez est introuvable.
				<br/>
				<br/>En voici les causes probables :
				<br/>La ressource a été effacée ou renommée.
				<br/>La ressource est temporairement indisponible.
				<br/>Vous avez involontairement ou non modifié son URI.
				<br/>Vous n'avez pas les droits d'accès à la ressource.
			</p>
			<p>
				Vous pouvez reporter un bug en écrivant à : <a href="mailto:remi.blaise@gmx.fr">remi.blaise@gmx.fr</a>.
			</p>
			<?php
			if (!empty($_SERVER['HTTP_REFERER'])) {
				echo '<h2>';
				echo '<a href="' . $_SERVER['HTTP_REFERER'] . '">Retour à la page précédente</a>';
				echo '</h2>';
			}
			?>
			<h2>
				<a href="index.php">Retour à la page d'accueil</a>
			</h2>
		</div>
	</body>
</html>
