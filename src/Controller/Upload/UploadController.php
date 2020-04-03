<?php

namespace App\Controller\Upload;

use App\Template\Annotation\MenuItem;
use App\Form\Upload\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
  /**
   * @Route("/upload", name="app_upload", methods={"GET"})
   */
  public function upload()
  {
    return $this->render('upload/upload.html.twig');
  }

  /**
   * @Route("/upload/view")
   */
  public function indexAction()
  {
    return $this->render('upload/overview.html.twig');
  }

  /**
   * @Route("/upload/test", name="app_upload_test")
   */
  public function formDisplay()
  {
    $form = $this->createForm('App\Form\Upload\ImageType');
  }
}
