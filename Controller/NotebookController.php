<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotebookController extends Controller
{
    public function notebookAction()
    {
        $factory = $this->get('zz_chez_zzortell.notebook.factory');
		
		return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig', [
			'notes' => array(
				$factory->get(0),
				$factory->get(1),
				$factory->get(2),
				$factory->get(2),
				$factory->get(2),
				$factory->get(2),
			)
		]);
    }
}
