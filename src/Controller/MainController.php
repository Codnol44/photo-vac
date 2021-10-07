<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route(path="/home", requirements={"id":"\d+"}, name="main_home", methods={"GET"})
     */
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route(path="/about", requirements={"id":"\d+"}, name="main_about", methods={"GET"})
     */
    public function about()
    {
        return $this->render('main/about.html.twig');
    }

}