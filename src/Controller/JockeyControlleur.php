<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Jockey;
use App\Form\JockeyFormType;
use doctrine\common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class JockeyControlleur extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/bet/Jockey", name="jockey_page")
     */
    public function addJockey(Request $request): Response
    {
        $form = $this->createForm(JockeyFormType::class);

        return $this->render("jockey/jockeyForm.html.twig", [
            "form_title" => "Ajouter un cours",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/add-jockey", name="add_jockey")
     */
    public function addJockeyfrom(Request $request): Response
    {
        $jockey = new Jockey();
        $form = $this->createForm(JockeyFormType::class, $jockey);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($jockey);
            $entityManager->flush();
        }

        return $this->render("jockey/jockeyForm.html.twig", [
            "form_title" => "Ajouter un course",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/bet/JockeyListe", name="JockeyListe")
     */
    public function jockeyListe(Request $request): Response{
        return $this->render("jockey/jockeyListe.html.twig",[
            'jockeyListe' => $this->em->getRepository(Jockey::class)->findAll()
        ]);
    }
}
