/* DECLARATIONS VARIABLES */
	var allElements = { //Toutes les références vers les éléments du DOM
			button_top : document.getElementById ('button_top'),
			button_bottom : document.getElementById ('button_bottom'),
			temoignages_containerArray : document.getElementsByClassName ('temoignages_container')
		},
		midID = allElements.temoignages_containerArray.length-2;
	
/* DECLARATIONS FONCTIONS */
	function goUp () {
		if ( midID-1 !==0 ) {
			allElements.temoignages_containerArray[ midID+1 ].style.display = 'none';
			allElements.temoignages_containerArray[ midID-2 ].style.display = 'inline';
			midID = midID-1;
			allElements.button_bottom.style.display = 'inline';
		}
		if ( midID-1 ===0 ) {
			allElements.button_top.style.display = 'none';
		}
	}
	
	function goDown () {
		if ( midID+1 !==0 ) {
			allElements.temoignages_containerArray[ midID-1 ].style.display = 'none';
			allElements.temoignages_containerArray[ midID+2 ].style.display = 'inline';
			midID = midID+1;
			allElements.button_top.style.display = 'inline';
		}
		if ( midID+1 === allElements.temoignages_containerArray.length-1) {
			allElements.button_bottom.style.display = 'none';
		}
	}

/* ATTRIBUTIONS EVENTS */
	allElements.button_top.onclick = goUp;
	allElements.button_bottom.onclick = goDown;
	