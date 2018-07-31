<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function adminLoginAction(Request $request)
    {
        if ($this->getUser() instanceof User) {
            return $this->redirectToRoute('sonata_admin_dashboard');
        }

        return $this->render('security/login.html.twig', array_merge([
            'admin_pool' => $this->get('sonata.admin.pool')
        ], $this->handleAuthentication()));
    }

    protected function handleAuthentication()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return [
            'last_username' => $lastUsername,
            'error'         => $error,
        ];
    }
}
