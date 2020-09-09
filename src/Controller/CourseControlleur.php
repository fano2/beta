<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Course;
use App\Entity\Entraineur;
use App\Entity\Horse;
use App\Entity\Jockey;
use App\Entity\ParametreDate;
use App\Form\CourseFormType;
use App\Form\ParametreDateFormType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class CourseControlleur extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/bet/course", name="course_page")
     */
    public function couresPage(Request $request): Response
    {
        $form = $this->createForm(CourseFormType::class);
        $parametreDate = new ParametreDate();
        $dateform = $this->createForm(ParametreDateFormType::class, $parametreDate);

        return $this->render("course/course.html.twig", [
            "form_title" => "Course",
            "form" => $form->createView(),
            "dateform" => $dateform->createView()

        ]);
    }

    /**
     * @Route("/bet/add_courses", name="add_courses")
     */
    public function addCourses(Request $request): Response
    {
       dd($request->query->get('date'));
        if( $request->query->count()>0){
            $course = new Course ();
            $course
                ->setDistance(floatval($request->query->get('distance')))
                ->setNumero(intval($request->query->get('numero')))
                ->setGains(intval($request->query->get('gains')))
                ->setCote(floatval($request->query->get('cote')))
                ->setDate($request->query->get('date'))
                ->setEntraineur($this->em->getRepository(Entraineur::class)->find(intval($request->query->get('entraineur'))))
                ->setHorse($this->em->getRepository(Horse::class)->find(intval($request->query->get('horse'))))
                ->setJockey($this->em->getRepository(Jockey::class)->find(intval($request->query->get('jockey'))));
                dd($course);
        }

        $course = new Course();
        
        $form = $this->createForm(CourseFormType::class, $course);
        $form->handleRequest($request);
        $parametreDate = new ParametreDate();
        $dateform = $this->createForm(ParametreDateFormType::class, $parametreDate);  


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();
            dd("mande");
        }

        return $this->render("course/course.html.twig", [
            "form" => $form->createView(),
            "dateform" => $dateform->createView()
        ]);
    }

   
}
