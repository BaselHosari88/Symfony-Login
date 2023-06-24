<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Registration;
use App\Form\AdminFormTrainingType;
use App\Form\LessonRegistrationType;
use App\Form\UserUpdateFormType;
use App\Repository\LessonRepository;
use App\Repository\RegistrationRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function index(RegistrationRepository $registrationRepository, LessonRepository $lessonRepository, Lesson $lesson): Response
    {
        $currentUser = $this->getUser();
        $lessons = $registrationRepository->findBy(['user'=>$currentUser]);

//        $arrayOfLessons = $lessonRepository->findBy(['id'=>$lesson]);
//        dd($arrayOfLessons);

        return $this->render('member/index.html.twig', [
            'controller_name' => 'MemberController',
            'lessons' => $lessons
        ]);
    }

    #[Route('/member/update', name: 'app_member_update')]
    public function form(Request $request,   UserRepository $userRepository): Response
    {

        $task =  $this->getUser()  ;


        $form = $this->createForm(UserUpdateFormType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $userRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_member');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }

    #[Route('/member/registration/{id}', name: 'app_member_registration')]
    public function lessonRegistration(Request $request, int $id,  RegistrationRepository $registrationRepository, LessonRepository $lessonRepository): Response
    {


        $task =  new Registration();

        $lesson = $lessonRepository->find($id);

        $lessonId = $lesson->getId();


        $currentUser= $this->getUser();

        $task->setLesson($lesson);
        $task->setUser($currentUser);



        $form = $this->createForm(LessonRegistrationType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $registrationRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_member');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/member/delete/{id}', name: 'app_member_delete')]
    public function deleteLesson(RegistrationRepository $registrationRepository, int $id): Response
    {


        $lessonDelete = $registrationRepository->find($id);
//        dd($lessonDelete);
        $registrationRepository->remove($lessonDelete);




        return $this->redirectToRoute('app_member', [
            'controller_name' => 'MemberController',
        ]);
    }


}
