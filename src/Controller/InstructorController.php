<?php

namespace App\Controller;

use App\Form\InstructorUpdateType;
use App\Form\LessonType;
use App\Form\UserUpdateFormType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lesson;

class InstructorController extends AbstractController
{
    #[Route('/instructor', name: 'app_instructor')]
    public function index(LessonRepository $lessonRepository): Response
    {
        $currentUser = $this->getUser();
        $currentUserID = $currentUser->getId();

        $lessons =$lessonRepository->findAll();
        $myLessons = $lessonRepository->findBy(['user'=>$currentUser]);

        return $this->render('instructor/index.html.twig', [
           'lessons'=>$lessons,
            'myLessons' => $myLessons
        ]);
    }


    #[Route('/instructor/form/{id}', name: 'app_instructor_form')]
    public function Inform(Request $request,  LessonRepository $lessonRepository, int $id, TrainingRepository $trainingRepository): Response
    {

        $task =  new Lesson() ;
        $currentUser = $this->getUser();
        $currentTraining = $trainingRepository->find($id);
        $task->setTraining($currentTraining);
        $task->setUser($currentUser);


        $form = $this->createForm(LessonType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $lessonRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_instructor');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/instructor/form/{id}', name: 'app_instructor_update')]
    public function update(Request $request,  LessonRepository $lessonRepository,  int $id ): Response
    {

        $task =  $lessonRepository->find($id);


        $form = $this->createForm(InstructorUpdateType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $lessonRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_instructor');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }





    #[Route('/instructor/updateProfile', name: 'app_instructor_update_profile')]
    public function form(Request $request,  UserRepository $userRepository): Response
    {

        $task =  $this->getUser();


        $form = $this->createForm(UserUpdateFormType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $userRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_instructor');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/instructor/lesson/{id}', name: 'app_instructor_lesson')]
    public function lessonInstructor(RegistrationRepository $registrationRepository, int $id): Response
    {
        $currentUser = $this->getUser();

//        $lessons =$registrationRepository->findAll();
        $myLessons = $registrationRepository->findBy(['lesson'=>$id]);


        return $this->render('instructor/lessons.html.twig', [
//            'lessons'=>$lessons,
            'myLessons' => $myLessons
        ]);
    }


}
