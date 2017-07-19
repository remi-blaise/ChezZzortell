<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZzChezZzortellBundle:Articles:index.html.twig');
    }
}
