<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotebookController extends Controller
{
    public function notebookAction()
    {
        
		
		return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig', [
			'articles' => array(
				array(
					'id' => 0,
					'title' => 'Choisir les noms de var en fonction de leur contexte et non de leur contenu.',
					'keywords' => [ 'gp&cs', 'css' ],
					'creation_date' => new \DateTime('14-02-2012'),
					'modif_date' => new \DateTime,
					'content' =>
'Exemples : `@color_title`, `@media_full_screen`.
<br/>Éviter donc les noms tels que `@color_dark_red`, `@media_3`.
<br/>:exclamation: Ne jamais rien coder d\'inutile. Ainsi, il est déconseillé de déclarer : `@color_bg: white;`.
<br/>Un bon code est un code flexible et adapté à la situation.'
				),
				array(
					'id' => 1,
					'title' => 'Redirection',
					'keywords' => [ 'server' ],
					'creation_date' => new \DateTime('14-02-2012'),
					'modif_date' => new \DateTime,
					'content' => 'Cf index de zzortell.perso.sfr.fr'
				)
			)
		]);
    }
}
