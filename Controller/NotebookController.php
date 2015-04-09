<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotebookController extends Controller
{
    public function notebookAction()
    {
        return $this->render('ZzChezZzortellBundle:Notebook:notebook.html.twig');
    }
}
