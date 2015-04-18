<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
	Zz\ChezZzortellBundle\Notebook\Article,
	Zz\ChezZzortellBundle\Notebook\ArticleFactory;

class NotebookController extends Controller
{
    public function notebookAction()
    {
        
		
		return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig', [
			'articles' => array(
				ArticleFactory::get(0),
				ArticleFactory::get(1)
			)
		]);
    }
}
