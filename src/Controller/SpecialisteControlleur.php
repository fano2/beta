<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Specialiste;
use App\Form\SpecialisteFormType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class SpecialisteControlleur extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/bet/specialiste", name="specialiste_page")
     */
    public function addHorse(Request $request): Response
    {
        $form = $this->createForm(SpecialisteFormType::class);

        return $this->render("specialiste/specialiste.html.twig", [
            "form_title" => "Specialiste en pronostique",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/add-specialiste", name="add_specialiste")
     */
    public function addSpecialiste(Request $request): Response
    {
        $specialiste = new Specialiste();
        $form = $this->createForm(SpecialisteFormType::class, $specialiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialiste);
            $entityManager->flush();
        }

        return $this->render("specialiste/specialiste.html.twig", [
            "form_title" => "Ajouter un course",
            "form" => $form->createView(),
        ]);
    }

     /**
     * @Route("/bet/specialisteListe", name="specialisteListe")
     */
    public function jockeyListe(Request $request): Response{
        return $this->render("specialiste/specialisteListe.html.twig",[
            'specialisteListe' => $this->em->getRepository(Specialiste::class)->findAll()
        ]);
    }
}
