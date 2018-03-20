<?php

namespace Zz\ChezZzortellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function freelanceAction()
    {
        return $this->render('ZzChezZzortellBundle::renov.html.twig');
        // return $this->render('ZzChezZzortellBundle:Index:freelance.html.twig');
    }

    public function portfolioAction()
    {
        return $this->render('ZzChezZzortellBundle::renov.html.twig');
        // return $this->render('ZzChezZzortellBundle:Index:portfolio.html.twig');
    }

    // public function indexAction()
    // {
    //     return $this->render('ZzChezZzortellBundle:Index:index.html.twig');
    // }

    public function librariesAction()
    {
        return $this->render('ZzChezZzortellBundle:Index:libraries.html.twig');
    }
}
