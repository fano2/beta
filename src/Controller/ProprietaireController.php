<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\ProprietaireFormType;
use App\Entity\Proprietaire;

class ProprietaireController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/proprietaire", name="proprietaire")
     */
    public function index()
    {
        $form = $this->createForm(ProprietaireFormType::class);
        return $this->render("proprietaire/index.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/proprietaire/newProprietaire", name="newProprietaire")
     */
    public function addProprietaire(Request $request): Response{
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireFormType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proprietaire);
            $entityManager->flush();
        }
        return $this->render("proprietaire/index.html.twig",[
            'form' => $form->createView()
        ]);

    }


}
