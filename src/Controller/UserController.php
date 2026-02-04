<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class UserController extends AbstractController
{
    #[Route('/members', name: 'app_users')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('member/members.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users,
        ]);
    }

    #[Route('/account/{email}', name: 'app_user_show')]
    public function show(string $email, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['email_user' => $email]);

        if (!$user) {
            throw $this->createNotFoundException('Le membre n\'existe pas');
        }

        return $this->render('member/member.html.twig', [
            'user' => $user,
        ]);
    }
}
