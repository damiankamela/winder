<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScannerController extends Controller
{
    /**
     * @Route("/scanner", name="scanner")
     */
    public function adminLoginAction(Request $request)
    {
        return $this->render('scanner.html.twig');
    }
}
