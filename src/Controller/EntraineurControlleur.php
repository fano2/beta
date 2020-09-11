<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Entraineur;
use App\Form\EntraineurFormType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


class EntraineurControlleur extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/bet/entraineur", name="entrainneur_page")
     */
    public function addEntraineur(Request $request): Response
    {
        $form = $this->createForm(EntraineurFormType::class);

        return $this->render("entraineur/entraineur.html.twig", [
            "form_title" => "Specialiste en pronostique",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/add-entrainneur", name="add_entraineur")
     */
    public function addEntraineurs(Request $request): Response
    {
        $entraineur = new Entraineur();
        $form = $this->createForm(EntraineurFormType::class, $entraineur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entraineur);
            $entityManager->flush();
        }
        return $this->render("entraineur/entraineur.html.twig", [
            "form" => $form->createView()
        ]);
    }

     /**
     * @Route("bet/entraineurliste", name="entraineurliste")
     */
    public function proprietaireListe(Request $request): Response{
        return $this->render("entraineur/entraineurListe.html.twig",[
            'entraineurListe' => $this->em->getRepository(Entraineur::class)->findAll()
        ]);
    }
}
