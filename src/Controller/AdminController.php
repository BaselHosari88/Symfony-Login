<?php

namespace App\Controller;

use App\Entity\Training;
use App\Entity\User;
use App\Form\AdminFormTrainingType;
use App\Form\InsertInstructorType;
use App\Form\UserUpdateFormType;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $userRepository, TrainingRepository $trainingRepository): Response
    {
        $users = $userRepository->findAll();
        $tranings = $trainingRepository->findBy(['deleted'=>null]);
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users,
            'trainings' => $tranings
        ]);
    }

    #[Route('/form/{id}', name: 'app_form')]
    public function form(Request $request, int $id,  UserRepository $userRepository): Response
    {

        $task =  $userRepository->find($id)  ;


        $form = $this->createForm(UserUpdateFormType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $userRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_admin');
        }



        return $this->renderForm('admin/form.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Request $request, int $id,  UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        $task =  $userRepository->find($id)  ;
        $userRepository->remove($task);



        return $this->redirectToRoute('app_admin', [
            'users', $users

        ]);
    }

    #[Route('/insert', name: 'app_insert_instructor')]
    public function insert(Request $request,  UserRepository $userRepository): Response
    {

        $task =  new User()  ;
        $task->setRoles(["ROLE_INSTRUCTOR"]);


        $form = $this->createForm(InsertInstructorType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $userRepository->save($task);

            $this->addFlash('success', 'Rij toegevoegd Basel    ');

            return $this->redirectToRoute('app_admin');
        }



        return $this->renderForm('admin/insert.html.twig', [

            'form' => $form,

        ]);
    }

    #[Route('/admin/insert', name: 'app_admin_insert')]
    public function adminInsert(Request $request,  TrainingRepository $trainingRepository): Response
    {

        $task =  new Training()  ;


        $form = $this->createForm(AdminFormTrainingType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $trainingRepository->save($task);

            $this->addFlash('success', 'les toegevoegd Basel    ');

            return $this->redirectToRoute('app_admin');
        }



        return $this->renderForm('admin/insert.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/admin/update/{id}', name: 'app_admin_update')]
    public function adminUpdate(Request $request,  TrainingRepository $trainingRepository, int $id): Response
    {

        $task =  $trainingRepository->find($id) ;


        $form = $this->createForm(AdminFormTrainingType::class, $task);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $trainingRepository->save($task);

            $this->addFlash('success', 'les toegevoegd Basel    ');

            return $this->redirectToRoute('app_admin');
        }



        return $this->renderForm('admin/insert.html.twig', [

            'form' => $form,

        ]);
    }


    #[Route('/admin/delete/{id}', name: 'app_admin_delete')]
    public function adminDelete(Request $request, int $id,  TrainingRepository $trainingRepository): Response
    {
        $users = $trainingRepository->findAll();
        $task =  $trainingRepository->find($id);
        $task->setDeleted('true');
        $trainingRepository->save($task);

        return $this->redirectToRoute('app_admin', [
            'users', $users

        ]);
    }


}
