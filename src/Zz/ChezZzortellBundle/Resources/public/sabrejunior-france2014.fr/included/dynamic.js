window.onload = function()
{

/* DECLARATIONS VARIABLES */
	var allElements = { //Toutes les références vers les éléments du DOM
			header: document.getElementById('header'),
			nav_main: document.getElementById('nav_main')
		},
		statutHeader = 0;
	
/* DECLARATIONS FONCTIONS */
	function changeHeader () {
		if (statutHeader) {
			allElements.header.innerHTML = '\
			<h1>\
				<span id="first_part_title" >Championnats de France</span>\
				<img src="images/header_sabre_red.png" alt="" /> <br/>\
				<span id="second_part_title" >Sabre Juniors</span>\
			</h1>\
			<img id="swordsmen_white" src="images/header_swordsmen_white.png" alt="Sabreurs blancs" />\
			';
			
			statutHeader = 0;
		} else {
			allElements.header.innerHTML = '\
			<h1>\
				<span id="first_part_title_dynamic" >Chatou</span>\
				<img src="images/header_sabre_blue.png" alt="" /> <br/>\
				<span id="second_part_title_dynamic" >17 et 18 Mai 2014</span>\
			</h1>\
			<img id="swordsmen_white" src="images/header_swordsmen_white.png" alt="Sabreurs blancs" />\
			';
			
			statutHeader = 1;
		}
		setTimeout (changeHeader, 3000);
	}

/* ATTRIBUTIONS EVENTS */	
	setTimeout (changeHeader, 3000);
	
	

}