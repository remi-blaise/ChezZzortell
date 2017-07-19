<?php //COMPTEUR
$fichier = fopen ('compteurs/vues_toutes_les_pages.txt', 'r+');
$compteur = fgets ($fichier);
settype ($compteur, 'int');
$compteur++;
settype ($compteur, 'string');
fseek ($fichier, 0);
fwrite ($fichier, $compteur);
fclose ($fichier);

//STATS
// include_once ('included/stats_head.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=700" />
        <title>Championnats de France de Sabre Juniors 2014 à Chatou - Site officiel</title>
		<link rel="icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="style.php" />
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="included/inlineblock_ie.css" />
        <![endif]-->
    </head>
    <body>
		<a id="header_a_container" href="index.php" title="Retour à l'accueil" >
		<header id="header" >
			<h1>
				<span id="first_part_title" >Championnats de France</span>
				<img src="images/header_sabre_red.png" alt="" /> <br/>
				<span id="second_part_title" >Sabre Juniors</span>
			</h1><br />
			<img id="swordsmen_white" src="images/header_swordsmen_white.png" alt="Sabreurs blancs" />
		</header>
		</a>
