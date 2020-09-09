<?php

namespace App\Controller;

use App\Entity\ParametreDate;
use App\Entity\Specialiste;
use App\Entity\SpecialisteChoice;
use App\Form\ParametreDateFormType;
use App\Form\SpecialisteChoiceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CourseRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Persistence\ManagerRegistry;

class DateController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/date", name="choice_date")
     */
    public function index(Request $request, CourseRepository $courseRepository): Response
    {
        $dateCourse = null;
        $specialisteChoice = new SpecialisteChoice();
        $courseArray = null;
        $date = new ParametreDate();
        $dateSearch = $this->createForm(ParametreDateFormType::class, $date);
        $courseChoice = $this->createForm(SpecialisteChoiceFormType::class, $specialisteChoice);
        if ($dateSearch->handleRequest($request)->isSubmitted() && $dateSearch->isValid()) {
            $getdate = $dateSearch->getData('date');
            $dateCourse = $getdate->date->format('y-m-d');
            $courseArray = $courseRepository->findAllcourseOneDate($dateCourse);
            // dd($courseArray);
        }
        //dd($dateCourse);
        return $this->render("datechoice.html.twig", [
            "form" => $dateSearch->createView(),
            //"courseArray" => $courseArray,
            //"dateCourseChoice" => $dateCourse,
            //"form2" => $courseChoice->createView()
        ]);
    }

    /**
     * @Route("/date/choice/", name="showformChoiceCourse")
     */
    public function showformChoiceCourse(Request $request, CourseRepository $courseRepository): Response
    {
        //dd($request);
        $dateCourse = $request->request->get("parametre_date_form")["date"];
        if ($dateCourse != null) {
            $dateaparametre = new ParametreDate();
            $specialisteChoice = new SpecialisteChoice();
            $paramDate = $this->createForm(ParametreDateFormType::class, $dateaparametre);
            $courseArray = $courseRepository->findAllcourseOneDate($dateCourse);
            $courseChoice = $this->createForm(SpecialisteChoiceFormType::class, $specialisteChoice);
            //liste pronostique
            $query = $this->em->createQuery('SELECT DISTINCT IDENTITY(s.specialiste) FROM App\Entity\SpecialisteChoice s WHERE s.datechoice = :name');
            $query->setParameter('name', $dateCourse);
            $idsSpecialistehavechoice = $query->getResult();
            $arraySpecilisteHaveChoice = array();
            for ($i = 0; $i < count($idsSpecialistehavechoice); $i++) {
                $test = $this->em->getRepository(SpecialisteChoice::class)->findBy([
                    "specialiste" => $this->em->getRepository(Specialiste::class)->findOneBy(["id" => $idsSpecialistehavechoice[$i]]),
                    "datechoice" => $dateCourse
                ]);
                array_push($arraySpecilisteHaveChoice, $test);
            }

            return $this->render("specialiste/specialisteChoice.html.twig", [
                "form" => $paramDate->createView(),
                "form2" => $courseChoice->createView(),
                "dateCourseChoice" => $dateCourse,
                "courseArray" => $courseArray,
                "dateChoice" => $dateCourse,
                
                "arraySpecilisteHaveChoice" => $arraySpecilisteHaveChoice
            ]);
        } else {
            return $this->render("base.html.twig");
        }
    }

    /**
     * @Route("/choiceCourse/", name="show_from_choice_course")
     */
    public function choiceCourse(Request $request): Response
    {
        //$v = $request->query->get('date');

        return $this->render('specialiste/choiceCourse.twig', []);
        // $dateChoice = $form['date']->getData();
        // $repository = $this->getDoctrine()->getRepository(Course::class);
        // $dateSpecialisteSelected = $repository->findBy(['date' => $dateChoice]);
        // $repository = $this->getDoctrine()->getRepository(Course::class);
        // $dateSpecialisteSelected = $repository->findBy(['date' => $date]);
        // $form->handleRequest($request);
        // return $this->render("specialiste/choiceCourse.twig", 
        // // [
        //     // "dateSelected" => $dateSpecialisteSelected
        // );
    }

    /**
     * @Route("/date/cho", name="test")
     * 
     */
    public function test_ajax(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $idMagasin = $request->request->get('premier');
            return new JsonResponse($idMagasin);
        }
    }
}
