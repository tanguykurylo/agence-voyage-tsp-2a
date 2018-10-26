<?php

namespace App\Controller;

use App\Entity\Circuit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Controleur FrontOfficeHome
 * @Route("/")
 */
class FrontofficeHomeController extends Controller
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {   
        return $this->redirectToRoute('circuit_index');
    }
    
}
