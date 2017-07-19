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
include_once ('included/stats_head.php');

include_once ('included/stats/StatsBDD.class.php');
$statsBDD = new StatsBDD ( DbConnection::newDb() );

//Gestion du paramètre join
	if ( isset ($_GET['join']) && $_GET['join'] === 'y' ) {
		$GETjoin = true;
	} else {
		$GETjoin = false;
	}
	if ( isset ($_GET['more']) && $_GET['more'] === 'y' ) {
		$GETmore = true;
	} else {
		$GETmore = false;
	}
?>
<?php
	$ordreArray = array (
		'index.php',
		'infos.php',
		'resultats.php',
		'photos.php',
		'youtube.php',
		'temoignages.php',
		'contact.php',
		'partenaires.php',
		'stats.php',
		'404.php'
	);
	
	function trierPagesTable ( Array $pagesTable, Array $ordreArray ) {
		$finalTable = [];
		//On trie $pagesTable dans l'ordre de $ordreArray et transférons les entrées dans $finalTable
		foreach ( $ordreArray as $page ) {
			$interTable = [];
			foreach ( $pagesTable as $key => $entry ) {
				if ( strpos ( $entry['name'], $page ) ) {
					$interTable [] = $entry;
					unset ( $pagesTable[$key] );
				}
			}
			sort ($interTable);
			$finalTable = array_merge ( $finalTable, $interTable );
		}
		if ( $ordreArray ) {
			$reste = [];
			//On trie le reste par ordre alphabétique
			foreach ( $pagesTable as $entry ) {
				$reste [] = $entry['name'];
			}
			sort ($reste);
			foreach ( $reste as $name ) {
				$ikey = 0;
				foreach ( $pagesTable as $key => $entry ) {
					if ( $entry['name'] === $name ) {
						$ikey = $key;
					}
				}
				$finalTable [] = $pagesTable[$ikey];
			}
		}
		return $finalTable;
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=700" />
        <title>Championnats de France de Sabre Juniors 2014 à Chatou - Site officiel</title>
		<link rel="icon" href="images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="included/stats.css" />
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
			<h1>
				Statistiques de fréquentation
			</h1>
			
			<h2>
				<div>Compteurs</div>
				<div class="legend" >(En place depuis le 13 Avril 2014)</div>
			</h2>
			
			<table>
				<tr>
					<th>Nom</th>
					<th>Valeur</th>
					<th>Emplacement</th>
				</tr>
				<?php
				$compteurs = array (
					[ 'name' => 'Ensemble des vues', 'value' => file_get_contents('compteurs/vues_toutes_les_pages.txt'), 'loc' => '/compteurs/vues_toutes_les_pages.php'],
					[ 'name' => 'Vues de l\'index', 'value' => file_get_contents('compteurs/vues_index.txt'), 'loc' => '/compteurs/vues_index.php'],
					[ 'name' => 'Vues de l\'index par le qrcode', 'value' => file_get_contents('compteurs/vues_index_via_qrcode.txt'), 'loc' => '/compteurs/vues_index_via_qrcode.php'],
					[ 'name' => 'Vues des résultats', 'value' => file_get_contents('compteurs/vues_resultats.txt'), 'loc' => '/compteurs/vues_resultats.php']
				);
				foreach ( $compteurs as $tr ) {
					echo '
					<tr>
					';
					foreach ( $tr as $class => $td ) {
						echo '<td class="' . $class . '">' . $td . '</td>
						';
					}
					echo '
					</tr>
					';
				}
				?>
			</table>
			
			<h2>
				<div>Base de données</div>
				<div class="legend" >(En place depuis le 11 Mai 2014 à 17h26)</div>
			</h2>
			
			<table>
				<caption>Tables</caption>
				<tr>
					<th>Connection</th>
					<th>Nombre d'entrées</th>
					<th>Explications</th>
				</tr>
				<?php
				$nbEntriesArray = $statsBDD->getNbEntries ( array ('ip', 'idcookie', 'idsession') );
				$rename = array ( 'ip' => 'IP', 'idcookie' => 'Navigateurs (ID Cookie)', 'idsession' => 'Sessions' );
				$explications = array ( 
										'ip' => 'Nombre de visiteurs se connectant à partir d\'un routeur réseau différent (pour les machines sur réseau local, ce qui constitue la majorité des cas : par exemple votre chère box; pour les connections sans-fil comme 3G, ce sera en général l\'IP dynamique du relais.).', 
										'idcookie' => 'Nombre de visiteurs se connectant à partir d\'un navigateur différent (sur un ordinateur ou utilisateur différent; établi grâce à un cookie). <br/>Révélateur du nombre de personnes ayant visité le site au moins une fois.', 
										'idsession' => 'Nombre de visiteurs se connectant à partir d\'une session différente. Une session débute avec le lancement d\'un navigateur et se termine avec sa fermeture, ou une heure après avoir quitté le site. <br/>Révélateur du nombre de visites.' 
									);
				foreach ( $nbEntriesArray as $table => $nbEntries ) {
					echo '
					<tr>
						<td class="name">' . $rename [$table] . '</td>
						<td class="value">' . $nbEntries . '</td>
						<td class="explanation">' . $explications[ $table ] . '</td>
					</tr>
					';
				}
				$vuesSum = $statsBDD->getSum ( 'pages', 'vues' );
				echo '
				<tr>
					<td class="name">' . 'Vues' . '</td>
					<td class="value">' . $vuesSum . '</td>
					<td class="explanation">' . 'Nombre brut de l\'ensemble des vues sur le site.' . '</td>
				</tr>
				';
				?>
			</table>
			
			<table>
				<caption>Moyennes</caption>
				<tr>
					<th>Par</th>
					<th>De</th>
					<th>Valeurs</th>
				</tr>
				<?php
					$idCookieArrayTable = $statsBDD->getTable ( 'ip', array ( 'idCookieArray' ) );
					$occurencesIdCookie = 0;
					foreach ( $idCookieArrayTable as $entry ) {
						$occurencesIdCookie += count ( unserialize ( $entry['idCookieArray'] ) );
					}
					echo '
					<tr>
						<td class="name" rowspan="3" >' . 'IP'  . '</td>
						<td class="name" >' . 'Navigateurs'  . '</td>
						<td class="value">' . round ( $occurencesIdCookie / $nbEntriesArray['ip'], 2 ) . '</td>
					</tr>
					<tr>
						<td class="name" >' . 'Sessions'  . '</td>
						<td class="value">' . round ( $nbEntriesArray['idsession'] / $nbEntriesArray['ip'], 2 ) . '</td>
					</tr>
					<tr>
						<td class="name" >' . 'Vues'  . '</td>
						<td class="value">' . round ( $vuesSum / $nbEntriesArray['ip'], 2 ) . '</td>
					</tr>
					<tr>
						<td class="name" rowspan="2" >' . 'Navigateurs'  . '</td>
						<td class="name" >' . 'Sessions'  . '</td>
						<td class="value">' . round ( $nbEntriesArray['idsession'] / $nbEntriesArray['idcookie'], 2 ) . '</td>
					</tr>
					<tr>
						<td class="name" >' . 'Vues'  . '</td>
						<td class="value">' . round ( $vuesSum / $nbEntriesArray['idcookie'], 2 ) . '</td>
					</tr>
					<tr>
						<td class="name" rowspan="1" >' . 'Sessions'  . '</td>
						<td class="name" >' . 'Vues'  . '</td>
						<td class="value">' . round ( $vuesSum / $nbEntriesArray['idsession'], 2 ) . '</td>
					</tr>
					';
				?>
			</table>
			
			<table>
				<caption>Récapitulatif vues des pages</caption>
				<tr>
					<th>Page</th>
					<th>Vues</th>
				</tr>
				<?php
				$pagesTable = $statsBDD->getTable ( 'pages' );
				$pagesTable = trierPagesTable ( $pagesTable, $ordreArray );
				foreach ( $ordreArray as $name ) {
					$vues = 0;
					foreach ( $pagesTable as $entry ) {
						if ( strripos ( $entry['name'], $name ) !== false ) {
							$vues += $entry['vues'];
						}
					}
					echo '
					<tr>
						<td class="name" >' . $name . '</td>
						<td class="value">' . $vues . '</td>
					</tr>
					';
				}
				?>
			</table>
			
			<table>
				<caption>Table Vues par pages</caption>
				<tr>
					<th>Page</th>
					<th>Vues</th>
				</tr>
				<?php
				foreach ( $pagesTable as $entry ) {
					$nameString = preg_replace ( '#/(\w+\.php)#iU', '/<span class="name" >$1</span>', $entry['name'] );
					$nameString = preg_replace ( '#=(\w+)$#iU', '=<span class="name" >$1</span>', $nameString );
					$nameString = preg_replace ( '#=(\w+)&#iU', '=<span class="name" >$1</span>&', $nameString );
					echo '
					<tr>
						<td>' . $nameString . '</td>
						<td class="value">' . $entry['vues'] . '</td>
					</tr>
					';
				}
				?>
			</table>
			
			<?php if ( $GETmore ) { ?>
			<table>
				<caption>Table IP</caption>
				<tr>
					<th><a href="" id="cacheIP" onclick="getIP (); return false;" >IP</a></th>
					<th class="warning_container" >Localisation <span class="warning" title="Ce champs estime la géolocalisation par comparaison de plage IP. Les informations renvoyés seront donc erronées en cas d'IP dynamique variable (rare). De plus, les adresses IPv6 ne sont pas pris en charges." >/!\</span></th>
					<th><a href="" id="cache1" >Tableau de Navigateurs</a></th>
				</tr>
				<?php
				$ipTable = $statsBDD->getTable ( 'ip' );
				foreach ( $ipTable as $entry ) {
					$idCookieString = '';
					foreach ( unserialize ( $entry['idCookieArray'] ) as $idCookie ) {
						if ( !$GETjoin ) {
							$idCookieString .= '<a href="#ID_COOKIE_' . $idCookie . '" onclick="surlignerTr ( \'ID_COOKIE_' . $idCookie . '\' );" >' . $idCookie . '</a>';
						} else {
							$idCookieString .= '<a href="#ID_COOKIE_' . $idCookie . '" onclick="surlignerTrAll ( \'ID_COOKIE_' . $idCookie . '\' );" >' . $idCookie . '</a>';
						}
					}
					echo '
					<tr>
						<td class="cacheIP"></td>
						<td>' . $entry['geolocInfos'] . '</td>
						<td class="cache cache1" >' . $idCookieString . '</td>
					</tr>
					';
				}
				?>
			</table>
			
			<div id="table_container" >
			<?php if ( !$GETjoin ) { ?>
				<div id="joinDiv" >&darr; <a href="stats.php?more=y&join=y#TN" id="join" >Jointure</a> &darr;</div>
				<?php } ?>
				<table class="inlineblock" >
					<caption id="TN" >Table Navigateurs</caption>
					<tr>
						<th>ID</th>
						<th>Vues Cumulées</th>
						<?php if ( !$GETjoin ) { ?>
						<th><a href="" id="cache2" >Tableau de Sessions</a></th>
						<?php } else { ?>
						<th>ID de Session</th>
						<th>Vues</th>
						<?php } ?>
					</tr>
					<?php
					$idCookieTable = $statsBDD->getTable ( 'idcookie' );
					foreach ( $idCookieTable as $entry ) {
						$idSessionTable = $statsBDD->getTable ( 'idsession' );
						$idSessionTableArray = [];
						foreach ( $idSessionTable as $entry2 ) {
							$idSessionTableArray [$entry2['idSession']] = $entry2['vues'];
						}
							
						$idSessionArray = unserialize ( $entry['idSessionArray'] );
						$vuesCum = 0;
						foreach ( $idSessionArray as $idSession2 ) {
							$vuesCum += $idSessionTableArray[$idSession2];
						}
						
						if ( !$GETjoin ) {
							$idSessionString = '';
							foreach ( unserialize ( $entry['idSessionArray'] ) as $idSession ) {
								$idSessionString .= '<a id="LINK_ID_SESSION_' . $idSession . '" class="id_session_link" href="#ID_SESSION_' . $idSession . '" onclick="surlignerTr ( \'ID_SESSION_' . $idSession . '\' );" >' . $idSession . '</a>';
							}
							echo '
							<tr id="ID_COOKIE_' . $entry['idCookie'] . '" onclick="désurlignerTr ( \'ID_COOKIE_' . $entry['idCookie'] . '\' );" >
								<td class="id">' . $entry['idCookie'] . '</td>
								<td class="value">' . $vuesCum . '</td>
								<td class="cache cache2" >' . $idSessionString . '</td>
							</tr>
							';
						} else {
							foreach ( $idSessionArray as $key => $idSession ) {
								echo '
								<tr class="ID_COOKIE_' . $entry['idCookie'] . '" onclick="désurlignerTrAll ( \'ID_COOKIE_' . $entry['idCookie'] . '\' );" >
								';
								if ( $key === 0 ) {
									echo '
									<td class="id" rowspan="' . count ( $idSessionArray ) . '" >' . $entry['idCookie'] . '</td>
									<td class="value" rowspan="' . count ( $idSessionArray ) . '" >' . $vuesCum . '</td>
									';
								}
								echo '
									<td class="id">' . $idSession . '</td>
									<td class="value">' . $idSessionTableArray[$idSession] . '</td>
								</tr>
								';
							}
						}
					}
					?>
				</table>
				<?php if ( !$GETjoin ) { ?>
				<table class="inlineblock" >
					<caption>Table Sessions</caption>
					<tr>
						<th>ID</th>
						<th>Vues</th>
					</tr>
					<?php
					$idSessionTable = $statsBDD->getTable ( 'idsession' );
					foreach ( $idSessionTable as $entry ) {
						echo '
						<tr id="ID_SESSION_' . $entry['idSession'] . '" onclick="désurlignerTr ( \'ID_SESSION_' . $entry['idSession'] . '\' );" >
							<td class="id">' . $entry['idSession'] . '</td>
							<td class="value">' . $entry['vues'] . '</td>
						</tr>
						';
					}
					?>
				</table>
				<?php } ?>
			</div>
			<?php } else { /*ElseIf ( !$GETmore ) */ ?>
				<div id="joinDiv" >&darr; <a href="stats.php?more=y" id="more" >Plus d'informations : Afficher les tables IP, Navigateurs et Sessions</a> &darr;</div>
			<?php } ?>
		</div>
		
	</body>
	<script src="included/stats_dynamic.js.php"></script>
</html>