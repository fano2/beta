<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Horse;
use App\Form\HorseTypeFormType;
use doctrine\common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class HorseController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }


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

    /**
     * @Route("/horse/listeHorse", name="listeHorse")
     */
    public function horseListe(Request $request): Response{
        return $this->render('horse/horseListe.html.twig',[
            'listhorse' =>  $this->em->getRepository(Horse::class)->findAll()
        ]);
    }


    /**
     * @Route("/horse/loadHorse/{id}", name="loadHorse")
     */
    public function LoadhorsetoUpdate(Request $request, int $id): Response{
        $horse = $this->em->getRepository(Horse::class)->find($id);
        $form = $this->createForm(HorseTypeFormType::class, $horse);
        $form->handleRequest($request);
        return $this->render("horse/horseModif.html.twig",[
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/horse/updateHorse", name="updateHorse")
     */
    public function updateHorse(Request $request): Response{
        $horseId = intval($request->request->get("horse_type_form")["id"]);
        $horse = $this->em->getRepository(Horse::class)->find($horseId);
        $form = $this->createForm(HorseTypeFormType::class, $horse);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();
        }
        return $this->render('horse/horseListe.html.twig',[
            'listhorse' =>  $this->em->getRepository(Horse::class)->findAll()
        ]);

    }

    /**
     * @Route("/horse/cofirmdeletehorse/{id}", name="cofirm_delete_horse")
     */
    public function horseDeleteConfirmation(int $id): Response{
        return $this->render("horse/btn_modal_confirm_delete.twig",[
            'id' => $id,
        ]);
    }

    /**
     * @Route("/horse/delete_horse", name="delete_horse")
     */
    public function deleteHorse(Request $request): Response{
        $idHorse = intval($request->query->get("btn_horse_del_confirm"));
        $horse = $this->em->getRepository(Horse::class)->find($idHorse);
        $this->em->remove($horse);
        $this->em->flush();
        return $this->render('horse/horseListe.html.twig',[
            'listhorse' =>  $this->em->getRepository(Horse::class)->findAll()
        ]);
    }
}
