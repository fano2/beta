<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Specialiste;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SpecialisteChoice;
use App\Form\SpecialisteChoiceFormType;
use App\Repository\CourseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SpecialisteChoiceRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use DateTime;

class SpecialisteChoiceControlleur extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->registry = $registry;
        $this->em = $this->registry->getManager('default');
        //$this->emm = 
    }
    /**
     * @Route("/bet/specialisteChoicePage", name="specialisteChoice_page")
     */
    public function specialisteChoicePage(Request $request): Response
    {
        $form = $this->createForm(SpecialisteChoiceFormType::class);

        return $this->render("specialiste/specialisteChoice_page.html.twig", [
            "form_title" => "Prononstique",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/add-SpecilisteChoice", name="add_addSpecilisteChoice")
     */
    public function addSpecilisteChoice(Request $request): Response
    {
        $specialisteChoice = new SpecialisteChoice();
        $form = $this->createForm(SpecialisteChoiceFormType::class, $specialisteChoice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialisteChoice);
            $entityManager->flush();
        }
        return $this->render("specialiste/specialisteChoice_page.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/date/choice/listeRankCourse", name="listeRankCourse")
     */
    public function listeRankCourse(Request $request, SpecialisteChoiceRepository $specialisteChoiceRepository, CourseRepository $courseRepository): Response
    {
        $rank = [];
        $dateCourseChoice = null;
        $specialistId = $request->query->get("specialiste_choice_form")["specialiste"];
        $specialiste = $this->getDoctrine()->getRepository(Specialiste::class)->find($specialistId);

        if ($request->query->count() > 0) {
            $dateCourseChoice = $request->query->get('dateCourseChoice');
            $rank = [
                1 => $request->query->get('premier'),
                2 => $request->query->get('deuxieme'),
                3 => $request->query->get('troisieme'),
                4 => $request->query->get('quatrieme'),
                5 => $request->query->get('cinqieme'),
                6 => $request->query->get('sixieme'),
                7 => $request->query->get('septieme'),
                8 => $request->query->get('huitieme'),
            ];
            $time = strtotime($dateCourseChoice);
            $newformat = date('Y-m-d', $time);
            $entityManager = $this->getDoctrine()->getManager();
            $specilisteAtData = $this->em->getRepository(SpecialisteChoice::class)->findOneBy([
                "specialiste" => $specialiste,
                "datechoice" => $newformat
            ]);
            //eviter le doublon
            if ($specilisteAtData == null) {
                for ($i = 1; $i <= count($rank); $i++) {
                    $specialistchoice = new SpecialisteChoice();
                    $course = $this->getDoctrine()->getRepository(Course::class)->find($rank[$i]);
                    $specialistchoice
                        ->setRang($i)
                        ->setCourse($course)
                        ->setDatechoice($newformat)
                        ->setSpecialiste($specialiste);
                    $entityManager->persist($specialistchoice);
                }
                $entityManager->flush();
            }
            else{
                dd("efa misy io safidy io");
            }
            $specialisteChoice = new SpecialisteChoice();
            $courseChoice = $this->createForm(SpecialisteChoiceFormType::class, $specialisteChoice);
        }
        $CourseChoiceOneDate = $this->em->getRepository(SpecialisteChoice::class)->findBy(
            ['datechoice' => $newformat]
        );
        //specialisteHavechoice
        $query = $this->em->createQuery('SELECT DISTINCT IDENTITY(s.specialiste) FROM App\Entity\SpecialisteChoice s WHERE s.datechoice = :name');
        $query->setParameter('name', $newformat);
        $idsSpecialistehavechoice = $query->getResult();
        $arraySpecilisteHaveChoice = array();
        for($i=0; $i < count($idsSpecialistehavechoice); $i++){
            $test = $this->em->getRepository(SpecialisteChoice::class)->findBy([
                "specialiste" => $this->em->getRepository(Specialiste::class)->findOneBy(["id" => $idsSpecialistehavechoice[$i]]),
                "datechoice" => $newformat
            ]);
           array_push($arraySpecilisteHaveChoice, $test);
        }
        return $this->render("specialiste/specialisteChoice.html.twig", [
            "form2" => $courseChoice->createView(),
            "courseArray" => $courseRepository->findAllcourseOneDate($newformat),
            "dateChoice" => $newformat,
            "arraySpecilisteHaveChoice" => $arraySpecilisteHaveChoice,
            
        ]);
    }
    
}
