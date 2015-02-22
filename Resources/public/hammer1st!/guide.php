<?php 
include ("included/head.php");
include ("included/header.php");
include ("included/nav.php");
include ("included/footer.php");
?>

		<div class="bodier">
			
			<?php /* Si contree n'existe pas */ 
			?>
			
			<h1>
				Guide
			</h1>
			<section class="section3">
				<h2>
					Menu
				</h2>
				<p>
					<h3>
						Niveaux
					</h3>
					<ul>
						<li><a href="guide.php?contree=village" >Village de Hammerfest (0 - 1)</a></li>
						<li><a href="guide.php?contree=premcaverne" >Les premières cavernes (2 - 9)</a></li>
						<li><a href="guide.php?contree=terrier" >Le terrier glissant (10 - 15)</a></li>
						<li><a href="guide.php?contree=profondeurs" >Profondeurs oubliées (16 - 19)</a></li>
						<li><a href="guide.php?contree=verttiges" >Cavernes des Vert-tiges (20 - 30)</a></li>
						<li><a href="guide.php?contree=frimas" >Région du Frimas (31 - 40)</a></li>
						<li><a href="guide.php?contree=morgenfell" >Strates supérieures de Morgenfell (41 - 50)</a></li>
						<li><a href="guide.php?contree=domaine" >Domaine Mangue-qui-roule (51 - 60)</a></li>
						<li><a href="guide.php?contree=souterrain" >Souterrain de la Prune (61 - 70)</a></li>
						<li><a href="guide.php?contree=jungle" >Jungle cavernicole (71 - 80)</a></li>
						<li><a href="guide.php?contree=grotte" >La Grotte Versicolore (81 - 90)</a></li>
						<li><a href="guide.php?contree=tuberculoz" >La Caverne de Tuberculoz (91 - 103)</a></li>		
					</ul>
				</p>
				<p>
					<h3>
						Dimensions parralèles
					</h3>
					<ul>
						<li><a href="guide.php?contree=plombier&type=d" >Cachette du plombier</a></li>
						
					</ul>
				</p>
				<h2>
					Astuces
				</h2>
				<p>
					
				</p>
				<h2>
					Liens externes
				</h2>
				<p>
					Voici quelques <a href="http://www.hammerfest.fr/forum.html/thread/12773" target="blank">autres sites d'aides</a> sur Hammerfest 
					par ordre décroissant(mais malheuresement tous plus ou moins incomplets) :
					<br /><a href="http://astham.free.fr/index.html" target="blank">Astham</a>
					<br /><a href="http://astuhf.free.fr" target="blank">AstuHf</a>
					<br /><a href="http://the_way_it_is.oldiblog.com" target="blank">The Way it is</a>
					<br /><a href="http://aide-hammerfest.oldiblog.com" target="blank">Blog d'Astucieux</a>
					<br /><a href="http://www.meilleursjeux.net/astuces-hammerfest.html" target="blank">Meilleursjeux</a>
					<br />Un petit tuto bien fait : <a href="http://www.hammerfest.fr/forum.html/thread/330053" target="blank">Le Tuto des Saventuriers</a>
					<br />Et bien sûr l'article Twinpedia : <a href="http://www.twinpedia.com/hammerfest" target="blank">Hammerfest</a>
				</p>
			</section>
			
			<?php /* Si contree existe :
			- instancier objet "transformation de contree en noms images"
			- appeller les images stockés dans des variables de l'objet
			- instancier objet "attribution de chaque image à ses liens"
			- appeller les liens, etc. stockés dans le nouvel objet
			- inclure la légende

			*/ 
			?>
			
		</div>

<?php
include ("included/foot.php");
?>