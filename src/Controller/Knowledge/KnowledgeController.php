<?php

namespace App\Controller\Knowledge;

use App\Template\Annotation\MenuItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/knowledge", name="knowledge_")
 */
class KnowledgeController extends AbstractController
{
    /**
     * @MenuItem(title="Kennisbank", activeCriteria="knowledge_")
     * @Route("/", name="index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('knowledge/overview.html.twig');
    }

    /**
     * @Route("/show", name="show", methods={"GET"})
     */
    public function showAction()
    {
        return $this->render('knowledge/show.static.html.twig');
    }

    /**
     * @Route("/proposal", name="proposal", methods={"GET"})
     */
    public function proposalAction()
    {
        return $this->render('knowledge/proposal.static.html.twig');
    }
}
