<?php //EN-TÊTE
header("Content-type: text/plain");

// ATTENTION : Ne pas insérer d'espace blanc.
?>
<?php //BEST_SCORE
if ( $_GET['score'] && $_GET['pseudo'] //Si les deux paramètres existent ...
	&& preg_match('#^[0-9]{1,}$#', $_GET['score']) && !preg_match('#//#', $_GET['pseudo']) //... et sont valides ...
	&& strlen($_GET['score'])< 8 && strlen($_GET['pseudo'])< 16	) { //... et pas trop longs
	$_GET['score'] = htmlspecialchars( $_GET['score'], ENT_QUOTES); //Sécurise le score
	$_GET['pseudo'] = htmlspecialchars( $_GET['pseudo'], ENT_QUOTES); //Sécurise le pseudo
	$fichier = fopen ('best_score/best_score.txt', 'r+'); //Ouvrir le fichier best_score.txt
	$line = fgets ($fichier); //Lire la première ligne
	fclose ($fichier); //Fermer le fichier
	$best_score = preg_split ('#//#', $line); //Décomposer la ligne en array : score -> [0] et pseudo -> [1]
	if ( $_GET['score'] > $best_score[0] ) { //Si le score envoyé est effectivement supérieur au score actuel
		if ( 
			file_put_contents ('best_score/best_score.txt', //On replace le fichier par lui-même avec la ligne remplacée dedans
				str_replace( $line, $_GET['score'] . '//' . $_GET['pseudo'] . PHP_EOL, file_get_contents('best_score/best_score.txt') ) 
			)
			/*fputs ($fichier, $_GET['score'] . '//' . $_GET['pseudo'])*/ 
		) { //Ecrire le nouveau score
			echo 'true'; //Envoyer 'true'
		} else {
			echo 'error'; //Envoyer 'error' si erreur
		}
	} else {
		echo 'false'; //Sinon envoyer 'false'
	}	
} else {
	echo 'invalid parameters'; //Sinon envoyer 'invalid parameters'
}

//str_replace("Ma ligne\n", "", file_get_contents("chemin/vers/mon/fichier.ext"))
?>