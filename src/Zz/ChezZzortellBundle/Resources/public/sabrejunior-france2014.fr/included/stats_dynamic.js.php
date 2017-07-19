<?php
   header('content-type: text/javascript');
?>
<?php

for ( $i = 1, $c = 2; $i <= $c; $i++ ) {
?>
/* DECLARATION DES VARIABLES */
	cache<?php echo $i; ?> = document.getElementById ( 'cache<?php echo $i; ?>' );

/*	FONCTIONS */
	function afficherCache<?php echo $i; ?> () {
		allCaches = document.getElementsByClassName ( 'cache<?php echo $i; ?>' );
		for ( var i = 0, c = allCaches.length; i<c; i++ ) {
			allCaches[i].style.display = 'table-cell';
		}
		cache<?php echo $i; ?>.onclick = function () {
			desafficherCache<?php echo $i; ?> ();
			return false;
		}
	}
	
	function desafficherCache<?php echo $i; ?> () {
		allCaches = document.getElementsByClassName ( 'cache<?php echo $i; ?>' );
		for ( var i = 0, c = allCaches.length; i<c; i++ ) {
			allCaches[i].style.display = 'none';
		}
		cache<?php echo $i; ?>.onclick = function () {
			afficherCache<?php echo $i; ?> ();
			return false;
		}
	}
	
/* ATTRIBUTION EVENTS */
	cache<?php echo $i; ?>.onclick = function () {
			afficherCache<?php echo $i; ?>();
			return false;
		};
		
/***********************************************************************************/		
		
<?php
}
?>

/*	FONCTIONS */
	function surlignerTr ( $id ) {
		document.getElementById ( $id ).style.backgroundColor = "gold";
	}
	
	function désurlignerTr ( $id ) {
		document.getElementById ( $id ).style.backgroundColor = "white";
	}
	
	function surlignerTrAll ( $class ) {
		all = document.getElementsByClassName ( $class );
		for ( var i = 0, c = all.length; i<c; i++ ) {
			all[i].style.backgroundColor = "gold";
		}
	}
	
	function désurlignerTrAll ( $class ) {
		all = document.getElementsByClassName ( $class );
		for ( var i = 0, c = all.length; i<c; i++ ) {
			all[i].style.backgroundColor = "white";
		}
	}
	
	function getIP ( mdp ) {
		if ( typeof mdp === 'string' ) {
			var xhr = new XMLHttpRequest ();
			xhr.open ( null, 'included/stats/admin/getip.php', true, 'ajax', mdp );
			xhr.send ();
			xhr.onreadystatechange = function () {
				if ( xhr.readyState == 4 && xhr.status == 200 ) {
					putIP ( JSON.parse ( xhr.responseText ) );
				} else if ( xhr.readyState == 4 && xhr.status == 401 ) {
					getIP ( prompt ( 'L\'authentification a échouée. Réessayez le mot de passe :' ) );
				}
			}
		} else if ( typeof mdp === 'undefined' ) {
			getIP ( prompt ( 'Les IP des visiteurs ne sont visibles que par les personnes autorisées.\nUn mot de passe est requis :' ) );
		}
	}
	
	function putIP ( allIP ) {
		allCacheIP = document.getElementsByClassName ( 'cacheIP' );
		for ( var i = 0, c = allCacheIP.length; i < c; i++ ) {
			allCacheIP[i].innerHTML = allIP[i];
			allCacheIP[i].style.border = "solid 1px black";
			allCacheIP[i].style.color = "green";
		}
	}