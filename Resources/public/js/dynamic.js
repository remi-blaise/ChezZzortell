/* DECLARATIONS VARIABLES */
	//Section Author
	author_buttons = document.getElementsByClassName ( 'author_button' );
	divs = document.getElementsByClassName ( 'author_p_container' );
	
	//Section Author Partie Compétences
	nextButton = document.getElementById ( 'next' );
	previousButton = document.getElementById ( 'previous' );
	allP = [
		document.getElementsByClassName ( 'position1' ),
		document.getElementsByClassName ( 'position2' ),
		document.getElementsByClassName ( 'position3' )
	];
	position = 0;
	
	//Section Author Partie Capacités
	nextButton2 = document.getElementById ( 'next2' );
	previousButton2 = document.getElementById ( 'previous2' );
	allP2 = [
		document.getElementsByClassName ( 'pos1' ),
		document.getElementsByClassName ( 'pos2' ),
		document.getElementsByClassName ( 'pos3' )
	];
	pos = 0;
	
	//Nav
	buttons = document.getElementsByClassName ( 'more' );
	sections = document.getElementsByClassName ( 'section_more' );
	
	//Sections More
	close_buttons = document.getElementsByClassName ( 'close' );
	more_buttons = document.getElementsByClassName ( 'more_button' );
	more_divs = document.getElementsByClassName ( 'more_p_container' );
	
	//Sections More Tous les autres buttons notés 3
	nextButton3 = document.getElementById ( 'next3' );
	previousButton3 = document.getElementById ( 'previous3' );
	allP3 = [
		document.getElementsByClassName ( 'posi1' ),
		document.getElementsByClassName ( 'posi2' )
	];
	posi = 0;
	
	
