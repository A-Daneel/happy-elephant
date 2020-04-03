<?php

namespace App\Controller\Photo;

use App\Template\Annotation\MenuItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/photo", name="photo_")
 */
class PhotoController extends AbstractController
{
    /**
     * @MenuItem(title="Foto's")
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('photo/index.html.twig');
    }
}