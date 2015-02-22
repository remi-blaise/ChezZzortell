/* DECLARATIONS FONCTIONS UTILITAIRES */

function rand (min, max, integer) {		
	if (!integer) {
		return Math.random() * (max - min) + min;
	} else {
		return Math.floor(Math.random() * (max - min + 1) + min);
	}
}

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

function lisibilite_nombre(nbr)
{
	var nombre = ''+nbr;
	var retour = '';
	var count=0;
	for(var i=nombre.length-1 ; i>=0 ; i--)
	{
		if(count!=0 && count % 3 == 0)
			retour = nombre[i]+' '+retour ;
		else
			retour = nombre[i]+retour ;
		count++;
	}
	return retour;
}

window.onload = function()
{
/* DECLARATIONS DES CLASSES */

	function Block ($x, $y, $color) {
		this.x = $x;
		this.y = $y;
		this.color = $color;
		
		this.moveBottom = function ($test, $justMove) {		
			if (!$justMove) {
				if (this.x === null) {
					return null;
				}
				if (this.y === 22) {
					return false;
				}
				for (var i = 0, c = blocks.length; i<c; i++) {
					if ( (blocks[i].x === this.x) && (blocks[i].y === this.y+1) ) {
						return false;
					}
				}
			}			
			if (!$test) {
				this.y += 1;
			}			
			return true;
		}
		
		this.moveLeft = function ($test, $justMove) {		
			if (!$justMove) {
				if (this.x === 1) {
					return false;
				}
				for (var i = 0, c = blocks.length; i<c; i++) {
					if ( (blocks[i].x === this.x-1) && (blocks[i].y === this.y) ) {
						return false;
					}
				}
			}			
			if (!$test) {
				this.x -= 1;
			}			
			return true;
		}
		
		this.moveRight = function ($test, $justMove) {		
			if (!$justMove) {
				if (this.x === 10) {
					return false;
				}
				for (var i = 0, c = blocks.length; i<c; i++) {
					if ( (blocks[i].x === this.x+1) && (blocks[i].y === this.y) ) {
						return false;
					}
				}
			}			
			if (!$test) {
				this.x += 1;
			}			
			return true;
		}
		
		this.rotate = function ($idBlock, $idPos, $test) {
			if (!$idBlock) {
				return true;
			}
			var falseBlock = {	x: currentPiece[0].x + modelePiece[currentPiece['type']][$idPos][$idBlock -1].x, 
								y: currentPiece[0].y + modelePiece[currentPiece['type']][$idPos][$idBlock -1].y
							};
			if ($test) {
				if (falseBlock.x === 0 || falseBlock.x === 11 || falseBlock.y === 23) {
					return false;
				}
				for (var i = 0, c = blocks.length; i<c; i++) {
					if ( (blocks[i].x === falseBlock.x) && (blocks[i].y === falseBlock.y) ) {
						return false;
					}
				}
			}
			if (!$test) {
				this.x = falseBlock.x;
				this.y = falseBlock.y;
				
			}			
			return true;			
		}
	}

/* DECLARATIONS DES VARIABLES */
	
	//Couleurs du dégradé dans le temps de la bande
	//var colorsBande = ['#ff0000', '#dd0000', '#bb0000', '#990000', '#770000', '#550000', '#330000', '#000000']; //Rouge
	var colorsBande = ['#ffd700', '#ddba00', '#bf9e00', '#9e8400', '#7f6b00', '#5e4f00', '#3f3500', '#000000']; //Gold
	
	
	//Pièce en cours : 4 blocks + type + idPos
	var currentPiece = [ // currentPiece[idBlock].x .y  // currentPiece['type']
		new Block (null, null, null), //Bloc de référence
		new Block (null, null, null), //Autres blocks
		new Block (null, null, null),
		new Block (null, null, null)
	];
	currentPiece['type'] = null;
	currentPiece['idPos'] = null;
	
	var blocks = [], //Tous les blocks statiques placés dans la matrice
		//Tous les modèles : coordonnées des 3 blocks (autres que le bloc de référence, par rapport à celui-ci) des 4 positions des 7 types de pièce
		modelePiece = { // modelePiece [typeOfPiece] [idPos] [idBlock] .x .y
			O: [
				[ new Block (-1, 0), new Block (-1, 1), new Block (0, 1) ],
				[ new Block (-1, 0), new Block (-1, 1), new Block (0, 1) ],
				[ new Block (-1, 0), new Block (-1, 1), new Block (0, 1) ],
				[ new Block (-1, 0), new Block (-1, 1), new Block (0, 1) ]				
			],
			I: [
				[ new Block (-2, 0), new Block (-1, 0), new Block (1, 0) ],
				[ new Block (0, 1), new Block (0, -1), new Block (0, -2) ],
				[ new Block (-2, 0), new Block (-1, 0), new Block (1, 0) ],
				[ new Block (0, 1), new Block (0, -1), new Block (0, -2) ]
			],
			S: [
				[ new Block (-1, 1), new Block (0, 1), new Block (1, 0) ],
				[ new Block (0, -1), new Block (1, 0), new Block (1, 1) ],
				[ new Block (-1, 1), new Block (0, 1), new Block (1, 0) ],
				[ new Block (0, -1), new Block (1, 0), new Block (1, 1) ]
			],
			Z: [
				[ new Block (-1, 0), new Block (0, 1), new Block (1, 1) ],
				[ new Block (0, 1), new Block (1, 0), new Block (1, -1) ],
				[ new Block (-1, 0), new Block (0, 1), new Block (1, 1) ],
				[ new Block (0, 1), new Block (1, 0), new Block (1, -1) ]
			],
			L: [
				[ new Block (-1, 0), new Block (-1, 1), new Block (1, 0) ],
				[ new Block (0, -1), new Block (0, 1), new Block (1, 1) ],
				[ new Block (-1, 0), new Block (1, 0), new Block (1, -1) ],
				[ new Block (-1, -1), new Block (0, -1), new Block (0, 1) ]
			],
			J: [
				[ new Block (-1, 0), new Block (1, 0), new Block (1, 1) ],
				[ new Block (0, -1), new Block (0, 1), new Block (1, -1) ],
				[ new Block (-1, -1), new Block (-1, 0), new Block (1, 0) ],
				[ new Block (-1, 1), new Block (0, 1), new Block (0, -1) ]
			],
			T: [
				[ new Block (-1, 0), new Block (0, 1), new Block (1, 0) ],
				[ new Block (0, -1), new Block (0, 1), new Block (1, 0) ],
				[ new Block (-1, 0), new Block (0, -1), new Block (1, 0) ],
				[ new Block (-1, 0), new Block (0, -1), new Block (0, 1) ]
			]
		},
		
		gameStatus = 'waiting', //Statut du jeu : 'waiting' 'playing' 'pause' 'ended'
		gameInfos = { //Infos du jeu
			score: 0,
			decomposedScore: { //gameInfos.decomposedScore : basic, drop, simple, doubleAndTriple, tetris
								basic: 0,
								drop: 0,
								simple: 0,
								doubleAndTriple: 0,
								tetris: 0,
								btb: 0,
								tSpin: 0
							 },
			lvl: 0,
			lastScore: 0,
			pieces: 0,
			lines: 0,
			temps: 0
		},
		allElements = { //Toutes les références vers les éléments du DOM
			body: document.getElementById('body'),
			matrice: document.getElementById('matrice'),
			hublot: document.getElementById('hublot'),
			
			pause: document.getElementById('pause'),
			ended: document.getElementById('ended'),
			
			start: document.getElementById('start'),
			
			score: document.getElementById('score'),
			lvl: document.getElementById('lvl'),
			last_score: document.getElementById('last_score'),
			bande: document.getElementById('bande'),
			pieces: document.getElementById('pieces'),
			lignes: document.getElementById('lignes'),
			temps: document.getElementById('temps'),
			best_score: document.getElementById('best_score'),
			pseudoInTitle: document.getElementById('pseudoInTitle'),
			infos_tests: document.getElementById('infos_tests')
		},
		contextMatrice = allElements.matrice.getContext('2d'), //Contexte de la matrice
		contextHublot = allElements.hublot.getContext('2d'), //Contexte du hublot
		bestScore = parseInt (allElements.best_score.innerHTML.replace(' ','')), //Best score donné par php
		startTime = null, //Destiné à contenir le timestamp initial de la partie
		currentPauseTime = null, //Destiné à contenir le timestamp de la mise en pause actuelle
		currentStartTime = null, //Destiné à contenir le timestamp du commencement du Timeout actuel
		currentScore = { //Les éléments du score en cours pour le calcul du score
			lines: null, 
			tSpin: null,
			combo: null,
			comboReset: null,
			btb: null, 
			softDrop: null, 
			hardDrop: null
		},
		siblingPieceType = null, //Pièce suivante (pour affichage dans le hublot)
		
		numberOfCurrentTimeout = null, //Nombre de fonction goTimeout en cours (système de blocage)
		currentChangePiece = null, //Fonction changePiece en cours (système de blocage)
		currentMsg, waitingMsg, //Liste d'attente fonction displayBande (système de blocage temporaire)
		numberOfCurrentLastScore; //Nombre de fonction displayLastScore en cours (système de blocage)
		
		//Met des espaces dans le best_score
		if (typeof bestScore === 'number') {
			allElements.best_score.innerHTML = lisibilite_nombre(bestScore);
		}
		
/* DECLARATIONS FONCTIONS */
	function start() {
		
		//Réinitialisation du canvas.
		contextMatrice.clearRect(0, 0, allElements.matrice.width, allElements.matrice.height);
		
		//Réinitialisation de currentPiece
		for (var i = 0; i<4; i++) {
			currentPiece[i] = new Block (null, null, null);
		}
		//Réinitialisation de blocks, gameStatus, gameInfos, currentScore, siblingPieceType
		blocks = []; 
		gameStatus = 'playing';
		gameInfos = { 
			score: 0,
			decomposedScore: { //gameInfos.decomposedScore : basic, drop, simple, doubleAndTriple, tetris, btb, tSpin
								basic: 0,
								drop: 0,
								simple: 0,
								doubleAndTriple: 0,
								tetris: 0,
								btb: 0,
								tSpin: 0
							 },
			lastScore: 0,
			lvl: 1,
			pieces: 0,
			lines: 0,
			temps: '...'
		};
		currentScore = {
			lines: 0, 
			tSpin: 0,
			combo: 0,
			comboReset: false,
			btb: 0, 
			softDrop: 0, 
			hardDrop: 0
		}
		siblingPieceType = null;
		
		//Réinitialisation des systèmes de blocage
		numberOfCurrentTimeout = 1;
		currentChangePiece = false;
		currentMsg = false;
		waitingMsg =[];
		numberOfCurrentLastScore = 0;
		
		//Réinitialisation des éléments pause et ended
		allElements.pause.style.display = "none";
		allElements.ended.style.display = "none";
		//Réinitialisation du bouton start
		allElements.start.value = "Finir le jeu";
		allElements.start.onclick = stop;
		
		//Initialisation du startTime
		startTime = new Date ().getTime ();
		
		//Apparition de la première pièce
		newPiece ();
		
		//Actualisation de la matrice
		displayMatrice();
		
		//Focus du body (qui reçoit les entrées clavier)
		allElements.body.focus();
		
		//Lancement du premier Timeout
		currentTimeout = window.setTimeout(goTimeout, calculateTimeout());
		
		//Affichage de la bande start
		displayBande ('start');
	}
	
	function modifierContextMatrice ($contour, $interieur, $taille) {
		if ($contour) {
			contextMatrice.strokeStyle = $contour;
		} else {
			contextMatrice.strokeStyle = 'black';
		}
		
		if ($contour) {
			contextMatrice.fillStyle = $interieur;
		} else {
			contextMatrice.fillStyle = 'rgba(0,0,0,0)';
		}
		
		if ($taille) {
			contextMatrice.lineWidth = $taille;
		} else {
			contextMatrice.lineWidth = 5;
		}
	}
	
	function modifierContextHublot ($contour, $interieur, $taille) {
		if ($contour) {
			contextHublot.strokeStyle = $contour;
		} else {
			contextHublot.strokeStyle = 'black';
		}
		
		if ($contour) {
			contextHublot.fillStyle = $interieur;
		} else {
			contextHublot.fillStyle = 'rgba(0,0,0,0)';
		}
		
		if ($taille) {
			contextHublot.lineWidth = $taille;
		} else {
			contextHublot.lineWidth = 5;
		}
	}

	//Traitements à faire à chaque fin de Timeout
	function goTimeout ($reste) {
		//Décomptage du Timeout
		numberOfCurrentTimeout -= 1;
		
		//Si il n'y pas plus de Timeout
		if (gameStatus === 'playing' && numberOfCurrentTimeout === 0) {
			//Comptage du Timeout
			numberOfCurrentTimeout += 1;
			
			//Si pas de paramètre $reste spécifié
			if (!$reste) {
				//Lancement du Timeout
				currentTimeout = window.setTimeout(goTimeout, calculateTimeout());
				var test = [];				for (var j = 0; j<4; j++) {
					test[j] = currentPiece[j].moveBottom(test, 0);
				}
				if (test[0] && test[1] && test[2] && test[3]) {
					for (var i = 0; i<4; i++) {
						currentPiece[i].moveBottom(0, 'justMove');
					}
				} else {
					changePiece ();
				}
				displayMatrice();
				displayInfos ();
			} else {
				currentTimeout = window.setTimeout(goTimeout, $reste);
			}
			currentStartDate = new Date ();
			currentStartTime = currentStartDate.getTime ();			
		}
	}
	
	function newPiece () {
		function aleatTypeOfPiece () {
			switch (rand(0,6, 1)) {
				case 0: return 'O';
				case 1: return 'I';
				case 2: return 'S';
				case 3: return 'Z';
				case 4: return 'L';
				case 5: return 'J';
				case 6: return 'T';			
			}
		}
		function typeToColor ($type) {
			switch ($type) {
				case 'O': return 'blue';	//blue		//#ff0000 (rouge)
				case 'I': return 'red'; 	//red		//#ff6600 (orange foncé)
				case 'S': return '#00bf00';	//green		//#00ff00 (vert flash)
				case 'Z': return 'hotpink';	//pink		//#66ccff (bleu clair)
				case 'L': return 'darkviolet';	//orange	//#0000ff (bleu foncé)
				case 'J': return '#40e0ef';	//violet	//#cc00ff (violet)
				case 'T': return 'gold';	//#1e90ff	//#ffff00 (jaune)
			}
		}
		if (!siblingPieceType) {
			siblingPieceType = aleatTypeOfPiece ();
		}
		currentPiece['idPos'] = 0;
		currentPiece[0].x = 6;
		currentPiece[0].y = 0;
		currentPiece['type'] = siblingPieceType;
		colorType = typeToColor (currentPiece['type']);
		for (var i = 0; i<4; i++) {
			currentPiece[i].color = colorType;
		}
		
		for (var i = 0; i<3; i++) {
			currentPiece[i+1].x = currentPiece[0].x + modelePiece[currentPiece['type']][0][i].x;
			currentPiece[i+1].y = currentPiece[0].y	+ modelePiece[currentPiece['type']][0][i].y;
		}
		
		var test = [];		for (var j = 0; j<4; j++) {
			test[j] = currentPiece[j].moveBottom(test, 0);
		}
		if (test[0] && test[1] && test[2] && test[3]) {
			for (var i = 0; i<4; i++) {
				currentPiece[i].moveBottom(0, 'justMove');
			}
		} else {
			stop ();
		}
		displayMatrice();
		
		siblingPieceType = aleatTypeOfPiece ();
		siblingPiece = [ new Block (4, 2, typeToColor (siblingPieceType))]
		for (var i = 1; i<4; i++) {
			siblingPiece[i] = new Block ( 
				siblingPiece[0].x + modelePiece[siblingPieceType][0][i-1].x, 
				siblingPiece[0].y + modelePiece[siblingPieceType][0][i-1].y,
				siblingPiece[0].color
			)
		}
		contextHublot.clearRect(0, 0, allElements.matrice.width, allElements.matrice.height);
		for (var i = 0; i<4; i++) {
			modifierContextHublot('black', siblingPiece[i].color);
			contextHublot.fillRect(siblingPiece[i].x*25-24, siblingPiece[i].y*25-24, 24, 24);
		}
	}
	
	function calculateTimeout () {
		return (12-gameInfos.lvl)*50;
	}
	
	//Effectue toute les traitements nécessaires au changement de pièce quand celle en cours a fini son parcours
	function changePiece () {
		//Suppression du Timeout
		clearTimeout(currentTimeout);
		
		//Si la fonction n'est pas bloquée
		if (!currentChangePiece) {
			//Blocage de la fonction
			currentChangePiece = true;
			
			//Attribution des points du tSpin
			if ( currentPiece['type'] === 'T' && currentPiece['idPos'] === 0 ) { //1ère vérif : Si T en position 1, lancer la 2ème vérif
				var tSpinCounterConditions = 0;
				for (var i = 0, c = blocks.length; i<c; i++) { //Vérif de tous les blocs
					if ( 
						(blocks[i].x === currentPiece[1].x -1 && blocks[i].y === currentPiece[1].y)
						|| (blocks[i].x === currentPiece[1].x && blocks[i].y === currentPiece[1].y +1)
						|| (blocks[i].x === currentPiece[3].x && blocks[i].y === currentPiece[3].y +1)
						|| (blocks[i].x === currentPiece[3].x +1 && blocks[i].y === currentPiece[3].y)
						|| (blocks[i].x === currentPiece[1].x && blocks[i].y === currentPiece[1].y -1)
						|| (blocks[i].x === currentPiece[3].x && blocks[i].y === currentPiece[3].y -1)
					) {
						tSpinCounterConditions++;
					}
				}
				if (currentPiece[1].x === 1) {//Verif au cas où le T est sur le bord gauche
					tSpinCounterConditions++;
				}
				if (currentPiece[3].x === 10) {//Verif au cas où le T est sur le bord droit
					tSpinCounterConditions++;
				}
				if (tSpinCounterConditions === 5) { //Si 5/6 conditions sont remplies
					currentScore.tSpin = 400;
				}
			}
			
			//Virement des blocs de currentPiece dans blocks et Optimisation de blocks
			var emptyBlocks = [];
			for (var i = 0, c = blocks.length; i<c; i++) {
				if (blocks[i].x === null) {
					emptyBlocks.push(i);
				}
			}
			for (var i = 0; i<4; i++) {
				if (emptyBlocks[i] !== undefined) {
					blocks[ emptyBlocks[i] ] = currentPiece[i];
				} else {
					blocks.push(currentPiece[i]);
				}
			}
			//Réinitialisation de currentPiece
			for (var i=0; i<4; i++) {
				currentPiece[i] = new Block (null, null, null);
			}
	
			//Référencement des lignes complétées dans completedLignes avec l'ordonnée de la ligne comme identifiant
			blocksPerLignes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
			blocksPerLignes[-1] = 0;
			for (var i = 0, c = blocks.length; i<c; i++) {
				blocksPerLignes[blocks[i].y] += 1;				
			}
			completedLignes = [];		
			for (var i = -1; i<23; i++) {
				if (blocksPerLignes[i] === 10) {
					completedLignes.push(i);
				}
			}
			
			//Attribution des points en fonction du nombre de lignes complétées et Affichage de la bande si besoin
			switch (completedLignes.length) {
				case 0: currentScore.lines = 0; 	break;
				case 1: currentScore.lines = 100; 	break;
				case 2: currentScore.lines = 300; 	displayBande ('double'); 	break;
				case 3: currentScore.lines = 700; 	displayBande ('triple'); 	break;
				case 4: currentScore.lines = 1300; 	displayBande ('tetris'); 	break;
			}
			
			//Traitements finaux : calcul du score et lancement d'une nouvelle pièce
			function finish2 () {
				//Mise à jour de gameInfos.pieces
				gameInfos.pieces++;
				
				//Affichage de la bande t-spin
				if (currentScore.tSpin) {
					switch (currentScore.tSpin) {
						case 400: displayBande ('t-spin'); break;
						case 1100: displayBande ('t-spin-dp'); break;
					}
					if (currentScore.combo) {
						//Ajout du combo au tSpin
						currentScore.tSpin += currentScore.tSpin*currentScore.combo;
						//Affichage de la bande t-spin combo
						displayBande (currentScore.combo+1);
					}
				}				
				//Vérification du btb et Affichage de la bande btb
				if ( gameInfos.lvl*(currentScore.lines + currentScore.tSpin) === 0 ) {
					currentScore.btb = 0;
				} else  if (currentScore.btb) {
					displayBande ('back');
				}
				
				
				//Calcul du score
				gameInfos.lastScore = gameInfos.lvl*(currentScore.lines + currentScore.tSpin) + gameInfos.lvl + currentScore.btb + gameInfos.lvl*( arrondir(0.5*currentScore.softDrop, 'defaut') + currentScore.hardDrop );
				gameInfos.score += gameInfos.lastScore;
				//Affichage du lastScore
				displayLastScore ();
				
				//Mise à jour de gameInfos.decomposedScore
				switch (completedLignes.length) {
					case 1: gameInfos.decomposedScore.simple += gameInfos.lvl*currentScore.lines; break;
					case 2: case 3: gameInfos.decomposedScore.doubleAndTriple += gameInfos.lvl*currentScore.lines; break;
					case 4: gameInfos.decomposedScore.tetris += gameInfos.lvl*currentScore.lines; break;
				}
				gameInfos.decomposedScore.basic += gameInfos.lvl;
				gameInfos.decomposedScore.drop += gameInfos.lvl*( arrondir(0.5*currentScore.softDrop, 'defaut') + currentScore.hardDrop );
				gameInfos.decomposedScore.btb += currentScore.btb;
				gameInfos.decomposedScore.tSpin += gameInfos.lvl*currentScore.tSpin;
				
				//Gestion du combo	
				if ( currentScore.tSpin ) {
					currentScore.combo++; //Si tSpin, on augmente le combo
				} else if (!currentScore.comboReset) {
					currentScore.comboReset = true; //Sinon, si comboReset pas activé, activer le comboReset
				} else {
					currentScore.combo = 0; //Sinon, si comboReset activé, réinitialisation du combo et du comboReset
					currentScore.comboReset = false;
				}
				//Ajout du btb
				if ( gameInfos.lvl*(currentScore.lines + currentScore.tSpin) ) {
					currentScore.btb += gameInfos.lvl*(currentScore.lines + currentScore.tSpin);
				}
				
				//Reinitialisation du reste du currentScore
				currentScore.tSpin = 0;
				currentScore.lines = 0;
				currentScore.softDrop = 0;
				currentScore.hardDrop = 0;
				
				//Création une nouvelle pièce
				newPiece ();
				
				//Déblocage de la fonction
				currentChangePiece = false;
				
				//Lancement d'un nouveau Timeout
				currentTimeout = window.setTimeout(goTimeout, calculateTimeout());
			
				//Actualisation des infos
				displayInfos ();
			}
			
			//Traitements si il y a des lignes complétées
			if (completedLignes.length) {
				//Si T-Spin Double Power
				if (currentScore.tSpin && completedLignes.length === 2) {
					currentScore.tSpin = 1100;
				}
				
				//Mise à jour de gameInfos.lines et gameInfos.lvl (sauf si lvl 10)
				gameInfos.lines += completedLignes.length;
				if (gameInfos.lvl !== 10) {
					gameInfos.lvl = arrondir (1 + gameInfos.lines/10, 'defaut');
					//Affichage de la bande lvl10
					if (gameInfos.lvl === 10) {
						displayBande ('lvl10');
					}
				}
				
				//Traitements après l'animation des lignes complétées
				function finish () {
					//Retirer les blocks des lignes complétées
					for (var i = 0, c = completedLignes.length; i<c; i++) {
						for (var j = 0, d = blocks.length; j<d; j++) {
							if (blocks[j].y === completedLignes[i]) {
								blocks[j] = new Block (null, null, null);
							}
						}
					}
					//Descendre tous les blocks du dessus
					for (var i = 0, c = completedLignes.length; i<c; i++) {
						for (var j = 0, d = blocks.length; j<d; j++) {
							if (blocks[j].y < completedLignes[i] && blocks[j].y != null) {
								blocks[j].y += 1;
							}
						}
					}
					//Lancement des traitements finaux
					finish2 ();
				}
				
				//Animation des lignes complétées
				function repete2 ($last) {
					for (var i = 0, c = completedLignes.length; i<c; i++) {
						for (var j = 0, d = blocks.length; j<d; j++) {
							if (blocks[j].y === completedLignes[i]) {
								blocks[j].color = 'white';
							}
						}
					}
					displayMatrice ();
					setTimeout ( function () {
						for (var i = 0, c = completedLignes.length; i<c; i++) {
							for (var j = 0, d = blocks.length; j<d; j++) {
								if (blocks[j].y === completedLignes[i]) {
									blocks[j].color = 'black';
								}
							}
						}
						displayMatrice ();
					}, 100);
					if (!$last) {
						setTimeout( function () {
							repete2 ('last');
						}, 200);
					} else {
						setTimeout( function () {
							//Lancement des traitements
							finish ();
						}, 200);					
					}
				}
				
				//Lancement de l'animation
				repete2 ();
			} else { //Sinon, si pas de lignes complétées
				//Lancement des traitements finaux
				finish2 ();
			}
			
			//Déblocage de la fonction
			currentChangePiece = false;
			//Actualisation des infos
			displayInfos ();
		}
	}
	
	function displayMatrice() {
		contextMatrice.clearRect(0, 0, allElements.matrice.width, allElements.matrice.height);
		for (var i = 0, c = blocks.length; i<c; i++) {
			modifierContextMatrice('black', blocks[i].color);
			contextMatrice.fillRect(blocks[i].x*25-24, blocks[i].y*25-24, 24, 24);
		}
		for (var i = 0; i<4; i++) {
			modifierContextMatrice('black', currentPiece[i].color);
			contextMatrice.fillRect(currentPiece[i].x*25-24, currentPiece[i].y*25-24, 24, 24);
		}
	}
	
	function displayInfos () { // allElements gameInfos
		allElements.score.innerHTML = lisibilite_nombre(gameInfos.score);
		allElements.lvl.innerHTML = gameInfos.lvl;
		allElements.pieces.innerHTML = gameInfos.pieces;
		allElements.lignes.innerHTML = gameInfos.lines;
		if ( typeof gameInfos.temps === 'number') {
			var min = (arrondir (gameInfos.temps/60000, 'defaut')).toString(),
				sec = (arrondir ((gameInfos.temps - min*60000 ) /1000, 'defaut')).toString(),
				mil = (gameInfos.temps - min*60000 - sec*1000).toString();
			if (min.length === 1) {
				min = '0' + min;
			}
			if (sec.length === 1) {
				sec = '0' + sec;
			}
			while (mil.length < 3) {
				mil = '0' + mil;
			}
			allElements.temps.innerHTML =  min + ' : ' + sec + ' .' + mil;
		} else {	
			allElements.temps.innerHTML = gameInfos.temps;
		}
	}
	
	function displayBande ($msg) {
		if (!currentMsg) {
			var msg;
			if ($msg === 'tetris') {
				msg = 'Tetris !!!';
			} else if ($msg === 't-spin') {
				msg = 'T-Spin !';
			} else if ($msg === 'back') {
				msg = 'Back-to-Back !';
			} else if ($msg === 'double') {
				msg = 'Double !';
			} else if ($msg === 'triple') {
				msg = 'Triple !';
			} else if ($msg === 't-spin-dp') {
				msg = 'T-Spin Power !!';
			} else if (typeof $msg === 'number') {
				msg = 'Combo T-Spin x' + $msg + ' !!';
			} else if ($msg === 'lvl10') {
				msg = 'Last Level !';
			} else if ($msg === 'start') {
				msg = 'Let\'s start !';
			} else if ($msg === 'stop') {
				msg = 'Game Over !';
			} else if ($msg === 'best-score') {
				msg = 'New Best Score !';
			}
		
			one();
		} else {
			waitingMsg.push($msg);
		}
		
		function one () {
			currentMsg = true;
			allElements.bande.innerHTML = msg;
			allElements.bande.style.color = colorsBande[0];
			window.setTimeout(two, 500);
		}
		function two () {
			allElements.bande.style.color = colorsBande[1];
			window.setTimeout(three, 100);
		}
		function three () {
			allElements.bande.style.color = colorsBande[2];
			window.setTimeout(four, 100);
		}
		function four () {
			allElements.bande.style.color = colorsBande[3];
			window.setTimeout(five, 100);
		}
		function five () {
			allElements.bande.style.color = colorsBande[4];
			window.setTimeout(six, 100);
		}
		function six () {
			allElements.bande.style.color = colorsBande[5];
			window.setTimeout(seven, 100);
		}
		function seven () {
			allElements.bande.style.color = colorsBande[6];
			window.setTimeout(eight, 100);
		}
		function eight () {
			allElements.bande.style.color = colorsBande[7];
			currentMsg = false;
			if ( waitingMsg.length > 0) {
				reMsg = waitingMsg[waitingMsg.length-1];
				waitingMsg.length = waitingMsg.length-1;
				displayBande(reMsg);
			}
		}
	}
	
	function displayLastScore () {
		numberOfCurrentLastScore++;
		one ();
		
		function one () {
			allElements.last_score.innerHTML = '+ ' + gameInfos.lastScore;
			allElements.last_score.style.color = colorsBande[0];
			window.setTimeout(two, 500);
		}
		function two () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[1];
				window.setTimeout(three, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function three () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[2];
				window.setTimeout(four, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function four () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[3];
				window.setTimeout(five, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function five () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[4];
				window.setTimeout(six, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function six () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[5];
				window.setTimeout(seven, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function seven () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[6];
				window.setTimeout(eight, 100);
			} else {
				numberOfCurrentLastScore--;
			}
		}
		function eight () {
			if (numberOfCurrentLastScore = 1) {
				allElements.last_score.style.color = colorsBande[7];
			}
			numberOfCurrentLastScore--;
		}
	}
	
	function stop () {
		gameStatus = 'ended';
		//Affichage de la bande stop
		displayBande ('stop');
		
		allElements.start.value = "Game Over !";
		allElements.start.onclick = displayInfos;
		window.setTimeout(function () { 
			allElements.start.value = "Jouer !";
			allElements.start.onclick = start;
		}, 2000);
		allElements.ended.style.display = "block";
		if (gameInfos.score > bestScore) {
			//Affichage de la bande best-score
			displayBande ('best-score');
			sendNewBestScore ();
		}
		stopTime = new Date ().getTime();
		gameInfos.temps = stopTime - startTime;
		displayInfos();
		allElements.pause.style.display = "none";
	}
	
	function sendNewBestScore ($msg) {
		if ( !$msg) {
			var newBestScore = gameInfos.score, pseudo = null;
			var msg = 'Vous avez dépassé le Best Score Ever de ' + allElements.pseudoInTitle.title.slice(4) +
			'et établi un nouveau record : ' + newBestScore + 
			' !\nSouhaitez-vous envoyer ce nouveau record afin qu\'il soit sauvegardé ?';
		} else {
			var msg = $msg;
		}
		
		if ( confirm (msg) ) {
			pseudo = prompt ('Veuillez entrer votre pseudo');
			while (!pseudo || ( /\/\//.test(pseudo) ) ) {
				pseudo = prompt ('Pseudo invalide. Veuillez entrer votre pseudo');
			}
			pseudo = encodeURIComponent(pseudo);
			
			var xhr = new XMLHttpRequest ();
			xhr.open ('GET', 'actualiser_best_score.php?score=' + newBestScore + '&pseudo=' + pseudo);
			xhr.send (null);
			xhr.onreadystatechange = function () {
				if ( xhr.readyState == 4 && xhr.status == 200 && xhr.responseText == 'true' ) {
					alert('Votre record a bien été sauvegardé.');
					bestScore = newBestScore;
					allElements.pseudoInTitle.title = 'Par ' + pseudo;
					allElements.best_score.innerHTML = lisibilite_nombre(bestScore);
				} else if (xhr.readyState == 4) {
					alert('Votre record n\'a pas pu être sauvegardé. \nUne erreur est probablement survenue lors de l\'envoi. ' +
						'\nRapport : ' + '\nxhr.readyState : ' + xhr.readyState + '\nxhr.status : ' + xhr.status + '\nxhr.responseText : ' + xhr.responseText
					);
					sendNewBestScore('Souhaitez-vous réessayer l\'envoi ?');
				}
			};
			
			
		}
	}
	
	function pause () {
		if (gameStatus === 'playing') {
			gameStatus = 'pause';
			allElements.pause.style.display = "block";
			
			currentPauseDate = new Date ();
			currentPauseTime = currentPauseDate.getTime ();
		}
	}
	
	function disPause () {
		gameStatus = 'playing';
		allElements.pause.style.display = "none";
		numberOfCurrentTimeout += 1;
		goTimeout(calculateTimeout()-(currentPauseTime-currentStartTime));
		allElements.body.focus();
	}
	
	function takeKey ($keyCode) {
		if (gameStatus === 'playing') {
			switch ($keyCode) {
			case 40:
				var test = [];				for (var j = 0; j<4; j++) {
					test[j] = currentPiece[j].moveBottom(test, 0);
				}
				if (test[0] && test[1] && test[2] && test[3]) {
					for (var i = 0; i<4; i++) {
						currentPiece[i].moveBottom(0, 'justMove');
					}
					currentScore.softDrop += 1;
				}
				displayMatrice();
			break;
			case 37:
				var test = [];				for (var j = 0; j<4; j++) {
					test[j] = currentPiece[j].moveLeft(test, 0);
				}
				if (test[0] && test[1] && test[2] && test[3]) {
					for (var i = 0; i<4; i++) {
						currentPiece[i].moveLeft(0, 'justMove');
					}
				}
				displayMatrice();
			break;
			case 39:
				var test = [];				for (var j = 0; j<4; j++) {
					test[j] = currentPiece[j].moveRight(test, 0);
				}
				if (test[0] && test[1] && test[2] && test[3]) {
					for (var i = 0; i<4; i++) {
						currentPiece[i].moveRight(0, 'justMove');
					}
				}
				displayMatrice();
			break;
			case 17: var mvt = 1;
			case 38: if (!mvt) { var mvt = -1; }
				falseIdPos = currentPiece['idPos'] +mvt;
				if (mvt === -1 && falseIdPos === -1) {
					falseIdPos += 4;
				} else if (mvt === 1 && falseIdPos === 4) {
					falseIdPos -= 4;
				}
					
				test = [];				
				for (var j = 0; j<4; j++) {
					test[j] = currentPiece[j].rotate(j, falseIdPos, test);
				}
				
				
				if (test[0] && test[1] && test[2] && test[3]) {
					currentPiece['idPos'] += mvt;
					if (mvt === -1 && currentPiece['idPos'] === -1) {
						currentPiece['idPos'] += 4;
					} else if (mvt === 1 && currentPiece['idPos'] === 4) {
						currentPiece['idPos'] -= 4;
					}
					
					for (var i = 0; i<4; i++) {
						currentPiece[i].rotate(i, currentPiece['idPos']);
					}
				}
				displayMatrice();
				mvt = 0;
			break;
			case 32:				
				var test = [];				j = true;
				while (j) {
					for (var i = 0; i<4; i++) {
						test[i] = currentPiece[i].moveBottom(test, 0);
					}
					if (test[0] && test[1] && test[2] && test[3]) {
						for (var i = 0; i<4; i++) {
							currentPiece[i].moveBottom(0, 'justMove');
						}
						currentScore.hardDrop += 1;
					} else {
						changePiece ();
						j = false;
					}					
				}
				displayMatrice();
			break;
			case 13:
				pause ();
			break;
			}
		} else if (gameStatus === 'pause') {
			if ($keyCode === 13) {
				disPause ();
			}
		}
	}
	
/* DECLARATIONS EVENEMENTS */
	allElements.start.onclick = start;
	allElements.matrice.onclick = pause;
	allElements.pause.onclick = disPause;
	allElements.hublot.onclick = function () { //DEBUG
	if (!allElements.infos_tests.innerHTML) {
					allElements.infos_tests.innerHTML = 
						'score : ' + gameInfos.score +
						'</br>basic : ' + gameInfos.decomposedScore.basic +						
						'</br>drop : ' + gameInfos.decomposedScore.drop +						
						'</br>simple : ' + gameInfos.decomposedScore.simple +						
						'</br>doubleAndTriple : ' + gameInfos.decomposedScore.doubleAndTriple +						
						'</br>tetris : ' + gameInfos.decomposedScore.tetris +
						'</br>btb : ' + gameInfos.decomposedScore.btb +
						'</br>tSpin : ' + gameInfos.decomposedScore.tSpin
					;
				} else {
					allElements.infos_tests.innerHTML = '';
				}
	};
	
	allElements.body.onkeydown = function(e) {
		takeKey (e.keyCode);
		event.preventDefault();
	};

/* PETIT DESSIN PAR DEFAUT DANS LE HUBLOT */
	/*
	var blocksDuDessin = [
		new Block(1, 1, 'red'),
		new Block(2, 1, 'red'),
		new Block(2, 2, 'red'),
		new Block(3, 1, 'red'),
		new Block(1, 2, 'orange'),
		new Block(1, 3, 'blue'),
		new Block(2, 3, 'blue'),
		new Block(3, 3, 'blue'),
		new Block(3, 2, 'blue'),
	];
	for (var i = 0, c = blocksDuDessin.length; i<c; i++) {
		modifierContextHublot('black', blocksDuDessin[i].color);
		contextHublot.fillRect(blocksDuDessin[i].x*25-24, blocksDuDessin[i].y*25-24, 25, 25);
	}*/
	
	/*
	modifierContextHublot('black', '#e81123');
	contextHublot.fillRect(1*25-24, 1*25-24, 25, 23);
	contextHublot.fillRect(2*25-24, 1*25-24, 25, 23);
	contextHublot.fillRect(2*25-24, 2*25-24-2, 23, 23+2);
	contextHublot.fillRect(3*25-24, 1*25-24, 23, 23);
	modifierContextHublot('black', '#0084ff');
	contextHublot.fillRect(1*25-24, 3*25-24, 25, 23);
	contextHublot.fillRect(2*25-24, 3*25-24, 25, 23);
	contextHublot.fillRect(3*25-24, 3*25-24, 23, 23);
	contextHublot.fillRect(3*25-24, 2*25-24, 23, 25);
	modifierContextHublot('black', '#ffd700');
	contextHublot.fillRect(1*25-24, 2*25-24, 23, 23);
	*/
	
	modifierContextHublot('black', '#e81130');
	contextHublot.fillRect(1*32-31, 1*32-31, 32, 30);
	contextHublot.fillRect(2*32-31, 1*32-31, 32, 30);
	contextHublot.fillRect(2*32-31, 2*32-31-2, 30, 30+2);
	contextHublot.fillRect(3*32-31, 1*32-31, 30, 30);
	modifierContextHublot('black', '#0084ff');
	contextHublot.fillRect(1*32-31, 3*32-31, 32, 30);
	contextHublot.fillRect(2*32-31, 3*32-31, 32, 30);
	contextHublot.fillRect(3*32-31, 3*32-31, 30, 30);
	contextHublot.fillRect(3*32-31, 2*32-31, 30, 32);
	modifierContextHublot('black', '#ffd700');
	contextHublot.fillRect(1*32-31, 2*32-31, 30, 30);
	
	contextHublot.font = "40px 'sf_collegiate_solidregular'";
	contextHublot.fillText("Zzortell", 30, 97);
	
	modifierContextHublot('black', 'white');
	contextHublot.font = "15px 'sans_serif'";
	contextHublot.fillText("dédié à", 100, 52);
	contextHublot.fillText("Maman", 100, 67);
}