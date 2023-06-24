<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Entity\Training;
use App\Entity\User;
use App\Form\AdminType;
use App\Form\RegistrationFormType;
use App\Form\UserUpdateFormType;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TrainingRepository $trainingRepository, Lesson $lesson): Response
    {
        $trainings = $trainingRepository->findBy(['deleted'=>null]);

        return $this->render('main/index.html.twig', [

            'trainings' => $trainings
        ]);
    }

    #[Route('/training/{id}', name: 'app_lesson')]
    public function lesson(LessonRepository $lessonRepository, $id, TrainingRepository $trainingRepository): Response
    {

        $lesson = $lessonRepository->findBy(['training' => $id]);
        $training = $trainingRepository->find($id);
        return $this->render('main/lesson.html.twig', [
            'lesson' => $lesson,
            'id' => $id,
            'training' => $training
        ]);
    }


    #[Route('/rules', name: 'app_rules')]
    public function rules(): Response
    {

        return $this->render('main/rules.html.twig', [

        ]);
    }


    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('main/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_MEMBER']);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email (will do that later)
            $this->addFlash('success', 'Gebruiker succesvol geregistreerd!');
            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }




}