/* DECLARATIONS FONCTIONS */
	// Utilitaires
	function indexOf ( array, value ) {
		for ( i = 0, c = array.length; i < c; i++ ) {
			if ( array[i] === value ) {
				return i;
			}
		}
		return false;
	}
	
	//Section Author
	function display_div_author ( target ) {
		for ( i = 0, c = divs.length; i < c; i++ ) {
			divs[i].style.display = 'none';
		}
		divs[ indexOf ( author_buttons, target ) ].style.display = 'block';
		if ( target.id === 'compet_button' ) {
			if ( position !== 2 ) {
				nextButton.style.visibility = 'visible';
			}
			if ( position !== 0 ) {
				previousButton.style.visibility = 'visible';
			} 
		} else {
			nextButton.style.visibility = 'hidden';
			previousButton.style.visibility = 'hidden';
		}
		if ( target.id === 'capacites_button' ) {
			if ( pos !== 2 ) {
				nextButton2.style.visibility = 'visible';
			}
			if ( pos !== 0 ) {
				previousButton2.style.visibility = 'visible';
			} 
		} else {
			nextButton2.style.visibility = 'hidden';
			previousButton2.style.visibility = 'hidden';
		}
	}
	
	//Section Author Partie Compétences
	function next () {
		for ( i = 0, c = allP[position].length; i < c; i++ ) {
			allP[position][i].style.display = 'none';
		}
		position++;
		for ( i = 0, c = allP[position].length; i < c; i++ ) {
			allP[position][i].style.display = 'block';
		}
		if ( position === 2 ) {
			nextButton.style.visibility = 'hidden';
		}
		previousButton.style.visibility = 'visible';
	}
	
	function previous () {
		for ( i = 0, c = allP[position].length; i < c; i++ ) {
			allP[position][i].style.display = 'none';
		}
		position--;
		for ( i = 0, c = allP[position].length; i < c; i++ ) {
			allP[position][i].style.display = 'block';
		}
		if ( position === 0 ) {
			previousButton.style.visibility = 'hidden';
		}
		nextButton.style.visibility = 'visible';
	}
	
	//Section Author Partie Capacités
	function next2 () {
		for ( i = 0, c = allP2[pos].length; i < c; i++ ) {
			allP2[pos][i].style.display = 'none';
		}
		pos++;
		for ( i = 0, c = allP2[pos].length; i < c; i++ ) {
			allP2[pos][i].style.display = 'block';
		}
		if ( pos === 2 ) {
			nextButton2.style.visibility = 'hidden';
		}
		previousButton2.style.visibility = 'visible';
	}
	
	function previous2 () {
		for ( i = 0, c = allP2[pos].length; i < c; i++ ) {
			allP2[pos][i].style.display = 'none';
		}
		pos--;
		for ( i = 0, c = allP2[pos].length; i < c; i++ ) {
			allP2[pos][i].style.display = 'block';
		}
		if ( pos === 0 ) {
			previousButton2.style.visibility = 'hidden';
		}
		nextButton2.style.visibility = 'visible';
	}
	
	//Nav
	function display_section_more ( target ) {
		for ( i = 0, c = sections.length; i < c; i++ ) {
			sections[i].style.display = 'none';
		}
		section = sections[ indexOf ( buttons, target ) ];
		section.style.display = 'block';
		childs = section.childNodes;
		for ( i = 0, c = childs.length; i < c; i++ ) {
			if ( childs[i].className === "more_p_container" ) {
				display_div_more ( childs[i], 'isDiv' );
				break;
			}
		}
		
	}
	
	//Sections More
	function close_sections_more () {
		for ( i = 0, c = sections.length; i < c; i++ ) {
			sections[i].style.display = 'none';
		}
	}
	
	function display_div_more ( target, ifDiv ) {
		div = ifDiv ? target : more_divs[ indexOf ( more_buttons, target ) ];
		for ( i = 0, c = more_divs.length; i < c; i++ ) {
			more_divs[i].style.display = 'none';
		}
		div.style.display = 'block';
	}
	
	//Sections More Tous les autres buttons notés 3
	function next3 () {
		for ( i = 0, c = allP3[posi].length; i < c; i++ ) {
			allP3[posi][i].style.display = 'none';
		}
		posi++;
		for ( i = 0, c = allP3[posi].length; i < c; i++ ) {
			allP3[posi][i].style.display = 'block';
		}
		if ( posi === 1 ) {
			nextButton3.style.display = 'none';
		}
		previousButton3.style.display = 'inline';
	}
	
	function previous3 () {
		for ( i = 0, c = allP3[posi].length; i < c; i++ ) {
			allP3[posi][i].style.display = 'none';
		}
		posi--;
		for ( i = 0, c = allP3[posi].length; i < c; i++ ) {
			allP3[posi][i].style.display = 'block';
		}
		if ( posi === 0 ) {
			previousButton3.style.display = 'none';
		}
		nextButton3.style.display = 'inline';
	}
	
	
/* DECLARATIONS EVENTS */
	//Section Author
	for ( i = 0, c = author_buttons.length; i < c; i++ ) {
		author_buttons[i].onclick = function ( e ) {
			e = e || window.event;
			display_div_author ( e.currentTarget );
		}
	}
	
	//Section Author Partie Compétences
	nextButton.onclick = next;
	previousButton.onclick = previous;
	
	//Section Author Partie Capacités
	nextButton2.onclick = next2;
	previousButton2.onclick = previous2;
	
	//Nav
	for ( i = 0, c = buttons.length; i < c; i++ ) {
		buttons[i].onclick = function ( e ) {
			e = e || window.event;
			display_section_more ( e.currentTarget );
		}
	}
	
	//Sections More
	for ( i = 0, c = close_buttons.length; i < c; i++ ) {
		close_buttons[i].onclick = close_sections_more;
	}
	for ( i = 0, c = more_buttons.length; i < c; i++ ) {
		more_buttons[i].onclick = function ( e ) {
			e = e || window.event;
			display_div_more ( e.currentTarget );
		}
	}
	
	//Sections More Tous les autres buttons notés 3
	nextButton3.onclick = next3;
	previousButton3.onclick = previous3;
	
	