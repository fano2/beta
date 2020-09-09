<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Horse;
use App\Form\HorseTypeFormType;
use doctrine\common\Persistence\ObjectManager;

class HorseController extends AbstractController
{


    /**
     * @Route("/horse/course", name="horse_page")
     */
    public function addHorse(Request $request): Response
    {
        $form = $this->createForm(HorseTypeFormType::class);

        return $this->render("horse/horseForm.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/horse/add-participant", name="participant")
     */
    public function addCourres(Request $request): Response
    {
        $course = new Horse();
        $form = $this->createForm(HorseTypeFormType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();
        }

        return $this->render("horse/horseForm.html.twig", [
            "form_title" => "Ajouter un course",
            "form" => $form->createView(),
        ]);
    }
}
