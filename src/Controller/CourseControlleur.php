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
        //dd();
        $form = $this->createForm(CourseFormType::class);
        $parametreDate = new ParametreDate();
        $dateform = $this->createForm(ParametreDateFormType::class, $parametreDate);
        $dateCourse = null;
        if(count($request->request)>0){
            $dateCourse = $request->get('parametre_date_form')['date'];
        }
        $liste = false;
        if($dateCourse != null){
            $dateCourse = $this->em->getRepository(Course::class)->findBy(['date'=>$dateCourse]);
        }

        return $this->render("course/course.html.twig", [
            "form_title" => "Course",
            "form" => $form->createView(),
            "course" => $dateCourse,
            "dateform" => $dateform->createView()

        ]);
    }

    /**
     * @Route("/bet/add_courses", name="add_courses")
     */
    public function addCourses(Request $request): Response
    {
      // dd($request->query->get("course_form")['date']);
        if( $request->query->count()>0){
            $course = new Course ();
            $time = strtotime($request->query->get("course_form")['date']);
            $date = date('Y-m-d', $time);
            // dd($date);
            $course
                ->setDistance(floatval($request->query->get("course_form")['distance']))
                ->setNumero(intval($request->query->get("course_form")['numero']))
                ->setGains(intval($request->query->get("course_form")['gains']))
                ->setCote(floatval($request->query->get("course_form")['cote']))
                ->setDate($date)
                ->setEntraineur($this->em->getRepository(Entraineur::class)->find(intval($request->query->get("course_form")['entraineur'])))
                ->setHorse($this->em->getRepository(Horse::class)->find(intval($request->query->get("course_form")['horse'])))
                ->setJockey($this->em->getRepository(Jockey::class)->find(intval($request->query->get("course_form")['jockey'])));
                //dd($course);
        }
        
        $form = $this->createForm(CourseFormType::class, $course);
        $form->handleRequest($request);
        $parametreDate = new ParametreDate();
        $dateform = $this->createForm(ParametreDateFormType::class, $parametreDate);  
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();
        $dateCourse = $this->em->getRepository(Course::class)->findBy(['date'=>$date]);    
        return $this->render("course/course.html.twig", [
            "form" => $form->createView(),
            "dateform" => $dateform->createView(),
            "course" => $dateCourse,
        ]);
    }

    // /**
    //  * Route("/bet/course_liste/", name="courseListe")
    //  */
    // public function listCourse(Request $request): Response{
    //     dd($request);
    //     $dateCourse = $this->em->getRepository(Course::class)->findBy(['date'=>$dateCourse]);
    // }   
}
