<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Liste des niveaux</title>
    </head>
	
    <body>
		<h1>Liste des niveaux travaillés</h1>
		<ul>
<?php
$list = scandir ( __dir__ );
unset ( $list[0], $list[1], $list[45] );

foreach ( $list as $img ) {
	echo '<a href="' . $img . '"><li>' . ($img) . '</li></a>';
}
?>
		</ul>
    </body>
</html>