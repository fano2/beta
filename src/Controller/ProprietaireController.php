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

    /**
     * @Route("/proprietaire/proprietaireListe", name="proprietaireListe")
     */
    public function proprietaireListe(): Response{
        return $this->render("proprietaire/proprietaireListe.html.twig",[
            'proprietaireListe' => $this->em->getRepository(Proprietaire::class)->findAll()
        ]);
    }

    /**
    * @Route("/proprietaire/modify-proprietaire/{id}", name="modify_proprietaire")
    */
    public function modify_proprietaire(Request $request, int $id): Response{
        $proprietaire = $this->em->getRepository(Proprietaire::class)->find($id);
        $form = $this->createForm(ProprietaireFormType::class, $proprietaire);
        $form->handleRequest($request);
        return $this->render("proprietaire/proprietaireModif.html.twig",[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/proprietaire/update", name="update_proprietaire")
     */
    public function showProprietaireUpdated (Request $request): Response{
        $propritaireId = intval($request->request->get('proprietaire_form')['id']);
        $proprietaire = $this->em->getRepository(Proprietaire::class)->find($propritaireId);
        $form = $this->createForm(ProprietaireFormType::class, $proprietaire);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
        }
        return $this->render("proprietaire/proprietaireListe.html.twig",[
            'proprietaireListe' => $this->em->getRepository(Proprietaire::class)->findAll()
        ]);
    }

    /**
     * @Route("/proprietaire/confirmDelete/{id}", name="cofirm_delete_proprietaire")
     */
    public function proprietaireDeleteConfirmation(int $id): Response{
        return $this->render("proprietaire/btn_proprietaire_confirm_delete.html.twig",[
            'id' => $id
        ]);
    }

    /**
     * @Route("/proprietaire/delete_proprietaire", name="delete_proprietaire")
     */
    public function deleteProprietaire(Request $request): Response{
        $proprietaireId = intval($request->query->get("btn_delete_proprietaire"));
        $proprietaire = $this->em->getRepository(Proprietaire::class)->find($proprietaireId);
        $this->em->remove($proprietaire);
        $this->em->flush();
        return $this->render("proprietaire/proprietaireListe.html.twig",[
            'proprietaireListe' => $this->em->getRepository(Proprietaire::class)->findAll()
        ]);
    }
}