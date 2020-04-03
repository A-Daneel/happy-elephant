<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main", methods={"GET"})
     */
    public function mainAction()
    {
        return $this->render('layout.html.twig', [
            'page_title' => 'Happy Elephant',
        ]);
    }
}