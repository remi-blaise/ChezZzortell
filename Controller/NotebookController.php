<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotebookController extends Controller
{
    public function notebookAction()
    {
        $manager = $this->get('zz_chez_zzortell.notebook.manager');
		
		return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig', [
			'notes' => $manager->getEntities(10)
		]);
    }
}
