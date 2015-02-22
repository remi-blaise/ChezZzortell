<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZzChezZzortellBundle:Index:index.html.twig');
    }
}
