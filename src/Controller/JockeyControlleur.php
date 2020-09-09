<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Jockey;
use App\Form\JockeyFormType;
use doctrine\common\Persistence\ObjectManager;

class JockeyControlleur extends AbstractController
{


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
}
