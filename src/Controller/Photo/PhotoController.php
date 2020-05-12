<?php

namespace App\Controller\Photo;

use App\Entity\Photo;
use App\Form\Photo\PhotoFormType;
use App\Repository\PhotoRepository;
use App\Service\UploaderHelper;
use App\Template\Annotation\MenuItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function indexAction(PhotoRepository $repo)
    {
        $photos = $repo->findAll();

        return $this->render('photo/overview.html.twig', [
      'images' => $photos,
    ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
    {
        $form = $this->createForm(PhotoFormType::class, new Photo());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->getData();
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadImage($uploadedFile);
                $photo->setFilename($newFilename);
            }
            $em->persist($photo);
            $em->flush();

            $this->addFlash('success', 'The picture has been uploaded!');

            return $this->redirectToRoute('photo_index');
        }

        return $this->render('photo/new.html.twig', [
      'photoForm' => $form->createView(),
    ]);
    }

    /**
     * $Route("/edit, name="edit").
     */
    public function edit(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
    {
    }
}
