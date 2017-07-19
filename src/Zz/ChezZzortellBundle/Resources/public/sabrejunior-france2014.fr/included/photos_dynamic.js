/* FONCTIONS UTILITAIRES */
function arrondir ($nombre, $mode, $decimale) {
	if (typeof $nombre === 'number') {
		if (!$decimale) {
			$decimale = 0;
			arrondi = Math.round($nombre);
		} else {
			arrondi = Math.round(number * Math.pow(10, $decimale)) / Math.pow(10, $decimale);
		}
		
		if ($mode === 'inf' || $mode === 'defaut') {
			if (arrondi > $nombre) {
				return arrondi - Math.pow(10, $decimale);
			}
		}
		if ($mode === 'sup' || $mode === 'exces') {
			if (arrondi < $nombre) {
				return arrondi + Math.pow(10, $decimale);
			}
		}
		return arrondi;
	}
}

/* DECLARATIONS VARIABLES */
	var allElements = { //Toutes les références vers les éléments du DOM
			button_top : document.getElementById ('button_top'),
			button_bottom : document.getElementById ('button_bottom'),
			button_max_top : document.getElementById ('button_max_top'),
			button_max_bottom : document.getElementById ('button_max_bottom'),
			photos_containerArray : document.getElementsByClassName ('photo_container')
		},
		firstID = 0;
		leftColumnLength = arrondir ( allElements.photos_containerArray.length/2, 'exces' );
	
/* DECLARATIONS FONCTIONS */
	function goUp () {
		allElements.photos_containerArray[ firstID-1 ].style.display = 'block';
		allElements.photos_containerArray[ firstID+leftColumnLength-1 ].style.display = 'block';
		allElements.photos_containerArray[ firstID+2 ].style.display = 'none';
		if ( allElements.photos_containerArray[ firstID+leftColumnLength+2 ] ) {
			allElements.photos_containerArray[ firstID+leftColumnLength+2 ].style.display = 'none';
		}
		firstID = firstID-1;
		allElements.button_bottom.style.display = 'inline';
		allElements.button_max_bottom.style.display = 'inline';
		if ( firstID === 0 ) {
			allElements.button_top.style.display = 'none';
			allElements.button_max_top.style.display = 'none';
			return false;
		}
		return true;
	}
	
	function goDown () {
		allElements.photos_containerArray[ firstID ].style.display = 'none';
		allElements.photos_containerArray[ firstID+leftColumnLength ].style.display = 'none';
		allElements.photos_containerArray[ firstID+3 ].style.display = 'block';
		if ( allElements.photos_containerArray[ firstID+leftColumnLength+3 ] ) {
			allElements.photos_containerArray[ firstID+leftColumnLength+3 ].style.display = 'block';
		}
		firstID = firstID+1;
		allElements.button_top.style.display = 'inline';
		allElements.button_max_top.style.display = 'inline';
		if ( firstID+3 === leftColumnLength ) {
			allElements.button_bottom.style.display = 'none';
			allElements.button_max_bottom.style.display = 'none';
			return false;
		}
		return true;
	}

/* ATTRIBUTIONS EVENTS */
	allElements.button_top.onclick = goUp;
	allElements.button_bottom.onclick = goDown;
	
	allElements.button_max_top.onclick = function () {
		while ( goUp () ) {}
		allElements.button_max_top.style.display = 'none';
		allElements.button_max_bottom.style.display = 'inline';
	}
	allElements.button_max_bottom.onclick = function () {
		while ( goDown () ) {}
		allElements.button_max_bottom.style.display = 'none';
		allElements.button_max_top.style.display = 'inline';
	}
	
	
	
	
	
	