<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotebookController extends Controller
{
    const NB_PER_PAGE = 10;
	
	public function notebookAction($tag, $page)
    {
        if ( $page < 1 ) {
			throw $this->createNotFoundException('La page ' . $page . ' n\'existe pas.');
		}
		if ( $tag ) {
			$tags = [ $tag ];
		} else {
			$tags = null;
		}
		
		$manager = $this->get('zz_chez_zzortell.notebook.manager');
		$notes = $manager->getEntities(self::NB_PER_PAGE, self::NB_PER_PAGE*($page-1), $tags);
		
		return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig', [
			'notes' 	=> $notes,
			'page' 		=> $page,
			'nbPages' 	=> ceil(count($notes)/self::NB_PER_PAGE),
		]);
    }
}
